<?php
include("includes/config.php");
$sql = "UPDATE messages SET seen='Yes' WHERE id_message=:id_message";
$query = $dbh1 -> prepare($sql);
$query->bindParam(":id_message",$_GET['id_message']);
$query->execute();
if($query->rowCount()>0) {
    header("Location: messages.php");
}