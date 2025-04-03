<!-- <?php
$totalProducts = count($get_product); // Total number of products
$productsPerPage = 9; // Assuming you want to show 9 products per page
$currentPage = 1; // You might want to set this dynamically based on your pagination

// Calculate the starting and ending product indices
$startingProduct = ($currentPage - 1) * $productsPerPage + 1;
$endingProduct = min($startingProduct + $productsPerPage - 1, $totalProducts);
?> -->
 <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Shop</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
    
    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-100">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                               <!-- <div class="short-by text-center">
                                    <select class="nice-select">
                                        <option>Default sorting</option>
                                        <option>Sort by popularity</option>
                                        <option>Sort by new arrivals</option>
                                        <option>Sort by price: low to high</option>
                                        <option>Sort by price: high to low</option>
                                    </select>
                                </div> --> 
                            </li>
                            <li>
                              <div class="showing-product-number text-right text-end">
    <span>Showing <?php echo $startingProduct; ?> to <?php echo $endingProduct; ?> of <?php echo $totalProducts; ?> results</span>
</div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
                                    <!-- ltn__product-item -->
                                      <?php foreach ($get_product as $product): ?>
                                    <div class="col-xl-4 col-sm-6 col-6">
                                        <div class="ltn__product-item ltn__product-item-3 text-center">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="<?php echo base_url($product->product_image); ?>" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                    <li>
    <a href="#" title="Quick View" class="quick-view-button"
       data-product-id="<?php echo $product->id; ?>"
       data-product-image="<?php echo base_url($product->product_image); ?>"
       data-product-title="<?php echo $product->product_name; ?>"
       data-product-price="<?php echo $product->product_price; ?>"
       data-product-categories="<a href='#'>Parts</a>, <a href='#'>Car</a>, <a href='#'>Seat</a>, <a href='#'>Cover</a>"
       data-bs-toggle="modal" data-bs-target="#quick_view_modal">
        <i class="far fa-eye"></i>
    </a>
</li>

                                                        <li>
                    <a href="#" title="Add to Cart" class="add-to-cart-button"
                       data-product-id="<?php echo $product->id; ?>"
                       data-product-image="<?php echo base_url($product->product_image); ?>"
                       data-product-title="<?php echo $product->product_name; ?>"
                       data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <li>
                    <a href="#" title="Wishlist" class="wishlist-button"
                       data-product-id="<?php echo $product->id; ?>"
                       data-product-image="<?php echo base_url($product->product_image); ?>"
                       data-product-title="<?php echo $product->product_name; ?>"
                       data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                        <i class="far fa-heart"></i></a>
                </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                 <h2 class="product-title"><a href="product-details.html"><?php echo $product->product_name; ?></a></h2>
                                                  <div class="product-price">
                                                 <span>₹<?php echo $product->product_price; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                         <!-- ltn__product-item -->

                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row">
                                    <!-- ltn__product-item -->
                                    <?php foreach ($get_product as $product): ?>
                                    <div class="col-lg-12">
                                        <div class="ltn__product-item ltn__product-item-3">
                                            <div class="product-img">
                                                <a href="product-details.html"><img src="<?php echo base_url($product->product_image); ?>" alt="#"></a>
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                               <h2 class="product-title"><a href="product-details.html"><?php echo $product->product_name; ?></a></h2>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                 <span>₹<?php echo $product->product_price; ?></span>

                                                </div>
                                                <div class="product-brief">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae asperiores sit odit nesciunt,  aliquid, deleniti non et ut dolorem!</p>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                         <li>
    <a href="#" title="Quick View" class="quick-view-button"
       data-product-id="<?php echo $product->id; ?>"
       data-product-image="<?php echo base_url($product->product_image); ?>"
       data-product-title="<?php echo $product->product_name; ?>"
       data-product-price="<?php echo $product->product_price; ?>"
       data-product-categories="<a href='#'>Parts</a>, <a href='#'>Car</a>, <a href='#'>Seat</a>, <a href='#'>Cover</a>"
       data-bs-toggle="modal" data-bs-target="#quick_view_modal">
        <i class="far fa-eye"></i>
    </a>
