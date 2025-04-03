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

if ($getUserOrder !== null && $getUserOrder->num_rows() > 0) {
    foreach ($getUserOrder->result() as $r) {
        if ($r->status == 'confirmed') {
            $cartDetailId = $r->id;

            // Initialize the cart_detail_id if not set
            if (!isset($groupedOrders[$cartDetailId])) {
                $groupedOrders[$cartDetailId] = [
                    'fi_name' => $r->fi_name,
                    'ls_name' => $r->ls_name,
                    'email_add' => $r->email_add,
                    'phone_no' => $r->phone_no,
                    'address' => $r->address_house . ', ' . $r->town . ', ' . $r->state . ', ' . $r->pincode,
                    'curr_date' => (new DateTime($r->curr_date))->format('d-m-Y'),
                    'curr_time' => $r->curr_time,
                    'note' => $r->note,
                    'products' => [],
                    'cart_subtotal' => $r->cart_subtotal,
                    'shipping' => $r->shipping,
                    'handling' => $r->handling,
                    'order_total' => $r->order_total,
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
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Date & Time</th>
                    <th>Note</th>
                    <th>Product</th>
                   <!--  <th>Quantity</th>
                    <th>Amount</th> -->
                    <th>Sub Total</th>
                    <!-- <th>Shipping</th>
                    <th>Handling</th> -->
                    <th>Order Total</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($groupedOrders)): ?>
        <?php $i = 1; ?>
        <?php foreach ($groupedOrders as $cartDetailId => $order): ?>
            <tr data-id="<?php echo $cartDetailId; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $order['fi_name'] . ' ' . $order['ls_name']; ?></td>
                <td><?php echo $order['email_add']; ?></td>
                <td><?php echo $order['phone_no']; ?></td>
                <td><?php echo $order['address']; ?></td>
                <td><?php echo $order['curr_date']; ?> & <?php echo $order['curr_time']; ?></td>
                <td><?php echo $order['note']; ?></td>
                
                <td>
                    <?php
                    $items = [];
                    foreach ($order['products'] as $product) {
                        $items[] = $product['name'] . ' (Qty: ' . $product['quantity'] . ', Amount: ' . $product['amount'] . ')';
                    }
                    echo implode('<hr class="small-hr">', $items);
                    ?>
                </td>
                
                <td>
                    <?php echo $order['cart_subtotal']; ?><br>
                    Shipping: <?php echo $order['shipping']; ?><br>
                    Handling: <?php echo $order['handling']; ?>
                </td>
                <td><?php echo $order['order_total']; ?></td>
               <!--  <td>
                    <a href="#" class="btn btn-success confirm-link" onclick="handleConfirmClick(<?php echo $cartDetailId; ?>); return false;">Confirm</a>
                </td> -->
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="13">No items found</td>
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