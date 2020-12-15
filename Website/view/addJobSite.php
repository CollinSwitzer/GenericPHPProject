<?php

$siteContact = $_POST["siteContact"];
$CustomerID = $_POST["customerID"];
$PhoneJobSite = $_POST["PhoneJobSite"];
$FaxJobSite = $_POST["FaxJobSite"];
$Address1JobSite = $_POST["Address1JobSite"];
$Address2JobSite = $_POST["Address2JobSite"];
$CityJobSite = $_POST["CityJobSite"];
$StateJobSite = $_POST["StateJobSite"];
$ZipJobSite = $_POST["ZipJobSite"];
$WorkingHours = $_POST["WorkingHours"];
$Directions = $_POST["Directions"];

$db = getDBConnection();
$query = 'INSERT INTO JOB_SITE (siteContact, customerID, Phone, Fax, Address1, Address2, City, State, Zip, WorkingHours, Directions)
VALUES (:siteContact, :customerID, :Phone, :Fax, :Address1, :Address2, :City, :State, :Zip, :WorkingHours, :Directions)';
$statement = $db->prepare($query);

$statement->bindValue(':siteContact', $siteContactID);
$statement->bindValue(':customerID', $CustomerID);

//Validations + Formatting of data
if (empty($PhoneJobSite)) {
    $statement->bindValue(':Phone', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Phone', $PhoneJobSite);
}
if (empty($FaxJobSite)) {
    $statement->bindValue(':Fax', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Fax', $FaxJobSite);
}
$statement->bindValue(':Address1', $Address1JobSite);
if (empty($Address2JobSite)) {
    $statement->bindValue(':Address2', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Address2', $Address2JobSite);
}
if (empty($CityJobSite)) {
    $statement->bindValue(':City', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':City', $CityJobSite);
}
if (empty($StateJobSite)) {
    $statement->bindValue(':State', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':State', $StateJobSite);
}
if (empty($ZipJobSite)) {
    $statement->bindValue(':Zip', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Zip', $ZipJobSite);
}
if (empty($WorkingHours)) {
    $statement->bindValue(':WorkingHours', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':WorkingHours', $WorkingHours);
}
if (empty($Directions)) {
    $statement->bindValue(':Directions', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Directions', $Directions);
}
$success = $statement->execute();
$statement->closeCursor();
if($success) {
    return $db->lastInsertId();
} else {
    logSQLError($statement->errorInfo());
}