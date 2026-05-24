<?php
require_once '../config/db.config.php';
if(!isset($_SESSION['user_id'])) { header("Location: ../module1/login.php"); exit; }

$club_id = $_GET['id'] ?? 0;

// Handle Joining a Club (Student action privilege boundary)
if (isset($_GET['join']) && $_SESSION['user_type'] === 'Student') {
    $check = $conn->prepare("SELECT COUNT(*) FROM membership WHERE club_id = ? AND user_id = ?");
    $check->execute([$club_id, $_SESSION['user_id']]);
    if ($check->fetchColumn() == 0) {
        $ins = $conn->prepare("INSERT INTO membership (club_id, user_id, club_role, start_date) VALUES (?, ?, 'General Member', NOW())");
        $ins->execute([$club_id, $_SESSION['user_id']]);
    }
    header("Location: club_management.php?id=".$club_id);
    exit;
}

// Fetch Club profile details with its designated advisor info
$stmt = $conn->prepare("SELECT c.*, u.name as advisor_name FROM club c JOIN user u ON c.advisor_id = u.user_id WHERE c.club_id = ?");
$stmt->execute([$club_id]);
$club = $stmt->fetch();

if(!$club) { die("Club Record Not Found."); }

// Dynamic calculation of registered club committee members mapping
$memStmt = $conn->prepare("SELECT m.club_role, u.name, u.email FROM membership m JOIN user u ON m.user_id = u.user_id WHERE m.club_id = ?");
$memStmt->execute([$club_id]);
$members = $memStmt->fetchAll();

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<h2>Figure 2.2 Club Details Page</h2>
<div class="profile-details-box">
    <h3>Club Name: <?= htmlspecialchars($club['club_name']); ?></h3>
    <p><strong>Category:</strong> <?= htmlspecialchars($club['club_category']); ?></p>
    <p><strong>Advisor:</strong> <?= htmlspecialchars($club['advisor_name']); ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($club['club_description']); ?></p>
    
    <?php if($_SESSION['user_type'] === 'Student'): ?>
        <a href="club_management.php?id=<?= $club['club_id']; ?>&join=1" class="btn-action">Join This Club</a>
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
        <?php foreach($members as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['name']); ?></td>
            <td><span class="badge-role"><?= htmlspecialchars($m['club_role']); ?></span></td>
            <td><?= htmlspecialchars($m['email']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>