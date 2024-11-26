<?php  
require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertApplicationBtn'])) {
    $result = insertNewApplication($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone_number'], $_POST['gender'], $_POST['address'], $_POST['state'], $_POST['nationality'], $_POST['qualification'], $_POST['experience_years'], $_POST['subjects'], $_SESSION['username']);
    
    if ($result['statusCode'] == 200) {
        $application = getApplicationByID($pdo, $pdo->lastInsertId());
        insertAnActivityLog($pdo, 'INSERT', $application['querySet']['id'], $application['querySet']['first_name'], $application['querySet']['last_name'], $application['querySet']['email'], $_SESSION['username']);
    }

    $_SESSION['message'] = $result['message'];
    header("Location: ../index.php");
}

if (isset($_POST['editApplicationBtn'])) {
    $result = editApplication($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone_number'], $_POST['gender'], $_POST['address'], $_POST['state'], $_POST['nationality'], $_POST['qualification'], $_POST['experience_years'], $_POST['subjects'], $_SESSION['username'], $_GET['id']);
    
    if ($result['statusCode'] == 200) {
        $application = getApplicationByID($pdo, $_GET['id']);
        insertAnActivityLog($pdo, 'UPDATE', $application['querySet']['id'], $application['querySet']['first_name'], $application['querySet']['last_name'], $application['querySet']['email'], $_SESSION['username']);
    }

    $_SESSION['message'] = $result['message'];
    header("Location: ../index.php");
}

if (isset($_POST['deleteApplicationBtn'])) {
    $application = getApplicationByID($pdo, $_GET['id']);
    $result = deleteApplication($pdo, $_GET['id']);
    
    if ($result['statusCode'] == 200) {
        insertAnActivityLog($pdo, 'DELETE', $application['querySet']['id'], $application['querySet']['first_name'], $application['querySet']['last_name'], $application['querySet']['email'], $_SESSION['username']);
    }

    $_SESSION['message'] = $result['message'];
    header("Location: ../index.php");
}

if (isset($_GET['searchBtn'])) {
    $result = searchForApplication($pdo, $_GET['searchInput']);
    foreach ($result['querySet'] as $row) {
        echo "<tr>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['address']}</td>
                <td>{$row['state']}</td>
                <td>{$row['nationality']}</td>
                <td>{$row['qualification']}</td>
                <td>{$row['experience_years']}</td>
                <td>{$row['subjects']}</td>
                <td>{$row['date_added']}</td>
                <td>{$row['added_by']}</td>
                <td>{$row['last_updated']}</td>
                <td>{$row['last_updated_by']}</td>
              </tr>";
    }
    
    
    insertAnActivityLog($pdo, 'SEARCH', null, null, null, $_GET['searchInput'], $_SESSION['username']);
}


if (isset($_POST['insertNewUserBtn'])) {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password) && !empty($confirm_password)) {
        if ($password == $confirm_password) {
            $insertQuery = insertNewUser($pdo, $username, $first_name, $last_name, password_hash($password, PASSWORD_DEFAULT));
            $_SESSION['message'] = $insertQuery['message'];

            if ($insertQuery['status'] == '200') {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../login.php");
            } else {
                $_SESSION['message'] = $insertQuery['message'];
                $_SESSION['status'] = $insertQuery['status'];
                header("Location: ../register.php");
            }
        } else {
            $_SESSION['message'] = "Please make sure both passwords are equal";
            $_SESSION['status'] = '400';
            header("Location: ../register.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = '400';
        header("Location: ../register.php");
    }
}

if (isset($_POST['loginUserBtn'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $loginQuery = checkIfUserExists($pdo, $username);
        $userIDFromDB = $loginQuery['userInfoArray']['user_id'];
        $usernameFromDB = $loginQuery['userInfoArray']['username'];
        $passwordFromDB = $loginQuery['userInfoArray']['password'];

        if (password_verify($password, $passwordFromDB)) {
            $_SESSION['user_id'] = $userIDFromDB;
            $_SESSION['username'] = $usernameFromDB;
            header("Location: ../index.php");
        } else {
            $_SESSION['message'] = "Username/password invalid";
            $_SESSION['status'] = "400";
            header("Location: ../login.php");
        }
    } else {
        $_SESSION['message'] = "Please make sure there are no empty input fields";
        $_SESSION['status'] = '400';
        header("Location: ../register.php");
    }
}

if (isset($_GET['logoutUserBtn'])) {
    unset($_SESSION['username']);
    header("Location: ../login.php");
}
?>