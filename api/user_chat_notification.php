<?php
$t = $_POST["tokan"];
$msg = $_POST['msg'];
$title = $_POST['title'];
$id=$_POST['id'];
function sendMessage($data, $t){
    //FCM api URL
    $url = 'https://fcm.googleapis.com/fcm/send';
    
    if (!defined('KEY_VALUE')){
        define('KEY_VALUE', 'AAAAjDAt2gQ:APA91bFKEio7FCLF_eFhga7KB1WJmLJdOYYbNQv3POhi1qcNqk4WfwHojOamrqbconcr0ffJ22S0G6TIJma07GFqo5CrqjUqQgquAQwlsEQDFHAStr7ougjY1vsVTCDjU6WbPAucA0Lz');
    
    $fields         = array();
    $fields['data'] = $data;
    $fields['to']   = $t;
    
    //header with content_type api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key=' . KEY_VALUE
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
	}
}
$data = array(
    'msg' => $msg,
	'title' => $title,
	'id' => $id
);
echo json_encode($data);
sendMessage($data, $t);
//echo "success";
sendMessage('New Message Received',$t,'New Message','206');
sendMessage('New Express Interest Received',$t,'New Interest','202');
?>
<?php
/*define('AIzaSyAaV99ibmF_wP4AACpNbhbUwmlCBYDjYjE','AIzaSyCtc39gsrl_hxQAmUQMIvwfZ5nd81rjheA');
 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 $token='eGboWbM-KIA:APA91bE3BpWWKeviepTNAKB1WuCkl21TBOAp4BuuC80SCHfWf5fjZQuLDMElJMSaON-M3-kHIDhxNxYrh7hmOc4p4-3lTXUH-7vFPXzyM91z2_SMwMvcZxsHurC00bz-9TJwcmXY6wTX';

    $notification = [
            'title' =>'title',
            'body' => 'body of message.',
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        echo $result;*/
?>