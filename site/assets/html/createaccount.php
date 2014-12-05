<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="stylesheet" href="../css/lookingfor.css">


    <!-- <link rel="stylesheet" type="text/css" href=""> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->

    <title>Create an account</title>
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

        <form action="#" onSumbit="submitSubscription(); return false;">

            <div class="row middle">
                <div class="col-lg-5 ">
                    <div class="form-group form-looking">
                        
                        <div class="lookingfor">Account informations :</div>
                        <div class="form-group">
                            <input type="text" class="form-control" required id="loginInput" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" required id="passwordInput" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" required id="password2Input" placeholder="Confirm password">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" required id="emailInput" placeholder="Email">
                        </div>
                        <div class="lookingfor">I am :</div>
                        <div class="form-group">
                            <input type="text" class="form-control" required id="nameInput" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required id="firstNameInput" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <textarea name="descPhysique" class="form-control" required id="descPhysiqueInput" placeholder="Physical description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required id="phoneInput" placeholder="Phone number">
                        </div>
                    </div>
                    <div class="ajax_error_area">
                        <div class="alert alert-danger ajax-error-alert" style="display:none;" >Ajax error</div>
                    </div>
                    <button type="submit" class="btn btn-login" id="submitButton">Get Hope</button>
                    <button type="button" class="btn btn-login" id="submitButtonLoader" disabled 
                            style="display:none; background-image:url(); width:"></button>

                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <div class="lookingfor">
                            And I am there:
                        </div>
                        <div class="form-group">
                            <input type="text" id="map-form" class="form-control" required id="locationInput" placeholder="Location">
                        </div>
                    </div>
                    <div class="map-container">
                        <iframe class="map" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA-ww8bbI0RaGe1Q927-pdxRDuZ-s6Wh3c&q=Eiffel">
                        </iframe>
                    </div>
                </div>
            </div>

        </form>

        <div class="footer">
            <div class="row">
                <div class="col-lg-12">
                    CECI EST UN FOOTER
                </div>
            </div>
        </div>
    </div>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="../js/map.js"></script>

<script type="text/javascript">

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

   function submitSubscription() {
        var login = $("#loginInput").val();
        var password = $("#passwordInput").val();
        var password2 = $("#password2Input").val();
        var email = $("#emailInput").val();
        var name = $("#nameInput").val();
        var firstName = $("#firstNameInput").val();
        var descPhysique = $("#descPhysiqueInput").val();
        var phone = $("#phoneInput").val();
        var location = $("#locationInput").val();

        $(".ajax_error_area *").hide();
        $("#submitButton").hide();
        $("#submitButtonLoader").show();

        $.ajax({
            url: '/api.php?type=0&method=10',
            method: 'POST',
            data: {
                'login': login,
                'pwd1': password,
                'pwd2': password2,
                'email': email,
            },
            success: function(data, textStatus, jqXHR) {
                
                
                $.ajax({
                    url: '/api.php?type=3&method=10',
                    method: 'POST',
                    data: {
                        'name': name,
                        'forename': firstName,
                        'desc': descPhysique,
                        'phone': phone,
                        'loc': location
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (getParameterByName("nextStep") == "search") {
                            windows.location.href="";
                        } else {
                            windows.location.href="";
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $(".ajax-error-alert-profile").show(300);
                        $("#submitButtonLoader").hide();
                        $("#submitButton").show();
                    }
                });


            },
            error: function(jqXHR, textStatus, errorThrown) {
                $(".ajax-error-alert-account").show(300);
                $("#submitButtonLoader").hide();
                $("#submitButton").show();
            }
        });

   }

</script>

</html>