$(document).ready(function(){
    var firstNameDefault= 'please insert your first name';
    var lastNameDefault = 'please insert your last name';
    
    //first name
    $('#form_reg #first_name').focus(function(){
        if($(this).val() == firstNameDefault){
            $('#form_reg #first_name').val('');
        }
    });
    
    $('#form_reg #first_name').blur(function(){
        if($(this).val() == ''){
            $('#form_reg #first_name').val(firstNameDefault);
        }
    });

    //last name
    $('#form_reg #last_name').focus(function(){
        if($(this).val() == lastNameDefault){
            $('#form_reg #last_name').val('');
        }
    });
    
    $('#form_reg #last_name').blur(function(){
        if($(this).val() == ''){
            $('#form_reg #last_name').val(lastNameDefault);
        }
    });
    
    $('#form_reg input[type="submit"]').click(function(){
        var corect  = true;
        var msg     = "";

        if($('#form_reg #first_name').val() == '' || $('#form_reg #first_name').val() == firstNameDefault){
            corect = false;
            msg += "Please insert your first name!\n";
        }else if($('#form_reg #first_name').val().length < 4){
            corect = false;
            msg += "Please insert a longer first name!\n";
        }

        if($('#form_reg #last_name').val() == '' || $('#form_reg #last_name').val() == lastNameDefault){
            corect = false;
            msg += "Please insert your last name!\n";
        }else if($('#form_reg #last_name').val().length < 4){
            corect = false;
            msg += "Please insert a longer last name!\n";
        }
        
        //EMAIL
        if($('#form_reg #email').val() == ''){
            corect = false;
            msg += "Please insert your email!\n";
        }
        
        //username
        if($('#form_reg #username').val() == ''){
            corect = false;
            msg += "Please insert your username!\n";
        }

        //password
        if($('#form_reg #password').val() == ''){
            corect = false;
            msg += "Please insert your password!\n";
        }

        if($('#form_reg #confirm_password').val() == ''){
            corect = false;
            msg += "Please confirm your password!\n";
        }

        //address
        if($('#form_reg #address').val() == ''){
            corect = false;
            msg += "Please insert your address!\n";
        }
        
        if(corect == false){
            jAlert(msg, "Errors");
            return false;
        }else{
           $('#form_reg').submit();
        }
        
        return false;
    }); 
});