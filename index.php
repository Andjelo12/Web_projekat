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
<title>Iznajmljivanje stanova</title>
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
    <script src="js/sidebarCheck.js"></script>
    <style>
        small{
            color: #f00;
        }
    </style>
</head>
<body>


<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header -->


<!--Page Header-->

<section id="banner " class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1 class="text-shadow" style="color:#fff !important;">Izaberite pravu nekretninu za vas</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- /Page Header--> 

<?php
$sql2 = "SELECT id_estate FROM rented WHERE rent_end<=now()";
$query2 = $dbh1 -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0){
    foreach ($results2 as $result2){
        $sql3 = "SELECT * FROM estates";
        $query3 = $dbh1 -> prepare($sql3);
        $query3->execute();
        $results3=$query3->fetchAll(PDO::FETCH_OBJ);
        foreach($results3 as $result3)
        {
            if($result3->id_estate==$result2->id_estate)
            {
                $sql4 = "UPDATE estates SET status='slobodno' WHERE id_estate=:id";
                $query4 = $dbh1 -> prepare($sql4);
                $query4->bindParam(":id",$result2->id_estate);
                $query4->execute();
            }
        }
    }
}
if(isset($_SESSION['login_ch'])) {
    echo "<script>alert('Lozinka uspesno izmenjena!')</script>";
    unset($_SESSION['login_ch']);
}
if(isset($_SESSION['message_profile_change'])) {
    echo "<script>alert('Profilni podaci uspesno izmenjeni!')</script>";
    unset($_SESSION['message_profile_change']);
}if(isset($_SESSION['message_send'])) {
    echo "<script>alert('Poruka poslana!')</script>";
    unset($_SESSION['message_send']);
}
?>
<section class="listing-page">
  <div class="container">
    <div class="row">
      <!--  Show properties from database that are alowed by admin      -->
      <div class="col-md-9 col-md-push-3" id="insert-rows">
        <?php
        $sql = "SELECT * FROM estates";
        $query = $dbh1 -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        $max=0;
        $min=0;
        $min_per=0;
        $max_per=0;
        if($query->rowCount() > 0)
        {
            $max=$results[0]->price;
            $min=$results[0]->price;
            $min_per=$results[0]->rent_period;
            $max_per=$results[0]->rent_period;
            foreach($results as $result)
            {
                if($result->price>$max)
                    $max=$result->price;
                if($result->price<$min)
                    $min=$result->price;
                if($result->rent_period>$max_per)
                    $max_per=$result->rent_period;
                if($result->rent_period<$min_per)
                    $min_per=$result->rent_period;
                if($result->active=="Yes" && $result->approved=="Yes"){
        ?>
                <div class="product-listing-m gray-bg">
                  <div class="product-listing-img">
                      <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($result->foto); ?>" class="img-responsive" alt="Image" />
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
                  </div>
                </div>
      <?php
                }
            }
        }
      ?>
      </div>

      <!-- Side-Bar search -->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Pronađite nekretninu </h5>
          </div>
          <div class="sidebar_filter">
            <form action="search.php" method="post" id="searchFrm">
              <div class="form-group select">
                <select class="form-control" name="type" id="type">
                  <option value="">Tip nekretnine</option>
                  <option value="kuća">kuća</option>
                  <option value="stan">stan</option>
                </select>
                  <small></small>
              </div>
                <label for="price" class="control-label">Cena</label><br>
                <input id="price" name="price" class="form-control" type="range" min="<?php echo $min; ?>" max="<?php echo $max; ?>" step=".01" />
                <p class="text-center"><span id="show_price"></span> RSD</p>
              <div class="form-group select">
                <select class="form-control" name="location" id="location">
                  <option value="">Lokacija</option>
                  <?php
                  $sql = "SELECT location FROM estates ";
                  $query = $dbh1 -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query->rowCount() > 0)
                  {
                      foreach($results as $result)
                      {
                          $str_arr = explode (", ", $result->location);
                  ?>
                  <option value="<?php echo htmlentities($result->location);?>"><?php echo $str_arr[0];?></option>
                  <?php
                      }
                  }
                  ?>
                </select>
                  <small></small>
              </div>
                <label for="period" class="control-label">Period iznajmljivanja</label><br>
                <input id="period" name="period" class="form-control" type="range" min="<?php echo $min_per; ?>" max="<?php echo $max_per; ?>" />
                <p class="text-center"><span id="period_result"></span> dana</p>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Pronađi nekretninu</button>
              </div>
            </form>
          </div>
        </div>
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
