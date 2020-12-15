$(document).ready(function() {
    var tableCustID = "";
    /* Applies initial dataTable for main page
     mRender creates the various buttons on the dataTable*/
    var table = $('#displayTable').DataTable({
        scrollY: "60vh",
        scrollX: true,
        scrollCollapse: true,
        "autoWidth": false,
        "pageLength": 25,
        "processing": true,
        "serverSide": true,
        "ajax": "../view/getTableJSON.php",
        "columns": [
            null,
            null,
            null,
            null,
            {
                mRender: function(data, type, row) {
                    return '<a class="table-edit buttonStyleNoColor viewJobSites" data-toggle="modal" data-target="#CustomerJobSiteModal"data-target-id= "' + row[0] + '">Job Site </a>';
                }
            },

            {
                mRender: function(data, type, row) {
                    return '<a class="table-edit buttonStyleNoColor viewContacts"data-toggle="modal" data-target="#CustomerContactsModal" data-target-id= "' + row[0] + '">Contacts</a><input type ="hidden" name="ContactsCustomerID" value="' + row[0] + '"</input>';
                }
            },

            {
                mRender: function(data, type, row) {
                    return '<a class="table-edit buttonStyleNoColor viewMachinery" data-toggle="modal" data-target="#CustomerMachineryModal" data-target-id= "' + row[0] + '">Machinery</a><input type ="hidden" name="MachineryCustomerID" value="' + row[0] + '"</input>';
                }
            },
            null,
            null,
            /* EDIT */
            {
                mRender: function(data, type, row) {
                    return '<a class="table-edit buttonStyleNoColor viewEdit" data-target-id= "' + row[0] + '">EDIT</a><input type ="hidden" name="EditCustomerID" value="' + row[0] + '"</input><form class= "deleteCustomerForm"action="../controller/controller.php?action=ProcessDelete" method="post" enctype = "multipart/form-data"><input type="submit" onClick="return confDeleteSubmit(' + row[0] + ')"name= "DELETE" class="table-edit buttonStyleNoColor"value="DELETE"></input><input type ="hidden" name="DeleteInput" value="' + row[0] + '"</input></form>'
                }
            },
        ],
        'columnDefs': [{

            'targets': [4, 5, 6],
            /* column index */

            'orderable': false,
            /* true or false */

        }]
    });
    /* MOVED TO VIEW MODAL FOR NEW AND EDIT CUSTOMERS
    var Machinecounter = 1;
    var Contactcounter = 1;
    var JobSitecounter = 1;
    */

    //Modals for Customer Info
    //Set Value of CustID for Customer Info Modals
    $(document).on("click", ".viewContacts", function() {
        var custID = $(this).attr('data-target-id');
        var table = $('#ContactsTable').DataTable({
            scrollY: "60vh",
            scrollX: true,
            scrollCollapse: true,
            "autoWidth": false,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "bLengthChange": false,
            "ajax": '../view/getCustomerContactsTableJSON.php?customerNumber=' + custID,
        });
    });
    $(document).on("click", ".viewMachinery", function() {
        var custID = $(this).attr('data-target-id');
        var table = $('#MachineryTable').DataTable({
            scrollY: "60vh",
            scrollX: true,
            scrollCollapse: true,
            "autoWidth": false,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "bLengthChange": false,
            "ajax": '../view/getCustomerMachineryTableJSON.php?customerNumber=' + custID,
        });
    });
    $(document).on("click", ".viewJobSites", function() {
        var custID = $(this).attr('data-target-id');
        var table = $('#jobSitesTable').DataTable({
            scrollY: "60vh",
            scrollX: true,
            scrollCollapse: true,
            "autoWidth": false,
            "searching": false,
            "processing": true,
            "serverSide": true,
            "bLengthChange": false,
            "ajax": '../view/getCustomerJobsitesTableJSON.php?customerNumber=' + custID,
        });
    });
    $(document).on("click", ".viewEdit", function() {
        var custID = $(this).attr('data-target-id');
        document.getElementById("CustomerModalTitle").innerText = "Edit Customer: " + custID;
        $.ajax({
            type: "POST",
            url: "../view/EditCustomer.php",
            data: { custID: custID },
            success: function(data) {
                $('#customer_detail').html(data);
                $('#newCustomerModal').modal('show');
            }
        })
    });
    $('#CustomerJobSiteModal').on('hidden.bs.modal', function() {
        var table = $('#jobSitesTable').DataTable();
        table.destroy();
    });
    $('#CustomerContactsModal').on('hidden.bs.modal', function() {
        var table = $('#ContactsTable').DataTable();
        table.destroy();
    });
    $('#CustomerMachineryModal').on('hidden.bs.modal', function() {
        var table = $('#MachineryTable').DataTable();
        table.destroy();
    });
    /* Show New Customer Modal */
    $("#NewCustomerButton").on("click", function() {
        document.getElementById("CustomerModalTitle").innerText = "Add Customer";
        $.ajax({
            type: "POST",
            url: "../view/viewNewCustomer.php",
            data: {},
            success: function(data) {
                $('#customer_detail').html(data);
                $('#newCustomerModal').modal('show');
            }
        })
    });
    /* ALL MODAL FORM CONTROLS IN THIER PHP VIEW FILES
    $("#addrowMachinery").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td class="col-sm-11"><input type="text" class="form-control" id = "Machine' + Machinecounter + '" name="Machine' + Machinecounter + '" readonly/></td>';
        cols += '<td class="col-sm-8"><input type="text" class="form-control" name="MD' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-7"><input type="text" class="form-control" name="SerialNumber' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-6"><input type="text" class="form-control" name="Range' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-5"><input type="text" class="form-control" name="lastCalibrationDate' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-4"><input type="text" class="form-control" name="RepairPrice' + Machinecounter + '"/></td>';
        cols += '<td class="col-sm-3"><input type="number" class="form-control" name="MachineryJobSiteID' + Machinecounter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDelMachinery btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-Machinery").append(newRow);
        document.getElementById("Machine" + Machinecounter).value = Machinecounter;
        document.getElementById("Machinecounter").value = Machinecounter;
        Machinecounter++;
    });
    $("#addrowContact").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

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
        Contactcounter++;
    });
    $("#addrowJobSite").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";
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

        cols += '<td><input type="button" class="ibtnDelJobSite btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list-JobSite").append(newRow);
        document.getElementById("JobSite" + JobSitecounter).value = JobSitecounter;
        document.getElementById("JobSitecounter").value = JobSitecounter;
        JobSitecounter++;
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
    */

    /* Add styling to show hovered styling on dataTable column */
    $('#displayTable tbody')
        .on('mouseenter', 'td', function() {
            var colIdx = table.cell(this).index().column;

            $(table.cells().nodes()).removeClass('highlight');
            $(table.column(colIdx).nodes()).addClass('highlight');
        });
});

