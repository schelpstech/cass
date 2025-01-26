<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (file_exists('../../controller/start.inc.php')) {
    include '../../controller/start.inc.php';
} elseif (file_exists('../controller/start.inc.php')) {
    include '../controller/start.inc.php';
} else {
    include './controller/start.inc.php';
};


if (!empty($_SESSION['active']) && isset($_SESSION['active'])) {
    $tblName = 'book_of_life';
    $conditions = [
        'return_type' => 'count',
        'where' => ['user_name' => $_SESSION['active']]
    ];
    $userExists = $model->getRows($tblName, $conditions);
    if ($userExists === 1) {
        $conditions = [
            'return_type' => 'single',
            'where' => ['user_name' => $_SESSION['active']],
            'joinl' => [
                'tbl_consultantdetails' => ' on tbl_consultantdetails.userid = book_of_life.userid',
            ]
        ];
        $consultantDetails = $model->getRows($tblName, $conditions);
        $_SESSION['activeID'] = $consultantDetails['userId'];
    }

    //Select Active Exam Year

    $tblName = 'examyear';
    $conditions = [
        'return_type' => 'single',
        'where' => ['activeStatus' => 1]
    ];
    $examYear = $model->getRows($tblName, $conditions);
    $_SESSION['examYear'] =  $examYear['year'];


    //Select All Allocated Schools

    $tblName = 'tbl_schoolallocation';
    $conditions = [
        'where' => ['consultantID' =>  $_SESSION['activeID']],
        'joinl' => [
            'tbl_schoollist' => ' on tbl_schoollist.centreNumber = tbl_schoolallocation.schoolCode',
            'examyear' => ' on examyear.id = tbl_schoolallocation.examYear',
            'lga_tbl' => ' on lga_tbl.waecCode = tbl_schoollist.lgaCode',
        ],
        'order_by' => 'SchoolName ASC',
    ];
    $allocatedSchools = $model->getRows($tblName, $conditions);


    //Select Capturing Records 
    if (!empty($_SESSION['activeID']) && isset($_SESSION['activeID'])) {
        $tblName = 'tbl_remittance';
        $conditions = [
            'where' => [
                'examYearRef' => $examYear['id'],
                'submittedby' => $_SESSION['activeID']
            ],
            'joinl' => [
                'tbl_schoollist' => ' on tbl_schoollist.centreNumber = tbl_remittance.recordSchoolCode',
                'lga_tbl' => ' on lga_tbl.waecCode = tbl_schoollist.lgaCode',
            ],
            'order_by' => 'remRecTime ASC',
        ];
        $CapturingRecords = $model->getRows($tblName, $conditions);
    }

    if ( !empty($_SESSION['pageid']) &&isset($_SESSION['pageid']) && $_SESSION['pageid'] == 'modifyCapturing' || $_SESSION['pageid'] == 'addCandidates') {

        $tblName = 'tbl_remittance';
        $conditions = [
            'where' => [
                'examYearRef' => $examYear['id'],
                'submittedby' => $_SESSION['activeID'],
                'recordSchoolCode' => $utility->inputDecode($_SESSION['reference'])
            ],
            'joinl' => [
                'tbl_schoollist' => ' on tbl_schoollist.centreNumber = tbl_remittance.recordSchoolCode',
            ],
            'return_type' => 'single',
        ];
        $SelectedCapturingRecords = $model->getRows($tblName, $conditions);
    }



    //Select Capturing Records 
    if (!empty($_SESSION['clearedSchool']) && isset($_SESSION['clearedSchool'])) {
        // Check if the school has paid
        $tblName = 'tbl_transaction';
        $conditions = [
            'where' => [
                'transSchoolCode' => $_SESSION['clearedSchool'],
                'transStatus' => 1,
                'transInitiator' => $_SESSION['active'],
                'transExamYear' => 1
            ],
            'return_type' => 'count',
        ];
        $checkPayment = $model->getRows($tblName, $conditions);

        if ($checkPayment >= 1) {
            // Retrieve clearance information
            $tblName = 'tbl_remittance';
            $conditions = [
                'where' => [
                    'examYearRef' => $examYear['id'],
                    'submittedby' => $_SESSION['activeID'],
                    'recordSchoolCode' => $_SESSION['clearedSchool'],
                    'clearanceStatus' => 200,
                ],
                'joinl' => [
                    'tbl_schoollist' => ' ON tbl_schoollist.centreNumber = tbl_remittance.recordSchoolCode',
                    'lga_tbl' => ' ON lga_tbl.waecCode = tbl_schoollist.lgaCode',
                    'tbl_consultantdetails' => ' on tbl_consultantdetails.userid = tbl_remittance.submittedby',
                ],
                'return_type' => 'single',
            ];
            $printClearanceInfo = $model->getRows($tblName, $conditions);
        }
    }



    //Dashboard Panel

    if (!empty($_SESSION['module']) && isset($_SESSION['module']) && $_SESSION['module'] == 'Dashboard' || 'Clearance') {


        $tblName = 'tbl_schoolallocation';
        $condition = array(
            'where' => ['consultantID' =>  $_SESSION['activeID']],
            'return_type' => 'count',
        );
        $allocatedSchoolNum = $model->getRows($tblName, $condition);

        $tblName = 'tbl_remittance';
        $condition = array(
            'where' => [
                'submittedby' =>  $_SESSION['activeID'],
                'clearanceStatus' =>  200,
            ],
            'return_type' => 'count',
        );
        $clearedSchoolNum = $model->getRows($tblName, $condition);


        $totalRemittancePaid = $model->sumQuery('tbl_transaction', 'transAmount', [
            'where' => [
                'transInitiator' => $_SESSION['active'],
                'transExamYear' => $examYear['id']
            ]
        ]);

        $tblName = 'tbl_remittance';
        $condition = array(
            'where' => [
                'submittedby' =>  $_SESSION['activeID'],
            ],
        );
        $remittanceDue = $model->getRows($tblName, $condition);
        // Initialize the total figure
        $totalfigure = 0;

        // Check if the $remittanceDue is not empty
        if (!empty($remittanceDue)) {
            foreach ($remittanceDue as $row) {
                // Decode the 'amountdue' if it is JSON encoded, otherwise use it directly
                $amount = $utility->inputDecode($row['amountdue']);
                // Add the amount to the total figure
                $totalfigure += floatval($amount); // Ensure the amount is treated as a number
            }
        }
    }
}
