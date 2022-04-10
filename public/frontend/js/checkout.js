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
            $('#fname_error').html('');
        }

        if (!lastName) {
            lnameError = 'Last name is required';
            $('#lname_error').html('');
            $('#lname_error').html(lnameError);
        } else {
            lnameError = '';
            $('#lname_error').html('');
        }

        if (!email) {
            emailError = 'Emial is required';
            $('#email').html('');
            $('#email').html(emailError);
        } else {
            emailError = '';
            $('#email').html('');
        }

        if (!phoneNumber) {
            phoneError = 'Phone number is required';
            $('#phone_number').html('');
            $('#phone_number').html(phoneError);
        } else {
            phoneError = '';
            $('#phone_number').html('');
        }

        if (!address1) {
            address1Error = 'Address 1 is required';
            $('#address_1').html('');
            $('#address_1').html(address1Error);
        } else {
            address1Error = '';
            $('#address_1').html('');
        }

        if (!city) {
            cityError = 'City is required';
            $('#city').html('');
            $('#city').html(cityError);
        } else {
            cityError = '';
            $('#city').html('');
        }

        if (!state) {
            stateError = 'State is required';
            $('#state').html('');
            $('#state').html(stateError);
        } else {
            stateError = '';
            $('#state').html('');
        }

        if (!country) {
            countryError = 'Country is required';
            $('#country').html('');
            $('#country').html(countryError);
        } else {
            countryError = '';
            $('#country').html('');
        }

        if (!pinCode) {
            pinCodeError = 'Pin code is required';
            $('#pin_code').html('');
            $('#pin_code').html(pinCodeError);
        } else {
            pinCodeError = '';
            $('#pin_code').html('');
        }

        if (fnameError != '' || lnameError != '' || phoneError != '' || address1Error != '' || cityError != ''
           || stateError != '' || pinCodeError != '') {

            return false;
        } else {
            alert('Razorpay');
        }

    });
});