
<?php 
//This model.php file contains various functions used throughout the controller in order to provide context for certain actions such as adding, deleting, or editing certain elements of the database
    //Gets Database Connection for various pages php
    //Username, Password, and database are set base on the instruction manual provided
    function getDBConnection() {
        $dsn = 'mysql: host=localhost;dbname=CSICustomers';
        $username = 'CSIAdmin';
        $password = '462CSI';
        try {
            $db = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;}
        return $db;
    }
    //Display all customer data
    function getAllCustomers() {
        try {
            $db = getDBConnection();
            $query = "SELECT * FROM CUSTOMER";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Displays all customer data with additonal info from Job Site
    function getAllCustomerInfo() {
        try {
            $db = getDBConnection();
            $query = "SELECT customer.activeStatus, customer.companyName, customer.companyIdentifier, customer.TourMonth, customer.scheduledDate, customer.SolicitationDate, customer.dateAcquired,
            customer.lastUpdated,customer.taxExemptStatus, customer.County, customer.taxRate, customer.creditTerms, customer.COD_Date, customer.certsInstructs, customer.PONum, customer.companyDivision,
            customer.callPrior, customer.technicianAssigned, job_site.Address1, job_site.Address2, job_site.City, job_site.State, job_site.Zip, job_site.WorkingHours, job_site.Directions, customer.Comments,
            customer.mapDone FROM customer inner join job_site ON customer.customerNumber = job_site.customerID";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all the information for a specific customer with additional info from Job Site
        function getAllCustomerInfoFromCustomer($CustomerNumber) {
            try {
                $db = getDBConnection();
                $query = "SELECT customer.activeStatus, customer.companyName, customer.companyIdentifier, customer.TourMonth, customer.scheduledDate, customer.SolicitationDate, customer.dateAcquired,
                customer.lastUpdated,customer.taxExemptStatus, customer.County, customer.taxRate, customer.creditTerms, customer.COD_Date, customer.certsInstructs, customer.QARequirement, customer.PONum, customer.companyDivision,
                customer.callPrior, customer.technicianAssigned, job_site.Address1, job_site.Address2, job_site.City, job_site.State, job_site.Zip, job_site.WorkingHours, job_site.Directions, customer.Comments,
                customer.mapDone FROM customer inner join job_site ON customer.customerNumber = job_site.customerID WHERE CUSTOMER.customerNumber = $CustomerNumber";
                $statement = $db->prepare ($query);
                $statement->execute();
                $result = $statement->fetch();
                $statement->closeCursor();
                return $result;
            //If there is an error
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
                include '../view/errorPage.php';
                die;
            }
    }
    //Gets all contacts for a given customer
    function getCustomerContact($CustomerID)
    {
        try {
            $db = getDBConnection();
            $query = "SELECT contact.ContactID, customer.companyIdentifier, contact.Title, contact.firstName, contact.lastName, contact.Department, contact.Address1, contact.Address2, contact.City, contact.State, contact.Zip, contact.Phone, contact.faxNumber, contact.email FROM customer inner join contact ON customer.customerNumber = contact.customerID
            WHERE customer.customerNumber = $CustomerID";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all Job Sites for a given customer
    function getCustomerJobSite($CustomerID)
    {
        try {
            $db = getDBConnection();
            $query = "SELECT JOB_SITE.JobSiteID, customer.companyIdentifier, JOB_SITE.siteContact, JOB_SITE.Phone, JOB_SITE.Fax, JOB_SITE.Address1, JOB_SITE.Address2, JOB_SITE.City, JOB_SITE.State, JOB_SITE.Zip, JOB_SITE.WorkingHours, JOB_SITE.Directions, JOB_SITE.SolicitedConfirmed FROM customer inner join JOB_SITE ON customer.customerNumber = job_site.customerID
            WHERE customer.customerNumber = $CustomerID";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all machinery and repair price info for a given customer
    function getCustomerMachinery($CustomerID) {
        try {
            $db = getDBConnection();
            $query = "SELECT  machinery.MachineryID, customer.companyIdentifier, customer.TourMonth, customer.scheduledDate, machinery.MD, machinery.SerialNumber, machinery.MachineRange, machinery.lastCalibrationDate,machinery.JobSiteID, repair_price.Cost FROM customer 
            inner join machinery ON customer.customerNumber = machinery.customerID
            Inner Join repair_price ON machinery.priceOfRepairs = repair_price.PriceID
            WHERE
            machinery.MD != ''
            AND
            customer.customerNumber=$CustomerID"
            ;
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all Contacts in the database
    function getAllContacts() {
        try {
            $db = getDBConnection();
            $query = "SELECT * FROM CONTACT";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all Job Sites in the table
    function getAllJobsites() {
        try {
            $db = getDBConnection();
            $query = "SELECT * FROM JOB_SITE";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all Machinery in the database
    function getAllMachinery() {
        try {
            $db = getDBConnection();
            $query = "SELECT * FROM MACHINERY";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Gets all machinery belonging to a certain customer
    function getAllCustomerMachinery(){
         try {
        $db = getDBConnection();
        $query = "SELECT customer.companyIdentifier, customer.TourMonth, customer.scheduledDate, machinery.MD, machinery.SerialNumber, repair_price.Cost FROM customer 
        inner join machinery ON customer.customerNumber = machinery.customerID 
        Inner Join repair_price ON machinery.priceOfRepairs = repair_price.PriceID
        WHERE
        machinery.MD != ''";
        $statement = $db->prepare ($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/errorPage.php';
        die;
    }
}
    //Gets Gets all machinery with their repair prices listed
    function getMachineryWithRepairPrice() {
        try {
            $db = getDBConnection();
            $query = "Select repair_price.Cost, machinery.MD, machinery.MachineRange, machinery.lastCalibrationDate From machinery inner join repair_price WHERE machinery.priceOfRepairs = repair_price.PriceID";
            $statement = $db->prepare ($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Unused
    //Provides basic customer search
    function getByGeneralSearch($criteria)
    {
        try {
            $db = getDBConnection();
            $query = "SELECT * FROM CUSTOMER WHERE companyName
            LIKE :criteria OR companyIdentifier Like :criteria OR TourMonth Like :criteria";
            $statement = $db->prepare ($query);
            $statement->bindValue(':criteria', "%$criteria%");
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
    }
    //Insert a new Customer to the database
    //Returns the new customerNumber
    function insertCustomer($companyName, $tourMonth,$companyIdentifier,$dateAcquired,
    $scheduledDate, $taxExemptStatus, $county, $taxRate, $creditTerms, $CODDate, $CertsInstructs, $activeStatus, $QARequirement, 
    $PONum, $companyDivision, $callPrior, $technicianAssigned, $comments, $mapDone, $solicitationDate)
    {
        $db = getDBConnection();
        $query = 'INSERT INTO CUSTOMER (companyName, TourMonth, companyIdentifier, billingContact, lastUpdated, dateAcquired, scheduledDate,
         taxExemptStatus, County, taxRate, creditTerms, COD_Date, certsInstructs, activeStatus, QARequirement, PONum, companyDivision, callPrior,
          technicianAssigned, Comments, mapDone, SolicitationDate)
        VALUES (:companyName,:TourMonth, :companyIdentifier, :billingContact, :lastUpdated, :dateAcquired, :scheduledDate, :taxExemptStatus, :County, :taxRate,
        :creditTerms, :COD_Date, :certsInstructs, :activeStatus, :QARequirement, :PONum, :companyDivision, :callPrior, :technicianAssigned, :Comments, :mapDone, :SolicitationDate)';
        $statement = $db->prepare($query);
        $date = date('Y-m-d', time());

        $statement->bindValue(':companyName', $companyName);
        $statement->bindValue(':companyIdentifier', $companyIdentifier);
        $statement->bindValue(':billingContact', '');
        $statement->bindValue(':lastUpdated',$date );

        //Validations + Formating of Data
        if(empty($tourMonth)) {
            $statement->bindValue(':TourMonth', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':TourMonth', toMySQLDate($tourMonth));
        }
        if(empty($dateAcquired)) {
            $statement->bindValue(':dateAcquired', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':dateAcquired', toMySQLDate($dateAcquired));
        }
        if(empty($scheduledDate)) {
            $statement->bindValue(':scheduledDate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':scheduledDate', toMySQLDate($scheduledDate));
        }
        if (empty($taxExemptStatus)) {
            $statement->bindValue(':taxExemptStatus', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':taxExemptStatus', $taxExemptStatus);
        }
        if(empty($county)) {
            $statement->bindValue(':County', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':County', $county);
        }
        if(empty($taxRate)) {
            $statement->bindValue(':taxRate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':taxRate', $taxRate);
        }
        if(empty($taxRate)) {
            $statement->bindValue(':creditTerms', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':creditTerms', $creditTerms);
        }
        if(empty($CODDate)) {
            $statement->bindValue(':COD_Date', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':COD_Date', toMySQLDate($CODDate));
        }
        if(empty($CertsInstructs)) {
            $statement->bindValue(':certsInstructs', null, PDO::PARAM_NULL);
        } else {
            if(is_null($CertsInstructs))
            {
                $statement->bindValue(':certsInstructs', 0);
            }
            $statement->bindValue(':certsInstructs', $CertsInstructs);
        }
        if(empty($activeStatus)) {
            $statement->bindValue(':activeStatus', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':activeStatus', $activeStatus);
        }
        if(empty($QARequirement)) {
            $statement->bindValue(':QARequirement', null, PDO::PARAM_NULL);
        } else {
            if(is_null($QARequirement))
            {
                $statement->bindValue(':QARequirement', 0);
            }
            $statement->bindValue(':QARequirement', $QARequirement);
        }
        if(empty($PONum)) {
            $statement->bindValue(':PONum', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':PONum', $PONum);
        }
        if(empty($companyDivision)) {
            $statement->bindValue(':companyDivision', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':companyDivision', $companyDivision);
        }
        if(empty($callPrior)) {
            $statement->bindValue(':callPrior', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':callPrior', $callPrior);
        }
        if(empty($technicianAssigned)) {
            $statement->bindValue(':technicianAssigned', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':technicianAssigned', $technicianAssigned);
        }
        if(empty($Comments)) {
            $statement->bindValue(':Comments', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':Comments', $comments);
        }
        if(empty($mapDone)) {
            $statement->bindValue(':mapDone', null, PDO::PARAM_NULL);
        } else {
            if(is_null($mapDone))
            {
                $statement->bindValue(':mapDone', 0);
            }
            $statement->bindValue(':mapDone', $mapDone);
        }
        if(empty($solicitationDate)) {
            $statement->bindValue(':SolicitationDate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':SolicitationDate', toMySQLDate($solicitationDate));
        }
        $success = $statement->execute();
        $statement->closeCursor();
        //Success in adding
        if($success) {
            return $db->lastInsertId();
        //Failure
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Inserts a new contact into the database
    //Returns the new ContactID
    function insertContact($CustomerID, $Title, $firstName, $lastName, $Department, $Address1Contact, $Address2Contact, $CityContact, $StateContact, $ZipContact, $PhoneContact, $faxNumberContact, $email)
    {
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
    }
    //Inserts a new Job Site into the database
    //Returns the newly created JobSiteID
    function insertJobSite($siteContactID, $CustomerID, $PhoneJobSite, $FaxJobSite, $Address1JobSite, $Address2JobSite, $CityJobSite, $StateJobSite, $ZipJobSite, $WorkingHours, $Directions, $SolicitedConfirmed)    
    {
        $db = getDBConnection();
        $query = 'INSERT INTO JOB_SITE (siteContact, customerID, Phone, Fax, Address1, Address2, City, State, Zip, WorkingHours, Directions, SolicitedConfirmed)
        VALUES (:siteContact, :customerID, :Phone, :Fax, :Address1, :Address2, :City, :State, :Zip, :WorkingHours, :Directions, :SolicitedConfirmed)';
        $statement = $db->prepare($query);
  
        $statement->bindValue(':siteContact', $siteContactID);
        $statement->bindValue(':customerID', $CustomerID);

        //Validations + Formatting of data
        if (empty($PhoneJobSite)) {
            $statement->bindValue(':Phone', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Phone', $PhoneJobSite);
        }
        if (empty($FaxJobSite)) {
            $statement->bindValue(':Fax', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Fax', $FaxJobSite);
        }
        $statement->bindValue(':Address1', $Address1JobSite);
        if (empty($Address2JobSite)) {
            $statement->bindValue(':Address2', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Address2', $Address2JobSite);
        }
        if (empty($CityJobSite)) {
            $statement->bindValue(':City', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':City', $CityJobSite);
        }
        if (empty($StateJobSite)) {
            $statement->bindValue(':State', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':State', $StateJobSite);
        }
        if (empty($ZipJobSite)) {
            $statement->bindValue(':Zip', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Zip', $ZipJobSite);
        }
        if (empty($WorkingHours)) {
            $statement->bindValue(':WorkingHours', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':WorkingHours', $WorkingHours);
        }
        if (empty($Directions)) {
            $statement->bindValue(':Directions', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Directions', $Directions);
        }
        if(empty($SolicitedConfirmed)) {
            $statement->bindValue(':SolicitedConfirmed', null, PDO::PARAM_NULL);
        } else {
            if(is_null($SolicitedConfirmed))
            {
                $statement->bindValue(':SolicitedConfirmed', 0);
            } else
            $statement->bindValue(':SolicitedConfirmed', $SolicitedConfirmed);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Insert a new Repair Price into the table
    //Returns the new repairPriceID
    function insertRepairPrice ($Cost)
    {
        $db = getDBConnection();
        $query = 'INSERT INTO repair_price (Cost)
        VALUES (:Cost)';
        $statement = $db->prepare($query);
        $statement->bindValue(':Cost', $Cost);
        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Insert a new machinery into the database
    //Returns the new MachineryID
    function insertMachinery($customerID, $SerialNumber, $MD, $MachineRange, $lastCalibrationDate, $priceOfRepairs, $JobSiteID)
    {
        $db = getDBConnection();
        $query = 'INSERT INTO MACHINERY (customerID, SerialNumber, MD, MachineRange, lastCalibrationDate, priceOfRepairs, JobSiteID)
        VALUES (:customerID, :SerialNumber, :MD, :MachineRange, :lastCalibrationDate, :priceOfRepairs, :JobSiteID)';
        $statement = $db->prepare($query);
        $date = date('m/d/Y', time());
        $statement->bindValue(':customerID', $customerID);

        //Validations + Formatting of data
        if (empty($SerialNumber)) {
            $statement->bindValue(':SerialNumber', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':SerialNumber', $SerialNumber);
        }
        $statement->bindValue(':MD', $MD);
        if (empty($MachineRange)) {
            $statement->bindValue(':MachineRange', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':MachineRange', $MachineRange);
        }
        if(empty($lastCalibrationDate)) {
            $statement->bindValue(':lastCalibrationDate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':lastCalibrationDate', $lastCalibrationDate);

        }
        $statement->bindValue(':priceOfRepairs', $priceOfRepairs);

        if (empty($JobSiteID)) {
            $statement->bindValue(':JobSiteID', 0);
        }   else {
                $statement->bindValue(':JobSiteID', $JobSiteID);
        }

        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Updates a customer of a given customerNumber
    function updateCustomer($customerNumber, $companyName, $tourMonth,$companyIdentifier,$dateAcquired,
    $scheduledDate, $taxExemptStatus, $county, $taxRate, $creditTerms, $CODDate, $CertsInstructs, $activeStatus, $QARequirement, 
    $PONum, $companyDivision, $callPrior, $technicianAssigned, $comments, $mapDone, $solicitationDate)
    {
        $db = getDBConnection();
        $query = "UPDATE CUSTOMER SET companyName = :companyName, TourMonth = :TourMonth, companyIdentifier = :companyIdentifier, billingContact = :billingContact, lastUpdated = :lastUpdated, dateAcquired = :dateAcquired, scheduledDate = :scheduledDate, taxExemptStatus = :taxExemptStatus, County = :County, taxRate = :taxRate,
        creditTerms = :creditTerms, COD_DATE = :COD_Date, certsInstructs = :certsInstructs, activeStatus = :activeStatus, QARequirement = :QARequirement, PONum = :PONum, companyDivision = :companyDivision, callPrior = :callPrior, technicianAssigned = :technicianAssigned, Comments = :Comments, mapDone = :mapDone, SolicitationDate = :SolicitationDate WHERE customerNumber = :customerNumber";
        $statement = $db->prepare($query);
        $date = date('Y-m-d', time());
        
        //Validations + Formatting data
        $statement->bindValue(':customerNumber', $customerNumber);

        $statement->bindValue(':companyName', $companyName);
        $statement->bindValue(':companyIdentifier', $companyIdentifier);
        $statement->bindValue(':billingContact', '0');
        $statement->bindValue(':lastUpdated',$date );

        if(empty($tourMonth)) {
            $statement->bindValue(':TourMonth', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':TourMonth', toMySQLDate($tourMonth));
        }
        if(empty($dateAcquired)) {
            $statement->bindValue(':dateAcquired', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':dateAcquired', toMySQLDate($dateAcquired));
        }
        if(empty($scheduledDate)) {
            $statement->bindValue(':scheduledDate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':scheduledDate', toMySQLDate($scheduledDate));
        }
        if (empty($taxExemptStatus)) {
            $statement->bindValue(':taxExemptStatus', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':taxExemptStatus', $taxExemptStatus);
        }
        if(empty($county)) {
            $statement->bindValue(':County', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':County', $county);
        }
        if(empty($taxRate)) {
            $statement->bindValue(':taxRate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':taxRate', $taxRate);
        }
        if(empty($taxRate)) {
            $statement->bindValue(':creditTerms', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':creditTerms', $creditTerms);
        }
        if(empty($CODDate)) {
            $statement->bindValue(':COD_Date', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':COD_Date', toMySQLDate($CODDate));
        }
        if(empty($CertsInstructs)) {
            $statement->bindValue(':certsInstructs', null, PDO::PARAM_NULL);
        } else {
            if(is_null($CertsInstructs))
            {
                $statement->bindValue(':certsInstructs', 0);
            } else
            $statement->bindValue(':certsInstructs', $CertsInstructs);
        }
        if(empty($activeStatus)) {
            $statement->bindValue(':activeStatus', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':activeStatus', $activeStatus);
        }
        if(empty($QARequirement)) {
            $statement->bindValue(':QARequirement', null, PDO::PARAM_NULL);
        } else {
            if(is_null($QARequirement))
            {
                $statement->bindValue(':QARequirement', 0);
            } else
            $statement->bindValue(':QARequirement', $QARequirement);
        }
        if(empty($PONum)) {
            $statement->bindValue(':PONum', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':PONum', $PONum);
        }
        if(empty($companyDivision)) {
            $statement->bindValue(':companyDivision', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':companyDivision', $companyDivision);
        }
        if(empty($callPrior)) {
            $statement->bindValue(':callPrior', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':callPrior', $callPrior);
        }
        if(empty($technicianAssigned)) {
            $statement->bindValue(':technicianAssigned', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':technicianAssigned', $technicianAssigned);
        }
        if(empty($Comments)) {
            $statement->bindValue(':Comments', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':Comments', $comments);
        }
        if(empty($mapDone)) {
            $statement->bindValue(':mapDone', null, PDO::PARAM_NULL);
        } else {
            if(is_null($mapDone))
            {
                $statement->bindValue(':mapDone', 0);
            } else
            $statement->bindValue(':mapDone', $mapDone);
        }
        if(empty($solicitationDate)) {
            $statement->bindValue(':SolicitationDate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':SolicitationDate', toMySQLDate($solicitationDate));
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Updates a contact of given ContactID
    function updateContact($ContactID, $Title, $firstName, $lastName, $Department, $Address1Contact, $Address2Contact, $CityContact, $StateContact, $ZipContact, $PhoneContact, $faxNumberContact, $email)
    {
        $db = getDBConnection();
        $query = "UPDATE
        `CONTACT` SET Title = :Title, firstName = :firstName, lastName = :lastName, `Department` = :Department, Address1 = :Address1, Address2 = :Address2, City = :City, State = :State, Zip = :Zip, Phone = :Phone, faxNumber = :faxNumber, email = :email
        WHERE  contactID = :contactID";
        $statement = $db->prepare($query);
        $statement->bindParam(':contactID', $ContactID);
        //Validation + Formatting of data
        if (empty($Title)) {
            $statement->bindValue(':Title', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Title', $Title);
        }
        $statement->bindValue(':firstName', $firstName);
        if (empty($Department)) {
            $statement->bindValue(':lastName', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':lastName', $lastName);
        }
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
    }
    //Update a given JobSiteID
    function updateJobSite($JobSiteID, $ContactID, $PhoneJobSite, $FaxJobSite, $Address1JobSite, $Address2JobSite, $CityJobSite, $StateJobSite, $ZipJobSite, $WorkingHours, $Directions, $SolicitedConfirmed)    
    {
        $db = getDBConnection();
        $query = "UPDATE
        `JOB_SITE` SET siteContact = :siteContact, Phone = :Phone, Fax = :Fax, Address1 = :Address1, Address2 = :Address2, City = :City, State = :State, Zip = :Zip, WorkingHours = :WorkingHours, Directions = :Directions, SolicitedConfirmed = :SolicitedConfirmed
        WHERE JobSiteID = :JobSiteID";
        $statement = $db->prepare($query);
        //Validation + Formatting of data
        $statement->bindParam(':JobSiteID', $JobSiteID);

        $statement->bindValue(':siteContact', $ContactID);
        if (empty($PhoneJobSite)) {
            $statement->bindValue(':Phone', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Phone', $PhoneJobSite);
        }
        if (empty($FaxJobSite)) {
            $statement->bindValue(':Fax', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Fax', $FaxJobSite);
        }
        $statement->bindValue(':Address1', $Address1JobSite);
        if (empty($Address2JobSite)) {
            $statement->bindValue(':Address2', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Address2', $Address2JobSite);
        }
        if (empty($CityJobSite)) {
            $statement->bindValue(':City', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':City', $CityJobSite);
        }
        if (empty($StateJobSite)) {
            $statement->bindValue(':State', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':State', $StateJobSite);
        }
        if (empty($ZipJobSite)) {
            $statement->bindValue(':Zip', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Zip', $ZipJobSite);
        }
        if (empty($WorkingHours)) {
            $statement->bindValue(':WorkingHours', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':WorkingHours', $WorkingHours);
        }
        if (empty($Directions)) {
            $statement->bindValue(':Directions', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':Directions', $Directions);
        }
        if (empty($ContactID)) {
            $statement->bindValue(':siteContact', 0);
        }   else {
                $statement->bindValue(':siteContact', $ContactID);
        }
        if(empty($SolicitedConfirmed)) {
            $statement->bindValue(':SolicitedConfirmed', null, PDO::PARAM_NULL);
        } else {
            if(is_null($SolicitedConfirmed))
            {
                $statement->bindValue(':SolicitedConfirmed', 0);
            }
            $statement->bindValue(':SolicitedConfirmed', $SolicitedConfirmed);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Updates a given MachineryID
    function updateMachinery($MachinerySelected, $SerialNumber, $MD, $MachineRange, $lastCalibrationDate, $priceOfRepairs, $JobSiteID)
    {
        $db = getDBConnection();
        $query = "UPDATE
        `MACHINERY` inner join REPAIR_PRICE ON MACHINERY.priceOfRepairs = REPAIR_PRICE.PriceID SET MACHINERY.SerialNumber = :SerialNumber, MACHINERY.MD = :MD, MACHINERY.MachineRange = :MachineRange, MACHINERY.lastCalibrationDate = :lastCalibrationDate, REPAIR_PRICE.Cost = :priceOfRepairs, MACHINERY.JobSiteID = :JobSiteID 
        WHERE MACHINERY.MachineryID = :MachineryID";
        $statement = $db->prepare($query);
        $date = date('m/d/Y', time());
        //Validation + Formatting of data
        $statement->bindParam(':MachineryID', $MachinerySelected);
        if (empty($SerialNumber)) {
            $statement->bindValue(':SerialNumber', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':SerialNumber', $SerialNumber);
        }
        $statement->bindValue(':MD', $MD);

        if (empty($MachineRange)) {
            $statement->bindValue(':MachineRange', null, PDO::PARAM_NULL);
        }   else {
                $statement->bindValue(':MachineRange', $MachineRange);
        }
        if(empty($lastCalibrationDate)) {
            $statement->bindValue(':lastCalibrationDate', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':lastCalibrationDate', $lastCalibrationDate);

        }
        $statement->bindValue(':priceOfRepairs', $priceOfRepairs);

        if (empty($JobSiteID)) {
            $statement->bindValue(':JobSiteID', 0);
        }   else {
                $statement->bindValue(':JobSiteID', $JobSiteID);
        }

        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Unused
    function UpdateRepairPrice ($Cost)
    {
        $db = getDBConnection();
        $query = 'Update repair_price SET Cost = :Cost';
        $statement = $db->prepare($query);
        $date = date('m/d/Y', time());
        $statement->bindValue(':Cost', $Cost);
    
        $success = $statement->execute();
        $statement->closeCursor();
        if($success) {
            return $db->lastInsertId();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Deletes a given Customer
    function deleteOneCustomer($CustomerNumber)
    {
        $db = getDBConnection();
        $query = 'DELETE FROM CUSTOMER WHERE customerNumber = :customerNumber';
        $statement = $db->prepare($query);
        $statement->bindValue(':customerNumber', $CustomerNumber);
        $success = $statement->execute();
        $statement->closeCursor();

        if($success) {
            return $statement->rowCount();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Deletes a given Contact
    function deleteOneContact($ContactID)
    {
        $db = getDBConnection();
        $query = 'DELETE FROM CONTACT WHERE contactID = :contactID';
        $statement = $db->prepare($query);
        $statement->bindValue(':contactID', $ContactID);
        $success = $statement->execute();
        $statement->closeCursor();

        if($success) {
            return $statement->rowCount();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Deletes a given Machinery
    function deleteOneMachinery($MachineryID)
    {
        $db = getDBConnection();
        $query = 'DELETE FROM MACHINERY WHERE MachineryID = :machineryID';
        $statement = $db->prepare($query);
        $statement->bindValue(':machineryID', $MachineryID);
        $success = $statement->execute();
        $statement->closeCursor();

        if($success) {
            return $statement->rowCount();
        } else {
            logSQLError($statement->errorInfo());
        }
    }
    //Deletes a given Machinery
    function deleteOneJobSite($JobSiteID)
    {
        $db = getDBConnection();
        $query = 'DELETE FROM JOB_SITE WHERE JobSiteID = :JobSiteID';
        $statement = $db->prepare($query);
        $statement->bindValue(':JobSiteID', $JobSiteID);
        $success = $statement->execute();
        $statement->closeCursor();

        if($success) {
            return $statement->rowCount();
        } else {
            logSQLError($statement->errorInfo());
        }
    }   
    //Logs an error and displays it on an error page
    function logSQLError($errorInfo) {
        $errorMessage = $errorInfo[2];
        include '../view/errorPage.php';
    }
    //Gets a given customer from their customerNumber
    function getCustomer($customerNumber) {
        try {
            $db = getDBConnection();
            $query = "SELECT * FROM CUSTOMER
                        WHERE customerNumber = :customerNumber";
            $statement = $db->prepare ($query);
            $statement->bindValue(':customerNumber',$customerNumber);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/errorPage.php';
            die;
        }
        
    }
?>