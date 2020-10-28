<?php

require_once '/var/www/ExpenseTracker/service/models.php';
require_once '/var/www/ExpenseTracker/configuration/db.php';

class CategoryService extends DB{

    public function createCategory($category){
    $conn = self::connect();
    $query = "INSERT INTO Category(category, users_id) VALUES (?,?)";
    $statement = $conn->prepare($query);
    $statement->bind_param('si', $category->category, $category->users_id);
    $statement->execute();
    if (mysqli_affected_rows($conn) > 0) {
        $lastest_id = mysqli_insert_id($conn);
        $statement->close();
        return 'success';
    } else {
        $statement->close();
        return 'failed';
    }

    }


    public static function listCategory($category)
    {
        $conn = self::connect();
        $query = "SELECT * FROM Category where users_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $category->users_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $category =  $row['category'];
                $category = new Category($id,null, $category);
                $rows[] = $category;
            }
        } else {
            $rows = '';
        }
        $stmt->close();
        return $rows;
    }


    public static function editCategory($category)
    {
        $conn = self::connect();
        $query = "UPDATE Category SET category=? where id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $category->category,$category->id);
        $stmt->execute();
        echo $stmt->error;
        if(mysqli_affected_rows($conn)>0){
            $message = "success";
            $stmt->close();
            return $message;
        }
        else{
            $message = "failed";
            $stmt->close();
            return $message;
        }
        
    }


    public static function deleteCategory($category)
    {
        $conn = self::connect();
        $query = "DELETE FROM Category WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $category->id);
        $stmt->execute();
        echo $stmt->error;
        if(mysqli_affected_rows($conn)>0){
            $message = "Deleted Successfully!";
            $stmt->close();
            return 'success';
        }
        else{
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }
        
    }


}


