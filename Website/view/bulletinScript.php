<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/bulletinandNavCSS.css">
<?php
include 'header.php';
?>
<body>

<?php
include "nav.php";
?>

<div class = "container-fluid alert">
    <div>
        <?php
        $servername = "localhost";
        $username = "CSIAdmin";
        $password = "462CSI";
        $db = "csicustomers";

        $customerNumber = $_POST["customerId"];
        $companyName = $_POST["companyName"];
        $Taken = $_POST["OrderTaken"];
        $Typed = $_POST["WorkOrderTyped"];
        $Copied = $_POST["WorkOrderCopied"];
        $WorkDone = $_POST["WorkDone"];
        $CertsDone = $_POST["CertsDone"];

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error){
            die("Connection failed: ". $conn->connect_error);
        }

        $sql = "update customer set OrderTaken='$Taken', WorkOrderTyped='$Typed', WorkOrderCopied='$Copied', 
                           WorkDone= '$WorkDone', CertsDone= '$CertsDone' where customerNumber='$customerNumber'";

        if ($conn->query($sql) === TRUE) {
            echo " <table style='background-color: white' class='container-fluid'> 
                                <tr>  
                                    <th style='text-align: center'> Company Name </th> 
                                    <th style='text-align: center'> Order Taken </th>
                                    <th style='text-align: center' > Order Typed </th>
                                    <th style='text-align: center'> Order Copied </th>
                                    <th style='text-align: center'> Work Done </th>
                                    <th style='text-align: center'> Certs Done </th>
                                    
                                </tr>";

                                        echo
                                        " <h2> Bulletin Updated for $companyName </h2>
                                        <tr>
                                            <td style='display:none'>
                                                ".$customerNumber."
                                            </td>
                                            <td>
                                                ".$companyName."
                                            </td> 
                                            <td>
                                               ".$Taken."                     
                                            <td>
                                             ".$Typed."                                                        
                                            </td> 
                                            <td>
                                            ".$Copied."
                                            </td> 
                                            <td>
                                             ".$WorkDone."
                                            </td> 
                                            <td>
                                             ".$CertsDone."                               
                                            </td>
                                        </tr>";

        } else {
            echo "Error: ".$sql."<br>".$conn->error;
        }

        echo "</table></br>
                    <button><a style='color: black' href='../controller/controller.php?action=bulletinBoard'>Return To Bulletin Board</button></br>";
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>