<?php
$pageTitle = 'Manage Pages';
include 'includes/header.php';

// Check if user has permission to manage pages
if ($_SESSION['role'] !== 'super_admin' && $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Handle form submissions
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        
        if ($action === 'add' || $action === 'edit') {
            $id = $action === 'edit' ? (int)$_POST['id'] : null;
            $slug = trim($_POST['slug'] ?? '');
            $title_ar = trim($_POST['title_ar'] ?? '');
            $title_en = trim($_POST['title_en'] ?? '');
            $content_ar = trim($_POST['content_ar'] ?? '');
            $content_en = trim($_POST['content_en'] ?? '');
            $meta_desc_ar = trim($_POST['meta_desc_ar'] ?? '');
            $meta_desc_en = trim($_POST['meta_desc_en'] ?? '');
            $status = trim($_POST['status'] ?? 'active');
            
            // Validation
            if (empty($slug) || empty($title_ar) || empty($title_en)) {
                $error = __('please_fill_required_fields');
            } else {
                try {
                    $pdo = getDB();
                    
                    if ($action === 'add') {
                        $stmt = $pdo->prepare("INSERT INTO pages (slug, title_ar, title_en, content_ar, content_en, meta_desc_ar, meta_desc_en, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                        $result = $stmt->execute([$slug, $title_ar, $title_en, $content_ar, $content_en, $meta_desc_ar, $meta_desc_en, $status]);
                    } else {
                        $stmt = $pdo->prepare("UPDATE pages SET slug = ?, title_ar = ?, title_en = ?, content_ar = ?, content_en = ?, meta_desc_ar = ?, meta_desc_en = ?, status = ?, updated_at = NOW() WHERE id = ?");
                        $result = $stmt->execute([$slug, $title_ar, $title_en, $content_ar, $content_en, $meta_desc_ar, $meta_desc_en, $status, $id]);
                    }
                    
                    if ($result) {
                        $message = $action === 'add' ? __('page_added_successfully') : __('page_updated_successfully');
                    } else {
                        $error = __('error_occurred');
                    }
                } catch (Exception $e) {
                    $error = __('error_occurred') . ': ' . $e->getMessage();
                }
            }
        } elseif ($action === 'delete') {
            $id = (int)$_POST['id'];
            try {
                $pdo = getDB();
                $stmt = $pdo->prepare("DELETE FROM pages WHERE id = ?");
                $result = $stmt->execute([$id]);
                
                if ($result) {
                    $message = __('page_deleted_successfully');
                } else {
                    $error = __('error_occurred');
                }
            } catch (Exception $e) {
                $error = __('error_occurred') . ': ' . $e->getMessage();
            }
        }
    }
}

