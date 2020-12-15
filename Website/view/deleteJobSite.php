<?php
include '../model/model.php';

$JobSiteID =$_POST['JobSiteID'];

return $success = deleteOneJobSite($JobSiteID);

?>