</li> 
<li>
                    <a href="#" title="Add to Cart" class="add-to-cart-button"
                       data-product-id="<?php echo $product->id; ?>"
                       data-product-image="<?php echo base_url($product->product_image); ?>"
                       data-product-title="<?php echo $product->product_name; ?>"
                       data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
      <li>
                    <a href="#" title="Wishlist" class="wishlist-button"
                       data-product-id="<?php echo $product->id; ?>"
                       data-product-image="<?php echo base_url($product->product_image); ?>"
                       data-product-title="<?php echo $product->product_name; ?>"
                       data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                        <i class="far fa-heart"></i></a>
                </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- ltn__product-item -->

                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            <ul>
                                <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mb-100">
                    <aside class="sidebar ltn__shop-sidebar">
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                            <ul>
                                <li><a href="#">Cements <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Steels <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Bricks <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Binding wires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            </ul>
                        </div>
                    
                            <div class="widget ltn__top-rated-product-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                                <ul>
                                    <?php foreach ($get_product as $product): ?>
                                        <li>
                                            <div class="top-rated-product-item clearfix">
                                                <div class="top-rated-product-img">
                                                    <a href="product-details.html"><img src="<?php echo base_url($product->product_image); ?>" alt="#"></a>
                                                </div>
                                                <div class="top-rated-product-info">
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                    <h6 class="product-title"><a href="product-details.html"><?php echo $product->product_name; ?></a></h6>
                                                    <div class="product-price">
                                                        <span>₹<?php echo $product->product_price; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->

<!-- MODAL AREA START (Quick View Modal) -->
<div class="ltn__modal-area ltn__quick-view-modal-area">
    <div class="modal fade" id="quick_view_modal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                       
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ltn__quick-view-modal-inner">
                        <div class="modal-product-item">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="modal-product-img">
                                        <!-- Placeholder for product image -->
                                        <img id="quick-view-product-image" src="" alt="#">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="modal-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                            </ul>
                                        </div>
                                        <h3 class="product-title"><a id="quick-view-product-title" href="product-details.html"></a></h3>
                                        <div class="product-price">
                                            <span id="quick-view-product-price"></span>
                                        </div>
                                        <div class="modal-product-meta ltn__product-details-menu-1">
                                            <ul>
                                                <li>
                                                    <strong>Categories:</strong>
                                                    <span id="quick-view-product-categories"></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-2">
                                            <ul>
                                                <li>
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                    </div>
                                                </li>
                                                <li>
                                                    <a href="#" title="Add to Cart" class="add-to-cart-button"
                       data-product-id="<?php echo $product->id; ?>"
                       data-product-image="<?php echo base_url($product->product_image); ?>"
                       data-product-title="<?php echo $product->product_name; ?>"
                       data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                        <i class="fas fa-shopping-cart"></i>
                          <span>Add to Cart</span>
                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-3">
                                            <ul>
                                                <li>
                                                   <a href="#" title="Wishlist" class="wishlist-button"
                       data-product-id="<?php echo $product->id; ?>"
                       data-product-image="<?php echo base_url($product->product_image); ?>"
                       data-product-title="<?php echo $product->product_name; ?>"
                       data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                        <i class="far fa-heart"></i>
                           <span>Add to Wishlist</span>
                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="" title="Compare">
                                                        <i class="fas fa-exchange-alt"></i>
                                                        <span>Compare</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        <div class="ltn__social-media">
                                            <ul>
                                                <li>Share:</li>
                                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AREA END -->


   <!-- MODAL AREA START (Add To Cart Modal) -->
<div class="ltn__modal-area ltn__add-to-cart-modal-area">
    <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ltn__quick-view-modal-inner">
                        <div class="modal-product-item">
                            <div class="row">
                                <div class="col-12">
                                    <div class="modal-product-img">
                                        <!-- Placeholder for product image -->
                                        <img id="modal-product-image" src="" alt="#">
                                    </div>
                                    <div class="modal-product-info">
                                        <h5 class="product-title"><a id="modal-product-title" href="product-details.html"></a></h5>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully added to your Cart</p>
                                        <div class="btn-wrapper">
                                            <a href="<?php echo base_url('cart')?>" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                                            <a href="<?php echo base_url('checkout')?>" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                        </div>
                                    </div>
                                    <!-- additional-info -->
                                    <div class="additional-info d-none">
                                        <p>We want to give you <b>10% discount</b> for your first order, <br> Use discount code at checkout</p>
                                        <div class="payment-method">
                                            <img src="asstes/img/icons/payment.png" alt="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AREA END -->

