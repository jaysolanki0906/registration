$(document).ready(function() {
    $('#productFormModal').on('shown.bs.modal', function() {
        $.ajax({
            url: 'php/get-category.php',
            method: 'GET',
            data: {
                type: 'categories'
            },
            success: function(data) {
                var categories = JSON.parse(data);
                var categorySelect = $('#categoryselect');
                categorySelect.empty().append('<option disabled selected>Select a Category</option>');
                categories.forEach(function(category) {
                    categorySelect.append('<option value="' + category.id + '">' + category.description + '</option>');
                });
            }
        });
    });

    $('#categoryselect').change(function() {
        var categoryId = $(this).val();
        $.ajax({
            url: 'php/get-sub-category.php',
            method: 'GET',
            data: {
                type: 'subcategories',
                category_id: 'categoryId'
            },
            success: function(data) {
                var subcategories = JSON.parse(data);
                var subcategorySelect = $('#subcategoryselect');
                subcategorySelect.empty().append('<option disabled selected>Select a Sub-Category</option>');
                subcategories.forEach(function(subcategory) {
                    subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.description + '</option>');
                });
                console.log(categoryId);
            }
        });
    });
});