// Fetch all pages
try {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT * FROM pages ORDER BY created_at DESC");
    $pages = $stmt->fetchAll();
} catch (Exception $e) {
    $pages = [];
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo __('manage_pages'); ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addPageModal">
                <i class="fas fa-plus me-1"></i><?php echo __('add_new_page'); ?>
            </button>
        </div>
    </div>

    <?php if ($message): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>

    <?php if ($error): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><?php echo __('id'); ?></th>
                    <th><?php echo __('slug'); ?></th>
                    <th><?php echo __('title'); ?> (AR)</th>
                    <th><?php echo __('title'); ?> (EN)</th>
                    <th><?php echo __('status'); ?></th>
                    <th><?php echo __('created_at'); ?></th>
                    <th><?php echo __('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pages)): ?>
                <tr>
                    <td colspan="7" class="text-center"><?php echo __('no_pages_found'); ?></td>
                </tr>
                <?php else: ?>
                <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?php echo $page['id']; ?></td>
                    <td><?php echo escape($page['slug']); ?></td>
                    <td><?php echo escape(mb_substr($page['title_ar'], 0, 30)) . (mb_strlen($page['title_ar']) > 30 ? '...' : ''); ?></td>
                    <td><?php echo escape(mb_substr($page['title_en'], 0, 30)) . (mb_strlen($page['title_en']) > 30 ? '...' : ''); ?></td>
                    <td>
                        <span class="badge bg-<?php echo $page['status'] === 'active' ? 'success' : 'secondary'; ?>">
                            <?php echo __($page['status']); ?>
                        </span>
                    </td>
                    <td><?php echo formatDate($page['created_at']); ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPageModal<?php echo $page['id']; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deletePageModal<?php echo $page['id']; ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                
                <!-- Edit Modal -->
                <div class="modal fade" id="editPageModal<?php echo $page['id']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo __('edit_page'); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="">
                                <div class="modal-body">
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="edit_slug_<?php echo $page['id']; ?>" class="form-label"><?php echo __('slug'); ?></label>
                                        <input type="text" class="form-control" id="edit_slug_<?php echo $page['id']; ?>" name="slug" 
                                               value="<?php echo escape($page['slug']); ?>" required>
                                        <div class="form-text"><?php echo __('slug_help_text'); ?></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_title_ar_<?php echo $page['id']; ?>" class="form-label"><?php echo __('title'); ?> (AR)</label>
                                                <input type="text" class="form-control" id="edit_title_ar_<?php echo $page['id']; ?>" name="title_ar" 
                                                       value="<?php echo escape($page['title_ar']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_title_en_<?php echo $page['id']; ?>" class="form-label"><?php echo __('title'); ?> (EN)</label>
                                                <input type="text" class="form-control" id="edit_title_en_<?php echo $page['id']; ?>" name="title_en" 
                                                       value="<?php echo escape($page['title_en']); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_content_ar_<?php echo $page['id']; ?>" class="form-label"><?php echo __('content'); ?> (AR)</label>
                                                <textarea class="form-control" id="edit_content_ar_<?php echo $page['id']; ?>" name="content_ar" rows="4"><?php echo escape($page['content_ar']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_content_en_<?php echo $page['id']; ?>" class="form-label"><?php echo __('content'); ?> (EN)</label>
                                                <textarea class="form-control" id="edit_content_en_<?php echo $page['id']; ?>" name="content_en" rows="4"><?php echo escape($page['content_en']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_meta_desc_ar_<?php echo $page['id']; ?>" class="form-label"><?php echo __('meta_description'); ?> (AR)</label>
                                                <textarea class="form-control" id="edit_meta_desc_ar_<?php echo $page['id']; ?>" name="meta_desc_ar" rows="2"><?php echo escape($page['meta_desc_ar']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_meta_desc_en_<?php echo $page['id']; ?>" class="form-label"><?php echo __('meta_description'); ?> (EN)</label>
                                                <textarea class="form-control" id="edit_meta_desc_en_<?php echo $page['id']; ?>" name="meta_desc_en" rows="2"><?php echo escape($page['meta_desc_en']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="edit_status_<?php echo $page['id']; ?>" class="form-label"><?php echo __('status'); ?></label>
                                        <select class="form-select" id="edit_status_<?php echo $page['id']; ?>" name="status">
                                            <option value="active" <?php echo $page['status'] === 'active' ? 'selected' : ''; ?>><?php echo __('active'); ?></option>
                                            <option value="inactive" <?php echo $page['status'] === 'inactive' ? 'selected' : ''; ?>><?php echo __('inactive'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo __('close'); ?></button>
                                    <button type="submit" class="btn btn-primary"><?php echo __('save_changes'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Delete Modal -->
                <div class="modal fade" id="deletePageModal<?php echo $page['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo __('confirm_delete'); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo __('confirm_delete_page'); ?> "<?php echo escape($page['title_en']); ?>"?</p>
                            </div>
                            <form method="post" action="">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo __('cancel'); ?></button>
                                    <button type="submit" class="btn btn-danger"><?php echo __('delete'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade" id="addPageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo __('add_new_page'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="mb-3">
                            <label for="slug" class="form-label"><?php echo __('slug'); ?></label>
                            <input type="text" class="form-control" id="slug" name="slug" required>
                            <div class="form-text"><?php echo __('slug_help_text'); ?></div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_ar" class="form-label"><?php echo __('title'); ?> (AR)</label>
                                    <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_en" class="form-label"><?php echo __('title'); ?> (EN)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="content_ar" class="form-label"><?php echo __('content'); ?> (AR)</label>
                                    <textarea class="form-control" id="content_ar" name="content_ar" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="content_en" class="form-label"><?php echo __('content'); ?> (EN)</label>
                                    <textarea class="form-control" id="content_en" name="content_en" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="meta_desc_ar" class="form-label"><?php echo __('meta_description'); ?> (AR)</label>
                                    <textarea class="form-control" id="meta_desc_ar" name="meta_desc_ar" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="meta_desc_en" class="form-label"><?php echo __('meta_description'); ?> (EN)</label>
                                    <textarea class="form-control" id="meta_desc_en" name="meta_desc_en" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label"><?php echo __('status'); ?></label>
                            <select class="form-select" id="status" name="status">
                                <option value="active"><?php echo __('active'); ?></option>
                                <option value="inactive"><?php echo __('inactive'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo __('close'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo __('add_page'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>