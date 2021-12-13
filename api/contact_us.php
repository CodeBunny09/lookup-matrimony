<?php
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
$site_que = $DatabaseCo->dbLink->query("select * from site_config");
$site_data = mysqli_fetch_object($site_que);
$sel_own_data=$DatabaseCo->dbLink->query("select * from cms_pages where cms_id='9'");
if (mysqli_num_rows($sel_own_data) > 0) {
	while ($contact_res = mysqli_fetch_object($sel_own_data)) {
		$string=$contact_res->cms_content;
		//$str=strip_tags($string);
		$aa= html_entity_decode($string, ENT_COMPAT, 'UTF-8'); 
		//$a=strip_tags($aa);
		$response['responseData'] = array('cms_id' => $contact_res->cms_id,'page_name' => $contact_res->page_name,'cms_title' => $contact_res->cms_title,'cms_content' =>  $aa,'status'=>"1");
}

$name=trim(ucwords($_POST['txt_name']));
		$from=$_POST['txt_email'];	  
		$mobile=$_POST['phone_no'];
		$subject1=$_POST['subject'];
		$description=$_POST['description'];
		$to =  $site_data->from_email;
		$website=$site_data->web_name;
		$webfriendlyname=$site_data->web_frienly_name;
		$subject="Contact us"; 
		$message = "<html>
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

                        <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>

                      </tr>

                    </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style='float:left;width:710px;min-height:auto'>

                        <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                           
                                            </p>
                                    <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
                                    <b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
                                    Name : ".$name.".<br/>
									Email ID : ".$from.".<br/>
									Contact No : ".$mobile.".<br/>
									Subject : ".$subject1.".<br/>
									Description : ".$description.".<br/>                                 
                                    </b></p>
                           
                            <p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'></p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>

                        </td>
                      </tr>
                    </tbody></table>
                    </body>
                    </html>
                    ";
	

$headers  = 'MIME-Version: 1.0' . "\r\n";
                          $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                          $headers .= 'From:'.$from."\r\n";
mail($to,$subject,$message,$headers);

                   
		

            
          

	$response['status'] = "1";
	$response['message'] = "Successfully";
	echo json_encode($response);
	exit;
}
else
{
	$response['status'] = "0";
	$response['message'] = "No Data Found";
	echo json_encode($response);
	
}

?>