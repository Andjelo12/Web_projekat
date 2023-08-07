<?php
session_start();
include('includes/config.php');
$id="";
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Detalji nekretnine</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/map.css">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/modal_confirmation.css">
</head>
<body>
<?php include('includes/header.php');?>
<br><br>
<?php
$sql_query="SELECT * FROM estates WHERE id_estate = :id";
$query= $dbh1 -> prepare($sql_query);
$query->bindParam(':id',$id);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0) {
        ?>
        <div class="container">
            <h2><?php echo $results[0]->location; ?></h2>
            <div class="row">
                <div class="col-md-5">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($results[0]->foto); ?>" class="img-responsive" alt="Image"/>
                </div>
                <div class="col-md-7">
                    <div style="font-size: 12pt">
                    Detalji nekretnine:<br><?php echo $results[0]->description; ?>
                    <br><br>Tip nekretnine:<br><?php echo $results[0]->estate_type; ?>
                    <br><br>Period iznajmljivanja:<br><?php echo $results[0]->rent_period; ?> dana
                    <br><br>Status nekretnine:<br><?php echo $results[0]->status; ?>
                    <br><br>
                    <div class="container-fluid text-right">
                        <?php
                        $sql_query3="SELECT id_estate,email FROM user_estate WHERE id_estate = :id";
                        $query3= $dbh1 -> prepare($sql_query3);
                        $query3->bindParam(':id',$id);
                        $query3->execute();
                        $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                        if($results[0]->status!="slobodno" || $results3[0]->email==$_SESSION["username"]) {
                            echo '<a href="" class="btn" style="background-color:#f00">Izaberite drugu nekretninu</span></a>';
                        }else{
                            echo '<a href="contact_user.php?id='.$id.'" class="btn">Kontaktiraj korisnika</span></a>';
                        }
                        ?>
                    </div>
                    <br><br>Komentari:
                    </div>
                    <?php
                        $sql_query2="SELECT * FROM comments WHERE id_estate=:id AND active='Yes'";
                        $query2= $dbh1 -> prepare($sql_query2);
                        $query2->bindParam(":id",$id);
                        $query2->execute();
                        $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                        if($query2->rowCount() > 0) {
                            foreach($results2 as $result)
                            {
                                echo "<hr><p><b>$result->publication_date</b><br> $result->comment</p>";
                                if(isset($_SESSION['adm'])) {
                                    echo '<small><a href="edit_comment.php?id='.$result->id_comment.'">Izmeni Komentar</a></small>';
                                }
                            }
                        }
                    ?>
                    <hr>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
<br><br>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <p class="white-text">Iznajmljivanje stanova <br>Copyright &copy; 2023 Jevanđel Đurić</p>
            </div>
        </div>
    </div>
</div>
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS-->
<script src="assets/js/bootstrap-slider.min.js"></script>
<!--Slider-JS-->
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
