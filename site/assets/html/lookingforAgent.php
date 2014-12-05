<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="stylesheet" href="../css/lookingfor.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="requete.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href=""> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

    <title>I'm looking for</title>
</head>

<body>
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

            </div>

            <div class="col-lg-5 logoContainer">
                <a href="../../index.php">
                <img class="logoImg" href="index.html" src="../img/logo.png" alt="">
            </a>
            </div>


            <div class="col-lg-2">

            </div>

        </div>

        <div class="row middle">
            <div class="col-lg-5 ">
                <div class="form-group form-looking">

                    <div  type="button" class="lookingfor">I'm looking for</div>
                    <div class="form-group">
                        <input id= "form_name" type="text" class="form-control" placeholder="Name">
                    </div>
                    <div  class="form-group">
                        <input id= "form_surname" type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <textarea id= "form_desc" name="descPhysique" class="form-control" placeholder="Physical description"></textarea>
                    </div>
                    <div class="form-group">
                        <input id= "form_phonenumber" type="text" class="form-control" placeholder="Phone number">
                    </div>
                </div>
                <button type="button" class="btn btn-login" id="form_submit">Submit</button>

            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    And he should be there :
                    <div class="form-group">
                        <input id= "form_location" type="text" class="form-control" placeholder="Location">
                    </div>
                </div>
                MAP
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="col-lg-2"></div>
                <div class="col-lg-7">
                    <textarea id= "form_message" name="Message" class="form-control" placeholder="Let a message for the person you are searching for"></textarea>
                </div>
            </div>
        </div>
        <div id="result">

        </div>
        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <div class="footer">
                <div class="col-lg-12 footer-content">
                    <a class="footer-content" href="assets/html/Eggs/Cat_game.html"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span></a>
                </div>
  </div>
</nav>

    </div>
    </br>

</body>

</html>