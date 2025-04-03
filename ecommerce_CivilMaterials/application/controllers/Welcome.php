<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	                                      //---START USER HOME PAGE CONTROLLER---//

	public function index()
{
    // Check if the user is logged in (correctly written condition)
    if (!$this->session->userdata('user_id')) {
        // Handle the case when the user is not logged in, if necessary
    }

    // Retrieve images from the model
    $result['get_image'] = $this->Main_model->getAllslider();

    $result['get_product'] = $this->Main_model->getAllProductsWithVendorInfo();

    // Load views with data
    $this->load->view('home_header');
    $this->load->view('home', $result);
    $this->load->view('home_footer');
}

	public function about_page()
	{
		 $this->load->view('home_pages/about_header');
		 $this->load->view('home_pages/about');
		 $this->load->view('home_footer');
	}

	public function shop_page()
{
    $this->load->model('Main_model');
    // Load views
    $result['get_product'] = $this->Main_model->getAllProducts();
    $this->load->view('home_pages/about_header');
    $this->load->view('home_pages/shop', $result);
    $this->load->view('home_footer');
}

    
    public function contact_page()
	{
		 $this->load->view('home_pages/about_header');
		 $this->load->view('home_pages/contact');
		 $this->load->view('home_footer');
	}

 //-------------------------------------------------START ADD TO CART--------------------------------------------//
	public function cart_page()
	{	if (!$this->session->userdata('user_id')) {
	        redirect('signIn'); // Redirect to login if not logged in
	    }

	    $user_id = $this->session->userdata('user_id'); // Get the logged-in user ID

	    // Load the necessary model
	    $this->load->model('Main_model'); // Ensure the model name matches

	    // Fetch the wishlist items
	    $data['cart_items'] = $this->Main_model->get_add_to_cart_products($user_id);

		$this->load->view('home_pages/about_header');
		$this->load->view('home_pages/cart', $data);
		$this->load->view('home_footer');
	}


     public function insertCart() {
	    $this->load->model('Main_model'); // Load the correct model

	    $input = json_decode(file_get_contents('php://input'), true);

	    $product_id = $input['product_id'];
	    $user_id = $input['user_id'];

	    if ($this->Main_model->addToCart($user_id, $product_id)) {
	        echo json_encode(['success' => true]);
	    } else {
	        echo json_encode(['success' => false]);
	    }
	}

// 	  public function delete_cart() {
//     $input = json_decode(file_get_contents('php://input'), true);
//     $id = $input['id'];
//     $user_id = $this->session->userdata('user_id'); // Get logged-in user ID

//     if ($id && $user_id) {
//         // Load the model if not already loaded
//         $this->load->model('Main_model');

//         // Call the model's delete method
//         $result = $this->Main_model->delete_cart($id, $user_id);

//         if ($result) {
//             echo json_encode(array('success' => true));
//         } else {
//             echo json_encode(array('success' => false));
//         }
//     } else {
//         echo json_encode(array('success' => false));
//     }
// }

