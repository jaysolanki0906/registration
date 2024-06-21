<?php
include("components/header.php");
include 'php/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="main" style="background-color: #F5F5F5;">
        <div class="container d-flex align-items-center justify-content-center flex-column">
            <button class="btn btn-warning mb-3 mt-5" id="addproductBtn" data-bs-toggle="modal" data-bs-target="#productFormModal">Add Product</button>
        </div>
    </div>
    <div class="modal fade" id="productFormModal" tabindex="-1" aria-labelledby="productFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFormModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ms-2 me-2">
                    <form id="productform">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="productname" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="productname" name="productname" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="category" class="form-label">Category:</label>
                                <select class="form-select" id="categoryselect" name="category" required>
                                    <option disabled selected>Select a Category</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sub-category" class="form-label">Sub Category:</label>
                                <select class="form-select" id="subcategoryselect" name="sub_category" required>
                                    <option disabled selected>Select a Sub-Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="inventory" class="form-label">Inventory:</label>
                                <input type="number" class="form-control" value="0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="cgst" class="form-label">CGST:</label>
                                <input type="number" class="form-control" value="0" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="sgst" class="form-label">SGST:</label>
                                <input type="number" class="form-control" value="0" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="igst" class="form-label">IGST:</label>
                                <input type="number" class="form-control" value="0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" class="form-control" value="0" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn button-color" id="addproductBtn">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets\js\product_backend.js"></script>
</body>
</html>
<?php
include("components/footer.php");
?>