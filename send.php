<?php
session_start();
class Message{
    const DB_HOST = 'localhost';
    const DB_USER='tim';
    const DB_PASS='Xj3W3WLgQeQxOp6';
    const DB_NAME2='tim';
    private $dbh1;
    public function __construct(){
        try
        {
            $this->dbh1 = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME2,self::DB_USER, self::DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }
        catch (PDOException $e)
        {
            exit("Error: " . $e->getMessage());
        }
    }
    public function checkEmail($id) : string{
        $sql = "SELECT email FROM user_estate WHERE id_estate=:id";
        $dbh=$this->dbh1;
        $query = $dbh -> prepare($sql);
        $query->bindParam('id',$id,PDO::PARAM_INT);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        return $results[0]->email;
    }
    public function sendEmail($email_sender,$email_receiver,$id_estate,$message){
        $sql = "INSERT INTO messages(email_sender,email_receiver,id_estate,message) VALUES (:email_sender,:email_receiver,:id_estate,:message)";
        $dbh=$this->dbh1;
        $query = $dbh -> prepare($sql);
        $query->bindParam(':email_sender',$email_sender,PDO::PARAM_STR);
        $query->bindParam(':email_receiver',$email_receiver,PDO::PARAM_STR);
        $query->bindParam(':id_estate',$id_estate,PDO::PARAM_INT);
        $query->bindParam(':message',$message,PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount() > 0)
        {
            $_SESSION['message_send'] = 1;
            header("Location: index.php");
        }
    }
}
$obj=new Message();
$email_receiver = $obj->checkEmail($_POST['id']);
$obj->sendEmail($_POST['email_sender'],$email_receiver,$_POST['id'],$_POST['message']);
?>