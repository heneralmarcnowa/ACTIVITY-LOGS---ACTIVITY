<?php 
require_once 'core/models.php'; 
require_once 'core/dbConfig.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Application</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="delete-container">
        <h1 class="delete-warning">Are you sure you want to delete this application?</h1>
        
        <?php 
        $result = getApplicationByID($pdo, $_GET['id']);
        $application = $result['querySet'];
        ?>

        <div class="application-details">
            <h2>First Name: <?php echo $application['first_name']; ?></h2>
            <h2>Last Name: <?php echo $application['last_name']; ?></h2>
            <h2>Email: <?php echo $application['email']; ?></h2>
            <h2>Phone Number: <?php echo $application['phone_number']; ?></h2>
            <h2>Gender: <?php echo $application['gender']; ?></h2>
            <h2>Address: <?php echo $application['address']; ?></h2>
            <h2>State: <?php echo $application['state']; ?></h2>
            <h2>Nationality: <?php echo $application['nationality']; ?></h2>
            <h2>Qualification: <?php echo $application['qualification']; ?></h2>
            <h2>Experience: <?php echo $application['experience_years']; ?></h2>
            <h2>Subjects: <?php echo $application['subjects']; ?></h2>
        </div>

        <div class="delete-actions">
            <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <input type="submit" name="deleteApplicationBtn" value="Delete" class="delete-btn">
            </form>
        </div>
    </div>
</body>
</html>