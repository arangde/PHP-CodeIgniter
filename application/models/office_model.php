<?php
/**
 * Office Model
 * Created by: arangde
 * Date: 11/21/13
 *
 */
class Office_model extends Base_model
{
	/*add Office */
	public function addOffice($data) {
		return $this->add('offices', $data);
	}
	/*update Office */
	public function updateOffice($data, $office_id) {
		$where = 'office_id = ' . $office_id;
		return $this->update('offices', $data, $where);
	}
	/*delete Office*/
	public function deleteOffice($office_id) {
		$where = 'office_id = ' . $office_id;
		return $this->delete('offices', $where);
	}

	/*get Office data by id*/

	public function getOfficeById($office_id) {

		$query = "SELECT * FROM offices WHERE office_id={$office_id}";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/* get Office last id*/
	function getOfficeLastId() {
		$this->db->select_max('office_id');
		$result= $this->db->get('offices')->row_array();
		return $result['office_id'];
	}
	/*get user list*/
	public function getOfficeList($keyword="", $limit=-1, $start=0){
		
		$query = "SELECT * FROM offices WHERE 1  ";

		if($keyword !="")
		{
			$query .= " AND (";
			$user_tbl_fields = $this->db->list_fields('offices');
			foreach($user_tbl_fields as $key=>$field)
			{
				if($field !="office_id"){
					$query .= $field." LIKE '%{$keyword}%'";
					if($key != count($user_tbl_fields)-1)
						$query .= " OR ";
				}
			}
			$query .= ")";
		}
		

		
		$query .= " ORDER BY created DESC";
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