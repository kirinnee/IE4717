<?php
session_start();
?>
<!doctype html>

<html lang="en">

<?php (require("./head.php"))("JavaJam Coffee House", ["main", "sales"], ["sales"]) ?>

<body>
    <div id="app" class="f-v">
        <header class="bg-primary">
            <h1 class="header"></h1>
        </header>
        <div class="f-h box">
            <?php require("./admin_nav.php") ?>
            <div class="f-v bg-light page-content p-l text-primary">
                <h2 class="text-primary text-center">Coffee at JavaJam</h2>
                <form class="f-v f-center sales" action="sales.php" method="post">
                    <div class="f-h f-center">
                        <div class="choice">
                            <input required type="radio" name="choice" value="all"><label for="all">All</label>
                        </div>
                        <div class="choice">
                            <input required type="radio" name="choice" value="day"><input style="width: 150px" ; type="date" name="day">
                        </div>
                    </div>
                    <?php require("./components/analytics.php") ?>
                    <input type="submit" value="Generate Report">
                </form>

            </div>
        </div>


        <?php require("./footer.php") ?>
    </div>
</body>

</html>