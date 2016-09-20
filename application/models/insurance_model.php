<?php
/**
 * Insurance Model
 * Created by: arangde
 * Date: 11/21/13
 *
 */
class Insurance_model extends Base_model
{
	/*add Insurer */
	public function addInsurer($data) {
		return $this->add('insurers', $data);
	}
	/*update Insurer */
	public function updateInsurer($data, $insurer_id) {
		$where = 'insurer_id = ' . $insurer_id;
		return $this->update('insurers', $data, $where);
	}
	/*delete Insurer*/
	public function deleteInsurer($insurer_id) {
		$where = 'insurer_id = ' . $insurer_id;
		return $this->delete('insurers', $where);
	}

	/*get Insurer data by id*/

	public function getInsurerById($insurer_id) {

		$query = "SELECT * FROM insurers WHERE insurer_id={$insurer_id}";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/*get All Insurer data*/

	public function getAllInsurers() {

		$query = "SELECT * FROM insurers ORDER BY insurer_name ASC";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/* get Insurer last id*/
	function getInsurerLastId() {
		$this->db->select_max('insurer_id');
		$result= $this->db->get('insurers')->row_array();
		return $result['insurer_id'];
	}
	/*get user list*/
	public function getInsurerList($keyword="", $limit=-1, $start=0){
		
		$query = "SELECT * FROM insurers WHERE 1  ";

		if($keyword !="")
		{
			$query .= " AND (";
			$user_tbl_fields = $this->db->list_fields('insurers');
			foreach($user_tbl_fields as $key=>$field)
			{
				if($field !="insurer_id"){
					$query .= $field." LIKE '%{$keyword}%'";
					if($key != count($user_tbl_fields)-1)
						$query .= " OR ";
				}
			}
			$query .= ")";
		}
		

		
		$query .= " ORDER BY sort_id DESC";
		$total_user_list = $this->db->query($query);
		$total_count = count($total_user_list->result_array());
		if($limit>-1)
			$query .= " LIMIT ".$start." , ".$limit;
		
		$page_user_list = $this->db->query($query);
		$user_list = $page_user_list->result_array();
		$user_lists = array($total_count, $user_list);
		return $user_lists;
	}

}