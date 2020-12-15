<?php
/* This page is the editing of customer info */
include "../model/model.php";
/* Get the customerNumber*/
if (!empty($_POST['custID'])){
    $customerNumber = $_POST['custID'];
}
/* These functions obtain relevant customer info and assign all their results to their respective Rows variable */
$CustomerRow = getAllCustomerInfoFromCustomer($customerNumber);
$ContactsRows = getCustomerContact($customerNumber);
$MachineryRows = getCustomerMachinery($customerNumber);
$JobSiteRows = getCustomerJobSite($customerNumber);
/* Prepair various variables for assignment*/
$checkboxCheckedMap = "";
$checkboxCheckedQA = "";
$checkboxCheckedCerts = "";
$output = "";
$MachineryCounter = "";
$JobSiteCounter = "";
$ContactCounter = "";
/* These set checkbox values to be shown correctly*/
if (!is_null($CustomerRow['mapDone'])) {
    $checkboxCheckedMap = "checked";
} else {
    $CustomerRow['mapDone'] = "0";
    $checkboxCheckedMap = "";
}
if (!is_null($CustomerRow['QARequirement'])) {
    $checkboxCheckedQA = "checked";
} else {
    $CustomerRow['QARequirement'] = "0";
    $checkboxCheckedQA = "";
}
if (!is_null($CustomerRow['certsInstructs'])) {
    $checkboxCheckedCerts = "checked";
} else {
    $CustomerRow['certsInstructs'] = "0";
    $checkboxCheckedCerts = "";
}
/* Create the modal 
The loops in here create the needed table elements based on the data in each table for the customer
Each element's results are stored in their input text box for user input and verification*/

$output .= '<div><form id= "EditForm" action="../controller/controller.php?action=EditCustomer" method="post" enctype = "multipart/form-data">
<div class="row">
<div class="column-large">
    <input type=hidden name="customerNumber" id="CustomerNumber" class= "CustomerNumber" value = "'.$customerNumber.'"/>
    <label><b>Company Name:</b></label>
    <input id="companyNameInput" class="leftAlignInput" type="text" value="' .$CustomerRow['companyName'].'" placeholder="REQUIRED" name="compNameInput" required/>
</div>
<div class="column-large">
    <label><b>Company Identifier:</b></label>
    <input id="companyIdentifierInput" type="text" value="' .$CustomerRow['companyIdentifier'].'"  placeholder="REQUIRED" name="companyIdentifierInput" required/>
  </div>
  <div class="column">
    <label><b>Contacts:</b></label>
</div>
<table id="ContactInputTable" class=" table order-list-Contact"style="overflow-x: scroll;">
<thead>
<tr>
    <td>ID</td>
    <td>Title</td>
    <td>First Name</td>
    <td>Last Name</td>
    <td>Department</td>
    <td>Address 1</td>
    <td>Address 2</td>
    <td>City</td>
    <td>State</td>
    <td>Zip</td>
    <td>Phone</td>
    <td>Fax Number</td>
    <td>Email</td>
    <td>Delete</td>
