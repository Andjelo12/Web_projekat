<?php
session_start();
include('includes/config.php');
if($_SESSION['adm']!="Yes")
{
    header("Location: index.php");
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
        <h2 class="page-title">Svi Komentari</h2>
        <div class="row">
                <?php
                $sql = "SELECT * FROM comments";
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
                            <div class="product-listing-img">
                            </div>
                            <div class="product-listing-content">
                                <ul>
                                    <li>E-mail korisnika: <?php echo htmlentities($result->email);?></li>
                                    <li>Datum postavljanja: <?php echo htmlentities($result->publication_date);?></li>
                                    <li><a href="details.php?id=<?php echo $result->id_estate ?>">Nekretnina</a></li>
                                    <li>Komentar: <?php echo $result->comment; ?></li>
                                </ul>
                                
                                <li><a href="edit_comment.php?id=<?php echo $result->id_comment; ?>" class="btn">Izmeni</a></li>
                                <li><a href="delete_comment.php?id=<?php echo $result->id_comment; ?>" class="btn" style="background-color: #f00">Obriši</a></li>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

</section>

<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="text-center">
                <p class="white-text">Iznajmljivanje stanova <br>Copyright &copy; 2023 Jevanđel Đurić</p>
            </div>
        </div>
    </div>
</div>

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
