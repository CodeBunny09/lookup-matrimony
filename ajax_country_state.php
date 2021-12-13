<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './class/Location.class.php';
$DatabaseCo = new DatabaseConn();
$country_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$_SESSION['country_code'] = $country_id;
if ($country_id != '') {
    ?>
    <option value="">Select State</option>
    <?php
    $SQL_STATEMENT_state = $DatabaseCo->dbLink->query("SELECT * FROM state_view WHERE cnt_id='$country_id' and status='APPROVED' ORDER BY state_name ASC");
    while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_state)) {
        ?>
        <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>"><?php echo $DatabaseCo->dbRow->state_name; ?></option>
    <?php } ?>
    <?php
}
if (isset($_REQUEST['state_id'])) {
    ?>
<option value="">Select City</option>
    <?php
    $SQL_STATEMENT_city = $DatabaseCo->dbLink->query("SELECT * FROM city_view WHERE cnt_id='" . $_REQUEST['country_id'] . "' AND state_id='" . $_REQUEST['state_id'] . "' and status='APPROVED' ORDER BY city_name ASC");
    while ($DatabaseCo->dbRow = mysqli_fetch_object($SQL_STATEMENT_city)) {
        ?>
                <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name ?></option>
    <?php } ?>

    <?php
}
?>
