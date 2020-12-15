<?php
if(isset($_POST['scompname']) && isset($_POST['staken']) && isset($_POST['styped']) && isset($_POST['scopied'])
        && isset($_POST['swork'])&& isset($_POST['scerts'])){

    $con = new mysqli('localhost' , 'root' , '' , 'cis411_csi');

    $query = "update customer set companyName='" . $_POST['scompname'] . "' , OrderTaken='". $_POST['staken'] ."',
            WorkOrderTyped='" . $_POST['styped'] . "' , WorkOrderCopied='" . $_POST['scopied'] . "' , WorkDone='"
        . $_POST['swork'] . "' , CertsDone='" . $_POST['scerts'] . "' where companyName='" . $_POST['scompname'] . "' ;";

    $status = $con->query($query);

    if($status)
        echo '<tr id="' . $_POST['companyName'] . '">' .
            '<td class="ed" id="scompname">' . $_POST['companyName'] . '</td>' .
            '<td class="ed" id="staken">' . $_POST['OrderTaken'] . '</td>' .
            '<td class="ed" id="styped">' . $_POST['WorkOrderTyped'] . '</td>' .
            '<td class="ed" id="scopied">' . $_POST['WorkOrderCopied'] . '</td>' .
            '<td class="ed" id="swork">' . $_POST['WorkDone'] . '</td>' .
            '<td class="ed" id="scerts">' . $_POST['CertsDone'] . '</td>' .
            '<td class="link"><button onclick= setEditable("' . $_POST['companyName'] . '")
                alt="" class="editLink" alt="Edit" name="Edit">
                <img class="linkImage" src="../img/edit.png" />Edit</button></td>' .
            '</tr>';
}
else echo 'Nothing found';
