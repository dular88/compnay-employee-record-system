<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php include "admin_css.php";?>
 <!-- Datatable CDN css ------------->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
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
            <h1 class="m-0 text-dark">Employee List</h1>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="data_list">

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
 <!-- Datatable CDN js ------------->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
       employee_list_data();
      });

         function employee_list_data(){
            $.ajax({
            url:"<?php echo base_url();?>employee_list_data",
            data:"list=list",
            method:"post",
            cache:false,
            success:function(response){
              var obj=JSON.parse(response);
              if(obj.result=="success"){
               
               $("#data_list").html(obj.data);
               $("#my_table").DataTable();
               }
            }
          })
     }

     function edit_data(employee_id){
        localStorage.employee_id=employee_id;
        window.location.href="<?php echo base_url();?>add_employee";
     }

           function delete_employee_data(){
               $.ajax({
                url:"<?php echo base_url(); ?>delete_employee_data",
                data:"employee_id="+localStorage.id,
                method:"post",
                cache:false,
                success:function(result){
                  var obj=JSON.parse(result);
                    if(obj.result=="success"){
                       $("#exampleModal").modal('hide');

                     alert("Successfully Delete Employee Record.")
                      localStorage.id="";
                      $("#data_list").html("");
                      employee_list_data();
                    }
                 }
              })
            }

        function show_modal(employee_id){
            localStorage.id=employee_id;
            $("#exampleModal").modal('show');
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
        Are you sure to Delete Employee Record ???
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="delete_employee_data();">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
