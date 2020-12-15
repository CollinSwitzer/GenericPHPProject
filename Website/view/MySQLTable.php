<body style="background-color: lightgrey">
<!-- Button trigger modal -->
<input type="checkbox" id="advancedViewToggle" name="advancedViewToggle" value="Advanced View" onchange=TableSwitch()>
<label for="advancedViewToggle">Advanced View</label><br>
<button type="button" id="NewCustomerButton" class= "buttonStyle NewCustomerButton">
  New Customer
</button>
<!-- Display Customer Job Sites, Contacts, or Machinery MODAL -->
<div class="modal" id="CustomerJobSiteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Job Sites</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      <div class="modal-body">
      <div class="container">
    <div style="display: block">
        <label><b>Job Sites Table: </b></label>
      </div>
      <div id="table-wrapper"></div>
      <input type="hidden" id = "JobSiteCustID" value="">
    <table id = "jobSitesTable"class = "display compact cell-border row-border hover order-column">
    <thead><tr>
        <th>Job Site ID</th>
        <th>Site Contact</th>
        <th>Phone</th>
        <th>Fax</th>
        <th>Address 1</th>
        <th>Address 2 </th>
        <th>City </th>
        <th>State</th>
        <th>Zip</th>
        <th>Working Hours</th>
        <th>Directions</th>
    </tr>
    </thead>
    </table>
      </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="CustomerContactsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Contacts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      <div class="modal-body">
          <div class="container">
      <div style="display: block">
        <label><b>Contacts Table: </b></label>
      </div>
      <div id="table-wrapper"></div>
      <input type="hidden" id = "ContactsCustID" value="">
    <table id = "ContactsTable"class = "display compact cell-border row-border hover order-column">
    <thead><tr>
        <th>Contact ID</th>
        <th>Title</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Department </th>
        <th>Address 1</th>
        <th>Address 2</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Phone</th>
        <th>Fax Number</th>
        <th>EMail</th>
    </tr>
    </thead>
    </table>
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal" id="CustomerMachineryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Machinery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
      <div class="modal-body">
        <div class = "container">
      <div style="display: block">
        <label><b>Machinery Table: </b></label>
      </div>
      <div id="table-wrapper"></div>
      <input type="hidden" id = "MachineryCustID" class = "CustID" value="">
    <table id = "MachineryTable"class = "display compact cell-border row-border hover order-column">
    <thead><tr>
        <th>Machinery ID</th>
        <th>Job Site ID</th>
        <th>Serial Number</th>
        <th>MD</th>
        <th>Machine Range</th>
        <th>Last Calibration Date </th>
        <th>Price of Repairs</th>
    </tr>
    </thead>
    </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- NEW CUSTOMER MODAL -->
