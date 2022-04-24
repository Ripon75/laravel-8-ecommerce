$(document).ready(function () {
    $('.razorpay_btn').click(function(e) {
        e.preventDefault();

        var firstName   = $('.first_name').val();
        var lastName    = $('.last_name').val();
        var email       = $('.email').val();
        var phoneNumber = $('.phone_number').val();
        var address1    = $('.address_1').val();
        var city        = $('.city').val();
        var state       = $('.state').val();
        var country     = $('.country').val();
        var pinCode     = $('.pin_code').val();

        if (!firstName) {
            fnameError = 'First name is required';
            $('#fname_error').html('');
            $('#fname_error').html(fnameError);
        } else {
            fnameError = '';
            $('#fname_error').html(fnameError);
        }

        if (!lastName) {
            lnameError = 'Last name is required';
            $('#lname_error').html('');
            $('#lname_error').html(lnameError);
        } else {
            lnameError = '';
            $('#lname_error').html(lnameError);
        }

        if (!email) {
            emailError = 'Emial is required';
            $('#email').html('');
            $('#email').html(emailError);
        } else {
            emailError = '';
            $('#email').html(emailError);
        }

        if (!phoneNumber) {
            phoneError = 'Phone number is required';
            $('#phone_number').html('');
            $('#phone_number').html(phoneError);
        } else {
            phoneError = '';
            $('#phone_number').html(phoneError);
        }

        if (!address1) {
            address1Error = 'Address 1 is required';
            $('#address_1').html('');
            $('#address_1').html(address1Error);
        } else {
            address1Error = '';
            $('#address_1').html(address1Error);
        }

        if (!city) {
            cityError = 'City is required';
            $('#city').html('');
            $('#city').html(cityError);
        } else {
            cityError = '';
            $('#city').html(cityError);
        }

        if (!state) {
            stateError = 'State is required';
            $('#state').html('');
            $('#state').html(stateError);
        } else {
            stateError = '';
            $('#state').html(stateError);
        }

        if (!country) {
            countryError = 'Country is required';
            $('#country').html('');
            $('#country').html(countryError);
        } else {
            countryError = '';
            $('#country').html(countryError);
        }

        if (!pinCode) {
            pinCodeError = 'Pin code is required';
            $('#pin_code').html('');
            $('#pin_code').html(pinCodeError);
        } else {
            pinCodeError = '';
            $('#pin_code').html(pinCodeError);
        }

        if (fnameError != '' || lnameError != '' || phoneError != '' || address1Error != '' || cityError != '' || stateError != '' || pinCodeError != '') {

            return false;
        } else {
            data = {
                'first_name': firstName,
                'last_name': lastName,
                'email': email,
                'phone_number': phoneNumber,
                'address_1': address1,
                'city': city,
                'state': state,
                'country': country,
                'pin_code': pinCode
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/process-to-pay',
                data: data,
                success: function (response) {
                    var options = {
                        "key": "rzp_test_rYBaqpcFdLmtkw", // Enter the Key ID generated from the Dashboard
                        "amount": response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": response.first_name +' '+ response.last_name,
                        "description": "Think you for chosing us",
                        "image": "https://example.com/your_logo",
                        "handler": function (responsea){
                            // alert(responsea.razorpay_payment_id);
                            $.ajax({
                                method: 'POST',
                                url: '/place-order',
                                data: {
                                    'f_name': response.first_name,
                                    'l_name': response.last_name,
                                    'email': response.email,
                                    'phone_num': response.phone_num,
                                    'address_1': response.address_1,
                                    'address_2': response.address_2,
                                    'city': response.city,
                                    'state': response.state,
                                    'country': response.country,
                                    'pin_code': response.pin_code,
                                    'payment_mode': 'Paid by Razorpay',
                                    'payment_id': responsea.razorpay_payment_id
                                },
                                success: function(responseb) {
                                    // alert(responseb.status);
                                    swal(responseb.status)
                                    .then((value) => {
                                        window.location.href = "/my-orders";
                                    });
                                }
                            });
                        },
                        "prefill": {
                            "name": response.first_name +' '+ response.last_name,
                            "email": response.email,
                            "contact": response.phone_number
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            });
        }
    });
});