/* Resets DataTable status when tables are switched out or in need of reloading*/
function TableSwitch() {
    //PREPARE TABLE SWITCH
    var table = $('#displayTable').DataTable();
    table.destroy();
    $('#displayTable').empty();
    //SHOW ADVANCED TABLE
    if (document.getElementById("advancedViewToggle").checked == true) {
        var newHeader = ["Customer Number", "Active Status", "Company Name", "Company Identifier", "Job Sites", "Contacts", "Machinery", "Tour Month",
            "Scheduled Date", "Date Acquired", "Last Updated", "Tax Exempt Status", "County", "Tax Rate",
            "Credit Terms", "COD Date", "Certs / Instructs", "PO Num", "Company Division", "Call Prior", "Technician Assigned",
            "Address 1", "Address 2", "City", "State", "Zip", "Working Hours", "Directions", "Comments", "Map Done", "Options"
        ];
        table = document.getElementById('displayTable');
        table.deleteTHead();
        var thead = table.createTHead();
        var row = thead.insertRow();
        var columnCount = newHeader.length;
        for (var i = 0; i < columnCount; i++) {
            th = document.createElement('th');
            var text = document.createTextNode(newHeader[i]);
            th.appendChild(text);
            row.appendChild(th);
        }
        /* Advanced View DataTable settings*/
        table = $('#displayTable').DataTable({
            scrollY: "60vh",
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                leftColumns: 1
            },
            "autoWidth": false,
            "pageLength": 25,
            "processing": true,
            "serverSide": true,
            "ajax": "../view/getAdvancedTableJSON.php",
            "columns": [
                null, // assume this is the id of the row, so don't show it
                null,
                null,
                null,
                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewJobSites" data-toggle="modal" data-target="#CustomerJobSiteModal" data-target-id= "' + row[0] + '">Job Site </a><input type ="hidden" name="JobSiteCustomerID" value="' + row[0] + '"</input > ';
                    }
                },

                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewContacts"data-toggle="modal" data-target="#CustomerContactsModal" data-target-id= "' + row[0] + '">Contacts</a><input type ="hidden" name="ContactsCustomerID" value="' + row[0] + '"</input>';
                    }
                },

                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewMachinery" data-toggle="modal" data-target="#CustomerMachineryModal" data-target-id= "' + row[0] + '">Machinery</a><input type ="hidden" name="MachineryCustomerID" value="' + row[0] + '"</input>';
                    }
                },
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                /* EDIT */
                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewEdit" data-target-id= "' + row[0] + '">EDIT</a><input type ="hidden" name="EditCustomerID" value="' + row[0] + '"</input><form class= "deleteCustomerForm"action="../controller/controller.php?action=ProcessDelete" method="post" enctype = "multipart/form-data"><input type="submit" onClick="return confDeleteSubmit(' + row[0] + ')"name= "DELETE" class="table-edit buttonStyleNoColor"value="DELETE"></input><input type ="hidden" name="DeleteInput" value="' + row[0] + '"</input></form>'
                    }
                },
            ],
            'columnDefs': [{

                'targets': [4, 5, 6],
                /* column index */

                'orderable': false,
                /* true or false */

            }]
        });
        /* DataTable hover highlighting */
        $('#displayTable tbody')
            .on('mouseenter', 'td', function() {
                var colIdx = table.cell(this).index().column;

                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            });
        // RESTORE BASIC TABLE VIEW
    } else {
        var newHeader = ["Customer Number", "Active Status", "Company Name", "Company Identifier", "Job Sites", "Contacts", "Machinery", "Tour Month",
            "Last Updated", "Options"
        ];
        var table = document.getElementById('displayTable');
        table.deleteTHead();
        var thead = table.createTHead();
        var row = thead.insertRow();
        var columnCount = newHeader.length;
        for (var i = 0; i < columnCount; i++) {
            th = document.createElement('th');
            var text = document.createTextNode(newHeader[i]);
            th.appendChild(text);
            row.appendChild(th);
        }
        var table = $('#displayTable').DataTable({
            scrollY: "60vh",
            scrollX: true,
            scrollCollapse: true,
            "autoWidth": false,
            "pageLength": 25,
            "processing": true,
            "serverSide": true,
            fixedColumns: false,
            "ajax": "../view/getTableJSON.php",
            "columns": [
                null, // assume this is the id of the row, so don't show it
                null,
                null,
                null,
                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewJobSites" data-toggle="modal" data-target="#CustomerJobSiteModal" data-target-id= "' + row[0] + '">Job Site </a><input type ="hidden" name="JobSiteCustomerID" value="' + row[0] + '"</input > ';
                    }
                },

                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewContacts"data-toggle="modal" data-target="#CustomerContactsModal" data-target-id= "' + row[0] + '">Contacts</a><input type ="hidden" name="ContactsCustomerID" value="' + row[0] + '"</input>';
                    }
                },

                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewMachinery" data-toggle="modal" data-target="#CustomerMachineryModal" data-target-id= "' + row[0] + '">Machinery</a><input type ="hidden" name="MachineryCustomerID" value="' + row[0] + '"</input>';
                    }
                },
                null,
                null,
                /* EDIT */
                {
                    mRender: function(data, type, row) {
                        return '<a class="table-edit buttonStyleNoColor viewEdit" data-target-id= "' + row[0] + '">EDIT</a><input type ="hidden" name="EditCustomerID" value="' + row[0] + '"</input><form class= "deleteCustomerForm"action="../controller/controller.php?action=ProcessDelete" method="post" enctype = "multipart/form-data"><input type="submit" onClick="return confDeleteSubmit(' + row[0] + ')"name= "DELETE" class="table-edit buttonStyleNoColor"value="DELETE"></input><input type ="hidden" name="DeleteInput" value="' + row[0] + '"</input></form>'
                    }
                },
            ],
            'columnDefs': [{

                'targets': [4, 5, 6],
                /* column index */

                'orderable': false,
                /* true or false */

            }]
        });
        $('#displayTable tbody')
            .on('mouseenter', 'td', function() {
                var colIdx = table.cell(this).index().column;

                $(table.cells().nodes()).removeClass('highlight');
                $(table.column(colIdx).nodes()).addClass('highlight');
            });
    }
}

