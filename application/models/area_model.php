<?php
/**
 * Area Model
 * Created by: KGH
 * Date: 11/21/13
 *
 */
class Area_model extends Base_model
{


	/*get Area data*/

	public function getAllArea() {

		$query = "SELECT * FROM areas ORDER BY area_id ASC";

		$user = $this->db->query($query);

		return $user->result_array();
	}
	

}