public function delete_cart() {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'];
    $user_id = $this->session->userdata('user_id'); // Get the logged-in user ID

    if ($id && $user_id) {
        $this->load->model('Main_model'); // Load your model

        // Log the values for debugging
        log_message('debug', 'Deleting item with ID: ' . $id . ' for User ID: ' . $user_id);
        
        $result = $this->Main_model->delete_cart($id, $user_id);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Could not delete item.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid ID or User.']);
    }
}


 //-------------------------------------------------END ADD TO CART--------------------------------------------//

 //--------------------------------------------------START CHECKOUT--------------------------------------------//

	public function checkout_page()
	{	if (!$this->session->userdata('user_id')) {
	        redirect('signIn'); // Redirect to login if not logged in
	    }

	    $user_id = $this->session->userdata('user_id'); // Get the logged-in user ID

	    // Load the necessary model
	    $this->load->model('Main_model'); // Ensure the model name matches

	    // Fetch the wishlist items
	    $data['getAddToCart'] = $this->Main_model->get_add_to_cart_products($user_id);
		$this->load->view('home_pages/about_header');
		$this->load->view('home_pages/checkout', $data);
		$this->load->view('home_footer');
	}

	public function insert_cart_detail() {
	 	$this->Main_model->insert_cart_detail();
	}

  //-------------------------------------------------------END CHECKOUT--------------------------------------------//

	 public function account_page()
	{	 
		 $this->load->view('home_pages/about_header');
		 $this->load->view('home_pages/my_account');
		 $this->load->view('home_footer');
	}


   //-----------------------------------------------START ADD TO WISHLIST--------------------------------------------//

	public function wishlist_page() {
		    if (!$this->session->userdata('user_id')) {
		        redirect('signIn'); // Redirect to login if not logged in
		    }

		    $user_id = $this->session->userdata('user_id'); // Get the logged-in user ID

		    // Load the necessary model
		    $this->load->model('Main_model'); // Ensure the model name matches

		    // Fetch the wishlist items
		    $data['wishlist_items'] = $this->Main_model->get_wishlist_with_products($user_id);

		    // Load the views
		    $this->load->view('home_pages/about_header');
		    $this->load->view('home_pages/wishlist', $data);
		    $this->load->view('home_footer');
		}


	public function insertWishlist() {
	    $this->load->model('Main_model'); // Load the correct model

	    $input = json_decode(file_get_contents('php://input'), true);

	    $product_id = $input['product_id'];
	    $user_id = $input['user_id'];

	    if ($this->Main_model->addToWishlist($user_id, $product_id)) {
	        echo json_encode(['success' => true]);
	    } else {
	        echo json_encode(['success' => false]);
	    }
	}
	
	public function delete_wishlist() {
		    $input = json_decode(file_get_contents('php://input'), true);
		    $id = $input['id'];
		    $user_id = $this->session->userdata('user_id'); // Get logged-in user ID

		    if ($id && $user_id) {
		        // Load the model if not already loaded
		        $this->load->model('Main_model');

		        // Call the model's delete method
		        $result = $this->Main_model->delete_wishlist($id, $user_id);

		        if ($result) {
		            echo json_encode(array('success' => true));
		        } else {
		            echo json_encode(array('success' => false));
		        }
		    } else {
		        echo json_encode(array('success' => false));
		    }
		}
   		//-------------------------------------------------END ADD TO WISHLIST--------------------------------------------//

	 public function signin_page()
	{	 
		 $this->load->view('home_pages/about_header');
		 $this->load->view('home_pages/sign_in');  
		 $this->load->view('home_footer');
	}

 		 //-------------------------------------------------START REGISTRATION--------------------------------------------//
	 public function register_page()
	{
		 $this->load->view('home_pages/about_header');
		 $this->load->view('home_pages/register');
		 $this->load->view('home_footer');
	}  

	 public function insertRegistration(){
       $this->Main_model->addRegistration();
            redirect('register');
    }
     //-----------------------------------------------END REGISTRATION--------------------------------------------//

    public function U_logout_sessionDestroy() {
	    if (!$this->session->userdata('user_id')) redirect('signIn');
	    $this->session->sess_destroy();
	   // $this->session->set_flashdata('success_message', 'You Are Successfully Logged Out.');
	    redirect('signIn');
	}
                                            //---END USER HOME PAGE CONTROLLER---//


                                             //---START ADMIN CONTROLLER---//

	public function adminLogin(){
		 $this->load->view('admin/admin_login');
	}

    //--------------------------------------------------START ADMIN DASHBOARD-------------------------------------//
	public function dashboard_page()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->view('admin/admin_header');
		$result['getUserVendor'] = $this->Main_model->getAllUserVendor();
		$result['getUserOrder'] = $this->Main_model->get_user_cart_details();
		$this->load->view('admin/dashboard', $result);
		$this->load->view('admin/admin_footer');
	}
	//-------------------------------------------------END ADMIN DASHBOARD----------------------------------------//


	 //--------------------------------------------START ADMIN USER ORDER LIST-------------------------------------//

	public function admin_user()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->view('admin/admin_header');
		$result['getUserOrder'] = $this->Main_model->get_user_cart_details();
		$this->load->view('admin/user_orderlist', $result);
		$this->load->view('admin/admin_footer');
	}

	public function sendEmailsToUsersAndVendors()
	{
	    // Load the email library
	    $this->load->library('email');

	    // Fetch the emails and the types (user or vendor)
	    $emails = $this->getEmailsToNotify();
	    $responseMessage = '';

	    foreach ($emails as $emailData) {
	    // Customize the email message based on the account_type
	    if ($emailData['account_type'] === 'User') {
	        $message = 'Your order has been confirmed.';
	    } elseif ($emailData['account_type'] === 'Vendor') {
	        $message = 'You have a new order.';
	    } else {
	        continue;  // Skip if the account_type is not defined
	    }

	    // Send email
	    $this->email->from('sushmarathod25@gmail.com', 'E-Commerce Civil Material');
	    $this->email->to($emailData['email']);
	    $this->email->subject('Order Notification');
	    $this->email->message($message);

	    if ($this->email->send()) {
	        $responseMessage .= "Email sent to: {$emailData['email']}<br>";
	    } else {
	        $responseMessage .= "Failed to send email to: {$emailData['email']}<br>";
	    }

	    // Clear email configuration for the next iteration
	    $this->email->clear();
	}


	    // Return a JSON response with the message
	    $response = ['status' => 'success', 'message' => $responseMessage];
	    $this->output
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response));
	}


	private function getEmailsToNotify()
	{
	    $this->db->select('r1.email as user_email, r2.email as registration_email');
	    $this->db->from('cart_detail cd');
	    $this->db->join('registration r1', 'cd.user_id = r1.id', 'left');
	    $this->db->join('cart_product_detail cpd', 'cd.id = cpd.cart_detail_id', 'left');
	    $this->db->join('registration r2', 'cpd.resgister_id = r2.id', 'left');
	    $query = $this->db->get();

	    $results = $query->result();

	    $emails = [];
	    foreach ($results as $row) {
	        if (!empty($row->user_email)) {
	            $emails[] = ['email' => $row->user_email, 'account_type' => 'User'];
	        }
	        if (!empty($row->registration_email)) {
	            $emails[] = ['email' => $row->registration_email, 'account_type' => 'Vendor'];
	        }
	    }

	    return $emails;
	}

	public function updateCartDetailStatus()
	{
	    // Retrieve the cart detail ID from the POST request
	    $cartDetailId = $this->input->post('id');

	    if ($cartDetailId) {
	        // Update the status in the cart_detail table
	        $this->db->where('id', $cartDetailId);
	        $updateCartDetail = $this->db->update('cart_detail', array('status' => 'confirmed'));

	        if (!$updateCartDetail) {
	            log_message('error', 'Failed to update cart_detail: ' . $this->db->last_query());
	            $response = array('status' => 'error', 'message' => 'Failed to update cart_detail.');
	            $this->output->set_content_type('application/json')->set_output(json_encode($response));
	            return;
	        }

	        // Update the order_status in the cart_product_detail table
	        $this->db->where('cart_detail_id', $cartDetailId);
	        $updateCartProductDetail = $this->db->update('cart_product_detail', array('order_status' => 'ordered'));

	        if (!$updateCartProductDetail) {
	            log_message('error', 'Failed to update cart_product_detail: ' . $this->db->last_query());
	            $response = array('status' => 'error', 'message' => 'Failed to update cart_product_detail.');
	            $this->output->set_content_type('application/json')->set_output(json_encode($response));
	            return;
	        }

	        // Get the product IDs from cart_product_detail
	        $this->db->select('product_id');
	        $this->db->where('cart_detail_id', $cartDetailId);
	        $productIdsQuery = $this->db->get('cart_product_detail');

	        if ($productIdsQuery->num_rows() > 0) {
	            $productIds = array_column($productIdsQuery->result(), 'product_id');

	            // Delete from add_to_cart where product_id is in the retrieved list
	            $this->db->where_in('product_id', $productIds);
	            $deleteAddToCart = $this->db->delete('add_to_cart');

	            if (!$deleteAddToCart) {
	                log_message('error', 'Failed to delete from add_to_cart: ' . $this->db->last_query());
	                $response = array('status' => 'error', 'message' => 'Failed to delete from add_to_cart.');
	            } else {
	                // If deletion is successful, send the emails
	                $this->sendEmailsToUsersAndVendors();
	                $response = array('status' => 'success', 'message' => 'Order status updated, items deleted from add_to_cart, and emails sent.');
	            }
	        } else {
	            // No products to delete
	            $response = array('status' => 'info', 'message' => 'No products found for deletion in add_to_cart.');
	        }
	    } else {
	        // If cartDetailId is not provided
	        $response = array('status' => 'error', 'message' => 'Cart Detail ID is missing.');
	    }

	    // Return the response as JSON
	    $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}



     //--------------------------------------------END ADMIN USER ORDER LIST-------------------------------------//



    //--------------------------------------------------START ADMIN USER------------------------------------------//
    public function user_total_page()
    {
    	if (!$this->session->userdata('user_id')) redirect('admin-login');
    	$this->load->model('Main_model');
		$result['user_list'] = $this->Main_model->getAlluser();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/user/user_total_list', $result);
		$this->load->view('admin/admin_footer');
	}	

    public function user_approval_page()
    {
    	if (!$this->session->userdata('user_id')) redirect('admin-login');
    	$this->load->model('Main_model');
		$result['user_data'] = $this->Main_model->getAlluser();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/user/user_approval_list', $result);
		$this->load->view('admin/admin_footer');
	}	

	 public function removeUser() {
        $this->Main_model->remove_user();
        redirect('admin-user-approval');
    }

    public function ConfirmationEmail_user($userId) {
        // Load the email library
        $this->load->library('email');

        // Load user details from the database
        $this->db->where('id', $userId);
        $query = $this->db->get('registration');
        $user = $query->row();

        if ($user) {
            $this->email->from('sushmarathod25@gmail.com', 'E-Commerce Civil Material');
            $this->email->to($user->email);
            $this->email->subject('Registration Confirmation');
            $this->email->message('You have been successfully registered to e-commerce website for civil material');

            if ($this->email->send()) {
                $response = ['status' => 'success', 'message' => 'Email sent successfully.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to send email.', 'error_details' => $this->email->print_debugger()];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'User not found.'];
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }

      public function updateStatus_user($userId){
	    $this->db->where('id', $userId);
	    $this->db->update('registration', array('status' => 'confirmed'));

	    if ($this->db->affected_rows() > 0) {
	        $response = ['status' => 'success', 'message' => 'Status updated successfully.'];
	    } else {
	        $response = ['status' => 'error', 'message' => 'Failed to update status.'];
	    }

	    $this->output
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response));
	}    
	//---------------------------------------------END ADMIN USER------------------------------------------------//


	//--------------------------------------------START ADMIN VENDOR---------------------------------------------//
	public function vendor_total_page()
     {
    	if (!$this->session->userdata('user_id')) redirect('admin-login');
    	$this->load->model('Main_model');
		$result['vendor_list'] = $this->Main_model->getAlluser();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/vendor/vendor_total_list', $result);
		$this->load->view('admin/admin_footer');
	}	

    public function vendor_approval_page()
    {
    	if (!$this->session->userdata('user_id')) redirect('admin-login');
    	$this->load->model('Main_model');
		$result['vendor_data'] = $this->Main_model->getAllvendor();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/vendor/vendor_approval_list', $result);
		$this->load->view('admin/admin_footer');
	}	

	 public function removeVendor() {
        $this->Main_model->remove_vendor();
        redirect('admin-vendor-approval');
    }

    public function sendConfirmationEmail_vendor($userId) {
        // Load the email library
        $this->load->library('email');

        // Load user details from the database
        $this->db->where('id', $userId);
        $query = $this->db->get('registration');
        $user = $query->row();

        if ($user) {
            $this->email->from('sushmarathod25@gmail.com', 'E-Commerce Civil Material');
            $this->email->to($user->email);
            $this->email->subject('Registration Confirmation');
            $this->email->message('You have been successfully registered to e-commerce website for civil material');

            if ($this->email->send()) {
                $response = ['status' => 'success', 'message' => 'Email sent successfully.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Failed to send email.', 'error_details' => $this->email->print_debugger()];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'User not found.'];
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response));
    }

   public function updateStatus_vendor($userId) {
	    $this->db->where('id', $userId);
	    $this->db->update('registration', array('status' => 'confirmed'));

	    if ($this->db->affected_rows() > 0) {
	        $response = ['status' => 'success', 'message' => 'Status updated successfully.'];
	    } else {
	        $response = ['status' => 'error', 'message' => 'Failed to update status.'];
	    }

	    $this->output
	         ->set_content_type('application/json')
	         ->set_output(json_encode($response));
	}
    //------------------------------------------------END ADMIN VENDOR--------------------------------------------//


	//------------------------------------START ADMIN USER ORDER MANAGEMENT---------------------------------------//
	public function user_page()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->model('Main_model');
		$result['getUserOrder'] = $this->Main_model->get_user_cart_details();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/user/user_management', $result);
		$this->load->view('admin/admin_footer');
	}
    //------------------------------------END  ADMIN USER ORDER MANAGEMENT----------------------------------------//


	//-----------------------------------START ADMIN VENDOR ORDER MANAGEMENT--------------------------------------//
	public function vendor_page()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->model('Main_model');
		
		$data['getVendorProduct'] = $this->Main_model->fetch_order_details();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/vendor/vendor_management', $data);
		$this->load->view('admin/admin_footer');
	}

