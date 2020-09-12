<?php
//---------------------------
 //initialise sessions

 //Define the products and cost
 $products = array("product A", "product B", "product C");
 $amounts = array("19.99", "10.99", "2.99");

 if ( !isset($_SESSION["total"]) ) {

  $_SESSION["total"] = 0;

  for ($i=0; $i< count($products); $i++) {
   $_SESSION["qty"][$i] = 0;
   $_SESSION["amounts"][$i] = 0;
 }
}
?>