function BuildTable() {
    if (tableID == "") {
        document.getElementById("table-wrapper").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table-wrapper").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getTable.php?q=Customers", true);
    xmlhttp.send();
}

/* No longer Used */

function BuildSearchTable() {
    var Criteria = document.getElementById("Criteria").value;
    if (Criteria == "") {
        alert("Search cannot be empty");
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table-wrapper").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "getTable.php?q=" + Criteria, true);
    xmlhttp.send();
}
//--->button > edit > start	
$(document).on('click', '.btn_edit', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('row_id');
    $('.btn_save').css("visibility, visible");
    $('.btn_cancel').css("visibility, visible");
    $('.btn_delete').css("visibility, visible");

    tbl_row.find('.btn_save').show();
    tbl_row.find('.btn_cancel').show();
    tbl_row.find('.btn_delete').show();

    //hide edit button
    tbl_row.find('.btn_edit').hide();

    //make the whole row editable
    tbl_row.find('.row_data')
        .attr('contenteditable', 'true')
        .attr('edit_type', 'button')
        .addClass('bg-warning')
        .css('padding', '3px')

    //--->add the original entry > start
    tbl_row.find('.row_data').each(function(index, val) {
        //this will help in case user decided to click on cancel button
        $(this).attr('original_entry', $(this).html());
    });
    //--->add the original entry > end

});
//--->button > edit > end
//--->button > cancel > start	
$(document).on('click', '.btn_cancel', function(event) {
    event.preventDefault();

    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('row_id');

    //show edit button
    tbl_row.find('.btn_edit').show();

    //make the whole row editable
    tbl_row.find('.row_data')
        .attr('edit_type', 'click')
        .removeClass('bg-warning')
        .css('padding', '')

    tbl_row.find('.row_data').each(function(index, val) {
        $(this).html($(this).attr('original_entry'));
    });
});
//--->button > cancel > end
function hideButtons() {
    $(document).find('.btn_save').hide();
    $(document).find('.btn_cancel').hide();
    $(document).find('.btn_delete').hide();
}

