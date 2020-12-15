<?php
include '../model/model.php';

$ContactID =$_POST['contactID'];

return $success = deleteOneContact($ContactID);

?>