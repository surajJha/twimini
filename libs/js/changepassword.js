$(document).ready(function(){
   
    
     $("#passwd-btn").click(function(e) {
        e.preventDefault();
        var values = $("#password-form").serialize();
        if($('#passwordinput').val() === $('#passwordconfirm').val()){
        $.ajax(
                {
                    type: 'POST',
                    url: 'http://localhost/twimini/index.php/changePasswordController/change',
                    cache: false,
                    data: values,
                    success: function(response)
                    {
                        console.log(response);
                        if (response === "success")
                        {
                            $("#password-form").append('<div class="alert alert-success" id="password_success_message" style="margin-top:20px;">You have successfully changed your password</div><br><div>Click <a href="http://localhost/twimini/index.php/homeController">here</a> to go back to Login page</div>');
                            
                        }
                        else{
                            $("#password-form").append('<div class="alert alert-warning" id="password_error_message" style="margin-top:20px;">Some database error occured. Please try again!</div>');
                        }
                    },
                    error: function()
                    {
                            $("#password-form").append('<div class="alert alert-warning" id="password_error_message" style="margin-top:20px;">Password change failed. Please try again!</div>');
                        //error message
                    }
                });
            }
            else 
            {
                $("#password-form").append('<div class="alert alert-warning" id="password_error_message" style="margin-top:20px;">Passwords don\'t match</div>');
            }
       // return false;
            
    }); 
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


