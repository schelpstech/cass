
<?php
include 'query.php';
// Validate and decode pageid
$pageId = isset($_GET['pageid']) ? $utility->inputDecode($_GET['pageid']) : 'consultantDashboard';

// Define navigation settings
$navigationSettings = [
    'consultantDashboard' => [
        'pageid' => 'consultantDashboard',
        'page_name' => 'Dashboard',
        'module' => 'Dashboard',
        'reference' => null,
        'clearedSchool' => null
    ],
    'schoolsAllocatedList' => [
        'pageid' => 'AllocatedSchoolList',
        'page_name' => 'Allocated School List',
        'module' => 'Report',
        'reference' => null,
        'clearedSchool' => null
    ],
    'capturingRecord' => [
        'pageid' => 'capturingRecord',
        'page_name' => 'Record Number of Captured Candidates',
        'module' => 'Clearance',
        'reference' => null,
        'clearedSchool' => null
    ],
    'consultantClearedSchools' => [
        'pageid' => 'consultantClearedSchools',
        'page_name' => 'Summary of Cleared Schools',
        'module' => 'Clearance',
        'reference' => null,
        'clearedSchool' => null
    ],
    'reportSchoolClearance' => [
        'pageid' => 'reportSchoolClearance',
        'page_name' => 'Report of Clearance by Schools',
        'module' => 'Clearance',
        'reference' => null,
        'clearedSchool' => null
    ],
    'consultantpwdMgr' => [
        'pageid' => 'consultantpwdMgr',
        'page_name' => 'Change Login Credential',
        'module' => 'Dashboard',
        'reference' => null,
        'clearedSchool' => null
    ],
    'transactionHistories' => [
        'pageid' => 'transactionHistories',
        'page_name' => 'Transaction History',
        'module' => 'Clearance',
        'reference' => null,
        'clearedSchool' => null
    ],
];

// Check if pageId exists in settings, otherwise default to 'consultantDashboard'
if (array_key_exists($pageId, $navigationSettings)) {
    $_SESSION['pageid'] = $navigationSettings[$pageId]['pageid'];
    $_SESSION['page_name'] = $navigationSettings[$pageId]['page_name'];
    $_SESSION['module'] = $navigationSettings[$pageId]['module'];
    $_SESSION['reference'] = $navigationSettings[$pageId]['reference'];
    $_SESSION['clearedSchool'] = $navigationSettings[$pageId]['clearedSchool'];

} else {
    // Default to 'consultantDashboard'
    $_SESSION['pageid'] = $navigationSettings['consultantDashboard']['pageid'];
    $_SESSION['page_name'] = $navigationSettings['consultantDashboard']['page_name'];
    $_SESSION['module'] = $navigationSettings['consultantDashboard']['module'];
}

// Redirect to the appropriate page
$utility->redirect('../view/pages/viewer.php?pageid=' . $utility->inputEncode($pageId));



?>