<style>
 .error-message {
    color: red;
    font-size: 14px;
    margin-bottom: 10px;
}

.status-message {
    font-weight: bold; /* Makes the text bold */
    color: #0d7a29; /* Dark color for the text */
    margin-top: 10px; /* Optional: Adds some spacing above the message */
}

#successMessage {
        background-color: #eb5234; /* Change to your desired color */
        border-color: #eb5234;
        color: #ffffff; /* Change to your desired text color */
    /*    //max-height: 350px;*/
        max-width: 450px;
        font-size: 16px; /* Change to your desired font size */
        padding: 10px 20px; /* Adjust padding as needed */
        margin-bottom: 20px; /* Adjust margin as needed */
    }


</style>
    <!-- BREADCRUMB AREA START -->
    <!-- <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bg="<?php echo base_url()?>uploads/images.jpg"> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <?php if ($this->session->flashdata('success_message')) { ?>
                          <div id="successMessage" class="alert alert-success">
                          <?php echo $this->session->flashdata('success_message'); ?>
                          </div>
                          <?php } ?>
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">Account</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="<?php echo base_url()?>"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
    <!-- BREADCRUMB AREA END -->

    <!-- LOGIN AREA START -->
    <div class="ltn__login-area pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h1 class="section-title">Sign In <br>To  Your Account</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                             Sit aliquid,  Non distinctio vel iste.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-login-inner">
                        <form id="loginForm" class="ltn__form-box contact-form-box">
                        <div id="error-message-email" class="error-message"></div> <!-- For displaying email error message -->
                        <input type="text" name="email" id="email" placeholder="Email*" autocomplete="off">
                        <div id="error-message-password" class="error-message"></div> <!-- For displaying password error message -->
                        <input type="password" name="password" id="password" placeholder="Password*">
                        <div class="btn-wrapper mt-0">
                            <button class="theme-btn-1 btn btn-block" type="submit">SIGN IN</button>
                        </div>
                        <div class="go-to-btn mt-20">
                            <a href="<?php echo base_url('forgot')?>"><small>FORGOTTEN YOUR PASSWORD?</small></a>
                        </div>
                          <div id="status-message" class="status-message"></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-create text-center pt-50">
                        <h4>DON'T HAVE AN ACCOUNT?</h4>
                        <p>Add items to your wishlistget personalised recommendations <br>
                            check out more quickly track your orders register</p>
                        <div class="btn-wrapper">
                            <a href="<?php echo base_url('register')?>" class="theme-btn-1 btn black-btn">CREATE ACCOUNT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN AREA END -->

<script>

$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('welcome/verifyLogin'); ?>',
            data: $(this).serialize(), // Serialize form data
            dataType: 'json',
            success: function(response) {
    console.log('Response:', response);
                $('#error-message-email').html('');
                $('#error-message-password').html('');
                $('#status-message').html('');

                if (response.status === 'success') {
                    // Redirect or show a success message
                    window.location.href = '<?php echo base_url(''); ?>' + response.redirect;
                } else {
                    // Display individual error messages
                    $('#error-message-email').html(response.email_message);
                    $('#error-message-password').html(response.password_message);
                    $('#status-message').html(response.message); // Display status message
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#error-message-email').html('An unexpected error occurred. Please try again.');
                $('#error-message-password').html('');
                $('#status-message').html('');
            }
        });
    });
});
    
//---------------------Closing flash message autometically-----------------------------//
     $(document).ready(function() {
        // Set a timeout to hide the success message after 5 seconds (adjust as needed)
        setTimeout(function() {
            $('#successMessage').fadeOut('slow');
        }, 2000); // 2000 milliseconds = 2 seconds
    });

</script>