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
            <h1 class="m-0 text-dark" id="emp-text">Add Employee</h1>
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
                <h3 class="card-title">Employee Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="employee_form">
                <input type="hidden" name="form_status" id="form_status" value="add">
                <input type="hidden" name="employee_id" id="employee_id">
                <input type="hidden" name="company_id" id="company_id" value="<?php echo $this->session->userdata('company_id');?>">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                       <div class="form-group">
                        <label for="fname">Employee Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Name">
                         <span id="name_error" class="text-danger"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
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
                          <label for="exampleInputPassword1">Mobile No.</label>
                          <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter Mobile No." minlength="10" onkeyup="mobile_validation();">
                          <span id="mobile_no_error" class="text-danger"></span>
                        </div>
                      </div>
                 </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   <button type="button" class="btn btn-primary" onclick="add_update_employee_data();">Submit</button>
                </div>
              </form>
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
         if(localStorage.employee_id!=""){
            get_edit_data(localStorage.employee_id);
            $("#emp-text").html("Update Employee");
         }
      });

       function get_edit_data(employee_id){
          $.ajax({
          url:"<?php echo base_url(); ?>employee_edit_data",
          data:"employee_id="+employee_id,
          method:"post",
          cache:false,
          success:function(result){
            var obj=JSON.parse(result);
              $.each(obj.data, function (i) {
                      $.each(obj.data[i], function (key, val) { 
                          $("#"+key).val(val);
                      });
                  });
              $("#form_status").val("edit");
           }
        })
     }


     function add_update_employee_data(){
  var name=$("#name").val();
  var email=$("#email").val();
  var address=$("#address").val();
  var mobile_no=$("#mobile_no").val();

  if(name==""){
    $("#name_error").html("Name is Required!!!");
  }else{
    $("#name_error").html("");
  }

  if(email==""){
    $("#email_error").html("Email is Required!!!");
  }else{
    $("#email_error").html("");
  }

  if(address==""){
    $("#address_error").html("Address is Required!!!");
  }else{
    $("#address_error").html("");
  }

  var mobile_no=mobile_validation();
 
      
          if(name!="" && email!="" && address!="" && mobile_no==true){
         var form_data=$("#employee_form").serialize();
          $.ajax({
            url:"<?php echo base_url();?>add_update_employee_data",
            data:form_data,
            method:"post",
            cache:false,
            success:function(response){
              var obj=JSON.parse(response);
              if(obj.result=="success"){
                localStorage.employee_id="";
              $('#employee_form')[0].reset();
              $("#form_status").val("add");
              $("#emp-text").html("Add Employee");

              $("#exampleModal").modal('show');
              $(".modal-body").html("Successfully Saved");
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
              $(".modal-body").html("All fields are Required !!!");
              setTimeout(function() { $("#exampleModal").modal('hide'); }, 2000);
       }


     }



     /////////////Mobile No validation//////////
        function mobile_validation() {
          var flag=false;
        var mobile1 = $("#mobile_no").val();
      
        // Allow A-Z, a-z, 0-9 .
        var pattern = /^[0-9]+$/;
        var mera_pattern=pattern.test(mobile1);

        if(mera_pattern==false){
          flag=false;
                $("#mobile_no").val("");
                $("#mobile_no").focus();
                $("#mobile_no_error").html("Invalid Mobile No.");
        }else{
          var six= mobile1.startsWith("6");
          var seven = mobile1.startsWith("7");
          var eight = mobile1.startsWith("8");
          var nine = mobile1.startsWith("9");
          
          var ok_number=0;
          if(six==true){
                ok_number=1;
          }else if(seven==true){
                ok_number=1;
          }else if(eight==true){
                ok_number=1;
          }else if(nine==true){
                ok_number=1;
          }else{
              ok_number=0;
          }
          
          if(ok_number==0){
                $("#mobile_no_error").html("Invalid No. Entered !!!");
                $("#mobile_no").val("");
                $("#mobile_no").focus();
                flag=false;
             }else{
/////////////////Length checking///////////
                  if(mobile1.length==10){
                     $("#mobile_no_error").html("");
                     flag=true;
                 }else{
                     $("#mobile_no_error").html("please type 10 digit");
                    $("#mobile_no").focus();
                    flag=false;
                 }

             }
          }
          return flag;
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
