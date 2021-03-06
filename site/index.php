<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/test.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="assets/js/login.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href=""> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

    <title>HOPE</title>
</head>

<body>


    <div class="container">

        <div class="row">

            <div class="col-lg-3">

            </div>

            <div class="col-lg-5 logoContainer">
                <a href="index.php">
                    <img class="logoImg" href="index.php" src="assets/img/logo.png" alt="">
                </a>
            </div>

            <div class="col-lg-2 " id="loginForm">

                <button type="button" class="btn btn-login">Login</button>
                <br/> 
                <form id="form-login" role="form" class="form-login" >
                    <input id="isONG" type="checkbox"> HOPE Agent?
                </br></br>
                    <div class="form-group">
                        <input type="text" id="pseudo" name="login" class="form-control" id="exampleInputEmail1" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <input type="password" id="pwd" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button id="index_submit_btn" type="" class="btn btn-submit">Submit</button>
                </form>

            </div>

            <div class="col-lg-2 " id="alreadyLoggedInForm" style="display:none;">
                <a href="/assets/html/imhere.php">Access my profile</a>
            </div>

        </div>
        <div class="row head-text">
            <div class="col-lg-12">
                <h2 class="subtitle">
                Find your relatives and keep communicating with them.
            </h2>
            </div>
        </div>
        <div class="row middle">
            <div class="col-lg-5">
                <a href="./assets/html/createaccount.php?nextStep=search" id="buttonLookFor">
                    <button type="button"  class="btn btn-main">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </br>
                        </br>
                        <span class="h3"> I am looking for ... </span>
                    </button>
                </a>
            </div>

            <div class="col-lg-2">

            </div>
            <div class="col-lg-5">
                <a href="./assets/html/createaccount.php?nextStep=iamhere" id="buttonIAmHere" >
                    <button type="button" class="btn btn-main">

                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </br>
                        </br>
                        <span class="h3"> I am here </span>

                    </button>
                </a>
            </div>
        </div>



        
    </div>
     <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <div class="footer">
                <div class="col-lg-6 footer-content-left">
                    <a class="footer-content-left" href="assets/html/Eggs/Cat_game.html"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></a>
                </div>
                <div class="col-lg-6 footer-content-right">
                    <a class="footer-content-right" href="assets/html/about.html">About</span></a>
                </div>
  </div>
</nav>

</body>

<script>

function alreadyLoggedIn() {
    $("#buttonLookFor").attr("href", "/assets/html/lookingfor.php");
    $("#buttonIAmHere").attr("href", "/assets/html/imhere.php");
    $("#loginForm").hide();
    $("#alreadyLoggedInForm").show();
}

$(document).ready(function() {

    $.ajax({
        "type": "GET",
        "url": "/core/api/api.php?type=0&method=60",
        success: function(data) {
            if (data == "1") {
                alreadyLoggedIn();
            }
        }
    })

});

</script>

</html>