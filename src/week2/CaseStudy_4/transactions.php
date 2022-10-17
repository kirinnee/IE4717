<?php
    session_start();
?>
<!doctype html>

<html lang="en">

<?php (require("./head.php"))("JavaJam Coffee House", ["main", "transactions"], []) ?>

<body>
    <div id="app" class="f-v">
        <header class="bg-primary">
            <h1 class="header"></h1>
        </header>
        <div class="f-h box">
            <?php require("./admin_nav.php") ?>
            <div class="f-v bg-light page-content p-l text-primary">
                <h2 class="text-primary text-center">Coffee at JavaJam</h2>
                <?php require("./components/transactions.php")?>
            </div>
        </div>

        
        <?php require("./footer.php") ?>
    </div>
</body>

</html>