// 	// Example in your controller
// public function get_order_details() {
//     $this->load->model('Main_model');
//     $orderDetails = $this->Main_model->fetch_order_details(); // Method to get order details

//     $data['getSalesman'] = $orderDetails; // Assuming this contains vendor details
//     $this->load->view('your_view_file', $data);
// }

    //----------------------------------END ADMIN VENDOR ORDER MANAGEMENT-----------------------------------------//


	//-----------------------------------------------START SLIDER-------------------------------------------------//
	public function slider_page()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->model('Main_model');
		$result['slider_data'] = $this->Main_model->getAllslider();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/add_slider', $result);
		$this->load->view('admin/admin_footer');
	}

   public function insertSlider(){
		    $this->load->model('Main_model');
		    $result = $this->Main_model->addSlider();

		    if ($result) {
		        redirect('add-slider');
		    } 
		        // Handle the case where insertion failed
		        // Possibly show an error message or redirect to an error page
		        $this->load->view('admin/error'); // Example error view
		    }

		    public function deleteSlider() {
		        $this->Main_model->delete_slider();
		        redirect('add-slider');
		    }

		       public function updateSlider() {
		        $this->Main_model->update_slider();
		        redirect('add-slider');
    }
    //-----------------------------------------------END SLIDER---------------------------------------------------//


	//--------------------------------------------START BRAND MASTER----------------------------------------------//
	public function Master_Brand()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->model('Main_model');
	    $result['brand_data'] = $this->Main_model->getAllbrand();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/master/brand_master', $result);
		$this->load->view('admin/admin_footer');
	}

	public function insertBrand() {
		if (!$this->session->userdata('user_id')) redirect('admin-login');
     $this->Main_model->addBrand();
        redirect('brand-master');
   }

    public function deleteBrand() {
    	if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->delete_brand();
        redirect('brand-master');
    }

    public function updateBrand(){
    	if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->update_brand();
        redirect('brand-master');
    }
    //-------------------------------------------------END BRAND MASTER------------------------------------------//


    //------------------------------------------------START CATEGORY MASTER--------------------------------------//
	public function Master_Category()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->model('Main_model');
	    $result['category_data'] = $this->Main_model->getAllcategory();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/master/category_master', $result);
		$this->load->view('admin/admin_footer');
	}

	public function insertCategory() {
			if (!$this->session->userdata('user_id')) redirect('admin-login');
     $this->Main_model->addCategory();
        redirect('category-master');
   }

    public function deleteCategory() {
    		if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->delete_category();
        redirect('category-master');
    }

      public function updateCategory() {
      		if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->update_category();
        redirect('category-master');
    }
    //---------------------------------------------------END CATEGORY MASTER-------------------------------------//


    //----------------------------------------------------START SIZE MASTER--------------------------------------//
	public function Master_Size()
	{
		if (!$this->session->userdata('user_id')) redirect('admin-login');
		$this->load->model('Main_model');
	    $result['storeCategory'] = $this->Main_model->getAllcategory();
	    $result['size_data'] = $this->Main_model->getAllsize();
		$this->load->view('admin/admin_header');
		$this->load->view('admin/master/size_master', $result);
		$this->load->view('admin/admin_footer');
	}

    public function insertSize() {
    		if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->addSize();
            redirect('size-master');

     }

    public function deleteSize() {
    		if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->delete_size();
        redirect('size-master');
    }

      public function updateSize() {
      		if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->update_size();
        redirect('size-master');
    }
    //--------------------------------------------------END SIZE MASTER-------------------------------------------//

    
    //--------------------------------------------------END SIZE MASTER-------------------------------------------//
      public function product_list_page()
{
    if (!$this->session->userdata('user_id')) {
        redirect('admin-login');
    }

    $data['all_data'] = $this->Main_model->getAllProductsWithVendorInfo();

    $this->load->view('admin/admin_header');
    $this->load->view('admin/product_list', $data);
    $this->load->view('admin/admin_footer');
}

    //--------------------------------------------------END SIZE MASTER-------------------------------------------//


    //-----------------------------------------START ADMIN LOGIN AND LOGOUT OPERATION-----------------------------//
    public function authLogin() {
	    if ($this->input->post('email')) {
	        $email = $this->input->post('email');
	        $password = $this->input->post('password');
	        $adminData = $this->db->get_where('admin', array("email" => $email));
	        if ($adminData->num_rows() > 0) {
	            $userData = $adminData->row();
	            if ($userData->password == $password) {
	                $_SESSION['user_id'] = $this->input->post('email');
	                $this->session->set_flashdata('success_message', 'Welcome, You Are Successfully Logged In.');
	                redirect('dashboard');
	            } else {
	                $this->session->set_flashdata('failure_message_password', 'Invalid password');
	                $this->session->set_flashdata('failure_message_email', ''); // Reset email error message
	                redirect('admin-login');
	            }
	        } else {
	            $this->session->set_flashdata('failure_message_email', 'Invalid email');
	            $this->session->set_flashdata('failure_message_password', ''); // Reset password error message
	            redirect('admin-login');
	        }
	    } else {
	        redirect('admin-login');
	    }
	}

	public function A_logout_sessionDestroy() {
	    if (!$this->session->userdata('user_id')) redirect('admin-login');
	    $this->session->sess_destroy();
	   // $this->session->set_flashdata('success_message', 'You Are Successfully Logged Out.');
	    redirect('admin-login');
	}
    //----------------------------------------END ADMIN LOGIN AND LOGOUT OPERATION--------------------------------//

                                                 //---END ADMIN CONTROLLER---//


	                                            //---START VENDOR CONTROLLER---//

	public function vendor_neworderlist()
	{ 
		if (!$this->session->userdata('user_id')) redirect('signIn');
		 $data['getVendorProduct'] = $this->Main_model->fetch_order_details();
		 $this->load->view('vendor/vendor_header');
		 $this->load->view('vendor/vendor_orderlist', $data);
		 $this->load->view('vendor/vendor_footer');
	}

	public function vendor_orderhistory()
	{ 
		if (!$this->session->userdata('user_id')) redirect('signIn');
		 $data['getVendorProduct'] = $this->Main_model->fetch_order_details();
		 $this->load->view('vendor/vendor_header');
		 $this->load->view('vendor/vendor_order_history', $data);
		 $this->load->view('vendor/vendor_footer');
	}


	//------------------------------------------START SIGN IN AND SIGN OUT PAGE----------------------------------//

