<?php
session_start();
include('includes/config.php');
$token='';
if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
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
    <style>
        small{
            color: #f00;
        }
    </style>
</head>
<body>
<?php include('includes/header.php');?>
<br><br>
<?php
$sql = "SELECT * FROM comments WHERE comment_token=:token AND granted_posting<=now()";
$query = $dbh1 -> prepare($sql);
$query->bindParam(':token', $token, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
<h3 class="page-title">Postavi komentar</h3>
<form method="post" action="add_comment.php" enctype="multipart/form-data" class="form-horizontal" id="commentForm">
    <input type="text" name="token" value="<?php echo $_GET['token']; ?>" style="display: none">
    <div class="form-group">
        <label for="comment" class="col-sm-4 control-label">Komenatar</label>
        <div class="col-sm-4">
            <textarea class="form-control white_bg" id="comment" name="comment" rows="4" cols="50" placeholder="unesite komentar ovde"></textarea>
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
            <input type="submit" class="btn btn-primary" value="sačuvaj promene">
        </div>
    </div>
</form>
<?php
}else{
?>
<h3 style="text-align: center">Postavljanje komentara je moguće tek 14 dana nakon početka izdavanja nekretnine</h3>
<?php
}
?>
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
    const comment=document.querySelector("#comment");
    const commentForm=document.querySelector("#commentForm");
    commentForm.addEventListener('submit',function (e) {
        e.preventDefault();
        if (validateComment()) this.submit();
    });
    let validateComment = () => {
        let isValid = true;

        if (isEmpty(comment.value.trim())) {
            showErrorMessage(comment, "Molimo unesite komentar");
            isValid = false;
        } else {
            hideErrorMessage(comment);
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
