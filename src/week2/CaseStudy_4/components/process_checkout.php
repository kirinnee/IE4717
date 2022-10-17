<?php 
require_once("./db.php");

function writeTransaction($quantity, $priceId){
    $conn = conn();
    $r = $conn->query("INSERT INTO transactions (quantity, ts, price_id) VALUES ('$quantity', CONVERT_TZ(NOW(),'SYSTEM','Asia/Singapore'), $priceId)");
    if($r) {
        $conn->close();
        return "";
    }else {
        $conn->close();
        return $conn->error;
    }
}

$error = array();

foreach($_POST as $key => $value) {
    if(preg_match("/coffee\-([\d]+)/", $key, $match)) {
        $coffeeId = $match[1];
        $priceId = $value;
        $quantity = $_POST["coffee-amount-".$coffeeId];
        $r = writeTransaction($quantity, $priceId);
        if($r != "") {
            array_push($error, $r);
        }

    }
}

if( count($error) > 0 ){
    $_SESSION['errors'] = $error;
} else {
    $_SESSION['success'] = 'true';
}

?>