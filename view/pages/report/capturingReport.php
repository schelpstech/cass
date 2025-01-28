<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Report of WASSCE Capturing in Schools as at
                            <?php echo date("d-m-Y") ?>
                        </h3>
                    </div>

                    <div class="card-body">
                        <?php
                        if (!empty($CapturingRecords)) {
                        ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Zone</th>
                                        <th>School Name</th>
                                        <th>Number of Candidates</th>
                                        <th>Remittance Due</th>
                                        <th>Clearance </th>
                                        <th>Modify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($CapturingRecords as $data) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $count++; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php
                                                if (intval($data['schType']) === 1) {
                                                    echo '<b>' . $data['lga'] . '</b>' . " - Public ";
                                                } elseif (intval($data['schType']) === 2) {
                                                    echo '<b>' . $data['lga'] . '</b>' . " - Private ";
                                                } else {
                                                    echo " Unspecified ";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo '<b>' . $data['centreNumber'] . ' - ' . $data['SchoolName'] . '</b>'; ?>
                                            </td>

                                            <td style="text-align: center;">
                                                <?php echo '<b>' . $utility->inputDecode($data['numberCaptured']) . '</b>'; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo '<b>' . $utility->money($utility->inputDecode($data['amountdue'])) . '</b>'; ?>
                                            </td>
                                            <td>
                                                <?php
                                                // Decode the clearance status from the data
                                                $clearanceStatus = $data['clearanceStatus'];

                                                // Base URLs for the links
                                                $paymentURL = '../../app/paymentHandler.php?pageid=';
                                                $routerURL = '../../app/router.php?pageid=';

                                                // Determine the button configuration based on clearance status
                                                if (intval($clearanceStatus) === 100) {
                                                    // Button for pending payment
                                                    echo '<a href="' . $paymentURL . $utility->inputEncode('clearanceProcess') .
                                                        '&reference=' . $utility->inputEncode($data['centreNumber']) . '" 
        class="btn btn-outline-primary btn-lg btn-block d-flex align-items-center justify-content-center">
        <i class="fas fa-clock me-2"></i> Pending :: Pay Now</a>';
                                                } elseif (intval($clearanceStatus) === 200) {
                                                    // Button for printing payment
                                                    echo '<a href="' . $routerURL . $utility->inputEncode('clearancePage') .
                                                        '&clearedSchool=' . $utility->inputEncode($data['centreNumber']) . '" 
        class="btn btn-outline-success btn-lg btn-block d-flex align-items-center justify-content-center">
        <i class="fas fa-print me-2"></i> Print Clearance</a>';
                                                } else {
                                                    // Default button for pending payment
                                                    echo '<a href="' . $paymentURL . $utility->inputEncode('clearanceProcess') .
                                                        '&reference=' . $utility->inputEncode($data['centreNumber']) . '" 
        class="btn btn-outline-primary btn-lg btn-block d-flex align-items-center justify-content-center">
        <i class="fas fa-times-circle me-2"></i> Pending :: Pay Now</a>';
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                // Decode the clearance status from the data
                                                $clearanceStatus = $data['clearanceStatus'];

                                                // Base URL for the links
                                                $baseURL = '../../app/router.php?pageid=';

                                                // Determine the button configuration based on clearance status
                                                if (intval($clearanceStatus) === 100) {
                                                    // Button for modifying record when clearance is pending
                                                    echo '<a href="' . $baseURL . $utility->inputEncode('modifyCapturing') .
                                                        '&reference=' . $utility->inputEncode($data['centreNumber']) . '" 
        class="btn btn-outline-primary btn-lg btn-block d-flex align-items-center justify-content-center">
        <i class="fas fa-edit me-2"></i> Modify Record</a>';
                                                } elseif (intval($clearanceStatus) === 200) {
                                                    // Button for adding additional candidates when clearance is cleared
                                                    echo '<a href="' . $baseURL . $utility->inputEncode('addCandidates') .
                                                        '&reference=' . $utility->inputEncode($data['centreNumber']) . '" 
        class="btn btn-outline-success btn-lg btn-block d-flex align-items-center justify-content-center">
        <i class="fas fa-user-plus me-2"></i> Additional Candidate</a>';
                                                } else {
                                                    // Default button for modifying record
                                                    echo '<a href="' . $baseURL . $utility->inputEncode('modifyCapturing') .
                                                        '&reference=' . $utility->inputEncode($data['centreNumber']) . '" 
        class="btn btn-outline-danger btn-lg btn-block d-flex align-items-center justify-content-center">
        <i class="fas fa-exclamation-circle me-2"></i> Modify Record</a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <!-- Display message if no transactions -->
                            <div class="alert alert-info text-center">
                                You have not made any capturing record in the active exam year:
                                <strong><?php echo htmlspecialchars($_SESSION['examYear']); ?></strong>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>