</tr>
</thead>
<tbody>';
$ContactCounter = 0;
foreach ($ContactsRows AS $contact) {
    $output.='
<tr>
<input type="hidden" id="ContactID' .$ContactCounter.'" name="ContactID'.$ContactCounter.'" value="'.$contact['ContactID'].'">
<td class="col-sm-11">
        <input type="text" name="Contact'.$ContactCounter.'" class="form-control" placeholder="" value='.$ContactCounter.' readonly />
    </td>
    <td class="col-sm-15">
        <input type="text" name="Title'.$ContactCounter.'" class="form-control" value="' .$contact['Title'].'"/>
    </td>
    <td class="col-sm-14">
        <input type="text" name="firstName'.$ContactCounter.'" placeholder="REQUIRED"  value="' .$contact['firstName'].'" class="form-control" required/>
    </td>
    <td class="col-sm-13">
        <input type="text" name="lastName'.$ContactCounter.'" placeholder="" value="' .$contact['lastName'].'" class="form-control" />
    </td>
    <td class="col-sm-12">
        <input type="text" name="Department'.$ContactCounter.'"  value="' .$contact['Department'].'" placeholder="" class="form-control" />
    </td>
    <td class="col-sm-11">
        <input type="text" name="Address1Contact'.$ContactCounter.'" value="' .$contact['Address1'].'" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($Address2Contact0)) {
            $Address2Contact0 = "";
        } ?>
    <td class="col-sm-10">
        <input type="text" name="Address2Contact'.$ContactCounter.'" value="' .$contact['Address2'].'" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($CityContact0)) {
            $CityContact0 = "";
        } ?>
    <td class="col-sm-9">
        <input type="text" name="CityContact'.$ContactCounter.'" value="' .$contact['City'].'"placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($StateContact0)) {
            $StateContact0 = "";
        } ?>
    <td class="col-sm-8">
        <input type="text" name="StateContact'.$ContactCounter.'" value="' .$contact['State'].'" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($ZipContact0)) {
            $ZipContact0 = "";
        } ?>
    <td class="col-sm-7">
        <input type="text" name="ZipContact'.$ContactCounter.'" value="' .$contact['Zip'].'"  placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($PhoneContact0)) {
            $PhoneContact0 = "";
        } ?>
    <td class="col-sm-6">
        <input type="text" name="PhoneContact'.$ContactCounter.'" value="' .$contact['Phone'].'"  placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($faxNumberContact0)) {
            $faxNumberContact0 = "";
        } ?>
    <td class="col-sm-5">
        <input type="text" name="faxNumberContact'.$ContactCounter.'" value="' .$contact['faxNumber'].'" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($email0)) {
            $email0 = "";
        } ?>
    <td class="col-sm-4">
        <input type="text" name="email'.$ContactCounter.'" value="' .$contact['email'].'" placeholder=""  class="form-control" />
    </td>
    <td><input type="button" class="ibtnDelContact btn btn-md btn-danger " onClick="confDeleteSubmitContact('.$contact['ContactID'].')"value="Delete"></form></td>
    </td>';
    $ContactCounter++;
    }
    $output.='
</tr>
<input type="hidden" id="Contactcounter" name="Contactcounter" value="'.$ContactCounter.'">
</tbody>
<tfoot>
<tr>
    <td colspan="13" style="text-align: left;">
        <input type="button" class=" buttonStyle" id="addrowContact" value="Add Additional Contact" />
    </td>
</tr>
</tfoot>
</table>
  <div class="column">
    <label><b>Job Sites:</b></label>
  </div>
<table id="JobSiteInputTable" class=" table order-list-JobSite"style="width: 100%;">
<thead>
<tr>
    <td>ID</td>
    <td>Contact</td>
    <td>Phone</td>
    <td>Fax</td>
    <td>Address 1</td>
    <td>Address 2</td>
    <td>City</td>
    <td>State</td>
    <td>Zip</td>
    <td>Working Hours</td>
    <td>Directions</td>
    <td>Solicited for Work</td>
    <td>Delete</td>
