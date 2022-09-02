jQuery(document).ready(function ($) {
    function s9ShowMessage(message, error = true) {
        $('.s9-loading').hide();
        if (message) {
            $('.s9-message').html('<div class="s9-' + (error ? "error" : "success") + '">' + replaceMessagesString(message) + '</div>');
            setTimeout(function () {
                $('.s9-message').html('');
            }, 5000);
        } else {
            window.location.href = "admin.php?page=social9_share";
        };
    }
    function replaceMessagesString(str){
        str = str.replace("loginradius", "Social9");
        str = str.replace("LoginRadius", "Social9");
        return str;
    }
    function validateEmail(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    } 
    $('#s9_manual_submit').click(function () {
        var account_id = $('#s9_account_id').val();
        var apikey = $('#s9_account_apikey').val();
        if(account_id == ""){
            s9ShowMessage("Account ID is Required field.");
            return;
        }
        if(apikey == ""){
            s9ShowMessage("API Key is Required field.");
            return;
        }
        var data = {
            'action': 'social9_get_access_token',
            'user_id': $('#s9_account_id').val(),
            'apikey': $('#s9_account_apikey').val(),
        };
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            response = JSON.parse(response);
            s9ShowMessage(response.data.Description);
        });
    });
    
    $('#s9_login_submit').click(function () {
        var email = $('#s9_login_email').val();
        var password = $('#s9_login_password').val();
        if(email == ""){
            s9ShowMessage("Email is Required field.");
            return;
        }if(!validateEmail(email)){
            s9ShowMessage("Email is not valid.");
            return;
        }if(password == ""){
            s9ShowMessage("Password is Required field.");
            return;
        }
        var data = {
            'action': 'social9_login',
            'email': email,
            'password': password,
        };
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            response = JSON.parse(response);
            s9ShowMessage(response.data.Description);
        });
    });
    $('#s9_register_submit').click(function () {
        var name = $('#s9_register_name').val();
        var email = $('#s9_register_email').val();
        var password = $('#s9_register_password').val();
        if(name == ""){
            s9ShowMessage("Name is Required field.");
            return;
        }if(email == ""){
            s9ShowMessage("Email is Required field.");
            return;
        }if(!validateEmail(email)){
            s9ShowMessage("Email is not valid.");
            return;
        }if(password == ""){
            s9ShowMessage("Password is Required field.");
            return;
        }
        var data = {
            'action': 'social9_register',
            'name': name,
            'email': email,
            'password': password,
        };
        $('.s9-loading').show();
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(s9_ajax_object.ajax_url, data, function (response) {
            //show message data has been updated and rederect to social share page
            response = JSON.parse(response);
            s9ShowMessage(response.data.Description);
        });
    });

    var lrloadInterval = setInterval(function() {
        if (typeof LoginRadiusV2 != 'undefined') {
            clearInterval(lrloadInterval);
            var commonOptions = {};
            commonOptions.apiKey = "a53c35da-a4f2-4767-8a47-4ded2174b737";
            commonOptions.appName = "social9";
            commonOptions.hashTemplate = true;

            LRObject = new LoginRadiusV2(commonOptions);

            var socialOption = {};
            socialOption.container = "interfacecontainerdiv";

            var custom_interface_option = {};
            custom_interface_option.templateName = 'loginradiuscustom_tmpl';
            LRObject.customInterface("." + socialOption.container, custom_interface_option);

            socialOption.onError = function(error) {
                console.log(error);
            };

            socialOption.onSuccess = function(response, userprofile) {
                if (response.IsPosted) {
                    //window.lr_raas_settings.sociallogin.success(response);
                } else {
                    if ((response.access_token) && (response.Profile && response.Profile.Uid)) {
                        //LRObject.documentCookies.setItem('uid', response.Profile.Uid);  
                        var data = {
                            'action': 'social9_generate_apikey',
                            'user_id': response.Profile.Uid,
                            'access_token': response.access_token,
                        };
                        $('.s9-loading').show();
                        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                        $.post(s9_ajax_object.ajax_url, data, function (response) {
                            //show message data has been updated and rederect to social share page
                            response = JSON.parse(response);
                            s9ShowMessage(response.data.Description);
                        }); 
                    }
                }
            };

            LRObject.init('socialLogin', socialOption);
        }
    }, 100);
});