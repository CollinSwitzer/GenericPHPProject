<?php
    include 'header.php';
?>

<body>
    <form action="../controller/controller.php?action=login" method="post">
        <div class="img_container">
            <img src="../img/CSI_img.jpg" alt="CSI Logo" class="avatar">
        </div>
        <div class="container">
            <label class="loginLabel"><b>Username</b></label>
            <input class = loginInputUsername id = "username" type="text" placeholder="Enter Username" name="userName" required/>

            <label class="loginLabel"><b>Password</b></label>
            <input id = "password" class= "loginInputPassword" type="password" placeholder="Enter Password" name="userPassword" required/>
            <input type="submit" class="buttonFullSize" id="loginButton" value="Login" name="submit"> </input>
    </form>
    <section>
            <?php
            if (isset($_GET["newpwd"]))
            {
                if($_GET["newpwd"] == "[passwordupdated]")
                {
                    echo '<p>Your password has been reset!</p>';
                }
            }
            ?>
    <a class="link" href= "../controller/controller.php?action=PasswordReset">Forgot your password?</a>
        </div>
    </section>
    <?php
    include "footer.php";
    ?>
</body>
<?php
    function getUsersDBConnection() {
        $dsn = 'mysql: host=localhost;dbname=csiaccounts;port=3306;charset=utf8';
        $username = 'CSIAdmin';
        $password = '462CSI';
        try {
            $db = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo $e;
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;}
        return $db;
    }
    function validateUser($username,$password) {
        try {
            $db = getUsersDBConnection();
            $stmt = $db->prepare('SELECT * FROM administrators WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $result = $stmt->fetch();
            
            if ($result) {
                // username was found in the db
                $hash = $result['userPassword'];
            
                if (password_verify($password, $hash)) { 
                    // Login successful. 
                    header("Location: ../controller/controller.php?action=Main");
                    exit();
                } else {
                    // invalid password
                    echo '<script type="text/javascript">alert("Username or Password Invalid");</script>';
                }
            } else {
                // invalid username
                echo '<script type="text/javascript">alert("Username or Password Invalid");</script>';
            }
        } catch (PDOException $e) {
            displayError($stmt . "\n" . $e->getMessage());
        }
    }

    function login($username,$password) {
        $result = validateUser($username,$password);
    }
    if(isset($_POST['submit']))
    {
      $userNameEntered = $_POST['userName'];
      $userPassword = $_POST['userPassword'];
      login($userNameEntered, $userPassword);
    }
?>
</html>