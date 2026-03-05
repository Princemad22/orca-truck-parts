    </main>
    
    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5><?php echo __('about'); ?></h5>
                    <p><?php echo __('who_we_are'); ?> ORCA Truck Parts، نحن نقدم أفضل قطع الغيار للشاحنات بجودة عالية وخدمة ممتازة.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5><?php echo __('quick_links'); ?></h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SITE_URL; ?>" class="text-white"><?php echo __('home'); ?></a></li>
                        <li><a href="about.php" class="text-white"><?php echo __('about'); ?></a></li>
                        <li><a href="products.php" class="text-white"><?php echo __('products'); ?></a></li>
                        <li><a href="news.php" class="text-white"><?php echo __('news'); ?></a></li>
                        <li><a href="contact.php" class="text-white"><?php echo __('contact'); ?></a></li>
                    </ul>
                </div>
                
                <div class="col-md-4">
                    <h5><?php echo __('contact_info'); ?></h5>
                    <address>
                        <p><i class="fas fa-map-marker-alt me-2"></i> شارع المصنع، المنطقة الصناعية، الرياض</p>
                        <p><i class="fas fa-phone me-2"></i> +966 11 123 4567</p>
                        <p><i class="fas fa-envelope me-2"></i> info@orcatruckparts.com</p>
                        <p><i class="fas fa-clock me-2"></i> <?php echo __('business_hours'); ?>: 8:00 ص - 6:00 م، السبت - الخميس</p>
                    </address>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> <?php echo __('copyright'); ?> ORCA Truck Parts. <?php echo __('all_rights_reserved'); ?>.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="form-check form-switch d-inline-block">
                        <label class="form-check-label text-white" for="languageSwitch"><?php echo __('language'); ?>:</label>
                        <select id="languageSwitch" class="form-select form-select-sm d-inline-block ms-2" style="width: auto;">
                            <option value="en" <?php echo getCurrentLanguage() === 'en' ? 'selected' : ''; ?>>English</option>
                            <option value="ar" <?php echo getCurrentLanguage() === 'ar' ? 'selected' : ''; ?>>العربية</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/dark-mode.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/language-switcher.js"></script>
    
    <?php if(getCurrentLanguage() === 'ar'): ?>
    <script src="<?php echo ASSETS_URL; ?>/js/rtl.js"></script>
    <?php endif; ?>
    
    </body>
    </html>