<section class="content mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <!-- Consultant Company Logo -->
                    <div class="card-header text-center">
                        <img id="consultantLogo" src="../../storage/app/moest.jpg" width="250" alt="MOEST Logo" />
                        <h2 class="mt-3"><b>Summary of WASSCE 2025 Capturing Exercise</b></h2>
                    </div>

                    <div class="card-body">
                        <?php if (!empty($clearedSchoolRecords)) { ?>
                            <div class="card-header text-center">
                                <h4 style="text-align:left;"><strong>Consultant Company:</strong> <span id="consultantName"><?php echo htmlspecialchars($consultantDetails['companyName']); ?></span></h4>
                                <h4 style="text-align:left;"><strong>Number of Cleared Schools:</strong> <span id="clearedSchoolCount"><?php echo intval($numclearedSchoolRecords); ?></span></h4>
                                <h4 style="text-align: left;"><strong>Total Number of Registered Candidates:</strong> <span id="totalCandidates"></span></h4>
                            </div>

                            <div class="table-responsive mt-3">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead class="table-dark">
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
                                        $totalCandidates = 0;
                                        foreach ($clearedSchoolRecords as $data) {
                                            $totalCandidates += intval($utility->inputDecode($data['numberCaptured'])); ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td class="text-center"><b><?php echo htmlspecialchars($data['lga']); ?></b></td>
                                                <td><b><?php echo htmlspecialchars($data['centreNumber']); ?></b></td>
                                                <td><b><?php echo htmlspecialchars($data['SchoolName']); ?></b></td>
                                                <td>
                                                    <?php
                                                    echo (intval($data['schType']) === 1) ? "Public" : ((intval($data['schType']) === 2) ? "Private" : "Unspecified");
                                                    ?>
                                                </td>
                                                <td class="text-center"><b><?php echo $utility->inputDecode($data['numberCaptured']); ?></b></td>
                                                <td>
                                                    <?php
                                                    echo ($data['clearanceStatus'] == 200) ? '<span class="badge bg-success">Cleared</span>' : (($data['clearanceStatus'] == 100) ? '<span class="badge bg-danger">Not Cleared</span>' :
                                                        '<span class="badge bg-warning">Unknown</span>');
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <script>document.getElementById('totalCandidates').textContent = '<?php echo $totalCandidates; ?>';</script>
                            </div>

                            <!-- Full Name and Signature Section -->
                            <div class="mt-5 text-center">
                                <p><strong>Full Name:</strong> _____________________________________</p>
                                <br>
                                <p><strong>Signature:</strong> _____________________________________</p>
                                <p><strong>Printed: <?php echo date("d-m-Y"); ?></strong></p>
                            </div>
                        <?php } else { ?>
                            <!-- Display message if no records -->
                            <div class="alert alert-danger text-center">
                                No cleared schools found for the active exam year:
                                <strong><?php echo isset($_SESSION['examYear']) ? htmlspecialchars($_SESSION['examYear']) : 'N/A'; ?></strong>.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Required Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "pageLength": 300,
            "order": [
                [0, "asc"]
            ],
            "dom": 'Bfrtip',
            "buttons": [{
                    extend: 'pdf',
                    text: 'Export PDF',
                    className: 'btn btn-danger',
                    customize: function(doc) {
                        doc.content.splice(0, 0, {
                            alignment: 'center',
                            image: getBase64Image(document.getElementById("consultantLogo")),
                            width: 150
                        });
                        doc.content.splice(1, 0, {
                            alignment: 'center',
                            text: "Summary of WASSCE 2025 Capturing Exercise",
                            fontSize: 18,
                            bold: true
                        });
                        doc.content.splice(2, 0, {
                            alignment: 'left',
                            text: "Consultant Company: " + document.getElementById("consultantName").textContent,
                            fontSize: 14,
                            bold: true
                        });
                        doc.content.splice(3, 0, {
                            alignment: 'left',
                            text: "Number of Cleared Schools: " + document.getElementById("clearedSchoolCount").textContent,
                            fontSize: 14,
                            bold: true
                        });
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-primary',
                    customize: function(win) {
                        $(win.document.body).prepend(
                            '<div style="text-align: center; margin-bottom: 20px;">' +
                            '<img src="' + document.getElementById("consultantLogo").src + '" width="150"><br>' +
                            '<h2>Summary of WASSCE 2025 Capturing Exercise</h2>' +
                            '<h3 style="text-align:left;">Consultant Company: ' + document.getElementById("consultantName").textContent + '</h3>' +
                            '<h3 style="text-align:left;">Number of Cleared Schools: ' + document.getElementById("clearedSchoolCount").textContent + '</h3>' +
                            '</div>'
                        );
                        $(win.document.body).append(
                            '<div style="text-align: center; margin-bottom: 20px;">' +
                            '<br><p style="text-align:centre;"><strong>Full Name:</strong> _____________________________________</p><br>' +
                            '<p style="text-align:centre;"><strong>Designation:</strong> _____________________________________</p><br>' +
                            '<p style="text-align:centre;"><strong>Signature:</strong> _____________________________________</p><br>' +
                            '<p><strong>Printed: <?php echo date("d-m-Y"); ?></strong></p>' +
                            '</div>'
                        );
                    }
                }
            ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    });

    function getBase64Image(img) {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        return canvas.toDataURL("image/png").replace(/^data:image\/(png|jpg);base64,/, "");
    }
</script>