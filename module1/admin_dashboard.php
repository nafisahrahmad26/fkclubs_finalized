<?php 
include('../includes/header.php'); 
?>

<div class="metrics-row">
    <div class="metric-card">
        <label>Total Users</label>
        <div class="value">3</div>
    </div>
    <div class="metric-card">
        <label>Total Students</label>
        <div class="value">1</div>
    </div>
    <div class="metric-card">
        <label>Total Committees</label>
        <div class="value">1</div>
    </div>
    <div class="metric-card">
        <label>Total Clubs</label>
        <div class="value">0</div>
    </div>
</div>

<div class="content-card">
    <h3>Recent Users Log</h3>
    <div class="data-table-container">
        <table class="system-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Siti Student</td>
                    <td>siti@fkclubs.umpsa.edu.my</td>
                    <td>Student</td>
                    <td><span style="color:#2ecc71; font-weight:bold;">Active</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ahmad Club President</td>
                    <td>ahmad@fkclubs.umpsa.edu.my</td>
                    <td>Staff</td>
                    <td><span style="color:#2ecc71; font-weight:bold;">Active</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>System Admin</td>
                    <td>admin@fkclubs.umpsa.edu.my</td>
                    <td>Admin</td>
                    <td><span style="color:#2ecc71; font-weight:bold;">Active</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="content-card">
    <h3>System Announcements / Notifications</h3>
    <p style="font-size:14px; color:#555;">System is up and running. Layout integration complete.</p>
</div>

<?php 
include('../includes/footer.php'); 
?>