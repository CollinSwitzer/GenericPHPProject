<?php
/* This controller interacts with the user's actions of the page and allows certain events to happen based on their input
Uses elements from the model.php file to complete these actions*/
session_start();
require_once '../model/model.php';
require_once '../lib/general_functions.php';
/* Get the user's actions from the view*/
if (isset($_POST['action']))
{
    $action = $_POST['action'];
}
else if (isset($_GET['action']))
{
    $action = $_GET['action'];
} else
{
    include('../view/main.php');
    exit();
}
/* Check Action Type*/
switch ($action) 
    {
        case 'weeklySchedule':
            include '../view/weeklySchedule.php';
            break;
        case 'bulletinBoard':
            include '../view/displayBulletin.php';
            break;
        case 'workOrder':
            include '../view/workorder.php';
            break;
        case 'login':
            include '../view/login.php';
            break;
        case 'Admin' :
            break;
        case 'EditCustomer' :
            processEdit();
            break;
        case 'AddCustomer' :
            processAdd();
            break;
        case 'PasswordReset' :
            include '../view/reset-password.php';
            break;
        case 'viewCustomerJobSites' :
            viewCustomerJobSites();
            include '../view/main.php';
            break;
        case 'viewCustomerContacts' :
            viewCustomerContacts();
            break;
        case 'ViewCustomerMachinery' :
            viewCustomerMachinery();
            break;
        case 'ProcessDelete' :
            deleteCustomer();
        break;
        case 'Grading' :
            break;
        case 'UserControl' :
            include '../view/AddAdmin.php';
            break;
        case 'Main' :
            include '../view/main.php';
            break;
        default:
            include('../view/main.php');
    }
