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
            <div class="f-v bg-light page-content p-l text-primary">
                <h2 class="text-primary">Music at JavaJam</h2>
                <p>
                    The first Friday night each month at JavaJam is a special night. Join us
                    From8pm to 11pm for some music you won't want to miss!
                </p>
                <div class="f-v music-holder">
                    <h3 class="bg-secondary max-width m-none">JANUARY</h3>
                    <div class="f-h f-space-evenly">
                        <!-- https://randomuser.me/photos -->
                        <img src="images/jj-singer1.jpg" alt="JavaJam Singer 1" class="avatar" />
                        <div class="f-v p-m">
                            <p>
                                Melanie Morris entertains with her melodic folk styles. <br>
                                <spam class="bold">CD are available now!</spam>
                            </p>
                            <!-- https://soundcloud.com/royaltyfreebackgroundmusic/creative-commons-music-4548 -->
                            <audio controls>
                            <source src="songs/Song1.mp3" type="audio/mp3">
                        </audio>
                            
                        </div>
                    </div>
                    <h3 class="bg-secondary max-width m-none">FEBRUARY</h3>
                    <div class="f-h f-space-evenly">
                        <!-- https://randomuser.me/photos -->
                        <img src="images/jj-singer2.jpg" alt="JavaJam Singer 1" class="avatar" />
                        <div class="f-v p-m">
                            <p>
                                Peneleope Young is back from his tour. New songs, new stories! <br>
                                <spam class="bold">CD are available now!</spam>
                            </p>
                            <!-- https://soundcloud.com/royaltyfreebackgroundmusic/creative-commons-music-4548 -->
                            <audio controls>
                                <source src="songs/Song2.mp3" type="audio/mp3">
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require("./footer.php") ?>
    </div>
</body>

</html>