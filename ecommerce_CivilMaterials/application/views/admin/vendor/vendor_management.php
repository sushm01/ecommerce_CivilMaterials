<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <style>
   .breadcrumb-item {
      display: flex;
      align-items: center;
    }

  .custom-btn {
    height: 30px; /* Adjust button height as needed */
    display: inline-flex;
    align-items: center;
    padding: 0 12px; /* Adjust padding for button */
  }
    </style>
    <!-- Content Header (Page header) -->
   
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Order List</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Home</a></li>
          <li class="breadcrumb-item active">Users Order List</li>
          </li>
        </ol>
      </div>
    </div>
  </div>
</section>

<?php
// Grouping the orders by cart_detail_id
$groupedOrders = [];

if ($getVendorProduct !== null && $getVendorProduct->num_rows() > 0) {
    foreach ($getVendorProduct->result() as $r) {
        $cartDetailId = $r->cart_detail_id; // Assuming this is the correct field for cart_detail_id

        // Initialize the cart_detail_id if not set
        if (!isset($groupedOrders[$cartDetailId])) {
            $groupedOrders[$cartDetailId] = [
                'fname' => $r->fname,
                'email' => $r->email,
                'mobile_no' => $r->mobile_no,
                'address' => $r->address,
                'curr_date' => (new DateTime($r->curr_date))->format('d-m-Y'),
                'curr_time' => $r->curr_time,
                'products' => [],
            ];
        }

        // Append product, quantity, and amount
        $products = explode(',', $r->product);
        $quantities = explode(',', $r->quantity);
        $amounts = explode(',', $r->amount);

        for ($j = 0; $j < count($products); $j++) {
            $groupedOrders[$cartDetailId]['products'][] = [
                'name' => $products[$j],
                'quantity' => $quantities[$j],
                'amount' => $amounts[$j],
            ];
        }
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Vendor Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Address</th>
                                    <th>Date & Time</th>
                                    <th>Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($groupedOrders)): ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($groupedOrders as $cartDetailId => $order): ?>
                                        <tr data-id="<?php echo $cartDetailId; ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $order['fname']; ?></td>
                                            <td><?php echo $order['email']; ?></td>
                                            <td><?php echo $order['mobile_no']; ?></td>
                                            <td><?php echo $order['address']; ?></td>
                                            <td><?php echo $order['curr_date']; ?> & <?php echo $order['curr_time']; ?></td>
                                            <td>
                                                <?php
                                                $items = [];
                                                foreach ($order['products'] as $product) {
                                                    $items[] = $product['name'] . ' (Qty: ' . $product['quantity'] . ', Amount: ' . $product['amount'] . ')';
                                                }
                                                echo implode('<hr class="small-hr">', $items);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">No items found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>