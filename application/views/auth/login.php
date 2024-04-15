<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo company_name();?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">
	
	<script src="<?= base_url().'assets/plugins/jquery/jquery.min.js' ?>"></script>
	<link rel="stylesheet" href="<?= base_url().'assets/toastr/toastr.css' ?>">
	<script src="<?= base_url().'assets/toastr/toastr.js' ?>"></script>
</head>
<body class="hold-transition login-page" >
<div class="login-box">
  <div class="login-logo">
    <img class="animation__shake" src="<?php echo base_url(logo());?>" alt="AdminLTELogo" width="357px;">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

		<form id="LoginForm" autocomplete="OFF">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Username" name="username">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-user"></span>
					</div>
				</div>
			</div>
			<div class="input-group mb-3">
				<input type="password" class="form-control" placeholder="Password" name="password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			<div class="icheck-primary">
				<input type="checkbox" id="remember">
				<label for="remember">Remember Me</label>
			</div>
			<button type="submit" class="btn btn-primary">Sign In</button>
		</form>
    </div>

 	  <!-- 
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
	  -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo base_url()?>ilium/ilium/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>ilium/ilium/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>ilium/ilium/assets/dist/js/adminlte.min.js"></script>

</body>
</html>
<script>
$("#LoginForm").on('submit',(function(e){
	e.preventDefault();
	var formData = new FormData($("#LoginForm")[0]);
	$.ajax({
		url: "<?= base_url().'loginCheck' ?>",
		type: "POST",
		data:  formData,
		dataType: "JSON",
		contentType: false,
		cache: false,
		processData:false,
		beforeSend: function() {
			$("#LoginForm [type='submit']").attr('disabled', true);
		},
		success: function(data)
		{
			if(data['status']=="Error"){
				toastr.error(data['msg']);
			}else{
				$("#LoginForm").html('<div class="alert alert-success">Login Processing !!!</div>');
				window.location.href=data['link'];
			}
		},
		complete: function(data) {
			$("#LoginForm [type='submit']").attr('disabled', false);
		},
	});
}));
</script>