DROP TABLE IF EXISTS
    JOB_SITE;
DROP TABLE IF EXISTS
    MACHINERY;
DROP TABLE IF EXISTS
    REPAIR_PRICE;
DROP TABLE IF EXISTS
    CONTACT;
DROP TABLE IF EXISTS
    CUSTOMER;
DELIMITER
    $$
DROP
PROCEDURE IF EXISTS MDASSIGN $$
CREATE PROCEDURE MDAssign(
    customerCount INT,
    EndOfCount INT
)
BEGIN
    DECLARE
        CustValue INT DEFAULT 1 ; DECLARE rowCursor INT DEFAULT 1 ; DECLARE IfCounter INT DEFAULT 1 ; DECLARE OrginalValue INT DEFAULT 1 ;
    SET
        OrginalValue = customerCount ; WHILE rowCursor <= EndOfCount
    DO
        IF rowCursor > customerCount THEN
    SET
        IfCounter = IfCounter + 1 ;
    SET
        CustValue = 1 ;
    SET
        customerCount = OrginalValue * IfCounter ;
END IF ;
UPDATE
    `machinery`
SET
    machinery.customerID = CustValue
WHERE
    machinery.MachineryID = rowCursor ;
SET
    rowCursor = rowCursor + 1 ;
SET
    CustValue = CustValue + 1 ;
END WHILE ;
END $$
DROP
PROCEDURE IF EXISTS priceOfRepairsAssign $$
CREATE PROCEDURE priceOfRepairsAssign(EndOfCount INT)
BEGIN
    DECLARE
        repairValue INT DEFAULT 1 ; DECLARE rowCursor INT DEFAULT 1 ; DECLARE IfCounter INT DEFAULT 1 ; DECLARE OrginalValue INT DEFAULT 1 ; WHILE rowCursor <= EndOfCount
    DO
UPDATE
    `machinery`
SET
    machinery.priceOfRepairs = repairValue
WHERE
    machinery.MachineryID = rowCursor ;
SET
    rowCursor = rowCursor + 1 ;
SET
    repairValue = repairValue + 1 ;
END WHILE ;
END $$
Delimiter
    ;
DELIMITER
    $$
DROP
PROCEDURE IF EXISTS customerContactAssign $$
CREATE PROCEDURE customerContactAssign(
    customerCount INT,
    EndOfCount INT
)
BEGIN
    DECLARE
        ContactValue INT DEFAULT 1 ; DECLARE rowCursor INT DEFAULT 1 ; DECLARE IfCounter INT DEFAULT 1 ; DECLARE OrginalValue INT DEFAULT 1 ;
    SET
        OrginalValue = customerCount ; WHILE rowCursor <= EndOfCount
    DO
        IF rowCursor > customerCount THEN
    SET
        IfCounter = IfCounter + 1 ;
    SET
        ContactValue = 1 ;
    SET
        customerCount = OrginalValue * IfCounter ;
END IF ;
UPDATE
    `contact`
SET
    contact.customerID = ContactValue
WHERE
    contact.ContactID = rowCursor ;
SET
    rowCursor = rowCursor + 1 ;
SET
    ContactValue = ContactValue + 1 ;
END WHILE ;
END $$
Delimiter
    ;
DELIMITER
    $$
DROP
PROCEDURE IF EXISTS jobSiteContactAssign $$
CREATE PROCEDURE jobSiteContactAssign(EndOfCount INT)
BEGIN
    DECLARE
        siteContactValue INT DEFAULT 1 ; DECLARE rowCursor INT DEFAULT 1 ; DECLARE siteContactCount INT DEFAULT 1 ;
    SET
        siteContactCount =(
    SELECT
        COUNT(*)
    FROM
        contact
    ) +1 ;
SET
    siteContactValue = siteContactCount / 2 ; WHILE rowCursor <= EndOfCount
DO
UPDATE
    `job_site`
SET
    job_site.siteContact = siteContactValue
WHERE
    job_site.JobSiteID = rowCursor ;
SET
    rowCursor = rowCursor + 1 ;
SET
    siteContactValue = siteContactValue + 1 ;
END WHILE ;
END $$
Delimiter
    ;
Delimiter 
	$$
DROP
PROCEDURE IF EXISTS jobSiteCustomerAssign $$
CREATE PROCEDURE jobSiteCustomerAssign(EndOfCount INT)
BEGIN
    DECLARE
        repairValue INT DEFAULT 1 ; DECLARE rowCursor INT DEFAULT 1 ; DECLARE IfCounter INT DEFAULT 1 ; WHILE rowCursor <= EndOfCount
    DO
UPDATE
    `job_site`
SET
    job_site.customerID = rowCursor
WHERE
    job_site.JobSiteID = rowCursor ;
SET
    rowCursor = rowCursor + 1 ;
END WHILE ;
END $$
Delimiter
    ;
