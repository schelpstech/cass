<?php
include './query.php';

// Utility Functions
function validatePaymentParameters($email, $amount, $callbackUrl)
{
    if (!$email || !$amount || !$callbackUrl) {
        throw new Exception('Invalid payment parameters.');
    }
}

function recordTransaction($model, $data)
{
    $tblName = 'tbl_transaction';
    if (!$model->insert_data($tblName, $data)) {
        throw new Exception('Failed to record transaction.');
    }
}

function initializePayment($paystack, $email, $amount, $callbackUrl, $transactionReference)
{
    $response = $paystack->initializePayment($email, $amount, $callbackUrl, $transactionReference);
    if (!$response || !isset($response['data']['authorization_url'])) {
        throw new Exception('Failed to initialize payment.');
    }
    return $response['data']['authorization_url'];
}

// Clearance Process
if (isset($_GET['pageid'], $_GET['reference']) && $utility->inputDecode($_GET['pageid']) === 'clearanceProcess') {
    $centreNumber = $utility->inputDecode($_GET['reference']);
    $tblName = 'tbl_remittance';
    $conditions = [
        'where' => [
            'examYearRef' => $examYear['id'],
            'submittedby' => $_SESSION['activeID'],
            'recordSchoolCode' => $centreNumber
        ],
        'return_type' => 'single',
    ];

    $paymentDetails = $model->getRows($tblName, $conditions);

    try {
        $email = $consultantDetails['contactEmail'] ?? null;
        $amount = ($utility->inputDecode($paymentDetails['amountdue']) * 100) ?? null;
        $callbackUrl = 'http://localhost/cass/app/paymentHandler.php';

        validatePaymentParameters($email, $amount, $callbackUrl);

        $transactionReference = $centreNumber . strtoupper($utility->generateRandomText(4));
        $transactionData = [
            'transactionRef' => $transactionReference,
            'transSchoolCode' => $centreNumber,
            'transAmount' => $paymentDetails['amountdue'],
            'transactionType' => 'Individual School',
            'transExamYear' => $examYear['id'],
            'transInitiator' => $_SESSION['active']
        ];

        recordTransaction($model, $transactionData);
        $authorizationUrl = initializePayment($paystack, $email, $amount, $callbackUrl, $transactionReference);

        header("Location: $authorizationUrl");
        exit();
    } catch (Exception $e) {
        $utility->redirectWithNotification('danger', "Error completing transaction: " . $e->getMessage(), 'capturingRecord');
    }
}

// Additional Candidates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['additionalCandidates']) && $utility->inputDecode($_POST['additionalCandidates']) === 'clear_candidates') {
    $recordSchoolCode = htmlspecialchars($_POST['schoolName'], ENT_QUOTES, 'UTF-8');
    $numberCaptured = filter_var($_POST['numCandidatesCaptured'], FILTER_VALIDATE_INT);

    $tblName = 'tbl_remittance';
    $conditions = [
        'where' => [
            'examYearRef' => $examYear['id'],
            'submittedby' => $_SESSION['activeID'],
            'recordSchoolCode' => $recordSchoolCode
        ],
        'return_type' => 'count',
    ];

    if ($model->getRows($tblName, $conditions) == 1) {
        $conditions['return_type'] = 'single';
        $paymentDetails = $model->getRows($tblName, $conditions);

        $_SESSION['ExAmount'] = $paymentDetails['amountdue'];
        $_SESSION['ExNumber'] = $paymentDetails['numberCaptured'];

        try {
            $email = $consultantDetails['contactEmail'] ?? null;
            $amount = (($numberCaptured * 280) * 100) ?? null;
            $callbackUrl = 'https://assoec.org/app/paymentHandler.php';

            validatePaymentParameters($email, $amount, $callbackUrl);

            $transactionReference = $recordSchoolCode . strtoupper($utility->generateRandomText(4));
            $transactionData = [
                'transactionRef' => $transactionReference,
                'transSchoolCode' => $recordSchoolCode,
                'transactionType' => 'Additional Candidate',
                'transAmount' => ($amount / 100),
                'transExamYear' => $examYear['id'],
                'transInitiator' => $_SESSION['active']
            ];

            recordTransaction($model, $transactionData);
            $authorizationUrl = initializePayment($paystack, $email, $amount, $callbackUrl, $transactionReference);

            header("Location: $authorizationUrl");
            exit();
        } catch (Exception $e) {
            $utility->redirectWithNotification('danger', "Error completing transaction: " . $e->getMessage(), 'capturingRecord');
        }
    } else {
        $utility->redirectWithNotification('danger', 'Addition of candidates can only be done for schools with existing clearance records.', 'capturingRecord');
    }
}

// Verify Payment
if (isset($_GET['reference'])) {
    try {
        $paymentResponse = $paystack->verifyTransaction($_GET['reference']);

        if ($paymentResponse['data']['status'] === 'success') {
            $transactionReference = $paymentResponse['data']['reference'];
            $amountPaid = $paymentResponse['data']['amount'] / 100;

            $tblName = 'tbl_transaction';
            $transactionData = [
                'transAmount' => $amountPaid,
                'transStatus' => 1,
                'transDate' => date('Y-m-d')
            ];
            $condition = ['transactionRef' => $transactionReference];

            if ($model->upDate($tblName, $transactionData, $condition)) {
                $conditions = ['return_type' => 'single', 'where' => ['transactionRef' => $transactionReference]];
                $transDetails = $model->getRows($tblName, $conditions);

                $_SESSION['clearedSchool'] = $transDetails['transSchoolCode'];

                $tblName = 'tbl_remittance';
                $updateData = [
                    'clearanceStatus' => 200,
                    'clearanceDate' => date('Y-m-d')
                ];

                if ($transDetails['transactionType'] === 'Additional Candidate') {
                    $newNumber = ($amountPaid / 280) + $utility->inputDecode($_SESSION['ExNumber']);
                    $newAmountPaid = $amountPaid + $utility->inputDecode($_SESSION['ExAmount']);
                    $updateData['amountdue'] = $utility->inputEncode($newAmountPaid);
                    $updateData['numberCaptured'] = $utility->inputEncode($newNumber);
                }

                $model->upDate($tblName, $updateData, ['recordSchoolCode' => $_SESSION['clearedSchool']]);
                $utility->redirectWithNotification('success', 'Transaction verified and saved successfully.', 'clearancePage');
            } else {
                throw new Exception('Could not save the transaction to the database.');
            }
        } else {
            throw new Exception('Transaction verification failed. Status: ' . $paymentResponse['data']['status']);
        }
    } catch (Exception $e) {
        $utility->redirectWithNotification('danger', "Error verifying transaction: " . $e->getMessage(), 'capturingRecord');
    }
}
?>
