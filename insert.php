<?php 
require_once 'core/handleForms.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Application</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <h1>Insert New Application!</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="first_name">
        </p>
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="last_name">
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email">
        </p>
        <p>
            <label for="phone_number">Phone Number</label> 
            <input type="text" name="phone_number">
        </p>
        <p>
            <label for="gender">Gender</label> 
            <input type="text" name="gender">
        </p>
        <p>
            <label for="address">Address</label> 
            <input type="text" name="address">
        </p>
        <p>
            <label for="state">State</label> 
            <input type="text" name="state">
        </p>
        <p>
            <label for="nationality">Nationality</label> 
            <input type="text" name="nationality">
        </p>
        <p>
            <label for="qualification">Qualification</label> 
            <input type="text" name="qualification">
        </p>
        <p>
            <label for="experience_years">Experience (Years)</label> 
            <input type="number" name="experience_years">
        </p>
        <p>
            <label for="subjects">Subjects</label> 
            <input type="text" name="subjects">
        </p>
        <p>
            <input type="submit" name="insertApplicationBtn" value="Insert">
        </p>
    </form>
</body>
</html>