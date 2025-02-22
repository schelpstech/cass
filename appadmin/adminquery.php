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



    //Select Capturing Records 
    if (!empty($_SESSION['activeAdmin']) && isset($_SESSION['activeAdmin'])) {
        $tblName = 'tbl_remittance';
        $conditions = [
            'where' => [
                'examYearRef' => $examYear['id'],
                'clearanceStatus' => 200
            ],
            'return_type' => 'count',
        ];
        $numclearedSchoolRecords = $model->getRows($tblName, $conditions);
    }


    if (
        !empty($_SESSION['module']) && isset($_SESSION['module']) &&
        ($_SESSION['module'] == 'Dashboard' || $_SESSION['module'] == 'Clearance')
    ) {

        // Fetch allocated school count
        $allocatedSchoolNum = $model->getRows('tbl_schoolallocation', [
            'return_type' => 'count',
        ]);

        // Fetch cleared school count
        $clearedSchoolNum = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' =>$examYear['id'],
                'clearanceStatus' => 200,
            ],
            'return_type' => 'count',
        ]);

        // Sum up the total remittance paid
        // Retrieve remittance paid
        $totalRemittancePaid = $model->getRows('tbl_transaction', [
            'where' => [
                'transExamYear' => $examYear['id'],
                'transStatus' => 1
            ],
        ]);

        // Initialize the total figure
        $totalRemittedfigure = 0;

        // Calculate the total figure if remittance paid exists
        if (!empty($totalRemittancePaid)) {
            foreach ($totalRemittancePaid as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $amount = floatval($utility->inputDecode($row['transAmount']));
                $totalRemittedfigure += $amount;
            }
        }



        // Retrieve remittance dues
        $remittanceDue = $model->getRows('tbl_remittance', [
            'where' => [
                'examYearRef' => $examYear['id']
            ],
        ]);

        // Initialize the total figure
        $totalfigure = 0;

        // Calculate the total figure if remittance due exists
        if (!empty($remittanceDue)) {
            foreach ($remittanceDue as $row) {
                // Decode 'amountdue' and ensure it's a valid float
                $amount = floatval($utility->inputDecode($row['amountdue']));
                $totalfigure += $amount;
            }
        }
    }
}
