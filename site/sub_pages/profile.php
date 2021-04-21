<?php 
require("subheader.php"); 
?>

<div id="change_class" class="flex_contain sec menu_sec">
  <div class="flex_itm brandin"><p></p></div>
  <div class="flex_itm menu_ite dropdown"></div>
   
   <div class="flex_itm menu_ite menu_ite_outsid"><a href="../home.php"><p>Home</p></a></div>
    <div style="margin-left: 400px; margin-top: -45px;"><a href="#" ><p>Hi, <?php if(isset($_SESSION["username"])){ echo htmlspecialchars($_SESSION["txtname"]);} ?>, Welcome to your profile</p></a></div></a>
</div>