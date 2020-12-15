
<?php
$CustomerNumber =$_GET['customerNumber'];
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use
$table = <<<EOD
 (
    SELECT
    a.MachineryID , a.JobSiteID, a.SerialNumber, a.MD, a.MachineRange, a.lastCalibrationDate, b.Cost
    FROM MACHINERY a
    LEFT JOIN REPAIR_PRICE b
    ON a.priceOfRepairs = b.PriceID
    WHERE CustomerID = $CustomerNumber
 ) temp
EOD;
// Table's primary key
$primaryKey = 'MachineryID';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'MachineryID', 'dt' => 0 ),
    array( 'db' => 'JobSiteID', 'dt' => 1 ),
    array( 'db' => 'SerialNumber', 'dt' => 2 ),
    array( 'db' => 'MD',  'dt' => 3 ),
    array( 'db' => 'MachineRange',   'dt' => 4 ),
    array( 'db' => 'lastCalibrationDate',   'dt' => 5 ),
    array( 'db' => 'Cost',   'dt' => 6 )
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