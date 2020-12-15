<?php
include "header.php";
?>

<body>
    
<?php
include "nav.php";
?>

<div id="selection">
    <div id="tourMonth">
        <form name="formMonth" id="formMonth" method="POST">
            Select Tour Month:
            <select id="selectTourMonth" name="selectTourMonth" onchange="getTourMonth();">
                <option id="defaultMonth" value="12">Please Select...</option>
                <option value="0">January</option>
                <option value="1">February</option>
                <option value="2">March</option>
                <option value="3">April</option>
                <option value="4">May</option>
                <option value="5">June</option>
                <option value="6">July</option>
                <option value="7">August</option>
                <option value="8">September</option>
                <option value="9">October</option>
                <option value="10">November</option>
                <option value="11">December</option>
            </select>
        </form>
    </div>

    <div id="scheduleWeek">
        <form name="formWeek" id="formWeek" method="POST">
            Select Week:
            <select id="selectWeek" name="selectWeek" onchange="getWeek();">
                <option id="defaultWeek" value="-1">Please Select...</option>
                <option id="opt0" style="display:none;" value="4/6/2020"></option>
                <option id="opt1" style="display:none;" value="4/13/2020"></option>
                <option id="opt2" style="display:none;" value="4/20/2020"></option>
                <option id="opt3" style="display:none;" value="4/27/2020"></option>
                <option id="opt4" style="display:none;" > </option>
            </select>
        </form>
    </div>

    <div id="tourTech">
        <form name="formTech" id="formTech" method="POST">
            Select Tech:
            <select id="selectTech" name="selectTech" onchange="getTech();">
                <option value="-1">Please Select...</option>
                <option value="CS/TJ">CS/TJ</option>
                <option value="DLP">DLP</option>
                <option value="III">III</option>
                <option value="KAS">KAS</option>
                <option value="LMS">LMS</option>
                <option value="TJT">TJT</option>
                <option value="TLR">TLR</option>
                <option value="TPJ">TPJ</option>
                <option value="TJT">TJT</option>
            </select>
        </form>
    </div>

</div>

<!-- Div for database view -->
    <table id="tblWeekSchedule" style="background-color: white">
        <tr>
            <th>Week of</th>
            <th>Customer #</th>
            <th>Company</th>
            <th>TechnicianAssigned</th>
            <th>Location</th>
            <th>ST</th>
            <?php
            /*$conn = new mysqli_connect("localhost", "root", "", "s_crswitzer1");
            if ($conn->connect_error) {
                die("Connection failed:".$conn-> connect_error);
            }

            $sql = "SELECT scheduledDate, companyIdentifier, companyName FROM customer";
            $result = $conn-> query($sql);
            /*$db = getDBConnection();
            $sql = "SELECT scheduledDate, companyIdentifier, companyName FROM customer";
            $result = $db-> query($sql);*/

            $servername = "localhost";
            $username = "CSIAdmin";
            $password = "462CSI";
            $db = "csicustomers";

            //Connection parameters passed
            $conn = new mysqli($servername, $username, $password, $db);
            //Connection failure display
            if($conn->connect_error){
                die("Connection failed ".$conn->connect_error);
            }

            $week = "2014-04-14";//$_POST['selectWeek'];
            //$tech = $_POST['selectTech'];
            $sql = "SELECT scheduledDate, companyIdentifier, companyName, technicianAssigned FROM customer WHERE scheduledDate = '$week'";
            $result = $conn-> query($sql);

            if ($result-> num_rows > 0) {
                while ($row = $result-> fetch_assoc()) {
                    echo "<tr><td>".$row["scheduledDate"] ."</td><td>".$row["companyIdentifier"] ."</td><td>".$row["companyName"] ."</td><td>".$row["technicianAssigned"] ."</td><td></td><td></td><td></td></tr>";
                }
                echo "</table>";
            }

            ?>

    </table>





</body>

</html>
</div>
<?php
    include "footer.php";
?>
</body>

</html>