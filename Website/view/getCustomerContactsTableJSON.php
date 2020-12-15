<?php
$CustomerNumber =$_GET['customerNumber'];
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use

$table = <<<EOD
 (
    SELECT
    ContactID, Title, firstName, lastName, Department, Address1, Address2, City, State, Zip, Phone, faxNumber, email
    FROM CONTACT
    WHERE CustomerID = $CustomerNumber
 ) temp
EOD;
// Table's primary key
$primaryKey = 'ContactID';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'ContactID', 'dt' => 0 ),
    array( 'db' => 'Title', 'dt' => 1 ),
    array( 'db' => 'firstName',  'dt' => 2 ),
    array( 'db' => 'lastName',   'dt' => 3 ),
    array( 'db' => 'Department',   'dt' => 4 ),
    array( 'db' => 'Address1',   'dt' => 5 ),
    array( 'db' => 'Address2',   'dt' => 6 ),
    array( 'db' => 'City',   'dt' => 7 ),
    array( 'db' => 'State',   'dt' => 8 ),
    array( 'db' => 'Zip',   'dt' => 9 ),
    array( 'db' => 'Phone',   'dt' => 10 ),
    array( 'db' => 'faxNumber',   'dt' => 11 ),
    array( 'db' => 'email',   'dt' => 12 )
);
// SQL server connection information
$sql_details = array(
    'user' => 'CSIAdmin',
    'pass' => '462CSI',
    'db'   => 'CSICustomers',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../scripts/ssp.class.php');
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
?>