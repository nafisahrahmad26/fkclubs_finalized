<?php 
include('../config/db.config.php'); 
$rankings = mysqli_query($link, "SELECT USER.name, 
SUM(ATTENDANCE.points_earned) as points FROM ATTENDANCE JOIN USER ON 
ATTENDANCE.user_id = USER.user_id GROUP BY USER.user_id ORDER BY points 
DESC"); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Faculty System Reports</title> 
    <link rel="stylesheet" href="../css/style.css"> 
</head> 
<body> 
    <div class="container"> 
        <h2>Faculty Management Overall Engagement Standing Report</h2> 
        <table> 
            <tr><th>Student Name</th><th>Accumulated Evaluation Score</th></tr> 
            <?php while($rk = mysqli_fetch_assoc($rankings)) { ?> 
                <tr> 
                    <td><?php echo $rk['name']; ?></td> 
                    <td><strong><?php echo $rk['points']; ?> Points</strong></td> 
                </tr> 
            <?php } ?> 
        </table> 
    </div> 
</body> 
</html>