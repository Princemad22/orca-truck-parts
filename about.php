<?php
$pageTitle = 'About Us';
include 'includes/header.php';
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo __('about'); ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-4 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('about'); ?> <span class="en-text">ORCA Truck Parts</span></h1>
            
            <div class="text-center mb-5">
                <img src="https://picsum.photos/800/400?random=1" alt="ORCA Truck Parts Company" class="img-fluid rounded shadow">
            </div>
            
            <section class="about-content mb-5">
                <h2 class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('who_we_are'); ?></h2>
                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('who_we_are_desc'); ?></p>
                
                <h2 class="mt-5 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('our_mission'); ?></h2>
                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('our_mission_desc'); ?></p>
                
                <h2 class="mt-5 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('our_vision'); ?></h2>
                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('our_vision_desc'); ?></p>
                
                <h2 class="mt-5 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('why_choose_us'); ?></h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                                <h4 class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('quality_assurance'); ?></h4>
                                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('quality_assurance_desc'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                                <h4 class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('fast_delivery'); ?></h4>
                                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('fast_delivery_desc'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tags fa-3x text-primary mb-3"></i>
                                <h4 class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('competitive_pricing'); ?></h4>
                                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('competitive_pricing_desc'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                                <h4 class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('expert_support'); ?></h4>
                                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('expert_support_desc'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="team-section mb-5">
                <h2 class="text-center mb-4 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('our_team'); ?></h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card team-member">
                            <img src="https://picsum.photos/300/200?random=2" class="card-img-top" alt="Team Member">
                            <div class="card-body text-center">
                                <h5 class="card-title <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>">John Smith</h5>
                                <p class="card-text text-muted <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('ceo'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card team-member">
                            <img src="https://picsum.photos/300/200?random=3" class="card-img-top" alt="Team Member">
                            <div class="card-body text-center">
                                <h5 class="card-title <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>">Sarah Johnson</h5>
                                <p class="card-text text-muted <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('operations_manager'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card team-member">
                            <img src="https://picsum.photos/300/200?random=4" class="card-img-top" alt="Team Member">
                            <div class="card-body text-center">
                                <h5 class="card-title <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>">Ahmed Hassan</h5>
                                <p class="card-text text-muted <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('technical_lead'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="certifications-section mb-5">
                <h2 class="text-center mb-4 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('certifications'); ?></h2>
                <div class="row">
                    <div class="col-md-3 col-6 mb-4">
                        <div class="text-center">
                            <i class="fas fa-certificate fa-3x text-warning mb-2"></i>
                            <p class="en-text">ISO 9001</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="text-center">
                            <i class="fas fa-certificate fa-3x text-warning mb-2"></i>
                            <p class="en-text">Saudi Standards</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="text-center">
                            <i class="fas fa-certificate fa-3x text-warning mb-2"></i>
                            <p class="en-text">Quality Assurance</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-4">
                        <div class="text-center">
                            <i class="fas fa-certificate fa-3x text-warning mb-2"></i>
                            <p class="en-text">Trusted Supplier</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>