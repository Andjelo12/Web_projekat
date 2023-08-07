<?php
session_start();
include('includes/config.php');
$sql = "UPDATE users SET is_banned=1 WHERE id_user=:id";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':id',$_GET["id"], PDO::PARAM_INT);
$query->execute();
if($query->rowCount() > 0)
{
    header("Location: users_admin.php");
}
?>