</tr>
</thead>
<tbody>';
$JobSiteCounter = 0;
foreach ($JobSiteRows AS $JobSite) {
    if (!is_null($JobSite['SolicitedConfirmed'])) {
        $checkboxCheckedSolicited = "checked";
    } else {
        $JobSite['SolicitedConfirmed'] = "0";
        $checkboxCheckedSolicited = "";
    }
    $output.='
<tr>
<td class="col-sm-13">
<?php if(!isSet($JobSite0)) {
            $JobSite0 = "";
        } ?>
        <input type="text" name="JobSite'.$JobSiteCounter.'" class="form-control" value = "'.$JobSiteCounter.'" placeholder="" readonly/>
    </td>
    <?php if(!isSet($siteContact0)) {
            $siteContact0 = "";
        } ?>
    <td class="col-sm-12">
        <input type="number" min="0" name="siteContact'.$JobSiteCounter.'" class="form-control" value="' .$JobSite['siteContact'].'" placeholder="EX: 0 for Contact ID 0" REQUIRED/>
    </td>
    <?php if(!isSet($PhoneJobSite0)) {
            $PhoneJobSite0 = "";
        } ?>
    <td class="col-sm-11">
        <input type="text" name="PhoneJobSite'.$JobSiteCounter.'" class="form-control" value="' .$JobSite['Phone'].'" placeholder=""/>
    </td>
    <?php if(!isSet($faxJobSite0)) {
            $faxJobSite0 = "";
        } ?>
    <td class="col-sm-10">
        <input type="text" name="FaxJobSite'.$JobSiteCounter.'" placeholder="" value="' .$JobSite['Fax'].'"class="form-control"/>
    </td>
    <?php if(!isSet($Address1JobSite0)) {
            $Address1JobSite0 = "";
        } ?>
    <td class="col-sm-9">
        <input type="text" name="Address1JobSite'.$JobSiteCounter.'" value="' .$JobSite['Address1'].'" placeholder="REQUIRED" class="form-control" required/>
    </td>
    <?php if(!isSet($Address2JobSite0)) {
            $Address2JobSite0 = "";
        } ?>
    <td class="col-sm-8">
        <input type="text" name="Address2JobSite'.$JobSiteCounter.'" value="' .$JobSite['Address2'].'" placeholder="" class="form-control" />
    </td>
    <?php if(!isSet($CityJobSite0)) {
            $CityJobSite0 = "";
        } ?>
    <td class="col-sm-7">
        <input type="text" name="CityJobSite'.$JobSiteCounter.'" value="' .$JobSite['City'].'" placeholder=""  class="form-control"/>
    </td>
    <?php if(!isSet($StateJobSite0)) {
            $StateJobSite0 = "";
        } ?>
    <td class="col-sm-6">
        <input type="text" name="StateJobSite'.$JobSiteCounter.'" value="' .$JobSite['State'].'" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($ZipJobSite0)) {
            $ZipJobSite0 = "";
        } ?>
    <td class="col-sm-5">
        <input type="text" name="ZipJobSite'.$JobSiteCounter.'" value="' .$JobSite['Zip'].'" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($WorkingHours0)) {
            $WorkingHours0 = "";
        } ?>
    <td class="col-sm-4">
        <textarea type="text" name="WorkingHours'.$JobSiteCounter.'" value="' .$JobSite['WorkingHours'].'" text= "' .$JobSite['WorkingHours'].'"  class="form-control" form="EditForm">'.$JobSiteRows[0]['WorkingHours'].'</textarea>
    </td>
    <?php if(!isSet($Directions0)) {
            $Directions0 = "";
        } ?>
    <td class="col-sm-3">
        <textarea type="text" name="Directions'.$JobSiteCounter.'" value="' .$JobSite['Directions'].'"  class="form-control" form="EditForm">'.$JobSite['Directions'].'</textarea>
    </td>
    <td class= "col-sm-3">
    <input name ="SolicitedConfirmed'. $JobSiteCounter.'" type="checkbox" value= "' .$JobSite['SolicitedConfirmed'].'" '.$checkboxCheckedSolicited.' placeholder="">
    </td>
    <td><input type="button" class="ibtnDelJobSite btn btn-md btn-danger "  onClick="confDeleteSubmitJobSite('.$JobSite['JobSiteID'].')"value="Delete"></form></td>
    </td>
    <input type="hidden" id="JobSiteID' .$JobSiteCounter.'" name="JobSiteID' .$JobSiteCounter.'" value="'.$JobSite['JobSiteID'].'">