<!-- MODAL AREA START (Wishlist Modal) -->
<!-- Similar structure to Add To Cart Modal -->
<div class="ltn__modal-area ltn__add-to-cart-modal-area">
    <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ltn__quick-view-modal-inner">
                        <div class="modal-product-item">
                            <div class="row">
                                <div class="col-12">
                                    <div class="modal-product-img">
                                        <!-- Placeholder for product image -->
                                        <img id="wishlist-modal-product-image" src="" alt="#">
                                    </div>
                                    <div class="modal-product-info">
                                        <h5 class="product-title"><a id="wishlist-modal-product-title" href="product-details.html"></a></h5>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully added to your Wishlist</p>
                                        <div class="btn-wrapper">
                                            <a href="<?php echo base_url('wishlist')?>" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                        </div>
                                    </div>
                                    <!-- additional-info -->
                                    <div class="additional-info d-none">
                                        <p>We want to give you <b>10% discount</b> for your first order, <br> Use discount code at checkout</p>
                                        <div class="payment-method">
                                            <img src="asstes/img/icons/payment.png" alt="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AREA END -->

<script>

    // pop up model View Cart Wishlist //
  $(document).ready(function() {
    // Handle Add to Cart Button Click
    $('.add-to-cart-button').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var productImage = $(this).data('product-image');
        var productTitle = $(this).data('product-title');

        // Update Add to Cart modal content
        $('#modal-product-image').attr('src', productImage);
        $('#modal-product-title').text(productTitle).attr('href', 'product-details.html?id=' + productId);

        // Show the Add to Cart modal
        $('#add_to_cart_modal').modal('show');
    });

    // Handle Wishlist Button Click
    $('.wishlist-button').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var productImage = $(this).data('product-image');
        var productTitle = $(this).data('product-title');

        // Update Wishlist modal content
        $('#wishlist-modal-product-image').attr('src', productImage);
        $('#wishlist-modal-product-title').text(productTitle).attr('href', 'product-details.html?id=' + productId);

        // Show the Wishlist modal
        $('#liton_wishlist_modal').modal('show');
    });

    // Handle Quick View Button Click
    $('.quick-view-button').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var productImage = $(this).data('product-image');
        var productTitle = $(this).data('product-title');
        var productPrice = $(this).data('product-price');
        var productCategories = $(this).data('product-categories');

        // Update Quick View modal content
        $('#quick-view-product-image').attr('src', productImage);
        $('#quick-view-product-title').text(productTitle).attr('href', 'product-details.html?id=' + productId);
        $('#quick-view-product-price').text('₹' + productPrice);
        $('#quick-view-product-categories').html(productCategories); // Assuming productCategories is an HTML string

        // Show the Quick View modal
        $('#quick_view_modal').modal('show');
    });
});

 // pop up model operation based on user sign in  //
$(document).ready(function() {
    // Assuming `isLoggedIn` is a variable indicating if the user is logged in
    var isLoggedIn = <?php echo $this->session->userdata('user_id') ? 'true' : 'false'; ?>;

    // Event handler for cart button
    $('.add-to-cart-button').on('click', function(e) {
        e.preventDefault(); // Prevent the default action
        if (!isLoggedIn) {
            window.location.href = 'signIn'; // Redirect to sign-in page
        } else {
            $('#add_to_cart_modal').modal('show'); // Show add to cart modal
        }
    });

    // Event handler for wishlist button
    $('.wishlist-button').on('click', function(e) {  
        e.preventDefault(); // Prevent the default action
        if (!isLoggedIn) {
            window.location.href = 'signIn'; // Redirect to sign-in page
        } else {
            $('#liton_wishlist_modal').modal('show'); // Show wishlist modal
        }
    });
});

// add to cart and add to wishlist operation //
document.addEventListener('DOMContentLoaded', function() {
    // Function to handle AJAX requests for adding to wishlist or cart
    function handleButtonClick(event, url, successMessage, errorMessage) {
        event.preventDefault(); // Prevent default anchor behavior

        var button = event.currentTarget; // Get the button that was clicked
        var productId = button.getAttribute('data-product-id'); // Get the product ID from the data attribute

        // Get the logged-in user ID from a JavaScript variable or another source
        var loggedInUserId = <?php echo json_encode($this->session->userdata('user_id')); ?>;

        // Send AJAX request
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest' // Ensure the request is AJAX
            },
            body: JSON.stringify({
                product_id: productId,
                user_id: loggedInUserId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(successMessage);
            } else {
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Attach click event listeners to wishlist buttons
    document.querySelectorAll('.wishlist-button').forEach(function(button) {
        button.addEventListener('click', function(event) {
            handleButtonClick(event, '<?php echo base_url('welcome/insertWishlist'); ?>', 'Product added to wishlist!', 'Error adding product to wishlist.');
        });
    });

    // Attach click event listeners to add-to-cart buttons
    document.querySelectorAll('.add-to-cart-button').forEach(function(button) {
        button.addEventListener('click', function(event) {
            handleButtonClick(event, '<?php echo base_url('welcome/insertCart'); ?>', 'Product added to cart!', 'Error adding product to cart.');
        });
    });
});

</script>
