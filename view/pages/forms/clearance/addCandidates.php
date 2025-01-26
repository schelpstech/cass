<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Modify record of Captured Candidates by in selected school</strong></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" aria-label="Collapse Form">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" aria-label="Remove Form">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Form Starts -->
                    <form action="../../app/paymentHandler.php" method="post" id="recordCandidatesForm">
                        <div class="card-body">
                            <!-- Select School Name -->
                            <div class="form-group">
                                <label for="schoolName">Selected School Name:</label>
                                <div class="input-group">
                                    <select id="schoolName" class="form-control" name="schoolName" readonly required="yes">
                                        <option value="<?php echo $SelectedCapturingRecords['centreNumber']; ?>">
                                            <?php echo $SelectedCapturingRecords['centreNumber'] . " - " . $SelectedCapturingRecords['SchoolName']; ?>
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-synagogue"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schoolName">Current Number of Cleared Candidates:</label>
                                <div class="input-group">
                                    <select id="schoolName" class="form-control" readonly required="yes">
                                        <option value="<?php echo $SelectedCapturingRecords['numberCaptured']; ?>">
                                            <?php echo $utility->inputDecode($SelectedCapturingRecords['numberCaptured']) ?>
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fa fa-synagogue"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Number of Candidates Captured -->
                            <div class="form-group">
                                <label for="numCandidatesCaptured"> Number of Additional Candidates Captured:</label>
                                <div class="input-group">
                                    <input type="number" id="numCandidatesCaptured" class="form-control" name="numCandidatesCaptured"
                                        min="1" max="9999" required
                                        title="Please enter a number between 1 and 9999"
                                        placeholder="Enter number of candidates captured" />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-users"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Remittance Due -->
                            <div class="form-group">
                                <label for="remittanceDue">Remittance Due @ &#8358;280 per Candidate:</label>
                                <div class="input-group">
                                    <input type="text" id="remittanceDue" class="form-control" name="remittanceDue"
                                        readonly
                                        placeholder="Calculated remittance due" />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-money-bill-wave"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <button type="submit" name="additionalCandidates" value=<?php echo $utility->inputEncode("clear_candidates"); ?>
                                        class="btn btn-info btn-block">Generate Clearance for Additional Candidates</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-footer">
                        This form is used to modify the number of candidates captured by school.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript to dynamically calculate remittance due
    document.addEventListener("DOMContentLoaded", function() {
        const numCandidatesField = document.getElementById("numCandidatesCaptured");
        const remittanceField = document.getElementById("remittanceDue");

        const ratePerCandidate = 280; // Fixed rate in Naira

        numCandidatesField.addEventListener("input", function() {
            const numCandidates = parseInt(this.value) || 0; // Default to 0 if input is invalid
            const remittanceDue = numCandidates * ratePerCandidate;

            remittanceField.value = remittanceDue.toLocaleString("en-NG", {
                style: "currency",
                currency: "NGN",
                minimumFractionDigits: 2
            });
        });
    });
</script>