<?php
require_once '../model/model.php';
function CreateTable() 
{
$con = mysqli_connect('localhost','s_crswitzer1','s_crswitzer1','s_crswitzer1');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$dbCustomers = getAllCustomerInfo();
foreach ($dbCustomers as $row) {
    $field1name = $row["activeStatus"];
    $field2name = $row["companyName"];
    $field3name = $row["companyIdentifier"];
    $field4name = $row["TourMonth"];
    $field4name = strtotime($row["TourMonth"]); 
    $field4name = date("m/d/y", $field4name);
    $field5name = $row["scheduledDate"];
    $field5name = strtotime($row["scheduledDate"]); 
    $field5name = date("m/d/y", $field5name);
    $field6name = $row["SolicitationDate"];
    $field6name = strtotime($row["SolicitationDate"]); 
    $field6name = date("m/d/y", $field6name);
    $field7name = $row["dateAcquired"];
    $field7name = strtotime($row["dateAcquired"]); 
    $field7name = date("m/d/y", $field7name);
    $field8name = $row["lastUpdated"];
    $field8name = strtotime($row["lastUpdated"]); 
    $field8name = date("m/d/y", $field8name);
    $field9name = $row["taxExemptStatus"];
    $field10name = $row["County"];
    $field11name = $row["taxRate"];
    $field12name = $row["creditTerms"];
    $field13name = $row["COD_Date"];
    $field13name = strtotime($row["COD_Date"]); 
    $field13name = date("m/d/y", $field13name);
    $field14name = $row["certsInstructs"];
    $field15name = $row["PONum"];
    $field16name = $row["companyDivision"];
    $field17name = $row["callPrior"];
    $field18name = $row["technicianAssigned"];
    $field19name = $row["Address1"];
    $field20name = $row["Address2"];
    $field21name = $row["City"];
    $field22name = $row["State"];
    $field23name = $row["Zip"];
    $field24name = $row["WorkingHours"];
    $field25name = $row["Directions"];
    $field26name = $row["Comments"];
    $ID = $row["customerNumber"];
    echo '<tr>
              <td><div class="row_data" edit_type="click" col_name="activeStatus">'.$field1name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="companyName">'.$field2name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="companyIdentifier">'.$field3name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="TourMonth">'.$field4name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="scheduledDate">'.$field5name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="SolicitationDate">'.$field6name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="dateAcquired">'.$field7name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field8name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="taxExemptStatus">'.$field9name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="County">'.$field10name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="taxRate">'.$field11name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="creditTerms">'.$field12name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="COD_Date">'.$field13name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="certsInstructs">'.$field14name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="PONum">'.$field15name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="companyDivision">'.$field16name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="callPrior">'.$field17name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="technicianAssigned">'.$field18name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address1">'.$field19name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address2">'.$field20name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="City">'.$field21name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="State">'.$field22name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Zip">'.$field23name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Directions">'.$field24name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Directions">'.$field25name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Comments">'.$field26name.'</td> 

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
              </td>
          </tr>';
echo "</table>";
mysqli_close($con);
    }
}
?>
</body>
</html>