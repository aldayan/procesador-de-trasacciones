var selectedRow = null;

function onFormSubmit() {
    var formData = readFormData();
    if (selectedRow == null)
        insertNewRecord(formData);
    else
        updateRecord(formData);
    resetForm();

}


function readFormData() {

    var formData = {};

    formData["Name"] = document.getElementById("Name").value;
    formData["kkk"] = document.getElementById("kkk").value;
    formData["cell"] = document.getElementById("cell").value;
    formData["productType"] = document.getElementById("productType").value;

    return formData;
}

function insertNewRecord(data) {

    var table = document.getElementById("contactolista").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.length);

    cell1 = newRow.insertCell(0);
    cell1.innerHTML = data.Name;
    cell2 = newRow.insertCell(1);
    cell2.innerHTML = data.kkk;
    cell3 = newRow.insertCell(2);
    cell3.innerHTML = data.cell;
    cell4 = newRow.insertCell(3);
    cell4.innerHTML = data.productType;
    cell5 = newRow.insertCell(4);
    cell5.innerHTML = `<button onclick="onEdit(this)" class="btn btn-warning">Editar</button>
                        <button onclick="onDelete(this)" class="btn btn-danger">Eliminar</button>`
}

function resetForm() {
    document.getElementById("Name").value = "";
    document.getElementById("kkk").value = "";
    document.getElementById("cell").value = "";
    document.getElementById("productType").value = "";
    selectedRow = null;
}

function onEdit(td) {
    selectedRow = td.parentElement.parentElement;
    document.getElementById("Name").value = selectedRow.cells[0].innerHTML;
    document.getElementById("kkk").value = selectedRow.cells[1].innerHTML;
    document.getElementById("celll").value = selectedRow.cells[2].innerHTML;
    document.getElementById("productType").value = selectedRow.cells[3].innerHTML;

}

function updateRecord(formData) {
    selectedRow.cells[0].innerHTML = formData.Name;
    selectedRow.cells[1].innerHTML = formData.kkk;
    selectedRow.cells[2].innerHTML = formData.cell;
    selectedRow.cells[3].innerHTML = formData.productType;
}

function onDelete(td) {
    row = td.parentElement.parentElement;
    document.getElementById("contactolista").deleteRow(row.rowIndex);
    resetForm();
}