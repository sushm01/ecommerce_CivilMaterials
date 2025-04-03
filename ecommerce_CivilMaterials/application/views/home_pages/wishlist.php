  <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="asstes/img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Wishlist</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area mb-105">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <!-- <thead>
                                    <th class="cart-product-remove">X</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Title</th>
                                    <th class="cart-product-price">Price</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Subtotal</th>
                                </thead> -->
                                <tbody>
                                     <?php if ($wishlist_items !== null && $wishlist_items->num_rows() > 0): ?>
                                <?php foreach ($wishlist_items->result() as $d): ?>
                                    <tr>
                                       <td id="item-<?php echo $d->id; ?>" class="cart-product-remove" data-id="<?php echo $d->id; ?>">x</td>
                                        <td class="cart-product-image">
                                            <a href="<?php echo base_url('product_detail')?>"><img src="<?php echo base_url($d->product_image); ?>" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="<?php echo base_url('product_detail')?>"><?php echo $d->product_name; ?></a></h4>
                                        </td>
                                        <td class="cart-product-price">₹<?php echo number_format($d->product_price, 2); ?></td>
                                        <td class="cart-product-stock">In Stock</td>
                                        <td class="cart-product-add-cart">
                                            <a class="submit-button-1" href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">Add to Cart</a>
                                        </td>
                                    </tr>
                                       <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">No items in wishlist.</td>
                                    </tr>
                                <?php endif; ?>
                               
                                 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->

   
<script>
document.addEventListener('DOMContentLoaded', function() {
    function setDeleteFunction(id) {
        // Send AJAX request to delete item
        fetch('<?php echo base_url('welcome/delete_wishlist'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest' // Ensure the request is AJAX
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                //alert('Item deleted successfully!');
                // Optionally remove the item from the UI
                document.querySelector(`#item-${id}`).remove();
                location.reload();
            } else {
                alert('Error deleting item.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Attach the click event listener to the delete elements
    document.querySelectorAll('.cart-product-remove').forEach(function(element) {
        element.addEventListener('click', function() {
            setDeleteFunction(this.getAttribute('data-id'));
        });
    });
});
</script>