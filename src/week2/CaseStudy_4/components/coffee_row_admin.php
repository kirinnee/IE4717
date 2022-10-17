<?php
return function($coffee) {

echo <<<EOL
<tr id="coffee-$coffee->id" class="coffee-row">
    <td><input class="edit-mode" type='checkbox' name="coffee-select-$coffee->id" value="$coffee->id"></td>
    <td>
        <div class="coffee-name">
            <div>
                <input disabled class="display" name="coffee-name-$coffee->id" value="$coffee->name">
                <span class="check">✅</span>
            <div>
            <div class="error-msg">
                sine errir
            </div>
        </div>
    </td>
    <td>
        <div class="coffee-desc">
            <div class="f-h f-center"> 
                <div class="desc display" contenteditable="false">
                    $coffee->desc
                </div>
                <div class="check">✅</div>
            </div>
            <div class="error-msg">
                sine errir
            </div>
            <input disabled class="desc-value" name="coffee-desc-$coffee->id" 
                value="$coffee->desc" style="display: none;">
        </div>
        <table class="m-a">
        
EOL;
foreach($coffee->types as $variant) {
    echo <<<EOL
    <tr class="coffee-variant-row" id="coffee-variant-row-$coffee->id-$variant->id">
        <td>
            <div id="coffee-variant-$coffee->id-$variant->id" class="coffee-variant">
                <div>
                    <input disabled class="variant-name display" name="coffee-variant-name-$coffee->id-$variant->id" value="$variant->name"> 
                    <span class="check">✅</span>
                <div>
                <div class="error-msg">
                    sine errir
                </div>
            </div>
        </td>
        <td>
            <div id="coffee-price-$coffee->id-$variant->id" class="coffee-price">
                <div>
                    $ <input disabled  class="price display" name="coffee-price-$coffee->id-$variant->id" value="$variant->price" pre="$variant->price"> 
                    <span class="check">✅</span>
                <div>
                <div class="error-msg">
                    sine errir
                </div>
            </div>
            
        </td>
        <td class="edit delete-variant" id="delete-variant-$coffee->id-$variant->id">
            <label>Delete</label><br>
            <input disabled type="checkbox" class="delete-variant" name="coffee-delete-variant-$coffee->id-$variant->id">
        </td>
    </tr>
EOL;
}

echo <<<EOL
    </table>
    <table class="additional m-a" id="additional-$coffee->id" coffeeId="$coffee->id" elementCount="0">

    </table> 
    <div class="add-button m-l edit variant" id="add-button-$coffee->id" coffeeId="$coffee->id">Add</div>
    </div>
</td>
<td class="edit delete-coffee">
    <label>Delete</label><br>
    <input disabled type="checkbox" name="coffee-delete-$coffee->id">
</td>
</tr>
EOL;
}
?>