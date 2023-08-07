<?php
session_start();
include('includes/config.php');
if($_SESSION['adm']!="Yes")
{
    header("Location: ./login/index.php");
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
    <title>Nekretnine</title>
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

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header -->

<section class="listing-page">
    <div class="container">
        <h2 class="page-title">Korisničke Nekretnine</h2>
            <?php
            if(isset($_SESSION['message'])) {
                echo "<script>alert('Nekretnina uspešno obrisana')</script>";
                unset($_SESSION['message']);
            }
            if(isset($_SESSION['message_change'])) {
                echo "<script>alert('Nekretnina uspešno izmenjena')</script>";
                unset($_SESSION['message_change']);
            }
            if(isset($_SESSION['message_change'])) {
                echo "<script>alert('Nekretnina uspešno dodata')</script>";
                unset($_SESSION['message_change']);
            }
            ?>
                <?php
                $sql = "SELECT * FROM estates";
                $query = $dbh1 -> prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0)
                {
                    foreach($results as $result)
                    {
                        ?>
                        <div class="product-listing-m gray-bg">
                            <div class="product-listing-img"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($result->foto); ?>" class="img-responsive" alt="Image" />
                            </div>
                            <div class="product-listing-content">
                                <h5><?php echo htmlentities($result->location);?></h5>
                                <p class="list-price"><?php echo number_format(htmlentities($result->price),2);?> RSD</p>
                                <ul>
                                    <li>Tip nekretnine: <?php echo htmlentities($result->estate_type);?></li>
                                    <li>Period iznajmljivanja: <?php echo htmlentities($result->rent_period);?> dana</small></li>
                                    <br>
                                    <li>Status nekretnine: <?php echo htmlentities($result->status);?></li>
                                </ul>
                                <a href="details.php?id=<?php echo htmlentities($result->id_estate);?>" class="btn">Detaljnije...<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                <a href="change_property.php?id=<?php echo htmlentities($result->id_estate);?>" class="btn">Izmeni</a>
                                <a href="delete_estate.php?id=<?php echo htmlentities($result->id_estate);?>" class="btn">Obriši</a>

                                <?php
                                if($result->approved=="No"){
                                    echo '<a href="approve.php?id='.$result->id_estate.'" class="btn" style="background-color: #080">Odobri nekretninu</a>';
                                }
                                if($result->active=="Yes" && $result->approved=="Yes"){
                                    echo '<a href="deactivate.php?id='.$result->id_estate.'" class="btn" style="background-color:#f00;">Deaktiviraj nekretninu</a>';
                                }
                                elseif ($result->active=="No" && $result->approved=="Yes"){
                                    echo '<a href="activate.php?id='.$result->id_estate.'" class="btn" style="background-color:#080">Aktiviraj nekretninu</a>';
                                }
                                ?>

                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

</section>


<!--Footer -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <p class="white-text">Iznajmljivanje stanova <br>Copyright &copy; 2023 Jevanđel Đurić</p>
            </div>
        </div>
    </div>
</div>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!-- Scripts -->
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