/* Unused */
function editCustomer($customerNumber) {
    $row = getAllCustomerInfoFromCustomer($customerNumber);
    
    $mode = "Edit";
    $companyName = $_POST['companyName'];
}
/* Deletes a customer*/
function deleteCustomer() {
    $customerNumber = $_POST['DeleteInput'];
    $row = getCustomer($customerNumber);
    if($row == FALSE) {
        $errorMessage = 'That Customer was not found';
        include '../view/errorPage.php';
    } else {
    $rowCount = deleteOneCustomer($customerNumber);
    if ($rowCount != 1)
    {
        $errorMessage = "The delete affected $rowCount rows.";
        include '../view/errorPage.php';
    } else {
        header("Location: ../controller/controller.php?action=Main");
        }
    }
}
/* Processes the adding of a Customer and its associated information such as Contacts, Job Sites, and Machinery*/
function processAdd() {
    //Counters
    $JobSitecounter = $_POST['JobSitecounter'];
    $Machinecounter = $_POST['Machinecounter'];
    $Contactcounter = $_POST['Contactcounter'];
    //Customer Input Data
    $companyName = $_POST['compNameInput'];
    $TourMonth = $_POST['compTourInput'];
    $companyIdentifier = $_POST['companyIdentifierInput'];
    $dateAcquired = $_POST['DateAcquiredInput'];
    $schduledDate = $_POST['ScheduledDateInput'];
    $taxExemptStatus = $_POST['TaxExemptStatusInput'];
    $County = $_POST["CountyInputInput"];
    $taxRate = $_POST["taxRateInput"];
    $creditTerms = $_POST["creditTermsInput"];
    $COD_Date = $_POST["CODDateInput"];
    /* Changing format for database input*/
    if (isset($_POST["certsInstructsInput"]))
    {
        $certsInstructs = "1";
    } else {
        $certsInstructs = 0;
    }
    $activeStatus = $_POST["activeStatusInput"];
    /* Changing format for database input*/
    if (isset($_POST["QARequirementInput"]))
    {
        $QARequirement = "1";
    } else {
        $QARequirement = 0;
    }
    $PONum = $_POST["PONumInput"];
    $companyDivision = $_POST["companyDivisionInput"];
    $callPrior = $_POST["callPriorInput"];
    $technicianAssigned = $_POST["technicianAssignedInput"];
    $Comments = $_POST["CommentsInput"];
    /* Changing format for database input*/
    if (isset($_POST["mapDoneInput"]))
    {
        $mapDone = "1";
    } else {
        $mapDone = 0;
    }
    $SolicitationDate = $_POST["SolicitationDateInput"];

    /* These loops create and load in the amount of neccesary information that a customer will have which is determined
    by their counters so a Customer with a JobSitecounter of 5 will have 5 Job Sites created and 5 of these sets of variables to be inputed later */

    //Job Site Data
    for ($i = 0; $i <= $JobSitecounter; $i++)
    {
        ${"siteContact" . $i} = $_POST['siteContact' . $i];
        ${"PhoneJobSite" . $i} = $_POST['PhoneJobSite' . $i];
        ${"FaxJobSite" . $i} = $_POST['FaxJobSite' . $i];
        ${"Address1JobSite" . $i} = $_POST['Address1JobSite' . $i];
        ${"Address2JobSite" . $i} = $_POST['Address2JobSite' . $i];
        ${"CityJobSite" . $i} = $_POST['CityJobSite' . $i];
        ${"StateJobSite" . $i} = $_POST['StateJobSite' . $i];
        ${"ZipJobSite" . $i} = $_POST['ZipJobSite' . $i];
        ${"WorkingHours" . $i} = $_POST['WorkingHours' . $i];
        ${"Directions" . $i} = $_POST['Directions' . $i];
        ${"SolicitedConfirmed" . $i} = $_POST['SolicitedConfirmed' . $i];
        if (isset($_POST[${"SolicitedConfirmed" . $i}]))
        {
            ${"SolicitedConfirmed" . $i} = "1";
        } else {
            ${"SolicitedConfirmed" . $i} = 0;
        }
    }
    //Contact Data
    for ($i = 0; $i<= $Contactcounter; $i++)
    {
        ${"Contact" . $i} = $_POST['Contact' . $i];
        ${"Title" . $i} = $_POST['Title' . $i];
        ${"firstName" . $i} = $_POST['firstName' . $i];
        ${"lastName" . $i} = $_POST['lastName' . $i];
        ${"Department" . $i} = $_POST['Department' . $i];
        ${"Address1Contact" . $i} = $_POST['Address1Contact' . $i];
        ${"Address2Contact" . $i} = $_POST['Address2Contact' . $i];
        ${"CityContact" . $i} = $_POST['CityContact' . $i];
        ${"StateContact" . $i} = $_POST['StateContact' . $i];
        ${"ZipContact" . $i} = $_POST['ZipContact' . $i];
        ${"PhoneContact" . $i} = $_POST['PhoneContact' . $i];
        ${"faxNumberContact" . $i} = $_POST['faxNumberContact' . $i];
        ${"email" . $i} = $_POST['email' . $i];    }
    //Machinery Data
    for ($i = 0; $i<= $Machinecounter; $i++)
    {
        ${"SerialNumber" . $i} = $_POST['SerialNumber' . $i];
        ${"MD" . $i} = $_POST['MD' . $i];
        ${"MachineRange" . $i} = $_POST['MachineRange' . $i];
        ${"LastCalibrationDate" . $i} = $_POST['LastCalibrationDate' . $i];
        ${"RepairPrice" . $i} = $_POST['RepairPrice' . $i];
        ${"MachineryJobSiteID" . $i} = $_POST['MachineryJobSiteID' . $i];
    }
    //Validations
    $errors = "";
    //Customer Errors
    if (empty($companyName) || strlen($companyName) > 100) {
        $errors .= "* Company Name is required to be no more than 100 characters.\\n ";
    }
    if (!empty($TourMonth) && !strtotime($TourMonth)) {
        $errors .= "* Either leave the Tour Month blank or provide a valid date. ";
    }
    if (empty($companyIdentifier) || strlen($companyIdentifier) > 50) {
        $errors .= "* Company Identifier is required to be no more than 50 characters.\\n ";
    }
    if (!empty($lastUpdated) && !strtotime($lastUpdated)) {
        $errors .= "* Either leave the Last Updated blank or provide a valid date. ";
    }
    if (!empty($dateAcquired) && !strtotime($dateAcquired) > 30) {
        $errors .= "* Either leave the Date Acquired blank or provide a valid date. ";
    }
    if (!empty($schduledDate) && !strtotime($schduledDate) > 30) {
        $errors .= "* Either leave the Scheduled Date blank or provide a valid date. ";
    }
    if (!empty($taxExemptStatus) && strlen($taxExemptStatus) > 5) {
        $errors .= "* Tax Exempt Status must be less than 5 characters ";
    }
    if(!empty($taxRate) && $taxRate>100 && $taxRate<0) {
        $errors .= "* Leave Tax Rate blank or give a tax value between 0 and 100%. ";
    }
    if(!empty($creditTerms) && strlen($creditTerms) > 20) {
        $errors .= "* Leave Credit Terms blank or have it be no more than 20 characters. ";
    }
    if(!empty($COD_Date) && strlen($COD_Date) > 25) {
        $errors .= "* Leave COD_Date blank or have it be no more than 25 characters. ";
    }
    if(!empty($certsInstructs) && strlen($certsInstructs) > 1) {
        $errors .= "* Leave Certs / Instructs blank or have it be a 'Yes' or 'No'";
    }
    if(empty($activeStatus) || strlen($activeStatus) > 25) {
        $errors .= "* Active Status is required to be no more than 25 characters";
    }
    if(!empty($QARequirement) && strlen($QARequirement) > 1) {
        $errors .= "* Leave QARequirement blank or have it be a 'Yes' or 'No'";
    }
    if(!empty($PONum) && strlen($activeStatus) > 50) {
        $errors .= "* Leave PONum be  blank or have it be no more than 50 characters";
    }
    if(!empty($companyDivision) && strlen($companyDivision) > 100) {
        $errors .= "* Leave Company Division  blank or have it be no more than 100 characters";
    }
    if(!empty($callPrior) && strlen($callPrior) > 25) {
        $errors .= "* Leave Call Prior  blank or have it be no more than 25 characters";
    }
    if(!empty($technicianAssigned) && strlen($technicianAssigned) > 10) {
        $errors .= "* Leave Technician Assigned blank or have it be no more than 10 characters";
    }
    if (!empty($SolicitationDate) && !strtotime($SolicitationDate) > 30) {
        $errors .= "* Either leave the Solicitation Date blank or provide a valid date. ";
    }
    //Job Site Errors Errors
    for ($i = 0; $i<= $JobSitecounter; $i++)
    {
        if(!empty(${'PhoneJobSite' . $i}) && strlen(${'PhoneJobSite' . $i}) > 20) {
            $errors .= "* Leave Job Site $i Phone blank or have it be no more than 20 characters";
        }
        if(!empty(${'FaxJobSite' . $i}) && strlen(${'FaxJobSite' . $i}) > 20) {
            $errors .= "* Leave Job Site $i Fax blank or have it be no more than 20 characters";
        }
        if(empty(${'Address1JobSite' . $i}) || strlen(${'Address1JobSite' . $i}) > 100) {
            $errors .= "* Job Site $i Address1 is required to be no more than 100 characters";
        }
        if(!empty(${'Address2JobSite' . $i}) && strlen(${'Address2JobSite' . $i}) > 50) {
            $errors .= "* Leave Job Site $i Address2 blank or have it be no more than 50 characters";
        }
        if(!empty(${'CityJobSite' . $i}) && strlen(${'CityJobSite' . $i}) > 25) {
            $errors .= "* Leave Job Site $i City blank or have it be no more than 25 characters";
        }
        if(!empty(${'StateJobSite' . $i}) && strlen(${'StateJobSite' . $i}) > 10) {
            $errors .= "* Leave Job Site $i State blank or have it be no more than 10 characters (Use 'PA' or 'OH' as examples)";
        }
        if(!empty(${'ZipJobSite' . $i}) && strlen(${'ZipJobSite' . $i}) > 15) {
            $errors .= "* Leave Job Site $i Zip blank or have it be no more than 15 characters";
        }
        //Machinery Errors
        for ($i = 0; $i<= $Machinecounter; $i++)
        {
            if(!empty(${'SerialNumber' . $i}) && strlen(${'SerialNumber' . $i}) > 50) {
                $errors .= "* Leave Machinery $i Serial Number blank or have it be no more than 50 characters";
            }
            if(!empty(${'MD' . $i}) && strlen(${'MD' . $i}) > 100) {
                $errors .= "* Leave Machinery $i MD blankk or have it be no more than 100 characters";
            }
            if(!empty(${'MachineRange' . $i}) && strlen(${'MachineRange' . $i}) > 50) {
                $errors .= "* Leave Machinery $i Range blank or have it be no more than 50 characters";
            }
            if(!empty(${'lastCalibrationDate' . $i}) && strlen(${'lastCalibrationDate' . $i}) > 25) {
                $errors .= "* Leave Last Calibration Date $i blank or insert a valid date";
            }

            if(!empty(${'MachineryJobSiteID' . $i}) && strlen(${'MachineryJobSiteID' . $i}) > 50) {
                $errors .= "* Leave Machinery $i Job Site blank or have it be no more than 50 characters";
            }

        }
    }
    for ($i = 0; $i<= $Contactcounter; $i++)
    {
        //Contact Errors
        if (!empty(${'Title' . $i}) && strlen(${'Title' . $i}) > 5) {
            $errors .= "* Leave Contact $i Title blank or to be no more than 5 characters.\\n ";
        }
        if (empty(${'firstName' . $i}) && strlen(${'firstName' . $i}) > 50) {
            $errors .= "* First Contact $i Name is required to be no more than 50 characters.\\n ";
        }
        if (empty(${'lastName' . $i}) && strlen(${'lastName' . $i}) > 50) {
            $errors .= "* Last Contact $i Name is required to be no more than 50 characters.\\n ";
        }
        if (!empty(${'Department' . $i}) && strlen(${'Department' . $i}) > 100) {
            $errors .= "* Leave Contact $i Department blank or is required to be no more than 100 characters.\\n ";
        }
        if (!empty(${'Address1Contact' . $i}) && strlen(${'Address1Contact' . $i}) > 100) {
            $errors .= "* Leave Contact $i Address1 blank or is required to be no more than 100 characters.\\n ";
        }
        if (!empty(${'Address2Contact'. $i}) && strlen(${'Address2Contact' . $i}) > 50) {
            $errors .= "* Leave Contact $i Address2 blank or is required to be no more than 50 characters.\\n ";
        }
        if (!empty(${'CityContact' . $i}) && strlen(${'CityContact' . $i}) > 25) {
            $errors .= "* Leave Contact $i City blank or is required to be no more than 25 characters.\\n ";
        }
        if (!empty(${'ZipContact' . $i}) && strlen(${'ZipContact' . $i}) > 15) {
            $errors .= "* Leave Contact $i Zip blank or is required to be no more than 15 characters.\\n ";
        }
        if (!empty(${'PhoneContact' . $i}) && strlen(${'PhoneContact' . $i}) > 20) {
            $errors .= "* Leave Contact $Contactcounter Phone blank or is required to be no more than 20 characters.\\n ";
        }
        if (!empty(${'faxNumberContact' . $i}) && strlen(${'faxNumberContact' . $i}) > 20) {
            $errors .= "* Leave Contact $i Fax Number blank or is required to be no more than 20 characters.\\n ";
        }
        if (!empty(${'email' . $i}) && strlen(${'email' . $i}) > 50) {
            $errors .= "* Leave Contact $i email blank or is required to be no more than 50 characters.\\n ";
        }
    
    }
    //END OF ERRORS
    if ($errors != "")
    {
        echo "<script>alert('$errors');</script>";
    //Begin Pushing to Database if no Errors
    } else {
            $customerNumber = insertCustomer($companyName, $TourMonth,$companyIdentifier,$dateAcquired,
            $schduledDate, $taxExemptStatus, $County, $taxRate, $creditTerms, $COD_Date, $certsInstructs, $activeStatus, $QARequirement, 
            $PONum, $companyDivision, $callPrior, $technicianAssigned, $Comments, $mapDone, $SolicitationDate);
            /* These loops take the data created in the loops before and does the correct amount of functions to insert the correct amount of each database element*/
            for ($i = 0; $i<= $Contactcounter; $i++)
            {
                ${'ContactID' . $i} = insertContact($customerNumber, ${'Title' . $i}, ${'firstName' . $i},${'lastName' . $i}, ${'Department' . $i}, ${'Address1Contact' . $i}, ${'Address2Contact' . $i}, ${'CityContact' . $i}, ${'StateContact' . $i}, ${'ZipContact' . $i}, ${'PhoneContact' . $i}, ${'faxNumberContact' . $i}, ${'email' . $i});
            }
            for ($i = 0; $i<= $JobSitecounter; $i++)
            {
                /* Sets a default for siteContact if none is entered */
                if(is_null(${'siteContact' . $i}))
                {
                    $siteContactInput = 0;
                } else
                {
                    $siteContactInput = (${'siteContact' . $i});
                }
                ${'JobSiteID' . $i} = insertJobSite(${'ContactID' . $siteContactInput}, $customerNumber, ${'PhoneJobSite' . $i}, ${'FaxJobSite' . $i}, ${'Address1JobSite' . $i}, ${'Address2JobSite' . $i}, ${'CityJobSite' . $i}, ${'StateJobSite' . $i}, ${'ZipJobSite' . $i}, ${'WorkingHours' . $i}, ${'Directions' . $i}, ${"SolicitedConfirmed" . $i});
            }
            for ($i = 0; $i<= $Machinecounter; $i++)
            {
                ${'priceOfRepairs' + $i} = insertRepairPrice(${'RepairPrice' . $i});
                ${'MachineryID' + $i} = insertMachinery($customerNumber, ${'SerialNumber' . $i},${'MD' . $i}, ${'Range' . $i}, ${'lastCalibrationDate' . $i}, ${'priceOfRepairs' + $i}, ${'MachineryJobSiteID' . $i});
            }
            /* Display the main page after everything is finished*/
        header("Location: ../controller/controller.php?action=Main");
    }
}
/* Same as the processAdd function except for Editing*/
function processEdit() {
    //Counters
    $JobSitecounter = $_POST['JobSitecounter'];
    $Machinecounter = $_POST['Machinecounter'];
    $Contactcounter = $_POST['Contactcounter'];
    //Customer Input Data
    $customerNumber = $_POST['customerNumber'];
    $companyName = $_POST['compNameInput'];
    $TourMonth = $_POST['compTourInput'];
    $companyIdentifier = $_POST['companyIdentifierInput'];
    $dateAcquired = $_POST['DateAcquiredInput'];
    $schduledDate = $_POST['ScheduledDateInput'];
    $taxExemptStatus = $_POST['TaxExemptStatusInput'];
    $County = $_POST["CountyInputInput"];
    $taxRate = $_POST["taxRateInput"];
    $creditTerms = $_POST["creditTermsInput"];
    $COD_Date = $_POST["CODDateInput"];
    /* Changing format for database input*/
    if (isset($_POST["CertsInstructsInput"]))
    {
        $certsInstructs = "1";
    } else {
        $certsInstructs = 0;
    }
    $activeStatus = $_POST["activeStatusInput"];
    /* Changing format for database input*/
    if (isset($_POST["QARequirementInput"]))
    {
        $QARequirement = "1";
    } else {
        $QARequirement = 0;
    }
    $activeStatus = $_POST["activeStatusInput"];
    $PONum = $_POST["PONumInput"];
    $companyDivision = $_POST["companyDivisionInput"];
    $callPrior = $_POST["callPriorInput"];
    $technicianAssigned = $_POST["technicianAssignedInput"];
    $Comments = $_POST["CommentsInput"];
    /* Changing format for database input*/
    if (isset($_POST["mapDoneInput"]))
    {
        $mapDone = "1";
    } else {
        $mapDone = 0;
    }
    $SolicitationDate = $_POST["SolicitationDateInput"];
    //Job Site Data
    for ($i = 0; $i < $JobSitecounter; $i++)
    {
        ${"JobSiteID" . $i} = $_POST['JobSiteID' . $i];
        ${"siteContact" . $i} = $_POST['siteContact' . $i];
        ${"PhoneJobSite" . $i} = $_POST['PhoneJobSite' . $i];
        ${"FaxJobSite" . $i} = $_POST['FaxJobSite' . $i];
        ${"Address1JobSite" . $i} = $_POST['Address1JobSite' . $i];
        ${"Address2JobSite" . $i} = $_POST['Address2JobSite' . $i];
        ${"CityJobSite" . $i} = $_POST['CityJobSite' . $i];
        ${"StateJobSite" . $i} = $_POST['StateJobSite' . $i];
        ${"ZipJobSite" . $i} = $_POST['ZipJobSite' . $i];
        ${"WorkingHours" . $i} = $_POST['WorkingHours' . $i];
        ${"Directions" . $i} = $_POST['Directions' . $i];
        ${"SolicitedConfirmed" . $i} = $_POST['SolicitedConfirmed' . $i];
        /* Changing format for database input*/
        if (isset($_POST[${"SolicitedConfirmed" . $i}]))
        {
            ${"SolicitedConfirmed" . $i} = "1";
        } else {
            ${"SolicitedConfirmed" . $i} = 0;
        }
    }
    //Contact Data
    for ($i = 0; $i< $Contactcounter; $i++)
    {
        ${"ContactID" . $i} = $_POST['ContactID' . $i];
        ${"Contact" . $i} = $_POST['Contact' . $i];
        ${"Title" . $i} = $_POST['Title' . $i];
        ${"firstName" . $i} = $_POST['firstName' . $i];
        ${"lastName" . $i} = $_POST['lastName' . $i];
        ${"Department" . $i} = $_POST['Department' . $i];
        ${"Address1Contact" . $i} = $_POST['Address1Contact' . $i];
        ${"Address2Contact" . $i} = $_POST['Address2Contact' . $i];
        ${"CityContact" . $i} = $_POST['CityContact' . $i];
        ${"StateContact" . $i} = $_POST['StateContact' . $i];
        ${"ZipContact" . $i} = $_POST['ZipContact' . $i];
        ${"PhoneContact" . $i} = $_POST['PhoneContact' . $i];
        ${"faxNumberContact" . $i} = $_POST['faxNumberContact' . $i];
        ${"email" . $i} = $_POST['email' . $i];
    }
    //Machinery Data
    for ($i = 0; $i< $Machinecounter; $i++)
    {
        ${"MachineryID" . $i} = $_POST['MachineryID' . $i];
        ${"SerialNumber" . $i} = $_POST['SerialNumber' . $i];
        ${"MD" . $i} = $_POST['MD' . $i];
        ${"MachineRange" . $i} = $_POST['MachineRange' . $i];
        ${"LastCalibrationDate" . $i} = $_POST['LastCalibrationDate' . $i];
        ${"RepairPrice" . $i} = $_POST['RepairPrice' . $i];
        ${"MachineryJobSiteID" . $i} = $_POST['MachineryJobSiteID' . $i];
    }
    //Validations
    $errors = "";
    //Customer Errors
    if (empty($companyName) || strlen($companyName) > 100) {
        $errors .= "* Company Name is required to be no more than 100 characters.\\n ";
    }
    if (!empty($TourMonth) && !strtotime($TourMonth)) {
        $errors .= "* Either leave the Tour Month blank or provide a valid date. ";
    }
    if (empty($companyIdentifier) || strlen($companyIdentifier) > 50) {
        $errors .= "* Company Identifier is required to be no more than 50 characters.\\n ";
    }
    if (!empty($lastUpdated) && !strtotime($lastUpdated)) {
        $errors .= "* Either leave the Last Updated blank or provide a valid date. ";
    }
    if (!empty($dateAcquired) && !strtotime($dateAcquired) > 30) {
        $errors .= "* Either leave the Date Acquired blank or provide a valid date. ";
    }
    if (!empty($schduledDate) && !strtotime($schduledDate) > 30) {
        $errors .= "* Either leave the Scheduled Date blank or provide a valid date. ";
    }
    if (!empty($taxExemptStatus) && strlen($taxExemptStatus) > 5) {
        $errors .= "* Tax Exempt Status must be less than 5 characters ";
    }
    if(!empty($taxRate) && $taxRate>100 && $taxRate<0) {
        $errors .= "* Leave Tax Rate blank or give a tax value between 0 and 100%. ";
    }
    if(!empty($creditTerms) && strlen($creditTerms) > 20) {
        $errors .= "* Leave Credit Terms blank or have it be no more than 20 characters. ";
    }
    if(!empty($COD_Date) && strlen($COD_Date) > 25) {
        $errors .= "* Leave COD_Date blank or have it be no more than 25 characters. ";
    }
    if(!empty($certsInstructs) && strlen($certsInstructs) > 1) {
        $errors .= "* Leave Certs / Instructs blank or have it be a 'Yes' or 'No'";
    }
    if(empty($activeStatus) || strlen($activeStatus) > 25) {
        $errors .= "* Active Status is required to be no more than 25 characters";
    }
    if(!empty($QARequirement) && strlen($QARequirement) > 1) {
        $errors .= "* Leave QARequirement blank or have it be a 'Yes' or 'No'";
    }
    if(!empty($PONum) && strlen($activeStatus) > 50) {
        $errors .= "* Leave PONum be  blank or have it be no more than 50 characters";
    }
    if(!empty($companyDivision) && strlen($companyDivision) > 100) {
        $errors .= "* Leave Company Division  blank or have it be no more than 100 characters";
    }
    if(!empty($callPrior) && strlen($callPrior) > 25) {
        $errors .= "* Leave Call Prior  blank or have it be no more than 25 characters";
    }
    if(!empty($technicianAssigned) && strlen($technicianAssigned) > 10) {
        $errors .= "* Leave Technician Assigned blank or have it be no more than 10 characters";
    }
    if (!empty($SolicitationDate) && !strtotime($SolicitationDate) > 30) {
        $errors .= "* Either leave the Solicitation Date blank or provide a valid date. ";
    }
    //Job Site Errors Errors
    for ($i = 0; $i< $JobSitecounter; $i++)
    {
        if(!empty(${'PhoneJobSite' . $i}) && strlen(${'PhoneJobSite' . $i}) > 20) {
            $errors .= "* Leave Job Site $i Phone blank or have it be no more than 20 characters";
        }
        if(!empty(${'FaxJobSite' . $i}) && strlen(${'FaxJobSite' . $i}) > 20) {
            $errors .= "* Leave Job Site $i Fax blank or have it be no more than 20 characters";
        }
        if(empty(${'Address1JobSite' . $i}) || strlen(${'Address1JobSite' . $i}) > 100) {
            $errors .= "* Job Site $i Address1 is required to be no more than 100 characters";
        }
        if(!empty(${'Address2JobSite' . $i}) && strlen(${'Address2JobSite' . $i}) > 50) {
            $errors .= "* Leave Job Site $i Address2 blank or have it be no more than 50 characters";
        }
        if(!empty(${'CityJobSite' . $i}) && strlen(${'CityJobSite' . $i}) > 25) {
            $errors .= "* Leave Job Site $i City blank or have it be no more than 25 characters";
        }
        if(!empty(${'StateJobSite' . $i}) && strlen(${'StateJobSite' . $i}) > 10) {
            $errors .= "* Leave Job Site $i State blank or have it be no more than 10 characters (Use 'PA' or 'OH' as examples)";
        }
        if(!empty(${'ZipJobSite' . $i}) && strlen(${'ZipJobSite' . $i}) > 15) {
            $errors .= "* Leave Job Site $i Zip blank or have it be no more than 15 characters";
        }
    }
        //Machinery Errors
        for ($i = 0; $i< $Machinecounter; $i++)
        {
            if(!empty(${'SerialNumber' . $i}) && strlen(${'SerialNumber' . $i}) > 50) {
                $errors .= "* Leave Machinery $i Serial Number blank or have it be no more than 50 characters";
            }
            if(!empty(${'MD' . $i}) && strlen(${'MD' . $i}) > 100) {
                $errors .= "* Leave Machinery $i MD blankk or have it be no more than 100 characters";
            }
            if(!empty(${'MachineRange' . $i}) && strlen(${'MachineRange' . $i}) > 50) {
                $errors .= "* Leave Machinery $i Range blank or have it be no more than 50 characters";
            }
            if(!empty(${'lastCalibrationDate' . $i}) && strlen(${'lastCalibrationDate' . $i}) > 25) {
                $errors .= "* Leave Last Calibration Date $i blank or insert a valid date";
            }
            if(!empty(${'MachineryJobSiteID' . $i}) && strlen(${'MachineryJobSiteID' . $i}) > 50) {
                $errors .= "* Leave Machinery $i Job Site blank or have it be no more than 50 characters";
            }

        }
    for ($i = 0; $i< $Contactcounter; $i++)
    {
        //Contact Errors
        if (!empty(${'Title' . $i}) && strlen(${'Title' . $i}) > 5) {
            $errors .= "* Leave Contact $i Title blank or to be no more than 5 characters.\\n ";
        }
        if (empty(${'firstName' . $i}) && strlen(${'firstName' . $i}) > 50) {
            $errors .= "* First Contact $i Name is required to be no more than 50 characters.\\n ";
        }
        if (empty(${'lastName' . $i}) && strlen(${'lastName' . $i}) > 50) {
            $errors .= "* Last Contact $i Name is required to be no more than 50 characters.\\n ";
        }
        if (!empty(${'Department' . $i}) && strlen(${'Department' . $i}) > 150) {
            $errors .= "* Leave Contact $i Department blank be no more than 150 characters.\\n ";
        }
        if (!empty(${'Address1Contact' . $i}) && strlen(${'Address1Contact' . $i}) > 100) {
            $errors .= "* Leave Contact $i Address1 blank or be no more than 100 characters.\\n ";
        }
        if (!empty(${'Address2Contact'. $i}) && strlen(${'Address2Contact' . $i}) > 50) {
            $errors .= "* Leave Contact $i Address2 blank or be no more than 50 characters.\\n ";
        }
        if (!empty(${'CityContact' . $i}) && strlen(${'CityContact' . $i}) > 25) {
            $errors .= "* Leave Contact $i City blank or is required to be no more than 25 characters.\\n ";
        }
        if (!empty(${'ZipContact' . $i}) && strlen(${'ZipContact' . $i}) > 15) {
            $errors .= "* Leave Contact $i Zip blank or is required to be no more than 15 characters.\\n ";
        }
        if (!empty(${'PhoneContact' . $i}) && strlen(${'PhoneContact' . $i}) > 20) {
            $errors .= "* Leave Contact $Contactcounter Phone blank or is required to be no more than 20 characters.\\n ";
        }
        if (!empty(${'faxNumberContact' . $i}) && strlen(${'faxNumberContact' . $i}) > 20) {
            $errors .= "* Leave Contact $i Fax Number blank or is required to be no more than 20 characters.\\n ";
        }
        if (!empty(${'email' . $i}) && strlen(${'email' . $i}) > 50) {
            $errors .= "* Leave Contact $i email blank or is required to be no more than 50 characters.\\n ";
        }
    }
    //END OF ERRORS
    if ($errors != "")
    {
        echo "<script>alert('$errors');</script>";
    //Begin Pushing to Database if no Errors
    } else {
            /* Changes Customer infrormation first*/
            $customerNumberUpdated = updateCustomer($customerNumber, $companyName, $TourMonth,$companyIdentifier,$dateAcquired,
            $schduledDate, $taxExemptStatus, $County, $taxRate, $creditTerms, $COD_Date, $certsInstructs, $activeStatus, $QARequirement, 
            $PONum, $companyDivision, $callPrior, $technicianAssigned, $Comments, $mapDone, $SolicitationDate);
            /* Each of these loops go forth and edit the correct amount of elemens in the edit window (WIP does not allow creation or deleting only editing as of 5.30.2020 */
            for ($i = 0; $i< $Contactcounter; $i++)
            {
                ${'ContactID' . $i} = updateContact(${'ContactID' . $i}, ${'Title' . $i}, ${'firstName' . $i},${'lastName' . $i}, ${'Department' . $i}, ${'Address1Contact' . $i}, ${'Address2Contact' . $i}, ${'CityContact' . $i}, ${'StateContact' . $i}, ${'ZipContact' . $i}, ${'PhoneContact' . $i}, ${'faxNumberContact' . $i}, ${'email' . $i});
            }
            for ($i = 0; $i< $JobSitecounter; $i++)
            {
                ${'JobSiteID' . $i} = updateJobSite(${'JobSiteID' . $i},${'siteContact' . $i}, ${'PhoneJobSite' . $i}, ${'FaxJobSite' . $i}, ${'Address1JobSite' . $i}, ${'Address2JobSite' . $i}, ${'CityJobSite' . $i}, ${'StateJobSite' . $i}, ${'ZipJobSite' . $i}, ${'WorkingHours' . $i}, ${'Directions' . $i}, ${'JobSiteID' . $i},${"SolicitedConfirmed" . $i});
            }
            for ($i = 0; $i< $Machinecounter; $i++)
            {
                ${'MachineryID' . $i} = updateMachinery(${'MachineryID' . $i}, ${'SerialNumber' . $i},${'MD' . $i}, ${'MachineRange' . $i}, ${'LastCalibrationDate' . $i}, ${'RepairPrice' . $i}, ${'MachineryJobSiteID' . $i});
            }
            /* Display main page after finish*/
        header("Location: ../controller/controller.php?action=Main");
    }
}
/* No longer used */

