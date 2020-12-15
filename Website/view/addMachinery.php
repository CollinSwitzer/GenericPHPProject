<?php
$db = getDBConnection();
$query = 'INSERT INTO MACHINERY (customerID, SerialNumber, MD, MachineRange, lastCalibrationDate, priceOfRepairs, JobSiteID)
VALUES (:customerID, :SerialNumber, :MD, :MachineRange, :lastCalibrationDate, :priceOfRepairs, :JobSiteID)';
$statement = $db->prepare($query);
$date = date('m/d/Y', time());
$statement->bindValue(':customerID', $customerID);

//Validations + Formatting of data
if (empty($SerialNumber)) {
    $statement->bindValue(':SerialNumber', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':SerialNumber', $SerialNumber);
}
$statement->bindValue(':MD', $MD);
if (empty($MachineRange)) {
    $statement->bindValue(':MachineRange', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':MachineRange', $MachineRange);
}
if(empty($lastCalibrationDate)) {
    $statement->bindValue(':lastCalibrationDate', null, PDO::PARAM_NULL);
} else {
    $statement->bindValue(':lastCalibrationDate', $lastCalibrationDate);

}
$statement->bindValue(':priceOfRepairs', $priceOfRepairs);

if (empty($JobSiteID)) {
    $statement->bindValue(':JobSiteID', 0);
}   else {
        $statement->bindValue(':JobSiteID', $JobSiteID);
}

$success = $statement->execute();
$statement->closeCursor();
if($success) {
    return $db->lastInsertId();
} else {
    logSQLError($statement->errorInfo());
}
?>