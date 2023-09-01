<?php
session_start();
include('includes/config.php');
$user="";
if (isset($_SESSION['username'])) {
    $user=$_SESSION['username'];
}
if(isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone'])) {
    $sql = "UPDATE users SET firstname=:firstname, lastname=:lastname, phone=:phone WHERE email=:id";
    $query = $dbh1->prepare($sql);
    $query->bindParam(':id', $_POST["id"], PDO::PARAM_STR);
    $query->bindParam(':firstname', $_POST["firstname"], PDO::PARAM_STR);
    $query->bindParam(':lastname', $_POST["lastname"], PDO::PARAM_STR);
    $query->bindParam(':phone', $_POST["phone"], PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        $_SESSION['message_profile_change'] = 1;
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
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
    <title>Izmeni nekretninu</title>
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
    <script src="js/chProfileCheck.js"></script>
    <style>
        small{
            color: #f00;
        }
    </style>
</head>
<body>
<?php include('includes/header.php');?>
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Izmeni profil</h3>
            <form method="post" action="#" enctype="multipart/form-data" class="form-horizontal" id="chProfileForm">
                <?php
                $sql = "SELECT * FROM users WHERE email=:email";
                $query = $dbh1 -> prepare($sql);
                $query->bindParam(':email', $user, PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {
                    $firstname=$results[0]->firstname;
                    $lastname=$results[0]->lastname;
                    $tel=$results[0]->phone;
                }
                ?>
                <input type="text" name="id" value="<?php echo $user; ?>" style="display: none">
                <div class="form-group">
                    <label for="firstname" class="col-sm-4 control-label">Ime</label>
                    <div class="col-sm-4">
                        <input id="firstname" class="form-control white_bg" type="text" name="firstname" value="<?php echo $firstname; ?>">
                        <small></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-4 control-label">Prezime</label>
                    <div class="col-sm-4">
                        <input type="text" id="lastname" class="form-control white_bg" name="lastname" value="<?php echo $lastname; ?>">
                        <small></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label">Broj telefona</label>
                    <div class="col-sm-4">
                        <input type="text" id="phone" class="form-control white_bg" name="phone" value="<?php echo $tel; ?>">
                        <small></small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <input type="submit" class="btn btn-primary" value="sačuvaj promene">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                        <a href="change_pass.php">Izmeni lozinku</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
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
