<?php
$pageTitle = 'Contact Us';
include '../includes/header.php';

// Process form submission
$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF token validation
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        $error_message = __('invalid_request');
    } else {
        // Collect and sanitize form data
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $inquiry_type = trim($_POST['inquiry_type'] ?? '');
        
        // Validation
        $errors = [];
        
        if (empty($name)) {
            $errors[] = __('name_required');
        }
        
        if (empty($email)) {
            $errors[] = __('email_required');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = __('invalid_email');
        }
        
        if (empty($subject)) {
            $errors[] = __('subject_required');
        }
        
        if (empty($message)) {
            $errors[] = __('message_required');
        }
        
        if (empty($errors)) {
            // In a real application, you would save to database and send email
            // For now, we'll just simulate successful submission
            $message_sent = true;
            
            // Clear form data
            $name = $email = $phone = $subject = $message = '';
        } else {
            $error_message = implode('<br>', $errors);
        }
    }
}

// Generate CSRF token
$csrf_token = generateCSRFToken();
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo __('contact'); ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-4"><?php echo __('contact_us'); ?></h1>
            
            <?php if ($message_sent): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo __('success_title'); ?></strong> <?php echo __('message_sent_successfully'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo __('error_title'); ?></strong> <?php echo $error_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                            <h4><?php echo __('our_address'); ?></h4>
                            <p class="mb-0">شارع المصنع، المنطقة الصناعية<br>الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-phone-alt fa-3x text-primary mb-3"></i>
                            <h4><?php echo __('contact_info'); ?></h4>
                            <p class="mb-0">
                                <i class="fas fa-phone me-2"></i> +966 11 123 4567<br>
                                <i class="fas fa-envelope me-2"></i> info@orcatruckparts.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo __('send_us_message'); ?></h4>
                            <form method="post" action="" id="contactForm">
                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label"><?php echo __('your_name'); ?> *</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?php echo isset($_POST['name']) ? escape($_POST['name']) : ''; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label"><?php echo __('your_email'); ?> *</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?php echo isset($_POST['email']) ? escape($_POST['email']) : ''; ?>" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label"><?php echo __('your_phone'); ?></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="<?php echo isset($_POST['phone']) ? escape($_POST['phone']) : ''; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inquiry_type" class="form-label"><?php echo __('inquiry_type'); ?></label>
                                        <select class="form-select" id="inquiry_type" name="inquiry_type">
                                            <option value=""><?php echo __('select_inquiry_type'); ?></option>
                                            <option value="general" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] === 'general') ? 'selected' : ''; ?>><?php echo __('general_inquiry'); ?></option>
                                            <option value="quotation" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] === 'quotation') ? 'selected' : ''; ?>><?php echo __('quotation'); ?></option>
                                            <option value="partnership" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] === 'partnership') ? 'selected' : ''; ?>><?php echo __('partnership'); ?></option>
                                            <option value="supply" <?php echo (isset($_POST['inquiry_type']) && $_POST['inquiry_type'] === 'supply') ? 'selected' : ''; ?>><?php echo __('supply'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label"><?php echo __('your_subject'); ?> *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" 
                                           value="<?php echo isset($_POST['subject']) ? escape($_POST['subject']) : ''; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label"><?php echo __('your_message'); ?> *</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required><?php 
                                        echo isset($_POST['message']) ? escape($_POST['message']) : ''; 
                                    ?></textarea>
                                </div>
                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg"><?php echo __('send_message'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.751888643435!2d46.64703137546461!3d24.71361307757451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee9e2635abcef%3A0x923b148a0f8429e8!2sRiyadh%2C%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1234567890123" 
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>