</tr>
</tbody>';
$JobSiteCounter++;

}
$output .='
<input type="hidden" id="JobSitecounter" name="JobSitecounter" value="'.$JobSiteCounter.'">
<tfoot>
<tr>
    <td colspan="11" style="text-align: left;">
        <input type="button" class=" buttonStyle" id="addrowJobSite" value="Add Additional Job Site" />
    </td>
</tr>
</tfoot>
</table>
<div class="column">
    <label><b>Machinery:</b></label>
</div>
<table id="MachineryInputTable" class=" table order-list-Machinery"style="width: 100%;">
<thead>
<tr>
    <td>ID</td>
    <td>MD</td>
    <td>Serial Number</td>
    <td>Range</td>
    <td>Last Calibration Date</td>
    <td>Repair Price</td>
    <td>Job Site</td>
    <td>Delete</td>
</tr>
</thead>
<tbody>';
$MachineryCounter = 0;
foreach ($MachineryRows AS $Machinery) {
    if(is_null($Machinery['JobSiteID'])) {
        $Machinery['JobSiteID'] = 0;
    }
    $output.='
<tr>
<td class="col-sm-8">
        <input type="text" name="Machine'.$MachineryCounter.'" class="form-control" placeholder=""value="'.$MachineryCounter.'" readonly/>
    </td>
    <td class="col-sm-8">
    <?php if(!isSet($MD0)) {
            $MD0 = "";
        } ?>
        <input type="text" name="MD'.$MachineryCounter.'" class="form-control" value="' .$Machinery['MD'].'" placeholder="" />
    </td>
    <td class="col-sm-7">
    <?php if(!isSet($SerialNumber0)) {
            $SerialNumber0 = "";
        } ?>
        <input type="text" name="SerialNumber'.$MachineryCounter.'" value="' .$Machinery['SerialNumber'].'" placeholder=""  class="form-control"/>
    </td>
    <td class="col-sm-6">
    <?php if(!isSet($Range0)) {
            $Range0 = "";
        } ?>
        <input type="text" name="MachineRange'.$MachineryCounter.'" value="' .$Machinery['MachineRange'].'" placeholder="" class="form-control" />
    </td>
    <td class="col-sm-5">
        <input type="date" name="LastCalibrationDate'.$MachineryCounter.'" value="'.date("Y-m-d", strtotime($Machinery['lastCalibrationDate'])).'" placeholder="" class="form-control" />
    </td>
    <td class="col-sm-4">
    <?php if(!isSet($RepairPrice0)) {
            $RepairPrice0 = "";
        } ?>
        <input type="text" name="RepairPrice'.$MachineryCounter.'" value="' .$Machinery['Cost'].'" placeholder=""  class="form-control" required />
    </td>
    <td class="col-sm-3">
    <?php if(!isSet($MachineryJobSiteID0)) {
            $MachineryJobSiteID0 = "";
        } ?>
        <input type="number" min="0"name="MachineryJobSiteID'.$MachineryCounter.'" value = "'.$Machinery['JobSiteID'].'" placeholder="EX: 0 for Job Site ID 0"  class="form-control" required/>
    </td>
    <td><input type="button" class="ibtnDelMachinery btn btn-md btn-danger "onClick="confDeleteSubmitMachinery('.$Machinery['MachineryID'].')"value="Delete"></td>
    </td>
</tr>
<input type="hidden" id="MachineryID'.$MachineryCounter.'" name="MachineryID'.$MachineryCounter.'" value="'.$Machinery['MachineryID'].'">
</tbody>';
$MachineryCounter++;
}
$output .='
<input type="hidden" id="Machinecounter" name="Machinecounter" value="'.$MachineryCounter.'">
<tfoot>
<tr>
    <td colspan="7" style="text-align: left;">
        <input type="button" class="buttonStyle" id="addrowMachinery" value="Add Additional Machine" />
    </td>
</tr>
</tfoot>
</table>
<div class="column">
    <label><b>Tour Month:</b></label>
    <input id="companyTourMonthInput" type="date" value="' .$CustomerRow['TourMonth'].'" placeholder="" name="compTourInput">
