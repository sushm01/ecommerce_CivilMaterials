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
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL.No</th>
                            <th>Vendor Name</th>
                            <th>Mobile Number</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Size/Weight</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($all_data)): ?>
                        <?php 
                        $serialNumber = 1;
                        foreach ($all_data as $product): ?>
                        <tr>
                            <td><?php echo $serialNumber++; ?></td>
                            <td><?php echo htmlspecialchars($product->fname, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->mobile_no, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->brand_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->size, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->product_quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($product->product_price, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php
                                $imagePath = base_url($product->product_image);
                                ?>
                                <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>" style="width:100px; height:auto;" alt="Product Image"/>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">No products found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
