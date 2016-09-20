<?php
/**
 * User slip Model
 * Created by: kgh
 * Date: 07/21/16
 *
 */
class Useslip_model extends Base_model
{
	/* add useslip data */
	public function addUseslip($data){
		return $this->add('useslips', $data);
	}
	/*update useslip data */
	public function updateUseslip($useslip_id, $data) {
		$where = 'useslip_id = ' . $useslip_id;
		return $this->update('useslips', $data, $where);
	}
	/*delete useslip data*/
	public function deleteUseslip($useslip_id) {
		$where = 'useslip_id = ' . $useslip_id;
		return $this->delete('useslips', $where);
	}
	public function deleteUseslipByServiceCode($contract_id, $service_id, $ur_year, $ur_month) {
		$where = 'us_contract_id = ' . $contract_id.' AND us_provide_service_code = ' . $service_id.' AND us_year = ' . $ur_year.' AND us_month = ' . $ur_month;
		return $this->delete('useslips', $where);
	}
	/* get usesilp by id*/
	public function getUseslipById($useslip_id){
		$query = "SELECT * FROM useslips WHERE useslip_id = {$useslip_id} ";
		$sclist = $this->db->query($query);
		return $sclist->result_array();
	}
	/*get service code list*/
	public function getSeviceCodeList() {
		$query = "SELECT * FROM service_codes ";
		$sclist = $this->db->query($query);
		return $sclist->result_array();
	}
	/* get contract's monthly userslip data */
	public function getMonthlyUserslipListByContractId($contract_id, $year, $month, $week){
		$query = "SELECT us.*, sc.service_code_name FROM useslips us  
				LEFT JOIN service_codes sc ON us.us_provide_service_code = sc.service_code 
				WHERE us.us_contract_id={$contract_id} AND us.us_year={$year} AND us.us_month={$month} ";
		$uslist = $this->db->query($query);
		return $uslist->result_array();
	}

	/* add useslip result data*/
	public function addUseslipResult($data){
		return $this->add('useslips_result', $data);
	}
	/*update useslip results data */
	public function updateUseslipResult($data, $ur_id, $day) {
		$where = 'ur_us_id = ' . $ur_id.' AND ur_date = '.$day;
		return $this->update('useslips_result', $data, $where);
	}

	public function getUsResultbyYMW($ur_contract_id, $ur_service_id, $ur_year, $ur_month, $str_us_dates=""){
		$query = "SELECT usr.* FROM useslips_result usr  
				WHERE usr.ur_contract_id={$ur_contract_id} AND usr.ur_service_id={$ur_service_id} AND usr.ur_year={$ur_year} 
				AND usr.ur_month={$ur_month} ";
		if($str_us_dates != ""){
			$query .= "  AND usr.ur_date IN ({$str_us_dates})";
		}
		$usrlist = $this->db->query($query);
		return $usrlist->result_array();
	}
	public function deleteUseslipResult($contract_id, $ur_service_code, $ur_year, $ur_month){
		$where = 'ur_contract_id = ' . $contract_id.' AND ur_service_id = ' . $ur_service_code.' AND ur_year = ' . $ur_year.' AND ur_month = ' . $ur_month;
		return $this->delete('useslips_result', $where);
	}
	public function getUsResultbyUsidAndDay($us_id, $day){
		$query = "SELECT usr.* FROM useslips_result usr  
				WHERE usr.ur_us_id={$us_id} AND usr.ur_date={$day}  ";
		$usrlist = $this->db->query($query);
		return $usrlist->result_array();
	}
}