<head>
<link rel="stylesheet" href="../css/bulletinandNavCSS.css">
<?php
include 'header.php';
?>
<body class="body">

<!--Nav Bar-->
<?php
include "nav.php";
?>

<div class = "container-fluid">
    <div><br>
            <?php
            //Server connection parameters
            $servername = "localhost";
            $username = "CSIAdmin";
            $password = "462CSI";
            $db = "csicustomers";
            //Connection parameters passed
            $conn = new mysqli($servername, $username, $password, $db);

            //The current month
            $currentMonth = date("F");

            //Connection failure display
            if($conn->connect_error){
                die("Connection failed ".$conn->connect_error);
            }

            //Do not show errors for onload
            error_reporting(0);
            ini_set('display_errors', 0);

            //Display dropdown to select month
            echo "<div><form name='frmMonth' id='frmMonth' method='POST' style='float: right'>
                                 <select name='selectMonth' id='selectMonth'>
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
                            </form >";

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

            //Display the table and page header
                echo " <h1 class='bulletinHeader'> Bulletin Board : $month </h1></div><br>
                    <table id='bulletinTab' style='background-color: white' class='container-fluid tbresponsive'>
                        <tr>  
                            <th style='text-align:center'> Company Identifier </th> 
                            <th style='text-align:center'> Order Taken </th>
                            <th style='text-align:center'> Order Typed </th>
                            <th style='text-align:center'> Order Copied </th>
                            <th style='text-align:center'> Work Done </th>
                            <th style='text-align:center'> Certs Done </th>
                            <th style='text-align:center'> Update Progress </th>
                        </tr> ";

                //If SQL returns results print into table
                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc() ){
                        $customerName = $row["companyIdentifier"];
                        $Taken = $row["OrderTaken"];
                        $Typed = $row["WorkOrderTyped"];
                        $Copied = $row["WorkOrderCopied"];
                        $WorkDone = $row["WorkDone"];
                        $CertsDone = $row["CertsDone"];
                        echo "<tr> 
                                <td align='center'>".$customerName. "</td> 
                                <td align='center'>".$Taken. "</td> 
                                <td align='center'>".$Typed. "</td> 
                                <td align='center'>".$Copied. "</td> 
                                <td align='center'>".$WorkDone. "</td> 
                                <td align='center'>".$CertsDone. "</td> 
                                <td align='center'>
                                    <button>
                                        <a style='color: black' href='../view/bulletinBoardphp.php'>Update Progress</a>
                                    </button>
                                </td>
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
