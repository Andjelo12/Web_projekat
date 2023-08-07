<?php
session_start();
include('includes/config.php');
if(!isset($_SESSION['username']))
{
    header("Location: ./login/index.php");
}
if(isset($_GET['id'])){
    $sql = "DELETE FROM messages WHERE id_message=:id";
    $query = $dbh1 -> prepare($sql);
    $query->bindParam(":id",$_GET['id']);
    $query->execute();
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
<?php
if (isset($_SESSION['msg_send'])){
    echo '<script>alert("Poruka uspešno poslana");</script>';
}
?>

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header -->

<section class="listing-page">
    <div class="container">
        <h2 class="page-title">Poruke</h2>
            <?php
            $sql = "SELECT * FROM messages WHERE email_receiver=:email_receiver";
            $query = $dbh1 -> prepare($sql);
            $query->bindParam(":email_receiver",$_SESSION['username']);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0)
            {
                foreach($results as $result)
                {
                    ?>
                    <div class="product-listing-m gray-bg">
                        <div class="product-listing-content" style="width: 100%">
                            <ul>
                                <li>E-mail korisnika: <?php echo htmlentities($result->email_sender);?></li>
                                <li>Datum: <?php echo htmlentities($result->publication_date);?></li>
                                <li><a href="details.php?id=<?php echo $result->id_estate ?>">Nekretnina</a></li>
                                <li>Poruka: <br><span style="font-size: 11pt"><?php echo htmlentities($result->message);?></span></li>
                                <?php
                                if($result->seen=='No')
                                    echo "
                                    <li>Status: Neodgovoreno</li>
                                    ";
                                else
                                    echo "
                                    <li>Pročitana poruka</li>
                                    ";
                                ?>
                            </ul>
                            <li style="width: 150px"><a href="answer.php?id_estate=<?php echo $result->id_estate; ?>&email_receiver=<?php echo $result->email_sender; ?>&id_message=<?php echo $result->id_message; ?>" class="btn">Odgovori</a></li>
                            <li style="width: 240px"><a href="read.php?id_message=<?php echo $result->id_message; ?>" class="btn" style="background-color: #080;">Označi kao pročitano</a></li>
                            <li style="width: 150px"><button onclick="confirmFnc(<?php echo $result->id_message; ?>)" class="btn" style="background-color: #f00">Obriši</button></li>
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
<script>
    function confirmFnc(id){
        if(confirm('Da li stvarno želite da obrišete poruku?')){
            location.href='messages.php?id='+id;
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
