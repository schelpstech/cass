<?php
if (file_exists('../../controller/start.inc.php')) {
    include '../../controller/start.inc.php';
} elseif (file_exists('../controller/start.inc.php')) {
    include '../controller/start.inc.php';
} else {
    include './controller/start.inc.php';
};


if (!empty($_SESSION['activeAdmin']) && isset($_SESSION['activeAdmin'])) {
    $tblName = 'book_of_life_admin';
    $conditions = [
        'return_type' => 'count',
        'where' => ['user_name' => $_SESSION['activeAdmin']]
    ];
    $userExists = $model->getRows($tblName, $conditions);
    if ($userExists === 1) {
        $conditions = [
            'return_type' => 'single',
            'where' => ['user_name' => $_SESSION['activeAdmin']],
        ];
        $consultantDetails = $model->getRows($tblName, $conditions);
        $_SESSION['activeAdmin'] = $consultantDetails['user_name'];
    } else {
        $model->log_out_user();
        session_start();
        $utility->setNotification('alert-success', 'icon fas fa-check', 'OOps. Sign in Again');
        $utility->redirect('../console/index.php');
    }
    //Select Active Exam Year

    $tblName = 'examyear';
    $conditions = [
        'return_type' => 'single',
        'where' => ['activeStatus' => 1]
    ];
    $examYear = $model->getRows($tblName, $conditions);
    $_SESSION['examYear'] =  $examYear['year'];


    if (
        !empty($_SESSION['module']) && isset($_SESSION['module']) &&
        ($_SESSION['module'] == 'Dashboard' || $_SESSION['module'] == 'Clearance')
    ) {


        //Dashboard One
        // Fetch profiled school count
        $tblName = 'tbl_schoollist';
        $conditions = [
            'return_type' => 'count',
        ];
        $profileSchools = $model->getRows($tblName, $conditions);

        // Fetch allocated school count
        $tblName = 'tbl_schoolallocation';
        $conditions = [
            'where' => [
                'examYear' => $examYear['id'],
            ],
            'return_type' => 'count',
        ];
        $allocatedSchoolNum = $model->getRows($tblName, $conditions);


        // Fetch cleared school count
        $clearedSchoolNum = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id'],
                'clearanceStatus' => 200,
            ],
            'return_type' => 'count',
        ]);

        // Fetch cleared school count
        $unclearedSchoolNum = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id'],
                'clearanceStatus' => 100,
            ],
            'return_type' => 'count',
        ]);


//Dashboard Two       
        // Sum up the total remittance paid
        // Retrieve remittance paid
        $totalRemittancePaid = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id'],
                'clearanceStatus' => 200
            ],
        ]);

        // Initialize the total figure
        $totalRemittedfigure = 0;
        $totalRemittedNumber = 0;

        // Calculate the total figure if remittance paid exists
        if (!empty($totalRemittancePaid)) {
            foreach ($totalRemittancePaid as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $amount = floatval($utility->inputDecode($row['amountdue']));
                $totalRemittedfigure += $amount;
            }
        }
        if (!empty($totalRemittancePaid)) {
            foreach ($totalRemittancePaid as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $numberRemitted = floatval($utility->inputDecode($row['numberCaptured']));
                $totalRemittedNumber += $numberRemitted;
            }
        }



        // Retrieve remittance dues
        $remittanceDue = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id']
            ]
        ]);

        // Initialize the total figure
        $totalfigure = 0;
        $totalCandidate = 0;

        // Calculate the total figure if remittance due exists
        if (!empty($remittanceDue)) {
            foreach ($remittanceDue as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $amount = floatval($utility->inputDecode($row['amountdue']));
                $totalfigure += $amount;
            }
        }
        // Calculate the total numberCaptured if remittance due exists
        if (!empty($remittanceDue)) {
            foreach ($remittanceDue as $row) {
                // Decode 'numberCaptured' and ensure it's a valid float
                $Candidate = floatval($utility->inputDecode($row['numberCaptured']));
                $totalCandidate += $Candidate;
            }
        }

        // Retrieve School Demography dues
        $numberPrivate = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id'],
                'clearanceStatus' => 200,
                'schType' => 2
            ],
            'joinl' => [
                'tbl_schoollist' => ' on tbl_schoollist.centreNumber = tbl_remittance.recordSchoolCode'
            ]
        ]);
        // Initialize the total figure
        $totalNumberPrivate = 0;
        $totalamountPrivate = 0;
        // Calculate the total figure if remittance due exists
        if (!empty($numberPrivate)) {
            foreach ($numberPrivate as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $privateNum = floatval($utility->inputDecode($row['numberCaptured']));
                $totalNumberPrivate += $privateNum;
            }
        }
        // Calculate the total figure if remittance due exists
        if (!empty($numberPrivate)) {
            foreach ($numberPrivate as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $privateAmount = floatval($utility->inputDecode($row['amountdue']));
                $totalamountPrivate += $privateAmount;
            }
        }

        // Retrieve School Demography dues
        $numberPublic = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id'],
                'clearanceStatus' => 200,
                'schType' => 1
            ],
            'joinl' => [
                'tbl_schoollist' => ' on tbl_schoollist.centreNumber = tbl_remittance.recordSchoolCode'
            ]
        ]);
        // Initialize the total figure
        $totalNumberPublic = 0;
        $totalamountPublic = 0;
        // Calculate the total figure if remittance due exists
        if (!empty($numberPublic)) {
            foreach ($numberPublic as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $publicNum = floatval($utility->inputDecode($row['numberCaptured']));
                $totalNumberPublic += $publicNum;
            }
        }
        if (!empty($numberPublic)) {
            foreach ($numberPublic as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $publicAmount = floatval($utility->inputDecode($row['amountdue']));
                $totalamountPublic += $publicAmount;
            }
        }
    }
}