public function verifyLogin() {
    if ($this->input->post('email')) {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        // Fetch user data based on email
        $loginData = $this->db->get_where('registration', array("email" => $email));
        
        if ($loginData->num_rows() > 0) {
            $userData = $loginData->row();
            
            // Check if password matches
            if ($userData->password == $password) {
                // Check the status field
                if ($userData->status == 'confirmed') {
                    // Store user ID and name in session
                    $this->session->set_userdata([
                        'user_id' => $userData->id,
                        'account_type' => $userData->account_type,
                        'fname' => $userData->fname,
                        'email' => $userData->email,
                        'address' => $userData->address
                    ]);

                    // Set flashdata with welcome message
                    $this->session->set_flashdata('success_message', 'Welcome, ' . $userData->fname . '. You Are Successfully Logged In.');

                   $response = [
					    'status' => 'success',
					    'redirect' => $userData->account_type == 'Vendor' ? 'dashboard-page' : 'signIn',
					    'email' => $userData->email,
					    'address' => $userData->address,
					];

				                } else {
				                    $response = ['status' => 'error', 'message' => 'Registration status is pending...'];
				                }
				            } else {
				                $response = [
				                    'status' => 'error', 
				                    'email_message' => '',
				                    'password_message' => 'Invalid password'
				                ];
				            }
				        } else {
				            $response = [
				                'status' => 'error', 
				                'email_message' => 'Invalid email',
				                'password_message' => ''
				            ];
				        }

				        $this->output
				            ->set_content_type('application/json')
				            ->set_output(json_encode($response));
				    } else {
				        $response = [
				            'status' => 'error', 
				            'email_message' => 'Invalid request',
				            'password_message' => ''
				        ];
				        $this->output
				            ->set_content_type('application/json')
				            ->set_output(json_encode($response));
				    }
				}

      
     public function V_logout_sessionDestroy() {
	    if (!$this->session->userdata('user_id')) redirect('signIn');
	    $this->session->sess_destroy();
	   // $this->session->set_flashdata('success_message', 'You Are Successfully Logged Out.');
	    redirect('signIn');
	}

    //--------------------------------------END SIGN AND SIGN OUT  IN PAGE------------------------------------------//


