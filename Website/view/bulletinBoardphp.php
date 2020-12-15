<?php 
include 'header.php';
?>
<head>
<link rel="stylesheet" href="../css/bulletinandNavCSS.css">
<body class="body">
<!--Nav Bar-->
    <?php
    include "nav.php";
    ?>
<br>
<div class = "container-fluid">
        <div>
            <?php
            //Server connection parameters
            $servername = "localhost";
            $username = "CSIAdmin";
            $password = "462CSI";
            $db = "csicustomers";

            //The current month
            $currentMonth = date("F");
            //Connection parameters passed
            $conn = new mysqli($servername, $username, $password, $db);
            //Connection failure display
            if($conn->connect_error){
                die("Connection failed ".$conn->connect_error);
            }

            //Do not show errors for onload
            error_reporting(0);
            ini_set('display_errors', 0);

            //Display dropdown to select month
            echo "<div>
                            <form name='frmMonth' id='frmMonth' method='POST' style='float: right'>
                                 <select name='selectMonth'>
                                 <!--Default select to current month-->
                                      <option value='$currentMonth'> Current Month: $currentMonth </option>  
                                      <option value='January'>January</option>
                                      <option value='February'>February</option>
                                      <option value='March'>March</option>
                                      <option value='April'>April</option>
                                      <option value='May'>May</option>
                                      <option value='June'>June</option>
                                      <option value='July'>July</option>
                                      <option value='August'>August</option>
                                      <option value='September'>September</option>
                                      <option value='October'>October</option>
                                      <option value='November'>November</option>
                                      <option value='December'>December</option>
                                      <input type=\"submit\" name=\"submit\" value=\"Submit\">
                                </select>
                            </form >
                            </div>";

            //POST selected month value
            $month = $_POST['selectMonth'];

            if($month){
                $sql = "select * from customer WHERE MONTHNAME(TourMonth) = '$month'";
            }
            else{
                //SQL select customers from month
                $sql = "select * from customer WHERE MONTHNAME(TourMonth) = '$currentMonth'";
            }


            $result = $conn->query($sql);
                //Display table and heading
                echo "
                    <h1 class='bulletinHeader'> Bulletin Board : $month</h1></div><br>
                    <table id='bulletinTab' style='background-color: white' class='container-fluid '> 
                        <thead >
                        <tr>  
                            <th style='text-align:center';  style= display:none> Customer ID  </th> 
                            <th style='text-align:center'> Company Identifier </th> 
                            <th style='text-align:center'> Order Taken </th>
                            <th style='text-align:center'> Order Typed </th>
                            <th style='text-align:center'> Order Copied </th>
                            <th style='text-align:center'> Work Done </th>
                            <th style='text-align:center'> Certs Done </th>
                            <th style='text-align:center'> Update Progress </th>
                        </tr> 
                        </thead>
                        ";
                        //Display table as editbale text forms
                        if ($result->num_rows > 0){
                            while($row = $result->fetch_assoc() ){
                                $customerID = $row["customerNumber"];
                                $companyName = $row["companyIdentifier"];
                                $Taken = $row["OrderTaken"];
                                $Typed = $row["WorkOrderTyped"];
                                $Copied = $row["WorkOrderCopied"];
                                $WorkDone = $row["WorkDone"];
                                $CertsDone = $row["CertsDone"];
                                echo "
                                <tr >
                                    <form action='bulletinScript.php' method='post' enctype='multipart/form-data'> 
                                        <td align='center'  style= display:none>
                                            $customerID <input type='hidden' name='customerId' value='$customerID'>
                                        </td>
                                        <td align='center'>
                                            $companyName <input type='hidden' name='companyName' value='$companyName'>
                                        </td> 
                                        <td align='center'>
                                            <select name='OrderTaken' value='$Taken' id='taken'>
                                                <option> Select an Option </option>     
                                                <option value='Complete'> Complete </option>
                                                <option value='Incomplete'> Incomplete </option>
                                             </select>  
                                        </td>                             
                                        <td align='center'>
                                            <select name='WorkOrderTyped' value='$Typed' id='typed'>
                                                <option> Select an Option </option>  
                                                <option value='Complete'> Complete </option>
                                                <option value='Incomplete'> Incomplete </option>
                                             </select>                                                                 
                                        </td> 
                                        <td align='center'>
                                             <select  name='WorkOrderCopied' value='$Copied' id='copied'>
                                                <option> Select an Option </option>  
                                                <option value='Complete'> Complete </option>
                                                <option value='Incomplete'> Incomplete </option>
                                             </select>
                                        </td> 
                                        <td align='center'>
                                             <select name='WorkDone' value='$WorkDone' id='work'>
                                                <option> Select an Option </option>  
                                                <option value='Complete'> Complete </option>
                                                <option value='Incomplete'> Incomplete </option>
                                             </select>    
                                        </td> 
                                        <td align='center'>
                                             <select name='CertsDone' value='$CertsDone' id='cert'>
                                                <option> Select an Option </option>  
                                                <option value='Complete'> Complete </option>
                                                <option value='Incomplete'> Incomplete </option>
                                             </select>                                       
                                        </td> 
                                        <td align='center'>
                                            <input type='submit' value='Update Progress'>
                                        </td>
                                    </form>
                                </tr>";
                            }
                            //Else no records
                } else {
                    echo "0 records";
                }
            echo "</table> </br>";


            $conn->close();
            ?>

        </div>

</div>

</body>
<!--Footer-->
<?php
include "footer.php";
?>

</html>