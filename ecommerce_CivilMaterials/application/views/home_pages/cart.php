 <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="asstes/img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Cart</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

   <!-- SHOPPING CART AREA START -->
<div class="liton__shoping-cart-area mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        <table class="table">
                         <!--    <thead>
                                <th class="cart-product-remove">Remove</th>
                                <th class="cart-product-image">Image</th>
                                <th class="cart-product-info">Product</th>
                                <th class="cart-product-price">Price</th>
                                <th class="cart-product-quantity">Quantity</th>
                                <th class="cart-product-subtotal">Subtotal</th>
                            </thead> -->
                             <tbody>
                                <?php if ($cart_items !== null && $cart_items->num_rows() > 0): ?>
                                    <?php foreach ($cart_items->result() as $items): 
                                        $user_id = $items->user_id;?>

                                        <tr data-product-id="<?php echo $items->id; ?>" data-registration-id="<?php echo $items->registration_id; ?>">

                                              <td id="item-<?php echo $items->id; ?>" class="cart-product-remove" data-id="<?php echo $items->id; ?>">x</td>
                                      <td style="display: none;"><?php echo $items->id; ?></td>
                                         <td style="display: none;"><?php echo $items->registration_id; ?></td>

                                            <td class="cart-product-image">
                                                <a href="<?php echo base_url('product_detail')?>"><img src="<?php echo base_url($items->product_image); ?>" alt="#"></a>
                                            </td>

                                            <td class="cart-product-info">
                                                <h4><a href="<?php echo base_url('product_detail')?>"><?php echo $items->product_name; ?></a></h4>
                                            </td>

                                            <td class="cart-product-price">₹<?php echo number_format($items->product_price, 2); ?></td>

                                            <td class="cart-product-quantity">
                                                <div class="cart">
                                                    <button class="quantity-plus">+</button>
                                                    <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box">
                                                    <button class="quantity-minus">-</button>
                                                </div>
                                            </td>

                                            <td class="cart-product-subtotal"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">No items in cart.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="shoping-cart-total mt-50">
                        <h4>Cart Totals</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Cart Subtotal</td>
                                     <td id="cart-subtotal">₹0.00</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                      <td id="shipping-cost">₹10.00</td>
                                </tr>
                                <tr>
                                    <td>Handling</td>
                                  <td id="handling-cost">₹5.00</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong id="order-total">₹0.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right text-end">
                            <a href="<?php echo base_url('checkout')?>" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SHOPPING CART AREA END -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Store user_id in session storage
    const userId = '12345'; // Replace with actual user ID logic
    sessionStorage.setItem('user_id', userId);

    function updateCartTotals() {
        let cartSubtotal = 0;
        const cartItems = [];

        // // Event listener for removing items
        // document.querySelectorAll('.remove-item').forEach(function(button) {
        //     button.addEventListener('click', function() {
        //         const row = this.closest('tr');
        //         row.remove(); // Remove the row from the DOM
        //         updateCartTotals(); // Update totals after removal
        //     });
        // });

        // Calculate subtotal for each cart item
        document.querySelectorAll('tr[data-product-id]').forEach(function(row) {
            const quantityInput = row.querySelector('.cart-plus-minus-box');
            const priceElement = row.querySelector('.cart-product-price');
            const subtotalElement = row.querySelector('.cart-product-subtotal');
            const productId = row.getAttribute('data-product-id');
            const registrationId = row.getAttribute('data-registration-id');

            if (quantityInput && priceElement && subtotalElement) {
                const quantity = parseInt(quantityInput.value, 10) || 1;
                const price = parseFloat(priceElement.textContent.replace('₹', '').replace(',', '')) || 0;
                const subtotal = quantity * price;

                // Update the subtotal for this row
                subtotalElement.textContent = `₹${subtotal.toFixed(2)}`;
                cartSubtotal += subtotal;

                // Collect cart items
                cartItems.push({
                    productId: productId,
                    registrationId: registrationId,
                    product: row.querySelector('.cart-product-info h4').textContent,
                    quantity: quantity,
                    amount: subtotal
                });
            }
        });

        // Update cart subtotal display
        document.getElementById('cart-subtotal').textContent = `₹${cartSubtotal.toFixed(2)}`;

        // Define shipping and handling costs
        const shippingCost = parseFloat(document.getElementById('shipping-cost').textContent.replace('₹', '').replace(',', '')) || 0;
        const handlingCost = parseFloat(document.getElementById('handling-cost').textContent.replace('₹', '').replace(',', '')) || 0;

        // Calculate order total
        const orderTotal = cartSubtotal + shippingCost + handlingCost;

        // Update order total display
        document.getElementById('order-total').textContent = `₹${orderTotal.toFixed(2)}`;

        // Save cart details to session storage
        sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
        sessionStorage.setItem('cartSubtotal', cartSubtotal.toFixed(2));
        sessionStorage.setItem('shippingCost', shippingCost.toFixed(2));
        sessionStorage.setItem('handlingCost', handlingCost.toFixed(2));
        sessionStorage.setItem('orderTotal', orderTotal.toFixed(2));
    }

    // Event listener for quantity changes
    document.querySelectorAll('.cart-plus-minus-box').forEach(function(input) {
        input.addEventListener('input', function() {
            const value = parseInt(this.value, 10);
            this.value = isNaN(value) || value < 1 ? 1 : value; // Reset to 1 if invalid
            updateCartTotals(); // Update totals when quantity changes
        });
    });

    // Event listeners for plus and minus buttons
    document.querySelectorAll('.quantity-plus').forEach(function(button) {
        button.addEventListener('click', function() {
            const quantityInput = this.closest('tr').querySelector('.cart-plus-minus-box');
            quantityInput.value = parseInt(quantityInput.value, 10) + 1; // Increment quantity
            updateCartTotals();
        });
    });

    document.querySelectorAll('.quantity-minus').forEach(function(button) {
        button.addEventListener('click', function() {
            const quantityInput = this.closest('tr').querySelector('.cart-plus-minus-box');
            const quantity = parseInt(quantityInput.value, 10);
            if (quantity > 1) {
                quantityInput.value = quantity - 1; // Decrement quantity
                updateCartTotals();
            }
        });
    });

    // Initial calculation on page load
    updateCartTotals();

    // Example of using session storage
    const storedUserId = sessionStorage.getItem('user_id');
    console.log('Current User ID:', storedUserId);
});

