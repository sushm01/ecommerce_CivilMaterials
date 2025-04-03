<?php
class Main_model extends CI_Model
{

                                                //---START HOME PAGE MODULE---//

     public function get_user_cart_details() {
        $this->db->select('cart_detail.*, cart_product_detail.product, cart_product_detail.quantity, cart_product_detail.amount, cart_product_detail.resgister_id');
        $this->db->from('cart_detail');
        $this->db->join('cart_product_detail', 'cart_detail.id = cart_product_detail.cart_detail_id');

        $query = $this->db->get();
        return $query;
    }

    public function fetch_order_details() {
    $this->db->select('cart_product_detail.*, cart_detail.curr_date, cart_detail.curr_time, registration.fname, registration.email, registration.mobile_no, registration.address');
    $this->db->from('cart_product_detail');
    $this->db->join('cart_detail', 'cart_product_detail.cart_detail_id = cart_detail.id');
    $this->db->join('registration', 'cart_product_detail.resgister_id = registration.id'); // Corrected syntax
    $query = $this->db->get();
    return $query; // Return as array of objects
}





    //--------------------------------------START ADD TO CART AND WISHLIST PAGE--------------------------------------//

   public function addToWishlist($user_id, $product_id) {
        $data = array(
            'user_id' => $user_id,
            'product_id' => $product_id
        );
        return $this->db->insert('add_to_wishlist', $data);
    }
         

    public function get_wishlist_with_products($user_id) {
        $this->db->select('add_to_wishlist.*, products.product_name, products.product_image, products.product_price');
        $this->db->from('add_to_wishlist');
        $this->db->join('products', 'add_to_wishlist.product_id = products.id');
        $this->db->where('add_to_wishlist.user_id', $user_id);

        $query = $this->db->get();
        return $query;
    }

    public function delete_wishlist($id, $user_id) {
            if ($id && $user_id) {
                $this->db->where('id', $id);
                $this->db->where('user_id', $user_id); // Ensure the deletion is for the logged-in user
                return $this->db->delete('add_to_wishlist');
            }
            return false;
        }

    public function addToCart($user_id, $product_id) {
        $data = array(
            'user_id' => $user_id,
            'product_id' => $product_id
        );
        return $this->db->insert('add_to_cart', $data);
    }


      public function get_add_to_cart_products($user_id) {
        $this->db->select('add_to_cart.*, products.id, products.registration_id, products.product_name, products.product_image, products.product_price');
        $this->db->from('add_to_cart');
        $this->db->join('products', 'add_to_cart.product_id = products.id');
        $this->db->where('add_to_cart.user_id', $user_id);

        $query = $this->db->get();
        return $query;
    }

    // public function delete_cart($id, $user_id) {
    //         if ($id && $user_id) {
    //             $this->db->where('id', $id);
    //             $this->db->where('user_id', $user_id); // Ensure the deletion is for the logged-in user
    //             return $this->db->delete('add_to_cart');
    //         }
    //         return false;
    //     }
    public function delete_cart($id, $user_id) {
    $this->db->where('id', $id);
    $this->db->where('user_id', $user_id);
    return $this->db->delete('add_to_cart'); // Ensure the table name is correct
}

   //-----------------------------------------START ADD TO CART AND WISHLIST PAGE-------------------------------------//


    //----------------------------------------------START CHECKOUT OPERATION-----------------------------------------//