public function dashboard()
	{ 
		if (!$this->session->userdata('user_id')) redirect('signIn');
		 $data['vendor_name'] = $this->session->userdata('fname');
		 $this->load->view('vendor/vendor_header');
		 $this->load->view('vendor/dashboard', $data);
		 $this->load->view('vendor/vendor_footer');
	}
//--------------------------------------------START ADD VIEW PRODUCT PAGE----------------------------------------------//

	public function add_product_page() {
	    if (!$this->session->userdata('user_id')) redirect('signIn');
	    $this->load->model('Main_model');
	    $result['get_brand'] = $this->Main_model->getAllbrand();
	    $result['get_category'] = $this->Main_model->getAllcategory();
	    $result['get_size'] = $this->Main_model->getAllsize();
	    $this->load->view('vendor/vendor_header');
	    $this->load->view('vendor/add_product', $result);
	    $this->load->view('vendor/vendor_footer');
	}

	public function view_product_page()
{
    if (!$this->session->userdata('user_id')) {
        redirect('signIn');
    }
    
    $registration_id = $this->session->userdata('user_id'); // Get the logged-in vendor's ID
    
    $this->load->model('Main_model');
    
    // Pass vendor_id to the model to get only the products belonging to the logged-in vendor
    $result['view_data'] = $this->Main_model->getAllproduct($registration_id); // Use $vendor_id here
    $result['get_brand'] = $this->Main_model->getAllbrand();
    $result['get_category'] = $this->Main_model->getAllcategory();
    $result['get_size'] = $this->Main_model->getAllsize();
    
    $this->load->view('vendor/vendor_header');
    $this->load->view('vendor/view_product', $result);
    $this->load->view('vendor/vendor_footer');
}

	
	 public function insertProduct() {
        $this->load->model('Main_model');
        $this->load->library('upload');

        // Get POST data
        $brands = $this->input->post('ms_brand_id');
        $categories = $this->input->post('ms_category_id');
        $sizes = $this->input->post('ms_size_id');
        $names = $this->input->post('product_name');
        $images = $_FILES['product_image']; // Use $_FILES for file uploads
        $quantities = $this->input->post('product_quantity');
        $prices = $this->input->post('product_price');
        $amounts = $this->input->post('product_amount');

        // Retrieve registration ID from session
        $registration_id = $_SESSION['user_id'];

        if (!$registration_id) {
            log_message('error', 'Registration ID not found.');
            redirect('error_page'); // Redirect or show an error message
            return;
        }

        $count = count($names);
        $products = [];

        // Upload configurations
        $upload_path = './vendor_upload/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        for ($i = 0; $i < $count; $i++) {
            $_FILES['file']['name'] = $images['name'][$i];
            $_FILES['file']['type'] = $images['type'][$i];
            $_FILES['file']['tmp_name'] = $images['tmp_name'][$i];
            $_FILES['file']['error'] = $images['error'][$i];
            $_FILES['file']['size'] = $images['size'][$i];

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048'; // 2MB
            $config['file_name'] = time() . '_' . $_FILES['file']['name'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $file_path = 'vendor_upload/'.$upload_data['file_name'];
            } else {
                $file_path = NULL; // In case of upload failure
            }

            $products[] = [
                'ms_brand_id' => $brands[$i],
                'ms_category_id' => $categories[$i],
                'ms_size_id' => $sizes[$i],
                'product_name' => $names[$i],
                'product_image' => $file_path, // Save file path
                'product_quantity' => $quantities[$i],
                'product_price' => $prices[$i],
                'product_amount' => $amounts[$i],
                'registration_id' => $registration_id
         
            ];
        }

        // Insert data into database
        $this->Main_model->addProducts($products);

        // Redirect or display success message
        redirect('vendor-add-product'); // Adjust if needed
    }

	 public function deleteProduct() {
        $this->Main_model->delete_product();
        redirect('vendor-view-product');
    }

     public function updateProduct() {
      	if (!$this->session->userdata('user_id')) redirect('admin-login');
        $this->Main_model->update_product();
        redirect('vendor-view-product');
    }


		public function getSizesByCategory() {
		    $category_id = $this->input->post('category_id');
		    $sizes = $this->Main_model->getSizesByCategory($category_id);

		    // Return the sizes as a JSON response
		    echo json_encode($sizes);
		}

//--------------------------------------------------END ADD VIEW PRODUCT PAGE------------------------------------------//

	                                             //---END VENDOR CONTROLLER---//


	}

	
