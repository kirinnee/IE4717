<?php
return function($coffee) {

echo <<<EOL
<tr id="coffee-$coffee->id" class="coffee-row">
    <td class="bold text-center ">$coffee->name</td>
    <td>
        <div>$coffee->desc</div>
        <div class="bold">
EOL;
foreach($coffee->types as $variant) {
    echo <<<EOL
    <input type="radio" name="coffee-$coffee->id" value="$variant->realId">
    <label>$variant->name $$variant->price</label>
EOL;
}

echo <<<EOL
    </div>
</td>
<td>
    <div class="f-h max-width f-center">
        <div class="minus">-</div>
        <input class="p-int" name="coffee-amount-$coffee->id" value="0">
        <div class="plus">+</div>
    </div>
</td>
<td class="cost">
    $ 0.00
</td>
EOL;
}
?>