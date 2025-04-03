<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
         <?php if ($this->session->flashdata('success_message')) { ?>
        <div id="successMessage" class="alert alert-success">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php } ?>

    	<style>
 	    .content-wrapper {
            background-color: white;
        }
        .table-container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Adjust gap as needed */
        }
        .table-card {
            flex: 1; /* Make sure each card takes equal space */
            margin: 10px; /* Optional margin around cards */
        }

         #successMessage {
      background-color: green; /* Change to your desired color */
      border-color: green;
      color: #ffffff; /* Change to your desired text color */
  /*    //max-height: 350px;*/
      max-width: 350px;
      font-size: 16px; /* Change to your desired font size */
      padding: 10px 20px; /* Adjust padding as needed */
      margin-bottom: 20px; /* Adjust margin as needed */
  }
    
    </style>
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('')?>">Home</a></li>
              <li class="breadcrumb-item active">Brand Details</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

        <!-- First Table Section -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Table 1: Designation Form -->
                    <!-- <div class="table-card"> -->
                        <div class="col-sm-4">
                        <div class="card card-gray">
                            <div class="card-header">
                                <h3 class="card-title">Brand Form</h3>
                            </div>
                            <!-- form start -->
                            <form method="post" action="<?php echo base_url('welcome/insertBrand')?>">
                                <div class="card-body">
                                     <!-- <div class="col-sm-6"> -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Name" autocomplete="off">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- Table 2: Employee List -->
                    <div class="table-card">
                        <div class="card">
                           <!--  <div class="card-header">
                                <h3 class="card-title">Brand Information</h3>
                            </div> -->
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.No</th>
                                            <th>Brand Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $serialNumber = 1;
                                        foreach($brand_data as $Brand): ?>
                                        <tr>
                                            <td><?php echo $serialNumber++; ?></td>
                                            <td><?php echo $Brand->brand_name; ?></td>
                                            <td>
         <a class="fa fa-trash" onclick="setDeleteFunction(
                                                        '<?php echo $Brand->id; ?>'
                                                    )" style="font-size: 25px; color: red;"></a>
         <a class="fa fa-edit" onclick="setDataFunction(
                                                        '<?php echo $Brand->id; ?>',
                                                         '<?php echo htmlspecialchars($Brand->brand_name, ENT_QUOTES, 'UTF-8'); ?>'
                                                    )" style="font-size: 25px; color: green;"></a>

                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

     <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this brand name?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteBrand')?>">
                        <input type="hidden" name="dlt_id" id="dlt_id">
                        <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-secondary">Yes Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <!-- End Delete Modal -->

   <!-- Update Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="editModalLabel">Edit Brand</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     <form method="post" action="<?=base_url('welcome/updateBrand')?>">
        <div class="modal-body">
                   <div class="row">
                   <div class="col-sm-6">
                    <div class="form-group inline-block">
                    <label class="inline-block">Brand Name</label>
                    <input type="hidden" name="id" id="id"> 
                    <input type="text" name="brand_name" id="brandRole" class="form-control inline-block brand_name" placeholder="Enter Brand"/>
                    <div id="nameErrorEd" class="text-danger"></div>
                   </div>
                   </div>
                  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-secondary editBrand-save">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- End Update Modal -->


<script>

//---------------------Closing flash message autometically----------------------------//
     setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds


    function setDataFunction(id, brandRole){
       // alert(id)
      $('#id').val(id); 
      $('#brandRole').val(brandRole); 
      $('#editModal').modal('show');
    }

     function setDeleteFunction(dlt_id){
       // alert(dlt_id)
      $('#dlt_id').val(dlt_id); 
      $('#deleteModal').modal('show');
    }
</script>


 