<div class="modal" id="newCustomerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <input type="hidden" id="newCustomerIDInput" name='CustomerNumberInput' value="<?php echo $companyName ?>">
        <h5 class="modal-title" id= "CustomerModalTitle"> Add/Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="customer_detail">
        <form id= "AddForm" action="../controller/controller.php?action=AddEditCustomer" method="post" enctype = "multipart/form-data">
        <div class="row">
        <div class="column-large">
        <?php if(!isSet($companyName)) {
                    $companyName = "";
                } ?>
            <label><b>Company Name:</b></label>
            <input id="companyNameInput" class="leftAlignInput" type="text" value="<?php echo $companyName ?>" placeholder="REQUIRED" name="compNameInput" required/>
        </div>
        <div class="column-large">
        <?php if(!isSet($companyIdentifier)) {
                    $companyIdentifier = "";
                } ?>
            <label><b>Company Identifier:</b></label>
            <input id="companyIdentifierInput" type="text" value="<?php echo $companyIdentifier ?>"  placeholder="REQUIRED" name="companyIdentifierInput" required/>
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
                <input type="text" name="Title0" class="form-control" value= "<?php echo $Title0 ?>"/>
            </td>
            <?php if(!isSet($firstName0)) {
                    $firstName0 = "";
                } ?>
            <td class="col-sm-14">
                <input type="text" name="firstName0" placeholder="REQUIRED"  value = "<?php echo $firstName0 ?>" class="form-control" required/>
            </td>
            <?php if(!isSet($lastName0)) {
                    $lastName0 = "";
                } ?>
            <td class="col-sm-13">
                <input type="text" name="lastName0" placeholder="REQUIRED" value = "<?php echo $lastName0 ?>"class="form-control" required/>
            </td>
            <?php if(!isSet($Department0)) {
                    $Department0 = "";
                } ?>
            <td class="col-sm-12">
                <input type="text" name="Department0"  value = "<?php echo $Department0 ?>" placeholder="" class="form-control" />
            </td>
            <?php if(!isSet($Address1Contact0)) {
                    $Address1Contact0 = "";
                } ?>
            <td class="col-sm-11">
                <input type="text" name="Address1Contact0" value = "<?php echo $Department0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($Address2Contact0)) {
                    $Address2Contact0 = "";
                } ?>
            <td class="col-sm-10">
                <input type="text" name="Address2Contact0" value = "<?php echo $Address2Contact0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($CityContact0)) {
                    $CityContact0 = "";
                } ?>
            <td class="col-sm-9">
                <input type="text" name="CityContact0" value = "<?php echo $CityContact0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($StateContact0)) {
                    $StateContact0 = "";
                } ?>
            <td class="col-sm-8">
                <input type="text" name="StateContact0" value = "<?php echo $StateContact0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($ZipContact0)) {
                    $ZipContact0 = "";
                } ?>
            <td class="col-sm-7">
                <input type="text" name="ZipContact0" value = "<?php echo $ZipContact0 ?>"  placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($PhoneContact0)) {
                    $PhoneContact0 = "";
                } ?>
            <td class="col-sm-6">
                <input type="text" name="PhoneContact0" value = "<?php echo $PhoneContact0 ?>"  placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($faxNumberContact0)) {
                    $faxNumberContact0 = "";
                } ?>
            <td class="col-sm-5">
                <input type="text" name="faxNumberContact0" value = "<?php echo $faxNumberContact0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($email0)) {
                    $email0 = "";
                } ?>
            <td class="col-sm-4">
                <input type="text" name="email0" value = "<?php echo $email0 ?>" placeholder=""  class="form-control" />
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
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td class="col-sm-13">
        <?php if(!isSet($JobSite0)) {
                    $JobSite0 = "";
                } ?>
                <input type="text" name="JobSite0" class="form-control" value = "<?php echo $JobSite0 ?>" placeholder="" value="0" readonly/>
            </td>
            <?php if(!isSet($siteContact0)) {
                    $siteContact0 = "";
                } ?>
            <td class="col-sm-12">
                <input type="number" min="0" name="siteContact0" class="form-control" value = "<?php echo $siteContact0 ?>" placeholder="EX: 0 for Contact ID 0"/>
            </td>
            <?php if(!isSet($PhoneJobSite0)) {
                    $PhoneJobSite0 = "";
                } ?>
            <td class="col-sm-11">
                <input type="text" name="PhoneJobSite0" class="form-control" value = "<?php echo $PhoneJobSite0 ?>" placeholder=""/>
            </td>
            <?php if(!isSet($faxJobSite0)) {
                    $faxJobSite0 = "";
                } ?>
            <td class="col-sm-10">
                <input type="text" name="FaxJobSite0" placeholder="" value = "<?php echo $faxJobSite0 ?>" class="form-control"/>
            </td>
            <?php if(!isSet($Address1JobSite0)) {
                    $Address1JobSite0 = "";
                } ?>
            <td class="col-sm-9">
                <input type="text" name="Address1JobSite0" value = "<?php echo $Address1JobSite0 ?>" placeholder="REQUIRED" class="form-control" required/>
            </td>
            <?php if(!isSet($Address2JobSite0)) {
                    $Address2JobSite0 = "";
                } ?>
            <td class="col-sm-8">
                <input type="text" name="Address2JobSite0" value = "<?php echo $Address2JobSite0 ?>" placeholder="" class="form-control" />
            </td>
            <?php if(!isSet($CityJobSite0)) {
                    $CityJobSite0 = "";
                } ?>
            <td class="col-sm-7">
                <input type="text" name="CityJobSite0" value = "<?php echo $CityJobSite0 ?>" placeholder=""  class="form-control"/>
            </td>
            <?php if(!isSet($StateJobSite0)) {
                    $StateJobSite0 = "";
                } ?>
            <td class="col-sm-6">
                <input type="text" name="StateJobSite0" value = "<?php echo $StateJobSite0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($ZipJobSite0)) {
                    $ZipJobSite0 = "";
                } ?>
            <td class="col-sm-5">
                <input type="text" name="ZipJobSite0" value = "<?php echo $ZipJobSite0 ?>" placeholder=""  class="form-control" />
            </td>
            <?php if(!isSet($WorkingHours0)) {
                    $WorkingHours0 = "";
                } ?>
            <td class="col-sm-4">
                <textarea type="text" name="WorkingHours0" value = "<?php echo $WorkingHours0 ?>" placeholder=""  class="form-control" form="AddForm"></textarea>
            </td>
            <?php if(!isSet($Directions0)) {
                    $Directions0 = "";
                } ?>
            <td class="col-sm-3">
                <textarea type="text" name="Directions0" value = "<?php echo $Directions0 ?>" placeholder=""  class="form-control" form="AddForm"></textarea>
            </td>
            <td class="col-sm-2"><a class="deleteRow"></a>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10" style="text-align: left;">
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
                <input type="text" name="MD0" class="form-control" value = "<?php echo $MD0 ?>" placeholder="REQUIRED" required/>
            </td>
            <td class="col-sm-7">
            <?php if(!isSet($SerialNumber0)) {
                    $SerialNumber0 = "";
                } ?>
                <input type="text" name="SerialNumber0" value = "<?php echo $SerialNumber0 ?>" placeholder=""  class="form-control"/>
            </td>
            <td class="col-sm-6">
            <?php if(!isSet($Range0)) {
                    $Range0 = "";
                } ?>
                <input type="text" name="Range0" value = "<?php echo $Range0 ?>" placeholder="" class="form-control" />
            </td>
            <td class="col-sm-5">
            <?php if(!isSet($LastCalibrationDate0)) {
                    $LastCalibrationDate0 = "";
                } ?>
                <input type="text" name="LastCalibrationDate0" value = "<?php echo $LastCalibrationDate0 ?>" placeholder="" class="form-control" />
            </td>
            <td class="col-sm-4">
            <?php if(!isSet($RepairPrice0)) {
                    $RepairPrice0 = "";
                } ?>
                <input type="text" name="RepairPrice0" value = "<?php echo $RepairPrice0 ?>" placeholder=""  class="form-control" />
            </td>
            <td class="col-sm-3">
            <?php if(!isSet($MachineryJobSiteID0)) {
                    $MachineryJobSiteID0 = "";
                } ?>
                <input type="number" min="0"name="MachineryJobSiteID0" value = "<?php echo $MachineryJobSiteID0 ?>" placeholder="EX: 0 for Job Site ID 0"  class="form-control" required/>
            </td>
            <td class="col-sm-2"><a class="deleteRow"></a>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: left;">
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
            <input id="companyTourMonthInput" type="Month" value = "<?php echo $compTourInput ?>"  placeholder="" name="compTourInput">
        </div>
        <div class="column">
            <label><b>Scheduled Date:</b></label>
            <?php if(!isSet($ScheduledInput)) {
                    $ScheduledInput = "";
                } ?>
        </div>
        <div class="column">
        <?php if(!isSet($SolicitationDateInput)) {
                    $SolicitationDateInput = "";
                } ?>
            <label><b>Solicitation Date:</b></label>
            <input id="SolicitationDateInput" type="date" value = "<?php echo $SolicitationDateInput ?>" placeholder="" name="SolicitationDateInput">
        </div>
        <div class="column">
        <?php if(!isSet($DateAcquiredInput)) {
                    $DateAcquiredInput = "";
                } ?>
            <label><b>Date Acquired:</b></label>
            <input id="DateAcquiredInput" type="date" value = "<?php echo $DateAcquiredInput ?>" placeholder="" name="DateAcquiredInput">
        </div>
        <div class="column">
        <?php if(!isSet($ScheduledDateInput)) {
                    $ScheduledDateInput = "";
                } ?>
            <label><b>Scheduled Date:</b></label>
            <input id="ScheduledDateInput" type="date" value = "<?php echo $ScheduledDateInput ?>" placeholder="" name="ScheduledDateInput">
        </div>
        <div class="column">
        <?php if(!isSet($TaxExemptStatusInput)) {
                    $TaxExemptStatusInput = "";
                } ?>
            <label><b>Tax Exempt Status:</b></label>
            <input id="TaxExemptStatusInput" type="text" value = "<?php echo $TaxExemptStatusInput ?>" placeholder="" name="TaxExemptStatusInput">
        </div>
        <div class="column">
        <?php if(!isSet($CountyInputInput)) {
                    $CountyInputInput = "";
                } ?>
            <label><b>County:</b></label>
            <input id="CountyInput" type="text" value = "<?php echo $CountyInputInput ?>" placeholder="" name="CountyInputInput">
        </div>
        <div class="column">
        <?php if(!isSet($taxRateInput)) {
                    $taxRateInput = "";
                } ?>
            <label><b>Tax Rate:</b></label>
            <input id="taxRateInput" type="text" value = "<?php echo $taxRateInput ?>" placeholder="" name="taxRateInput">
        </div>
        <div class="column">
        <?php if(!isSet($creditTermsInput)) {
                    $creditTermsInput = "";
                } ?>
            <label><b>Credit Terms:</b></label>
            <input id="creditTermsInput" type="text" value = "<?php echo $creditTermsInput ?>" placeholder="" name="creditTermsInput">
        </div>
        <div class="column">
        <?php if(!isSet($CODDateInput)) {
                    $CODDateInput = "";
                } ?>
            <label><b>COD Date:</b></label>
            <input id="CODDateInput" type="date" value = "<?php echo $CODDateInput ?>" placeholder="" name="CODDateInput">
        </div>
        <div class="column">
        <?php if(!isSet($CertsInstructsInput)) {
                    $CertsInstructsInput = "";
                } ?>
            <label><b>Certs | Instructs :</b></label>
            <input id="CertsInstructsInput" type="text" value = "<?php echo $CertsInstructsInput ?>" placeholder="" name="CertsInstructsInput">
        </div>
        <div class="column">
        <?php if(!isSet($activeStatusInput)) {
                    $activeStatusInput = "";
                } ?>
            <label><b>Active Status: </b></label>
            <input id="activeStatusInput" type="text" value = "<?php echo $activeStatusInput ?>" placeholder="Active / Inactive" name="activeStatusInput" required/>
        </div>
        <div class="column">
        <?php if(!isSet($QARequirementInput)) {
                    $QARequirementInput = "";
                } ?>
            <label><b>QA Requirement: </b></label>
            <input id="QARequirementInput" type="text" value = "<?php echo $QARequirementInput ?>" placeholder="" name="QARequirementInput">
        </div>
        <div class="column">
        <?php if(!isSet($PONumInput)) {
                    $PONumInput = "";
                } ?>
            <label><b>PO Number: </b></label>
            <input id="PONumInput" type="text" value = "<?php echo $PONumInput ?>" placeholder="" name="PONumInput">
        </div>
        <div class="column">
        <?php if(!isSet($companyDivisionInput)) {
                    $companyDivisionInput = "";
                } ?>
            <label><b>Company Division: </b></label>
            <input id="companyDivisionInput" type="text" value = "<?php echo $companyDivisionInput ?>" placeholder="" name="companyDivisionInput">
        </div>
        <div class="column">
        <?php if(!isSet($callPriorInput)) {
                    $callPriorInput = "";
                } ?>
            <label><b>Call Prior: </b></label>
            <input id="callPriorInput" type="text" value = "<?php echo $callPriorInput ?>" placeholder="Yes / No" name="callPriorInput">
        </div>
        <div class="column">
        <?php if(!isSet($technicianAssignedInput)) {
                    $technicianAssignedInput = "";
                } ?>
            <label><b>Technician Assigned: </b></label>
            <input id="technicianAssignedInput" type="text" value = "<?php echo $technicianAssignedInput ?>" placeholder="" name="technicianAssignedInput">
        </div>
        <div class="column">
        <?php if(!isSet($CommentsInput)) {
                    $CommentsInput = "";
                } ?>
            <label><b>Comments: </b></label>
            <input id="CommentsInput" type="text" value = "<?php echo $CommentsInput ?>" placeholder="" name="CommentsInput">
        </div>
        <div class="column">
        <?php if(!isSet($MapDoneInput)) {
                    $MapDoneInput = "";
                } ?>
            <label><b>Map Done: </b></label>
            <input id="mapDoneInput" type="text" value = "<?php echo $MapDoneInput ?>" placeholder="Yes / No" name="mapDoneInput">
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
<!-- DATATABLE ID + TABLE HEADERS -->
<div id="table-wrapper"></div>
    <table id = "displayTable" class = "display compact cell-border row-border hover order-column">
    <thead><tr>
        <th>Customer Number</th>
        <th>Active Status</th>
        <th>Company Name</th>
        <th>Company Identifier</th>
        <th>Job Sites </th>
        <th>Contacts </th>
        <th>Machinery</th>
        <th>Tour Month</th>
        <th>Last Updated</th>
        <th>Options</th>
    </tr>
    </thead>
    </table>
</div>
</body>
</html>