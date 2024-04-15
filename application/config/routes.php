<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'web';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['loginCheck'] = "auth/loginCheck";
$route['logout'] = "auth/logout";
$route['dashboard'] = "web/dashboard";
$route['settings'] 	= "web/settings";

//Settings - Attendance Master
$route['attendance_master'] 		= "Company/attendance_master";
$route['add_edit_leave_category'] 	= "Company/submit_leave_category";
$route['list_leave_category'] 		= "Company/list_leave_category";
$route['delete_leave_category'] 	= "Company/delete_leave_category";

//Settings - Salary Master
$route['salary_master'] 				= "Company/salary_master";
$route['add_edit_salary_earninings'] 	= "Company/submit_salary_earninings";
$route['list_salary_earninings'] 		= "Company/list_salary_earninings";
$route['delete_salary_earninings'] 		= "Company/delete_salary_earninings";
$route['add_edit_salary_deductions'] 	= "Company/submit_salary_deductions";
$route['list_salary_deductions'] 		= "Company/list_salary_deductions";
$route['delete_salary_deductions'] 		= "Company/delete_salary_deductions";

// Settings Designation Master
$route['designation_master'] 				= "Company/designation_master";
$route['add_edit_designation_category'] 	= "Company/submit_designation_category";
$route['list_designation_category'] 		= "Company/list_designation_category";
$route['delete_designation_category'] 		= "Company/delete_designation_category";

// Settings Department - master
$route['department_master'] 			= "Company/department_master";
$route['add_edit_department_category'] 	= "Company/submit_department_category";
$route['list_department_category'] 		= "Company/list_department_category";
$route['delete_department_category'] 	= "Company/delete_department_category";

//HR - Employee Master
$route['employee_master'] 				= "EmployeeMaster/index";
$route['list_employee_master']          = "EmployeeMaster/list_employee_master";
$route['add_employee'] 					= "EmployeeMaster/add_employee";
$route['edit_employee/(:any)'] 			= "EmployeeMaster/edit_employee/$1";
$route['add_edit_employee_details'] 	= "EmployeeMaster/add_edit_employee_details";
$route['update_passport_details'] 		= "EmployeeMaster/update_passport_details";
$route['update_resident_details'] 		= "EmployeeMaster/update_resident_details";
$route['update_cpr_details'] 			= "EmployeeMaster/update_cpr_details";
$route['update_bank_details'] 			= "EmployeeMaster/update_bank_details";
$route['update_salary_details'] 		= "EmployeeMaster/update_salary_details";
$route['list_certificate_details'] 		= "EmployeeMaster/list_certificate_details";
$route['add_certificate_details'] 		= "EmployeeMaster/add_certificate_details";
$route['add_employee_master_import']    = "EmployeeMaster/add_employee_master_import";
$route['employee_profile'] 				= "EmployeeMaster/employee_profile";
$route['all_employee_notification'] 	= "EmployeeMaster/all_employee_notification";
$route['delete_certificate'] 	= "EmployeeMaster/delete_certificate";
$route['delete_employee_category'] 		= "EmployeeMaster/delete_employee_category";

//HR - Attendance Master
$route['attendance'] 					= "AttendanceMaster/index";
$route['attendance/(:any)'] 			= "AttendanceMaster/employee_view/$1";
$route['add_attendance_import'] 		= "AttendanceMaster/submit_attendance_import";
$route['list_attendance_import'] 		= "AttendanceMaster/list_attendance_import";
$route['add_attendance_approve'] 		= "AttendanceMaster/submit_attendance_approve";
$route['list_attendance_approve'] 		= "AttendanceMaster/list_attendance_approve";
$route['view_attendance_report'] 		= "Attendance/attendance_master";

//HR - Leave Request Master
$route['leave_request_master'] 			= "LeaveRequestMaster/request_master";
$route['leave_approve_master'] 			= "LeaveRequestMaster/approve_master";
$route['add_edit_leave_request'] 		= "LeaveRequestMaster/submit_leave_request";
$route['list_leave_approve'] 			= "LeaveRequestMaster/list_leave_approve";
$route['list_leave_request'] 			= "LeaveRequestMaster/list_leave_request";
$route['delete_leave_request'] 			= "LeaveRequestMaster/delete_leave_request";
$route['approve_leave_request'] 		= "LeaveRequestMaster/approve_leave_request";
$route['reject_leave_request'] 			= "LeaveRequestMaster/reject_leave_request";

//HR - Leave Request Master
$route['payslip_generator'] 			= "Hr/payslip_generator";
$route['get_payslip_details'] 			= "Hr/get_payslip_details";
$route['get_salary_slip']               = "Hr/get_salary_slip";
$route['update_salary_slip']            = "Hr/update_salary_slip";
$route['add_salary_slip_form']          = "Hr/add_salary_slip_form";

//Company - Shift Timing Master
$route['shift_timing_master'] 				= "Company/shift_timing_master";
$route['add_edit_shift_timing_category'] 	= "Company/submit_shift_timing_category";
$route['list_shift_timing_category'] 		= "Company/list_shift_timing_category";
$route['delete_shift_timing_category'] 		= "Company/delete_shift_timing_category";

//Users
$route['users_master'] 			= "UserManagement/index";
$route['add_edit_users'] 		= "UserManagement/submit_users";
$route['list_users'] 			= "UserManagement/list_users";
$route['delete_user_category'] 	= "UserManagement/delete_user_category";
$route['add_edit_permission'] 	= "UserManagement/submit_permission";
$route['check_permission'] 	= "UserManagement/check_permission";

