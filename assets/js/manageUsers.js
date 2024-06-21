// Add User
let table;
document.getElementById('addUserBtn').addEventListener('click', function () {
    document.getElementById('userForm').classList.toggle('d-none');
    this.classList.add('d-none');
});

//CloseBtn
document.getElementById('userFormModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('form').reset();

    form.classList.remove('was-validated');
    const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
    inputs.forEach(input => {
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');
    });
});

// Submit
document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
    const form = event.target;
    let isValid = form.checkValidity();
    form.classList.add("was-validated");

    // Confirm password
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        document.getElementById('confirmPassword').setCustomValidity("Passwords do not match!");
        isValid = false;
    } else {
        document.getElementById('confirmPassword').setCustomValidity("");
    }

    if (!isValid) {
        return;
    }

    //Add data to the Table
    let username = document.getElementById('username').value;
    let fullname = document.getElementById('fullname').value;
    let email = document.getElementById('email').value;
    let mobile = document.getElementById('mobile').value;
    let role = document.getElementById('role').value;
    let permissions = Array.from(document.querySelectorAll('.form-check-input:checked')).map(checkbox => checkbox.id);

    let newRow = {
        srNo: table.getDataCount() + 1,
        username,
        fullname,
        email,
        mobile,
        role,
        permissions
    };

    table.addData([newRow]);
    bootstrap.Modal.getInstance(document.getElementById('userFormModal')).hide();
    form.reset();
    form.classList.remove('was-validated');

    // Role
    if (!role) {
        document.getElementById('role').classList.add("is-invalid");
        document.getElementById('role').nextElementSibling.textContent = "Please select a Role!";
        event.preventDefault();
    } else {
        document.getElementById('role').classList.remove("is-invalid");
        document.getElementById('role').nextElementSibling.textContent = "";
    }
});

// Permissions
document.getElementById('role').addEventListener('change', function () {
    var role = this.value;
    var checkboxes = document.querySelectorAll('.form-check-input');

    checkboxes.forEach(function (checkbox) {
        checkbox.checked = (role === "admin");
    });
});

//Form Validation
document.querySelectorAll(".form-control").forEach(function (input) {
    input.addEventListener("input", function () {
        if (this.checkValidity()) {
            this.classList.remove("is-invalid");
            this.nextElementSibling.textContent = "";
        } else {
            this.classList.add("is-invalid");
            this.nextElementSibling.textContent = this.validationMessage;
        }
    });
});


//Table
document.addEventListener("DOMContentLoaded", function () {
    table = new Tabulator("#user-table", {
        layout: "fitDataFill",
        maxHeight: "400px",
        maxWidth: "100%",
        hozAlign: "center",
        responsiveLayout: true,
        columns: [
            { title: "#", field: "User_id", sorter: "number", headerHozAlign: "center", width: 50 },
            { title: "Username", field: "username", sorter: "string", headerHozAlign: "center", width: 200 },
            { title: "Fullname", field: "fullname", sorter: "string", headerHozAlign: "center", width: 250 },
            { title: "Email", field: "email_id", sorter: "string", headerHozAlign: "center", width: 330 },
            { title: "Mobile", field: "mobile_number", sorter: "string", headerHozAlign: "center", width: 180 },
            {
                title: "Actions",
                field: "actions",
                width: 200,
                headerHozAlign: "center",
                formatter: function (cell, formatterParams) {
                    let div = document.createElement("div");

                    // Edit Button
                    let editButton = document.createElement("button");
                    editButton.className = "btn btn-sm btn-primary me-2 p-2";
                    editButton.innerHTML = "<i class='bi bi-pencil-fill'></i> Edit";
                    editButton.onclick = function () {
                        let rowData = cell.getRow().getData();
                        fillForm(rowData);
                    };
                    div.appendChild(editButton);

                    // Delete Button
                    let deleteButton = document.createElement("button");
                    deleteButton.className = "btn btn-sm btn-danger p-2";
                    deleteButton.innerHTML = "<i class='bi bi-trash-fill'></i> Delete";
                    deleteButton.onclick = function () {
                        let rowData = cell.getRow().getData();
                        showDeleteConfirmation(rowData.User_id);
                    };
                    div.appendChild(deleteButton);

                    return div;
                }
            }
        ]
    });

    fetchUsers();
    window.addEventListener("resize", function () {
        table.redraw();
    });
});

function fetchUsers() {
    $.ajax({
        url: 'php/fetchUsers.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Data fetched from server:", data);
            data.forEach((user, index) => {
                user.srNo = index + 1;
            });
            table.setData(data);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}
//Delete
function showDeleteConfirmation(rowId) {
    let modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();

    document.getElementById('confirmDeleteButton').onclick = function () {
        $.ajax({
            url: 'php/deleteUser.php',
            type: 'POST',
            data: { id: rowId },
            success: function (response) {
                try {
                    let res = typeof response === "string" ? JSON.parse(response) : response; // Parse the JSON response
                    if (res.success) {
                        console.log("User deleted successfully");
                        modal.hide();
                        fetchUsers();  // Refresh the data in the table
                    } else {
                        console.error('Error deleting user:', res.error);
                        alert("Error deleting user. Please try again. " + res.error);
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                    alert("Error deleting user. Please try again. " + error.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText, status, error);
                alert("Error deleting user. Check console for details.");
            }
        });
    };
}


//Edit
function fillForm(data) {

    editingRowId = data.srNo;

    document.getElementById('username').value = data.username;
    document.getElementById('fullname').value = data.fullname;
    document.getElementById('email').value = data.email;
    document.getElementById('mobile').value = data.mobile;
    document.getElementById('role').value = data.role;

    let checkboxes = document.querySelectorAll('.form-check-input');
    checkboxes.forEach(checkbox => checkbox.checked = data.permissions.includes(checkbox.id));

    new bootstrap.Modal(document.getElementById('userFormModal')).show();
}
