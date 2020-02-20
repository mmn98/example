<?php
//session_start();

include_once '../../includes/config.php';
include_once '../../classes/auth.class.php';

$auth = new Auth();

	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'logout')
	{
		$auth->logout();
		header('Location:'.ADMIN_URL);
		exit();
	}

	if ($auth->is_loggedin()=="true")
	{
        $role = $_SESSION['role'];
        echo $role;
        if($role == "admin")
        {
		header('Location:'.BASE_URL.'admin/dashboard/');
        exit();
        }
        if($role == "user")
        {
            header('Location:'.BASE_URL.'user/display.php');
            exit();
        }
    }

	$err_msg = '';

	if (isset($_REQUEST['submit']))
	{

        if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) 
        {
            
            //echo "captcha matched";

            $email    = $_REQUEST['email'];
            $password = md5($_REQUEST['password']);
            $remember = (isset($_REQUEST['remember'])) ? 1 : 0;

            $login = $auth->login($email, $password, $remember);

            switch ($login['response'])
            {
                case 'incorrect_password':
                    $err_msg = 'Wrong Password';
                    break;

                case 'wrong_email':
                    $err_msg = 'Wrong Email';
                    break;

                case 'user_role':
                    echo  'user role';
                    header('Location:'.BASE_URL.'user/display.php');
                    exit();
                    break;

                case 'success':
                    header('Location:'.BASE_URL.'admin/dashboard/');
                    exit();
                    break;

                default:
                    $err_msg = '';
                    break;
            }
            error_log("$err_msg",0);
        }
        else
        {
            $err_msg = "Incorrect Captcha Code";
            error_log("$err_msg",0);
        }
    }

?>





<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sample Admin Panel | Admin Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo BASE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
        <section class="content">
           
            <div class="row">
                <div class="col-lg-offset-4 col-lg-4">
                    <section class="panel">

                        <header class="panel-heading">
                            <h2>Admin Login</h2>
                        </header>

                        <div class="panel-body">
                            <form id="myform" name="myform" class="form-horizontal" method="POST" action="">
                               <div class="form-group">
                                    <p style="color:red;"><?php echo $err_msg; ?></p>
                                </div> 

                                <div class="form-group">
                                    <label for="email" class="col-lg-2 col-sm-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="email"  name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-lg-2 col-sm-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                       <div> <img src="captcha_code.php" style="margin-left:150px;size:30px" /></div><br>
                                        <label for="captcha_code"  class="col-lg-2 col-sm-2 control-label">captcha</label>
                                        <div class="col-lg-10">
                                            <input name="captcha_code" id="captcha_code" type="text" class="form-control" placeholder="please enter captcha"> 
                                        </div>                               
                                </div>

                                <div class="checkbox">                                 
                                        <label for="remember">Remember Me</label>
                                        <input type="checkbox" name="remember" id="remember">
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" name="submit" value="submit" class="btn btn-danger">Sign in</button>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <span ><a href="forgotpassword.php">Forgot password?</a></span>
                                      <!--  <span style="margin-left:150px"><a href="register.php">Register Here</a></span> -->
                                    </div>                                    
                                </div>
                               

                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>
</html>

<script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script>
     $("#myform").validate({
   rules: {

        captcha_code : {
            required: true,
        },
        email : {
            required: true,
            email: true,
            
        },
        password: {
        required: true  ,
        minlength: 2
        }
   },
   messages: {

    captcha_code : {
            required: "captcha must be entered"
        },
        email: {
        required: "We need your email address to contact you",
        email: "Your email address must be in the format of name@domain.com"
        },
        password: {
        required: "password must be entered",
        minlength: "password include atleast 2 characher"
        }
   }

 });
</script>