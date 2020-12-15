<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "cis411_csi";

$conn = new mysqli($servername, $username, $password, $db);

if($conn->connect_error){
    die("Connection failed ".$conn->connect_error);
}

$month= date("F");

$sql = "select * from customer 
    WHERE scheduledDateInput = '$month'";

$result = $conn->query($sql);

    echo "<table> 
            <tr>  
                <th> Customer ID  </th> 
                <th> Company Name </th> 
                <th> Order Taken </th>
                <th> Order Typed </th>
                <th> Order Copied </th>
                <th> Work Done </th>
                <th> Certs Done </th>
                <th> Update Progress </th>
            </tr> ";

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc() ){
            $customerID = $row["customerNumber"];
            $customerName = $row["callPrior"];
            $Taken = $row["OrderTaken"];
            $Typed = $row["WorkOrderTyped"];
            $Copied = $row["WorkOrderCopied"];
            $WorkDone = $row["WorkDone"];
            $CertsDone = $row["CertsDone"];
            echo "<tr> 
                    <td>". $customerID ."</td>
                    <td>".$customerName. "</td> 
                    <td>".$Taken. "</td> 
                    <td>".$Typed. "</td> 
                    <td>".$Copied. "</td> 
                    <td>".$WorkDone. "</td> 
                    <td>".$CertsDone. "</td> 
                    <td><a href=\"index.php?id='".$customerID."'\">Update Progress</a></td>
                    </tr>";
        }
    } else {
        echo "0 records";
    }
echo "</table>";

$conn->close();

