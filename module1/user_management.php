<?php
require_once('../includes/header.php');
if ($_SESSION['user_type'] !== 'Admin') { echo "Access Denied."; exit; }

// Handle User Creation Form Action
if (isset($_POST['create_user'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $user_type = $_POST['user_type'];

    mysqli_query($link, "INSERT INTO user (name, email, username, password, user_type, status) VALUES ('$name', '$email', '$username', '$password', '$user_type', 'Active')");
}

// Handle Account Deletion Activity
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    mysqli_query($link, "DELETE FROM user WHERE user_id=$del_id");
}
?>

<h2>👥 Comprehensive Account & User Database Management</h2>

<div class="ui-card">
    <h3>Create New System User Account</h3>
    <form action="user_management.php" method="POST" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top:15px;">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>User Assignment Role</label>
            <select name="user_type" class="form-control">
                <option value="Student">Student</option>
                <option value="Staff">Club Committee / Staff</option>
                <option value="Admin">System Administrator</option>
            </select>
        </div>
        <div class="form-group" style="grid-column: span 2; text-align: right;">
            <button type="submit" name="create_user" class="btn btn-success">Save Account Registration</button>
        </div>
    </form>
</div>

<div class="ui-card">
    <h3>Registered Users Listing</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role Type</th>
                <th>Status</th>
                <th>Management Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users_list = mysqli_query($link, "SELECT * FROM user");
            while($u = mysqli_fetch_assoc($users_list)) {
                echo "<tr>
                        <td>{$u['user_id']}</td>
                        <td>{$u['name']}</td>
                        <td>{$u['email']}</td>
                        <td>{$u['username']}</td>
                        <td><strong>{$u['user_type']}</strong></td>
                        <td>{$u['status']}</td>
                        <td>
                            <a href='user_management.php?delete={$u['user_id']}' class='btn btn-danger' style='padding:4px 8px; font-size:12px; text-decoration:none;' onclick='return confirm(\"Delete user permanently?\");'>Remove Account</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../includes/footer.php'); ?>