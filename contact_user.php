<?php
session_start();
include('includes/config.php');
if(!isset($_SESSION['username']))
{
    header('Location: ./login/index.php');
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
    <title>Kontaktiraj korisnika</title>
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
<h3 class="page-title">Kontaktiraj zakupca</h3>
<form method="post" action="send.php" enctype="multipart/form-data" class="form-horizontal" id="msgForm">
    <input type="text" name="id"  value="<?php echo $_GET["id"];?>" style="display: none">
    <input type="text" name="email_sender"  value="<?php echo $_SESSION['username'];?>" style="display: none">
    <div class="form-group">
        <label for="message" class="col-sm-4 control-label">Poruka</label>
        <div class="col-sm-4">
            <textarea class="form-control white_bg" id="message" name="message" rows="4" cols="50" placeholder="unesite poruku ovde"></textarea>
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
            <input type="submit" class="btn btn-primary" value="Pošalji">
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

<script>
    const message=document.querySelector("#message");
    const msgForm=document.querySelector("#msgForm");
    msgForm.addEventListener('submit',function (e) {
        e.preventDefault();
        if (validateMsg()) this.submit();
    });
    let validateMsg = () => {
        let isValid = true;

        if (isEmpty(message.value.trim())) {
            showErrorMessage(message, "Molimo unesite poruku");
            isValid = false;
        } else {
            hideErrorMessage(message);
        }

        return isValid;

    }
    const isEmpty = value => value === '';
    const showErrorMessage = (field, message) => {
        const error = field.nextElementSibling;
        error.innerText = message;
    };
    const hideErrorMessage = (field) => {
        const error = field.nextElementSibling;
        error.innerText = '';
    }
</script>
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