</div>
<div class="column">
<?php if(!isSet($SolicitationDateInput)) {
            $SolicitationDateInput = "";
        } ?>
    <label><b>Solicitation Date:</b></label>
    <input id="SolicitationDateInput" type="date" value="' .date("Y-m-d", strtotime($CustomerRow['SolicitationDate'])).'" placeholder="" name="SolicitationDateInput">
</div>
<div class="column">
<?php if(!isSet($DateAcquiredInput)) {
            $DateAcquiredInput = "";
        } ?>
    <label><b>Date Acquired:</b></label>
    <input id="DateAcquiredInput" type="date" value="' .date("Y-m-d", strtotime($CustomerRow['dateAcquired'])).'" placeholder="" name="DateAcquiredInput">
</div>
<div class="column">
<?php if(!isSet($ScheduledDateInput)) {
            $ScheduledDateInput = "";
        } ?>
    <label><b>Scheduled Date:</b></label>
    <input id="ScheduledDateInput" type="date" value="' .date("Y-m-d", strtotime($CustomerRow['scheduledDate'])).'" placeholder="" name="ScheduledDateInput">
</div>
<div class="column">
<?php if(!isSet($TaxExemptStatusInput)) {
            $TaxExemptStatusInput = "";
        } ?>
    <label><b>Tax Exempt Status:</b></label>
    <input id="TaxExemptStatusInput" type="text" value="' .$CustomerRow['taxExemptStatus'].'" placeholder="" name="TaxExemptStatusInput">
</div>
<div class="column">
<?php if(!isSet($CountyInputInput)) {
            $CountyInputInput = "";
        } ?>
    <label><b>County:</b></label>
    <input id="CountyInput" type="text" value="' .$CustomerRow['County'].'" placeholder="" name="CountyInputInput">
</div>
<div class="column">
<?php if(!isSet($taxRateInput)) {
            $taxRateInput = "";
        } ?>
    <label><b>Tax Rate:</b></label>
    <input id="taxRateInput" type="text" value="' .$CustomerRow['taxRate'].'" placeholder="" name="taxRateInput">
</div>
<div class="column">
<?php if(!isSet($creditTermsInput)) {
            $creditTermsInput = "";
        } ?>
    <label><b>Credit Terms:</b></label>
    <input id="creditTermsInput" type="text" value="' .$CustomerRow['creditTerms'].'" placeholder="" name="creditTermsInput">
</div>
<div class="column">
<?php if(!isSet($CODDateInput)) {
            $CODDateInput = "";
        } ?>
    <label><b>COD Date:</b></label>
    <input id="CODDateInput" type="date" value="' .date("Y-m-d", strtotime($CustomerRow['COD_Date'])).'" placeholder="" name="CODDateInput">
</div>
<div class="column">
    <label><b>Certs | Instructs :</b></label>
    <input id="CertsInstructsInput" type="checkbox" value= "' .$CustomerRow['certsInstructs'].'" '.$checkboxCheckedCerts.' placeholder="" name="CertsInstructsInput">
</div>
<div class="column">
<?php if(!isSet($activeStatusInput)) {
            $activeStatusInput = "";
        } ?>
    <label><b>Active Status: </b></label>
    <input id="activeStatusInput" type="text" value="' .$CustomerRow['activeStatus'].'" placeholder="Active / Inactive" name="activeStatusInput" required/>
</div>
<div class="column">
    <label><b>QA Requirement: </b></label>
    <input id="QARequirementInput" type="checkbox" value= "' .$CustomerRow['QARequirement'].'" '.$checkboxCheckedQA.' placeholder="" name="QARequirementInput">
</div>
<div class="column">
    <label><b>PO Number: </b></label>
    <input id="PONumInput" type="text" value="' .$CustomerRow['PONum'].'" placeholder="" name="PONumInput">
