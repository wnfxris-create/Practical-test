<?php

$showBill = false;
$error = false;


//what user type in each box will given here
    $block1 = "";
    $block2 = "";
    $block3 = "";
    $block4 = "";
    $block5 = "";

    if (isset($_POST['calculate'])) {

    //get data from the form user enter
    $block1 = $_POST['block1'];
    $block2 = $_POST['block2'];
    $block3 = $_POST['block3'];
    $block4 = $_POST['block4'];
    $block5 = $_POST['block5'];

    if($block1 == "") {
        $block1 = 0; 
    }

    if($block2 == "") {
        $block2 = 0; 
    }

    if($block3 == "") {
        $block3 = 0; 
    }

    if($block4 == "") {
        $block4 = 0; 
    }

    if($block5 == "") {
        $block5 = 0; 
    }

    //VALIDATION

    //make sure it is numeric number
    if(!is_numeric($block1) ||
    !is_numeric($block2) ||
    !is_numeric($block3) ||
    !is_numeric($block4) ||
    !is_numeric($block5)
    ){
        $error = "Please enter numbers only!";
    }

    //meter reading cannot be less than zero
    else if (
        $block1 < 0 ||
        $block2 < 0 ||
        $block3 < 0 ||
        $block4 < 0 ||
        $block5 < 0 
    ){
        $error = "kwh cannot be negative number";

    }

    //each block to hold fixed amount of kwh
    else if ($block1 > 200){
        $error = "The fisrt block is only 200 kwh. Please enter 200 or less";
    }else if ($block2 > 100){
        $error = "The second block is only 100 kwh. Please enter 100 or less";
    }else if ($block3 > 300){
        $error = "The third block is only 300 kwh. Please enter 300 or less";
    }else if ($block4 > 300){
        $error = "The four block is only 300 kwh. Please enter 300 or less";
    }
    //block5 has noo limit because the tariff says 901 kwh ownwards

    //user must enter something
    else if($block1 + $block2 + $block3 + $block4 + $block5 == 0){
        $error ="Please enter your electricity usage";
    }
    
else{
    //charge for each block
    $charge1 = $block1 * 0.218;
    $charge2 = $block2 * 0.344;
    $charge3 = $block3 * 0.516;
    $charge4 = $block4 * 0.546;
    $charge5 = $block5 * 0.571;

    $totalKwh = $block1 + $block2 + $block3 + $block4 + $block5;
    $totalCharge = $charge1 + $charge2 + $charge3 + $charge4 + $charge5;

    //minimun charge
    if($totalCharge <3.00) {
       $totalCharge = 3.00;
    }

    //charge STT
    if($totalKwh > 600){
        $sst = $totalCharge * 0.06;
    }else{
        $sst = 0;
    }

    //final bill
$totalBill = $totalCharge + $sst;
    


    $showBill= true;



    }

    }