<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use
$table = <<<EOD
 (
	SELECT
	a.customerNumber, a.activeStatus, a.companyName, a.companyIdentifier, a.TourMonth, a.scheduledDate, a.dateAcquired,
	a.lastUpdated, a.taxExemptStatus, a.County, a.taxRate, a.creditTerms, a.COD_Date, a.certsInstructs, a.PONum, a.companyDivision,
	a.callPrior, a.technicianAssigned, b.Address1, b.Address2, b.City, b.State, b.Zip, b.WorkingHours, b.Directions, a.Comments,
	a.mapDone
	FROM CUSTOMER a
	LEFT JOIN JOB_SITE b 
	ON a.customerNumber = b.customerID
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
		},
    ),
    array(
        'db'        => 'scheduledDate',
        'dt'        => 8,
        'formatter' => function( $d, $row ) {
            return date( 'M jS Y', strtotime($d));
		}
	),
	array(
        'db'        => 'dateAcquired',
        'dt'        => 9,
        'formatter' => function( $d, $row ) {
            return date( 'M jS Y', strtotime($d));
		}
	),
	array(
        'db'        => 'lastUpdated',
        'dt'        => 10,
        'formatter' => function( $d, $row ) {
            return date( 'M jS Y', strtotime($d));
		}
	),
	array( 'db' => 'taxExemptStatus',   'dt' => 11 ),
	array( 'db' => 'County',   'dt' => 12 ),
	array( 'db' => 'taxRate',   'dt' => 13 ),
	array( 'db' => 'creditTerms',   'dt' => 14 ),
	array(
        'db'        => 'COD_Date',
        'dt'        => 15,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
		}
	),
	array( 'db' => 'certsInstructs',   'dt' => 16),
	array( 'db' => 'PONum',   'dt' => 17 ),
	array( 'db' => 'companyDivision',   'dt' => 18 ),
	array( 'db' => 'callPrior',   'dt' => 19 ),
	array( 'db' => 'technicianAssigned',   'dt' => 20 ),
	array( 'db' => 'Address1',   'dt' => 21 ),
	array( 'db' => 'Address2',   'dt' => 22 ),
	array( 'db' => 'City',   'dt' => 23 ),
	array( 'db' => 'State',   'dt' => 24 ),
	array( 'db' => 'Zip',   'dt' => 25 ),
	array( 'db' => 'WorkingHours',   'dt' => 26 ),
	array( 'db' => 'Directions',   'dt' => 27 ),
	array( 'db' => 'Comments',   'dt' => 28 ),
	array( 'db' => 'mapDone',   'dt' => 29 )
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