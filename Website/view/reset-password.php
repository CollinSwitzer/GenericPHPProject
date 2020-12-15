<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSI Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/MainCSS.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../js/mainJS.js"></script>
</head>

<body>
    <form action="../view/reset-password.inc.php" method="post">
        <div class="img_container">
            <img src="../img/CSI_img.jpg" alt="CSI Logo" class="avatar">
        </div>

        <div class="container">
            <h1>Reset your password</h1>
            <p>An e-mail will be send to you with instructions on how to reset your password.</p>
          <form action ="../view/reset-request.inc.php" method="post">
            <input type="text" name="email" placeholder="Enter your e-mail address...">
            <button type = "submit" name="reset=request-submit">Receive a new password by e-mail
            </button>
          </form>
        </div>

    </form>
    <?php
        if(isset($_GET["reset"]))
            if($_GET["reset"] == "success")
            {
                echo '<p class="signupsuccess">Check your e-mail!</p>';
            }

    ?>
    <?php
    include "footer.php";
    ?>
</body>

</html>