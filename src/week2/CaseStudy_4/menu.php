<?php session_start() ?>
<!doctype html>
<html lang="en">
<?php 
    require("./components/coffee_query.php");
?>
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
                <form action="checkout_form.php" method="POST">
                    <?php 
                        echo "<div class='server-error-holder'>";
                        if(isset($_SESSION['errors'])) {
                            foreach($_SESSION['errors'] as $v) {
                                echo "<div class='server-error'>".$v."</div>";
                            }
                            unset($_SESSION['errors']);
                        } else if(isset($_SESSION['success'])) {
                            echo "<div class='success-menu'>Successfully checked-out!</div>";
                            unset($_SESSION['success']);
                        }
                        echo "</div>";
                    ?>
                    <table class="menu text-primary">
                        <?php 
                            $rowGen = require("./components/coffee_row.php");
                            foreach($coffeeTable as $coffee) {
                                $rowGen($coffee);
                            }
                        ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" id="total-result">Total: $ 0.00</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1" id="total-result">
                                <input type="submit" value="Checkout"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        
        <?php require("./footer.php") ?>
    </div>
</body>

</html>