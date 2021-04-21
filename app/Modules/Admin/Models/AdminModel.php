<?php namespace App\Modules\Admin\Models;
			
use App\Entities\AdminEntity;
use App\Helpers\UserUtils;
use App\Entities\ContactEntity;
use App\Entities\AboutEntity;
use App\Entities\HelpEntity;
use App\Entities\JobEntity;
use App\Entities\COUEntity;
use App\Entities\PolicyEntity;
use App\Entities\ProvisionEntity;
use App\Entities\MemberEntity;
use App\Entities\EventEntity;
class AdminModel
{
	public function __construct()
    {
        helper('cookie');
        $this->eventEntity = new EventEntity();
        $this->adminEntity = new AdminEntity();  
        $this->userUtils = new UserUtils();  
        $this->couEntity = new COUEntity();
        $this->contentmanagementEntity = new ContactEntity();
        $this->contentaboutentity = new AboutEntity();
        $this->contentpolicyentity = new PolicyEntity();
        $this->provisionEntity = new ProvisionEntity();
        $this->helpEntity = new HelpEntity(); 
        $this->jobEntity = new JobEntity();   
        $this->memberEntity = new MemberEntity();
        $this->db = \Config\Database::connect();
    }
/// admin
    public function getAdminList()
    {
        $adminmanagementTable = $this->db->table('admin');
        $result = $adminmanagementTable->select('*')
            ->get()->getResultArray();
        return $result;
    }
	
