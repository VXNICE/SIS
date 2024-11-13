<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator") {
   
} else {
    header("Location: index.php");
    exit(); 
}

include_once("connections/connection.php");

$con = connection();

$id = $_GET['ID'];

if (isset($id) && is_numeric($id)) {

    $stmt = $con->prepare("SELECT * FROM student_list WHERE ID = ?");
    $stmt->bind_param("i", $id);  
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        
        $row = null;
        echo "Student not found.";
    }
} else {
    
    $row = null;
    echo "Invalid student ID.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="css/styledetails.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['UserLogin']; ?></h1>
    </header>

    <div class="container">
        <a href="index.php" class="back-link">← Back</a>
        
        <?php if ($row): ?>
            <h2><?php echo htmlspecialchars($row['first_name']); ?> <?php echo htmlspecialchars($row['last_name']); ?></h2>
            <p>is a <?php echo $row['gender']; ?></p>

            <div class="button-container">
                <a href="edit.php?ID=<?php echo htmlspecialchars($row['ID']); ?>">Edit</a>
                <form action="delete.php" method="post" style="display:inline;">
                    <button type="submit" name="delete" class="delete">Delete</button>
                    <input type="hidden" name="ID" value="<?php echo htmlspecialchars($row['ID']); ?>">
                </form>
            </div>
        <?php else: ?>
            <p>No student found with the provided ID.</p>
        <?php endif; ?>
    </div>
</body>


</html>
