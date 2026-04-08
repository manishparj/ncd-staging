<?php
session_start();

// Include database configuration (already has $dbh)
include('inc/config.php'); // <- this replaces the manual $dbh setup
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}

// Create uploads directory if not exists
$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle different actions
$action = $_POST['action'] ?? $_GET['action'] ?? 'list';

switch($action) {
    case 'create':
        handleCreate($dbh, $upload_dir);
        break;
    case 'edit':
        handleEdit($dbh);
        break;
    case 'update':
        handleUpdate($dbh, $upload_dir);
        break;
    case 'delete':
        handleDelete($dbh, $upload_dir);
        break;
    default:
        listDirectors($dbh);
}

function uploadPhoto($file, $upload_dir) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowed_types)) {
        return ['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, GIF, WEBP allowed.'];
    }
    
    if ($file['size'] > $max_size) {
        return ['success' => false, 'message' => 'File too large. Max 5MB allowed.'];
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = time() . '_' . uniqid() . '.' . $extension;
    $filepath = $upload_dir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => true, 'path' => $filepath];
    }
    
    return ['success' => false, 'message' => 'Failed to upload file.'];
}

function handleCreate($dbh, $upload_dir) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $service_from = $_POST['service_from'];
        $service_to = $_POST['service_to'] ?: NULL;
        
        if (empty($name) || empty($service_from)) {
            $_SESSION['error'] = "Name and Service From date are required";
            header("Location: " . $_SERVER['PHP_SELF'] . "?action=create");
            exit;
        }
        
        // Handle photo upload
        $photo_path = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $upload_result = uploadPhoto($_FILES['photo'], $upload_dir);
            if ($upload_result['success']) {
                $photo_path = $upload_result['path'];
            } else {
                $_SESSION['error'] = $upload_result['message'];
                header("Location: " . $_SERVER['PHP_SELF'] . "?action=create");
                exit;
            }
        }
        
        try {
            $stmt = $dbh->prepare("INSERT INTO directors (name, photo, service_from, service_to) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $photo_path, $service_from, $service_to]);
            $_SESSION['success'] = "Director added successfully";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error adding director: " . $e->getMessage();
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    
    showCreateForm();
}

function handleEdit($dbh) {
    $id = $_GET['id'] ?? 0;
    $stmt = $dbh->prepare("SELECT * FROM directors WHERE id = ?");
    $stmt->execute([$id]);
    $director = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$director) {
        $_SESSION['error'] = "Director not found";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    
    showEditForm($director);
}

function handleUpdate($dbh, $upload_dir) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['director_id'];
        $name = trim($_POST['name']);
        $service_from = $_POST['service_from'];
        $service_to = $_POST['service_to'] ?: NULL;
        
        if (empty($name) || empty($service_from)) {
            $_SESSION['error'] = "Name and Service From date are required";
            header("Location: " . $_SERVER['PHP_SELF'] . "?action=edit&id=" . $id);
            exit;
        }
        
        // Get current photo
        $stmt = $dbh->prepare("SELECT photo FROM directors WHERE id = ?");
        $stmt->execute([$id]);
        $current = $stmt->fetch(PDO::FETCH_ASSOC);
        $photo_path = $current['photo'];
        
        // Handle new photo upload
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Delete old photo if exists
            if ($photo_path && file_exists($photo_path)) {
                unlink($photo_path);
            }
            
            $upload_result = uploadPhoto($_FILES['photo'], $upload_dir);
            if ($upload_result['success']) {
                $photo_path = $upload_result['path'];
            } else {
                $_SESSION['error'] = $upload_result['message'];
                header("Location: " . $_SERVER['PHP_SELF'] . "?action=edit&id=" . $id);
                exit;
            }
        }
        
        try {
            $stmt = $dbh->prepare("UPDATE directors SET name = ?, photo = ?, service_from = ?, service_to = ? WHERE id = ?");
            $stmt->execute([$name, $photo_path, $service_from, $service_to, $id]);
            $_SESSION['success'] = "Director updated successfully";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error updating director: " . $e->getMessage();
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

function handleDelete($dbh, $upload_dir) {
    $id = $_GET['id'] ?? 0;
    
    // Get photo path to delete file
    $stmt = $dbh->prepare("SELECT photo FROM directors WHERE id = ?");
    $stmt->execute([$id]);
    $director = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($director && $director['photo'] && file_exists($director['photo'])) {
        unlink($director['photo']);
    }
    
    try {
        $stmt = $dbh->prepare("DELETE FROM directors WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "Director deleted successfully";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error deleting director: " . $e->getMessage();
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

function listDirectors($dbh) {
    // Get directors ordered by service_from (oldest first)
    $stmt = $dbh->query("SELECT * FROM directors ORDER BY service_from ASC");
    $directors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    showListPage($directors);
}

function showCreateForm() {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Director</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                padding: 20px;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                border-radius: 10px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                overflow: hidden;
            }
            .header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 30px;
                text-align: center;
            }
            .content {
                padding: 30px;
            }
            .form-group {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 8px;
                color: #555;
                font-weight: 500;
            }
            input[type="text"], 
            input[type="date"],
            input[type="file"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            }
            .current-photo {
                margin: 10px 0;
                padding: 10px;
                background: #f7f9fc;
                border-radius: 4px;
            }
            .current-photo img {
                max-width: 100px;
                border-radius: 50%;
            }
            button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                margin-right: 10px;
            }
            button:hover {
                transform: translateY(-2px);
            }
            .back-link {
                display: inline-block;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
            }
            .alert {
                padding: 12px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
            .alert-success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            .alert-error {
                background: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
            .helper-text {
                font-size: 12px;
                color: #666;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Add New Director</h1>
                <p>Fill in the director's information</p>
            </div>
            <div class="content">
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="?action=create" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Director Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" id="photo" name="photo" accept="image/*">
                        <div class="helper-text">Accepted formats: JPG, PNG, GIF, WEBP. Max size: 5MB</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="service_from">Service From (Start Date) *</label>
                        <input type="date" id="service_from" name="service_from" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="service_to">Service To (End Date)</label>
                        <input type="date" id="service_to" name="service_to">
                        <div class="helper-text">Leave empty if currently serving</div>
                    </div>
                    
                    <button type="submit">Add Director</button>
                    <a href="?action=list" class="back-link">← Back to Timeline</a>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}

function showEditForm($director) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Director</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                padding: 20px;
            }
            .container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                border-radius: 10px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                overflow: hidden;
            }
            .header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 30px;
                text-align: center;
            }
            .content {
                padding: 30px;
            }
            .form-group {
                margin-bottom: 20px;
            }
            label {
                display: block;
                margin-bottom: 8px;
                color: #555;
                font-weight: 500;
            }
            input[type="text"], 
            input[type="date"],
            input[type="file"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            }
            .current-photo {
                margin: 10px 0;
                padding: 10px;
                background: #f7f9fc;
                border-radius: 4px;
            }
            .current-photo img {
                max-width: 100px;
                border-radius: 50%;
                margin-right: 10px;
            }
            button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 24px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                margin-right: 10px;
            }
            button:hover {
                transform: translateY(-2px);
            }
            .delete-btn {
                background: #dc3545;
            }
            .back-link {
                display: inline-block;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
            }
            .alert {
                padding: 12px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
            .alert-success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            .alert-error {
                background: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
            .helper-text {
                font-size: 12px;
                color: #666;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Edit Director</h1>
                <p>Update director information</p>
            </div>
            <div class="content">
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="?action=update" enctype="multipart/form-data">
                    <input type="hidden" name="director_id" value="<?php echo $director['id']; ?>">
                    
                    <div class="form-group">
                        <label for="name">Director Name *</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($director['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <?php if($director['photo'] && file_exists($director['photo'])): ?>
                            <div class="current-photo">
                                <img src="<?php echo $director['photo']; ?>" alt="Current Photo">
                                <span>Current photo</span>
                            </div>
                        <?php endif; ?>
                        <input type="file" id="photo" name="photo" accept="image/*">
                        <div class="helper-text">Leave empty to keep current photo. Accepted formats: JPG, PNG, GIF, WEBP. Max size: 5MB</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="service_from">Service From (Start Date) *</label>
                        <input type="date" id="service_from" name="service_from" value="<?php echo $director['service_from']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="service_to">Service To (End Date)</label>
                        <input type="date" id="service_to" name="service_to" value="<?php echo $director['service_to']; ?>">
                        <div class="helper-text">Leave empty if currently serving</div>
                    </div>
                    
                    <button type="submit">Update Director</button>
                    <a href="?action=list" class="back-link">← Back to Timeline</a>
                </form>
            </div>
        </div>
    </body>
    </html>
    <?php
}

function showListPage($directors) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Directors Timeline</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                padding: 20px;
            }
            .container {
                max-width: 1400px;
                margin: 0 auto;
                background: white;
                border-radius: 10px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                overflow: hidden;
            }
            .header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 30px;
                text-align: center;
            }
            .header h1 {
                font-size: 2.5em;
                margin-bottom: 10px;
            }
            .content {
                padding: 30px;
            }
            .add-btn {
                display: inline-block;
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: white;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 5px;
                margin-bottom: 30px;
                font-weight: bold;
                transition: transform 0.2s;
            }
            .add-btn:hover {
                transform: translateY(-2px);
            }
            .alert {
                padding: 12px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
            .alert-success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            .alert-error {
                background: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
            .timeline {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            .timeline-item {
                display: flex;
                background: white;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                overflow: hidden;
                transition: transform 0.3s, box-shadow 0.3s;
                position: relative;
            }
            .timeline-item:hover {
                transform: translateX(5px);
                box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            }
            .timeline-year {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                min-width: 120px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 20px;
                text-align: center;
            }
            .year-start, .year-end {
                font-size: 1.2em;
                font-weight: bold;
            }
            .year-separator {
                margin: 5px 0;
            }
            .timeline-photo {
                width: 150px;
                height: 150px;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f7f9fc;
                padding: 15px;
            }
            .timeline-photo img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 3px solid #667eea;
            }
            .timeline-photo .no-photo {
                width: 100%;
                height: 100%;
                background: #e0e0e0;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 48px;
                color: #999;
            }
            .timeline-info {
                flex: 1;
                padding: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .director-name {
                font-size: 1.4em;
                font-weight: bold;
                color: #333;
                margin-bottom: 5px;
            }
            .service-period {
                color: #666;
                font-size: 0.9em;
            }
            .service-period i {
                font-style: normal;
                background: #f0f0f0;
                padding: 3px 8px;
                border-radius: 15px;
            }
            .current-badge {
                display: inline-block;
                background: #28a745;
                color: white;
                padding: 3px 10px;
                border-radius: 15px;
                font-size: 0.75em;
                margin-left: 10px;
            }
            .actions {
                display: flex;
                gap: 10px;
                margin-left: 20px;
            }
            .btn-edit, .btn-delete {
                padding: 8px 16px;
                text-decoration: none;
                border-radius: 4px;
                font-size: 0.85em;
                transition: opacity 0.2s;
            }
            .btn-edit {
                background: #ffc107;
                color: #333;
            }
            .btn-delete {
                background: #dc3545;
                color: white;
            }
            .btn-edit:hover, .btn-delete:hover {
                opacity: 0.8;
            }
            .empty-state {
                text-align: center;
                padding: 60px;
                color: #666;
            }
            .empty-state p {
                margin-bottom: 20px;
                font-size: 1.2em;
            }
            @media (max-width: 768px) {
                .timeline-item {
                    flex-direction: column;
                }
                .timeline-year {
                    flex-direction: row;
                    justify-content: space-around;
                    padding: 10px;
                }
                .timeline-photo {
                    width: 100%;
                    height: auto;
                    padding: 20px;
                }
                .timeline-info {
                    flex-direction: column;
                    text-align: center;
                }
                .actions {
                    margin-top: 15px;
                    margin-left: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>📅 Directors Timeline</h1>
                <p>Chronological order of directors (Oldest to Newest)</p>
            </div>
            <div class="content">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                
                <a href="?action=create" class="add-btn">+ Add New Director</a>
                
                <?php if(empty($directors)): ?>
                    <div class="empty-state">
                        <p>No directors found.</p>
                        <a href="?action=create" class="add-btn">Add First Director</a>
                    </div>
                <?php else: ?>
                    <div class="timeline">
                        <?php foreach($directors as $index => $director): ?>
                            <div class="timeline-item">
                                <div class="timeline-year">
                                    <div class="year-start"><?php echo date('d-m-Y', strtotime($director['service_from'])); ?></div>
                                    <div class="year-separator">→</div>
                                    <div class="year-end">
                                        <?php 
                                        if($director['service_to']) {
                                            echo date('d-m-Y', strtotime($director['service_to']));
                                        } else {
                                            echo '<span style="color: #ffd700;">Present</span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="timeline-photo">
                                    <?php if($director['photo'] && file_exists($director['photo'])): ?>
                                        <img src="<?php echo $director['photo']; ?>" alt="<?php echo htmlspecialchars($director['name']); ?>">
                                    <?php else: ?>
                                        <div class="no-photo">👤</div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="timeline-info">
                                    <div>
                                        <div class="director-name">
                                            <?php echo htmlspecialchars($director['name']); ?>
                                            <?php if(!$director['service_to']): ?>
                                                <span class="current-badge">Current Director</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="service-period">
                                            <i>📅 Service Period: <?php echo date('d-m-Y', strtotime($director['service_from'])); ?> - <?php echo $director['service_to'] ? date('d-m-Y', strtotime($director['service_to'])) : 'Present'; ?></i>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <a href="?action=edit&id=<?php echo $director['id']; ?>" class="btn-edit">✏️ Edit</a>
                                        <a href="?action=delete&id=<?php echo $director['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this director?')">🗑️ Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>