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

$(document).ready(function(){
   
    
     $("#register-button").click(function(e) {
        //e.preventDefault();
        var values = $("#register-form").serialize();
        if($('#passwordinput').val() === $('#passwordconfirm').val()){
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
                        else{
                            $("#register_error_message").html("Some database error occured. Please try again!");
                        }
                    },
                    error: function()
                    {
                            $("#register_error_message").html("Registration failed. Please try again!");
                        //error message
                    }
                });
            }
            else 
            {
                $("#register_error_message").html("Passwords don't match");
            }
       // return false;
            
    });
    
    $("#forgot-passwd").one("click",function() {
        $(this).parent().parent().append('<div><input id="passwd-email" class="form-control" placeholder="yourmail@example.com" type="email" style="margin-top: 9px;"><br><center><button id="passwd-btn" type="button" style="opacity: .5;float: none;" class="close" data-dismiss="modal" aria-hidden="true">Submit</button></center><hr></div>');
        
        
        
        $("#passwd-btn").on("click",function(){
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
                
               $("#passwd-email").parent().remove();
            }
        });
    });
    
    });
    
    
});
