$(document).ready(function () {
    // when page reload then count cart
    loadCart()
    // when page reload then count wishlist
    loadWishlist()
    //   event with increment button 
    $(document).on('click', '.increment-btn', function(e) {
        e.preventDefault();
        var incrementValue = $(this).closest('.product_data').find('.qty-input').val();
        // var incrementValue = $('.qty-input').val();
        var value = parseInt(incrementValue, 10);
        value = isNaN(value) ? '0' : value;
        if (value < 100) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    // event with decrement button
    $(document).on('click', '.decrement-btn', function(e) {
        e.preventDefault();
        var decrementValue = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(decrementValue, 10);
        value = isNaN(value) ? '0' : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    //   add event with cart button
    $('.addToCart').click(function (e) {
        e.preventDefault();
        var productId = $(this).closest('.product_data').find('.product_id').val();
        var productQty = $(this).closest('.product_data').find('.qty-input').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': productId,
                'product_qty': productQty
            },
            // cache: false,
            success: function (response) {
                swal(response.status);
                loadCart();
            }
        });
    });

    // Add to wishlist
    $('.addToWishlist').click(function(e) {
        e.preventDefault();
        var productId = $(this).closest('.product_data').find('.product_id').val();
        data = {
            'product_id': productId
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "post",
            url: "/add-to-wishlists",
            data: data,
            success: function (response) {
                swal(response.status);
                loadWishlist();
            }
        });
    });

    // increment price with incremet product quantity
    $(document).on('click', '.changeQty', function(e) {
        e.preventDefault();
        var productId  = $(this).closest('.product_data').find('.product_id').val();
        var productQty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'product_id': productId,
            'product_qty': productQty
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-cart",
            data: data,
            success: function (response) {
                // window.location.reload();
                $('.cartItems').load(location.href + " .cartItems");
                swal(response.status);
            }
        });
    });

    // update cart count
    function loadCart() {
        $.ajax({
            method: 'GET',
            url: '/load-cart-data',
            success: function(response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    // update wishlist count
    function loadWishlist() {
        $.ajax({
            method: 'GET',
            url: '/load-wishlist-data',
            success: function(response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
            }
        });
    }

       // event with delete button
    $(document).on('click', '.delete-cart-item', function(e) {
        e.preventDefault();
        var productId = $(this).closest('.product_data').find('.product_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'product_id': productId
            },
            // cache: false,
            success: function (response) {
                // window.location.reload();
                loadCart();
                $('.cartItems').load(location.href + " .cartItems");
                swal('', response.status, 'success');
            }
        });
    });
    // Delete wishlist
    $(document).on('click', '.delete-cart-wishlist', function(e) {
        e.preventDefault();
        var productId = $(this).closest('.product_data').find('.product_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "remove-wishlists",
            data: {
                'product_id': productId
            },
            // cache: false,
            success: function (response) {
                // window.location.reload();
                loadWishlist();
                $('.wishlistItems').load(location.href + " .wishlistItems");
                swal('', response.status, 'success');
            }
        });
    });
});