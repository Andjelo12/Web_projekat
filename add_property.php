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
    <title>Dodaj nekretninu</title>
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
    <script src="js/addcheck.js"></script>
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
<h3 class="page-title text-center">Dodaj nekretninu</h3>
<form method="post" action="insert.php" enctype="multipart/form-data" class="form-horizontal" id="propertyAddFrm">
    <div class="form-group">
        <label class="col-sm-4 control-label" for="location">Lokacija</label>
        <div class="col-sm-4">
            <input type="text" class="form-control white_bg" id="location" name="location" placeholder="naselje,&#9251;adresa">
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="type">Tip nekretnine</label>
        <div class="col-sm-4">
            <select name="type" class="form-control white_bg" id="type">
                <option value="kuća">kuća</option>
                <option value="stan">stan</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="period" class="col-sm-4 control-label">Period iznajmljivanja</label>
        <div class="col-sm-4">
            <input id="period" class="form-control white_bg" type="number" name="period" min="1" placeholder="broj dana">
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <label for="price" class="col-sm-4 control-label">Cena</label>
        <div class="col-sm-4">
            <input class="form-control white_bg" type="number" min="0" id="price" name="price" step=".01" placeholder="RSD" >
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <label for="details" class="col-sm-4 control-label">Detalji nekretnine</label>
        <div class="col-sm-4">
            <textarea id="details" class="form-control white_bg" name="details" rows="4" cols="50" placeholder="opis nekretnine" ></textarea>
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <label for="foto" class="col-sm-4 control-label">Dodaj fotografiju</label>
        <div class="col-sm-4">
            <input id="foto" class="form-control white_bg" type="file" name="img" />
            <small></small>
        </div>
    </div>
    <div class="hr-dashed"></div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
            <input type="submit" class="btn btn-primary" value="dodaj nekretninu">
        </div>
    </div>
</form>
        </div>
    </div>
</div>
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
<!--Back to top-->
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
