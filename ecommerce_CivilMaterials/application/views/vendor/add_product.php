<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <style>
        .table td, .table th {
            vertical-align: middle;
        }
        .form-control {
            width: 100%;
        }
        .btn-group {
            display: flex;
        }
        .btn-group .btn {
            flex: 1;
        }
        .btn-group .btn:not(:last-child) {
            margin-right: 5px;
        }
    </style>

    <!-- Content Header 1 (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Sales</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Table Section -->
   <div class="table-card">
    <div class="card">
        <div class="card-header">
            <h3 class="btn btn-warning">Product Details</h3>
        </div>
        <!-- /.card-header -->
         <form method="post" action="<?php echo base_url('welcome/insertProduct')?>" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group inline-block">
                          <?= form_open('welcome/submit'); ?>
                        <table id="productTable" class="table table-bordered">
            <thead>
                <tr>
                    <th><button class="btn btn-warning">+</button></th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Size/Weight</th>
                    <th>Product</th>
                    <th>Upload Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Amount</th>
                </tr>
                </thead>
                <tbody id="productContainer">
        <tr>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning addRow">+</button>
                    <button type="button" class="btn btn-secondary removeRow">-</button>
                </div>
            </td>
            <td>
                <select name="ms_brand_id[]" class="form-control">
                    <option value="">Select Brand</option>
                    <?php foreach ($get_brand as $b): ?>
                        <option value="<?php echo $b->id; ?>"><?php echo $b->brand_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="ms_category_id[]" class="categorySelect form-control">
                    <option value="">Select Category</option>
                    <?php foreach ($get_category as $c): ?>
                        <option value="<?php echo $c->id; ?>"><?php echo $c->category_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select name="ms_size_id[]" class="sizeSelect form-control">
                    <option value="">Select Size</option>
                    <?php foreach ($get_size as $s): ?>
                        <option value="<?php echo $s->id; ?>"><?php echo $s->size; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="text" name="product_name[]" class="form-control" placeholder="Enter Product"></td>
            <td><input type="file" name="product_image[]" class="form-control"></td>
            <td><input type="text" name="product_quantity[]" class="form-control" placeholder="Enter Quantity"></td>
            <td><input type="text" name="product_price[]" class="form-control" placeholder="Enter Price"></td>
            <td><input type="text" name="product_amount[]" class="form-control" placeholder="Enter Total Amount" readonly></td>
            <input type="hidden" name="registration_id" value="<?php echo $this->session->userdata('user_id')?>"></input>
        </tr>
    </tbody>
    </table>
     <button type="submit" class="btn btn-warning">Submit</button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {
        // Add new row
        $(document).on('click', '.addRow', function() {
            const newRow = $('<tr>');
            newRow.append('<td><button type="button" class="btn btn-warning addRow">+</button> <button type="button" class="btn btn-secondary removeRow">-</button></td>');

            newRow.append('<td><select name="ms_brand_id[]" class="form-control"><option value="">Select Brand</option><?php foreach ($get_brand as $b): ?><option value="<?php echo $b->id; ?>"><?php echo $b->brand_name; ?></option><?php endforeach; ?></td>');

            newRow.append('<td><select name="ms_category_id[]" class="categorySelect form-control"><option value="">Select Category</option><?php foreach ($get_category as $c): ?><option value="<?php echo $c->id; ?>"><?php echo $c->category_name; ?></option><?php endforeach; ?></select></td>');

            newRow.append('<td><select name="ms_size_id[]" class="sizeSelect form-control"><option value="">Select Size</option><?php foreach ($get_size as $s): ?><option value="<?php echo $s->id; ?>"><?php echo $s->size; ?></option><?php endforeach; ?></select></td>');

            newRow.append('<td><input type="text" name="product_name[]" class="form-control" placeholder="Enter Product"></td>');

            newRow.append('<td><input type="file" name="product_image[]" class="form-control" placeholder="Upload"></td>');

            newRow.append('<td><input type="text" name="product_quantity[]" class="form-control" placeholder="Enter Quantity"></td>');

            newRow.append('<td><input type="text" name="product_price[]" class="form-control" placeholder="Enter Price"></td>');

            newRow.append('<td><input type="text" name="product_amount[]" class="form-control" placeholder="Enter Total Amount" readonly></td>');

            $('#productContainer').append(newRow);
        });

        // Remove a row
        $(document).on('click', '.removeRow', function() {
            if ($('#productContainer tr').length > 1) {
                $(this).closest('tr').remove();
            }
        });

        // Calculate Total Amount
        $(document).on('input', 'input[name="product_quantity[]"], input[name="product_price[]"]', function() {
            const $row = $(this).closest('tr');
            const quantity = parseFloat($row.find('input[name="product_quantity[]"]').val()) || 0;
            const price = parseFloat($row.find('input[name="product_price[]"]').val()) || 0;
            const totalAmount = quantity * price;
            $row.find('input[name="product_amount[]"]').val(totalAmount.toFixed(2));
        });
    });

    //calclate size based on category
   $(document).ready(function() {
    // Event delegation for dynamically added rows
    $(document).on('change', '.categorySelect', function() {
        var $row = $(this).closest('tr'); // Get the closest row
        var categoryId = $(this).val(); // Get the selected category ID
        
        var $sizeSelect = $row.find('.sizeSelect'); // Find the size select in the same row

        if (categoryId) {
            // Make an AJAX request to get the sizes for the selected category
            $.ajax({
                url: 'welcome/getSizesByCategory', // Replace with the path to your controller method
                type: 'POST',
                data: { category_id: categoryId },
                dataType: 'json',
                success: function(response) {
                    $sizeSelect.empty(); // Clear the existing options
                    $sizeSelect.append('<option value="">Select Size</option>'); // Add default option

                    // Add new options based on the response
                    $.each(response, function(index, size) {
                        $sizeSelect.append('<option value="' + size.id + '">' + size.size + '</option>');
                    });
                },
                error: function() {
                    alert('An error occurred while fetching sizes.');
                }
            });
        } 
    });
});

</script>
