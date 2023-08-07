<?php
session_start();
include('includes/config.php');
$sql = "UPDATE comments SET comment=:comment,active='Yes' WHERE comment_token=:token";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':comment',$_POST["comment"], PDO::PARAM_STR);
$query->bindParam(':token',$_POST["token"], PDO::PARAM_STR);
$query->execute();
if($query->rowCount() > 0)
{
    header("Location: index.php");
}
