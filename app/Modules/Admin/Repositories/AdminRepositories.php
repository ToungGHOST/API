<?php

namespace App\Modules\Admin\Repositories;

use App\Modules\Admin\Models\AdminModel;
use CodeIgniter\Controller;

class AdminRepositories extends Controller
{
    private $adminModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }
    public function loginPage()
    {
        $data = [
            'title' => 'Login',
            'view' => 'login/login-page',
        ];

        return view('template/layout-auth', $data);
    }
    public function adminLoginProcess($request)
    {
        $param = [
            'username' => $request->getVar('username'),
            'password' => $request->getVar('password'),
            'remember' => $request->getVar('remember')
        ];
        $isLogin = $this->adminModel->getAdminLogin($param);
        if (!empty($isLogin)) {
            return redirect()->to('dashboard')->setCookie('userInfo', $isLogin['token'], $isLogin['expire']);
        } else {
            return redirect()->to('login')->with('notification', '<b>ขออภัย!</b> อีเมลหรือรหัสผ่านไม่ถูกต้องโปรดลองอีกครั้ง..');
        }
    }
    public function getDashboardPage()
    {
        $data = [
            'title' => 'Dashboard Page',
            'view' => 'dashboard/dashboard',
        ];

        return view('template/layout', $data);
    }
    public function getlistAdminPage()
    {
        $adminList = $this->adminModel->getAdminList();
        $data = [
            'title' => 'Admin List',
            'view' => 'admin/admin-list',
            'data' => $adminList,
        ];
        return view('template/layout', $data);
    }
    public function addAdminPage()
    {

        $data = [
            'title' => 'Add Admin',
            'view' => 'admin/admin-add',
            'data' => ''
        ];
        return view('template/layout', $data);
    }
    public function addadminProcess($request)
    {
        $param = [
            'firstname' => $request->getVar('firstname'),
            'lastname' => $request->getVar('lastname'),
            'admin_email' => $request->getVar('email'),
            'username' => $request->getVar('username'),
            'password' => password_hash($request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $createAccount = $this->adminModel->createUserAccountadmin($param);
        if ($createAccount['resultCode'] == 200) {
            return redirect()->to(site_url() . 'admin/addadmin')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกเพิ่มเรียบร้อยแล้ว');
        } elseif ($createAccount['resultCode'] == 401) {
            return redirect()->to(site_url() . 'admin/addadmin')->with('notification-danger', '<b>ขออภัย!</b> มี Username นี้แล้ว.');
        }
    }
    public function geteditAdminPage($id)
    {
        $userInfo = $this->adminModel->getAdminById($id);
        $data = [
            'title' => 'Admin Edit',
            'view' => 'admin/admin-edit',
            'data' => $userInfo
        ];
        return view('template/layout', $data);
    }
    public function updateAdminProcess($request)
    {
        $id = $request->getVar('id');
        $newData = [
            'admin_email' => $request->getVar('email'),
            'firstname' => $request->getVar('firstname'),
            'lastname' => $request->getVar('lastname'),
        ];
        $updateUser =  $this->adminModel->updateAdmin($id, $newData);
        if ($updateUser['resultCode'] == 200) {
            return redirect()->to('')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->to('')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deleteAdmin($id)
    {
        $deleteUser =  $this->adminModel->deleteAdminById($id);

        if ($deleteUser['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getChangePassword()
    {
        $data = [
            'title' => 'Change Password',
            'view' => 'admin/admin-changepassword',
            'data' => ""
        ];
        return view('template/layout', $data);
    }
    public function changePasswordProcess($request)
    {
        $old_password = $request->getVar('old_password');
        $new_password = $request->getVar('new_password');
        $adminAuth = $this->adminModel->getAdminAuth();
        $dataUser = $adminAuth['data'];
        $idUser = $dataUser['id'];
        if (!password_verify($old_password, $dataUser['password'])) {
            return redirect()->to('changepassword')->with('notification-danger', '<b>ขออภัย!</b> รหัสของคุณไม่ถูกต้อง..1');
        } else {
            $param = [
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
            ];
            $updatePasswordUser =  $this->adminModel->updatePassword($idUser, $param);
            if ($updatePasswordUser['resultCode'] == 200) {
                return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>รหัสของคุณถูกเปลี่ยนแล้ว..');
            } else {
                return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> รหัสของคุณไม่ถูกต้อง..');
            }
        }
    }
    public function adminLogout()
    {
        session()->destroy();
        return redirect()->to('login')->setCookie('userInfo', '', time() - 3600);
    }
    public function getProvince()
    {
        $province = $this->adminModel->getProvince();
        $output = ' ';
        foreach ($province = (object) $province as $row) {
            $output .= '<option value="' . $row['province_id'] . '">' . $row['province_name_th'] . ' </option>';
        }
        return $output;
    }
    public function getAmphur($request)
    {
        $provice_id = $request->getVar('province_id');
        $amphur = $this->adminModel->getAmphur($provice_id);
        $output = '<option value="">= เลือก =</option>';
        foreach ($amphur = (object) $amphur as $row) {
            $output .= '<option value="' . $row['amphur_id'] . '">' . $row['amphur_name_th'] . ' </option>';
        }
        return $output;
    }
    public function getPageListMembers()
    {
        $data = [
            'title' => 'Member Management',
            'view' => 'member/member-list',
            'data' => $this->adminModel->getAllMembers(),
        ];

        return view('template/layout', $data);
    }
    public function getPageApproveMembers()
    {
        $condition = ['status' => 0];
        $memberApprove = $this->adminModel->getAllMemberWithCondition($condition);

        $data = [
            'title' => 'Member Approve',
            'view' => 'member/member-approve',
            'data' => $memberApprove,
        ];

        return view('template/layout', $data);
    }
    public function getPageHistoryMember()
    {
        $member = $this->adminModel->getAllMembers();

        $data = [
            'title' => 'Member History',
            'view' => 'member/member-history',
            'data' => $member,
        ];
        return view('template/layout', $data);
    }
    public function getPageBanListMember()
    {
        $condition = ['status' => 99];
        $memberBanList = $this->adminModel->getAllMemberWithCondition($condition);
        $data = [
            'title' => 'Member Ban',
            'view' => 'member/member-ban',
            'data' => $memberBanList,
        ];

        return view('template/layout', $data);
    }
    public function getPageEditMember($id)
    {
        $memberInfo = $this->adminModel->getMemberById($id);
        $provincename = $this->adminModel->getProvinceById($memberInfo[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurById($memberInfo[0]['amphur_id']);


        if ($memberInfo[0]['province_id'] == '') {
            $memberInfo[0]['provinceID'] = "";
            $memberInfo[0]['provinceName'] = "เลือก";
        } else {
            $memberInfo[0]['provinceID'] = $provincename[0]['province_id'];
            $memberInfo[0]['provinceName'] = $provincename[0]['province_name_th'];
        }
        if ($memberInfo[0]['amphur_id'] == '') {
            $memberInfo[0]['amphurID'] = "";
            $memberInfo[0]['amphurName'] = "เลือก";
        } else {
            $memberInfo[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $memberInfo[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }
        $data = [
            'title' => 'Member Edit',
            'view' => 'member/member-edit',
            'data' => $memberInfo
        ];

        return view('template/layout', $data);
    }
    public function getMemberShowPage($request)
    {
        $member_id = $request->getVar('reqid');
        $member = $this->adminModel->getMemberById($member_id);
        $provincename = $this->adminModel->getProvinceById($member[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurById($member[0]['amphur_id']);

        if ($member[0]['province_id'] == '') {
            $member[0]['provinceID'] = "";
            $member[0]['provinceName'] = "";
        } else {
            $member[0]['provinceID'] = $provincename[0]['province_id'];
            $member[0]['provinceName'] = $provincename[0]['province_name_th'];
        }

        if ($member[0]['amphur_id'] == '') {
            $member[0]['amphurID'] = "";
            $member[0]['amphurName'] = "";
        } else {
            $member[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $member[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }


        if ($member[0]['gender'] == '0') {
            $member[0]['genName'] = "ไม่ได้เลือก";
        } elseif ($member[0]['gender'] == '1') {
            $member[0]['genName'] = "ชาย";
        } elseif ($member[0]['gender'] == '2') {
            $member[0]['genName'] = "หญิง";
        }

        if ($member[0]['status'] == '0') {
            $member[0]['statusName'] = "ยังไม่อนุมัติ";
        } elseif ($member[0]['status'] == '1') {
            $member[0]['statusName'] = "อนุมัติ";
        } elseif ($member[0]['status'] == '99') {
            $member[0]['statusName'] = "ระงับ";
        }
        $response =
            '<div class="container">
        <table width="100%" border="0">
        <thead><tr><th width="50%"> </th>
        <th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($member as $row) {
            $response .=
                '<td style="padding:30px"><img width="100%" src="<?=base_url()?>assets/images/profile.png"></td>';
            $response .= '<td style="vertical-align: top; padding:30px">';
            $response .=
                '<p class="lead"><strong>ชื่อสมาชิก :' .
                $row['firstname'] . '  
            </p></strong>
            <p style="line-height: 2.0;">Email : ' .
                $row['member_email'] . '
            <br>เบอร์โทร :  ' .
                $row['phone'] . '
            <br>เลขประจำตัวประชาชน : ' .
                $row['idcard'] . ' 
            <br>สถานะ :' .
                $row['statusName'] . '
            <br>เพศ :' .
                $row['genName'] . '
            <br>ที่อยู่ :' .
                $row['address'] . " " . $row['provinceName'] . "  " . $row['amphurName'] . ' ';
            $response .=
                '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
            วันที่สมัคร :  ' .
                $row['created_at'] . ' ' . '<br> ';
            $response .= '</td></tr>';
            $response .= '</tbody></table></div> </p> ';
        }
        return $response;
    }
    public function updateMemberProcess($request)
    {
        $member_id = $request->getVar('id');
        $data = [
            'firstname' => $request->getVar('firstname'),
            'lastname' => $request->getVar('lastname'),
            'status' => $request->getVar('status'),
            'gender' => $request->getVar('gender'),
            'idcard' => $request->getVar('idcard'),
            'member_email' => $request->getVar('email'),
            'phone' => $request->getVar('phone'),
            'province_id' => $request->getVar('province_id'),
            'amphur_id' => $request->getVar('amphur_id'),
            'address' => $request->getVar('address'),
        ];

        $update =  $this->adminModel->updateMemberById($member_id, $data);
        if ($update['resultCode'] == 200) {
            return redirect()->to('')->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->to('')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function approveMemberProcess($id)
    {
        $member_id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approvemember =  $this->adminModel->updateMemberById($member_id, $data);

        if ($approvemember['resultCode'] == 200) {
            return redirect()->back('')->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back('')->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function banMemberProcess($id)
    {
        $member_id = $id;
        $data =
            [
                'status' => '99',
            ];
        $approve =  $this->adminModel->updateMemberById($member_id, $data);

        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function unbanMemberProcess($id)
    {
        $member_id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approve =  $this->adminModel->updateMemberById($member_id, $data);

        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deleteMemberProcess($id)
    {
        $deletemember =  $this->adminModel->deleteMemberById($id);
        if ($deletemember['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getPageListCompanyall()
    {
        $data = [
            'title' => 'Company Management',
            'view' => 'company/company-list',
            'data' => $this->adminModel->getAllCompany(),
        ];

        return view('template/layout', $data);
    }

    public function getPageApproveCompany()
    {
        $condition = ['status' => 0, 'cou_type' => 0];
        $company = $this->adminModel->getAllCompanyWithCondition($condition);
        $data = [
            'title' => 'Company Approve',
            'view' => 'company/company-approve',
            'data' => $company,
        ];
        return view('template/layout', $data);
    }

    public function getPageBanList()
    {
        $condition =  ['status' => 99, 'cou_type' => 0];
        $company = $this->adminModel->getAllCompanyWithCondition($condition); {
            $data = [
                'title' => 'Company Ban',
                'view' => 'company/company-ban',
                'data' => $company,
            ];

            return view('template/layout', $data);
        }
    }
    public function getPageHistory()
    {
        $condition = ['status' != 0, 'cou_type' => 0];
        $company = $this->adminModel->getAllCompanyWithCondition($condition); {
            $data = [
                'title' => 'Company History',
                'view' => 'company/company-history',
                'data' => $company,
            ];

            return view('template/layout', $data);
        }
    }
    public function getPageEditCompany($id)
    {
        $comInfo = $this->adminModel->getcompanyById($id);

        $provincename = $this->adminModel->getProvinceByIdCompany($comInfo[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurByIdCompany($comInfo[0]['amphur_id']);

        if ($comInfo[0]['province_id'] == '') {
            $comInfo[0]['provinceID'] = "";
            $comInfo[0]['provinceName'] = "เลือก";
        } else {
            $comInfo[0]['provinceID'] = $provincename[0]['province_id'];
            $comInfo[0]['provinceName'] = $provincename[0]['province_name_th'];
        }
        if ($comInfo[0]['amphur_id'] == '') {
            $comInfo[0]['amphurID'] = "";
            $comInfo[0]['amphurName'] = "เลือก";
        } else {
            $comInfo[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $comInfo[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }
        $data = [
            'title' => 'Company Edit',
            'view' => 'company/company-edit',
            'data' => $comInfo
        ];
        return view('template/layout', $data);
    }
    public function getPageListCompany($request)
    {
        $cou_id = $request->getVar('reqid');
        $cou = $this->adminModel->getCompanyById($cou_id);
        $provincename = $this->adminModel->getProvinceByIdCompany($cou[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurByIdCompany($cou[0]['amphur_id']);

        if ($cou[0]['province_id'] == '') {
            $cou[0]['provinceID'] = "";
            $cou[0]['provinceName'] = "";
        } else {
            $cou[0]['provinceID'] = $provincename[0]['province_id'];
            $cou[0]['provinceName'] = $provincename[0]['province_name_th'];
        }

        if ($cou[0]['amphur_id'] == '') {
            $cou[0]['amphurID'] = "";
            $cou[0]['amphurName'] = "";
        } else {
            $cou[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $cou[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }

        if ($cou[0]['status'] == '0') {
            $cou[0]['statusName'] = "ยังไม่อนุมัติ";
        } elseif ($cou[0]['status'] == '1') {
            $cou[0]['statusName'] = "อนุมัติ";
        } elseif ($cou[0]['status'] == '99') {
            $cou[0]['statusName'] = "ระงับ";
        }

        $response =
            '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($cou = (object) $cou as $row) {
            $response .=
                '<td style="padding:30px"><img width="100%" src="">
                </td>';
            $response .= '<td style="vertical-align: top; padding:30px">';
            $response .=
                '<p class="lead"><strong>ชื่อบริษัท :' .
                $row['cou_name_th'] . '  
            ' . $row['cou_name_en'] . '
            </p></strong>
            <p style="line-height: 2.0;">Email : ' .
                $row['cou_email'] . '
            <br>เบอร์โทร :  ' .
                $row['phone'] . '
            <br>เลขประจำตัวผู้เสียภาษี : ' .
                $row['cou_tax_id'] . ' 
            <br>รายละเอียด :  ' .
                $row['cou_description'] . '
            <br>ที่อยู่ :  ' .
                $row['address'] . '' . $row['provinceName'] . "  " . $row['amphurName'] . '';
            $response .=
                '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
            <br>สร้างเมื่อ :' .
                $row['created_at'] .
                ' <br>สถานะ :' .
                $row['statusName'] .  '<br> ';
            $response .= '</td></tr>';
            $response .= '</tbody></table></div>';
        }
        return $response;
    }
    public function updatecompanyProcess($request)
    {
        $id = $request->getVar('id');
        $data = [
            'cou_name_th' => $request->getVar('firstname'),
            'cou_name_en' => $request->getVar('lastname'),
            'cou_description' => $request->getVar('description'),
            'cou_tax_id' => $request->getVar('idcard'),
            'cou_email' => $request->getVar('email'),
            'phone' => $request->getVar('phone'),
            'address' => $request->getVar('address'),
            'status' => $request->getVar('status'),
            'province_id' => $request->getVar('province_id'),
            'amphur_id' => $request->getVar('amphur_id'),
        ];

        $update =  $this->adminModel->updatecompanyById($id, $data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }

    public function approvecompanyProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approvecompany =  $this->adminModel->updatecompanyById($cou_id, $data);

        if ($approvecompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function bancompanyProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'status' => '99',
            ];
        $approvecompany =  $this->adminModel->updatecompanyById($cou_id, $data);
        if ($approvecompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function unbancompanyProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approvecompany =  $this->adminModel->updatecompanyById($cou_id, $data);
        if ($approvecompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deletecompanyProcess($id)
    {
        $deleteCompany =  $this->adminModel->deleteCompanyById($id);
        if ($deleteCompany['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }

    public function getPageListUniversity()
    {
        $data = [
            'title' => 'University Management',
            'view' => 'university/university-list',
            'data' => $this->adminModel->getAllUniversity(),
        ];

        return view('template/layout', $data);
    }
    public function getPageApproveUniversity()
    {
        $condition = ['status' => 0, 'cou_type' => 1];
        $uni = $this->adminModel->getAllUniversityWithCondition($condition);

        $data = [
            'title' => 'University Approve',
            'view' => 'university/university-approve',
            'data' =>  $uni,
        ];
        return view('template/layout', $data);
    }
    public function getPageBanUniversityList()
    {
        $condition = ['status' => 99, 'cou_type' => 1];
        $uni = $this->adminModel->getAllUniversityWithCondition($condition);

        $data = [
            'title' => 'University Ban',
            'view' => 'university/universuty-banapprove',
            'data' => $uni,
        ];
        return view('template/layout', $data);
    }
    public function getPageHistoryUniversity()
    {
        $condition = ['status' != 0, 'cou_type' => 1];
        $uni = $this->adminModel->getAllUniversityWithCondition($condition);

        $data = [
            'title' => 'University History',
            'view' => 'university/university-hisapprove',
            'data' => $uni,
        ];
        return view('template/layout', $data);
    }
    public function getPageEditUniversity($id)
    {
        $proInfo = $this->adminModel->getUniversityById($id);
        $provincename = $this->adminModel->getProvinceByIdUniversity($proInfo[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurByIdUniversity($proInfo[0]['amphur_id']);

        if ($proInfo[0]['province_id'] == '') {
            $proInfo[0]['provinceID'] = "";
            $proInfo[0]['provinceName'] = "เลือก";
        } else {
            $proInfo[0]['provinceID'] = $provincename[0]['province_id'];
            $proInfo[0]['provinceName'] = $provincename[0]['province_name_th'];
        }
        if ($proInfo[0]['amphur_id'] == '') {
            $proInfo[0]['amphurID'] = "";
            $proInfo[0]['amphurName'] = "เลือก";
        } else {
            $proInfo[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $proInfo[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }
        $data = [
            'title' => 'University Edit',
            'view' => 'university/university-update',
            'data' => $proInfo
        ];
        return view('template/layout', $data);
    }
    public function updateUniversityProcess($request)
    {
        $id = $request->getVar('id');
        $data = [
            'cou_name_th' => $request->getVar('name_th'),
            'cou_name_en' => $request->getVar('name_en'),
            'cou_description' => $request->getVar('description'),
            'cou_tax_id' => $request->getVar('idcard'),
            'cou_email' => $request->getVar('email'),
            'phone' => $request->getVar('phone'),
            'address' => $request->getVar('address'),
            'status' => $request->getVar('status'),
            'province_id' => $request->getVar('province_id'),
            'amphur_id' => $request->getVar('amphur_id'),
        ];
        $update =  $this->adminModel->updateUniversityById($id, $data);
        if ($update['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกแก้ไขเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function approveUniversityProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approveUniversity =  $this->adminModel->updateUniversityById($cou_id, $data);
        if ($approveUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function banUniversityProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'status' => '99',
            ];
        $approveUniversity =  $this->adminModel->updateUniversityById($cou_id, $data);
        if ($approveUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function unbanUniversityProcess($id)
    {
        $cou_id = $id;
        $data =
            [
                'status' => '1',
            ];
        $unlockUniversity =  $this->adminModel->updateUniversityById($cou_id, $data);
        if ($unlockUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deleteUniversityProcess($id)
    {
        $deleteUniversity =  $this->adminModel->deleteUniversityById($id);
        if ($deleteUniversity['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getUniversityShowPage($request)
    {
        $cou_id = $request->getVar('reqid');
        $cou = $this->adminModel->getUniversityById($cou_id);
        $provincename = $this->adminModel->getProvinceByIdUniversity($cou[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurByIdUniversity($cou[0]['amphur_id']);

        if ($cou[0]['province_id'] == '') {
            $cou[0]['provinceID'] = "";
            $cou[0]['provinceName'] = "";
        } else {
            $cou[0]['provinceID'] = $provincename[0]['province_id'];
            $cou[0]['provinceName'] = $provincename[0]['province_name_th'];
        }

        if ($cou[0]['amphur_id'] == '') {
            $cou[0]['amphurID'] = "";
            $cou[0]['amphurName'] = "";
        } else {
            $cou[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $cou[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }
        if ($cou[0]['status'] == '0') {
            $cou[0]['statusName'] = "ยังไม่อนุมัติ";
        } elseif ($cou[0]['status'] == '1') {
            $cou[0]['statusName'] = "อนุมัติ";
        } elseif ($cou[0]['status'] == '99') {
            $cou[0]['statusName'] = "ระงับ";
        }
        $response =
            '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($cou = (object) $cou as $row) {
            $response .=
                '<td style="padding:30px"><img width="100%" src="">
                </td>';
            $response .= '<td style="vertical-align: top; padding:30px">';
            $response .=
                '<p class="lead"><strong>ชื่อบริษัท :' .
                $row['cou_name_th'] . '  
            ' . $row['cou_name_en'] . '
            </p></strong>
            <p style="line-height: 2.0;">Email : ' .
                $row['cou_email'] . '
            <br>เบอร์โทร :  ' .
                $row['phone'] . '
            <br>เลขประจำตัวผู้เสียภาษี : ' .
                $row['cou_tax_id'] . ' 
            <br>รายละเอียด :  ' .
                $row['cou_description'] . '
            <br>ที่อยู่ :  ' .
                $row['address'] . ' จังหวัด ' . $row['provinceName'] . " อำเภอ/เขต " . $row['amphurName']  . ' ';

            $response .=
                '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
            เข้าใช่ล่าสุด :  ' .
                $row['created_at'] . '  
            <br>สร้างเมื่อ :' .
                $row['created_at'] . '  
            <br>สถานะ :' .
                $row['statusName'] . '<br> ';
            $response .= '</td></tr>';
            $response .= '</tbody></table></div>';
        }
        return $response;
    }

    public function getPageJob()
    {
        $job = $this->adminModel->getAllJob();
        $data = [
            'title' => 'Job Management',
            'view' => 'job/job-list',
            'data' => $job,
        ];
        return view('template/layout', $data);
    }
    public function getPagebanJob()
    {
        $condition = ['job.status' => 99];
        $job = $this->adminModel->getAlljobWithCondition($condition);
        $data = [
            'title' => 'Job Management',
            'view' => 'job/job-ban',
            'data' => $job,
        ];
        return view('template/layout', $data);
    }
    public function getPageHistoryJob()
    {
        $condition = ['status' != 0];
        $job = $this->adminModel->getAlljobWithCondition($condition);
        $data = [
            'title' => 'Job History',
            'view' => 'job/job-history',
            'data' => $job,
        ];
        return view('template/layout', $data);
    }
    public function getPageApproveJob()
    {
        $condition = ['job.status' => 0];
        $job = $this->adminModel->getAlljobWithCondition($condition);
        $data = [
            'title' => 'Job Approve',
            'view' => 'job/job-approve',
            'data' =>  $job,
        ];
        return view('template/layout', $data);
    }
    public function approvejobProcess($id)
    {
        $id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approve =  $this->adminModel->updateJobById($id, $data);
        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function banjobProcess($id)
    {
        $id = $id;
        $data =
            [
                'status' => '99',
            ];
        $approve =  $this->adminModel->updateJobById($id, $data);
        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deletejobProcess($id)
    {
        $deletejob =  $this->adminModel->deleteJobById($id);

        if ($deletejob['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getJobShowPage($request)
    {
        $job_id = $request->getVar('reqid');
        $job = $this->adminModel->getJobById($job_id);;

        $provincename = $this->adminModel->getProvinceById($job[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurById($job[0]['amphur_id']);
        if ($job[0]['province_id'] == '') {
            $job[0]['provinceID'] = "";
            $job[0]['provinceName'] = "";
        } else {
            $job[0]['provinceID'] = $provincename[0]['province_id'];
            $job[0]['provinceName'] = $provincename[0]['province_name_th'];
        }

        if ($job[0]['amphur_id'] == '') {
            $job[0]['amphurID'] = "";
            $job[0]['amphurName'] = "";
        } else {
            $job[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $job[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }
        if ($job[0]['status'] == '0') {
            $job[0]['statusName'] = "ยังไม่อนุมัติ";
        } elseif ($job[0]['status'] == '1') {
            $job[0]['statusName'] = "อนุมัติ";
        } elseif ($job[0]['status'] == '99') {
            $job[0]['statusName'] = "ระงับ";
        }
        $response =
            '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($job = (object) $job as $row) {

            $response .=
                '<td style="padding:30px"><img width="100%" src="">
                </td>';
            $response .= '<td style="vertical-align: top; padding:30px">';
            $response .=
                '<p class="lead"><strong>ชื่อประกาศ :'
                . $row['job_name'] . '  
    </p></strong>
    <p style="line-height: 2.0;">รายละเอียดงาน : ' .
                $row['job_description'] . '
    <br>งานเดือน : ' .
                $row['salary'] . ' บาท';
            $response .=
                '<p class="lead"><strong>ชื่อบริษัท :'
                . $row['cou_name_th'] . '  
        ' . $row['cou_name_en'] . '
        </p></strong>
        <p style="line-height: 2.0;">Email : ' .
                $row['cou_email'] . '
        <br>เบอร์โทร :  ' .
                $row['phone'] . '
        <br>เลขประจำตัวผู้เสียภาษี : ' .
                $row['cou_tax_id'] . '
        <br>ที่อยู่ :  ' .
                $row['address'] . ' จังหวัด ' . $row['provinceName'] . " อำเภอ/เขต " . $row['amphurName']  .
                ' ';

            $response .=
                '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
        เข้าใช่ล่าสุด :  ' .
                $row['created_at'] . '
        <br>สถานะ :  ' .
                $row['statusName'] .  '<br> ';
            $response .= '</td></tr>';
            $response .= '</tbody></table></div>';
        }
        return $response;
    }

    public function getPageEvent()
    {
        $event = $this->adminModel->getAllEvent();
        $data = [
            'title' => 'Event Management',
            'view' => 'event/event-list',
            'data' => $event,
        ];
        return view('template/layout', $data);
    }
    public function getPagebanEvent()
    {
        $condition = ['event.status' => 99];
        $event = $this->adminModel->getAllEventWithCondition($condition);
        $data = [
            'title' => 'Event Management',
            'view' => 'event/event-ban',
            'data' => $event,
        ];
        return view('template/layout', $data);
    }
    public function getPageHistoryEvent()
    {
        $condition = ['status' != 0];
        $event = $this->adminModel->getAllEventWithCondition($condition);
        $data = [
            'title' => 'Event Management',
            'view' => 'event/event-history',
            'data' => $event,
        ];
        return view('template/layout', $data);
    }
    public function getPageApproveEvent()
    {
        $condition = ['event.status' => 0];
        $event = $this->adminModel->getAllEventWithCondition($condition);
        $data = [
            'title' => 'Event Approve',
            'view' => 'event/event-approve',
            'data' =>  $event,
        ];
        return view('template/layout', $data);
    }
    public function approveEventProcess($id)
    {
        $id = $id;
        $data =
            [
                'status' => '1',
            ];
        $approve =  $this->adminModel->updateEventById($id, $data);
        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function banEventProcess($id)
    {
        $id = $id;
        $data =
            [
                'status' => '99',
            ];
        $approve =  $this->adminModel->updateEventById($id, $data);
        if ($approve['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b>');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function deleteEventProcess($id)
    {
        $deletejob =  $this->adminModel->deleteEventById($id);

        if ($deletejob['resultCode'] == 200) {
            return redirect()->back()->with('notification-success', '<b>สำเร็จ!</b> รายการถูกลบเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('notification-danger', '<b>ขออภัย!</b> เกิดข้อผิดพลาด กรุณาลองอีกครั้ง..');
        }
    }
    public function getEventShowPage($request)
    {
        $event_id = $request->getVar('reqid');
        $event = $this->adminModel->getEventById($event_id);;

        $provincename = $this->adminModel->getProvinceById($event[0]['province_id']);
        $amphurname = $this->adminModel->getAmphurById($event[0]['amphur_id']);
        if ($event[0]['province_id'] == '') {
            $event[0]['provinceID'] = "";
            $event[0]['provinceName'] = "";
        } else {
            $event[0]['provinceID'] = $provincename[0]['province_id'];
            $event[0]['provinceName'] = $provincename[0]['province_name_th'];
        }

        if ($event[0]['amphur_id'] == '') {
            $event[0]['amphurID'] = "";
            $event[0]['amphurName'] = "";
        } else {
            $event[0]['amphurID'] = $amphurname[0]['amphur_id'];
            $event[0]['amphurName'] = $amphurname[0]['amphur_name_th'];
        }
        if ($event[0]['status'] == '0') {
            $event[0]['statusName'] = "ยังไม่อนุมัติ";
        } elseif ($event[0]['status'] == '1') {
            $event[0]['statusName'] = "อนุมัติ";
        } elseif ($event[0]['status'] == '99') {
            $event[0]['statusName'] = "ระงับ";
        }
        $response =
            '<div class="container"><table width="100%" border="0"><thead><tr><th width="50%"> </th><th width="50%"> </th></tr></thead><tbody><tr>';
        foreach ($event = (object) $event as $row) {

            $response .=
                '<td style="padding:30px"><img width="100%" src="profile.png">
                </td>';
            $response .= '<td style="vertical-align: top; padding:30px">';
            $response .=
                '<p class="lead"><strong>ชื่อกิจกรรม :'
                . $row['event_name'] . '  
    </p></strong>
    <p style="line-height: 2.0;">รายละเอียดกิจกรรม : ' .
                $row['event_description'] . '
    <br>จำนวนคน : ' .
                $row['full_amount'] . ' คน' . '
    <br>จำนวนคนเข้าร่วม : ' .
                $row['regis_amount'] . ' คน';
            $response .=
                '<p class="lead"><strong>ชื่อสถาบัน :'
                . $row['cou_name_th'] . '  
        ' . $row['cou_name_en'] . '
        </p></strong>
        <p style="line-height: 2.0;">Email : ' .
                $row['cou_email'] . '
        <br>เบอร์โทร :  ' .
                $row['phone'] . '
        <br>เลขประจำตัวผู้เสียภาษี : ' .
                $row['cou_tax_id'] . '
        <br>ที่อยู่ :  ' .
                $row['address'] . ' จังหวัด ' . $row['provinceName'] . " อำเภอ/เขต " . $row['amphurName']  .
                ' ';

            $response .=
                '<hr><p class="lead"><strong>ข้อมูลการเข้าใช้งาน</strong></p>
        เข้าใช่ล่าสุด :  ' .
                $row['created_at'] . '
        <br>สถานะ :  ' .
                $row['statusName'] .  '<br> ';
            $response .= '</td></tr>';
            $response .= '</tbody></table></div>';
        }
        return $response;
    }
}
