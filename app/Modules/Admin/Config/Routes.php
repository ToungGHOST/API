<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers'], function($subroutes){

	$subroutes->add('login', 'Admin::Login');
	$subroutes->post('process', 'Admin::loginProcess');
	$subroutes->get('dashboard', 'Admin::getDashboard');
	$subroutes->get('listadmin', 'Admin::getlistAdmin');
	$subroutes->get('addadmin', 'Admin::getaddadminPage');
	$subroutes->post('addadmin', 'Admin::addadminProcess');
	$subroutes->get('editadmin/(:num)', 'Admin::geteditadminPage/$1');
	$subroutes->post('editadmin/(:num)', 'Admin::updateAdminProcess');
	$subroutes->get('deleteadmin/(:num)', 'Admin::deleteAdminProcess/$1');
	$subroutes->get('changepassword', 'Admin::getchangepasswordPage');
	$subroutes->post('changepassword', 'Admin::changepasswordProcess');
	$subroutes->add('logout', 'Admin::Logout');
	$subroutes->get('getprovince', 'Admin::getprovince');
	$subroutes->post('getamphur', 'Admin::getamphur');
	////member 
	$subroutes->add('getlistmember', 'Admin::getPagememberlist');
	$subroutes->get('approvemember', 'Admin::getPageApproveMembers');
	$subroutes->get('banmember', 'Admin::getPagememberBanList');
	$subroutes->get('hismember', 'Admin::getPagememberHistory');
	$subroutes->get('editmember/(:num)', 'Admin::getPageEditMember/$1');
	$subroutes->post('getmember', 'Admin::getMemberShowPage');
	$subroutes->post('editmember/(:num)', 'Admin::updatememberProcess');
	$subroutes->get('approvemember/(:num)', 'Admin::approvememberProcess/$1');
	$subroutes->get('banmember/(:num)', 'Admin::banmemberProcess/$1');
	$subroutes->get('unbanmember/(:num)', 'Admin::unbanmemberProcess/$1');
	$subroutes->get('deletemember/(:num)', 'Admin::deletememberProcess/$1');
	////company
	$subroutes->add('getcompanylist', 'Admin::getPagecompanylist');
	$subroutes->get('approvecompany', 'Admin::getPageApproveCompany');
	$subroutes->get('bancompany', 'Admin::getPagecompanyBanList');
	$subroutes->get('hiscompany', 'Admin::getPagecompanyHistory');
	$subroutes->get('editcompany/(:num)', 'Admin::getPageEditCompany/$1');
	$subroutes->post('getcompany', 'Admin::getCompanyShowPage');
	$subroutes->post('editcompany/(:num)', 'Admin::updatecompanyProcess');
	$subroutes->get('approvecompany/(:num)', 'Admin::approvecompanyProcess/$1');
	$subroutes->get('bancompany/(:num)', 'Admin::bancompanyProcess/$1');
	$subroutes->get('unbancompany/(:num)', 'Admin::unbancompanyProcess/$1');
	$subroutes->get('deletecompany/(:num)', 'Admin::deletecompanyProcess/$1');
	/////university
	$subroutes->get('getuniversitylist', 'Admin::getPageuniversitylist');
	$subroutes->get('approveuniversity', 'Admin::getPageApproveUniversity');
	$subroutes->get('banuniversity', 'Admin::getPageBanUniversityList');
	$subroutes->get('hisuniversity', 'Admin::getPageHistoryUniversity');
	$subroutes->get('edituniversity/(:num)', 'Admin::getPageEditUniversity/$1');
	$subroutes->post('getUniversitylistshow', 'Admin::getUniversityShowPage');
	$subroutes->post('edituniversity/(:num)', 'Admin::updateUniversityProcess');
	$subroutes->get('approveuniversity/(:num)', 'Admin::approveUniversityProcess/$1');
	$subroutes->get('banuniversity/(:num)', 'Admin::banUniversityProcess/$1');
	$subroutes->get('unbanuniversity/(:num)', 'Admin::unbanuniversityProcess/$1');
	$subroutes->get('deleteuniversity/(:num)', 'Admin::deleteuniversityProcess/$1');
	///// Job
	$subroutes->get('getjoblist', 'Admin::getPageJoblist');
	$subroutes->get('banjob', 'Admin::getPagebanJob');
	$subroutes->get('approvejob', 'Admin::getPageApproveJob');
	$subroutes->get('hisjob', 'Admin::getPageHistoryJob');
	$subroutes->get('approvejob/(:num)', 'Admin::approvejobProcess/$1');
	$subroutes->get('unbanjob/(:num)', 'Admin::approvejobProcess/$1');
	$subroutes->get('deletejob/(:num)', 'Admin::deleteJobProcess/$1');
	$subroutes->get('banjob/(:num)', 'Admin::banjobProcess/$1');
	$subroutes->post('getjob', 'Admin::getJobShowPage');
	//// event
	$subroutes->get('geteventlist', 'Admin::getPageEventlist');
	$subroutes->get('banevent', 'Admin::getPagebanEvent');
	$subroutes->get('approveevent', 'Admin::getPageApproveEvent');
	$subroutes->get('hisevent', 'Admin::getPageHistoryEvent');
	$subroutes->get('approveevent/(:num)', 'Admin::approveEentProcess/$1');
	$subroutes->get('unbanevent/(:num)', 'Admin::approveEventProcess/$1');
	$subroutes->get('deleteevent/(:num)', 'Admin::deleteEventProcess/$1');
	$subroutes->get('banevent/(:num)', 'Admin::banEventProcess/$1');
	$subroutes->post('getevent', 'Admin::getEventShowPage');
	
});