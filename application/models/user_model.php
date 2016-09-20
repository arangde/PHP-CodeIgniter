<?php
/**
 * User Model
 * Created by: arangde
 * Date: 11/21/13
 *
 */
class User_model extends Base_model
{
	/*add User in signup*/
	public function addUser($data) {
		return $this->add('users', $data);
	}
	/*update User */
	public function updateUser($data, $user_id) {
		$user = $this->getUserById($user_id);
		$where = 'user_id = ' . $user_id;
		return $this->update('users', $data, $where);
	}
	/*delete User*/
	public function deleteUser($user_id) {
		$where = 'user_id = ' . $user_id;
		$where1 = 'manager_id = ' . $user_id;
		$this->delete('users_view_history', $where1);
		return $this->delete('users', $where);
	}
	/*user check in signup*/
	public function userCheckByName($user_name) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('login_id', $user_name);

		$query = $this->db->get();
		if($query->num_rows > 0) {
			return $query->row_array();
		} else{
			return false;
		}
	}
	/*user check in login*/
	public function userCheck($user_name, $password) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('login_id', $user_name);
		$this->db->where('password', $password);

		$query = $this->db->get();

		if($query->num_rows > 0) {
			return $query->row_array();
		} else{
			return false;
		}
	}
	/*get user data by id*/

	public function getUserById($user_id) {

		$query = "SELECT u.*, o.office_name FROM users as u LEFT JOIN offices o ON u.office_id=o.office_id  WHERE u.user_id={$user_id}";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/* get user last id*/
	function getUserLastId() {
		$this->db->select_max('user_id');
		$result= $this->db->get('users')->row_array();
		return $result['user_id'];
	}
	/* get user view history*/
	function getUserViewHistory($manager_id){
		$query = "SELECT u.*, uh.view_date, o.office_name FROM users_view_history AS uh 
			LEFT JOIN users as u ON u.user_id=uh.user_viewed_id 
			LEFT JOIN offices as o ON u.office_id=o.office_id  
			WHERE uh.manager_id={$manager_id} AND u.user_id !='' ORDER BY uh.view_date DESC LIMIT 0, 20";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/* log user view history*/
	function setUserViewHistory($manager_id, $user_id){
		$data = array('manager_id'=>$manager_id, 'user_viewed_id'=>$user_id, 'view_date'=>date('Y-m-d H:i:s'));
		return $this->add('users_view_history', $data);
	}
	/*get user list*/
	public function getUserList($user_office_id=0,$user_id=0, $keyword="", $employment=99, $job=99, $office=99, $kana=0, $limit=-1, $start=0){
		
		$query = "SELECT u.*, o.office_name FROM users as u LEFT JOIN offices o ON u.office_id=o.office_id WHERE 1  ";
		if($user_office_id!=0){
			$query .= " AND u.office_id={$user_office_id} AND u.role !=2 ";
		}
		if($keyword !="")
		{
			$query .= " AND (";
			$user_tbl_fields = $this->db->list_fields('users');
			foreach($user_tbl_fields as $key=>$field)
			{
				if($field !="password" and $field !="job_title" and $field !="office_id" and $field !="employment"){
					$query .= "u.".$field." LIKE '%{$keyword}%'";
					if($key != count($user_tbl_fields)-1)
						$query .= " OR ";
				}
			}
			$query .= ")";
		}
		
		if($employment != 99)
			$query .= " AND (u.employment = {$employment}) ";
		if($job != 99)
			$query .= " AND (u.job_title = {$job}) ";
		if($office != 99)
			$query .= " AND (u.office_id = {$office}) ";

		$kana_suitable = $this->getKanaSuitable($kana);

		if($kana != 0) {
			if($kana == 11) {
				$query .= " AND substr(u.username, 1, 1) NOT IN (";
			}else{
				$query .= " AND substr(u.username, 1, 1) IN (";
			}
			foreach ($kana_suitable as $key => $kana_array) {
				$query .= "'".$kana_array."'";
				if($key != count($kana_suitable)-1)
					$query .=",";
			}
			$query .= " )";
		}

		
		$query .= " ORDER BY u.created DESC";
		$total_user_list = $this->db->query($query);
		$total_count = count($total_user_list->result_array());
		if($limit>-1)
			$query .= " LIMIT ".$start." , ".$limit;
		
		$page_user_list = $this->db->query($query);
		$user_list = $page_user_list->result_array();
		$user_lists = array($total_count, $user_list);
		return $user_lists;
	}


	public function getKanaSuitable($kana = 0) {

		global $g_kana;
		$result = array();
		if($kana == 11){
			foreach ($g_kana as $key => $ka) {
				if($key != 0 and $key!= 11){
					foreach ($ka[1] as $key1 => $k) {
						$result[] = $k;
					}
				}
			}
		}else{
			$result = $g_kana[$kana][1];
		}
		return $result;
	}
	/***************************************************************************/
	

	

	

	

	public function getGroupIdByName($group_name) {
		$this->db->select('group_id');
		$this->db->from('groups');
		$this->db->where('group_name', $group_name);

		$query = $this->db->get();
		$result = $query->row_array();

		return $result['group_id'];
	}

	public function getGroupName() {
		$this->db->select('*');
		$this->db->from('groups');

		$query = $this->db->get();

		return $query->result_array();
	}

	public function getOldFilenameById($user_id) {
		$this->db->select('photo_url');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$result = $this->db->get()->row_array();

		return $result['photo_url'];
	}

	

	public function getRoleByGroupName($group_name) {
		$this->db->select('role');
		$this->db->from('groups');
		$this->db->where('group_name', $group_name);

		$query = $this->db->get();
		$result = $query->row_array();

		return $result['role'];
	}
}