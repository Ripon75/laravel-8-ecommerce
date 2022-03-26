$(document).ready(function () {
    //   event with increment button 
    $('.increment-btn').click(function (e) {
        e.preventDefault();
        var incrementValue = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(incrementValue, 10);
        value = isNaN(value) ? '0' : value;
        if (value < 100) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    // event with decrement button
    $('.decrement-btn').click(function (e) {
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
            }
        });
    });

    // increment price with incremet product quantity
    $('.changeQty').click(function(e) {
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
                window.location.reload();
                // swal(response.status);
            }
        });
    });

       // event with delete button
    // $('.delete-cart-item').click(function (e) {
    //     e.preventDefault();
    //     var productId = $(this).closest('.product_data').find('.product_id').val();
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         method: "POST",
    //         url: "delete-cart-item",
    //         data: {
    //             'product_id': productId
    //         },
    //         // cache: false,
    //         success: function (response) {
    //             window.location.reload();
    //             swal(response.status);
    //         }
    //     });
    // });
});