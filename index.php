<?php error_reporting(0);?>
<html>
    <head>
        <title>Registration</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery.alerts-1.0.css" media="screen" />
        <script type="text/javascript" src="js/jquery.alerts-1.0.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
    </head>
    <body>
        <?php
        if(!empty($_POST)){
            require_once('functions.php');

            $errors         = array();
            $validatorObj   = new Validator($_POST);
            $validatorObj->validate();
            if($validatorObj->getIsValid()){
                // create user object for OOP manipulation
                $userObj = new User($_POST);

                // save user object data into DB
                $dbObj = new Db(array('host'=>'localhost', 'user'=>'root', 'password'=>'', 'db_name'=>'test'));
                $dbObj->connect();
                $saved = $dbObj->save($userObj);
            }else{
                $errors = $validatorObj->getErrors();
            }
        }
        ?>
        <h3>Registration</h3>
        <?php if(!empty($errors)):?>
            <p>Please correct the following errors:</p>
            <p class="error">
                <?php 
                if(is_array($errors)):
                    foreach($errors as $val):
                        echo $val.'<br />';
                    endforeach;
                endif;
                ?>
            </p>
        <?php elseif(!empty($saved) && $saved == true):?>
            <p class="success">Thank you!</p>
            <?php $_POST = array();?>
        <?php endif;?>
        <form id="form_reg" action="" method="post">
            <table>
                <tr>
                    <td>First name* :</td>
                    <td><input type="text" name="first_name" id="first_name" value="<?php if(!empty($_POST['first_name'])):?><?php echo $_POST['first_name']?><?php else:?>please insert your first name<?php endif;?>" /></td>
                </tr>
                <tr>
                    <td>Last name* :</td>
                    <td><input type="text" name="last_name" id="last_name" value="<?php if(!empty($_POST['last_name'])):?><?php echo $_POST['last_name']?><?php else:?>please insert your last name<?php endif;?>" /></td>
                </tr>
                <tr>
                    <td>Email* :</td>
                    <td><input type="text" name="email" id="email" value="<?php if(!empty($_POST['email'])):?><?php echo $_POST['email']?><?php endif;?>" /></td>
                </tr>
                <tr>
                    <td>Username* :</td>
                    <td><input type="text" name="username" id="username" value="<?php if(!empty($_POST['username'])):?><?php echo $_POST['username']?><?php endif;?>" /></td>
                </tr>
                <tr>
                    <td>Password* :</td>
                    <td><input type="password" name="password" id="password" value="<?php if(!empty($_POST['password'])):?><?php echo $_POST['password']?><?php endif;?>" /></td>
                </tr>
                <tr>
                    <td>Confirm password* :</td>
                    <td><input type="password" name="confirm_password" id="confirm_password" value="<?php if(!empty($_POST['confirm_password'])):?><?php echo $_POST['confirm_password']?><?php endif;?>" /></td>
                </tr>
                <tr>
                    <td>Address* :</td>
                    <td><textarea name="address" id="address"><?php if(!empty($_POST['address'])):?><?php echo $_POST['address']?><?php endif;?></textarea>
                </tr>
                <tr><td colspan="2" class="note">*)mandatory fields</td></tr>
                <tr><td colspan="2"><input type="submit" class="submit" value="Register" /></td></tr>
            </table>
        </form>
	</body>
</html>