<?php
require_once '/var/www/ExpenseTracker/configuration/db.php';
class UsersService extends DB
{

    public static function createUser($user)
    {
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            return 'failed';
        }
       
        $emails = UsersService::checkEmail($user->email);
        if (in_array($user->email, $emails)) {
            $message = "exists";
            return $message;
        }
        $user->password = password_hash("$user->password", PASSWORD_DEFAULT);
        $conn = self::connect();
        $query = "INSERT INTO Users(first_name, last_name,email, password) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $user->first_name, $user->last_name, $user->email, $user->password);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            return 'success';
        } else {
            $stmt->close();
            return 'failed';
        }}

    public static function checkEmail($email)
    {
        $conn = self::connect();
        $query = "SELECT email FROM Users";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emails[] = $row['email'];
            }
        } else {
            $emails[] = [];
        }
        $stmt->close();
        return $emails;
    }

    public static function check($user)
    {
        $conn = self::connect();
        $query = "SELECT * FROM Users WHERE email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $user->email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $password = $row['password'];
            if (password_verify($user->password, $password)) {
                return new Users($row['id'], $row['first_name'], $row['last_name'], $row['email'], null);
            } else {
                return 'Wrong';
            }
        } else {
            return 'Wrong';
        }
    }

}
