<?php
/* Below function is used to insert new Advertisment Booking details to the tbl_booking */

function addNewAdBooking(){
  session_start();

  var ad_img = $("#imgad").val();
  var nic_img = $("#imgupnic").val();
  var br_img = $("#imgupbr").val();

  $cus_id = $_SESSION['session_cus']['cus_id'];  
  $cusname = $_POST["cusname"];
  $mob_number = $_POST["txt_mob"];
  $npname = $_POST["txt_npname"];
  $adpub_date = $_POST["dtadpublish"];
  $ad_mode = $_POST["txt_npadmode"];
  $ad_colour = $_POST["txt_npadcolour"];
  $ad_size = $_POST["txt_npadsize"];
  $ad_cat = $_POST["txt_npadcat"];
  $adcat_des = $_POST["txt_npadcatdes"];
  $ad_description = $_POST["txtaddress"];
  $word_count = $_POST["txt_wc"];

  $tot_price = $_POST["tot_price"];
  $crnt_date = date("Y-m-d");

/*  if(isset($_POST["ck_glz"])){
    $ck_glz = $_POST["ck_glz"];
  }else{
    $ck_glz=0;
  }

  if(isset($_POST["ck_mini"])){
    $ck_mini = $_POST["ck_mini"];
  }else{
    $ck_mini = 0;
  }       
          
  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_booking(cus_id,grm_name,brd_name,mob_number,crnt_date,wed_date,pgrapher_id,wed_time,shoot_area,location,add_msg,pgrapghy_pkg,tnq_cards,albm_size,gls_cov,mini_albm,tot_price) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

      $stmt = $dbobj->prepare($sql);
      $stmt->bind_param("issississsssssiid",$cus_id,$grmname,$brdname,$mobile,$crnt_date,$dtwedd,$cmbpg_id,$bg_time,$st_area,$txtloction,$txtmsg,$pg_pkg,$tnq_card,$albm_size,$ck_glz,$ck_mini,$tot_price);

        if(!$stmt->execute()){
        echo("0,SQL Error : ".$stmt->error);
        }
        else{

        echo("1,Successfully Reserved!");
        }

        $stmt->close();
        $dbobj->close();
                
}*/
//------------------------------------recheck------------------------------//
    $img_name1 = $_FILES['imgad']['name'];
    $img_size = $_FILES['imgad']['size'];
    $img_type = $_FILES['imgad']['type'];
    $img_tmp_name = $_FILES['imgad']['tmp_name'];         //recheck until here 

                                                      /*to take 3 type of images  take "For loop"*/
     
     #substr display part after specific point
     #strrpos - finds the position numbers of the last occurrence
     $ext = substr($img_name1, strrpos($img_name1, "."));
     # $ext is file extenstion
     # convert to lower case
     $txt = strtolower($ext);

     if($img_name1== ""){
         echo (",Please Select the image");
         exit;
     }
     if($img_size>2097152 || $img_size==0){
         echo("0,Image size must be less than 2MB");
         exit;
     }
     if($ext!=".jpg" && $ext!=".png" && $ext!=".gif" & $ext!=".JPG"){
         echo("0,Image file size should be either jpg png or gif");
         exit;
     }
     $nic_path = "../../images/nic_images/$cus_id";
     $br_path = "../../images/br_images/$cus_id";
     $img_path = "../../images/ad_images/$cus_id";
     if(!file_exists($nic_path)){
         mkdir($nic_path);
     }
     if(!file_exists($br_path)){
         mkdir($br_path);
     }
     if(!file_exists($img_path)){
         mkdir($img_path);
     }

     $fname1 = $cus_id.time().$ext;
     $fpath1 = $nic_path."/".$fname1;
     $imgpath1 = $cus_id."/".$fname1;


     $fname2 = $cus_id.time().$ext;
     $fpath2 = $br_path."/".$fname2;
     $imgpath2 = $cus_id."/".$fname2;


     $fname3 = $cus_id.time().$ext;
     $fpath3 = $img_path."/".$fname3;
     $imgpath3 = $cus_id."/".$fname3;

     if(move_uploaded_file($img_tmp_name, $fpath)){
         $dbobj = DB::connect();
         $sql = "INSERT INTO tbl_products (prod_id,prod_name,prod_modal,prod_color,desc_id,prod_price ,prod_dprice,prod_rlevel,prod_img,cat_id) VALUES('$prod_id','$prod_name','$prod_modal','$prod_color','$prod_id','$prod_price', '$discount_price','$prod_rlevel','$imgpath','$cat_id');";


         $stmt = $dbobj->prepare($sql);
         if(!$stmt->execute()){
             unlink($fpath);
             echo("0,SQL Error, Please try again:".$stmt->error);
         }else{
             $sql2 = "INSERT INTO tbl_prod_desc(desc_id,prod_desc,capacity,voltage,power,tank_capacity,material,dimension,contains,stage_pp,stage_cto,stage_post,stage_ro,stage_udf,stage_min,warr_id) VALUES('$prod_id','$prod_desc','$prod_capacity','$prod_voltage','$prod_power','$prod_tank' ,'$prod_material','$prod_dimension','$prod_contains','$pp','$cto','$post','$ro','$udf','$mineral','$warranty_type');";

             $stmt2 = $dbobj->prepare($sql2);

             if (!$stmt2->execute()){
                 echo("0,SQL Error, Please try again:".$stmt2->error);
             }else{
                 echo ("1,Successfully Saved!");
             }
            $stmt2->close();

         }
         $stmt->close();
         $dbobj->close();
     }else{
         echo("0,Image Uploading Error");
     }
