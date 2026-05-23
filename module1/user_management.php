<?php 
include('../includes/header.php'); 
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2 style="font-weight: 700; color: #2c3e50;">User Management</h2>
    <button class="btn btn-primary">+ Add New User</button>
</div>

<div class="content-card" style="display: flex; gap: 15px; padding: 15px; align-items: center;">
    <input type="text" class="input-control" placeholder="Search User by Name..." style="flex-grow:1;">
    <select class="input-control" style="width: 200px;">
        <option value="">All Roles</option>
        <option value="Admin">Admin</option>
        <option value="Staff">Committee</option>
        <option value="Student">Student</option>
    </select>
    <button class="btn btn-primary">Search</button>
</div>

<div class="content-card">
    <div class="data-table-container">
        <table class="system-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Siti Student</td>
                    <td>siti@fkclubs.umpsa.edu.my</td>
                    <td>Student</td>
                    <td><span class="role-tag" style="background-color:#2ecc71;">Active</span></td>
                    <td>
                        <button class="btn btn-primary" style="padding:5px 10px; font-size:12px;">Edit</button>
                        <button class="btn btn-danger" style="padding:5px 10px; font-size:12px;">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php 
include('../includes/footer.php'); 
?>