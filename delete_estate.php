<?php
session_start();
$id=$_GET["id"];
include('includes/config.php');
$sql = "DELETE FROM estates WHERE id_estate=:id";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':id',$id, PDO::PARAM_INT);
$query->execute();
if($query->rowCount() > 0)
{
    $_SESSION['message'] = 'Nekretnina uspesno uklonjena!';
    if(isset($_SESSION['adm']) && $_SESSION['adm']=='Yes')
        header("Location: list_estates_admin.php");
    else
        header("Location: list_estates.php");
}
?>
