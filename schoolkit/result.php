<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['UserLogin'])) {
    echo "Welcome " . $_SESSION['UserLogin'];
} else {
    echo "Welcome Guest";
}
include_once("connections/connection.php");

$con = connection();
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM student_list WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' ORDER BY id DESC";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="css/styleresult.css">
</head>
<body>
    <h1>Student Information System</h1>
    <br/>
    <br/>

    <form action="result.php" method="get">
        <input type="text" name="search" id="search">
        <button type="submit">Search</button>
    </form>

    <?php if (isset($_SESSION['UserLogin'])) { ?>
        <a href="logout.php">Logout</a>
    <?php } else { ?>
        <a href="login.php">Login</a>
    <?php } ?>
    <a href="add.php">Add New</a>
    
    <table>
        <thead>
            <tr>
                <th></th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($row) { do { ?>
            <tr>
                <td><a href="details.php?ID=<?php echo $row['ID']; ?>">View</a></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
            </tr>
            <?php } while ($row = $students->fetch_assoc()); } else { ?>
                <tr><td colspan="3">No records found.</td></tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
