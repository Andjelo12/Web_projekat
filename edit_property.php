<?php
session_start();
include('includes/config.php');
$sql = "UPDATE estates SET description=:description, estate_type=:estate_type, location=:location, price=:price, rent_period=:period, status=:status WHERE id_estate=:id";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':id',$_POST["id"], PDO::PARAM_INT);
if($_FILES['img']['tmp_name']!=null)
{

    $sql2 = "UPDATE estates SET foto=:foto WHERE id_estate=:id";
    $query2 = $dbh1 -> prepare($sql2);
    $foto=file_get_contents($_FILES['img']['tmp_name']);
    $query2->bindParam(':id',$_POST["id"], PDO::PARAM_INT);
    $query2->bindParam(':foto',$foto);
    $query2->execute();
    if($query2->rowCount() > 0)
    {
        $_SESSION['message_change'] = 'Nekretnina uspesno izmenjena!';
        if(isset($_SESSION['adm']) && $_SESSION['adm']=='Yes') {
            header("Location: list_estates_admin.php");
        }else {
            header("Location: list_estates.php");
        }
    }
    else {
        if (isset($_SESSION['adm']) && $_SESSION['adm'] == 'Yes') {
            header("Location: list_estates_admin.php");
        } else {
            header("Location: list_estates.php");
        }
    }
}
$query->bindParam(':description',$_POST["details"], PDO::PARAM_STR);
$query->bindParam(':estate_type',$_POST["type"], PDO::PARAM_STR);
$query->bindParam(':location',$_POST["location"], PDO::PARAM_STR);
$query->bindParam(':price',$_POST["price"], PDO::PARAM_STR);
$query->bindParam(':period',$_POST["period"], PDO::PARAM_INT);
$query->bindParam(':status',$_POST["status"], PDO::PARAM_STR);
$query->execute();
if($query->rowCount() > 0)
{
    $_SESSION['message_change'] = 'Nekretnina uspesno izmenjena!';
    if(isset($_SESSION['adm']) && $_SESSION['adm']=='Yes')
        header("Location: list_estates_admin.php");
    else
        header("Location: list_estates.php");
}
else {
    if (isset($_SESSION['adm']) && $_SESSION['adm'] == 'Yes') {
        header("Location: list_estates_admin.php");
    } else {
        header("Location: list_estates.php");
    }
}
?>