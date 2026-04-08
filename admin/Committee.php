

<?php
session_start();

// Include database configuration (already has $dbh)
include('inc/config.php'); // <- this replaces the manual $dbh setup
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}

// Handle different actions
$action = $_POST['action'] ?? $_GET['action'] ?? 'list';

switch($action) {
    case 'create':
        handleCreate($dbh);
        break;
    case 'edit':
        handleEdit($dbh);
        break;
    case 'update':
        handleUpdate($dbh);
        break;
    case 'delete':
        handleDelete($dbh);
        break;
    case 'add_member':
        handleAddMember($dbh);
        break;
    case 'remove_member':
        handleRemoveMember($dbh);
        break;
    default:
        listCommittees($dbh);
}

function handleCreate($dbh) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $committee_name = trim($_POST['committee_name']);
        
        if (empty($committee_name)) {
            $_SESSION['error'] = "Committee name is required";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        
        try {
            $stmt = $dbh->prepare("INSERT INTO committees (committee_name) VALUES (?)");
            $stmt->execute([$committee_name]);
            $_SESSION['success'] = "Committee created successfully";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error creating committee: " . $e->getMessage();
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

function handleEdit($dbh) {
    $id = $_GET['id'] ?? 0;
    $stmt = $dbh->prepare("SELECT * FROM committees WHERE id = ?");
    $stmt->execute([$id]);
    $committee = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$committee) {
        $_SESSION['error'] = "Committee not found";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    
    // Get committee members
    $memberStmt = $dbh->prepare("SELECT * FROM committee_members WHERE committee_id = ? ORDER BY id");
    $memberStmt->execute([$id]);
    $members = $memberStmt->fetchAll(PDO::FETCH_ASSOC);
    
    showEditForm($committee, $members);
}

function handleUpdate($dbh) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['committee_id'];
        $committee_name = trim($_POST['committee_name']);
        
        if (empty($committee_name)) {
            $_SESSION['error'] = "Committee name is required";
            header("Location: " . $_SERVER['PHP_SELF'] . "?action=edit&id=" . $id);
            exit;
        }
        
        try {
            $stmt = $dbh->prepare("UPDATE committees SET committee_name = ? WHERE id = ?");
            $stmt->execute([$committee_name, $id]);
            $_SESSION['success'] = "Committee updated successfully";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error updating committee: " . $e->getMessage();
        }
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

function handleDelete($dbh) {
    $id = $_GET['id'] ?? 0;
    
    try {
        // Members will be deleted automatically due to CASCADE constraint
        $stmt = $dbh->prepare("DELETE FROM committees WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['success'] = "Committee deleted successfully";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error deleting committee: " . $e->getMessage();
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

function handleAddMember($dbh) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $committee_id = $_POST['committee_id'];
        $employee_name_designation = trim($_POST['employee_name_designation']);
        $role = trim($_POST['role']);
        
        if (empty($employee_name_designation) || empty($role)) {
            $_SESSION['error'] = "Employee Name & Designation and Role are required";
            header("Location: " . $_SERVER['PHP_SELF'] . "?action=edit&id=" . $committee_id);
            exit;
        }
        
        try {
            $stmt = $dbh->prepare("INSERT INTO committee_members (committee_id, employee_name_designation, role) VALUES (?, ?, ?)");
            $stmt->execute([$committee_id, $employee_name_designation, $role]);
            $_SESSION['success'] = "Member added successfully";
        } catch(PDOException $e) {
            $_SESSION['error'] = "Error adding member: " . $e->getMessage();
        }
        
        header("Location: " . $_SERVER['PHP_SELF'] . "?action=edit&id=" . $committee_id);
        exit;
    }
}

function handleRemoveMember($dbh) {
    $member_id = $_GET['member_id'] ?? 0;
    $committee_id = $_GET['committee_id'] ?? 0;
    
    try {
        $stmt = $dbh->prepare("DELETE FROM committee_members WHERE id = ?");
        $stmt->execute([$member_id]);
        $_SESSION['success'] = "Member removed successfully";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error removing member: " . $e->getMessage();
    }
    
    header("Location: " . $_SERVER['PHP_SELF'] . "?action=edit&id=" . $committee_id);
    exit;
}

function listCommittees($dbh) {
    $stmt = $dbh->query("SELECT * FROM committees ORDER BY id DESC");
    $committees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get member count for each committee
    foreach ($committees as &$committee) {
        $countStmt = $dbh->prepare("SELECT COUNT(*) as member_count FROM committee_members WHERE committee_id = ?");
        $countStmt->execute([$committee['id']]);
        $committee['member_count'] = $countStmt->fetch(PDO::FETCH_ASSOC)['member_count'];
    }
    
    showListPage($committees);
}

function showListPage($committees) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Committee Management System</title>
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
                max-width: 1200px;
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
                font-size: 2em;
                margin-bottom: 10px;
            }
            .content {
                padding: 30px;
            }
            .form-section {
                background: #f7f9fc;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 30px;
            }
            .form-section h2 {
                color: #333;
                margin-bottom: 20px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
                font-weight: 500;
            }
            input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            }
            button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: transform 0.2s;
            }
            button:hover {
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
            .committee-table {
                width: 100%;
                border-collapse: collapse;
            }
            .committee-table th,
            .committee-table td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            .committee-table th {
                background: #f7f9fc;
                font-weight: 600;
                color: #555;
            }
            .committee-table tr:hover {
                background: #f7f9fc;
            }
            .actions a {
                margin-right: 10px;
                text-decoration: none;
                padding: 5px 10px;
                border-radius: 3px;
                font-size: 12px;
            }
            .btn-edit {
                background: #ffc107;
                color: #333;
            }
            .btn-delete {
                background: #dc3545;
                color: white;
            }
            .btn-view {
                background: #17a2b8;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Committee Management System</h1>
                <p>Manage committees and their members</p>
            </div>
            <div class="content">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <div class="form-section">
                    <h2>Create New Committee</h2>
                    <form method="POST" action="?action=create">
                        <div class="form-group">
                            <label for="committee_name">Committee Name:</label>
                            <input type="text" id="committee_name" name="committee_name" placeholder="Enter committee name" required>
                        </div>
                        <button type="submit">Create Committee</button>
                    </form>
                </div>

                <h2>Existing Committees</h2>
                <table class="committee-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Committee Name</th>
                            <th>Members Count</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($committees as $committee): ?>
                        <tr>
                            <td><?php echo $committee['id']; ?></td>
                            <td><?php echo htmlspecialchars($committee['committee_name']); ?></td>
                            <td><?php echo $committee['member_count']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($committee['created_at'])); ?></td>
                            <td class="actions">
                                <a href="?action=edit&id=<?php echo $committee['id']; ?>" class="btn-view">View/Edit</a>
                                <a href="?action=delete&id=<?php echo $committee['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure? This will delete all committee members too.')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>
    <?php
}

