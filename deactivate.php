<?php
session_start();
include('includes/config.php');
$sql = "UPDATE estates SET active='No' WHERE id_estate=:id";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':id',$_GET["id"], PDO::PARAM_INT);
$query->execute();
if($query->rowCount() > 0)
{
    header("Location: list_estates_admin.php");
}
?>