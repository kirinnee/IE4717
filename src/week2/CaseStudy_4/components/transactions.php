<?php 
require_once("./db.php");

$conn = conn();

$result = $conn->query("SELECT t.id as id, t.ts as timestamp, ps.name as name, p.name as variant, t.quantity as quantity, p.price as price FROM transactions as t JOIN prices as p ON t.price_id = p.id JOIN products as ps ON p.product_id = ps.id ORDER BY t.ts DESC");

echo <<<EOL
    <table class="trans">
    <tr>
        <th>
            ID
        </th>
        <th>
            Time Stamp
        </th>
        <th>
            Coffee Name
        </th>
        <th>
            Choice
        </th>
        <th>
            Quantity
        </th>
        <th>
            Price
        </th>
        <th>
            Sales
        </th>
    </tr>
EOL;

while($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $timestamp = $row["timestamp"];
    $name = $row["name"];
    $variant = $row["variant"];
    $quantity = intval($row["quantity"]);
    $price = floatval($row["price"]);
    $sales = $quantity * $price;

    $p = number_format($price, 2);
    $s = number_format($sales, 2);
echo <<<EOL
    <tr>
        <td>
            $id
        </td>
        <td>
            $timestamp
        </td>
        <td>
            $name
        </td>
        <td>
            $variant
        </td>
        <td>
            $quantity
        </td>
        <td>
            $ $p
        </td>
        <td>
            $ $s
        </td>
    </tr>
EOL;
}

echo "</table>";
$conn->close();


?>