function showEditForm($committee, $members) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Committee - <?php echo htmlspecialchars($committee['committee_name']); ?></title>
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
                max-width: 900px;
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
                font-size: 2em;
                margin-bottom: 10px;
            }
            .content {
                padding: 30px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
                font-weight: 500;
            }
            input[type="text"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            }
            input[type="text"]:focus {
                outline: none;
                border-color: #667eea;
            }
            button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                transition: transform 0.2s;
            }
            button:hover {
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
            .member-list {
                margin-top: 30px;
            }
            .member-list h3 {
                color: #333;
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 2px solid #667eea;
            }
            .member-item {
                background: #f7f9fc;
                padding: 15px;
                margin-bottom: 10px;
                border-radius: 8px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                transition: all 0.3s;
            }
            .member-item:hover {
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            .member-info {
                flex: 1;
            }
            .member-name-designation {
                font-weight: 600;
                color: #333;
                font-size: 16px;
                margin-bottom: 5px;
            }
            .member-role {
                color: #764ba2;
                font-size: 14px;
                display: inline-block;
                background: #e8e0f5;
                padding: 3px 10px;
                border-radius: 15px;
            }
            .remove-btn {
                background: #dc3545;
                color: white;
                padding: 6px 15px;
                text-decoration: none;
                border-radius: 4px;
                font-size: 12px;
                transition: background 0.2s;
            }
            .remove-btn:hover {
                background: #c82333;
            }
            .add-member-form {
                margin-top: 30px;
                padding: 20px;
                background: #f7f9fc;
                border-radius: 8px;
            }
            .add-member-form h3 {
                margin-bottom: 15px;
                color: #333;
            }
            .back-link {
                display: inline-block;
                margin-top: 20px;
                color: #667eea;
                text-decoration: none;
                margin-left: 10px;
            }
            .back-link:hover {
                text-decoration: underline;
            }
            .btn-update {
                margin-right: 10px;
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
                <h1>Edit Committee</h1>
                <p><?php echo htmlspecialchars($committee['committee_name']); ?></p>
            </div>
            <div class="content">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <form method="POST" action="?action=update">
                    <input type="hidden" name="committee_id" value="<?php echo $committee['id']; ?>">
                    <div class="form-group">
                        <label for="committee_name">Committee Name:</label>
                        <input type="text" id="committee_name" name="committee_name" value="<?php echo htmlspecialchars($committee['committee_name']); ?>" required>
                    </div>
                    <button type="submit" class="btn-update">Update Committee Name</button>
                    <a href="?action=list" class="back-link">← Back to Committees</a>
                </form>

                <div class="member-list">
                    <h3>Committee Members (<?php echo count($members); ?>)</h3>
                    <?php if(empty($members)): ?>
                        <p style="color: #666; padding: 20px; text-align: center; background: #f7f9fc; border-radius: 8px;">No members added yet. Add members using the form below.</p>
                    <?php else: ?>
                        <?php foreach($members as $member): ?>
                            <div class="member-item">
                                <div class="member-info">
                                    <div class="member-name-designation">
                                        👤 <?php echo htmlspecialchars($member['employee_name_designation']); ?>
                                    </div>
                                    <div class="member-role">
                                        📌 Role: <?php echo htmlspecialchars($member['role']); ?>
                                    </div>
                                </div>
                                <a href="?action=remove_member&member_id=<?php echo $member['id']; ?>&committee_id=<?php echo $committee['id']; ?>" class="remove-btn" onclick="return confirm('Remove this member from the committee?')">Remove</a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="add-member-form">
                    <h3>➕ Add New Member</h3>
                    <form method="POST" action="?action=add_member">
                        <input type="hidden" name="committee_id" value="<?php echo $committee['id']; ?>">
                        <div class="form-group">
                            <label for="employee_name_designation">Employee Name & Designation:</label>
                            <input type="text" id="employee_name_designation" name="employee_name_designation" 
                                   placeholder="Example: John Smith - Senior Manager" required>
                            <div class="helper-text">Enter employee name followed by their designation (e.g., "Jane Doe - Team Lead")</div>
                        </div>
                        <div class="form-group">
                            <label for="role">Role in Committee:</label>
                            <input type="text" id="role" name="role" placeholder="Example: Chairperson, Secretary, Member, Coordinator" required>
                            <div class="helper-text">Specify the member's role in this committee</div>
                        </div>
                        <button type="submit">Add Member to Committee</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
}
?>