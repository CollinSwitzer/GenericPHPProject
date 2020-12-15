<?php
/* This page is the modal for the creation of new customers */
$output = '<div><form id= "AddForm" action="../controller/controller.php?action=AddCustomer" method="post" enctype = "multipart/form-data">
<div class="row">
<div class="column-large">
    <label><b>Company Name:</b></label>
    <input id="companyNameInput" class="leftAlignInput" type="text" value="" placeholder="REQUIRED" name="compNameInput" required/>
</div>
<div class="column-large">
    <label><b>Company Identifier:</b></label>
    <input id="companyIdentifierInput" type="text" value=""  placeholder="REQUIRED" name="companyIdentifierInput" required/>
  </div>
  <div class="column">
    <label><b>Contacts:</b></label>
</div>
<input type="hidden" id="Contactcounter" name="Contactcounter" value="">
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
<tbody>
<tr>
<td class="col-sm-11">
        <input type="text" name="Contact0" class="form-control" placeholder="" value=0 readonly/>
    </td>
    <td class="col-sm-15">
        <?php if(!isSet($Title0)) {
            $Title0 = "";
        } ?>
        <input type="text" name="Title0" class="form-control" value=""/>
    </td>
    <?php if(!isSet($firstName0)) {
            $firstName0 = "";
        } ?>
    <td class="col-sm-14">
        <input type="text" name="firstName0" placeholder="REQUIRED"  value="" class="form-control" required/>
    </td>
    <?php if(!isSet($lastName0)) {
            $lastName0 = "";
        } ?>
    <td class="col-sm-13">
        <input type="text" name="lastName0" placeholder="" value="" class="form-control"/>
    </td>
    <?php if(!isSet($Department0)) {
            $Department0 = "";
        } ?>
    <td class="col-sm-12">
        <input type="text" name="Department0"  value="" placeholder="" class="form-control" />
    </td>
    <?php if(!isSet($Address1Contact0)) {
            $Address1Contact0 = "";
        } ?>
    <td class="col-sm-11">
        <input type="text" name="Address1Contact0" value="" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($Address2Contact0)) {
            $Address2Contact0 = "";
        } ?>
    <td class="col-sm-10">
        <input type="text" name="Address2Contact0" value="" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($CityContact0)) {
            $CityContact0 = "";
        } ?>
    <td class="col-sm-9">
        <input type="text" name="CityContact0" value=""placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($StateContact0)) {
            $StateContact0 = "";
        } ?>
    <td class="col-sm-8">
        <input type="text" name="StateContact0" value="" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($ZipContact0)) {
            $ZipContact0 = "";
        } ?>
    <td class="col-sm-7">
        <input type="text" name="ZipContact0" value=""  placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($PhoneContact0)) {
            $PhoneContact0 = "";
        } ?>
    <td class="col-sm-6">
        <input type="text" name="PhoneContact0" value=""  placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($faxNumberContact0)) {
            $faxNumberContact0 = "";
        } ?>
    <td class="col-sm-5">
        <input type="text" name="faxNumberContact0" value="" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($email0)) {
            $email0 = "";
        } ?>
    <td class="col-sm-4">
        <input type="text" name="email0" value="" placeholder=""  class="form-control" />
    </td>
    <td class="col-sm-2"><a class="deleteRow"></a>
    </td>
