document.getElementById("AddRow").addEventListener("click", AddRow());
var countRow = 1;

function AddRow() {
    var table = document.getElementById("usersTable");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    cell1.innerHTML = countRow;
    cell2.innerHTML = "Calibration";
    cell3.innerHTML = "Done";
    cell4.innerHTML = "Done";
    cell5.innerHTML = "Not Done";
}