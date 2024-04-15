<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url(logo());?>" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	
	      <li class="nav-item">
           <a href="javascript:;" align="center" class="nav-link user-profile dropdown-toggle" data-toggle="modal" data-target=".companypop" aria-expanded="false" style="color: black;">
              <i class="fas fa-university"></i>  <?php echo get_defaultcompany();?>
           
           </a>                               
        </li>
		
		<li class="nav-item">
             <a href="javascript:;" class="nav-link user-profile finyear dropdown-toggle" data-toggle="modal" data-target=".financepop" aria-expanded="false" style="color: black;">
                <i class="fas fa-calendar-alt"></i> &nbsp; Financial Year : <?php echo get_defaultyear();?>
           
           </a>                               
        </li>
	 
		<li class="nav-item">
			<a class="nav-link"  href="<?php echo base_url('logout');?>" title="Signout">
				<i class="fas fa-sign-out-alt"></i>  Logout
			</a>
		</li>
		
		                  
    </ul>
  </nav>
  <!-- /.navbar -->
<!--- Company List--->
						<div class="modal fade bs-example-modal-sm companypop" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" style='width:350px'>
                                        <div class="modal-content">

                                            <div class="modal-header"  style='background-color:#2A3F54'>
											    <h4 class="modal-title" id="myModalLabel2" style='color:#fff'>Company Names</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='color:#fff;opacity:1 !important;'><span aria-hidden="true" style='color:#fff'>×</span>
                                                </button>
                                                
                                            </div>
                                            <div class="modal-body">
                                               <div class="row">

                       
                            <div class="x_panel" style='border:0px'>
										<?php
										$company = get_companylist();
										if(!empty($company)){
											foreach($company as $tmp){
										?> 
										<div>
										<input type=radio value='<?php echo $tmp->company_id?>' name='companychange' id='companychange_<?php echo $tmp->company_id?>' class='companychange' <?php echo $tmp->comp==1?"checked":"";?>>
										&nbsp;<span id='companytxt_<?php echo $tmp->company_id?>'><?php echo $tmp->name;?></span><br>
										</div>
										<?php
											}						
										}
										?>

                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                           <!--- Company List--->
						   
                            <!--- Financial year List--->
						<div class="modal fade bs-example-modal-sm financepop" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm" style='width:350px'>
                                        <div class="modal-content">

                                            <div class="modal-header" style='background-color:#2A3F54'>
											
											    <h4 class="modal-title" id="myModalLabel2" style='color:#fff'>Financial Year</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='color:#fff;opacity:1 !important;'><span aria-hidden="true" style='color:#fff'>×</span>
                                                </button>
                                                
                                            </div>
                                            <div class="modal-body">
                                               <div class="row">

                       
                            <div class="x_panel" style='border:0px'>
										<?php
										$year = get_financialyear_list();
										if(!empty($year)){
											foreach($year as $tmp){
										?> 
										<div>
										<input type=radio value='<?php echo $tmp->yearid?>' name='yearchange' class='yearchange' id='yearchange_<?php echo $tmp->yearid?>' <?php echo $tmp->comp==1?"checked":"";?>>&nbsp;<span id='yeartext_<?php echo $tmp->yearid?>'><?php echo date("M Y",strtotime($tmp->startdate)).' - '.date("M Y",strtotime($tmp->enddate));?></span><br>
										</div>
										<?php
											}						
										}
										?>

                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                           <!--- Financial year List--->
						   
						   
						   
<script>
	$(document).ready(function(){
	
		$(".companychange").change(function(){		
				var v = $(this).attr("id");
				v = v.split("_");
				txt = $("#companytxt_"+v[1]).html();
		
				e = confirm("Do you want to change the company to "+txt+"?");			
			    if(e){
				
					$.ajax({
					  url: "<?php echo base_url();?>web/update_default_company",
					  dataType: "json",
					  type:"POST",	  
					  data: {
						company_id: $(this).val()
					  },
					  success: function( data ) {
						 window.location.href = '<?php echo base_url()?>web/dashboard';
					  }
					});
				
				}
		});
		
		$(".yearchange").change(function(){
			    
			    var v = $(this).attr("id");
			    v = v.split("_");
			    txt = $("#yeartext_"+v[1]).html();
			    
			    e = confirm("Do you want to change the financial year to "+txt+"?");			
			    if(e){
				$.ajax({
				  url: "<?php echo base_url();?>web/update_default_year",
				  dataType: "json",
				  type:"POST",	  
				  data: {
					yearid: $(this).val()
				  },
				  success: function( data ) {
					 window.location.href = '<?php echo base_url()?>web/dashboard';
				  }
				});
			    }
		});
		
		<?php if(trim(get_defaultyear()) == '-'){ ?>
					$('.financepop').modal({
						show: 'true'
					}); 
		<?php } ?>
	});
</script>    



<script>
$(document).ready(function(){
	
	
	$("body").keypress(function(e){	
		  if($("#calcbox").is(":focus")){
			  if(e.which == 43){
				$("#plus").trigger("click");
				return false;
			  }else if(e.which == 45){
				$("#minus").trigger("click");
				return false;
			  }else if(e.which == 42){
				$("#times").trigger("click");
				return false;
			  }else if(e.which == 37){
				$("#div").trigger("click");
				return false;
			  }else if(e.which == 13){
				$("#doit").trigger("click");
				return false;
			  }else if(e.which == 0){
				$("#clear").trigger("click");
				return false;
			  }
		  }
	});

	$("#calclink").click(function(){
		$("#calcbox").focus();
	});
	
	$(".calclose").click(function(){
		$("#calcbox").val('');
	});

});
</script>  						   
						   
						   
						   
						  