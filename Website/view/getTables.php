<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
require_once '../model/model.php';
$q = $_GET['q'];
$con = mysqli_connect('localhost','s_crswitzer1','s_crswitzer1','s_crswitzer1');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"s_crswitzer1");
$sql="SELECT * FROM Customer";
$result = mysqli_query($con,$sql);
echo '<table id = "displayTable">';
echo '<thead>';
if ($q == "tb1") {
echo '<tr>
      <th> <font face="Arial">Company Name</font> </th> 
      <th> <font face="Arial">Company Identifier</font> </th> 
      <th> <font face="Arial">County</font> </th> 
      <th> <font face="Arial">Tax Exempt Status</font> </th> 
      <th> <font face="Arial">Last Updated</font> </th> 
      <th> <font face="Arial">Options</font> </th> 
  </tr>
  </thead';
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

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
              </td>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
} else if ($q == "tb2")
{
    $rowNumber = 0;
    $dbContacts = getAllContacts();
    echo '<tr> 
      <th> <font face="Arial">Title</font> </th> 
      <th> <font face="Arial">firstName</font> </th> 
      <th> <font face="Arial">lastName</font> </th> 
      <th> <font face="Arial">Department</font> </th> 
      <th> <font face="Arial">Address1</font> </th> 
      <th> <font face="Arial">Address 2</font> </th> 
      <th> <font face="Arial">City</font> </th> 
      <th> <font face="Arial">State</font> </th> 
      <th> <font face="Arial">Zip</font> </th> 
      <th> <font face="Arial">Phone</font> </th> 
      <th> <font face="Arial">Fax Number</font> </th>
      <th> <font face="Arial">E-Mail</font> </th>  
      <th> <font face="Arial">Options</font> </th>  
  </tr>
  </thead>';
$rowNumber = 0;
foreach ($dbContacts as $row) {
    $field1name = $row["Title"];
    $field2name = $row["firstName"];
    $field3name = $row["lastName"];
    $field4name = $row["Department"];
    $field5name = $row["Address1"]; 
    $field6name = $row["Address2"]; 
    $field7name = $row["City"];
    $field8name = $row["State"];
    $field9name = $row["Zip"];
    $field10name = $row["Phone"];
    $field11name = $row["faxNumber"];
    $field12name = $row["email"];
    echo '<tr> 
              <td><div class="row_data" edit_type="click" col_name="Title">'.$field1name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="firstName">'.$field2name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="lastName">'.$field3name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Department">'.$field4name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address1">'.$field5name.'</td>
              <td><div class="row_data" edit_type="click" col_name="Address2">'.$field6name.'</td>
              <td><div class="row_data" edit_type="click" col_name="City">'.$field7name.'</td>
              <td><div class="row_data" edit_type="click" col_name="State">'.$field8name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Zip">'.$field9name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Phone">'.$field10name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="faxNumber">'.$field11name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="email">'.$field12name.'</td>    

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
              </td>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
}
else if ($q == "tb3") {
    $rowNumber = 0;
    $dbContacts = getAllJobsites();
    echo '<tr> 
      <th> <font face="Arial">Phone</font> </th> 
      <th> <font face="Arial">Fax</font> </th> 
      <th> <font face="Arial">Address1</font> </th> 
      <th> <font face="Arial">Address2</font> </th> 
      <th> <font face="Arial">City</font> </th> 
      <th> <font face="Arial">State</font> </th> 
      <th> <font face="Arial">Zip</font> </th> 
      <th> <font face="Arial">Working Hours</font> </th> 
      <th> <font face="Arial">Directions</font> </th> 
      <th> <font face="Arial">Options</font> </th>  
  </tr>
  </thead>';
$rowNumber = 0;
foreach ($dbContacts as $row) {
    $field1name = $row["Phone"];
    $field2name = $row["Fax"];
    $field3name = $row["Address1"];
    $field4name = $row["Address2"];
    $field5name = $row["City"]; 
    $field6name = $row["State"]; 
    $field7name = $row["Zip"];
    $field8name = $row["WorkingHours"];
    $field9name = $row["Directions"];
    echo '<tr> 
              <td><div class="row_data" edit_type="click" col_name="Phone">'.$field1name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Fax">'.$field2name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address1">'.$field3name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address2">'.$field4name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="City">'.$field5name.'</td>
              <td><div class="row_data" edit_type="click" col_name="State">'.$field6name.'</td>
              <td><div class="row_data" edit_type="click" col_name="Zip">'.$field7name.'</td>
              <td><div class="row_data" edit_type="click" col_name="WorkingHours">'.$field8name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Directions">'.$field9name.'</td>    

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
              </td>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
} else if ($q == "tb4") {
    $rowNumber = 0;
    $dbContacts = getAllMachinery();
    echo '<tr> 
      <th> <font face="Arial">Serial Number</font> </th> 
      <th> <font face="Arial">MD</font> </th> 
      <th> <font face="Arial">Machine Range</font> </th> 
      <th> <font face="Arial">lastCalibrationDate</font> </th> 
      <th> <font face="Arial">priceOfRepairs</font> </th> 
      <th> <font face="Arial">Options</font> </th>  
  </tr>
  </thead>';
$rowNumber = 0;
foreach ($dbContacts as $row) {
    $field1name = $row["SerialNumber"];
    $field2name = $row["MD"];
    $field3name = $row["MachineRange"];
    $field4name = $row["lastCalibrationDate"];

    echo '<tr> 
              <td><div class="row_data" edit_type="click" col_name="SerialNumber">'.$field1name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="MD">'.$field2name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="MachineRange">'.$field3name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="lastCalibrationDate">'.$field4name.'</td>  

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
              </td>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
} else if ($q == "tb5") {
    $rowNumber = 0;
    $dbContacts = getAllJobsites();
    echo '<tr> 
      <th> <font face="Arial">Phone</font> </th> 
      <th> <font face="Arial">Fax</font> </th> 
      <th> <font face="Arial">Address1</font> </th> 
      <th> <font face="Arial">Address2</font> </th> 
      <th> <font face="Arial">City</font> </th> 
      <th> <font face="Arial">State</font> </th> 
      <th> <font face="Arial">Zip</font> </th> 
      <th> <font face="Arial">Working Hours</font> </th> 
      <th> <font face="Arial">Directions</font> </th> 
      <th> <font face="Arial">Options</font> </th>  
  </tr>
  </thead>';
$rowNumber = 0;
foreach ($dbContacts as $row) {
    $field1name = $row["Phone"];
    $field2name = $row["Fax"];
    $field3name = $row["Address1"];
    $field4name = $row["Address2"];
    $field5name = $row["City"]; 
    $field6name = $row["State"]; 
    $field7name = $row["Zip"];
    $field8name = $row["WorkingHours"];
    $field9name = $row["Directions"];
    echo '<tr> 
              <td><div class="row_data" edit_type="click" col_name="Phone">'.$field1name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Fax">'.$field2name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address1">'.$field3name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Address2">'.$field4name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="City">'.$field5name.'</td>
              <td><div class="row_data" edit_type="click" col_name="State">'.$field6name.'</td>
              <td><div class="row_data" edit_type="click" col_name="Zip">'.$field7name.'</td>
              <td><div class="row_data" edit_type="click" col_name="WorkingHours">'.$field8name.'</td> 
              <td><div class="row_data" edit_type="click" col_name="Directions">'.$field9name.'</td>    

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
} else if ($q == "tb5") {
    $rowNumber = 0;
    $dbContacts = getAllRepairPrices();
    echo '  <tr> 
      <th> <font face="Arial">Cost</font> </td> 
  </tr>';
$rowNumber = 0;
foreach ($dbContacts as $row) {
    $field1name = $row["Cost"];
    echo '<tr> 
              <td><div class="row_data" edit_type="click" col_name="SerialNumber">'.$field1name.'</td> 

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }
}
else {
    $dbSearch = getByGeneralSearch($q);
    echo '<thead>
  <tr> 
      <th> <font face="Arial">Company Name</font> </th> 
      <th> <font face="Arial">Company Identifier</font> </th> 
      <th> <font face="Arial">County</font> </th> 
      <th> <font face="Arial">Tax Exempt Status</font> </th> 
      <th> <font face="Arial">Last Updated</font> </th> 
      <th> <font face="Arial">Options</font> </th> 
  </tr>
  </thead';
$rowNumber = 0;
foreach ($dbSearch as $row) {
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

              <td class = "OptionDiv"><div class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> </div>
              <div class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </div>
              <div class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </div>
              <div class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></div>
              </td>
          </tr>';
    $rowNumber= $rowNumber + 1;
    }

}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>