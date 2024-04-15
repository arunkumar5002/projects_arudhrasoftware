<?php $menu_user_id = $this->session->userdata('user_id'); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url() . 'dashboard' ?>" class="brand-link" style="text-align:center;background:#fff;">
		<img src="<?php echo base_url(logo()); ?>" alt="AdminLTE Logo" class="" style="opacity: .8;width: 235px;">
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->

		<?php if ($this->session->userdata('user_emp') == 1) { ?>
			<?php $user_details = $this->session->userdata('user_details'); ?>
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="<?= base_url() . 'uploads/employee_profile/' . $user_details->profile_image ?>" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="#" class="d-block"><?= $user_details->employeename ?></a>
				</div>
			</div>
		<?php } ?>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

				<li class="nav-item">
					<a href="<?= base_url() . 'dashboard' ?>" class="nav-link">
						<i class="fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<!-- First -->
				<?php
				$val = get_role_permission_list(11);
				if (!empty($val)) {
				?>
					<li class="nav-item">
						<a href="<?= base_url() . 'users_master' ?>" class="nav-link">
							<i class="fas fa-user-cog"></i>
							<p>User Access </p>
						</a>
					</li>
				<?php } ?>

				<?php
				$val = get_role_permission_list(2);
				if (!empty($val)) {
				?>
					<li class="nav-item">
						<a href="<?= base_url() . 'settings' ?>" class="nav-link">
							<i class="fas fa-cogs"></i>
							<p>Configuration</p>
						</a>
					</li>
				<?php } ?>

				<!-- Last -->

				<!-- HR Start  -->

				<?php
				$val = get_role_permission_list(1);
				if (!empty($val)) {
				?>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fas fa-users"></i>
							<p>HR</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() . 'employee_master' ?>" class="nav-link ">
									<i class="far fa-circle nav-icon"></i>
									<p>Employee Master</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() . 'attendance' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Attendance Master</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() . 'view_attendance_report' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p> Attendance List</p>
								</a>
							</li>


							<!--<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/salary_master" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Salary Master</p>
								</a>
							</li>-->
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/payslip_generator" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Payslip Generator</p>
								</a>
							</li>
							<!--<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/levy_master" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Levy Master </p>
								</a>
							</li>-->
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/salary_slip" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Salary Slip </p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/pay_rol" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p> Payroll </p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/salary_sheet" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Salary Sheet </p>
								</a>
							</li>
							<!--<li class="nav-item">
				<a href="<?php echo base_url() ?>Hr/leave_category" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Leave category </p>
				</a>
			</li>-->
							<!--<li class="nav-item">
                <a href="<?php echo base_url() ?>Hr/leave_management_list" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Leave Management </p>
                </a>
            </li>-->
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Perfomance/employee_perform_list" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Employee Performance </p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?php echo base_url() ?>Hr/holidays" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p> Holidays </p>
								</a>
							</li>
						</ul>
					</li>
				<?php } ?>

				<!-- HR End  -->

				<!-- Inventory Master Starts  -->

				<?php
				$val = get_role_permission_list(5);
				if (!empty($val)) {
				?>

					<li class="nav-item ">
						<a href="#" class="nav-link">
							<i class="fas fa-money-check-alt"></i>
							<p> Inventory Master</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() ?>web/newmaster" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Item Master </p>
								</a>
							</li>
							<!--<li class="nav-item">
								<a href="<?php echo base_url() ?>Accounts/new_closing_stock_list" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Closing Stock</p>
								</a>
							</li> -->

							
						</ul>
					</li>
				<?php } ?>

				<!-- Inventory Master End  -->

				<!-- Purchase Start -->

				<?php
				$val = get_role_permission_list(7);
				if (!empty($val)) {
				?>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fas fa-suitcase"></i>
							<p>Purchase</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Purchase/purchasequote" class="nav-link ">
									<i class="far fa-circle nav-icon"></i>
									<p>Purchase Quote</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Purchase/purchaseorder" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Purchase Order</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?php echo base_url() ?>Purchase/purchaseinvoice" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Purchase Invoice</p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="<?= base_url() . 'purchasevouchers' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Supplier Payment </p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Accounts/grns" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>GRN</p>
								</a>
							</li>


						</ul>
					</li>

				<?php } ?>

				<!--  Purchase End  -->


				<!--  Sales End  -->

				<?php
				$val = get_role_permission_list(8);
				if (!empty($val)) {
				?>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fas fa-cart-arrow-down"></i>
							<p> Sales</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">

								<a href="<?= base_url() . 'quotations' ?>" class="nav-link ">

									<i class="far fa-circle nav-icon"></i>

									<p>Sales Quote</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() . 'orders' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Sales Order</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?= base_url() . 'invoices' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Sales Invoice</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() . 'quickinvoicelist' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Quick Sales Invoice</p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="<?= base_url() . 'salesvouchers' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Customer Receipt </p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="<?= base_url() . 'creaditnote' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Credit Note </p>
								</a>
							</li>
							
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Accounts/gdn" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>GDN <p style="font-size:13px;">(Goods Dispatch Notes)</p>
									</p>
								</a>
							</li>

						</ul>
					</li>
				<?php } ?>

				<!--  Sales End  -->

				<!--  Finance Start  -->

				<?php
				$val = get_role_permission_list(3);
				if (!empty($val)) {
				?>
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fas fa-building"></i>
							<p> Finance</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() . 'accountname' ?>" class="nav-link ">
									<i class="far fa-circle nav-icon"></i>
									<p>Chart Of Accounts</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() . 'vouchers' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Voucher</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?= base_url() . 'balancesheet' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Balance Sheet </p>
								</a>
							</li>


							<li class="nav-item">
								<a href="<?= base_url() . 'profitandloss' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									
									<p>Profit & Loss</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?= base_url() . 'ledger' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>General Ledger</p>
								</a>
							</li>

							<!-- <li class="nav-item">
								<a href="" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>General Ledger - Subcategory</p>
								</a>
							</li> -->

							<li class="nav-item">
								<a href="<?= base_url() .'trialbalance' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Trial Balance</p>
								</a>
							</li>

							<!-- <li class="nav-item">
								<a href="" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>GST Form 5 Return</p>
								</a>
							</li> -->


						</ul>
					</li>
				<?php } ?>

				<!--  Finance End  -->


				<!--  Bank Reconcilliation Start 

				<?php
				$val = get_role_permission_list(4);
				if (!empty($val)) {
				?>


					<li class="nav-item ">
						<a href="#" class="nav-link">
							<i class="fas fa-university"></i>
							<p> Bank Reconcilliation</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Bank/bank_form" class="nav-link ">
									<i class="far fa-circle nav-icon"></i>
									<p>Bank Entries</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() ?>Bank/bank_entries_upload" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Bank Entries Upload</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?php echo base_url() ?>Bank/Bank_Entries_Final" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Bank Entries Final</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="<?php echo base_url() ?>Bank/Bank_Entries_View" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Bank Entries View</p>
								</a>
							</li>

						</ul>
					</li>
				<?php } ?>   -->

				<!--  Bank Reconcilliation End  -->


				<!--  Start  -->

				<?php if ($this->session->userdata('user_emp') == 1) { ?>
					<li class="nav-item">
						<a href="<?= base_url() . 'leave_request_master' ?>" class="nav-link">
							<i class="far fa-circle"></i>
							<p>Leave Request Master</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url() . 'employee_profile' ?>" class="nav-link">
							<i class="far fa-circle"></i>
							<p>Profile</p>
						</a>
					</li>
				<?php } else { ?>

					<!--  End  -->







					<?php
					$val = get_role_permission_list(6);
					if (!empty($val)) {
					?>

						<!-- <li class="nav-item">
						<a href="#" class="nav-link">
							
 
 
<i class="fas fa-money-bill-alt"></i>
							<p> Aging Schedule</p>
							<i class="right fas fa-angle-left"></i>
						</a>
					<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aging - Invoice - Sales </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aging - Invoice - Purchase </p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aging - Voucher - Purchase </p>
                </a>
              </li>
			  
			  <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aging - Voucher - Sales </p>
                </a>
              </li>
			  
</ul>
</li> -->
					<?php } ?>




					<?php
					$val = get_role_permission_list(9);
					if (!empty($val)) {
					?>

						<!--  <li class="nav-item">
						<a href="#" class="nav-link">
				<i class="fas fa-newspaper"></i>
							<p> Reports</p>
							<i class="right fas fa-angle-left"></i>
						</a>
					<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Invoice</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quick Sales Invoice</p>
                </a>
              </li>
			  
			  
			  </ul>
			  </li> -->
					<?php } ?>
					<?php
					$val = get_role_permission_list(10);
					if (!empty($val)) {
					?>

						<!-- <li class="nav-item">
						<a href="#" class="nav-link">
					<i class="fas fa-bezier-curve"></i>
							<p> Logistics</p>
							<i class="right fas fa-angle-left"></i>
						</a>
					<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Followup </p>
                </a>
              </li>
			  </ul>
			  </li>    -->
					<?php } ?>

					<?php
					$val = get_role_permission_list(12);
					if (!empty($val)) {
					?>

						<li class="nav-item">
							<a href="" class="nav-link">
								<i class="far fa-calendar-alt"></i>
								<p>Leave Management</p>
								<i class="right fas fa-angle-left"></i>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= base_url() . 'leave_approve_master' ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p> Leave Approval</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?= base_url() . 'leave_request_master' ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Leave Request</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?php echo base_url() ?>LeaveRequestMaster/leave_settings" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Leave Settings</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?= base_url() . 'leave_setting' ?>" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Holidays Settings</p>
									</a>
								</li>

							</ul>
						</li>
						
									<li class="nav-item">
						<a href="" class="nav-link">
							<i class="fas fa-landmark"></i>
							<p>Loan Management</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?= base_url() . 'loan_master' ?>" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>Loan Master</p>
								</a>
							</li>


						</ul>
					</li>
					
					
					<li class="nav-item">
						<a href="" class="nav-link">
							<i class="fas fa-user"></i>
							<p> Contact</p>
							<i class="right fas fa-angle-left"></i>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="<?php echo base_url()?>web/contact" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p> Contact</p>
								</a>
							</li>


						</ul>
					</li>






					<?php } ?>


		

				<?php } ?>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>