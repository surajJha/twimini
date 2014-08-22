/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




/*
 *  THis file contains JS code for Login page 
 *  login and registration etc....
 * 
 */

$(document).ready(function() {

    // Registration scenario============================================================================
    $("#register-button").click(function(e) {
        //e.preventDefault();
        var values = $("#register-form").serialize();
        // if ($('#passwordinput').val() === $('#passwordconfirm').val()) {
        $.ajax(
                {
                    type: 'POST',
                    url: 'http://localhost/twimini/index.php/loginController/register',
                    cache: false,
                    data: values,
                    success: function(response)
                    {
                        console.log(response);
                        if (response === "success")
                        {

                            $("#mcqModalForm").trigger('reset');
                            $("#register_success_message").html("You have successfully registered to Twimini. Please login to continue");

                        }
                        else {
                            $("#register_error_message").html("Some database error occured. Please try again!");
                        }
                    },
                    error: function()
                    {
                        $("#register_error_message").html("Registration failed. Please try again!");
                        //error message
                    }
                });
        //}
        // else
        // {
        //     $("#register_error_message").html("Passwords don't match");

        //  }
        //return false;

    });

    // function for resetting the registration form and clearing out all error or success 
    // messages from the modal
    $(".close-modal").on("click", function() {
        $('#register-form')[0].reset();
        $("#register_success_message").html("");
        $("#register_error_message").html("");

    })

    //=====================================VALIDATIONS============================================== 
    // functions for registration form validation==========================
    var name_status = false;
    var handle_status = false;
    var email_status = false;
    var pwd_status = false;
    var pwd_confirm_status = false;
    $("#name-warning").hide();
    $("#name").on("blur", function() {
        // alert($("#name").text().length);
        if ($("#name").val().length <= 0) {
            $("#name-warning").show(300);
        }
        else {
            $("#name-warning").hide(300);
            name_status = true;
        }
    });

    // HANDLE VALIDATION===========================================
    $("#handle-warning").hide();
    $("#handle").on("blur", function() {
        // alert($("#name").text().length);
        if ($("#handle").val().length <= 0) {
            $("#handle-warning").text("field length should be greater than 0");
            $("#handle-warning").show(300);
        }
        else {
            var handle = $("#handle").val();
            console.log(handle);
            var valid = checkHandle(handle);
            console.log(valid);
            if (valid === "failure") {
                // show cannot use handle message
                $("#handle-warning").text("This handle already exist. Please choose another handle");
            }
            else {
                // allowed to use the handle
                $("#handle-warning").hide(300);
                handle_status = true;
            }

        }
    });

    function checkHandle(handle) {
        $.ajax(
                {
                    type: 'POST',
                    url: 'http://localhost/twimini/index.php/formValidationController/checkHandle',
                    data: handle,
                    cache: false
                }).done(function(msg, status, XHR) {
            if (msg === "falure")
            {
                $("#passwd-email").parent().parent().append('<div style="color: darkseagreen;font-weight: 800;text-align: center;padding-top: 8px;padding-bottom: 8px;">A change password link has been sent to you by e-mail.</div>');
                $("#passwd-email").parent().remove();

            }
        });

    }
    // password validation========================================
    $("#password-warning").hide();
    $("#passwordinput").on("blur", function() {
        // alert($("#name").text().length);
        if ($("#passwordinput").val().length <= 3) {
            $("#password-warning").show(300);
        }
        else {
            $("#password-warning").hide(300);
            pwd_status = true;
        }
    });
    //  CONFIRM PASSWORD CHECK
    $("#password-confirm-warning").hide();
    $("#passwordconfirm").on("blur", function() {
        // alert($("#name").text().length);
        if ($("#passwordinput").val() != $("#passwordconfirm").val()) {
            $("#password-confirm-warning").show(300);
        }
        else {
            $("#password-confirm-warning").hide(300);
            pwd_confirm_status = true;
        }
    });

    // VALIDATE EMAIL=========================================

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);

        $("#email-warning").hide();
        $("#emailinput").on("blur", function() {
            // alert($("#name").text().length);
            if ($("#passwordinput").val().length <= 3) {
                $("#password-warning").show(300);
            }
            else {
                $("#password-warning").hide(300);
                pwd_status = true;
            }
        });
    }
    //================================================================================================= 
    // function for handling forgot password scenario===============================================================================

    $("#forgot-passwd").one("click", function() {
        $(this).parent().parent().append('<div><input id="passwd-email" class="form-control" placeholder="yourmail@example.com" type="email" style="margin-top: 9px;"><br><center><button id="passwd-btn" type="button" style="opacity: .5;float: none;" class="close" data-dismiss="modal" aria-hidden="true">Submit</button></center><hr></div>');



        $("#passwd-btn").on("click", function() {
            var email = {'email': $('#passwd-email').val()};
            $.ajax(
                    {
                        type: 'POST',
                        url: 'http://localhost/twimini/index.php/sendEmailController/sendEmail',
                        data: email,
                        cache: false
                    }).done(function(msg, status, XHR) {
                if (msg === "success")
                {
                    $("#passwd-email").parent().parent().append('<div style="color: darkseagreen;font-weight: 800;text-align: center;padding-top: 8px;padding-bottom: 8px;">A change password link has been sent to you by e-mail.</div>');
                    $("#passwd-email").parent().remove();

                }
            });
        });

    });


});
