<?php
session_start();
include('includes/config.php');
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
        <h2 class="page-title">Moje Nekretnine</h2>
            <?php
            if(isset($_SESSION['message'])) {
                echo "<script>alert('Nekretnina uspešno obrisana')</script>";
                unset($_SESSION['message']);
            }
            if(isset($_SESSION['message_change'])) {
                echo "<script>alert('Nekretnina uspešno izmenjena')</script>";
                unset($_SESSION['message_change']);
            }
            if(isset($_SESSION['message_added'])) {
                echo "<script>alert('Nekretnina uspešno dodata')</script>";
                unset($_SESSION['message_added']);
            }
            ?>
                <?php
                $sql = "SELECT estates.id_estate,estates.description,estates.estate_type,estates.location,estates.price,estates.foto,estates.rent_period,estates.status, estates.approved FROM estates INNER JOIN user_estate ON estates.id_estate=user_estate.id_estate WHERE email=:email";
                $query = $dbh1 -> prepare($sql);
                $query->bindParam(':email',$_SESSION["username"], PDO::PARAM_STR);
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
                                <?php
                                if($result->approved=="Yes"){
                                if($result->status=='slobodno') {
                                    echo '<a href="rent_property.php?id='.$result->id_estate.'&days='.$result->rent_period.'" class="btn">Izdaj nekretninu</a>';
                                }else{
                                    echo '<a href="" class="btn" style="background-color: #f00">Nekretnina je izdata</a>';
                                }
                                ?>
                                <a href="change_property.php?id=<?php echo htmlentities($result->id_estate);?>" class="btn">Izmeni</a>
                                    <button onclick="confirmFncEstate(<?php echo $result->id_estate; ?>)" class="btn" style="background-color: #f00">Obriši</button>
                                    <?php } else {
                                echo '
                                <a href="" class="btn" style="background-color: #f00">Nekretnina još uvek nije odobrena</a>
                                ';
                                }?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

</section>
<div style="position: relative;display: flex;align-items: center;justify-content: center; top: 0;
                bottom: 0;
                left: 0;
                right: 0;">
<a href="add_property.php" class="btn">Dodaj nekretninu</a>
</div>
    <br><br>

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

<script>
    function confirmFncEstate(id){
        if(confirm('Da li stvarno želite da obrišete nekretninu?')){
            location.href='delete_estate.php?id='+id;
        }
    }
</script>
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
