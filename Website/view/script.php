<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "s_crswitzer1";

$customerNumber = $_POST["customerId"];
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
    echo "Records updated: ".$customerNumber."-".$Taken."-".$Typed."-".$Copied. "-".$WorkDone."-" .$CertsDone;
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