//Users - Account Type Master
$route['add_edit_user_account_type_category'] 	= "UserManagement/submit_user_account_type_category";
$route['list_user_account_type_category'] 		= "UserManagement/list_user_account_type_category";
$route['delete_user_account_type_category'] 	= "UserManagement/delete_user_account_type_category";

//Common Function
$route['get_user_account_type_list'] 			= "UserManagement/get_user_account_type_list";

// Hr loan- master
$route['loan_master'] 						= "Hr/loan_master";
$route['add_edit_loan_master'] 				= "Hr/submit_loan_master";
$route['list_loan_master'] 					= "Hr/list_loan_master";
$route['delete_loan_master'] 				= "Hr/delete_loan_master";
$route['loan_payment/(:any)'] 				= "Hr/loan_payment/$1";
$route['add_edit_loan_payment'] 			= "Hr/submit_payment";
$route['list_loan_details'] 				= "Hr/list_loan_details";



// Perfomance - Employee Perform 
$route['employee_perform'] 		= "Perfomance/employee_perform";
$route['employee_perform_views/(:any)'] 		= "Perfomance/employee_perform_views/$1";
$route['employee_perform_view/(:any)'] 	= "Perfomance/employee_perform_view/$1";
$route['update_employee_perform'] 		= "Perfomance/update_employee_perform";
$route['employee_perform_list'] 		= "Perfomance/employee_perform_list";
$route['add_edit_employee_perform'] 	= "Perfomance/submit_employee_perform";
$route['list_employee_perform'] 		= "Perfomance/list_employee_perform";
$route['delete_Employee_Perform'] 	= "Perfomance/delete_employee_perform";



// Company - VAT Master
$route['vat_master'] 	= "Company/vat_master";
$route['add_edit_vat'] 	= "Company/submit_vat";
$route['list_vat'] 		= "Company/list_vat";
$route['delete_vat'] 	= "Company/delete_vat";
$route['financialyear'] 			= "Company/financialyear";

// Banks

$route['add_edit_bank_form']  =  "Bank/save_bank_form";
$route['delete_bank_form']  =  "Bank/delete_bank_form";


// purchase 

$route['add_purchase_quote'] = "Purchase/save_purchase_quote";
$route['add_vendor'] = "Purchase/save_add_vendor";
$route['list_purchase_quote'] = "Purchase/list_purchase_quote";


// item master

$route['add_item'] = "Web/save_item";
$route['list_item_master'] = "Web/list_item_master";
$route['delete_item_master'] = "Web/delete_item_master";



//Holidays
$route['holidays'] 	= "Hr/holidays";
$route['holidays_submit'] = "Hr/holidays_submit";
$route['list_holidays'] = "hr/list_holidays";
$route['delete_value'] 	= "hr/delete_value";



//leaveRequestmaster - Leave Settings 
$route['leave_setting'] 			= "LeaveRequestMaster/leave_setting";
$route['add_edit_leave_setting'] 	= "LeaveRequestMaster/submit_leave_setting";
$route['list_leave_setting'] 	    = "LeaveRequestMaster/list_leave_setting";
$route['delete_leave_setting'] 	    = "LeaveRequestMaster/delete_leave_setting";


// closing stock 

$route['closing_submit'] 	= "Account/closing_closing_submit";
$route['list_closing_submit'] 	= "Account/list_closing_submit";


// Finance 

$route['accountname']     = "Web/accountsname";
$route['purchasevoucher'] = "Accounts/purchasevoucher";
$route['purchasevouchers'] = "Accounts/purchasevouchers";
$route['salesvouchers'] = "Accounts/customer_receipt";
$route['salesvoucher'] = "Accounts/salesvoucher";
$route['vouchers'] = "Accounts/vouchers";
$route['voucher'] = "Accounts/voucher";


// Production

$route['ilium_production'] = "production/ilium_production";
$route['stock'] = "Manufacturing/stock";

// Purchase quote
$route['list_purchase_quote'] = "purchase/purchasequote";
$route['purchasequotelist'] = "purchase/purchasequotelist";
$route['delete_purchasequote'] = "purchase/delete_purchasequote";

// purchase order
$route['list_purchase_quote'] = "purchase/purchasequote";
$route['purchaseorderlist'] = "purchase/purchaseorderlist";
$route['purchaseorderlist'] = "purchase/purchaseorderlist";
$route['delete_purchase_order'] = "purchase/delete_purchase_order";


// sales quote
$route['quotations'] = "Sales/quotations";

//Sales - Quotation
$route['orders'] = "Sales/orders";


//Sales - Invoices
$route['invoices'] = "Sales/invoices";
$route['creaditnote'] = "Sales/creaditnote";
$route['createcreditnote'] = "Sales/createcreditnote";
// grn 

$route['add_grn'] = "Web/save_grn";
$route['list_grn'] = "Web/list_grn";
$route['delete_grn'] = "Web/delete_grn";

//Quick Sales Invoice 

$route['quickinvoicelist'] = "Accounts/quickinvoicelist";


// Contacts

$route['web/contact'] = "web/contact";

//Reports

$route['ledger'] = 'Reports/ledger';
$route['profitandloss'] = 'Reports/profitandloss';
$route['balancesheet'] = 'Reports/balancesheet';
$route['trialbalance'] = 'Reports/trialbalance';