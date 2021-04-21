<!-------------------------TESTING---------------------------->
<?php

require("lib/dbconnection.php");


$sql = "SELECT newsp_id,sample_qty FROM tbl_sample_data ORDER BY sample_id DESC";

$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$total_row = $stmt->rowCount();
$output = '';
if($total_row > 0)
{
	foreach ($result as $row) {
		$output .= '
		<tr>
			<td>'.$row["txt_npname"].'</td>
			<td>'.$row["txt_npqty"].'</td>
			<td><input type="button" class="btn btn-success" id="btnedit" name="btnedit" value="Edit"></td>
            <td><input type="button" class="btn btn-danger" id="btncancel" name="" value="Cancel"></td>
        </tr>
        ';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="3" align="center">Data not found</td>
	</tr>
	';
}
echo $output;
?>