<?php
include('includes/config.php');
$sql = "DELETE FROM comments WHERE id_comment=:id";
$query = $dbh1 -> prepare($sql);
$query->bindParam(":id",$_GET["id"]);
$query->execute();
if($query->rowCount()>0) {
    header("Location: comments_admin.php");
}