CREATE TABLE CUSTOMER(
    customerNumber INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    companyName VARCHAR(100),
    TourMonth DATE,
    companyIdentifier VARCHAR(50),
    billingContact INT,
    lastUpdated DATE,
    dateAcquired DATE,
    scheduledDate DATE,
    taxExemptStatus VARCHAR(5),
    County VARCHAR(50),
    taxRate FLOAT,
    creditTerms VARCHAR(20),
    COD_Date VARCHAR(25),
    certsInstructs BIT,
    activeStatus varchar(25),
    QARequirement BIT,
    PONum VARCHAR(50),
    companyDivision VARCHAR(100),
    callPrior VARCHAR(25),
    technicianAssigned VARCHAR(10),
    Comments TEXT,
    mapDone BIT,
    SolicitationDate DATE,
    TourMonthInput VARCHAR(25),
    lastUpdatedInput VARCHAR(25),
    dateAcquiredInput VARCHAR(25),
    scheduledDateInput VARCHAR(25),
    SolicitationDateInput VARCHAR(25)
) ; CREATE TABLE CONTACT(
    ContactID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID INT,
    Title VARCHAR(5),
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    Department VARCHAR(100),
    Address1 VARCHAR(100),
    Address2 VARCHAR(50),
    City VARCHAR(25),
    State VARCHAR(10),
    Zip VARCHAR(15),
    Phone VARCHAR(20),
    faxNumber VARCHAR(20),
    email VARCHAR(50),
    FOREIGN KEY(customerID) REFERENCES CUSTOMER(customerNumber) ON DELETE CASCADE
) ; CREATE TABLE JOB_SITE(
    JobSiteID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    siteContact INT,
    customerID INT,
    Phone VARCHAR(20),
    Fax VARCHAR(20),
    Address1 VARCHAR(100),
    Address2 VARCHAR(50),
    City VARCHAR(25),
    State VARCHAR(10),
    Zip VARCHAR(15),
    WorkingHours VARCHAR(50),
    Directions MEDIUMTEXT,
    SolicitedConfirmed bit,
    FOREIGN KEY(customerID) REFERENCES CUSTOMER(customerNumber) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY(siteContact) REFERENCES CONTACT(ContactID) ON DELETE SET NULL
) ; CREATE TABLE REPAIR_PRICE(
    PriceID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Cost VARCHAR(10)
) ; CREATE TABLE MACHINERY(
    MachineryID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    customerID INT,
    SerialNumber VARCHAR(50),
    MD VARCHAR(100),
    MachineRange VARCHAR(50),
    lastCalibrationDate DATE,
    priceOfRepairs INT,
    lastCalibrationDateInput VARCHAR(25),
    JobSiteID INT,
    FOREIGN KEY(priceOfRepairs) REFERENCES REPAIR_PRICE(PriceID) ON DELETE CASCADE,
    FOREIGN KEY(customerID) REFERENCES CUSTOMER(customerNumber) ON DELETE CASCADE
) ; DELETE
FROM
    `repair_price` ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE repair_price FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Cost
) ;
SET
    @RowCount =(
    SELECT
        COUNT(*)
    FROM
        repair_price
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `repair_price` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    SerialNumber,
    MachineRange,
    lastCalibrationDateInput
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    SerialNumber,
    MachineRange,
    lastCalibrationDateInput
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    SerialNumber,
    MachineRange,
    lastCalibrationDateInput
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    SerialNumber,
    MachineRange,
    lastCalibrationDateInput
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    SerialNumber,
    MachineRange,
    lastCalibrationDateInput
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    SerialNumber,
    MachineRange,
    lastCalibrationDateInput
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    lastCalibrationDateInput,
    MachineRange,
    @dummy,
    SerialNumber
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    @dummy,
    @dummy,
    lastCalibrationDateInput,
    @dummy,
    SerialNumber,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MachineRange
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    @dummy,
    SerialNumber,
    @dummy,
    @dummy,
    @dummy,
    lastCalibrationDateInput,
    @dummy,
    @dummy,
    @dummy,
    MachineRange
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    machinery
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `machinery` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE machinery FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    MD,
    @dummy,
    SerialNumber,
    @dummy,
    @dummy,
    @dummy,
    lastCalibrationDateInput,
    @dummy,
    @dummy,
    @dummy,
    MachineRange
) ;
UPDATE
    machinery
SET
    lastCalibrationDate = STR_TO_DATE(
        lastCalibrationDateInput,
        '%m/%d/%Y'
    ) ;
DELETE
FROM
    `customer` ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE customer FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    lastUpdatedInput,
    dateAcquiredInput,
    TourMonthInput,
    scheduledDateInput,
    companyIdentifier,
    @dummy,
    @dummy,
    @dummy,
    companyName,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    taxExemptStatus,
    @dummy,
    County,
    taxRate,
    @dummy,
    creditTerms,
    COD_Date,
    certsInstructs,
    activeStatus,
    QARequirement,
    billingContact,
    PONum,
    @dummy,
    companyDivision,
    callPrior,
    @dummy,
    technicianAssigned,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Comments,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy
) ;
UPDATE
    Customer
