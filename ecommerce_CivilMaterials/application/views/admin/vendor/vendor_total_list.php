<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header 1 (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendor Total List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vendor Total List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- First Table Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
             <!--  <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.No</th>
                    <th>User Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Adress</th>
                    <th>Date & Time</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                      <tbody>
                      <?php 
                        $serialNumber = 1;
                      foreach($vendor_list as $vendor): ?>
                       <?php if($vendor->account_type == 'Vendor' && $vendor->status == 'confirmed'): ?>
                              <tr>
                                  <td><?php echo $serialNumber++; ?></td>
                                  <td><?php echo $vendor->fname; ?></td>
                                  <td><?php echo $vendor->mobile_no; ?></td>
                                  <td><?php echo $vendor->email; ?></td>
                                  <td><?php echo $vendor->address; ?></td>
                                  <td><?php 
                              // Format date as 'd-m-Y'
                              echo (new DateTime($vendor->curr_date))->format('d-m-Y'); 
                              echo ' & ';
                              // Create a DateTime object for the time
                              $time = new DateTime($vendor->curr_time);
                              // Format time as 'h:i A' (e.g., 01:30 PM)
                              echo $time->format('h:i A'); 
                              ?></td>
                                  <td>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="fa fa-trash" onclick="setDeleteFunction(
                                                        '<?php echo $vendor->id; ?>'
                                                    )" style="font-size: 25px; color: red;"></a>
                                  </td>
                              </tr>
                          <?php endif; ?>
                      <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
