<?php  
require_once 'dbConfig.php';

function getAllApplications($pdo) {
    $sql = "SELECT * FROM teacher_applications ORDER BY first_name ASC";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    
    if ($executeQuery) {
        return [
            'message' => 'Applications retrieved successfully',
            'statusCode' => 200,
            'querySet' => $stmt->fetchAll()
        ];
    } else {
        return [
            'message' => 'Failed to retrieve applications',
            'statusCode' => 400
        ];
    }
}

function getApplicationByID($pdo, $id) {
    $sql = "SELECT * from teacher_applications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);

    if ($executeQuery) {
        return [
            'message' => 'Application retrieved successfully',
            'statusCode' => 200,
            'querySet' => $stmt->fetch()
        ];
    } else {
        return [
            'message' => 'Failed to retrieve application',
            'statusCode' => 400
        ];
    }
}

function searchForApplication($pdo, $searchQuery) {
    $sql = "SELECT * FROM teacher_applications WHERE 
            CONCAT(first_name, last_name, email, phone_number, gender, address, state, nationality, qualification, experience_years, subjects, date_added) 
            LIKE ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(["%" . $searchQuery . "%"]);
    
    if ($executeQuery) {
        return [
            'message' => 'Applications retrieved successfully',
            'statusCode' => 200,
            'querySet' => $stmt->fetchAll()
        ];
    } else {
        return [
            'message' => 'Failed to retrieve applications',
            'statusCode' => 400
        ];
    }
}

function insertNewApplication($pdo, $first_name, $last_name, $email, $phone_number, $gender, $address, $state, $nationality, $qualification, $experience_years, $subjects, $added_by) {
    $sql = "INSERT INTO teacher_applications 
            (
                first_name,
                last_name,
                email,
                phone_number,
                gender,
                address,
                state,
                nationality,
                qualification,
                experience_years,
                subjects,
                added_by
            )
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([
        $first_name, $last_name, $email, $phone_number, $gender, $address, $state, $nationality, $qualification, $experience_years, $subjects, $added_by
    ]);

    if ($executeQuery) {
        return [
            'message' => 'Application inserted successfully',
            'statusCode' => 200
        ];
    } else {
        return [
            'message' => 'Failed to insert application',
            'statusCode' => 400
        ];
    }
}

function editApplication($pdo, $first_name, $last_name, $email, $phone_number, $gender, $address, $state, $nationality, $qualification, $experience_years, $subjects, $last_updated_by, $id) {
    $sql = "UPDATE teacher_applications
            SET first_name = ?,
                last_name = ?,
                email = ?,
                phone_number = ?,
                gender = ?,
                address = ?,
                state = ?,
                nationality = ?,
                qualification = ?,
                experience_years = ?,
                subjects = ?,
                last_updated = CURRENT_TIMESTAMP,
                last_updated_by = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $email, $phone_number, $gender, $address, $state, $nationality, $qualification, $experience_years, $subjects, $last_updated_by, $id]);

    if ($executeQuery) {
        return [
            'message' => 'Application updated successfully',
            'statusCode' => 200
        ];
    } else {
        return [
            'message' => 'Failed to update application',
            'statusCode' => 400
        ];
    }
}

function deleteApplication($pdo, $id) {
    $sql = "DELETE FROM teacher_applications WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$id]);

    if ($executeQuery) {
        return [
            'message' => 'Application deleted successfully',
            'statusCode' => 200
        ];
    } else {
        return [
            'message' => 'Failed to delete application',
            'statusCode' => 400
        ];
    }
}

function checkIfUserExists($pdo, $username) {
    $response = array();
    $sql = "SELECT * FROM user_accounts WHERE username = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$username])) {
        $userInfoArray = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            $response = array(
                "result"=> true,
                "status" => "200",
                "userInfoArray" => $userInfoArray
            );
        } else {
            $response = array(
                "result"=> false,
                "status" => "400",
                "message"=> "User doesn't exist from the database"
            );
        }
    }

    return $response;
}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
    $response = array();
    $checkIfUserExists = checkIfUserExists($pdo, $username); 

    if (!$checkIfUserExists['result']) {
        $sql = "INSERT INTO user_accounts (username, first_name, last_name, password) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$username, $first_name, $last_name, $password])) {
            $response = array(
                "status" => "200",
                "message" => "User successfully inserted!"
            );
        } else {
            $response = array(
                "status" => "400",
                "message" => "An error occured with the query!"
            );
        }
    } else {
        $response = array(
            "status" => "400",
            "message" => "User already exists!"
        );
    }

    return $response;
}

function insertAnActivityLog($pdo, $operation, $application_id, $first_name, $last_name, $email, $username) {
    $sql = "INSERT INTO activity_logs (operation, application_id, first_name, last_name, email, username) VALUES(?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$operation, $application_id, $first_name, $last_name, $email, $username]);

    if ($executeQuery) {
        return true;
    }
}

function getAllActivityLogs($pdo) {
    $sql = "SELECT * FROM activity_logs";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        return $stmt->fetchAll();
    }
}

function getAllUsers($pdo) {
    $sql = "SELECT username FROM user_accounts";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>