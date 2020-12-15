<?php
include '../model/model.php';

$MachineryID =$_POST['MachineryID'];

return $success = deleteOneMachinery($MachineryID);

?>