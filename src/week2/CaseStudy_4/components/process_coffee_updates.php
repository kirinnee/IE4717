<?php
require_once("./db.php");
require("./components/server_side_validator.php");

function deleteAllPricesWithCoffeeId($id) {
    $conn = conn();
    $r = $conn->query("UPDATE prices SET deleted = 1 WHERE product_id = '$id'");
    if($r) {
        return "";
    }else {
        return $conn->error;
    }
    $conn->close();
    
}

function deleteCoffee($id) {
    # delete prices
    $pr = deleteAllPricesWithCoffeeId($id);
    if($pr == "") {
        $conn = conn();
        $r = $conn->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
        if ($r) {
            return "";
        } else {
            return $conn->error;
        }
    } else {
        return $pr;
    }
}

function deletePrice($priceId) {
    $conn = conn();
    $r = $conn->query("UPDATE prices SET deleted = 1 WHERE internalId = '$priceId'");
    if($r) {
        return "";
    }else {
        return $conn->error;
    }
    $conn->close();
}

function updatePrice($id, $name, $price) {
    $conn = conn();
    $r = $conn->query("INSERT INTO prices (name, price, internalId, version, product_id, deleted) VALUES ('$name', '$price', $id, ((SELECT MAX(version) FROM prices as p2 WHERE p2.internalId = $id)+1), (SELECT MAX(product_id) FROM prices as p3 WHERE p3.internalId = $id), 0)");
    if($r) {
        return "";
    }else {
        return $conn->error;
    }
   
    $conn->close();
}

function updateCoffee($id, $name, $desc) {
    $conn = conn();
    $r = $conn->query("UPDATE products SET name = '$name', description = '$desc' WHERE id = '$id'");
    if($r) {
        return "";
    }else {
        return $conn->error;
    }
    $conn->close();
}

function addCoffee($name, $desc) {
    $conn = conn();
    $r = $conn->query("INSERT INTO products (name, description, deleted) VALUES ('$name' , '$desc', 0)");
    if($r) {
        return array($conn->insert_id, "");
    }else {
        return array(0, $conn->error);
    }
    $conn->close();
}

function addPrices($productId, $name, $price) {
    $conn = conn();
    $r = $conn->query("INSERT INTO prices (name, internalId, version, price, deleted, product_id) VALUES ('$name', ((SELECT MAX(p2.internalId) FROM prices as p2)+1), 0, '$price', 0, '$productId')");
    if($r) {
        return "";
    }else {
        return $conn->error;
    }

    $conn->close();
}

function deleteVariants($coffeeId, $key, $value, $object) {
    if(preg_match("/^coffee\-delete\-variant\-". $coffeeId ."\-([\d]+)$/",$key, $matches)) {
        $variantId = $matches[1];
        if($value == "on") {
            $deletePriceResult = deletePrice($variantId);
            if($deletePriceResult != "" ){
                return $deletePriceResult;
            }
        }
    }
    return "";
}