</tr>
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
<input type="hidden" id="JobSitecounter" name="JobSitecounter" value="">
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
<tbody>
<tr>
<td class="col-sm-13">
<?php if(!isSet($JobSite0)) {
            $JobSite0 = "";
        } ?>
        <input type="text" name="JobSite0" class="form-control" value = "0" placeholder="" value="0" readonly/>
    </td>
    <?php if(!isSet($siteContact0)) {
            $siteContact0 = "";
        } ?>
    <td class="col-sm-12">
        <input type="number" min="0" name="siteContact0" class="form-control" value="" placeholder="EX: 0 for Contact ID 0" REQUIRED />
    </td>
    <?php if(!isSet($PhoneJobSite0)) {
            $PhoneJobSite0 = "";
        } ?>
    <td class="col-sm-11">
        <input type="text" name="PhoneJobSite0" class="form-control" value="" placeholder=""/>
    </td>
    <?php if(!isSet($faxJobSite0)) {
            $faxJobSite0 = "";
        } ?>
    <td class="col-sm-10">
        <input type="text" name="FaxJobSite0" placeholder="" value=""class="form-control"/>
    </td>
    <?php if(!isSet($Address1JobSite0)) {
            $Address1JobSite0 = "";
        } ?>
    <td class="col-sm-9">
        <input type="text" name="Address1JobSite0" value="" placeholder="REQUIRED" class="form-control" required/>
    </td>
    <?php if(!isSet($Address2JobSite0)) {
            $Address2JobSite0 = "";
        } ?>
    <td class="col-sm-8">
        <input type="text" name="Address2JobSite0" value="" placeholder="" class="form-control" />
    </td>
    <?php if(!isSet($CityJobSite0)) {
            $CityJobSite0 = "";
        } ?>
    <td class="col-sm-7">
        <input type="text" name="CityJobSite0" value="" placeholder=""  class="form-control"/>
    </td>
    <?php if(!isSet($StateJobSite0)) {
            $StateJobSite0 = "";
        } ?>
    <td class="col-sm-6">
        <input type="text" name="StateJobSite0" value="" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($ZipJobSite0)) {
            $ZipJobSite0 = "";
        } ?>
    <td class="col-sm-5">
        <input type="text" name="ZipJobSite0" value="" placeholder=""  class="form-control" />
    </td>
    <?php if(!isSet($WorkingHours0)) {
            $WorkingHours0 = "";
        } ?>
    <td class="col-sm-4">
        <textarea type="text" name="WorkingHours0" value="" placeholder=""  class="form-control" form="AddForm"></textarea>
    </td>
    <?php if(!isSet($Directions0)) {
            $Directions0 = "";
        } ?>
    <td class="col-sm-3">
        <textarea type="text" name="Directions0" value="" placeholder=""  class="form-control" form="AddForm"></textarea>
    </td>
    <td class= "col-sm-3">
    <input id="Solicited" name ="SolicitedConfirmed0" type="checkbox" value= "1" placeholder="" name="SolicitedConfirmed">
    </td>
    <td class="col-sm-2"><a class="deleteRow"></a>
    </td>
</tr>
</tbody>
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
<input type="hidden" id="Machinecounter" name="Machinecounter" value="">
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
<tbody>
<tr>
<td class="col-sm-8">
        <input type="text" name="Machine0" class="form-control" placeholder=""value="0" readonly/>
    </td>
    <td class="col-sm-8">
    <?php if(!isSet($MD0)) {
            $MD0 = "";
        } ?>
        <input type="text" name="MD0" class="form-control" value="" placeholder=""/>
    </td>
    <td class="col-sm-7">
    <?php if(!isSet($SerialNumber0)) {
            $SerialNumber0 = "";
        } ?>
        <input type="text" name="SerialNumber0" value="" placeholder=""  class="form-control"/>
    </td>
    <td class="col-sm-6">
    <?php if(!isSet($Range0)) {
            $Range0 = "";
        } ?>
        <input type="text" name="MachineRange0" value="" placeholder="" class="form-control" />
    </td>
    <td class="col-sm-5">
    <?php if(!isSet($LastCalibrationDate0)) {
            $LastCalibrationDate0 = "";
        } ?>
        <input type="date" name="LastCalibrationDate0" value="" placeholder="" class="form-control" />
    </td>
    <td class="col-sm-4">
    <?php if(!isSet($RepairPrice0)) {
            $RepairPrice0 = "";
        } ?>
        <input type="text" name="RepairPrice0" value="" placeholder=""  class="form-control" required/>
    </td>
    <td class="col-sm-3">
    <?php if(!isSet($MachineryJobSiteID0)) {
            $MachineryJobSiteID0 = "";
        } ?>
        <input type="number" min="0"name="MachineryJobSiteID0" value = "" placeholder="EX: 0 for Job Site ID 0"  class="form-control" required/>
    </td>
    <td class="col-sm-2"><a class="deleteRow"></a>
    </td>
</tr>
</tbody>
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
    <?php if(!isSet($compTourInput)) {
            $compTourInput = "";
        } ?>
    <input id="companyTourMonthInput" type="Month" value="" placeholder="" name="compTourInput">
</div>
<div class="column">
<?php if(!isSet($SolicitationDateInput)) {
            $SolicitationDateInput = "";
        } ?>
    <label><b>Solicitation Date:</b></label>
    <input id="SolicitationDateInput" type="date" value="" placeholder="" name="SolicitationDateInput">
