<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="stylesheet" href="../css/lookingfor.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="../js/map.js"></script>



    <!-- <link rel="stylesheet" type="text/css" href=""> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

    <title>I'm Here!</title>
</head>

<body>
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

            </div>
            <a href="../../index.html">
                <div class="col-lg-5 logoContainer">
                    <img class="logoImg" href="index.html" src="../img/logo.png" alt="">
                </div>
            </a>


            <div class="col-lg-2">

            </div>

        </div>

        <div class="row middle">
            <div class="col-lg-5 ">
                <div class="form-group form-looking">

                    <div type="button" class="lookingfor">I am</div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <textarea name="descPhysique" class="form-control" placeholder="Physical description"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone number">
                    </div>
                </div>
                <div class="form-group">

                    <textarea name="Message" class="form-control" placeholder="Let a message for the people who are searching for you"></textarea>
                </div>
                <button type="button" class="btn btn-login">Submit</button>


            </div>
            <div class="col-lg-2">
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <div class="lookingfor">
                        And I am :
                    </div>
                    <div class="form-group where">
                        <input id="map-form" type="text" class="form-control" placeholder="Location">
                    </div>
                </div>
                <div class="map-container">
                    <iframe class="map" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA-ww8bbI0RaGe1Q927-pdxRDuZ-s6Wh3c&q=Eiffel">
                    </iframe>
                </div>

            </div>
        </div>

        <div class="footer">
            <div class="row">
                <div class="col-lg-12">
                    CECI EST UN FOOTER
                </div>
            </div>
        </div>
    </div>
</body>

</html>