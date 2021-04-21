
<!-------------------------TESTING---------------------------->



<?php
require("subheader.php");

require("cmn_booking_navbar.php");

require("lib/mod_np_booking.php");

include('lib/dbconnection.php');

$sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsp_status=1;";

$statement = $connect->prepare($sql);

$statement->execute();

$result = $statement->fetchAll();  

?>

<?php
require("subfooter.php");
?>
