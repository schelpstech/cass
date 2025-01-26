<?php
include '../include/header.php';
include '../include/nav.php';
include '../include/aside.php';

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h6>Page :: <?php echo $_SESSION['page_name'] ?> </h6>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><strong>Active Module</strong></li>
                        <li class="breadcrumb-item active"><?php echo $_SESSION['module'] ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php
            // Check if pageid exists in the GET request
            $pageId = isset($_GET['pageid']) ? $utility->inputDecode($_GET['pageid']) : '';

            if ($pageId === 'consultantDashboard') {
                include './userDashboard.php';
                echo '<br><br>';
                include './forms/consultant/profile.php';
            } elseif ($pageId === 'schoolsAllocatedList') {
                //Allocated School List
                include './report/schoolList.php';
            } elseif ($pageId === 'capturingRecord') {
                include './userDashboard.php';
                echo '<br><br>';
                //Record Captured Candidates
                include './forms/clearance/capturing.php';
                echo '<br><br>';
                include './report/capturingReport.php';
            } elseif ($pageId === 'modifyCapturing') {
                //Allocated School List
                include './forms/clearance/modifyCapturing.php';
            } elseif ($pageId === 'clearancePage') {
                //Allocated School List
                include './report/clearance.php';
            }  elseif ($pageId === 'addCandidates') {
                //Allocated School List
                include './forms/clearance/addCandidates.php';
            } else {
                // Default case
                include './userDashboard.php';
                echo '<br><br>';
                include './forms/consultant/profile.php';
            }
            ?>
        </div>
    </section>
</div>
<?php
include '../include/footer.php';
?>