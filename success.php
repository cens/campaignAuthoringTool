<!DOCTYPE HTML>
<?php
    session_start(); 
    include('notice.php');
    require_once('authorize.php');
    authorizeUser();
?>
<html>
    <head>
        <title>Congratulation</title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery-ui-1.9.1.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/jquery.powertips.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-cookie.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="js/menu.js"></script>  
        <script type="text/javascript" src="js/navbar.js"></script>
        <script type="text/javascript" src="js/alerts.js"></script>
        <script type="text/javascript" src="js/help-icon.js"></script>
        <script type="text/javascript" src="js/success.js"></script>
                      
    </head>
    <body>
        <?php
            include('navbar.php');
            require_once('authorize.php');
        ?>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="boxRounded boxDark content">
                        <h3 class="centered red">Congratulation! </h3> 
                        <h5 class="centered"> Your campaign was successfully submitted to the server. You can either log out or create a new campaign. </h5>
                        <div class="centered">
                            <button type="button" class="btn btn-small btn-info centered createCampaign" id="createCampaign">Create New Campaign</button>
                            <a href="index.php" class="logoutButton btn btn-small btn-info">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include('footer.php');
        ?>
    </body>
</html>