/* Require User confirmation on customer delete*/
function confDeleteSubmit(customerNumber) {
    var agree = confirm("Are you sure you want to delete Customer: " + customerNumber + "?");
    if (agree)
        return true;
    else
        return false;
}


function addrowContact() {
    var newRow = $("<tr>");
    var cols = "";

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
    Contactcounter++;
}

// weeklySchedule JS

var currentYear = 2014; //for demonstration purposes only with archived database
var tourMonth;
var d = new Date();
var month = d.getMonth();
var Week;
var Tech;

var defaultMonth = document.getElementById("defaultMonth")
if (defaultMonth != null && defaultMonth.value == '') {
    defaultMonth.value = month;
    console.log(defaultMonth.value);
}


function getTourMonth() {
    tourMonth = document.getElementById("selectTourMonth").value;
    console.log(tourMonth);


    var mondays = [];
    var numMondays = 0;
    d.setFullYear(currentYear); //comment out this line when setting up for current database
    d.setDate(1); // prevents issue with February when the today's date is 29, 30, or 31
    d.setMonth(tourMonth);

    //console.log(d);
    month = d.getMonth();
    document.getElementById("defaultMonth").value = month;

    console.log(document.getElementById("defaultMonth").value);
    document.getElementById("opt4").style.display = "none";




    // Get the first Monday in the month
    while (d.getDay() !== 1) {
        d.setDate(d.getDate() + 1);
    }

    // Get all the other Mondays in the month
    while (d.getMonth() === month) {
        mondays.push(new Date(d.getTime()));
        d.setDate(d.getDate() + 7);
        numMondays++;
    }

    console.log(numMondays);
    var j = 0;
    while (mondays[j].getDate() < d.getDate()) {

    }


    for (var i = 0; i < numMondays; i++) {
        //var inside = (mondays[i].getMonth() + 1) + "/" + (mondays[i].getDate()) + "/" + (mondays[i].getFullYear());
        //console.log(inside);
        document.getElementById("opt" + i).innerHTML = ((mondays[i].getMonth() + 1) + "/" + (mondays[i].getDate()) +
            "/" + (mondays[i].getFullYear()));
        document.getElementById("opt" + i).value = ((mondays[i].getFullYear()) + "-" + (mondays[i].getMonth() + 1) +
            "-" + (mondays[i].getDate()));
        document.getElementById("opt" + i).style.display = "block";
    }




}

function getWeek() {
    Week = document.getElementById("selectWeek").value;
    console.log(Week);
}

function getTech() {
    Tech = document.getElementById("selectTech").value;
    console.log(Tech);


}