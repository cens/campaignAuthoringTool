<!DOCTYPE HTML>
<?php
    session_start(); 
    include('notice.php');
    require_once('authorize.php');
    authorizeUser();
?>
<html>
    <head>
        <title>Create Campaign</title>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
        <link href="css/campaign.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-cookie.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/json2xml.js"></script>
        <script type="text/javascript" src="js/jquery.xml2json.js"></script>
        <script type="text/javascript" src="js/alerts.js"></script>
        <script type="text/javascript" src="js/navbar.js"></script>
        <script type="text/javascript" src="js/campaign.js"></script>
        <script type="text/javascript" src="js/help-icon.js"></script>
        <script type="text/javascript" src="js/campaign-editor.js"></script>
    </head>
    <body>
        <!-- navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="navbar-container">
                    <a class="brand" href="#"><img src="img/ohmage-logo.png" width="112"></a>

                    <a href="index.php" class="logoutButton pull-right btn btn-info">Log Out</a>
                    <p class="navbar-text pull-right" id="username"></p>
                    <!--<a href="#" class="btn btn-link">About</a>-->
                    <a href="help.php" target="_blank" class="btn btn-link pull-right helpBtn">Help</a>
                    
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="span12 content">
                    <div class="boxRounded boxDark">
                        <h4>Campaign Editor <small>Create a new campaign info, or edit an existing one.</small></h4>
        
                        <div class="new-campaign">
                            <form class="form-horizontal" id="campaign-form" action="survey.php">
                                <h5>Campaign Info </h5>
                                <div class="control-group">
                                    <label class="control-label" for="campaignTitle">Campaign Name <span class="red">*</span></label>
                                    <div class="controls">
                                        <input type="text" class="span5" id="campaignTitle" placeholder="Campaign Name" />
                                        <i class="help-icon icon-question-sign" data-original-title="A name to be displayed to the user for this campaign." rel="tooltip" data-placement="right"></i>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="campaignUrn">Campaign Urn <span class="red">*</span></label>
                                    <div class="controls">
                                        <input type="text" class="span5" id="campaignUrn" placeholder="Campaign Urn" />
                                        <i class="help-icon icon-question-sign" data-original-title="Every campaign in the system must have a unique URN, and it is best practice to name this in such a way that it can easily be traced back to the creator, for example: 'urn:campaign:text:describing:author:version'" rel="tooltip" data-placement="right"></i>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="campaignDescription">Description</label>
                                    <div class="controls">
                                        <textarea type="text" class="span5" id="campaignDescription" placeholder="Description"> </textarea>
                                        <i class="help-icon icon-question-sign" data-original-title="Optional campaign description that can be viewed through Ohmage main page" rel="tooltip" data-placement="right"></i>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="classes">Classes <span class="red">*</span></label>
                                    <div class="controls">
                                        <!--
                                        <input type="text" class="span4" id="classes" placeholder="Classes" />
                                        <i class="help-icon icon-question-sign" data-original-title="Classes that use this campaign" rel="tooltip" data-placement="right"></i>
                                    -->
                                        <select class="classes"></select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="authors">Authors </label>
                                    <div class="controls">
                                        <input type="text" class="span5 authors" id="authors" disabled/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="privacyState">Privacy State <span class="red">*</span></label>
                                    <div class="controls">
                                        <!--<button type="button" class="btn btn-info" id="privacyStateBtn">Shared</button>-->
                                        <select id="privacyStateBtn" name="privacyStateBtn" class="privacyStateBtn">
                                            <option value="shared">Shared</option>
                                            <option value="private">Private</option>
                                        </select>
                                        <i class="help-icon icon-question-sign" data-original-title="In private mode, individual responses cannot be viewed." rel="tooltip" data-placement="right"></i>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="runningState">Running State <span class="red">*</span></label>
                                    <div class="controls">
                                        <!--<button type="button" class="btn btn-info" id="runningStateBtn">Running</button>-->
                                        <select id="runningStateBtn" name="runningStateBtn" class="runningStateBtn">
                                            <option value="running">Running</option>
                                            <option value="stopped">Stopped</option>
                                        </select>
                                        <i class="help-icon icon-question-sign" data-original-title="Users can only upload responses on running campaigns. This can be updated once you submit your campaign." rel="tooltip" data-placement="right"></i>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" id="create-campaign" class="btn"><i class="icon-plus icon-black"></i> Create Campaign </button>
                                    </div>
                                </div>
                            </form>
                            <span class="red">*</span> <small>Required Fields</small>
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
