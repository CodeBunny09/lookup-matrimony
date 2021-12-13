<?php
$email='port@inlogixinfoway.com';
$from = $configObj->getConfigFrom();
$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$ToSubject = "Details";
$message =  "<html>
<head>
<title>Details </title>
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
details are - $actual_link <br/>
                                  
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
?>