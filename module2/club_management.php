<?php 
include('../includes/header.php'); 
?>

<div class="content-card">
    <h3>Establish New Student Club Entity</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label>Club Name</label>
            <input type="text" class="input-control" placeholder="e.g. Faculty Computer Club">
        </div>
        <div class="form-group">
            <label>Club Category Division</label>
            <input type="text" class="input-control" placeholder="e.g. Academic & Technology">
        </div>
        <button type="submit" class="btn btn-success">Authorize & Form Club</button>
    </form>
</div>

<div class="content-card">
    <h3>Current Faculty Active Club List</h3>
    <div class="data-table-container">
        <table class="system-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Club Structured Name</th>
                    <th>Category</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" style="text-align: center; color: #7f8c8d; padding: 15px;">No clubs initialized. Create one using the form above.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php 
include('../includes/footer.php'); 
?>