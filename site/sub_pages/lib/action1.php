<!-------------------------TESTING---------------------------->


<?php
include('dbconnection.php');

if(isset($_POST["action"]))
{
  if($_POST["action"] == 'Save')
  {
    $data = array(
      ':name'  => $_POST["txt_npname"],
      ':qty'   => $_POST["txt_npqty"]
    );

    $sql = "INSERT INTO tbl_sample_data (newsp_id,sample_qty) VALUES (:name, :qty)";

    $statement = $connect->prepare($sql);
    if($statement->execute($data))
    {
      echo 'Data Inserted';
    }
  }
}
 ?>