</div>
<div class="column">
<?php if(!isSet($DateAcquiredInput)) {
            $DateAcquiredInput = "";
        } ?>
    <label><b>Date Acquired:</b></label>
    <input id="DateAcquiredInput" type="date" value="" placeholder="" name="DateAcquiredInput">
</div>
<div class="column">
<?php if(!isSet($ScheduledDateInput)) {
            $ScheduledDateInput = "";
        } ?>
    <label><b>Scheduled Date:</b></label>
    <input id="ScheduledDateInput" type="date" value="" placeholder="" name="ScheduledDateInput">
</div>
<div class="column">
<?php if(!isSet($TaxExemptStatusInput)) {
            $TaxExemptStatusInput = "";
        } ?>
    <label><b>Tax Exempt Status:</b></label>
    <input id="TaxExemptStatusInput" type="text" value="" placeholder="" name="TaxExemptStatusInput">
</div>
<div class="column">
<?php if(!isSet($CountyInputInput)) {
            $CountyInputInput = "";
        } ?>
    <label><b>County:</b></label>
    <input id="CountyInput" type="text" value="" placeholder="" name="CountyInputInput">
</div>
<div class="column">
<?php if(!isSet($taxRateInput)) {
            $taxRateInput = "";
        } ?>
    <label><b>Tax Rate:</b></label>
    <input id="taxRateInput" type="text" value="" placeholder="" name="taxRateInput">
</div>
<div class="column">
<?php if(!isSet($creditTermsInput)) {
            $creditTermsInput = "";
        } ?>
    <label><b>Credit Terms:</b></label>
    <input id="creditTermsInput" type="text" value="" placeholder="" name="creditTermsInput">
</div>
<div class="column">
<?php if(!isSet($CODDateInput)) {
            $CODDateInput = "";
        } ?>
    <label><b>COD Date:</b></label>
    <input id="CODDateInput" type="date" value="" placeholder="" name="CODDateInput">
</div>
<div class="column">
<?php if(!isSet($CertsInstructsInput)) {
            $CertsInstructsInput = "";
        } ?>
    <label><b>Certs | Instructs :</b></label>
    <input id="CertsInstructsInput" type="checkbox" value="1" placeholder="" name="CertsInstructsInput">
</div>
<div class="column">
<?php if(!isSet($activeStatusInput)) {
            $activeStatusInput = "";
        } ?>
    <label><b>Active Status: </b></label>
    <input id="activeStatusInput" type="text" value="" placeholder="Active / Inactive" name="activeStatusInput" required/>
</div>
<div class="column">
<?php if(!isSet($QARequirementInput)) {
            $QARequirementInput = "";
        } ?>
    <label><b>QA Requirement: </b></label>
    <input id="QARequirementInput" type="checkbox" value="1" placeholder="" name="QARequirementInput">
</div>
<div class="column">
<?php if(!isSet($PONumInput)) {
            $PONumInput = "";
        } ?>
    <label><b>PO Number: </b></label>
    <input id="PONumInput" type="text" value="" placeholder="" name="PONumInput">
</div>
<div class="column">
<?php if(!isSet($companyDivisionInput)) {
            $companyDivisionInput = "";
        } ?>
    <label><b>Company Division: </b></label>
    <input id="companyDivisionInput" type="text" value="" placeholder="" name="companyDivisionInput">
</div>
<div class="column">
<?php if(!isSet($callPriorInput)) {
            $callPriorInput = "";
        } ?>
    <label><b>Call Prior: </b></label>
    <input id="callPriorInput" type="text" value="" placeholder="Yes / No" name="callPriorInput">
</div>
<div class="column">
<?php if(!isSet($technicianAssignedInput)) {
            $technicianAssignedInput = "";
        } ?>
    <label><b>Technician Assigned: </b></label>
    <input id="technicianAssignedInput" type="text" value="" placeholder="" name="technicianAssignedInput">
</div>
<div class="column">
<?php if(!isSet($CommentsInput)) {
            $CommentsInput = "";
        } ?>
    <label><b>Comments: </b></label>
    <input id="CommentsInput" type="text" value="" placeholder="" name="CommentsInput">
</div>
<div class="column">
<?php if(!isSet($MapDoneInput)) {
            $MapDoneInput = "";
        } ?>
    <label><b>Map Done: </b></label>
    <input id="mapDoneInput" type="checkbox" value="1" placeholder="Yes / No" name="mapDoneInput">
    </div>
    <div class="modal-footer">
