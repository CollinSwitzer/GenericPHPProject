<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../css/MainCSS.css">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="../js/mainJS.js"></script>
<body>
<div class="container-fluid" style= "overflow-y: auto;">
<label for="tableSelect">Select a Table:</label>
<form>
    <select name= "tableSelect"id="table-select">
        <option value="">...</option>
        <option value="tb1">Customer</option>
        <option value="tb2">Contact</option>
        <option value="tb3">Job Site</option>
        <option value="tb4">Machinery</option>
        <option value="tb5">Repair Price</option>
    </select>
</form>
<div class="table-responsive" id="tableDiv"></div>
<?php 
require_once '../model/model.php';
?>
</div>
</body>
</html>