
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
    ],
    'schoolsAllocatedList' => [
        'pageid' => 'AllocatedSchoolList',
        'page_name' => 'Allocated School List',
        'module' => 'Report',
    ],
    'capturingRecord' => [
        'pageid' => 'capturingRecord',
        'page_name' => 'Record Number of Captured Candidates',
        'module' => 'Clearance',
    ],
    'modifyCapturing' => [
        'pageid' => 'modifyCapturing',
        'page_name' => 'Modify Number of Captured Candidates',
        'module' => 'Clearance',
        'reference' => $_GET['reference'],
    ],
    'addCandidates' => [
        'pageid' => 'addCandidates',
        'page_name' => 'Generate Clearance for Additional Captured Candidates',
        'module' => 'Clearance',
        'reference' => $_GET['reference'],
    ],
    'clearancePage' => [
        'pageid' => 'clearancePage',
        'page_name' => 'Clearance Printout',
        'module' => 'Clearance',
        'clearedSchool' => !empty($_GET['clearedSchool']) ? $utility->inputDecode($_GET['clearedSchool']) : (isset($_SESSION['clearedSchool']) ? $_SESSION['clearedSchool'] : null),
    ]
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