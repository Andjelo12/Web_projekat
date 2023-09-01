<?php
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="js/script.js"></script>

    <link href="css/style.css" rel="stylesheet">

    <title>Register / login</title>
</head>
<body>
<div class="container">
    <div class="row m-2">
        <div class="col p-3">
            <h1>Registracija</h1>
            <form action="web.php" method="post" id="registerForm">
                <div class="pt-3 field">
                    <label for="registerFirstname" class="form-label">Ime</label>
                    <input type="text" class="form-control" id="registerFirstname"
                           placeholder="Unesite ime" name="firstname">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="registerLastname" class="form-label">Prezime</label>
                    <input type="text" class="form-control" id="registerLastname"
                           placeholder="Unesite prezime" name="lastname">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="phoneNum" class="form-label">Broj telefona</label>
                    <input type="text" class="form-control" id="phoneNum"
                           placeholder="Unesite validan broj telefona" name="phone">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="registerEmail" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="registerEmail"
                           placeholder="Unesite validan e-mail" name="email">
                    <small></small>
                </div>

                <div class="pt-3 field">
                    <label for="registerPassword" class="form-label">Lozinka <i class="bi bi-eye-slash-fill"
                                                                                 id="passwordEye"></i></label>
                    <input type="password" class="form-control passwordVisibiliy" name="password" id="registerPassword"
                           placeholder="Lozinka (min 8 karaktera)">
                    <small></small>
                    <span id="strengthDisp" class="badge displayBadge">Weak</span>
                </div>

                <div class="pt-3 field">
                    <label for="registerPasswordConfirm" class="form-label">Potvrdi lozinku</label>
                    <input type="password" class="form-control" name="passwordConfirm" id="registerPasswordConfirm"
                           placeholder="Potvrdi lozinku">
                    <small></small>
                </div>

                <div class="pt-3">
                    <input type="hidden" name="action" value="register">
                    <button type="submit" class="btn btn-primary">Registruj se</button>
                    <button type="reset" class="btn btn-primary resetButton" >Otkaži</button>
                </div>
            </form>

            <?php
            $r = 0;

            if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
                $r = (int)$_GET["r"];

                if (array_key_exists($r, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$r] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>
        </div>

        <div class="col bg-light p-3">
            <h1>Login</h1>
            <form action="web.php" method="post" id="loginForm">
                <div class="pt-3">
                    <label for="loginUsername" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="loginUsername"
                           placeholder="Unesite e-mail" name="username">
                    <small></small>
                </div>
                <div class="pt-3">
                    <label for="loginPassword" class="form-label">Lozinka</label>
                    <input type="password" class="form-control" id="loginPassword" placeholder="Lozinka"
                           name="password">
                    <small></small>
                </div>
                <div class="pt-3">
                    <input type="hidden" name="action" value="login">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>


            <?php

            $l = 0;

            if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
                $l = (int)$_GET["l"];

                if (array_key_exists($l, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$l] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>
            <a href="#" id="fl">Zaboravili ste lozinku?</a>
            <form action="web.php" method="post" name="forget" id="forgetForm">
                <div class="pt-3">
                    <label for="forgetEmail" class="form-label">E-mail</label>
                    <input type="text" class="form-control" id="forgetEmail" placeholder="Unesite Vaš e-mail"
                           name="email">
                    <small></small>
                </div>
                <div class="pt-3">
                    <input type="hidden" name="action" value="forget">
                    <button type="submit" class="btn btn-primary">Resetuj lozinku</button>
                </div>
            </form>

            <?php

            $f = 0;

            if (isset($_GET["f"]) and is_numeric($_GET['f'])) {
                $f = (int)$_GET["f"];

                if (array_key_exists($f, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$f] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                }
            }
            ?>

        </div>

    </div>
</div>
<script>
    document.getElementById("registerEmail").addEventListener("focusout", validation);
    const regEmail=document.getElementById('registerEmail');
    function validation() {
        if(regEmail.value.trim().length==0){
            hideErrorMessage(regEmail);
        } else if (!isValidEmail(regEmail.value.trim())) {
            showErrorMessage(regEmail, 'Email is in incorrect format!');
        } else {
            hideErrorMessage(regEmail);
            exist();
        }
    }
    function exist(){
        let dbParam = JSON.stringify({"email":regEmail.value});
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            let respTxt = JSON.parse(this.responseText);
            if(respTxt[0].length!=0) {
                showErrorMessage(regEmail, respTxt[0]);
            }
            else {
                hideErrorMessage(regEmail);
            }
        }
        xmlhttp.open("POST", "emailLiveCheck.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);
    }
</script>
</body>
</html>