<?php
include_once '../databaseConn.php';
$DatabaseCo = new DatabaseConn();
$mid = $_SESSION['user_id'];
$Row1 = mysqli_fetch_object($DatabaseCo->dbLink->query("select photo1,gender from register where matri_id='" . $mid . "'"));
?>
<?php
	if ($Row1->photo1 != '' && file_exists('../my_photos/' . $Row1->photo1)) {
?> 
    <img src="my_photos/<?php echo $Row1->photo1; ?>" class="thumbnail img-responsive">
    <?php
} else {
    ?> 
    <?php $img = $_SESSION['gender123']; ?>
    <img src="img/<?= $img ?>.png" class="img-developer-larg">

    <?php
}
?>
									 