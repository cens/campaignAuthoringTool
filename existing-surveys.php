<!DOCTYPE HTML>
<?php
    session_start(); 
    include('notice.php');
    require_once('authorize.php');
    authorizeUser();
?>
<html>
    <head>
        <title>Existing Surveys</title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
        <link href="css/existing-surveys.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-cookie.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/configuration.js"></script>
        <script type="text/javascript" src="js/Constant.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/surveyDisplay.js"></script>
        <script type="text/javascript" src="js/promptUtil.js"></script>
        <script type="text/javascript" src="js/existing-surveys.js"></script>
        
        <script type="text/javascript" src="js/navbar.js"></script>
        <script type="text/javascript" src="js/alerts.js"></script>
        <script type="text/javascript" src="js/help-icon.js"></script>
        <script type="text/javascript" src="js/json2xml.js"></script>
        <script type="text/javascript" src="js/campaign-editor.js"></script>
        <script type="text/javascript" src="js/breadcrumb.js"></script>
        <script type="text/javascript" src="js/vkbeautify.0.99.00.beta.js"></script>
    </head>
    <body>
        <!-- navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="navbar-container">
                    <a class="brand" href="#"><img src="img/ohmage-logo.png" width="112"></a>

                    <a href="login.html" class="logoutButton pull-right btn btn-info">Log Out</a>
                    <p class="navbar-text pull-right" id="username"></p>
                    <!--<a href="#" class="btn btn-link">About</a>-->
                    <a href="help.html" target="_blank" class="btn btn-link pull-right helpBtn">Help</a>
                    
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="boxRounded boxDark" id="campaignMenu">
                        <div class="center">
                            <h5></h5>
                            <button type="button" class="btn btn-block" id="editCampaign">Edit Campaign Info</button>
                            <button type="button" class="btn btn-block" id="createNewSurvey">Create New Survey</button>
                            <button type="button" class="btn btn-block" id="editExistingSurvey">Edit Existing Surveys</button>
                            <button type="button" class="btn btn-block" id="viewSurveyXML">View Campaign XML</button>
                            <button type="button" class="btn btn-info btn-block" id="submitCampaign">Submit Campaign to Server</button>
                        </div>
                        <?php
                            include('promptModals/viewXmlModal.php');
                        ?>

                        <div id="loginModal" class="modal hide fade" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                            <div class="modal-header centered">
                               Time Out. Please relogin
                            </div>
                            <div class="modal-body centered">
                                <div class="">
                                    <form class="form-horizontal" id="login-form">
                                        <div class="control-group centered">
                                            <label class="control-label" for="inputUsername">Username</label>
                                            <div class="controls">
                                                <input type="text" class="span3" id="inputUsername" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="control-group centered">
                                            <label class="control-label" for="inputPassword">Password</label>
                                            <div class="controls">
                                                <input type="password" class="span3" id="inputPassword" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-info">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">   
                            </div>
                        </div>

                    </div>
                </div>
                <div class="span9 content">
                    <div class="boxRounded boxDark content">
                        <h5 class="left">
                            Existing Surveys
                            <small>Reorder surveys by dragging!</small>
                        </h6>

                        <table>
                            <div class="existingSurveyss" id="existingSurveys">
                                <ul class="existingSurveysSortable" id="existingSurveysSortable">
                                </ul>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <hr>
                        <div class="pull-right">
                            <a href="#">Back to top</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