SET
    TourMonth = STR_TO_DATE(TourMonthInput, "%M") ;
UPDATE
    Customer
SET
    lastUpdated = STR_TO_DATE(lastUpdatedInput, '%m/%d/%Y') ;
UPDATE
    Customer
SET
    dateAcquired = STR_TO_DATE(dateAcquiredInput, '%M/%Y') ;
UPDATE
    Customer
SET
    scheduledDate = STR_TO_DATE(scheduledDateInput, '%m/%d/%Y') ;
UPDATE
    Customer
SET
    SolicitationDate = STR_TO_DATE(SolicitationDateInput, '%m/%d/%Y') ;
SET
    @CustomerCount =(
SELECT
    COUNT(*)
FROM
    customer
) ;
DELETE
FROM
    `contact` ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE contact FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Title,
    firstName,
    lastName,
    @dummy,
    Department,
    Address1,
    Address2,
    City,
    State,
    Zip,
    Phone,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    faxNumber,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    email,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy
) ;
SET
    @RowCount =(
SELECT
    COUNT(*)
FROM
    contact
) + 1 ;
SET
    @sql = CONCAT(
        'ALTER TABLE `contact` AUTO_INCREMENT = ',
        @RowCount
    ) ;
PREPARE
    st
FROM
    @sql ;
EXECUTE
    st ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE contact FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    firstName,
    Phone,
    faxNumber
) ;
DELETE
FROM
    `job_site` ;
LOAD DATA INFILE
    'Database.csv'
INTO TABLE job_site FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n'(
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    Phone,
    Fax,
    Address1,
    Address2,
    City,
    State,
    Zip,
    WorkingHours,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dir3,
    @dir4,
    @dir5,
    @dir6,
    @dir7,
    @dir8,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dummy,
    @dir9,
    @dir10
)
SET
    Directions = CONCAT(
        @dir3,
        ' ',
        @dir4,
        ' ',
        @dir5,
        ' ',
        @dir6,
        ' ',
        @dir7,
        ' ',
        @dir8,
        ' ',
        @dir9,
        ' ',
        @dir10
    ) ;
SET
    @End =(
SELECT
    COUNT(*)
FROM
    machinery
) ;
CALL
    MDASSIGN(@CustomerCount, @End) ;
CALL
    priceOfRepairsAssign(@End) ;
SET
    @End =(
SELECT
    COUNT(*)
FROM
    contact
) ;
CALL
    customerContactAssign(@CustomerCount, @End) ;
SET
    @End =(
SELECT
    COUNT(*)
FROM
    job_site
) ;
CALL
    jobSiteContactAssign(@End) ;
SET
    @End =(
SELECT
    COUNT(*)
FROM
    customer
) ;
CALL
    jobSiteCustomerAssign(@End) ;
    
ALTER TABLE customer
  ADD  OrderTaken bit NOT NULL;
ALTER TABLE customer
  ADD  WorkOrderTyped bit NOT NULL;
ALTER TABLE customer
  ADD  WorkOrderCopied bit NOT NULL;
ALTER TABLE customer
  ADD  WorkDone bit NOT NULL;
ALTER TABLE customer
  ADD  CertsDone bit NOT NULL;
  
  ALTER TABLE customer MODIFY OrderTaken varchar(25),
MODIFY WorkOrderTyped varchar(25),
MODIFY WorkOrderCopied varchar(25),
MODIFY WorkDone varchar(25),
MODIFY CertsDone varchar(25);
UPDATE customer SET OrderTaken = 'Incomplete' WHERE OrderTaken = '1';
UPDATE customer SET OrderTaken = 'Incomplete' WHERE OrderTaken = '0';

UPDATE customer SET WorkOrderTyped = 'Incomplete' WHERE WorkOrderTyped = '1';
UPDATE customer SET WorkOrderTyped = 'Incomplete' WHERE WorkOrderTyped = '0';

UPDATE customer SET WorkOrderCopied = 'Incomplete' WHERE WorkOrderCopied = '1';
UPDATE customer SET WorkOrderCopied = 'Incomplete' WHERE WorkOrderCopied = '0';

UPDATE customer SET WorkDone = 'Incomplete' WHERE WorkDone = '1';
UPDATE customer SET WorkDone = 'Incomplete' WHERE WorkDone = '0';

UPDATE customer SET CertsDone = 'Incomplete' WHERE CertsDone = '1';
UPDATE customer SET CertsDone = 'Incomplete' WHERE CertsDone = '0';

DELETE FROM Machinery WHERE MD = "";