function createVariants($coffeeId, $key, $value, $object) {
    if(preg_match("/^add\-coffee\-variant\-name\-". $coffeeId ."\-([\d]+)$/",$key, $matches)) {
        $variantId = $matches[1];
        $name = $value;
        $price = $object["add-coffee-price-".$coffeeId."-".$variantId];
        
        $nameValid = coffeeNameValidator($name);
        $priceValid = coffeePriceValidator($price);
        if($nameValid != "" ) {
            return $nameValid;
        }
        if($priceValid != "") {
            return $priceValid;
        }
        $createResult = addPrices($coffeeId, $name, $price);
        if($createResult != "" ){
            return $createResult;
        }
    }
    return "";
}
function updateVariants($coffeeId, $key, $value, $object) {
  
        if(preg_match("/^coffee\-variant\-name\-". $coffeeId ."\-([\d]+)$/",$key, $matches)) {
            $variantId = $matches[1];
            
            $variantName = $value;
            $price = $object["coffee-price-".$coffeeId."-".$variantId];

            # validate variant name and price
            $variantNameValid = coffeeNameValidator($variantName);
            $priceValid = coffeePriceValidator($price);
            if($variantNameValid != "" ) {
                return $variantNameValid;
            }
            if($priceValid != "") {
                return $priceValid;
            }

            $updatePriceResult = updatePrice($variantId, $variantName, $price);
            if($updatePriceResult != "" ){
                return $updatePriceResult;
            }
        }
        return "";

        
        
    return "";
}
function updateNormal($coffeeId, $object) {
    # Check if delete
    $dKey = "coffee-delete-".$coffeeId;
    
    if (isset($object[$dKey]) && $object[$dKey] == "on") {
        return deleteCoffee($coffeeId);
    } 
    $name = $object["coffee-name-" . $coffeeId];
    $desc = $object["coffee-desc-" . $coffeeId];

    # validate name and desc 
    $nameResult = coffeeNameValidator($name);
    $descResult = coffeeDescriptionValidator($desc);

    if ($nameResult != "") {
        return $nameResult;
    }
    if ($descResult != "") {
        return $descResult;
    }

    $updateResult = updateCoffee($coffeeId, $name, $desc);
    if($updateResult == "") {
        # update variants
        foreach($object as $key => $value) {
            $uR = updateVariants($coffeeId, $key, $value, $object);
            $dR = deleteVariants($coffeeId, $key, $value, $object);
            $cR = createVariants($coffeeId, $key, $value, $object);

            if ($uR != "") {
                return $uR;
            }

            if ($dR != "") {
                return $dR;
            }

            if ($cR != "") {
                return $cR;
            }
        }

    } else {
        return $updateResult;
    }

}


function process_normal($key, $value, $object) {
    if(preg_match('/^coffee\-select\-([\d]+)$/',$key, $matches)) {
        $coffeeId = $matches[1];
        if($value != "") {
            return updateNormal($coffeeId, $object);
        }
    }
    return "";
}

function addNewPrices($newId, $key, $value, $object, $productId) {
    if(preg_match('/^add\-add\-coffee\-variant\-name-'.$newId.'-([\d]+)$/',$key, $matches)) {
        $newPriceId = $matches[1];
        $name = $value;
        $price = $object["add-add-coffee-price-".$newId."-".$newPriceId];

        $nameValid = coffeeNameValidator($name);
        $priceValid = coffeePriceValidator($price);
        if($nameValid != "" ) {
            return $nameValid;
        }
        if($priceValid != "") {
            return $priceValid;
        }

        addPrices($productId, $name, $price);
    }
    return "";
}


function addNewCoffee($newId, $object) {
    $name = $object["add-coffee-name-". $newId];
    $desc = $object["add-coffee-desc-". $newId];
    # validate name and desc 
    $nameResult = coffeeNameValidator($name);
    $descResult = coffeeDescriptionValidator($desc);

    if ($nameResult != "") {
        return $nameResult;
    }
    if ($descResult != "") {
        return $descResult;
    }

    # create new Product
    $addResult = addCoffee($name, $desc);
    $productId = $addResult[0];
    $result = $addResult[1];
    if($result != "") {
        return $result;
    } else {
        foreach($object as $key => $value) {
            $r = addNewPrices($newId, $key, $value, $object, $productId);
            if($r != "") {
                return $r;
            }
        }
        return "";
    }
}


function process_add($key, $value, $object) {
    if(preg_match('/^add\-coffee\-name\-([\d]+)$/',$key, $matches)) {
        $newId = $matches[1];
        $r = addNewCoffee($newId, $object);
        if($r != "") {
            return $r;
        }
    }
    return "";
}

$errors = array();

foreach($_POST as $key => $value)
{
    $normalR = process_normal($key, $value, $_POST);
    if($normalR != "") {
         array_push($errors, $normalR);
    } 

    $addR = process_add($key, $value, $_POST);
    if($addR != "") {
        array_push($errors, $addR);
    } 
}

$_SESSION['errors'] = $errors;
?>