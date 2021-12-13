<?php
	include_once '../databaseConn.php';
 	include_once '../lib/requestHandler.php';
    $DatabaseCo = new DatabaseConn();	
	$connection = $DatabaseCo->dbLink;


if ($_GET['action'] == "chatheartbeat") { chatHeartbeat($connection); } 
if ($_GET['action'] == "sendchat") { sendChat($connection); } 
if ($_GET['action'] == "closechat") { closeChat($connection); } 
if ($_GET['action'] == "startchatsession") { startChatSession($connection); } 
if ($_GET['action'] == "chatname") { chatName($connection); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}

function chatHeartbeat($connection) {
	$sql = "select register.username,register.gender,register.photo1,chat.user_from,chat.message,chat.user_to,chat.id,chat.sent,chat.recd from chat,register where (chat.user_to = '".mysqli_real_escape_string($connection,$_SESSION['chatuser'])."' AND recd = 0) and chat.user_from=register.index_id  order by id ASC";
	
	$query = mysqli_query($connection,$sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysqli_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['user_from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}
		
		$chat['message'] = sanitize($chat['message']);
		
		if($chat['photo1']=='')
		{
			 if($chat['gender']=='Groom')
			 {
			 $chat['photo1']="male_small.png";
			 } 		
			 else
			 {
			 $chat['photo1']= "female_small.png";
			 }	
			 		
		}
		

		$items .= <<<EOD
					   {
			"s": "0",
			"u": "{$chat['username']}",
			"ph": "{$chat['photo1']}",
			"f": "{$chat['user_from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['user_from']])) {
		$_SESSION['chatHistory'][$chat['user_from']] = '';
	}

	$_SESSION['chatHistory'][$chat['user_from']] .= <<<EOD
						   {
			"s": "0",
			"u": "{$chat['username']}",
			"f": "{$chat['user_from']}",
			"ph": "{$chat['photo1']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['user_from']]);
		$_SESSION['openChatBoxes'][$chat['user_from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.user_to = '".mysqli_real_escape_string($connection,$_SESSION['chatuser'])."' and recd = 0";
	$query = mysqli_query($connection,$sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession($connection) {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
/*
$suser=$_SESSION['chatuser'];
$sc=mysql_query("select username from register where username='$su'");
while($row_sc=mysql_fetch_array($sc))
{
$_SESSION['current_chat_username']=$row_sc['username'];
}*/
?>
{
		"username": "<?php echo $_SESSION['chatuser'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php
	exit(0);
	
}

function chatName($connection) 
{
	$un = '';
	
$su=$_GET['usw'];


$sc2=mysqli_query($connection,"select username from register where index_id='$su' limit 1");
while($row_sc2=mysqli_fetch_array($sc2))
{
$un=$row_sc2["username"];
}
?>
{
		"unm": ["<?php echo $un;?>"]
		
}

<?php


	exit(0);
}



function sendChat($connection) {
	
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	
	
	$from = $_SESSION['chatuser'];
	$to = $_POST['to'];
	$message = $_POST['message'];
	$sql = "select register.username from register where register.index_id='$from' limit 1";
	$uname = mysqli_query($connection,$sql);
	$from_user='';
	while ($un = mysqli_fetch_array($uname)) {
	$from_user=$un['username'];
	}
	
	
	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}

	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"u": "{$from_user}",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$_POST['to']]);
	
	mysqli_query($connection,"UPDATE online_users SET dt='$date' WHERE index_id=".$from);

	$sql = "insert into chat (chat.user_from,chat.user_to,message,sent) values ('".mysqli_real_escape_string($connection,$from)."', '".mysqli_real_escape_string($connection,$to)."','".mysqli_real_escape_string($connection,$message)."','$date')";
	$query = mysqli_query($connection,$sql);
	echo "1";
	
	
	
	
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}
?>
