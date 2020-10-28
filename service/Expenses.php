<?php
require_once '/var/www/ExpenseTracker/configuration/db.php';
class ExpensesService extends DB
{

    public static function createExpense($expense)
    {

        $conn = self::connect();
        $query = "INSERT INTO Expenses(users_id, category, amount, buyingdate ) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('isis', $expense->users_id, $expense->category, $expense->amount, $expense->buyingdate);
        $stmt->execute();
        if (mysqli_affected_rows($conn) > 0) {
            $lastest_id = mysqli_insert_id($conn);
            $stmt->close();
            return 'success';
        } else {
            $stmt->close();
            return 'failed';
        }}




    public static function listExpenses($expense)
    {
        $conn = self::connect();
        $query = "SELECT * FROM Expenses where users_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $expense->users_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $category =  $row['category'];
                $amount =  $row['amount'];
                $buyingdate =  $row['buyingdate'];
                $expense = new Expenses($id, null, $category, $amount, $buyingdate);
                $rows[] = $expense;
            }
        } else {
            $rows = '';
        }
        $stmt->close();
        return $rows;
    }



    public static function getCategoryGrouped($expense)
    {
        $conn = self::connect();
        $query = "SELECT category, count(1) as statistic FROM Expenses where users_id=? group by category";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $expense->users_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $statistic = $row['statistic'];
                $category =  $row['category'];
                $expense = new Expenses(null, null, $category, $statistic);
                $rows[] = $expense;
            }
        } else {
            $rows = '';
        }
        $stmt->close();
        return $rows;
    }

    public static function deleteExpense($expense)
    {
        $conn = self::connect();
        $query = "DELETE FROM Expenses WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $expense->id);
        $stmt->execute();
        echo $stmt->error;
        if(mysqli_affected_rows($conn)>0){
            $message = "Deleted Successfully!";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }
        
    }

    public static function editExpense($expense)
    {
        $conn = self::connect();
        $query = "UPDATE Expenses SET category=?, amount=?, buyingdate=? where id=? and users_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sisii', $expense->category,$expense->amount,$expense->buyingdate,$expense->id,$expense->users_id);
        $stmt->execute();
        echo $stmt->error;
        if(mysqli_affected_rows($conn)>0){
            $message = "Edited Successfully!";
            $stmt->close();
            return $message;
        }
        else{
            $message = "Something went wrong, try again!";
            $stmt->close();
            return $message;
        }
        
    }

}
