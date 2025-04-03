<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
 /*       .card-gray {
            background-color: #f8f9fa;
        }*/
    </style>
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('')?>">Home</a></li>
              <li class="breadcrumb-item active">Add Slider</li>
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
                                <h3 class="card-title">Slider Form</h3>
                            </div>
                            <!-- form start -->
                            <form method="post" action="<?php echo base_url('welcome/insertSlider')?>" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Add Slider</label>
                                        <input type="file" name="image" class="form-control" placeholder="Choose File">
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
                                <h3 class="card-title">Slider Information</h3>
                            </div> -->
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL.No</th>
                                            <th>Slider</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         $serialNumber = 1;
                                        foreach($slider_data as $add): ?>
                                        <tr>
                                           <td><?php echo $serialNumber++; ?></td>
                                            <td><img src="<?php echo base_url('upload/'.$add->image)?>" style="width:100px"/></td>
                                            
         <td>
    <a class="fa fa-trash" onclick="setDeleteFunction('<?php echo $add->id; ?>')" style="font-size: 25px; color: red;"></a>
    <a class="fa fa-edit" onclick="setDataFunction('<?php echo $add->id; ?>', '<?php echo htmlspecialchars($add->image, ENT_QUOTES, 'UTF-8'); ?>')" style="font-size: 25px; color: green;"></a>
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
                    <p>Are you sure you want to delete this slider?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteSlider')?>">
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
<!-- Update Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel">Edit Slider</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?=base_url('welcome/updateSlider')?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sliderRole">Add Slider</label>
                        <input type="hidden" name="id" id="id">
                        <input type="file" name="image" id="sliderRole" class="form-control" placeholder="Choose File"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Update Modal -->

<!-- End Update Modal -->


<script>
   
    // Function to set data for the edit modal
    function setDataFunction(id, sliderRole){
        $('#id').val(id); 
        $('#editModal').modal('show'); 
    }

    // Function to set data for the delete modal
    function setDeleteFunction(dlt_id){
        $('#dlt_id').val(dlt_id); 
        $('#deleteModal').modal('show');
    }

</script>
 