<input type="submit" class = "buttonStyle" value="Add New Customer">
</div>
</div>
  </form>
</div>
</div>
</div>
</div>
</div>
</div>';
echo $output;
/* The scripts below allow the various buttons to function in the modal created, can't be placed in MainJS file*/
?>
<script>
    <?php
    ?>
    var Machinecounter = 0;
    var Contactcounter = 0;
    var JobSitecounter = 0;
    $("#addrowMachinery").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
        Machinecounter++;
        cols += '<td class="col-sm-11"><input type="text" class="form-control" id = "Machine' + Machinecounter + '" name="Machine' + Machinecounter + '" readonly/></td>';
        cols += '<td class="col-sm-8"><input type="text" class="form-control" name="MD' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-7"><input type="text" class="form-control" name="SerialNumber' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-6"><input type="text" class="form-control" name="MachineRange' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-5"><input type="date" class="form-control" name="lastCalibrationDate' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-4"><input type="text" class="form-control" name="RepairPrice' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-3"><input type="number" class="form-control" name="MachineryJobSiteID' + Machinecounter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDelMachinery btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Machinery").append(newRow);
        document.getElementById("Machine" + Machinecounter).value = Machinecounter;
        document.getElementById("Machinecounter").value = Machinecounter;
    });
    $("#addrowContact").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
        Contactcounter++;
        cols += '<td class="col-sm-11"><input type="text" class="form-control" id = "Contact' + Contactcounter + '" name="Contact' + Contactcounter + '" readonly/></td>';
        cols += '<td class="col-sm-15"><input type="text" class="form-control" name="Title' + Contactcounter + '"/></td>';
        cols += '<td class="col-sm-14"><input type="text" class="form-control" name="firstName' + Contactcounter + '"/></td>';
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

        cols += '<td><input type="button" class="ibtnDelContact btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Contact").append(newRow);
        document.getElementById("Contact" + Contactcounter).value = Contactcounter;
        document.getElementById("Contactcounter").value = Contactcounter;
    });
    $("#addrowJobSite").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
        JobSitecounter++;
        cols += '<td class="col-sm-13"><input type="text" class="form-control" id = "JobSite' + JobSitecounter + '" name="JobSite' + JobSitecounter + '" readonly/></td>';
        cols += '<td class="col-sm-12"><input type="text" class="form-control" name="siteContact' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-11"><input type="text" class="form-control" name="PhoneJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-10"><input type="text" class="form-control" name="FaxJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-9"><input type="text" class="form-control" name="Address1JobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-8"><input type="text" class="form-control" name="Address2JobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-7"><input type="text" class="form-control" name="CityJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-6"><input type="text" class="form-control" name="StateJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-5"><input type="text" class="form-control" name="ZipJobSite' + JobSitecounter + '"/></td>';
        cols += '<td class="col-sm-4"><textarea type="text" class="form-control" form="AddForm" name="WorkingHours' + JobSitecounter + '"></textarea></td>';
        cols += '<td class="col-sm-3"><textarea type="text" class="form-control" form="AddForm" name="Directions' + JobSitecounter + '"></textarea></td>';
        cols +='<td class= "col-sm-3"><input id="Solicited" name ="SolicitedConfirmed' + JobSitecounter + '" type="checkbox" value= "1" placeholder="" name="SolicitedConfirmed"></td>';

        cols += '<td><input type="button" class="ibtnDelJobSite btn btn-md btn-danger " value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-JobSite").append(newRow);
        document.getElementById("JobSite" + JobSitecounter).value = JobSitecounter;
        document.getElementById("JobSitecounter").value = JobSitecounter;
    });
    $("table.order-list-JobSite").on("click", ".ibtnDelJobSite", function(event) {
        $(this).closest("tr").remove();
        JobSitecounter -= 1
        document.getElementById("JobSitecounter").value = JobSitecounter;
    });
    $("table.order-list-Machinery").on("click", ".ibtnDelMachinery", function(event) {
        $(this).closest("tr").remove();
        Machinecounter -= 1
        document.getElementById("Machinecounter").value = Machinecounter;

    });
    $("table.order-list-Contact").on("click", ".ibtnDelContact", function(event) {
        $(this).closest("tr").remove();
        Contactcounter -= 1
        document.getElementById("Contactcounter").value = Contactcounter;

    });
</script>