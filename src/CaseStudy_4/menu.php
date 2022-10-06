<!doctype html>
<html lang="en">

<?php (require("./head.php"))("JavaJam Coffee House", ["main", "menu"], ["menu"]) ?>

<body>
    <div id="app" class="f-v">
        <header class="bg-primary">
            <h1 class="header"></h1>
        </header>
        <div class="f-h box">
            <?php require("./nav.php") ?>
            <div class="f-v bg-light page-content p-l text-primary">
                <h2 class="text-primary text-center">Coffee at JavaJam</h2>
                <form action="menu.php">
                    <table class="menu text-primary">
                        <tr id="jj" price="2.00">
                            <td class="bold text-center ">Just Java</td>
                            <td>
                                <div>Regular house blend, decaffeinated coffee, or flavor of the day.</div>
                                <div class="bold">Endless Cup $2.00</div>
                            </td>
                            <td>
                                <div class="f-h max-width f-center">
                                    <div class="minus">-</div>
                                    <input class="p-int" value="0">
                                    <div class="plus">+</div>
                                </div>
                            </td>
                            <td class="cost">
                                $ 0.00
                            </td>
                        </tr>
                        <tr id="cal" price-s="2.00"  price-d="3.00">
                            <td class="bold text-center">Cafe au Lait</td>
                            <td>
                                <div>House blended coffee infused into a smooth, steamed milk</div>
                                <div class="bold">
                                    <input type="radio" id="cafe-au-lait-single" name="cafe-au-lait"
                                        value="cafe-au-lait-single">
                                    <label for="html">Single $2.00</label>
                                    <input type="radio" id="cafe-au-lait-double" name="cafe-au-lait"
                                        value="cafe-au-lait-double">
                                    <label for="css">Double $3.00</label>
                                </div>
                            </td>
                            <td>
                                <div class="f-h max-width f-center">
                                    <div class="minus">-</div>
                                    <input class="p-int" value="0">
                                    <div class="plus">+</div>
                                </div>
                            </td>
                            <td class="cost">
                                $ 0.00
                            </td>
                        </tr>
                        <tr id="icap" price-s="4.75"  price-d="5.75">
                            <td class="bold text-center">Iced Cappuccino</td>
                            <td>
                                <div>Sweetened espresso blended with icy-cold milk and served in a chilled glass.</div>
                                <div class="bold">
                                    <input type="radio" id="ice-cap-single" name="ice-cap" value="ice-cap-single">
                                    <label for="html">Single $4.75</label>
                                    <input type="radio" id="ice-cap-double" name="ice-cap" value="ice-cap-double">
                                    <label for="css">Double $5.75</label>
                                </div>
                            </td>
                            <td>
                                <div class="f-h max-width f-center">
                                    <div class="minus">-</div>
                                    <input class="p-int" value="0">
                                    <div class="plus">+</div>
                                </div>
                            </td>
                            <td class="cost">
                                $ 0.00
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" id="total-result">Total: $ 0.00</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        
        <?php require("./footer.php") ?>
    </div>
</body>

</html>