<?php 
require_once("./db.php");
require("./components/coffee.php");

$conn = conn();
$r = $conn->query("SELECT products.id as id, p.id as price_id, p.internalId as price_internal_id, p.version as version, products.name as name, p.name as variant, p.price as price, products.description as `desc` FROM products JOIN prices as p ON p.product_id = products.id WHERE products.deleted = 0 AND p.deleted = 0 AND p.version = (SELECT MAX(p2.version) FROM prices as p2 WHERE p2.internalId = p.internalId GROUP BY p2.internalId)");

$coffeeTable = [];

while($row = $r->fetch_assoc()) {
    if(!isset($coffeeTable[$row['id']])) {
        $coffeeTable[$row['id']] = new Coffee($row['id'], $row['name'], $row['desc']);
    }
    $coffeeTable[$row['id']]->addType(new CoffeeType($row['price_internal_id'], $row['variant'], floatval($row['price']), $row['price_id']));
}

?>

