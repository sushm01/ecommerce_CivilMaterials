<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <style>
        .content-wrapper {
            background-color: white;
        }
        .table-container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Adjust gap as needed */
        }
        .table-card {
            flex: 1; /* Make sure each card takes equal space */
            margin: 10px; /* Optional margin around cards */
        }
        /* .card-gray {
            background-color: #f8f9fa;
        } */
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('')?>">Home</a></li>
                        <li class="breadcrumb-item active">Product List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Table 2: Product List -->
    <div class="table-card">
        <div class="card">
            <!-- <div class="card-header">
                <h3 class="card-title">Slider Information</h3>
            </div> -->
            <!-- /.card-header -->
            <form method="post" action="<?php echo base_url('welcome/insertProduct')?>" enctype="multipart/form-data">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL.No</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Size/Weight</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
       <tbody>
    <?php if (!empty($view_data)): ?>
        <?php 
        $serialNumber = 1;
        foreach ($view_data as $product): ?>
        <tr>
            <td><?php echo $serialNumber++; ?></td>
            <td><?php echo htmlspecialchars($product->brand_name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($product->size, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <?php
                $imagePath = base_url($product->product_image);
                ?>
                <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" style="width:100px; height:auto;" alt="Product Image"/>
            </td>
            <td><?php echo htmlspecialchars($product->product_quantity, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($product->product_price, ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($product->product_amount, ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a class="fa fa-trash" onclick="setDeleteFunction('<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>')" style="font-size: 25px; color: orange;"></a>
                <a class="fa fa-edit" onclick="setDataFunction(
                    '<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->ms_brand_id, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->ms_category_id, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->ms_size_id, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->product_image, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->product_quantity, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->product_price, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($product->product_amount, ENT_QUOTES, 'UTF-8'); ?>'
                )" style="font-size: 25px; color: gray;"></a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="10">No products found for your account.</td>
        </tr>
    <?php endif; ?>
</tbody>


                    </table>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.content-wrapper -->

      <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteProduct')?>">
                        <input type="hidden" name="dlt_p" id="dlt_p">
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-secondary">Yes Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Delete Modal -->

<!-- Update Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel">Edit Information Of Products</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('welcome/updateProduct') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- Select Brand -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="brandSelect">Select Brand</label>
                                <input type="hidden" name="id" id="id"> 
                                <select name="ms_brand_id" class="form-control" id="brandSelect">
    <?php foreach($get_brand as $b): ?>
        <?php 
        $selected = ($b->id == $b->ms_brand_id) ? 'selected="selected"' : ''; 
        ?>
        <option value="<?php echo htmlspecialchars($b->id); ?>" <?php echo $selected; ?>>
            <?php echo htmlspecialchars($b->brand_name); ?>
        </option>
    <?php endforeach; ?>
</select>
                            </div>
                        </div>

                        <!-- Select Category -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="categorySelect">Select Category</label>
                                <select name="ms_category_id" class="form-control" id="categorySelect">
    <?php foreach($get_category as $c): ?>
        <?php 
        $selected = ($c->id == $c->ms_category_id) ? 'selected="selected"' : ''; 
        ?>
        <option value="<?php echo htmlspecialchars($c->id); ?>" <?php echo $selected; ?>>
            <?php echo htmlspecialchars($c->category_name); ?>
        </option>
    <?php endforeach; ?>
</select>
                            </div>
                        </div>

                        <!-- Select Size/Weight -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sizeSelect">Select Size/Weight</label>
                                <select name="ms_size_id" class="form-control" id="sizeSelect">
    <?php foreach($get_size as $s): ?>
        <?php 
        $selected = ($s->id == $s->ms_size_id) ? 'selected="selected"' : ''; 
        ?>
        <option value="<?php echo htmlspecialchars($s->id); ?>" <?php echo $selected; ?>>
            <?php echo htmlspecialchars($s->size); ?>
        </option>
    <?php endforeach; ?>
</select>
                            </div>
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="productName" placeholder="Enter Name">
                            </div>
                        </div>

                        <!-- Product Image -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="productImage">Product Image</label>
                                <input type="file" name="product_image" class="form-control" id="productImage">
                                <img id="currentImage" src="" alt="Product Image" style="width: 100px; height: auto; display: none;">
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="productQuantity">Quantity</label>
                                <input type="text" name="product_quantity" class="form-control" id="productQuantity" placeholder="Enter Quantity">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="productPrice">Price</label>
                                <input type="text" name="product_price" class="form-control" id="productPrice" placeholder="Enter Price">
                            </div>
                        </div>

                        <!-- Total Amount -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="productAmount">Total Amount</label>
                                <input type="text" name="product_amount" class="form-control" id="productAmount" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Update Modal -->



<!-- JavaScript -->
<script>

 function setDataFunction(id, brandSelect, categorySelect, sizeSelect, productName, productImage, productQuantity, productPrice, productAmount) {
    // Set the value for the ID field
    $('#id').val(id);

    // Set the selected value for the brand dropdown
    $('#brandSelect').val(brandSelect).trigger('change');

    // Set the selected value for the category dropdown
    $('#categorySelect').val(categorySelect).trigger('change');

    // Set the selected value for the size dropdown
    $('#sizeSelect').val(sizeSelect).trigger('change');

    // Set the value for the product name input field
    $('#productName').val(productName);

    // Handle the product image input
    if (productImage) {
        $('#currentImage').attr('src', productImage).show(); // Show the current image if needed
    } else {
        $('#currentImage').hide(); // Hide the image if none
    }

    // Set the value for the product quantity input field
    $('#productQuantity').val(productQuantity);

    // Set the value for the product price input field
    $('#productPrice').val(productPrice);

    // Set the value for the total amount input field
    $('#productAmount').val(productAmount);

    // Show the modal
    $('#editModal').modal('show');
}
    // Calculate Total Amount
    $(document).ready(function() {
            function calculateTotalAmount() {
                const quantity = parseFloat($('#productQuantity').val()) || 0;
                const price = parseFloat($('#productPrice').val()) || 0;
                const totalAmount = quantity * price;
                $('#productAmount').val(totalAmount.toFixed(2));
            }

            // Event listener to recalculate totals on input changes
            $('#productQuantity, #productPrice').on('input', function() {
                calculateTotalAmount();
            });

            // Optionally set initial values if needed
            // Example:
            // const initialQuantity = 5;
            // const initialPrice = 10;
            // $('#productQuantity').val(initialQuantity);
            // $('#productPrice').val(initialPrice);
            // calculateTotalAmount();
        });

    // Function to set data for the delete modal
    function setDeleteFunction(dlt_p){
         //alert(dlt_p)
        $('#dlt_p').val(dlt_p); 
        $('#deleteModal').modal('show');
    }

</script>
