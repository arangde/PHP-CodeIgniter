<?php
/**
 * Corporation Model
 * Created by: arangde
 * Date: 11/21/13
 *
 */
class Corporation_model extends Base_model
{
	/*add Corporation */
	public function addCorporation($data) {
		return $this->add('corporations', $data);
	}
	/*add Corporation Subscription */
	public function addCorporationSubscription($data){
		return $this->add('corporations', $data);
	}
	/*update Corporation */
	public function updateCorporation($data, $corporation_id) {
		$where = 'corporation_id = ' . $corporation_id;
		return $this->update('corporations', $data, $where);
	}
	/*delete Corporation*/
	public function deleteCorporation($corporation_id) {
		$where = 'corporation_id = ' . $corporation_id;
		return $this->delete('corporations', $where);
	}

	/*get Corporation data by id*/

	public function getCorporationById($corporation_id) {

		$query = "SELECT * FROM corporations WHERE corporation_id={$corporation_id}";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/*get All Corporation data*/

	public function getAllCorporations() {

		$query = "SELECT * FROM corporations ORDER BY insurer_name ASC";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	/* get Corporation last id*/
	public function getCorporationLastId() {
		$this->db->select_max('corporation_id');
		$result= $this->db->get('corporations')->row_array();
		return $result['corporation_id'];
	}

	/* check Corporation */
	public function checkCorporation($office_id){
		$query = "SELECT * FROM corporations WHERE corporation_id={$corporation_id}";
		$this->db->select('*');
		$this->db->from('corporations');
		$this->db->where('username', $user_name);

		$query = $this->db->get();
		if($query->num_rows > 0) {
			return $query->row_array();
		} else{
			return false;
		}
	}
}