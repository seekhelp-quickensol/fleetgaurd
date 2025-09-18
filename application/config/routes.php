<?php

defined('BASEPATH') or exit('No direct script access allowed');





$route['default_controller'] = 'Welcome/login';

$route['login'] = 'Welcome/login';



$route['index'] = "admin/Admin_controller/index";

$route['logout'] = "admin/Admin_controller/logout";



$route['delete/(:any)/(:any)'] = "admin/Admin_controller/delete/$1";



$route['inactive/(:any)/(:any)'] = "admin/Admin_controller/inactive/$1";



$route['active/(:any)/(:any)'] = "admin/Admin_controller/active/$1";

// master

$route['tabs'] = "admin/Admin_controller/tabs";

$route['master'] = "admin/Admin_controller/master";

$route['machine'] = "admin/Admin_controller/machine";

// 23-5-25

$route['site'] = "admin/Admin_controller/site";

$route['site/(:any)'] = "admin/Admin_controller/site/$1";





$route['type-of-good'] = "admin/Admin_controller/type_of_good";

$route['type-of-good/(:any)'] = "admin/Admin_controller/type_of_good/$1";

$route['add-plant'] = "admin/Admin_controller/add_plant";

$route['add-plant/(:any)'] = "admin/Admin_controller/add_plant/$1";

$route['add-workshop'] = "admin/Admin_controller/add_workshop";

$route['add-workshop/(:any)'] = "admin/Admin_controller/add_workshop/$1";

$route['add-type-item'] = "admin/Admin_controller/add_type_item";

$route['add-type-item/(:any)'] = "admin/Admin_controller/add_type_item/$1";

$route['add-udm'] = "admin/Admin_controller/add_udm";

$route['add-udm/(:any)'] = "admin/Admin_controller/add_udm/$1";



$route['add-bom'] = "admin/Admin_controller/add_bom";

$route['add-bom/(:any)'] = "admin/Admin_controller/add_bom/$1";

$route['bom-list'] = "admin/Admin_controller/bom_list";

$route['upload-bom'] = "admin/Admin_controller/upload_bom";



$route['designation-management'] = "admin/Admin_controller/designation_management";

$route['designation-management/(:any)'] = "admin/Admin_controller/designation_management/$1";

$route['deparment-management'] = "admin/Admin_controller/deparment_management";

$route['deparment-management/(:any)'] = "admin/Admin_controller/deparment_management/$1";


$route['add-customer'] = "admin/Admin_controller/add_customer";

$route['add-user'] = "admin/Admin_controller/add_user";

$route['add-user/(:any)'] = "admin/Admin_controller/add_user/$1";



// jayesh 26-5-25

$route['supplier'] = "admin/Admin_controller/supplier";

$route['supplier/(:any)'] = "admin/Admin_controller/supplier/$1";

$route['add-item'] = "admin/Admin_controller/add_item";

$route['add-item/(:any)'] = "admin/Admin_controller/add_item/$1";

$route['add-line-master'] = "admin/Admin_controller/add_line_master";

$route['add-line-master/(:any)'] = "admin/Admin_controller/add_line_master/$1";

$route['add-part-master'] = "admin/Admin_controller/add_part_master";

$route['add-part-master/(:any)'] = "admin/Admin_controller/add_part_master/$1";

$route['create-report'] = "admin/Admin_controller/create_report";

$route['uploaded-report-review/(:any)'] = "admin/Admin_controller/uploaded_report_review/$1";

$route['bpr-mts-shortage-report/(:any)'] = "admin/Admin_controller/bpr_mts_shortage_report/$1";

$route['bpr-mts-shortage-report/(:any)/(:any)'] = "admin/Admin_controller/bpr_mts_shortage_report/$1";

$route['export_bpr_mts_shortage_report/(:any)'] = "admin/Admin_controller/export_bpr_mts_shortage_report/$1";

$route['bpr-work-order'] = "admin/Admin_controller/bpr_work_order";
// $route['bpr-work-order/(:any)'] = "admin/Admin_controller/bpr_work_order/$1";
// $route['bpr-work-order/(:any)/(:any)'] = "admin/Admin_controller/bpr_work_order/$1";

$route['generated-report'] = "admin/Admin_controller/generated_report";

$route['bom-review'] = "admin/Admin_controller/bom_review";

$route['order-review/(:any)'] = "admin/Admin_controller/order_review/$1";

$route['mto-order-review/(:any)'] = "admin/Admin_controller/mto_order_review/$1";

$route['inventory-review/(:any)'] = "admin/Admin_controller/inventory_review/$1";

$route['trigger-report-review/(:any)'] = "admin/Admin_controller/trigger_report_review/$1";

$route['report-list'] = "admin/Admin_controller/report_list";

$route['add-fg'] = "admin/Admin_controller/add_fg";

$route['add-fg/(:any)'] = "admin/Admin_controller/add_fg/$1";





$route['todays-bpr-mts-report'] = "admin/Admin_controller/todays_bpr_mts_report";

$route['todays-bpr-work-report'] = "admin/Admin_controller/todays_bpr_work_report";

$route['bom-upload-history'] = "admin/Admin_controller/bom_upload_history";

$route['bpr-mto-shortage-report/(:any)'] = "admin/Admin_controller/bpr_mto_shortage_report/$1";
$route['bpr-mto-shortage-report/(:any)/(:any)'] = "admin/Admin_controller/bpr_mto_shortage_report/$1";

$route['bpr-shortage-summary-report/(:any)'] = "admin/Admin_controller/bpr_shortage_summary_report/$1";
$route['bpr-shortage-summary-report/(:any)/(:any)'] = "admin/Admin_controller/bpr_shortage_summary_report/$1";
$route['export-bpr-shortage-summary-report/(:any)'] = "admin/Admin_controller/export_bpr_shortage_summary_report/$1";

$route['export_bpr_mto_shortage_report/(:any)'] = "admin/Admin_controller/export_bpr_mto_shortage_report/$1";






$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

