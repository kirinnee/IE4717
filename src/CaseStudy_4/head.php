<?php 
return function($title, $css, $scripts){
$val = <<<HD
<head>
    <title>$title</title>
    <meta charset="utf-8" />
HD;
echo $val;
foreach( $css as $c) {
    echo "<link rel=\"stylesheet\" href=\"" . $c . ".css\">";
}

foreach ($scripts as $s) {
    echo "<script defer src=\"" .$s . ".js\"></script>";
}
echo "</head>";
}

?>