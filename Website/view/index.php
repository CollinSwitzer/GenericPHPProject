<?php
$customerNumber=1;

$servername = "localhost";
$username = "root";
$password = "";
$db = "s_crswitzer1";

$conn = new mysqli($servername, $username, $password, $db);

if($conn->connect_error){
    die("Connection failed ".$conn->connect_error);
}

$sql = "select * from customer where customerNumber='$customerNumber'";

$result = $conn->query($sql);

if ($result->num_rows > 0){

    $row = $result->fetch_assoc();

    $customerNumber = $row["customerNumber"];
    $Taken = $row["OrderTaken"];
    $Typed = $row["WorkOrderTyped"];
    $Copied = $row["WorkOrderCopied"];
    $WorkDone = $row["WorkDone"];
    $CertsDone = $row["CertsDone"];

    echo

    "<html>
<body>

<form action='script.php' method='post'>
<tr>Customer ID: $customerNumber
<input type='hidden' name='customerId' value='$customerNumber'></tr>
<td>Taken: <input type='text' name='OrderTaken' value='$Taken'></td>
</td>Typed: <input type='text' name='WorkOrderTyped' value='$Typed'></td>
</td>Copied: <input type='text' name='WorkOrderCopied' value='$Copied'></td>
</td>Done: <input type='text' name='WorkDone' value='$WorkDone'></td>
Certs: <input type='text' name='CertsDone' value='$CertsDone'>
<input type='submit'>
</form>

</body>
</html>";

} else {
    echo "Not Found";
}
$conn->close();

?>


