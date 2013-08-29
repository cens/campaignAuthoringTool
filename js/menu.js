// campaign menu script
//
//

$(function() {

    // edit campaign button
    $('#editCampaign').click(function() {
        window.location = ('campaign-edit.php');
    });

    // create new survey button
    $('#createNewSurvey').click(function() {
        window.location.replace('survey.php');
    });

    // edit existing survey button
    $('#editExistingSurvey').click(function() {
        window.location.replace('existing-surveys.php');
    });

    // view campaign xml button
    $('#viewSurveyXML').click(function() {
        deleteEditField(campaignWrapper['campaign']['surveys']['survey'][$.cookie('currentSurvey')]['contentList']['']);
        var xml = '<?xml version="1.0" encoding="UTF-8"?>' + json2xml({'campaign': campaignWrapper['campaign']});
        $('#surveyXml').text(vkbeautify.xml(xml));
        $('#xmlModal').modal('show');
        

    });

    /*
    // submit campaign button
    $('#submitCampaign').click(function() {
        //alert('test');
        var xmlFile = '<?xml version="1.0" encoding="UTF-8"?>' + json2xml({'campaign': campaignWrapper['campaign']});
        // $.post("https://test.ohmage.org/app/user_info/read", { auth_token: $.cookie('authToken'), client: 'campaign-webapp' }, function(response) {
        $.post(SERVER + "app/user_info/read", { auth_token: $.cookie('authToken'), client: 'campaign-webapp' }, function(response) {
            if (response.result === 'success') {
                var classes = Object.keys(response['data'][$.cookie('username')]['classes']).join();
                 $.post("submitCampaign.php", { 
                    auth_token: $.cookie('authToken'), 
                    client: "campaign-webapp", 
                    running_state: campaignWrapper['runningState'],
                    privacy_state: campaignWrapper['privacyState'],
                    description: campaignWrapper['description'],
                    class_urn_list: campaignWrapper['classes'],
                    xml: xmlFile }, function(response) {
                    var jsonStart = response.indexOf('{');
                    var json = response.substring(jsonStart, response.length);
                    var responseJSON = JSON.parse(json);
                    if (responseJSON['result'] === 'success') {
                        alert("Campaign submitted successfully!");
                        window.location.replace('success.php');
                    } else {
                        alert("Error: " + responseJSON['errors'][0]['text']);
                    }
                }, "text");
            } else {
                //console.log('CLASS FAILURE');
                $('#loginModal').modal('show');
            }
        }, "json");
    });
    */

    var oh = oh || {};
    oh.call = function(path, data, datafun){

        /*
        function processError(errors){
            if(errors[0].code && errors[0].code == "0200"){
                var pattern = /(is unknown)|(authentication token)|(not provided)/i;
                if(!errors[0].text.match(pattern)) {
                    alert(errors[0].text);
                }
                if(!/login.html$/.test(window.location.pathname)){
                    oh.sendtologin();
                }
            } else {
                alert("Fail: " + path + ":\n" + errors[0].text)
            }
        }   
        */
        //input processing
        var data = data ? data : {};        

        //default parameter
        data.client = "dashboard"

        //add auth_token from cookie
        if($.cookie('authToken')){
            data.auth_token = $.cookie('authToken');
        }

        var myrequest = $.ajax({
            type: "POST",
            url : "https://test.ohmage.org" + "/app" + path,
            data: data,
            dataType: "text",
            xhrFields: {
                withCredentials: true
            }
        }).done(function(rsptxt) {
            //in case of json
            if(myrequest.getResponseHeader("content-type") == "application/json"){
                if(!rsptxt || rsptxt == ""){
                    alert("Undefined error.")
                    return false;
                }           
                var response = jQuery.parseJSON(rsptxt);
                if(response.result == "success"){
                    if(datafun) datafun(response)
                } else if(response.result == "failure") {
                    //processError(response.errors)
                    //var jsonStart = response.indexOf('{');
                    //var json = response.substring(jsonStart, response.length);
                    //var responseJSON = JSON.parse(json);
                    alert("Error: " + response.errors[0].text);
                    return false;
                } else{
                    alert("JSON response did not contain result attribute.")
                }
            //anything else
            } else {
                datafun(rsptxt);
            }
        }).error(function(){alert("Ohmage returned an undefined error.")});     

        return(myrequest)
    }

    $('#submitCampaign').click(function() {
        var xmlFile = '<?xml version="1.0" encoding="UTF-8"?>' + json2xml({'campaign': campaignWrapper['campaign']});

        $.post(SERVER + "app/user_info/read", { auth_token: $.cookie('authToken'), client: 'campaign-webapp' }, function(response) {
            if (response.result === 'success') {
                var req = oh.call("/campaign/create", {
                    xml : xmlFile,
                    privacy_state : campaignWrapper['privacyState'],
                    running_state : campaignWrapper['runningState'],
                    campaign_urn : campaignWrapper['campaign']['campaignUrn'],    
                    description : campaignWrapper['description'],
                    class_urn_list : campaignWrapper['classes']      
                }, function(response) {
                        //var jsonStart = response.indexOf('{');
                        //var json = response.substring(jsonStart, response.length);
                        //var responseJSON = JSON.parse(json);
                        //if (responseJSON['result'] === 'success') {
                        alert("Campaign submitted successfully!");
                        window.location.replace('success.php');
                        //} else {
                        //    alert("Error: " + responseJSON['errors'][0]['text']);
                        //}
                });
            } else {
                //console.log('CLASS FAILURE');
                $('#loginModal').modal('show');
            }
        }, "json");
    });

    // relogin
    $("#login-form").submit(function(e) {
        var $this = $(this);
        var inputUsername = $this.find("#inputUsername").val();
        var inputPassword = $this.find("#inputPassword").val();
        // $.post("https://test.ohmage.org/app/user/auth_token", { user: inputUsername, password: inputPassword, client: "campaign-webapp" }, function(response) {
        $.post(SERVER + "app/user/auth_token", { user: inputUsername, password: inputPassword, client: "campaign-webapp" }, function(response) {
            if (response.result === "success") {
                $.cookie("authToken", response.token, { expires: 1 });
                $.cookie("username", inputUsername, { expires: 1 });

                var xmlFile = '<?xml version="1.0" encoding="UTF-8"?>' + json2xml({'campaign': campaignWrapper['campaign']});
                // $.post("https://test.ohmage.org/app/user_info/read", { auth_token: $.cookie('authToken'), client: "campaign-webapp" },
                $.post(SERVER + "app/user_info/read", { auth_token: $.cookie('authToken'), client: "campaign-webapp" },
                    function(response) {
                        if(response.result === "success"){
                            /*
                            var classes = Object.keys(response['data'][$.cookie('username')]['classes']).join();
                             $.post("submitCampaign.php", { 
                                auth_token: $.cookie('authToken'), 
                                client: "campaign-webapp", 
                                running_state: campaignWrapper['runningState'],
                                privacy_state: campaignWrapper['privacyState'],
                                description: campaignWrapper['description'],
                                class_urn_list: campaignWrapper['classes'],
                                xml: xmlFile }, function(response) {
                                var jsonStart = response.indexOf('{');
                                var json = response.substring(jsonStart, response.length);
                                var responseJSON = JSON.parse(json);
                                if (responseJSON['result'] === 'success') {
                                    var successAlert = '<div class="alert alert-success createCampaignSuccess hide"><button class="close">&times;</button><strong>Campaign Submitted Successfully!</strong></div>';
                                    $(successAlert).insertAfter('.newSurvey hr').slideToggle();
                                    if($('.createCampaignSuccess').size() > 1) {
                                        $('.createCampaignSuccess').slice(1).delay('1000').slideToggle('slow',function() { $(this).alert('close')});
                                    }
                                } else {
                                    var errorAlert = '<div class="alert alert-error createCampaignError hide"><button class="close">&times;</button><strong>Error:</strong> ' + responseJSON['errors'][0]['text'] + '</div>';
                                    $(errorAlert).insertAfter('.newSurvey hr').slideToggle();
                                    if($('.createCampaignError').size() > 1) {
                                        $('.createCampaignError').slice(1).delay('1000').slideToggle('slow',function() { $(this).alert('close')});
                                    }
                                }
                            }, "text");
                            */
                            var req = oh.call("/campaign/create", {
                                xml : xmlFile,
                                privacy_state : campaignWrapper['privacyState'],
                                running_state : campaignWrapper['runningState'],
                                campaign_urn : campaignWrapper['campaign']['campaignUrn'],    
                                description : campaignWrapper['description'],
                                class_urn_list : campaignWrapper['classes']      
                            }, function(response) {
                                    //var jsonStart = response.indexOf('{');
                                    //var json = response.substring(jsonStart, response.length);
                                    //var responseJSON = JSON.parse(json);
                                    //if (responseJSON['result'] === 'success') {
                                    alert("Campaign submitted successfully!");
                                    window.location.replace('success.php');
                                    //} else {
                                    //    alert("Error: " + responseJSON['errors'][0]['text']);
                                    //}
                            });
                        } else {
                            // relogin
                            alert("Unknow error")
                        }
                    }, "json");
                $('#loginModal').modal('hide');
            }
            else {
                alert("Incorrect username or password")
            }
        }, "json");
        e.preventDefault();
    });    
});