	public function getAdminById($id)
    {
        $condition = array('id' => $id);
        $adminmanagementTable = $this->adminEntity;
        $result = $adminmanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    public function getAdminLogin($param)
    {
        
        $query = [
            'username' => $param['username'],
        ];
        $tokenData = [];
        $userTable = $this->adminEntity;
        $query = $userTable->select('*')->where($query)->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;
        if (!empty($userData)) {
            if (!password_verify($param['password'], $userData['password'])) {
                // the password is incorrect.
                return null;
            }
            $tokenData = $this->createAuthSession($userData);
        }
        return $tokenData;
    }
    public function createAuthSession($data)
    {
        $expire = (!empty($data['remember'])) ? 60 * 60 * 24 * 365 : 0;
        $setToken = array(
            'id' => $data['id'],
            'username' => $data['username']
        );
        $token = $this->userUtils->jwtTokenEncode($setToken);
        return ['token' => $token, 'expire' => $expire];
    }
    public function createUserAccountadmin($data)
    {
        $userTable = $this->adminEntity;
        $query = $userTable->select('*')
            ->where('username', $data['username'])
            ->get()->getResultArray();
        $userData = !empty($query) ? $query[0] : null;
        if (!empty($userData)) {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Dupicate username',
            );
            return $result;
        }

        try {
            $response = $this->adminEntity->insert($data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {
            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function updateAdmin($id, $data)
    {
        try {
            $response = $this->adminEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function deleteAdminById($id)
    {
        try {
            $condition = array(
                'id' => $id,
            );
            $response = $this->adminEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function updatePassword($id, $data)
    {
        try {
            $response = $this->adminEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function getAdminAuth()
    {
        $user_token = get_cookie('userInfo');

        if (!empty($user_token)) {
            $token_data = $this->userUtils->jwtTokenDecode($user_token);
            if ($token_data['resultCode'] !== 200) {
                $result = array(
                    'resultCode' => 401,
                    'resultMessage' => 'Unauthorized',
                );
                return $result;
            }
            $query = [
                'username' => $token_data['result']['username'],
                'id' => $token_data['result']['id'],
            ];
            $userTable = $this->db->table('admin');
            $query = $userTable->select('*')->where($query)->get()->getResultArray();
            $userData = !empty($query) ? $query[0] : null;
            if (!empty($userData)) {
                $result = array(
                    'resultCode' => 200,
                    'resultMessage' => 'Success',
                    'data' => $userData,
                );
            } else {
                $result = array(
                    'resultCode' => 401,
                    'resultMessage' => 'Unauthorized',
                );
            }
            return $result;
        } else {
            $result = array(
                'resultCode' => 401,
                'resultMessage' => 'Unauthorized!',
            );
            return $result;
        }
    }
    public function getProvince()
    {
        $province = $this->db->table('province')
            ->get()->getResultArray();
        return  $province;
    }

    public function getAmphur($province_id)
    {
        $amphur = $this->db->table('amphur')
            ->where(['province_id' => $province_id])
            ->get()->getResultArray();
        return  $amphur;
    }
//// member
      //ดึงข้อมูลสมาชิกทั้งหมด
      public function getAllMembers()
      {
          $membermanagementTable = $this->db->table('member');
          $result = $membermanagementTable->select('*')
              ->get()->getResultArray();
          return $result;
      }
      //ดีงข้อมูลสมาชิกตัวเดียว
      public function getMemberById($id)
      {
          $condition = array('member_id' => $id);
          $memberTable = $this->db->table('member');
          $result = $memberTable->select('*')
              ->where($condition)
              ->get()->getResultArray();
          return $result;
      }
      //ดึงข้อมูลสมาชิกพร้อมเงื่อนไข
      public function getAllMemberWithCondition($condition)
      {
          $membermanagementTable = $this->db->table('member');
          $result = $membermanagementTable->select('*')
              ->where($condition)
              ->get()->getResultArray();
          return $result;
      }
      //ดึงข้อมูลจังหวัด
      public function getProvinceById($id)
      {
          $condition = array('province_id' => $id);
          $memberTable = $this->db->table('province');
          $result = $memberTable->select('*')
              ->where($condition)
              ->get()->getResultArray();
          return $result;
      }
      //ดึงข้อมูลอำเภอ
      public function getAmphurById($id)
      {
          $condition = array('amphur_id' => $id);
          $memberTable = $this->db->table('amphur');
          $result = $memberTable->select('*')
              ->where($condition)
              ->get()->getResultArray();
          return $result;
      }
      //อัปเดทข้อมูลสมาชิก
      public function updateMemberById($member_id, $data)
      {
          try {
              $response = $this->memberEntity->update($member_id, $data);
              $result = array(
                  'resultCode' => 200,
                  'resultMessage' => 'Success',
                  'data' => $response
              );
              return $result;
          } catch (\Exception $e) {
  
              $result = array(
                  'resultCode' => 500,
                  'resultMessage' => 'Failed'
              );
              return $result;
          }
      }
      //ลบข้อมูลสมาชิก
      public function deleteMemberById($id)
      {
          try {
              $condition = array(
                  'member_id' => $id,
              );
              $response = $this->memberEntity->where($condition)->delete();
              $result = array(
                  'resultCode' => 200,
                  'resultMessage' => 'Success',
                  'data' => $response
              );
              return $result;
          } catch (\Exception $e) {
  
              $result = array(
                  'resultCode' => 500,
                  'resultMessage' => 'Failed'
              );
              return $result;
          }
      }
/////company
      public function getAllCompany()
    {
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where(['cou_type' => 0])
            ->get()->getResultArray();
        return $result;
    }
    public function getCompanyById($id)
    {
        $condition = array('cou_id' => $id, 'cou_type' => 0);
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }

    public function getAllCompanyWithCondition($condition)
    {
        $companymanagementTable = $this->db->table('cou');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }

    public function updatecompanyById($cou_id, $data)
    {
        try {
            $response = $this->couEntity->update($cou_id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function deleteCompanyById($cou_id)
    {
        try {
            $condition = array(
                'cou_id' => $cou_id,
            );
            $response = $this->couEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {
            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function getProvinceByIdCompany($id)
    {
        $condition = array('province_id' => $id);
        $companymanagementTable = $this->db->table('province');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getAmphurByIdCompany($id)
    {
        $condition = array('amphur_id' => $id);
        $companymanagementTable = $this->db->table('amphur');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getDistrictByIdCompany($id)
    {
        $condition = array('district_id' => $id);
        $companymanagementTable = $this->db->table('district');
        $result = $companymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
////university
    public function getAllUniversity()
    {
        $universitymanagementTable = $this->db->table('cou');
        $result = $universitymanagementTable->select('*')
            ->where(['cou_type' => 1])
            ->get()->getResultArray();
        return $result;
    }
    public function getUniversityById($id)
    {
        $condition = array('cou_id' => $id, 'cou_type' => 1);
        $universitymanagementTable = $this->couEntity;
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        return $result;
    }
    public function getAllUniversityWithCondition($condition)
    {
        $universitymanagementTable = $this->db->table('cou');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }

    public function updateUniversityById($id, $data)
    {
        try {
            $response = $this->couEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function deleteUniversityById($cou_id)
    {
        try {
            $condition = array(
                'cou_id' => $cou_id,
            );

            //!ดักหาก ID ที่ลบไม่ใช้ Admin ไม่อนุญาติให้ลบ

            $response = $this->couEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }

    public function getProvinceByIdUniversity($id)
    {
        $condition = array('province_id' => $id);
        $universitymanagementTable = $this->db->table('province');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function getAmphurByIdUniversity($id)
    {
        $condition = array('amphur_id' => $id);
        $universitymanagementTable = $this->db->table('amphur');
        $result = $universitymanagementTable->select('*')
            ->where($condition)
            ->get()->getResultArray();
        // dd($result);
        return $result;
    }
    ///// job
    public function getAllJob()
    {
        $jobTable = $this->db->table('job');
        $result = $jobTable->select('job.job_id,job.status,job.job_name,job.salary,job.job_description,job.created_at,cou.cou_name_th,cou.cou_name_en,cou.cou_email,cou.phone,cou.cou_tax_id,cou.address,cou.province_id,cou.amphur_id,province.province_name_th,amphur.amphur_name_th')
        ->join('cou','job.cou_id = cou.cou_id')
        ->join('category', 'category.category_id  = job.category_id')
        ->join('province', 'province.province_id = cou.province_id')
        ->join('amphur', 'amphur.amphur_id = cou.amphur_id')
            ->get()->getResultArray();
        return $result;
    }
    public function getJobById($id)
    {
        $condition = array('job_id' => $id);
        $jobTable = $this->db->table('job');
        $result = $jobTable->select('job.job_id,job.status,job.job_name,job.salary,job.job_description,job.created_at,cou.cou_name_th,cou.cou_name_en,cou.cou_email,cou.phone,cou.cou_tax_id,cou.address,cou.province_id,cou.amphur_id,province.province_name_th,amphur.amphur_name_th')->where($condition)
        ->join('cou', 'cou.cou_id = job.cou_id')
        ->join('category', 'category.category_id  = job.category_id')
        ->join('province', 'province.province_id = cou.province_id')
        ->join('amphur', 'amphur.amphur_id = cou.amphur_id')
        ->get()->getResultArray();
        return $result;
    }
    public function updateJobById($id,$data)
    {
        try {
            $response = $this->jobEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function getAlljobWithCondition($condition)
    {
        $job = $this->db->table('job');
        $result = $job->select('job.job_id,job.status,job.job_name,job.salary,job.job_description,job.created_at,cou.cou_name_th,cou.cou_name_en,cou.cou_email,cou.phone,cou.cou_tax_id,cou.address,cou.province_id,cou.amphur_id,province.province_name_th,amphur.amphur_name_th')->where($condition)
        ->join('cou', 'job.cou_id = cou.cou_id')
        ->join('category', 'category.category_id  = job.category_id')
        ->join('province', 'province.province_id = cou.province_id')
        ->join('amphur', 'amphur.amphur_id = cou.amphur_id')
            ->get()->getResultArray();
        return $result;
    }
    public function deleteJobById($id)
    {
        try {
            $condition = array(
                'job_id' => $id,
            );
            $response = $this->jobEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function getAllEvent()
    {
        $eventTable = $this->db->table('event');
        $result = $eventTable->select('event.event_id,event.status,event.event_name,event.full_amount,event.regis_amount,event.event_description,event.created_at,cou.cou_name_th,cou.cou_name_en,cou.cou_email,cou.phone,cou.cou_tax_id,cou.address,cou.province_id,cou.amphur_id,province.province_name_th,amphur.amphur_name_th')
        ->join('cou','event.cou_id = cou.cou_id')
        ->join('province', 'province.province_id = cou.province_id')
        ->join('amphur', 'amphur.amphur_id = cou.amphur_id')
            ->get()->getResultArray();
        return $result;
    }
    public function getEventById($id)
    {
        $condition = array('event_id' => $id);
        $eventTable = $this->db->table('event');
        $result = $eventTable->select('event.event_id,event.status,event.event_name,event.full_amount,event.regis_amount,event.event_description,event.created_at,cou.cou_name_th,cou.cou_name_en,cou.cou_email,cou.phone,cou.cou_tax_id,cou.address,cou.province_id,cou.amphur_id,province.province_name_th,amphur.amphur_name_th')->where($condition)
        ->join('cou', 'cou.cou_id = event.cou_id')
        ->join('province', 'province.province_id = cou.province_id')
        ->join('amphur', 'amphur.amphur_id = cou.amphur_id')
        ->get()->getResultArray();
        return $result;
    }
    public function updateEventById($id,$data)
    {
        try {
            $response = $this->eventEntity->update($id, $data);
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {

            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
    public function getAllEventWithCondition($condition)
    {
        $eventTable = $this->db->table('event');
        $result = $eventTable->select('event.event_id,event.status,event.event_name,event.full_amount,event.regis_amount,event.event_description,event.created_at,cou.cou_name_th,cou.cou_name_en,cou.cou_email,cou.phone,cou.cou_tax_id,cou.address,cou.province_id,cou.amphur_id,province.province_name_th,amphur.amphur_name_th')->where($condition)
        ->join('cou', 'event.cou_id = cou.cou_id')
        ->join('province', 'province.province_id = cou.province_id')
        ->join('amphur', 'amphur.amphur_id = cou.amphur_id')
            ->get()->getResultArray();
        return $result;
    }
    public function deleteEventById($id)
    {
        try {
            $condition = array(
                'event_id' => $id,
            );
            $response = $this->eventEntity->where($condition)->delete();
            $result = array(
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => $response
            );
            return $result;
        } catch (\Exception $e) {
            $result = array(
                'resultCode' => 500,
                'resultMessage' => 'Failed'
            );
            return $result;
        }
    }
}
	
	