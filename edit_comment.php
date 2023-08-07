<?php
session_start();
include('includes/config.php');
if(isset($_POST["id"])){
    $sql2 = "UPDATE comments SET comment=:comment WHERE id_comment=:id";
    $query2 = $dbh1 -> prepare($sql2);
    $query2->bindParam(":id",$_POST["id"]);
    $query2->bindParam(":comment",$_POST["comment"]);
    $query2->execute();
    header("Location: comments_admin.php");
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
<h3 class="page-title">Izmeni komentar</h3>
<form method="post" action="#" enctype="multipart/form-data" class="form-horizontal" id="commentForm">
    <?php
    $sql = "SELECT * FROM comments WHERE id_comment=:id";
    $query = $dbh1 -> prepare($sql);
    $query->bindParam(":id",$_GET["id"]);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    ?>
    <input type="text" name="id" value="<?php echo $results[0]->id_comment; ?>" style="display: none">
    <div class="form-group">
        <label for="posted" class="col-sm-4 control-label">Postavio</label>
        <div class="col-sm-4">
            <input type="email" id="posted" class="form-control white_bg" value="<?php echo $results[0]->email; ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="date" class="col-sm-4 control-label">Datum postavljanja</label>
        <div class="col-sm-4">
            <input type="datetime-local" id="date" class="form-control white_bg" value="<?php echo $results[0]->publication_date; ?>" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="comment" class="col-sm-4 control-label">Komenatar</label>
        <div class="col-sm-4">
            <textarea class="form-control white_bg" id="comment" name="comment" rows="4" cols="50"><?php echo $results[0]->comment; ?></textarea>
            <small></small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
            <input class="btn btn-primary" type="submit" value="sačuvaj promene">
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
    const comment=document.querySelector("#comment");
    const commentFrm=document.querySelector("#commentForm");
    commentFrm.addEventListener('submit',function (e) {
        e.preventDefault();
        if (validateMsg()) this.submit();
    });
    let validateMsg = () => {
        let isValid = true;

        if (isEmpty(comment.value.trim())) {
            showErrorMessage(comment, "Polje ne može ostati prazno!");
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
