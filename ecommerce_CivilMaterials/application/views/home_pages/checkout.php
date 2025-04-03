    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="<?php echo base_url()?>uploads/images.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Checkout</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="<?php echo base_url()?>"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- CHECKOUT AREA START -->
    <div class="ltn__checkout-area mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__checkout-inner">
                        <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                            <h5>Returning customer? <a class="ltn__secondary-color" href="#ltn__returning-customer-login" data-bs-toggle="collapse">Click here to login</a></h5>
                            <div id="ltn__returning-customer-login" class="collapse ltn__checkout-single-content-info">
                                <div class="ltn_coupon-code-form ltn__form-box">
                                    <p>Please login your accont.</p>
                                    <form action="#" >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="ltn__name" placeholder="Enter your name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input type="email" name="ltn__email" placeholder="Enter email address">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase">Login</button>
                                        <label class="input-info-save mb-0"><input type="checkbox" name="agree"> Remember me</label>
                                        <p class="mt-30"><a href="register.html">Lost your password?</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                       
                        <div class="ltn__checkout-single-content mt-50">
                            <h4 class="title-2">Billing Details</h4>
                            <div class="ltn__checkout-single-content-info">
                                <form method="post" action="welcome/insert_cart_detail" id="add">
                                    <h6>Personal Information</h6>
                                    <div class="row">
                                        <!-- <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>"> -->
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="fi_name" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="ls_name" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" name="email_add" placeholder="email address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-phone ltn__custom-icon">
                                                <input type="text" name="phone_no" placeholder="phone number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <h6>Address</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-item">
                                                        <input type="text" name="address_house" placeholder="House number and street name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-item">
                                                        <input type="text" name="address_appartment" placeholder="Apartment, suite, unit etc. (optional)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h6>Town / City</h6>
                                            <div class="input-item">
                                                <input type="text" name="town" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h6>State </h6>
                                            <div class="input-item">
                                                <input type="text" name="state" placeholder="State">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <h6>Pincode</h6>
                                            <div class="input-item">
                                                <input type="text" name="pincode" placeholder="Pincode">
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Order Notes (optional)</h6>
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <textarea name="note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ltn__checkout-payment-method mt-50">
                        <h4 class="title-2">Payment Method</h4>
                        <div id="checkout_accordion_1">
                            <div class="card">
                                <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2" aria-expanded="true"> 
                                Cash on delivery 
                                <input type="hidden" name="payment_method" value="Cash on delivery">
                            </h5>
                                <div id="faq-item-2-2" class="collapse show" data-parent="#checkout_accordion_1">
                                    <div class="card-body">
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                        <div class="ltn__payment-note mt-30 mb-30">
                            <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                        </div>
                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit" id="test-button">Place order</button>
                    </div>
                </div>
               <div class="col-lg-6">
    <div class="shoping-cart-total mt-50">
        <h4 class="title-2">Cart Totals</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="cart-items-container">
                <!-- Cart items will be dynamically inserted here -->
            </tbody>
            <tbody class="checkout-summary">
                <tr>
                    <td>Cart Subtotal</td>
                    <td id="checkout-cart-subtotal">₹0.00</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td id="checkout-shipping-cost">₹0.00</td>
                </tr>
                <tr>
                    <td>Handling</td>
                    <td id="checkout-handling-cost">₹0.00</td>
                </tr>
                <tr>
                    <td><strong>Order Total</strong></td>
                    <td id="checkout-order-total"><strong>₹0.00</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- CHECKOUT AREA START -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
    const cartSubtotal = sessionStorage.getItem('cartSubtotal') || '0.00';
    const shippingCost = sessionStorage.getItem('shippingCost') || '0.00';
    const handlingCost = sessionStorage.getItem('handlingCost') || '0.00';
    const orderTotal = sessionStorage.getItem('orderTotal') || '0.00';

    console.log('Cart Items:', cartItems);
    console.log('Cart Subtotal:', cartSubtotal);
    console.log('Shipping Cost:', shippingCost);
    console.log('Handling Cost:', handlingCost);
    console.log('Order Total:', orderTotal);

    // Populate cart items
    const cartItemsContainer = document.getElementById('cart-items-container');
    cartItemsContainer.innerHTML = '';
    cartItems.forEach(item => {
        const row = document.createElement('tr');
        row.innerHTML = `
           <td>${item.product} x ${item.quantity}</td>
        <td style="display: none;">${item.productId}</td>
        <td style="display: none;">${item.registrationId}</td>
        <td>₹${item.amount.toFixed(2)}</td>
        `;
        console.log(item.productId)
        cartItemsContainer.appendChild(row);
    }); 

    // Display totals
    document.getElementById('checkout-cart-subtotal').textContent = `₹${cartSubtotal}`;
    document.getElementById('checkout-shipping-cost').textContent = `₹${shippingCost}`;
    document.getElementById('checkout-handling-cost').textContent = `₹${handlingCost}`;
    document.getElementById('checkout-order-total').textContent = `₹${orderTotal}`;

    // Handle form submission
    document.getElementById('test-button').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form from submitting traditionally

    // Gather form data
    // Gather form data
    const orderData = {
    user_id: sessionStorage.getItem('userId') || null, // Ensure userId is retrieved from sessionStorage or set to null if not available
    fi_name: document.querySelector('input[name="fi_name"]').value,
    ls_name: document.querySelector('input[name="ls_name"]').value,
    email_add: document.querySelector('input[name="email_add"]').value,
    phone_no: document.querySelector('input[name="phone_no"]').value,
    address_house: document.querySelector('input[name="address_house"]').value,
    address_appartment: document.querySelector('input[name="address_appartment"]').value,
    town: document.querySelector('input[name="town"]').value,
    state: document.querySelector('input[name="state"]').value,
    pincode: document.querySelector('input[name="pincode"]').value,
    note: document.querySelector('textarea[name="note"]').value,
    cart_subtotal: document.getElementById('checkout-cart-subtotal').textContent.replace('₹', ''),
    shipping_cost: document.getElementById('checkout-shipping-cost').textContent.replace('₹', ''),
    handling_cost: document.getElementById('checkout-handling-cost').textContent.replace('₹', ''),
    order_total: document.getElementById('checkout-order-total').textContent.replace('₹', '')
};

    // Get cart items from sessionStorage
    const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

    // Create payload
    const payload = {
        order: orderData,
        cartItems: cartItems
    };

    // Send data to the server
    fetch('welcome/insert_cart_detail', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    },
    body: JSON.stringify(payload)
})
.then(response => response.text()) // Get response as text
.then(text => {
    console.log('Response Text:', text); // Log response for debugging
    try {
        const data = JSON.parse(text); // Parse text to JSON
        if (data.success) {
            alert('Order placed successfully');
           // window.location.href = 'confirmation_page_url'; // Replace with your confirmation page URL
            location.reload();
        } else {
            alert(data.error || 'An error occurred');
        }
    } catch (e) {
        console.error('Error parsing JSON:', e);
        alert('Error parsing response');
    }
})
.catch(error => console.error('Error:', error));

    });
});
</script>
