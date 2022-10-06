<!doctype html>
<html lang="en">


<?php (require("./head.php"))("JavaJam Coffee House", ["main", "form"], ["validate"]) ?>

<body>
    <div id="app" class="f-v">
        <header class="bg-primary">
            <h1 class="header"></h1>
        </header>
        <div class="f-h box">
            <?php require("./nav.php") ?>
            <div class="f-v bg-light page-content p-l">
                <h2 class="text-primary">Jobs at JavaJam</h2>
                <p>
                    Want to work at JavaJam? Fill up the job applciation form below to get started!
                    Required fields are marked with *
                </p>
                <form class="job-application" onsubmit="return validateAll()" action="show_post.php" method="post">
                    <div id="name-form">
                        <div>
                            <label for="name">*Name: </label>
                            <input required name="name" type="text" placeholder="Enter your name here" />
                        </div>
                        <div class="error"></div>
                    </div>
                    <div id="email-form">
                        <div>
                            <label for="email">*Email: </label>
                            <input required name="email" type="email" placeholder="Enter your Email-ID here" />
                        </div>
                        <div class="error"></div>
                    </div>
                    <div id="start-date-form">
                        <div>
                            <label for="start-date">Start Date: </label>
                            <input required name="start-date" type="date" />
                        </div>
                        <div class="error"></div>
                    </div>
                    <div id="work-exp-form">
                        <div>
                            <label for="work-exp">*Experience: </label>
                            <textarea required name="work-exp" placeholder="Enter your experience here"></textarea>
                        </div>
                        <div class="error"></div>
                    </div>

                    <input class="button" type="reset" value="Clear">
                    <input class="button" type="submit" value="Apply Now">

                </form>

            </div>
        </div>
        <?php require("./footer.php") ?>
    </div>
</body>

</html>