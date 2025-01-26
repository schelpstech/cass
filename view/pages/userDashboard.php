<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary" role="region" aria-label="Remittance Due">
                            <div class="inner">
                                <h3><?php echo  $utility->money(isset($totalfigure) && is_numeric($totalfigure) ? htmlspecialchars($totalfigure) : 0); ?></h3>
                                <p>Remittance Due</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('npf_area_command_manager'); ?>" class="small-box-footer">
                                Pay All Remittance Due<i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success" role="region" aria-label="Remittance Paid">
                            <div class="inner">
                                <h3><?php echo $utility->money(isset($totalRemittancePaid) && is_numeric($totalRemittancePaid) ? intval($totalRemittancePaid) : 0); ?></h3>
                                <p>Remittance Paid</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('npf_division_command_manager'); ?>" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning" role="region" aria-label="Schools Allocated">
                            <div class="inner">
                                <h3><?php echo isset($allocatedSchoolNum) && is_numeric($allocatedSchoolNum) ? intval($allocatedSchoolNum) : 0; ?></h3>
                                <p>Schools Allocated</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('schoolsAllocatedList'); ?>" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info" role="region" aria-label="Wallet Balance">
                            <div class="inner">
                                <h3><?php echo isset($clearedSchoolNum) && is_numeric($clearedSchoolNum) ? htmlspecialchars($clearedSchoolNum) : 0; ?></h3>
                                <p>Schools Cleared</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-synagogue"></i>
                            </div>
                            <a href="../../app/router.php?pageid=<?php echo $utility->inputEncode('npf_state_hqtrs_manager'); ?>" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>