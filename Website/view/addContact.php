<?php
$Title = $_POST["Title"];
$CustomerID = $_POST["customerID"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$Department = $_POST["Department"];
$Address1Contact = $_POST["Address1"];
$Address2Contact = $_POST["Address2"];
$CityContact = $_POST["City"];
$StateContact = $_POST["State"];
$ZipContact = $_POST["Zip"];
$PhoneContact = $_POST["Phone"];
$faxNumberContact = $_POST["faxNumber"];
$email = $_POST["email"];

$db = getDBConnection();
$query = 'INSERT INTO CONTACT (customerID, Title, firstName, lastName, Department, Address1, Address2, City, State, Zip, Phone, faxNumber, email)
VALUES (:customerID, :Title, :firstName, :lastName, :Department, :Address1, :Address2, :City, :State, :Zip, :Phone, :faxNumber, :email)';
$statement = $db->prepare($query);

//Validations + Formatting of data
$statement->bindValue(':customerID', $CustomerID);
if (empty($Title)) {
    $statement->bindValue(':Title', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Title', $Title);
}
$statement->bindValue(':firstName', $firstName);
$statement->bindValue(':lastName', $lastName);

if (empty($Department)) {
    $statement->bindValue(':Department', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Department', $Department);
}
if (empty($Address1Contact)) {
    $statement->bindValue(':Address1', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Address1', $Address1Contact);
}
if (empty($Address2Contact)) {
    $statement->bindValue(':Address2', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Address2', $Address2Contact);
}
if (empty($CityContact)) {
    $statement->bindValue(':City', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':City', $CityContact);
}
if (empty($StateContact)) {
    $statement->bindValue(':State', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':State', $StateContact);
}
if (empty($ZipContact)) {
    $statement->bindValue(':Zip', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Zip', $ZipContact);
}
if (empty($PhoneContact)) {
    $statement->bindValue(':Phone', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':Phone', $PhoneContact);
}
if (empty($faxNumberContact)) {
    $statement->bindValue(':faxNumber', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':faxNumber', $faxNumberContact);
}
if (empty($email)) {
    $statement->bindValue(':email', null, PDO::PARAM_NULL);
}   else {
        $statement->bindValue(':email', $email);
}

$success = $statement->execute();
$statement->closeCursor();
if($success) {
    return $db->lastInsertId();
} else {
    logSQLError($statement->errorInfo());
}

?>