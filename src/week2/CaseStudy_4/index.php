<!doctype html>
<html lang="en">

<?php (require("./head.php"))("JavaJam Coffee House", ["main"], []) ?>

<body>
    <div id="app" class="f-v">
        <header class="bg-primary">
            <h1 class="header"></h1>
        </header>
        <div class="f-h box">
            <?php require("./nav.php") ?>
            <div class="f-v f-center bg-light page-content p-l">
                <h2 class="text-primary">Follow the Winding Road to JavaJam</h2>
                <div class="f-h text-primary f-wrap f-center ">
                    <!--From https://userpages.umbc.edu/~geet2/ch10javajam/index.html -->
                    <img class="p-m main-image" src="images/windingroad.jpg" alt="">
                    <div>
                        <ul class="bullet">
                            <li>Specialty Cofee and Tea</li>
                            <li>Bagels, Muffins, and Organic Snacks</li>
                            <li>Music and Poetry Readings</li>
                            <li>Open Mic Night Every Friday</li>
                        </ul>
                        <p>
                            54321 Route 42 <br>
                            Ellison Bay, WI54210 <br>
                            888-555-8888
                        </p>
                    </div>
                </div>
                
            </div>
        </div>

        <?php require("./footer.php") ?>
    </div>
</body>

</html>