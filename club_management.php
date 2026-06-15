<?php
require_once 'config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$club_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = intval($_SESSION['user_id']);

// Proses Join Club
if (isset($_GET['join']) && $_SESSION['user_type'] === 'Student') {
    $checkStmt = mysqli_prepare($conn, "SELECT COUNT(*) as count FROM membership WHERE club_id = ? AND user_id = ?");
    mysqli_stmt_bind_param($checkStmt, "ii", $club_id, $user_id);
    mysqli_stmt_execute($checkStmt);
    $resCheck = mysqli_stmt_get_result($checkStmt);
    $rowCheck = mysqli_fetch_assoc($resCheck);
    mysqli_stmt_close($checkStmt);

    if ($rowCheck['count'] == 0) {
        $insStmt = mysqli_prepare($conn, "INSERT INTO membership (club_id, user_id, club_role, start_date) VALUES (?, ?, 'General Member', NOW())");
        mysqli_stmt_bind_param($insStmt, "ii", $club_id, $user_id);
        mysqli_stmt_execute($insStmt);
        mysqli_stmt_close($insStmt);
    }
    header("Location: club_management.php?id=".$club_id);
    exit;
}

// Ambil info kelab (Join table dengan User Staff)
$stmt = mysqli_prepare($conn, "SELECT c.*, u.name as advisor_name FROM club c JOIN user u ON c.advisor_id = u.user_id WHERE c.club_id = ?");
mysqli_stmt_bind_param($stmt, "i", $club_id);
mysqli_stmt_execute($stmt);
$club = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if(!$club) { die("Club Not Found."); }

// Ambil ahli & jawatankuasa kelab
$memStmt = mysqli_prepare($conn, "SELECT m.club_role, u.name, u.email FROM membership m JOIN user u ON m.user_id = u.user_id WHERE m.club_id = ?");
mysqli_stmt_bind_param($memStmt, "i", $club_id);
mysqli_stmt_execute($memStmt);
$membersResult = mysqli_stmt_get_result($memStmt);

include 'header.php';
include 'sidebar.php';
?>

<h2>Club Details Management</h2>
<div class="profile-details-box" style="background:#f8f9fa; padding:20px; border-radius:6px; margin-bottom:20px; border:1px solid #dee2e6;">
    <h3>Club Name: <?php echo htmlspecialchars($club['club_name']); ?></h3>
    <p><strong>Category:</strong> <?php echo htmlspecialchars($club['club_category']); ?></p>
    <p><strong>Advisor:</strong> <?php echo htmlspecialchars($club['advisor_name']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($club['club_description']); ?></p>
    
    <?php if($_SESSION['user_type'] === 'Student'): ?>
        <a href="club_management.php?id=<?php echo $club['club_id']; ?>&join=1" class="btn-action">Join This Club</a>
    <?php endif; ?>
</div>

<h3>Club Members & Committees</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php while($m = mysqli_fetch_assoc($membersResult)): ?>
        <tr>
            <td><?php echo htmlspecialchars($m['name']); ?></td>
            <td><span class="badge-role"><?php echo htmlspecialchars($m['club_role']); ?></span></td>
            <td><?php echo htmlspecialchars($m['email']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php 
mysqli_stmt_close($memStmt);
include 'footer.php'; 
?>