   public function insert_cart_detail() {
        // Retrieve user ID from session
        $user_id = $this->session->userdata('user_id');
        
        // Check if user ID is available
        if (!$user_id) {
            echo json_encode(['success' => false, 'error' => 'User ID is missing']);
            return;
        }

        // Retrieve raw input data
        $rawData = $this->input->raw_input_stream;

        // Log raw input for debugging (optional)
        log_message('debug', 'Raw input: ' . $rawData);

        // Decode JSON data
        $data = json_decode($rawData, true);

        // Check if JSON decoding failed
        if (json_last_error() !== JSON_ERROR_NONE) {
            $error = json_last_error_msg(); // Get JSON error message
            echo json_encode(['success' => false, 'error' => 'Invalid JSON data: ' . $error]);
            return;
        }

        // Extract order and cart items
        $order = $data['order'] ?? [];
        $cartItems = $data['cartItems'] ?? [];

        // Validate data
        if (empty($order) || empty($cartItems)) {
            echo json_encode(['success' => false, 'error' => 'Missing order or cart items']);
            return;
        }

        date_default_timezone_set('Asia/Kolkata');
        $now = date('Y-m-d'); // Use Y-m-d for standard date format
        $time = date('H:i:s'); // Use H:i:s for 24-hour time format

        // Prepare order data
        $orderData = [
            'user_id' => $user_id, // Use the retrieved user ID
            'fi_name' => $order['fi_name'] ?? '',
            'ls_name' => $order['ls_name'] ?? '',
            'email_add' => $order['email_add'] ?? '',
            'phone_no' => $order['phone_no'] ?? '',
            'address_house' => $order['address_house'] ?? '',
            'address_appartment' => $order['address_appartment'] ?? '',
            'town' => $order['town'] ?? '',
            'state' => $order['state'] ?? '',
            'pincode' => $order['pincode'] ?? '',
            'note' => $order['note'] ?? '',
            'cart_subtotal' => $order['cart_subtotal'] ?? '0.00',
            'shipping' => $order['shipping_cost'] ?? '0.00',
            'handling' => $order['handling_cost'] ?? '0.00',
            'order_total' => $order['order_total'] ?? '0.00',
            'curr_date' => $now,
            'curr_time' => $time
        ];

        // Insert into cart_detail
        if (!$this->db->insert('cart_detail', $orderData)) {
            $error = $this->db->error(); // Get database error
            echo json_encode(['success' => false, 'error' => 'Failed to insert order: ' . $error['message']]);
            return;
        }

        // Get cart_detail_id
        $cart_detail_id = $this->db->insert_id();

        // Insert cart items into cart_product_detail
        foreach ($cartItems as $item) {
            $itemData = [
                'cart_detail_id' => $cart_detail_id,
                'product_id' => $item['productId'] ?? null, // Use productId from the item
                'resgister_id' => $item['registrationId'] ?? null, // Use registrationId from the item
                'product' => $item['product'] ?? '',
                'quantity' => $item['quantity'] ?? 0,
                'amount' => $item['amount'] ?? '0.00'
            ];
            if (!$this->db->insert('cart_product_detail', $itemData)) {
                $error = $this->db->error(); // Get database error
                echo json_encode(['success' => false, 'error' => 'Failed to insert cart item: ' . $error['message']]);
                return;
            }
        }

        // Success response
        echo json_encode(['success' => true]);
    }

   
    //-------------------------------------------------END CHECKOUT OPERATION---------------------------------------//


       //-------------------------------------------------START SHOP PAGE------------------------------------------//

    public function getAllProducts()
        {
            $this->db->select("products.*, brand_master.brand_name, category_master.category_name, size_master.size");
            $this->db->from('products');
            $this->db->join('brand_master', 'brand_master.id = products.ms_brand_id');
            $this->db->join('category_master', 'category_master.id = products.ms_category_id');
            $this->db->join('size_master', 'size_master.id = products.ms_size_id');
            $this->db->order_by('products.ms_category_id', 'ASC');
              $this->db->order_by('products.product_image', 'ASC');
                $this->db->order_by('products.product_price', 'ASC');
            $query = $this->db->get();
            
            if ($query->num_rows() > 0)
            {
                return $query->result();
            }
            return null; // Return null if no products found
        }

       


     //-------------------------------------------------START SHOP PAGE----------------------------------------//


   //-------------------------------------------------START REGISTRATION PAGE----------------------------------------//
    public function addRegistration() {
       if ($this->input->post('fname')) {
        // Retrieve input data
        $data = array(
            'fname' => $this->input->post('fname'),
            'mobile_no' => $this->input->post('mobile_no'),
            'address' => $this->input->post('address'),
            'account_type' => $this->input->post('account_type'),
            'email' => $this->input->post('email'),
            'curr_date' => date('Y-m-d'), // Current date in YYYY-MM-DD format
            'curr_time' => date('H:i:s'), // Current time in HH:MM:SS format
            'password' => $this->input->post('password') );

        // Insert data into database
        $result = $this->db->insert('registration', $data); 

        return $result; // Ensure to return the result
    }
    return false; // Return false if input data is not present
}
    
    public function getAlluser(){
        $master = $this->db->get('registration');
        if($master->num_rows()> 0){
            return $master->result();
        } 
    }

