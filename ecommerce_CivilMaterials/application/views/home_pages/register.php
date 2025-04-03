    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="<?php echo base_url()?>uploads/images.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Account</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="<?php echo base_url()?>"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- LOGIN AREA START (Register) -->
    <div class="ltn__login-area pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Register <br>Your Account</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                             Sit aliquid,  Non distinctio vel iste.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="account-login-inner">
                        <form method="post" action="<?php echo base_url('welcome/insertRegistration')?>" class="ltn__form-box contact-form-box">

                            <div id="fnameError" class="text-danger"></div>
                            <input type="text" name="fname" placeholder="Full Name" id="fname" autocomplete="off">

                            <div id="mobile_noError" class="text-danger"></div>
                            <input type="text" name="mobile_no" placeholder="Mobile Number" id="mobile_no" autocomplete="off">

                            <div id="addressError" class="text-danger"></div>
                            <input type="text" name="address" placeholder="Address" id="address" autocomplete="off">

                            <div id="account_typeError" class="text-danger"></div>
                            <div class="input-item">
                                <select name="account_type" class="nice-select" id="account_type">
                                <option disabled selected>Select Type</option>
                                <option>User</option>
                                <option>Vendor</option>
                                </select>
                            </div>

                            <div id="emailError" class="text-danger"></div>
                            <input type="text" name="email" placeholder="Email*" id="email" autocomplete="off">

                            <div id="passwordError" class="text-danger"></div>
                            <input type="password" name="password" placeholder="Password*" id="password" >
                            
                            <div id="confirmpasswordError" class="text-danger"></div>
                            <input type="password" name="confirmpassword" placeholder="Confirm Password*" id="confirmpassword">
                           <!--  <label class="checkbox-inline">
                                <input type="checkbox" value="">
                                I consent to Herboil processing my personal data in order to send personalized marketing material in accordance with the consent form and the privacy policy.
                            </label> -->
                            <label class="checkbox-inline">
                                <input type="checkbox" value="">
                                By clicking "create account", I consent to the <a href="">privacy policy.</a>
                            </label>
                            <div class="btn-wrapper">
                                <button class="theme-btn-1 btn reverse-color btn-block add-save" type="submit">CREATE ACCOUNT</button>
                            </div>
                        </form>
                        <div class="by-agree text-center">
                            <p>By creating an account, you agree to our:</p>
                            <p><a href="#">TERMS OF CONDITIONS  &nbsp; &nbsp; | &nbsp; &nbsp;  PRIVACY POLICY</a></p>
                            <div class="go-to-btn mt-50">
                                <a href="<?php echo base_url('login')?>">ALREADY HAVE AN ACCOUNT ?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN AREA END -->

<script>
//--------------START REDIRECTING TO SAME PAGE AND VALIDATION FOR ADDING DATA-----------//
$(document).ready(function() {
    $('.add-save').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        var form = $(this).closest('form'); // Find the closest form
        var isValid = true;

        var fnameInput = $('#fname');
        var mobile_no_Input = $('#mobile_no');
        var addressInput = $('#address');
        var account_typeInput = $('#account_type');
        var emailInput = $('#email');
        var passwordInput = $('#password');
        var confirmPasswordInput = $('#confirmpassword');

        var fnameError = $('#fnameError');
        var mobile_no_Error = $('#mobile_noError');
        var addressError = $('#addressError');
        var account_typeError = $('#account_typeError');
        var emailError = $('#emailError');
        var passwordError = $('#passwordError');
        var confirmPasswordError = $('#confirmpasswordError');

        // Regular expressions for validation
        var namePattern = /^[a-zA-Z\s]+$/;
        var mobileNoPattern = /^[6-9][0-9]{9}$/;
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        // Validate name input
        if (fnameInput.val().trim() === '') {
            fnameError.text('Please enter a name');
            isValid = false;
        } else if (!namePattern.test(fnameInput.val().trim())) {
            fnameError.text('Please enter only letters');
            isValid = false;
        } else {
            fnameError.text('');
        }

        // Validate mobile number input
        if (mobile_no_Input.val().trim() === '') {
            mobile_no_Error.text('Please enter a mobile number.');
            isValid = false;
        } else if (!mobileNoPattern.test(mobile_no_Input.val().trim())) {
            mobile_no_Error.text('Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.');
            isValid = false;
        } else {
            mobile_no_Error.text('');
        }

        // Validate address input
        if (addressInput.val().trim() === '') {
            addressError.text('Please enter address');
            isValid = false;
        } else {
            addressError.text('');
        }

        // Validate select type input
        if (account_typeInput.val() === null || account_typeInput.val() === 'Select Type') {
            account_typeError.text('Please select type');
            isValid = false;
        } else {
            account_typeError.text('');
        }

        // Validate email input
        if (emailInput.val().trim() === '') {
            emailError.text('Please enter email');
            isValid = false;
        } else if (!emailPattern.test(emailInput.val().trim())) {
            emailError.text('Please enter a valid email');
            isValid = false;
        } else {
            emailError.text('');
        }

        // Validate password input
        if (passwordInput.val() === '') {
            passwordError.text('Please enter password');
            isValid = false;
        } else if (!passwordPattern.test(passwordInput.val())) {
            passwordError.text('Password must be at least 8 characters long, include uppercase, lowercase, number, and special character.');
            isValid = false;
        } else {
            passwordError.text('');
        }

        // Validate confirm password input
        if (confirmPasswordInput.val() === '') {
            confirmPasswordError.text('Please enter confirm password');
            isValid = false;
        } else if (confirmPasswordInput.val() !== passwordInput.val()) {
            confirmPasswordError.text('Passwords do not match');
            isValid = false;
        } else {
            confirmPasswordError.text('');
        }

        // // Validate confirm password input
        // if (confirmPasswordInput.val() !== passwordInput.val()) {
        //     confirmPasswordError.text('Passwords do not match');
        //     isValid = false;
        // } else {
        //     confirmPasswordError.text('');
        // }

        // If all inputs are valid, proceed with form submission via AJAX
        if (isValid) {
            $.ajax({
                type: form.attr('method'), // Get form method (POST)
                url: form.attr('action'), // Get form action URL
                data: form.serialize(), // Serialize form data for submission
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        alert('Data added successfully');
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
//---------------END REDIRECTING TO SAME PAGE AND VALIDATION FOR ADDING DATA-----------//

</script>