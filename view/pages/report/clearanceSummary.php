<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- Consultant Company Logo -->
                    <div class="card-header text-center">
                        <img src="../../storage/app/moest.jpg" width="200" alt="MOEST Logo" />
                    </div>

                    <!-- Title Section -->
                    <div class="card-header text-center">
                        <h3>
                            <b>Summary of WASSCE 2025 Capturing Exercise</b>                           
                        </h3>
                        <br>
                        </div>
                        <div class="card-header">
                        <h4><strong>Consultant Company:</strong> 
                            <?php echo htmlspecialchars($consultantDetails['companyName']); ?>
                        </h4>
                        <h4><strong>Number of Cleared Schools:</strong> 
                            <?php echo $numclearedSchoolRecords; ?>
                        </h4>
                    </div>

                    <!-- Table Content -->
                    <div class="card-body">
                        <?php if (!empty($clearedSchoolRecords)) { ?>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Zone</th>
                                        <th>Centre Number</th>
                                        <th>School Name</th>
                                        <th>School Type</th>
                                        <th>Number of Candidates</th>
                                        <th>Clearance Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($clearedSchoolRecords as $data) { ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td class="text-center"><?php echo '<b>' . htmlspecialchars($data['lga']) . '</b>'; ?></td>
                                            <td><?php echo '<b>' . htmlspecialchars($data['centreNumber']) . '</b>'; ?></td>
                                            <td><?php echo '<b>' . htmlspecialchars($data['SchoolName']) . '</b>'; ?></td>
                                            <td>
                                                <?php
                                                if (intval($data['schType']) === 1) {
                                                    echo "Public";
                                                } elseif (intval($data['schType']) === 2) {
                                                    echo "Private";
                                                } else {
                                                    echo "Unspecified";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo '<b>' . $utility->inputDecode($data['numberCaptured']) . '</b>'; ?></td>
                                            <td>
                                                <?php
                                                switch ($data['clearanceStatus']) {
                                                    case 200:
                                                        echo '<span class="badge badge-success">Cleared</span>';
                                                        break;
                                                    case 100:
                                                        echo '<span class="badge badge-danger">Not Cleared</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="badge badge-warning">Unknown</span>';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- Full Name and Signature Section -->
                            <div class="mt-5 text-center">
                                <p><strong>Full Name:</strong> _____________________________________</p><br>
                                <p><strong>Signature:</strong> _____________________________________</p>
                                <p><strong>Printed ::  <?php echo date("d-m-Y"); ?></strong></p>
                            </div>
                        <?php } else { ?>
                            <!-- Display message if no records -->
                            <div class="alert alert-danger text-center">
                                No cleared schools found for the active exam year: 
                                <strong><?php echo htmlspecialchars($_SESSION['examYear']); ?></strong>.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DataTables Script -->
<script>
    $(document).ready(function () {
        // Initialize DataTables with toolbar and features
        $('#example1').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
