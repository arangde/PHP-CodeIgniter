<?php
/**
 * Office class Model
 * Created by: KGH
 * Date: 11/21/13
 *
 */
class Officeclass_model extends Base_model
{


	/*get Area data*/

	public function getAllOfficeClass() {

		$query = "SELECT * FROM office_class ORDER BY office_class_id ASC";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	

}