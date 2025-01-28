<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Change Password</strong></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="../../app/companyModule.php" method="post" id="changePasswordForm">
                        <div class="card-body">
                            <!-- Display Consultant User Code -->
                            <div class="form-group">
                                <label for="userCode">Consultant User Code:</label>
                                <input type="text" id="userCode" class="form-control" 
                                    value="<?php echo !empty($consultantDetails['user_name']) ? htmlspecialchars($consultantDetails['user_name']) : ''; ?>" 
                                    disabled />
                            </div>

                            <!-- Old Password -->
                            <div class="form-group">
                                <label for="oldPassword">Old Password:</label>
                                <div class="input-group">
                                    <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="Enter old password" required />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <div class="input-group">
                                    <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Enter new password" required />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                </div>
                                <small id="passwordHelp" class="form-text text-muted">
                                    Password must be at least 8 characters long, include an uppercase letter, lowercase letter, number, and symbol.
                                </small>
                                <div id="passwordStrength" class="mt-2"></div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <div class="input-group">
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm new password" required />
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-check-circle"></i></div>
                                    </div>
                                </div>
                                <div id="passwordMatch" class="mt-2"></div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                <button type="submit" name="new_user_password_credential" value="<?php echo $utility->inputEncode("user_password_editor_form"); ?>" class="btn btn-info btn-block">Update Login Credential</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-footer">
                        Use this form to securely update your login credentials.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


