<?php
    session_start();
?>
<!doctype html>

<html lang="en">

<?php (require("./head.php"))("JavaJam Coffee House", ["main", "menu", "admin"], ["admin_validators","admin"]) ?>

<body>
    <div id="app" class="f-v">
        <header class="bg-primary">
            <h1 class="header"></h1>
        </header>
        <div class="f-h box">
            <?php require("./admin_nav.php") ?>
            <div class="f-v bg-light page-content p-l text-primary">
                <h2 class="text-primary text-center">Coffee at JavaJam</h2>
                
                <?php
                    if(isset($_SESSION['errors'])) {
                        echo "<div class='server-error-holder'>";
                        foreach($_SESSION['errors'] as $v) {
                            echo "<div class='server-error'>".$v."</div>";
                        }
                        echo "</div>";
                        unset($_SESSION['errors']);
                    }
                ?>
                <form action="admin_form.php" method="post" onsubmit="return validateAll()">
                    <table class="menu text-primary">
                        <?php 
                            require("./components/coffee_query.php");
                            $rowGen = require("./components/coffee_row_admin.php");
                            foreach($coffeeTable as $coffee) {
                                $rowGen($coffee);
                            }
                            
                        ?>
                       
                    </table>
                    <table class="menu text-primary" id="additional-coffee" elementCount="0">
                        
                    </table>
                    <div class="menu-actions f-h f-center menu">
                        <div id="add-coffee" class="text-primary add-button m-l">Add Coffee</div>
                        <input type="submit" class="add-button m-l" value="Update">
                    </div>
                </form>
            </div>
        </div>

        
        <?php require("./footer.php") ?>
    </div>
</body>

</html>