</div>
<div class="column">
    <label><b>Company Division: </b></label>
    <input id="companyDivisionInput" type="text" value="' .$CustomerRow['companyDivision'].'" placeholder="" name="companyDivisionInput">
</div>
<div class="column">
    <label><b>Call Prior: </b></label>
    <input id="callPriorInput" type="text" value="' .$CustomerRow['callPrior'].'" placeholder="Yes / No" name="callPriorInput">
</div>
<div class="column">
    <label><b>Technician Assigned: </b></label>
    <input id="technicianAssignedInput" type="text" value="' .$CustomerRow['technicianAssigned'].'" placeholder="" name="technicianAssignedInput">
</div>
<div class="column">
    <label><b>Comments: </b></label>
    <input id="CommentsInput" type="text" value="' .$CustomerRow['Comments'].'" placeholder="" name="CommentsInput">
</div>
<div class="column">
    <label><b>Map Done: </b></label>
    <input id="mapDoneInput" type="checkbox" value= "' .$CustomerRow['mapDone'].'" '.$checkboxCheckedMap.' name="mapDoneInput">
    </div>
    <div class="modal-footer">
<input type="submit" class = "buttonFullSize" value="Edit Customer">
</div>
</div>
  </form>
</div>
</div>
</div>
</div>
</div>';
echo $output;
/* The Javascript below is used by the modal generated above and cannot be placed in MainJS
 */