    public function remove_user(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('registration');
   }
}

    public function getAllvendor(){
        $master = $this->db->get('registration');
        if($master->num_rows()> 0){
            return $master->result();
        } 
    }

    public function remove_vendor(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('registration');
   }
} 
//---------------------------------------------------END REGISTRATION PAGE----------------------------------------//


                                                //---END HOME PAGE MODULE---//



                                                //---START ADMIN PAGE MODULE---//


	//---------------------------------------------------STAR SLIDER-----------------------------------------------//
	 public function addSlider() {
            // Load the upload library
            $this->load->library('upload');

            // Set upload configuration
            $config['upload_path'] = './upload/'; // Change this to your desired path
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048; // Size in kilobytes
            $config['encrypt_name'] = false; // Encrypt file name to prevent duplicate names

            // Initialize the upload library with the configuration
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                // If upload fails, show error message
                $error = array('error' => $this->upload->display_errors());
                // You might want to handle the error here
                return false;
            } else {
                // Get the uploaded file data
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];

                // Prepare data for insertion
                $data = array(
                    'image' => $image
                );

                // Insert into the database
                $result = $this->db->insert('slider', $data);

                return $result;
            }
          }

	public function getAllslider(){
		$add = $this->db->get('slider');
		if($add->num_rows()> 0){
			return $add->result();
		} 
	}

	public function delete_slider() {
        $response = ['data' => [], 'error' => ''];

        // Check if 'dlt_id' is provided in the POST request
        if ($this->input->post('dlt_id')) {
            // Retrieve the ID from the POST request
            $id = $this->input->post('dlt_id');

            // Retrieve the image filename from the database before deletion
            $this->db->select('image'); // Adjust 'image' to the actual column name for image filenames
            $this->db->where('id', $id);
            $query = $this->db->get('slider');

            if ($query->num_rows() > 0) {
                $row = $query->row();
                $image_filename = $row->image; // Adjust 'image' to the actual column name for image filenames

                // Define the path to the upload folder
                $upload_path = './upload/'; // Adjust this path to your upload folder

                // Full path to the image file
                $image_path = $upload_path . $image_filename;

                // Perform the delete operation in the database
                $this->db->where('id', $id);
                $result = $this->db->delete('slider');

            if ($result) {
                // Check if the file exists before attempting to delete it
                if (file_exists($image_path)) {
                    unlink($image_path); // Delete the file from the server
                }       
                            $response['data'] = ['status' => 'success'];
                        } else {
                            $response['error'] = 'Failed to delete record from database.';
                        }
                    } else {
                        $response['error'] = 'Image not found in the database.';
                    }
                } else {
                    $response['error'] = 'No ID provided.';
                }

                // Return the response
                echo json_encode($response);
            }

     public function update_slider() {
        $response = ['data' => [], 'error' => ''];

        // Load the upload library
        $this->load->library('upload');

        // Set upload configuration
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // Size in kilobytes
        $config['encrypt_name'] = false; // Encrypt file name to prevent duplicate names

        // Initialize the upload library with the configuration
        $this->upload->initialize($config);

        // Retrieve ID from POST request
        $id = $this->input->post('id');

        if (!$id) {
            $response['error'] = 'No ID provided.';
            echo json_encode($response);
            return;
        }

        // Check if a new image file is uploaded
        if (!empty($_FILES['image']['name'])) {
            // Attempt to upload the new image
            if (!$this->upload->do_upload('image')) {
                $response['error'] = $this->upload->display_errors();
                echo json_encode($response);
                return;
            }

        // Get the uploaded file data
        $upload_data = $this->upload->data();
        $new_image_filename = $upload_data['file_name'];

        // Retrieve the old image filename from the database
        $this->db->select('image');
        $this->db->where('id', $id);
        $query = $this->db->get('slider');

        if ($query->num_rows() === 0) {
            $response['error'] = 'Record not found in the database.';
            echo json_encode($response);
            return;
        }

        $row = $query->row();
        $old_image_filename = $row->image;

        // Prepare data to update
        $data = ['image' => $new_image_filename];

        // Update the database record
        $this->db->where('id', $id);
        $result = $this->db->update('slider', $data);

        if ($result) {
            // Remove the old image file if it exists
            if (!empty($old_image_filename)) {
                $old_image_path = './upload/' . $old_image_filename;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path); // Delete the old image file
                }
            }
            $response['data'] = ['status' => 'success', 'message' => 'Record updated successfully.'];
        } else {
            $response['error'] = 'Failed to update record in the database.';
        }
    } else {
        // If no new image is uploaded, handle other updates if necessary
        $data = []; // Add other fields here if needed

        if (!empty($data)) {
            $this->db->where('id', $id);
            $result = $this->db->update('slider', $data);

            if ($result) {
                $response['data'] = ['status' => 'success', 'message' => 'Record updated successfully.'];
            } else {
                $response['error'] = 'Failed to update record in the database.';
            }
        } else {
            $response['data'] = ['status' => 'success', 'message' => 'No new changes made.'];
        }
    }

    // Return the response
    echo json_encode($response);
}


  	 //----------------------------------------------------END SLIDER---------------------------------------------//


	//--------------------------------------------------STAR BRAND MASTER-----------------------------------------//
	public function addBrand()
    {
        $response = ['data' => [], 'error' => '']; // Initialize response array
        if ($this->input->post('brand_name')) {
            $data = array(
                'brand_name' => $this->input->post('brand_name')
            );

            $result = $this->db->insert('brand_master', $data);

            if ($result) {
                $this->session->set_flashdata('success_message', 'Data added successfully');
            } else {
                $response['error'] = 'Failed to add data'; // Set error message
            }
        } else {
            $response['error'] = 'Invalid request'; // Set error message for invalid request
        }
        
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response)); // Set JSON response without echoing
    }

	public function getAllbrand(){
		$master = $this->db->get('brand_master');
		if($master->num_rows()> 0){
			return $master->result();
		} 
	}

	public function delete_brand(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('brand_master');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}

     public function update_brand()
        {
        $response = ['data' => [], 'error' => ''];
        if ($this->input->post('brand_name')) {
            $data = array(
                'brand_name' => $this->input->post('brand_name')
            );

            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('brand_master', $data);

             if ($result) {
                $this->session->set_flashdata('success_message', 'Data updated successfully');
            } else {
                //echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
            }
            $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response)); // Set JSON response without echoing
    }
  }
   //------------------------------------------------------END BRAND MASTER----------------------------------------//


  //-----------------------------------------------------STAR CATEGORY MASTER-------------------------------------//
	public function addCategory()
    {
        $response = ['data' => [], 'error' => '']; // Initialize response array
        if ($this->input->post('category_name')) {
            $data = array(
                'category_name' => $this->input->post('category_name')
            );

            $result = $this->db->insert('category_master', $data);

            if ($result) {
                $this->session->set_flashdata('success_message', 'Data added successfully');
            } else {
                $response['error'] = 'Failed to add data'; // Set error message
            }
        } else {
            $response['error'] = 'Invalid request'; // Set error message for invalid request
        }
        
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response)); // Set JSON response without echoing
    }

    public function getAllcategory(){
		$master = $this->db->get('category_master');
		if($master->num_rows()> 0){
			return $master->result();
		} 
	}

	public function delete_category(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('category_master');
         if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
            }
            redirect('category-master');           
   }


 public function update_category()
        {
        $response = ['data' => [], 'error' => ''];
        if ($this->input->post('category_name')) {
            $data = array(
                'category_name' => $this->input->post('category_name')
            );

            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('category_master', $data);

            if ($result) {
                $this->session->set_flashdata('success_message', 'Data updated successfully');
            } else {
                //echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
            }
            $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response)); // Set JSON response without echoing
       }
    }
     //------------------------------------------------END CATEGORY MASTER-----------------------------------------//


    //-------------------------------------------------STAR SIZE MASTER-------------------------------------------//
   	public function addSize()
    {
        $response = ['data' => [], 'error' => '']; // Initialize response array
        if ($this->input->post('size')) {
            $data = array(
                'size' => $this->input->post('size'),
                'category_id' => $this->input->post('category_id')
            );

            $result = $this->db->insert('size_master', $data);

            if ($result) {
                $this->session->set_flashdata('success_message', 'Data added successfully');
            } else {
                $response['error'] = 'Failed to add data'; // Set error message
            }
        } else {
            $response['error'] = 'Invalid request'; // Set error message for invalid request
        }
        
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response)); // Set JSON response without echoing
    }

    public function getAllsize(){
	     $this->db->select('size_master.*, category_master.category_name');
		 $this->db->from('size_master');
		 $this->db->join('category_master', 'category_master.id = size_master.category_id', 'left');
		 $master = $this->db->get();
		if($master->num_rows()> 0){
			return $master->result();
		} 
	}

	public function delete_size(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('size_master');
  
                if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
            }
            redirect('size-master');
        }

 public function update_size()
        {
        $response = ['data' => [], 'error' => ''];
        if ($this->input->post('size')) {
            $data = array(
                'size' => $this->input->post('size'),
                'category_id' => $this->input->post('category_id')
            );

            $this->db->where('id', $this->input->post('id'));
            $result = $this->db->update('size_master', $data);
     if ($result) {
                $this->session->set_flashdata('success_message', 'Data updated successfully');
            } else {
                //echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
            }
            $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($response)); // Set JSON response without echoing
        }
    }

     //------------------------------------------------END SIZE MASTER---------------------------------------------//

   public function getAllProductsWithVendorInfo() 
{
    // Select fields from the products table and related information
    $this->db->select('products.*, brand_master.brand_name, category_master.category_name, size_master.size, registration.fname, registration.mobile_no');
    $this->db->from('products');
    
    // Join with brand_master table
    $this->db->join('brand_master', 'brand_master.id = products.ms_brand_id', 'left');
    
    // Join with category_master table
    $this->db->join('category_master', 'category_master.id = products.ms_category_id', 'left');
    
    // Join with size_master table
    $this->db->join('size_master', 'size_master.id = products.ms_size_id', 'left');
    
    // Join with registration table to get vendor info
    $this->db->join('registration', 'registration.id = products.registration_id', 'left');
    
    // Execute the query
    $query = $this->db->get();
    
    // Check if there are results and return them
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return [];
    }
}


     //-------------------------------------START ADMIN LOGIN AND LOGOUT OPERATION---------------------------------//

    public function authenticate_admin($email, $password) {
        $query = $this->db->get_where('admin', array('email' => $email, 'password' => $password));
        $admin = $query->row_array();
        if (!empty($admin)) {
            return $admin; // Return user data if authentication succeeds
        } else {
            return false; // Return false if authentication fails
        }
    }

    //--------------------------------------END ADMIN LOGIN AND LOGOUT OPERATION-----------------------------------//

                                                //---END ADMIN PAGE MODULE---//



                                                //---START VENDOR PAGE MODULE---//

    //--------------------------------------------------START ADD VIEW PRODUCT-----------------------------------------//

    public function addProducts($products) {
        // Begin transaction
        $this->db->trans_begin();
        
        // Insert each product into the database
        foreach ($products as $data) {
            // Ensure that the data is correctly formatted
            if (!isset($data['product_image'])) {
                $data['product_image'] = NULL; // Set to NULL if no image
            }

            // Insert the data into the 'products' table
            $this->db->insert('products', $data);
        }
        
        // Check if the transaction was successful
        if ($this->db->trans_status() === FALSE) {
            // Rollback the transaction if something went wrong
            $this->db->trans_rollback();
            return FALSE;
        } else {
            // Commit the transaction if everything is fine
            $this->db->trans_commit();
            return TRUE;
        }
    }

      public function getAllproduct($registration_id) 
    {
        // Start by selecting from the products table
        $this->db->select('products.*, brand_master.brand_name, category_master.category_name, size_master.size');
        $this->db->from('products');
        
        // Add condition to filter products by the vendor_id
        $this->db->where('products.registration_id', $registration_id); // Ensure the column name is correct
        
        // Join with brand_master table
        $this->db->join('brand_master', 'brand_master.id = products.ms_brand_id', 'left');
        
        // Join with category_master table
        $this->db->join('category_master', 'category_master.id = products.ms_category_id', 'left');
        
        // Join with size_master table
        $this->db->join('size_master', 'size_master.id = products.ms_size_id', 'left');
        
        // Execute the query
        $query = $this->db->get();
        
        // Check if there are results and return them
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }

     public function delete_product() {
            $response = array('success' => false);

            // Check if 'dlt_p' is provided in the POST request
            if ($this->input->post('dlt_p')) {
                $item_id = $this->input->post('dlt_p');

                // Fetch the product data to get the image filename
                $product = $this->db->get_where('products', array('id' => $item_id))->row();

                if ($product) {
                    // Attempt to delete the product record from the database
                    $this->db->where('id', $item_id);
                    $this->db->delete('products');

                    if ($this->db->affected_rows() > 0) {
                        // Define the path to the upload folder
                        $upload_path = './vendor_upload/';
                        // Construct the full file path
                        $file_path = $upload_path . basename($product->product_image);

                        // Attempt to delete the image file from the uploads folder
                        if (file_exists($file_path)) {
                            if (unlink($file_path)) {
                                log_message('info', 'File deleted successfully: ' . $file_path);
                                $response['success'] = true;
                                $this->session->set_flashdata('success_message', 'Data and image deleted successfully');
                            } else {
                                log_message('error', 'Failed to delete file: ' . $file_path);
                                $this->session->set_flashdata('error_message', 'Data deleted, but failed to delete image file');
                            }
                        } else {
                            log_message('error', 'File does not exist: ' . $file_path);
                            $this->session->set_flashdata('success_message', 'Data deleted, but image file was not found');
                        }
                    } else {
                        $this->session->set_flashdata('error_message', 'Failed to delete data from the database');
                    }
                } else {
                    $this->session->set_flashdata('error_message', 'Data not found');
                }
            } else {
                $this->session->set_flashdata('error_message', 'No ID provided');
            }

            // Redirect to a specific page after processing
            redirect('vendor-view-product');
        }

     public function update_product() {
            $response = ['data' => [], 'error' => ''];

            // Check if the form was submitted and if the product ID is provided
            if ($this->input->post('id')) {
                $id = $this->input->post('id');
                $data = array(
                    'ms_brand_id' => $this->input->post('ms_brand_id'),
                    'ms_category_id' => $this->input->post('ms_category_id'),
                    'ms_size_id' => $this->input->post('ms_size_id'),
                    'product_name' => $this->input->post('product_name'),
                    'product_quantity' => $this->input->post('product_quantity'),
                    'product_price' => $this->input->post('product_price'),
                    'product_amount' => $this->input->post('product_amount')
                );

                // Handle file upload
                $config['upload_path'] = './vendor_upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2048;
                $this->load->library('upload', $config);

                // Retrieve the current image path from the database
                $this->db->select('product_image');
                $this->db->where('id', $id);
                $query = $this->db->get('products');

                if ($query->num_rows() > 0) {
                    $current_image = $query->row()->product_image;

                    if (!empty($_FILES['product_image']['name'])) {
                        if ($this->upload->do_upload('product_image')) {
                            $uploadData = $this->upload->data();
                            $new_image_path = 'vendor_upload/' . $uploadData['file_name']; // Path to store in DB

                            // Add the new image path to the data array
                            $data['product_image'] = $new_image_path;

                            // Delete the old image file if necessary
                            if ($current_image) {
                                $old_image_path = './' . $current_image; // Construct full path to old image
                                if (file_exists($old_image_path)) {
                                    if (unlink($old_image_path)) {
                                        $response['data'] = 'Old file deleted successfully.';
                                    } else {
                                        $response['error'] = 'Failed to delete old file: ' . $old_image_path;
                                    }
                                } else {
                                    $response['error'] = 'Old file not found: ' . $old_image_path;
                                }
                            }
                        } else {
                            $response['error'] = $this->upload->display_errors();
                            echo json_encode($response);
                            return;
                        }
                    } else {
                        // If no new image is uploaded, keep the old image
                        $data['product_image'] = $current_image;
                    }

                    // Perform the update
                    $this->db->where('id', $id);
                    $result = $this->db->update('products', $data);

                    // Check if the update was successful
                    if ($result) {
                        $response['data'] = 'Product updated successfully!';
                    } else {
                        $response['error'] = 'Failed to update product.';
                    }
                } else {
                    $response['error'] = 'Product not found.';
                }
            } else {
                $response['error'] = 'No product ID provided.';
            }

            // Return the response as JSON
            echo json_encode($response);
        }


     public function getSizesByCategory($category_id) {
                $this->db->where('category_id', $category_id); // Adjust the column name as per your database schema
                $query = $this->db->get('size_master'); // Adjust the table name as per your database schema
                return $query->result_array();
            }

 //---------------------------------------------------ENS ADD VIEW PRODUCT-------------------------------------------//

                  
                                       //---END VENDOR PAGE MODULE---//
    public function getAllUserVendor()
    {
        //$this->db->where('action', 'active');
        $this->db->order_by('registration.id', 'DESC');
        $query = $this->db->get("registration");
        if ($query->num_rows() > 0)
        {
            return $query;
        }
    }
   


}
