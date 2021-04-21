<?php namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Repositories\AdminRepositories;

class Admin extends BaseController
{
	private $adminRepositories;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->adminRepositories = new AdminRepositories();
    }

    public function Login()
	{
		return $this->adminRepositories->loginPage();
	}
    public function loginProcess()
    {
        if (!$this->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string'
            ]
        )) {
            return redirect()->to('login')->
                   with('notification', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
        return $this->adminRepositories->adminLoginProcess($this->request);
    }
    public function getDashboard()
    {
        return $this->adminRepositories->getDashboardPage();
    }
    public function getlistAdmin()
    {
        return $this->adminRepositories->getlistAdminPage();
    }
    public function getaddadminPage()
    {
        return $this->adminRepositories->addAdminPage();
    }
    public function addadminProcess()
    {
        return $this->adminRepositories->addadminProcess($this->request);
    }
    public function geteditadminPage($id)
    {
        return $this->adminRepositories->geteditAdminPage($id);
    }
    public function updateAdminProcess()
    {
        return $this->adminRepositories->updateAdminProcess($this->request);
    }
    public function deleteAdminProcess($id)
    {
        return $this->adminRepositories->deleteAdmin($id);
    }
    public function getchangepasswordPage()
    {
        return $this->adminRepositories->getChangePassword();
    }
    public function changepasswordProcess()
    {
        if (!$this->validate(
            [
                'old_password' => 'required|string',
                'new_password' => 'required|string',
                'new_password_con' => 'required|matches[new_password]',
            ]
        )) {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> ข้อมูลของคุณไม่ถูกต้อง..');
        } else {
            return $this->adminRepositories->changePasswordProcess($this->request);
        }
    }
    public function Logout()
    {
        return $this->adminRepositories->adminLogout();
    }
    public function getprovince()
    {
        return $this->adminRepositories->getProvince();
    }
    public function getamphur()
    {
        return $this->adminRepositories->getAmphur($this->request);
    }
///
    public function getPagememberlist()
    {
        return $this->adminRepositories->getPageListMembers();
    }
    public function getPageApproveMembers()
    {
        return $this->adminRepositories->getPageApproveMembers();
    }
    public function getPagememberHistory()
    {
        return $this->adminRepositories->getPageHistoryMember();
    }
    public function getPagememberBanList()
    {
        return $this->adminRepositories->getPageBanListMember();
    }
    public function getPageEditMember($id)
    {
        return $this->adminRepositories->getPageEditMember($id);

    }
    public function getMemberShowPage()
    {
        return $this->adminRepositories->getMemberShowPage($this->request);
    }
    public function updatememberProcess()
    {
        return $this->adminRepositories->updateMemberProcess($this->request);
    }
    public function approvememberProcess($id)
    {
        return $this->adminRepositories->approveMemberProcess($id);
    }
    public function banmemberProcess($id)
    {
        return $this->adminRepositories->banMemberProcess($id);
    }
    public function unbanmemberProcess($id)
    {
        return $this->adminRepositories->unbanMemberProcess($id);

    }
    public function deletememberProcess($id)
    {
        return $this->adminRepositories->deleteMemberProcess($id);
    }
    /////cmopany
    public function getPagecompanylist()
    {
        return $this->adminRepositories->getPageListCompanyall();
    }
    public function getPageApproveCompany()
    {
        return $this->adminRepositories->getPageApproveCompany();
    }
    public function getPagecompanyBanList()
    {
        return $this->adminRepositories->getPageBanList();
    }
    public function getPagecompanyHistory()
    {
        return $this->adminRepositories->getPageHistory();
    }
    public function getPageEditCompany($id)
    {
        return $this->adminRepositories->getPageEditCompany($id);
    }
    public function getCompanyShowPage()
    {
        return $this->adminRepositories->getPageListCompany($this->request);
    }
    public function updatecompanyProcess()
    {
        return $this->adminRepositories->updatecompanyProcess($this->request);
    }
    public function approvecompanyProcess($id)
    {
        return $this->adminRepositories->approvecompanyProcess($id);
    }
    public function bancompanyProcess($id)
    {
        return $this->adminRepositories->bancompanyProcess($id);
    }
    public function unbancompanyProcess($id)
    {
        return $this->adminRepositories->unbancompanyProcess($id);
    }
    public function deletecompanyProcess($id)
    {
        return $this->adminRepositories->deletecompanyProcess($id);
    }
///// university
    public function getPageuniversitylist()
    {
        return $this->adminRepositories->getPageListUniversity();
    }
    public function getPageApproveUniversity()
    {
        return $this->adminRepositories->getPageApproveUniversity();
    }
    public function getPageBanUniversityList()
    {
        return $this->adminRepositories->getPageBanUniversityList();
    }
    public function getPageHistoryUniversity()
    {
        return $this->adminRepositories->getPageHistoryUniversity();
    }
    public function getPageEditUniversity($id)
    {
        return $this->adminRepositories->getPageEditUniversity($id);
    }
    public function getUniversityShowPage()
    {
        return $this->adminRepositories->getUniversityShowPage($this->request);
    }
    public function updateUniversityProcess()
    {
        return $this->adminRepositories->updateUniversityProcess($this->request);
    }
    public function approveUniversityProcess($id)
    {
        return $this->adminRepositories->approveUniversityProcess($id);
    }
    public function banUniversityProcess($id)
    {
        return $this->adminRepositories->banUniversityProcess($id);
    }
    public function unbanUniversityProcess($id)
    {
        return $this->adminRepositories->unbanUniversityProcess($id);
    }
    public function deleteUniversityProcess($id)
    {
        return $this->adminRepositories->deleteUniversityProcess($id);
    }
    //// job
    public function getPageJoblist()
    {
        return $this->adminRepositories->getPageJob();
    }
    public function getPagebanJob()
    {
        return $this->adminRepositories->getPagebanJob();
    }
    public function getPageApproveJob()
    {
        return $this->adminRepositories->getPageApproveJob();
    }
    public function approvejobProcess($id)
    {
        return $this->adminRepositories->approvejobProcess($id);
    }
    public function banjobProcess($id)
    {
        return $this->adminRepositories->banjobProcess($id);
    }
    public function deleteJobProcess($id)
    {
        return $this->adminRepositories->deletejobProcess($id);
    }
    public function getPageHistoryJob()
    {
        return $this->adminRepositories->getPageHistoryJob();
    }
    public function getJobShowPage()
    {
        return $this->adminRepositories->getJobShowPage($this->request);
    }
///// 
    public function getPageEventlist()
    {
        return $this->adminRepositories->getPageEvent();
    }
    public function getPagebanEvent()
    {
        return $this->adminRepositories->getPagebanEvent();
    }
    public function getPageApproveEvent()
    {
        return $this->adminRepositories->getPageApproveEvent();
    }
    public function approveEentProcess($id)
    {
        return $this->adminRepositories->approveEventProcess($id);
    }
    public function banEventProcess($id)
    {
        return $this->adminRepositories->banEventProcess($id);
    }
    public function deleteEventProcess($id)
    {
        return $this->adminRepositories->deleteEventProcess($id);
    }
    public function getPageHistoryEvent()
    {
        return $this->adminRepositories->getPageHistoryEvent();
    }
    public function getEventShowPage()
    {
        return $this->adminRepositories->getEventShowPage($this->request);
    }



}
