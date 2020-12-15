<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
require_once '../model/model.php';

$q = intval($_GET['q']);

$con = mysqli_connect('localhost','s_crswitzer1','s_crswitzer1','s_crswitzer1');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"s_crswitzer1");
$sql="SELECT * FROM Customer";
$result = mysqli_query($con,$sql);

echo '<table id = "Customer" border="0" cellspacing="2" cellpadding="2"> 
<caption>Customers</caption>
  <tr> 
      <th> <font face="Arial">Company Name</font> </td> 
      <th> <font face="Arial">Company Identifier</font> </td> 
      <th> <font face="Arial">County</font> </td> 
      <th> <font face="Arial">Tax Exempt Status</font> </td> 
      <th> <font face="Arial">Last Updated</font> </td> 
      <th> <font face="Arial">Options</font> </td> 
  </tr>';
$dbCustomers = getAllCustomers();
$rowNumber = 0;
foreach ($dbCustomers as $row) {
    $field1name = $row["companyName"];
    $field2name = $row["companyIdentifier"];
    $field3name = $row["County"];
    $field4name = $row["taxExemptStatus"];
    $field5name = strtotime($row["lastUpdated"]); 
    $field5name = $myFormatForView = date("m/d/y", $field5name);
    echo '<tr> 
              <td><div class="row_data" edit_type="click" col_name="companyName">'.$field1name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="companyIdentifier">'.$field2name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="County">'.$field3name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="taxExemptStatus">'.$field4name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field5name.'</td> 

              <td><span class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </span>
              <span class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </span>
              <span class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </span>
              <span class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></span>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
echo "</table>";
mysqli_close($con);
?>
</body>
</html>