?>
<script>
    var Machinecounter = <?php echo $MachineryCounter?>;
    var Contactcounter = <?php echo $ContactCounter?>;
    var JobSitecounter = <?php echo $JobSiteCounter?>;
    var customerNumber = <?php echo $customerNumber?>;
    /* Add Machinery Button
    changes the counter variable so the correct amount of results are known at all time */
    $("#addrowMachinery").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="col-sm-11"><input type="text" class="form-control" id = "Machine' + Machinecounter + '" name="Machine' + Machinecounter + '" readonly/></td>';
        cols += '<td class="col-sm-8"><input type="text" class="form-control" name="MD' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-7"><input type="text" class="form-control" name="SerialNumber' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-6"><input type="text" class="form-control" name="MachineRange' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-5"><input type="date" class="form-control" name="lastCalibrationDate' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-4"><input type="text" class="form-control" name="RepairPrice' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-3"><input type="number" class="form-control" name="MachineryJobSiteID' + Machinecounter + '"/></td>';

        cols += '<td><input type="button" class=" pull-left ibtnAddMachinery btn btn-md btn-primary" onClick="confAddMachinery(' + Machinecounter + ')" value="Add"><input type="button" class=" pull-right ibtnDelMachinery btn btn-md btn-danger " value="Delete"></td>';

        newRow.append(cols);
        $("table.order-list-Machinery").append(newRow);
        document.getElementById("Machine" + Machinecounter).value = Machinecounter;
        document.getElementById("Machinecounter").value = Machinecounter;
        Machinecounter++;
    });
    /* Add Contact Button 
    changes the counter variable so the correct amount of results are known at all time */
    $("#addrowContact").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="col-sm-11"><input type="text" class="form-control" id = "Contact' + Contactcounter + '" name="Contact' + Contactcounter + '" readonly/></td>';
        cols += '<td class="col-sm-15"><input type="text" class="form-control" name="Title' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-14"><input type="text" class="form-control" name="firstName' + Contactcounter + ' required"/></td>';
        cols += '<td class="col-sm-13"><input type="text" class="form-control" name="lastName' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-12"><input type="text" class="form-control" name="Department' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-11"><input type="text" class="form-control" name="Address1Contact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-10"><input type="text" class="form-control" name="Address2Contact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-9"><input type="text" class="form-control" name="CityContact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-8"><input type="text" class="form-control" name="StateContact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-7"><input type="text" class="form-control" name="ZipContact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-6"><input type="text" class="form-control" name="PhoneContact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-5"><input type="text" class="form-control" name="faxNumberContact' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-4"><input type="text" class="form-control" name="email' + Contactcounter + '"/></td>';

        cols += '<td><input type="button" class="pull-left ibtnAddContact btn btn-md btn-primary" onClick="confAddContact(' + Contactcounter + ')"value="Add"><input type="button" class="pull-right ibtnDelContact btn btn-md btn-danger" value="Delete"></td>';
        
        newRow.append(cols);
        $("table.order-list-Contact").append(newRow);
        document.getElementById("Contact" + Contactcounter).value = Contactcounter;
        document.getElementById("Contactcounter").value = Contactcounter;
        Contactcounter++;
    });
    /* Add Job Site Button
    changes the counter variable so the correct amount of results are known at all time*/
    $("#addrowJobSite").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
        cols += '<td class="col-sm-13"><input type="text" class="form-control" id = "JobSite' + JobSitecounter + '" name="JobSite' + JobSitecounter + '" readonly/></td>';
        cols += '<td class="col-sm-12"><input type="text" class="form-control" name="siteContact' + JobSitecounter + '" REQUIRED /></td>';
        cols += '<td class="col-sm-11"><input type="text" class="form-control" name="PhoneJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-10"><input type="text" class="form-control" name="FaxJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-9"><input type="text" class="form-control" name="Address1JobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-8"><input type="text" class="form-control" name="Address2JobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-7"><input type="text" class="form-control" name="CityJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-6"><input type="text" class="form-control" name="StateJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-5"><input type="text" class="form-control" name="ZipJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-4"><textarea type="text" class="form-control" form="AddForm" name="WorkingHours' + JobSitecounter + '"></textarea></td>';
        cols += '<td class="col-sm-3"><textarea type="text" class="form-control" form="AddForm" name="Directions' + JobSitecounter + '"></textarea></td>';
        cols +='<td class= "col-sm-3"><input id="Solicited" name ="SolicitedConfirmed' + JobSitecounter + '"type="checkbox" value= "" placeholder="" name="SolicitedConfirmed"></td>';

        cols += '<td><input type="button" class=" pull-left ibtnAddJobSite btn btn-md btn-primary " onClick="confAddJobSite(' + JobSitecounter + ')" value="Add"><input type="button" class=" pull-right ibtnDelJobSite btn btn-md btn-danger" value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-JobSite").append(newRow);
        document.getElementById("JobSite" + JobSitecounter).value = JobSitecounter;
        document.getElementById("JobSitecounter").value = JobSitecounter;
        JobSitecounter++;
    });

    //* DELETION FUNCTIONS

    /* Require User confirmation on Contact delete*/
function confDeleteSubmitContact(ContactID) {
    var agree = confirm("Are you sure you want to delete Contact: " + ContactID + "?");
    if (agree) {
        $.ajax({
        type: "POST",
        url: "../view/deleteContact.php",
        data: "contactID="+ ContactID,
        success: function(){
        }
    });
    $("table.order-list-Contact").on("click", ".ibtnDelContact", function(event) {
            $(this).closest("tr").remove();
            Contactcounter -= 1
            document.getElementById("Contactcounter").value = Contactcounter;
            });
    }
}
/* Require User confirmation on JobSite delete*/
function confDeleteSubmitJobSite(JobSiteID) {
    var agree = confirm("Are you sure you want to delete Job Site: " + JobSiteID + "?");
    if (agree) {
        $.ajax({
        type: "POST",
        url: "../view/deleteJobSite.php",
        data: "JobSiteID="+ JobSiteID,
        success: function(){
        }
    });
    $("table.order-list-JobSite").on("click", ".ibtnDelJobSite", function(event) {
            $(this).closest("tr").remove();
            JobSitecounter -= 1;
            document.getElementById("JobSiteCounter").value = JobSitecounter;
            });
    }
}
/* Require User confirmation on Machinery delete*/
function confDeleteSubmitMachinery(MachineryID) {
    var agree = confirm("Are you sure you want to delete Machinery: " + MachineryID + "?");
    if (agree) {
        $.ajax({
        type: "POST",
        url: "../view/deleteMachinery.php",
        data: "MachineryID="+ MachineryID,
        success: function(){
        }
    });
    $("table.order-list-Machinery").on("click", ".ibtnDelMachinery", function(event) {
            $(this).closest("tr").remove();
            Machinecounter -= 1;
            document.getElementById("JobSiteCounter").value = Machinecounter;
            });
    }
}


