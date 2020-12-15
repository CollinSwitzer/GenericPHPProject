<?php
require 'model.php';
if(isset($_POST["reset-password-submit"]))
{
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];
}


        if(empty($password) || empty($passwordRepeat))
            {
                header("Location: login.php?newpwd=empty");
                echo "An error has accord. Please restart the process";
                exit();
            }
        else if ($password != $passwordRepeat)
        {
            header("Location: login.php.php?newpwd=pwdmnotsame");
            exit();
        }

        $currentDate = date("U");


        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= $currentDate";
        $stmt = mysqli_stmt_init($con);
            if(!msqli_stmt_prepare($stmt, $sql))
             {
                echo "There was an error!";
                exit();
             }

            else {
                msqli_stmt_bind_param($stmt, "s", $selector);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt, $currentDate);
                if (!$row = mysqli_fetch_assoc($result)) {
                    echo "You need to re-submit your reset request.";
                    exit();
                } else {
                    $tokenBin = hex2bin($validator);
                    $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

                    if ($tokenCheck === false) {
                        echo "You need to re-submit your reset request.";
                        exit();
                    } elseif ($tokenCheck === true) {
                        $tokenEmail = $row['pwdResetEmail'];
                        $sql = "SELECT * FROM users WHERE emailUsers=?;";
                        $stmt = mysqli_stmt_init($con);
                        if (!msqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        } else {
                            msqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt, $currentDate);
                            if (!$row = mysqli_fetch_assoc()) {
                                echo "There was an error!";
                                exit();
                            } else {
                                $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                                $stmt = mysqli_stmt_init($con);
                                if (!msqli_stmt_prepare($stmt, $sql)) {
                                    echo "There was an error!";
                                    exit();
                                } else {
                                    $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                                    msqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                                    mysqli_stmt_execute($stmt);
                                    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                                    $stmt = mysqli_stmt_init($con);
                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        echo "There was an error";
                                        exit();
                                    } else {
                                        mysqli_stmt_msqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                        mysqli_stmt_execute($stmt);
                                        header("Location: login.php?newpwd=passwordupdated");
                                    }

                                }
                            }
                        }
                    } else {
                        header("Location:login.php");
                    }
                }
            }
?>