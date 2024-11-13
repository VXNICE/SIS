<?php

include_once("connections/connection.php");
$con = connection();
$id = $_GET['ID']; 


$sql = "SELECT * FROM student_list WHERE ID = '$id'";
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();

if (isset($_POST['submit'])) {

    
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    
    echo "Form data received: $fname, $lname, $gender<br>";

    $sql = "UPDATE student_list SET first_name = '$fname', last_name = '$lname', gender = '$gender' WHERE ID = '$id'";


    $con->query($sql) or die ($con->error);


    header("Location: details.php?ID=" . $id);
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="css/styleedit.css">
</head>
<body>
    
    <form action="" method="post">
        <label>First Name</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($row['first_name']); ?>">

        <label>Last Name</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($row['last_name']); ?>">

        <label>Gender</label>
        <select name="gender" id="gender" required>
            <option value="Male" <?php echo ($row['gender'] == "Male") ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($row['gender'] == "Female") ? 'selected' : ''; ?>>Female</option>
        </select>

        <input type="submit" name="submit" value="UPDATE">
    </form>

</body>
</html>
