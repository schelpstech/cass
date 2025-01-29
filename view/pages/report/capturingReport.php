<script>
    $(document).ready(function () {
        $('#example1').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "pageLength": 10,
            "order": [[0, "asc"]], // Sorting by S/N
            "buttons": ["copy", "csv", "excel", "pdf", "print"] // Export buttons
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Report of WASSCE Capturing in Schools as at <?php echo date("d-m-Y"); ?></h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Zone</th>
                                    <th>School Name</th>
                                    <th>Number of Candidates</th>
                                    <th>Remittance Due</th>
                                    <th>Clearance</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($CapturingRecords)): ?>
                                    <?php $count = 1; ?>
                                    <?php foreach ($CapturingRecords as $data): ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td class="text-center">
                                                <?php 
                                                    $schoolType = intval($data['schType']);
                                                    $lga = htmlspecialchars($data['lga']);
                                                    echo $schoolType === 1 ? "<b>{$lga}</b> - Public" : ($schoolType === 2 ? "<b>{$lga}</b> - Private" : "Unspecified");
                                                ?>
                                            </td>
                                            <td><b><?php echo htmlspecialchars($data['centreNumber']) . ' - ' . htmlspecialchars($data['SchoolName']); ?></b></td>
                                            <td class="text-center"><b><?php echo htmlspecialchars($utility->inputDecode($data['numberCaptured'])); ?></b></td>
                                            <td class="text-center"><b><?php echo $utility->money($utility->inputDecode($data['amountdue'])); ?></b></td>
                                            <td>
                                                <?php 
                                                    $clearanceStatus = intval($data['clearanceStatus']);
                                                    $centreNumber = $utility->inputEncode($data['centreNumber']);
                                                    $paymentURL = '../../app/paymentHandler.php?pageid=clearanceProcess&reference=' . $centreNumber;
                                                    $routerURL = '../../app/router.php?pageid=clearancePage&clearedSchool=' . $centreNumber;

                                                    if ($clearanceStatus === 100) {
                                                        echo "<a href='{$paymentURL}' class='btn btn-outline-primary btn-lg btn-block'><i class='fas fa-clock me-2'></i> Pending :: Pay Now</a>";
                                                    } elseif ($clearanceStatus === 200) {
                                                        echo "<a href='{$routerURL}' class='btn btn-outline-success btn-lg btn-block'><i class='fas fa-print me-2'></i> Print Clearance</a>";
                                                    } else {
                                                        echo "<a href='{$paymentURL}' class='btn btn-outline-danger btn-lg btn-block'><i class='fas fa-times-circle me-2'></i> Pending :: Pay Now</a>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $modifyURL = '../../app/router.php?pageid=modifyCapturing&reference=' . $centreNumber;
                                                    $addCandidatesURL = '../../app/router.php?pageid=addCandidates&reference=' . $centreNumber;

                                                    if ($clearanceStatus === 100) {
                                                        echo "<a href='{$modifyURL}' class='btn btn-outline-primary btn-lg btn-block'><i class='fas fa-edit me-2'></i> Modify Record</a>";
                                                    } elseif ($clearanceStatus === 200) {
                                                        echo "<a href='{$addCandidatesURL}' class='btn btn-outline-success btn-lg btn-block'><i class='fas fa-user-plus me-2'></i> Additional Candidate</a>";
                                                    } else {
                                                        echo "<a href='{$modifyURL}' class='btn btn-outline-danger btn-lg btn-block'><i class='fas fa-exclamation-circle me-2'></i> Modify Record</a>";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center alert alert-info">
                                            You have not made any capturing record in the active exam year: <strong><?php echo htmlspecialchars($_SESSION['examYear']); ?></strong>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>