<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "css.php"; ?>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo base_url();?>"><b><?php echo PROJECT_NAME; ?></b></a>
    <div class="alert alert-success" role="alert">
	 Successfully Registered
	</div>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new Company</p>

      <form id="reg_form">
     	<input type="hidden" name="form_status" value="add">
        <div class="form-group mb-3">
          <input type="text" class="form-control" placeholder="Company Name" name="company_name" id="company_name">
          <span id="company_name_error" class="text-danger"></span>
        </div>
        <div class="form-group mb-3">
          <input type="text" name="email" id="email" class="form-control" placeholder="Enter Company Email">
          <span id="email_error" class="text-danger"></span>
        </div>
        <div class="form-group mb-3">
          <textarea name="address" id="address" class="form-control" placeholder="Enter Company Address"></textarea>
          <span id="address_error" class="text-danger"></span>
        </div>
        <div class="form-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter Company Password">
          <span id="password_error" class="text-danger"></span>
        </div> 
       
        <div class="row">
          <div class="col-8">
          	<a href="<?php echo base_url();?>login" class="text-center">I already have a membership</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" class="btn btn-primary btn-block" onclick="register();">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

	<?php include "js.php"; ?>
	<script type="text/javascript">
		$(document).ready(function () {
		  $(".alert").hide();
		});

		function register(){
			var company_name=$("#company_name").val();
			var email=$("#email").val();
			var address=$("#address").val();
			var password=$("#password").val();
			if(company_name==""){
				$("#company_name_error").html("Company Name is Required !!!");
			}else{
				$("#company_name_error").html("");
			}

			if(email==""){
				$("#email_error").html("Email is Required !!!");
			}else{
				$("#email_error").html("");
			}

			if(address==""){
				$("#address_error").html("Address is Required !!!");
			}else{
				$("#address_error").html("");
			}


			if(password==""){
				$("#password_error").html("Password is Required !!!");
			}else{
				$("#password_error").html("");
			}

			if(company_name!="" && email!="" && address!="" && password!=""){
				var data=$("#reg_form").serialize();
				 $.ajax({
	                url:"<?php echo base_url(); ?>company_add",
	                data:data,
	                method:"post",
	                cache:false,
	                success:function(result){
	                  var obj=JSON.parse(result);
	                    if(obj.result=="success"){
	                      $(".alert").show();
							setTimeout(function() { $(".alert").hide(); }, 5000);
							$('#reg_form')[0].reset();
							$("#form_status").val("add");
	                    }else{
				              $("#email_error").html("Email is Already Exist !!!");
	                    }
	                 }
	              })
			}
			
		}
	</script>
</body>
</html>

