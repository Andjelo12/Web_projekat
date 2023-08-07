<header class="shadowed">
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header" style="padding-left:2rem !important;">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button" style="color:white !important; border: none !important; font-weight:600; top: -2px !important;">Iznajmljivanje &nbsp; <i class='fa fa-navicon fa-sm'></i> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login" style="margin-right:45px;">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
<?php
if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
}
?>
   <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu pull-right">
           <?php if(isset($_SESSION['username'])){
               echo "<li><a href='./login/reset_pass.php'>Izmeni Lozinku</a></li>";
               if(isset($_SESSION['adm']) && $_SESSION['adm']=='Yes'){
                   echo "
                   <li><a href='users_admin.php'>Korisnički nalozi</a></li>
               <li><a href='list_estates_admin.php'>Nekretnine korisika</a></li>    
               <li><a href='comments_admin.php'>Komentari</a></li>                               
                   ";
               }else{
                   echo "
                   <li><a href='change_profile.php'>izmeni profil</a></li>
               <li><a href='list_estates.php'>Moje nekretnine</a></li>
              <li><a href='records_of_issuance.php'>Evidencija</a></li>
                   ";
               }
               $sql = "SELECT * FROM messages WHERE email_receiver=:email_receiver";
               $query = $dbh1 -> prepare($sql);
               $query->bindParam(":email_receiver",$_SESSION['username']);
               $query->execute();
               $results=$query->fetchAll(PDO::FETCH_OBJ);
               $cnt=0;
               if($query->rowCount() > 0)
               {
                   foreach ($results as $result)
                   {
                       if($result->seen=='No')
                           $cnt++;
                   }
               }
               if($cnt>0){
                   echo "
                       <li><a href='messages.php'>Nove Poruke($cnt)</a></li>
                       ";
               }else{
                   echo "
                       <li><a href='messages.php'>Poruke</a></li>
                       ";
               }
               ?>
            <li><a href="./login/logout.php">Sign Out</a></li>
            <?php } else { ?>
            <li><a href="./login/index.php" data-toggle="modal" data-dismiss="modal">Log-in</a></li>
            <?php } ?>
          </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation" style="background-color:#428bca; !important;" >
        <ul class="nav navbar-nav">
          <li><a href="index.php" id="nav-home-button">Početna</a></li>
          <li><a href="contact-us.php" id="nav-about-us-button">O nama</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end -->
</header>

