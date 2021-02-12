<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php include "admin_css.php";?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "sidebar.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Company Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
           
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-sm-8">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Users</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="company_form">
                <input type="hidden" name="form_status" id="form_status" value="edit">
                <input type="hidden" name="company_id" id="company_id">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                       <div class="form-group">
                        <label for="fname">Company Name</label>
                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name">
                         <span id="company_name_error" class="text-danger"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" readonly="readonly">
                          </div>
                    </div>
                  </div>
                 <div class="row">
                     <div class="col-sm-6">
                       <div class="form-group">
                        <label for="dob">Address</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Enter Address"></textarea>
                         <span id="address_error" class="text-danger"></span>
                      </div>
                     </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                      </div>
                 </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-primary" onclick="update_company_data();">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-sm-4">
            <!-- small box -->
              <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $employee_count;?></h3>

                <p>Employee</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include "footer.php";?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include "admin_js.php";?>
<script type="text/javascript">

    $(document).ready(function () {
       get_edit_data();
      });

       function get_edit_data(){
          $.ajax({
          url:"<?php echo base_url(); ?>company_edit_data",
          data:"form_status=company_edit",
          method:"post",
          cache:false,
          success:function(result){
            var obj=JSON.parse(result);
              $.each(obj.data, function (i) {
                      $.each(obj.data[i], function (key, val) { 
                         if(key=="password"){
                          $("#password").val("");
                        }else{
                           $("#"+key).val(val);
                         }
                        
                      });
                  });
           }
        })
     }


     function update_company_data(){
  var company_name=$("#company_name").val();
  var email=$("#email").val();
  var address=$("#address").val();
 
      
          if(company_name!="" && email!="" && address!=""){
         var form_data=$("#company_form").serialize();
          $.ajax({
            url:"<?php echo base_url();?>company_update",
            data:form_data,
            method:"post",
            cache:false,
            success:function(response){
              var obj=JSON.parse(response);
              if(obj.result=="success"){
              $("#exampleModal").modal('show');
              $(".modal-body").html("Successfully Updated");
              setTimeout(function() { $("#exampleModal").modal('hide'); }, 2000);
               }else{
               $("#exampleModal").modal('show');
              $(".modal-body").html("Something Went Wrong!!!");
              setTimeout(function() { $("#exampleModal").modal('hide'); }, 2000);
               }
            }
          })
       }else{
             $("#exampleModal").modal('show');
              $(".modal-body").html("Company Name and Address is Required !!!");
              setTimeout(function() { $("#exampleModal").modal('hide'); }, 2000);
       }


     }
</script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Response Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
</body>
</html>
