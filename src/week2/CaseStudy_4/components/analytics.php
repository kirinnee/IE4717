<?php  
require_once("./db.php");

class Stats {
    public $key;
    public $sales;
    public $quantity;

    function __construct($key, $sales, $quantity) {
        $this->key = $key;
        $this->sales = $sales;
        $this->quantity = $quantity;
    }

    function add($stats) {
        $this->sales = $this->sales + $stats->sales;
        $this->quantity = $this->quantity + $stats->quantity;
    }
}

function generateAnalytics($day) {

    $productStats = [];
    $categoryStats = [];

    $tree = [];

    $conn = conn();
    $start = new DateTime($day);
    $end = new DateTime($day);
    $end->modify('+1 day');
    $result = null;
    if($day == "") {
        $result = $conn->query("SELECT ps.name as name, p.name as variant, t.quantity as quantity, p.price as price FROM transactions as t JOIN prices as p ON t.price_id = p.id JOIN products as ps ON p.product_id = ps.id");
    }else {
        $s = $start->format('Y-m-d');
        $e = $end->format('Y-m-d');
        $result = $conn->query("SELECT ps.name as name, p.name as variant, t.quantity as quantity, p.price as price FROM transactions as t JOIN prices as p ON t.price_id = p.id JOIN products as ps ON p.product_id = ps.id WHERE t.ts > '$s' AND t.ts < '$e'");
    }
    while($row = $result->fetch_assoc()) {
        $price = floatval($row["price"]);
        $quant = intval($row["quantity"]);
        $n =$row["name"];
        $v = $row["variant"];
        $prod = new Stats($n, $price * $quant, $quant);
        $cat = new Stats($v, $price * $quant, $quant);

        if(!isset($productStats[$n])) $productStats[$n] = new Stats($n, 0, 0);
        if(!isset($categoryStats[$v])) $categoryStats[$v] = new Stats($n, 0, 0);

        if(!isset($tree[$n])) $tree[$n] = [];
        if(!isset($tree[$n][$v])) $tree[$n][$v] = 0;
        
        $tree[$n][$v] += $quant;
        $productStats[$n]->add($prod);
        $categoryStats[$v]->add($cat);
    }
    $conn->close();
    return array($productStats, $categoryStats, $tree);
}

# here starts
$stats = null;
if(isset($_POST["choice"])){
    if($_POST["choice"] == "day") {
        $stats = generateAnalytics($_POST["day"]);
    } else {
        $stats = generateAnalytics("");
    }
    
    echo <<<EOL
    <table class="product">
        <tr>
            <th>Product</th>
            <th>Total Dollar Sales</th>
            <th>Quantity Sales</th>
        </tr>
    EOL;
    
    $most = "";
    $mostVal = 0;

    $prod = $stats[0];
    foreach($prod as $k => $v) {

        if($v->sales > $mostVal) {
            $mostVal = $v->sales;
            $most = $k;
        }

        $s = number_format($v->sales, 2);
    echo <<<EOL
        <tr>
            <td>$k</td>
            <td>$ $s</td>
            <td>$v->quantity</td>
        </tr>
    
    EOL;
    
    }
    
    echo <<<EOL
    </table>
    <table class="cat">
        <tr>
            <th>Category</th>
            <th>Total Dollar Sales</th>
            <th>Quantity Sales</th>
        </tr>
    EOL;
    $cat = $stats[1];
    foreach($cat as $k => $v) {
        $s = number_format($v->sales, 2);
        echo <<<EOL
            <tr>
                <td>$k</td>
                <td>$ $s</td>
                <td>$v->quantity</td>
            </tr>
        
        EOL;
        
        }
    
    echo "</table>";
    $tree = $stats[2];

    $maxOpt = "";
    $maxOptQ = 0;
    foreach($tree[$most] as $k => $v) { 
        if($v > $maxOptQ) {
            $maxOptQ = $v;
            $maxOpt = $k;
        }
    }

    echo "Popular option of best selling product: ". $maxOpt. " of " . $most;
}


?>