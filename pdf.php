<?php
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$document = new Dompdf();
$html='
	<h1>hello world !</h1>
';
//$document->loadHtml($html);
$matri_id=$_REQUEST['matri_id'];
$page=file_get_contents("admin/print_profile.php?".);
$document->loadHtml($page);
$document->setPaper('A4','landscape');
$document->render();
$document->stream("Webslession",array("Attachment" => 0));
//1 - download
//0 - preview
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<h1>hello world !</h1>
</body>
</html>