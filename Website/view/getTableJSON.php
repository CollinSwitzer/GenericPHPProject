<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use
$table = <<<EOD
(
	SELECT
    customerNumber, activeStatus, companyName, companyIdentifier, TourMonth, lastUpdated
    FROM CUSTOMER
 ) temp
EOD;
// Table's primary key
$primaryKey = 'customerNumber';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => 'customerNumber', 'dt' => 0 ),
    array( 'db' => 'activeStatus', 'dt' => 1 ),
    array( 'db' => 'companyName',  'dt' => 2 ),
    array( 'db' => 'companyIdentifier',   'dt' => 3 ),
    array(null, 'dt' => 4),
    array(null, 'dt' => 5),
    array(null, 'dt' => 6),
    array(
        'db'        => 'TourMonth',
        'dt'        => 7,
        'formatter' => function( $d, $row ) {
            return date( 'M', strtotime($d));
	}),
	array(
        'db'        => 'lastUpdated',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
            return date( 'M jS Y', strtotime($d));
		}
	)
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