function showTables()
{
    $listType = $_GET['tableSelect'];
    if($listType == "tb1")
    {
        echo '<table id = "Customer" border="0" cellspacing="2" cellpadding="2"> 
    <caption>Customers</caption>
      <tr> 
          <th> <font face="Arial">Company Name</font> </td> 
          <th> <font face="Arial">Company Identifier</font> </td> 
          <th> <font face="Arial">County</font> </td> 
          <th> <font face="Arial">Tax Exempt Status</font> </td> 
          <th> <font face="Arial">Last Updated</font> </td> 
          <th> <font face="Arial">Options</font> </td> 
      </tr>';
    $dbCustomers = getAllCustomers();
    $rowNumber = 0;
    foreach ($dbCustomers as $row) {
        $field1name = $row["companyName"];
        $field2name = $row["companyIdentifier"];
        $field3name = $row["County"];
        $field4name = $row["taxExemptStatus"];
        $field5name = strtotime($row["lastUpdated"]); 
        $field5name = $myFormatForView = date("m/d/y", $field5name);
        echo '<tr> 
                  <td><div class="row_data" edit_type="click" col_name="companyName">'.$field1name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="companyIdentifier">'.$field2name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="County">'.$field3name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="taxExemptStatus">'.$field4name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field5name.'</td> 

                  <td><span class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </span>
                  <span class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </span>
                  <span class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </span>
                  <span class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></span>
              </tr>';
        $rowNumber= $rowNumber + 1;
        }
    }
    else if ($listType == "tb2")
    {
        $rowNumber = 0;
        $dbContacts = getAllContacts();
        echo '<table id = "Contact" border="0" cellspacing="2" cellpadding="2"> 
    <caption>Customers</caption>
      <tr> 
          <th> <font face="Arial">Title</font> </td> 
          <th> <font face="Arial">firstName</font> </td> 
          <th> <font face="Arial">lastName</font> </td> 
          <th> <font face="Arial">Department</font> </td> 
          <th> <font face="Arial">Address1</font> </td> 
          <th> <font face="Arial">Address 2</font> </td> 
          <th> <font face="Arial">City</font> </td> 
          <th> <font face="Arial">State</font> </td> 
          <th> <font face="Arial">Zip</font> </td> 
          <th> <font face="Arial">Phone</font> </td> 
          <th> <font face="Arial">Fax Number</font> </td>
          <th> <font face="Arial">E-Mail</font> </td>  
      </tr>';
    $rowNumber = 0;
    foreach ($dbContacts as $row) {
        $field1name = $row["Title"];
        $field2name = $row["firstName"];
        $field3name = $row["lastName"];
        $field4name = $row["Department"];
        $field5name = $row["Address1"]; 
        $field6name = $row["Address2"]; 
        $field7name = $row["City"];
        $field8name = $row["State"];
        $field9name = $row["Zip"];
        $field10name = $row["Phone"];
        $field11name = $row["faxNumber"];
        $field12name = $row["email"]; 
        echo '<tr> 
                  <td><div class="row_data" edit_type="click" col_name="companyName">'.$field1name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="companyIdentifier">'.$field2name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="County">'.$field3name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="taxExemptStatus">'.$field4name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field5name.'</td>
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field6name.'</td>
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field7name.'</td>
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field8name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field9name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field10name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field11name.'</td> 
                  <td><div class="row_data" edit_type="click" col_name="lastUpdated">'.$field12name.'</td>    

                  <td><span class="btn_edit"> <a href="#" class="btn btn-link" row_id= $rowNumber> Edit</a> | </span>
                  <span class="btn_save"> <a href="#" class="btn btn-link" row_id= $rowNumber> Save</a> | </span>
                  <span class="btn_cancel"> <a href="#" class="btn btn-link" row_id= $rowNumber>Cancel</a> | </span>
                  <span class="btn_delete"> <a href="#" class="btn btn-link" row_id= $rowNumber>Delete</a></span>
              </tr>';
        $rowNumber= $rowNumber + 1;
        }
    } 
    else if($listType == 'GeneralSearch')
    {

    }
    
/* Unused functions*/
function viewCustomerJobSites()
{
    echo '<script language="javascript">';
    echo 'alert("message successfully sent")';
    echo '</script>';
}
function viewCustomerContacts()
{
    echo '<script language="javascript">';
    echo 'alert("message successfully sent")';
    echo '</script>';
}
function viewCustomerMachinery()
{
    echo '<script language="javascript">';
    echo 'alert("message successfully sent")';
    echo '</script>';
}
}
?>