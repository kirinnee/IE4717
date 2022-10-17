<?php
function coffeeNameValidator($name) {
    if (preg_match("/^[a-zA-Z][^\s]*(\s*[^\s]+)*$/", $name) && strlen($name) < 64) {
        return "";
    }
    if (strlen($name) >= 64 ) {
        return "Name cannot exceed 63 characters";
    }
    
    if (preg_match("/^[^a-zA-Z].*$/", $name)) {
        return "First character can only be alphabet";
    }
    if(preg_match("/^.*\s$/", $name)) {
        return "Cannot end with space";
    }
    return "Name cannot be empty";
}

function coffeeDescriptionValidator($desc) {

    if (strlen($desc) >= 4096 ) {
        return "Description cannot exceed 4095 characters";
    }

    #

    if (preg_match("/^.*\s$/", $desc)) {
        return "Cannot end with space";
    }
    if (strlen($desc) == 0) {
        return "Description cannot be empty";
    }
    return "";
}


function coffeePriceValidator($price) {

    $arr = explode(".",$price); 

    $arrL = count($arr);
    
    if($arrL != 1 && $arrL != 2) {
        return "Only can have a single decimal point";
    }

    if($arrL == 2 && strlen($arr[1]) > 2) {
        return "Only can have 2 digit in decimal place";
    }

    if (strlen($price) == 0) {
        return "Cannot have empty price";
    }
    if(strlen($arr[0]) == 0) {
        return "Missing dollar section";
    }

    if(!preg_match("/^\d*\.?\d?\d?$/", $price)) {
        return "Needs to be in money format";
    }
    if(strlen($arr[0]) > 1 && $arr[0][0] == '0') {
        
        return "Cannot start with 0";
    }
    if(strlen($arr[0]) > 3) {
        return "Max price is $999.99";
    }

    if(preg_match("/^.*\.$/",$price)){
        return "Cannot end with .";
    }
    return "";
}
?>