<?php
include_once("connections/connection.php");

$con = connection();

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    echo "Form data received: $fname, $lname, $gender<br>";

    $sql = "INSERT INTO `student_list`(`first_name`, `last_name`, `gender`) VALUES ('$fname', '$lname', '$gender')";
    $con->query($sql) or die ($con->error);

    echo header("Location: index.php");
   
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="css/styleadd.css">
</head>
<body>
    
    <form action="" method="post">
        <label>First Name</label>
        <input type="text" name="firstname" id="firstname" required>

        <label>Last Name</label>
        <input type="text" name="lastname" id="lastname" required>

        <label>Gender</label>
        <select name="gender" id="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <input type="submit" name="submit" value="Submit Form">
    </form>

</body>
</html>