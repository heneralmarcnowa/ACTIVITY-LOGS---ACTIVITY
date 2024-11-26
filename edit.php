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
    <title>Edit Application</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <?php 
    $result = getApplicationByID($pdo, $_GET['id']); 
    $application = $result['querySet'];
    ?>
    <h1>Edit the Application!</h1>
    <form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="first_name" value="<?php echo $application['first_name']; ?>">
        </p>
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="last_name" value="<?php echo $application['last_name']; ?>">
        </p>
        <p>
            <label for="email">Email</label> 
            <input type="email" name="email" value="<?php echo $application['email']; ?>">
        </p>
        <p>
            <label for="phone_number">Phone Number</label> 
            <input type="text" name="phone_number" value="<?php echo $application['phone_number']; ?>">
        </p>
        <p>
            <label for="gender">Gender</label> 
            <input type="text" name="gender" value="<?php echo $application['gender']; ?>">
        </p>
        <p>
            <label for="address">Address</label> 
            <input type="text" name="address" value="<?php echo $application['address']; ?>">
        </p>
        <p>
            <label for="state">State</label> 
            <input type="text" name="state" value="<?php echo $application['state']; ?>">
        </p>
        <p>
            <label for="nationality">Nationality</label> 
            <input type="text" name="nationality" value="<?php echo $application['nationality']; ?>">
        </p>
        <p>
            <label for="qualification">Qualification</label> 
            <input type="text" name="qualification" value="<?php echo $application['qualification']; ?>">
        </p>
        <p>
            <label for="experience_years">Experience (Years)</label> 
            <input type="number" name="experience_years" value="<?php echo $application['experience_years']; ?>">
        </p>
        <p>
            <label for="subjects">Subjects</label> 
            <input type="text" name="subjects" value="<?php echo $application['subjects']; ?>">
        </p>
        <p>
            <label for="lastUpdatedBy">Last Updated By</label> 
            <input type="text" name="last_updated_by" value="<?php echo $_SESSION['username']; ?>" readonly>
        </p>
        <p>
            <input type="submit" value="Save" name="editApplicationBtn">
        </p>
    </form>
</body>
</html>