//* ADDING FUNCTIONS


/* Require User confirmation on Contact delete*/
function confAddContact(counter) {
var agree = confirm("Are you sure you want to add this Contact?");

if (agree) {
    var Title = $("#Title" + counter).val();
    var firstName = $("#firstName" + counter).val();
    var lastName = $("#lastName" + counter).val();
    var Department = $("#Department" + counter).val();
    var Address1 = $("#Address1Contact" + counter).val();
    var Address2 = $("#Address2Contact" + counter).val();
    var City = $("#CityContact" + counter).val();
    var State = $("#StateContact" + counter).val();
    var Zip = $("#ZipContact" + counter).val();
    var Phone = $("#PhoneContact" + counter).val();
    var faxNumber = $("#FaxContact" + counter).val();
    var email = $("#email" + counter).val();
    $.ajax({
    type: "POST",
    data: {"Title": Title , "customerID":customerNumber, "firstName":firstName, "lastName": lastName, "Department":Department, "Address1":Address1, "Address2":Address2, "City":City, "State":State, "Zip":Zip, "Phone":Phone, "faxNumber":faxNumber, "email":email},
    url: "../view/addContact.php",
    success: function(){
    }
});
    $("table.order-list-Contact").on("click", ".ibtnAddContact", function(event) {
            JobSitecounter += 1;
            $("#JobSiteCounter").val(JobSitecounter);
            });
    }
}
/* Require User confirmation on JobSite delete*/
function confAddJobSite(counter) {
    var agree = confirm("Are you sure you want to add this Job Site?");
    if (agree) {
        $.ajax({
        type: "POST",
        data: {"siteContact": siteContact, "customerID": customerID, "Phone":PhoneJobSite, "FaxJobSite":FaxJobSite, "Address1JobSite":Address1JobSite,"Address2JobSite":Address2JobSite, "CityJobSite":CityJobSite,"StateJobSite":StateJobSite, "ZipJobSite":ZipJobSite, "WorkingHours": WorkingHours, "Directions": Directions},
        url: "../view/addJobSite.php",
        success: function(){
        }
    });
    $("table.order-list-JobSite").on("click", ".ibtnAddJobSite", function(event) {
            });
    }
}
/* Require User confirmation on Machinery delete*/
function confAddMachinery(counter) {
    var agree = confirm("Are you sure you want to add this Machinery?");
    if (agree) {
        $.ajax({
        type: "POST",
        url: "../view/addMachinery.php",
        success: function(){
        }
    });
    $("table.order-list-Machinery").on("click", ".ibtnAddMachinery", function(event) {
            });
    }
}
$("table.order-list-JobSite").on("click", ".ibtnDelJobSite", function(event) {
            $(this).closest("tr").remove();
            JobSitecounter -= 1;
            document.getElementById("JobSitecounter").value = JobSitecounter;
});

$("table.order-list-Machinery").on("click", ".ibtnDelMachinery", function(event) {
            $(this).closest("tr").remove();
            Machinecounter -= 1;
            document.getElementById("Machinecounter").value = Machinecounter;
});

$("table.order-list-Contact").on("click", ".ibtnDelContact", function(event) {
    $(this).closest("tr").remove();
    Contactcounter -= 1
    document.getElementById("Contactcounter").value = Contactcounter;
    });
</script>