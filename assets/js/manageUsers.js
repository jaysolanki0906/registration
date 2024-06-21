// Initialize global variable for Tabulator table
let table;

document.addEventListener("DOMContentLoaded", function () {
    // Function to fetch users data via AJAX
    function fetchUsers() {
        $.ajax({
            url: 'php/fetchUsers.php', // Adjust URL as per your server setup
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log("Data fetched from server:", data);

                // Initialize Tabulator table with fetched data
                table = new Tabulator("#user-table", {
                    data: data,
                    layout: "fitDataFill",
                    pagination: "local",
                    paginationSize: 10,
                    maxWidth: "100%",
                    responsiveLayout: true,
                    columns: [
                        { title: "#", field: "user_id", sorter: "number", headerHozAlign: "center", width: 50 },
                        { title: "Username", field: "username", sorter: "string", headerHozAlign: "center", width: 200 },
                        { title: "Fullname", field: "fullname", sorter: "string", headerHozAlign: "center", width: 250 },
                        { title: "Email", field: "email_id", sorter: "string", headerHozAlign: "center", width: 330 },
                        { title: "Mobile", field: "mobile_number", sorter: "string", headerHozAlign: "center", width: 180 },
                        { title: "role", field: "role", sorter: "string", visible: false },
                        { title: "password", field: "password", sorter: "string", visible: false },
                        { title: "admin", field: "admin", sorter: "string", visible: false },
                        { title: "product", field: "product", sorter: "string", visible: false },
                        { title: "purchase", field: "purchase", sorter: "string", visible: false },
                        { title: "production", field: "production", sorter: "string", visible: false },
                        { title: "billing", field: "billing", sorter: "string", visible: false },
                        { title: "customer", field: "customer", sorter: "string", visible: false },
                        { title: "report", field: "report", sorter: "string", visible: false },
                        {
                            title: "Action",
                            field: "action",
                            width: 200,
                            headerHozAlign: "center",
                            formatter: function (cell, formatterParams) {
                                return `
                                    <button class="btn btn-sm btn-primary edit-button"><i class='bi bi-pencil-fill'></i> Edit</button>
                                    <button class="btn btn-sm btn-danger delete-button"><i class='bi bi-trash-fill'></i> Delete</button>
                                `;
                            },
                            cellClick: function (e, cell) {
                                var data = cell.getRow().getData();
                                if (e.target.closest('.edit-button')) {
                                    console.log("Populating edit modal with data:", data);
                                    document.getElementById('editUserId').value = data.user_id;
                                    document.getElementById('editUsername').value = data.username;
                                    document.getElementById('editFullname').value = data.fullname;
                                    document.getElementById('editEmail').value = data.email_id;
                                    document.getElementById('editMobile').value = data.mobile_number;
                                    document.getElementById('editRole').value = data.role;
                                    document.getElementById('editPassword').value = data.password;
                                    document.getElementById('editConfirmPassword').value = data.password;
                                    
                                    // Set the checkbox values
                                    document.getElementById('editAdmin').checked = (data.admin == 1);
                                    document.getElementById('editProduct').checked = (data.product == 1);
                                    document.getElementById('editPurchase').checked = (data.purchase == 1);
                                    document.getElementById('editProduction').checked = (data.production == 1);
                                    document.getElementById('editBilling').checked = (data.billing == 1);
                                    document.getElementById('editCustomer').checked = (data.customer == 1);
                                    document.getElementById('editReport').checked = (data.report == 1);

                                    var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                                    editModal.show();
                                }
                            }
                        }
                    ]
                });
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    // Call fetchUsers function on page load
    fetchUsers();

    // Add User Button Click
    document.getElementById('addUserBtn').addEventListener('click', function () {
        document.getElementById('userForm').classList.toggle('d-none');
        this.classList.add('d-none');
    });

    // Close Modal Event
    document.getElementById('userFormModal').addEventListener('hidden.bs.modal', function () {
        const form = document.getElementById('form');
        form.reset();
        form.classList.remove('was-validated');
        const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
        inputs.forEach(input => {
            input.classList.remove('is-valid');
            input.classList.remove('is-invalid');
        });
    });

    // Form Submit Event
    document.getElementById("form").addEventListener("submit", function (event) {
        event.preventDefault();
        const form = event.target;
        let isValid = form.checkValidity();
        form.classList.add("was-validated");

        // Validate password confirmation
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

        // Add data to the Table
        let username = document.getElementById('username').value;
        let fullname = document.getElementById('fullname').value;
        let email = document.getElementById('email').value;
        let mobile = document.getElementById('mobile').value;
        let role = document.getElementById('role').value;
        let permissions = Array.from(document.querySelectorAll('.form-check-input:checked')).map(checkbox => checkbox.id);

        let newRow = {
            user_id: table.getDataCount() + 1, // Ensure 'user_id' matches the field in your data source
            username,
            fullname,
            email_id: email, // Ensure 'email_id' matches the field in your data source
            mobile_number: mobile, // Ensure 'mobile_number' matches the field in your data source
            role,
            admin: permissions.includes('admin') ? 1 : 0,
            product: permissions.includes('product') ? 1 : 0,
            purchase: permissions.includes('purchase') ? 1 : 0,
            production: permissions.includes('production') ? 1 : 0,
            billing: permissions.includes('billing') ? 1 : 0,
            customer: permissions.includes('customer') ? 1 : 0,
            report: permissions.includes('report') ? 1 : 0
        };

        table.addData([newRow]);
        bootstrap.Modal.getInstance(document.getElementById('userFormModal')).hide();
        form.reset();
        form.classList.remove('was-validated');

        // Role validation
        if (!role) {
            document.getElementById('role').classList.add("is-invalid");
            document.getElementById('role').nextElementSibling.textContent = "Please select a Role!";
            event.preventDefault();
        } else {
            document.getElementById('role').classList.remove("is-invalid");
            document.getElementById('role').nextElementSibling.textContent = "";
        }
    });

    // Permissions based on Role
    document.getElementById('role').addEventListener('change', function () {
        var role = this.value;
        var checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function (checkbox) {
            checkbox.checked = (role === "admin");
        });
    });

    // Form Validation
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

    // Edit Button Event
    document.getElementById('user-table').addEventListener('click', function (e) {
        if (e.target.closest('.edit-button')) {
            var cell = table.getCellFromEvent(e);
            var data = cell.getRow().getData();

            document.getElementById('editUserId').value = data.user_id; // Ensure 'editUserId' matches the id attribute of your input
            document.getElementById('editUsername').value = data.username;
            document.getElementById('editFullname').value = data.fullname;
            document.getElementById('editEmail').value = data.email_id;
            document.getElementById('editMobile').value = data.mobile_number;
            document.getElementById('editRole').value = data.role;
            document.getElementById('editPassword').value = data.password;
            document.getElementById('editConfirmPassword').value = data.password;

            // Set the checkbox values
            document.getElementById('editAdmin').checked = (data.admin == 1);
            document.getElementById('editProduct').checked = (data.product == 1);
            document.getElementById('editPurchase').checked = (data.purchase == 1);
            document.getElementById('editProduction').checked = (data.production == 1);
            document.getElementById('editBilling').checked = (data.billing == 1);
            document.getElementById('editCustomer').checked = (data.customer == 1);
            document.getElementById('editReport').checked = (data.report == 1);

            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editModal.show();
        }
    });

    // Confirm Delete Button Event
    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        var rowId = this.dataset.rowId;
        var row = table.getRow(rowId);
        row.delete();

        var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmationModal'));
        deleteModal.hide();
    });

    // Role validation
    document.getElementById('editRole').addEventListener('change', function () {
        var role = this.value;
        var checkboxes = document.querySelectorAll('.form-check-input');

        checkboxes.forEach(function (checkbox) {
            checkbox.checked = (role === "admin");
        });
    });

    $(document).ready(function () {
        $("#editForm").submit(function (event) {
            event.preventDefault(); 
            var formData = $(this).serialize(); 
    
            $.ajax({
                type: "POST",
                url: "php/updateUser.php",
                data: formData,
                success: function (response) {
                    alert("User updated successfully!"+ response);
                    $("#editUserModal").modal('hide');
                    fetchUsers();
                },
                error: function (xhr, status, error) {
                    alert("An error occurred: " + error);
                    console.log(xhr.responseText); // Log detailed error message
                }
            });
        });
    });   
});
