<?php
include 'model.php'
?>
<!DOCTYPE html>

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
<form action="includes.php" method="post">
    <div class="img_container">
        <img src="../img/CSI_img.jpg" alt="CSI Logo" class="avatar">
    </div>

    <div class="container">
        <section>
        <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(empty($selector) || empty($validator))
        {
            echo "Could not validate your request!";
        }
        else
        {
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false )
            {
            ?>
                <form action = "reset-password.inc.php" method = "post" >
                    <input type = "hidden" name = "selector" value = "<?php echo $selector?>">
                    <input type = "hidden" name = "validator" value = "<?php echo $validator?>">
                    <input type = "password" name = "pwd" placeholder = "Enter a new password...">
                <input type = "password" name = "pwd-repeat" placeholder = "Repeat new password...">
                <button type = "submit" name = "reset-password-submit">Reset password </button >
                </form>
            <?php
                    }

                    }
            ?>
        </section>
    </div>

<?php
include "footer.php";
?>
</body>
</html>