<?php 
include 'header.php';
include 'nav.php';
?>
</div>
<body>
<div class = "container">
  <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="Username" name="userName" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="userPassword" required><br><br>
        <label for="password">email:</label>
        <input type="text" id="email" name="userEmail" required><br><br>
        <input class= "buttonStyle" type="submit" value="Submit New Admin" name="submit">
    </form>
</body>
</div>
<?php
    function getUserDBConnection() {
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
        function addUser($userName, $password, $email){
            try {
                $db = getUserDBConnection();
                $query = 'INSERT INTO administrators (UserName, userPassword, email)
                          VALUES (:UserName, :userPassword, :email)';
                $statement = $db->prepare($query);
                $statement->bindValue(':UserName', $userName);
                $statement->bindValue(':userPassword', $password);
                $statement->bindValue(':email', $email);
                $success = $statement->execute();
                $statement->closeCursor();
                if ($success) {
                    return $db->lastInsertId(); // Get generated ID
                    echo "SENT";
                } else {
                    logSQLError($statement->errorInfo());  // Log error to debug
                }		
            } catch (PDOException $e) {
                displayError($e->getMessage());
            }
        }
  if(isset($_POST['submit']))
  {
    $options = [
        'cost' => 12,
    ];
    $userName = $_POST['userName'];
    $password = $_POST['userPassword'];
    $email = $_POST['userEmail'];
    $passwordHash = password_hash($password, PASSWORD_ARGON2ID, $options);
    addUser($userName, $passwordHash, $email);
  }
    ?>