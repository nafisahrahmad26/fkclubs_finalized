<?php
require_once __DIR__ . '/../config.db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

// Dynamic Join Table: Merges club info with staff user details
$query = "SELECT c.*, u.name as advisor_name, u.email as advisor_email 
          FROM club c 
          JOIN user u ON c.advisor_id = u.user_id 
          WHERE c.status = 'Active'";
$clubs_res = mysqli_query($link, $query);
?>
<?php require_once __DIR__ . '/header.php'; require_once __DIR__ . '/sidebar.php'; ?>

<h2>Faculty of Computing Available Club Directory</h2>
<p style="color:#64748b; margin-bottom:20px;">Browse student groups, co-curricular structures, and managing advisors.</p>

<table class="data-table">
    <thead>
        <tr>
            <th>Organization Profile</th>
            <th>Operational Division</th>
            <th>Core Curricular Context</th>
            <th>Lead Advisor Meta Parameters</th>
        </tr>
    </thead>
    <tbody>
        <?php while($club = mysqli_fetch_assoc($clubs_res)): ?>
        <tr>
            <td><strong style="color:#2563eb; font-size:15px;"><?php echo htmlspecialchars($club['club_name']); ?></strong></td>
            <td><span style="background:#e2e8f0; padding:3px 8px; border-radius:12px; font-size:11px; font-weight:600;"><?php echo htmlspecialchars($club['club_category']); ?></span></td>
            <td><p style="font-size:13px; color:#475569; max-width:400px;"><?php echo htmlspecialchars($club['club_description']); ?></p></td>
            <td><strong><?php echo htmlspecialchars($club['advisor_name']); ?></strong><br><span style="font-size:11px; color:#64748b;"><?php echo htmlspecialchars($club['advisor_email']); ?></span></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/footer.php'; ?>