// document.addEventListener('DOMContentLoaded', function() {
//     function setDeleteFunction(id) {
//         fetch('<?php echo base_url('welcome/delete_cart'); ?>', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-Requested-With': 'XMLHttpRequest'
//             },
//             body: JSON.stringify({ id: id })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 document.querySelector(`#item-${id}`).closest('tr').remove();
//                 // Optionally refresh the cart or update totals
//             } else {
//                 alert('Error deleting item.');
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
//     }

//     document.querySelectorAll('.cart-product-remove').forEach(function(element) {
//         element.addEventListener('click', function() {
//             setDeleteFunction(this.getAttribute('data-id'));
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
    function setDeleteFunction(id) {
        console.log(`Attempting to delete item with ID: ${id}`); // Log the ID being deleted

        fetch('<?php echo base_url('welcome/delete_cart'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => {
            console.log('Response received:', response); // Log the raw response
            return response.json();
        })
        .then(data => {
            console.log('Data received from server:', data); // Log the response data

            if (data.success) {
                const itemElement = document.querySelector(`#item-${id}`).closest('tr');
                itemElement.remove();
                alert('Item deleted successfully!');
            } else {
                alert('Error deleting item: ' + (data.message || 'Unknown error.'));
            }
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors encountered
            alert('An unexpected error occurred. Please try again.');
        });
    }

    document.querySelectorAll('.cart-product-remove').forEach(function(element) {
        element.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            setDeleteFunction(id);
        });
    });
});

</script>

