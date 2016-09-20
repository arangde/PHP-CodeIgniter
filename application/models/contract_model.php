<?php
/**
 * Contract Model
 * Created by: arangde
 * Date: 11/21/13
 *
 */
class Contract_model extends Base_model
{
	/*add Contract in signup*/
	public function addContract($data) {
		return $this->add('contracts', $data);
	}
	/*add Contract Service*/
	public function addContractService($contract_id, $contractServices){
		$where = 'contract_id = ' . $contract_id;
		$this->delete('contracts_service', $where);
		foreach($contractServices as $service){
			$this->add('contracts_service', $service);
		}
	}
	/*update Contract */
	public function updateContract($data, $contract_id) {
		//$user = $this->getContractById($contract_id);
		$where = 'contract_id = ' . $contract_id;
		return $this->update('contracts', $data, $where);
	}
	/*delete Contract*/
	public function deleteContract($contract_id) {
		$where = 'contract_id = ' . $contract_id;
		$this->delete('contracts_service', $where);
		return $this->delete('contracts', $where);
	}

	/*get Contract data by id*/

	public function getContractById($contract_id) {

		$query = "SELECT c.*, o.office_name FROM contracts c LEFT JOIN offices o ON o.office_id=c.office_id WHERE c.contract_id={$contract_id}";
		$contract = $this->db->query($query);
		return $contract->result_array();
	}
	/* get contract last id*/
	function getContractLastId() {
		$this->db->select_max('contract_id');
		$result= $this->db->get('contracts')->row_array();
		return $result['contract_id'];
	}
	/* get contract view history*/
	function getContractViewHistory($manager_id){
		$query = "SELECT c.*, ch.view_date FROM contracts_view_history AS ch 
			LEFT JOIN contracts as c ON c.contract_id=ch.contract_viewed_id 
			WHERE ch.manager_id={$manager_id} AND c.contract_id!='' ORDER BY ch.view_date DESC LIMIT 0, 20";

		$contract = $this->db->query($query);

		return $contract->result_array();
	}
	/*  contract view history*/
	function setContractViewHistory($manager_id, $contract_id){
		$data = array('manager_id'=>$manager_id, 'contract_viewed_id'=>$contract_id, 'view_date'=>date('Y-m-d H:i:s'));
		return $this->add('contracts_view_history', $data);
	}
	/* get contract service */
	public function getContractServices($contract_id){
		$query = "SELECT * FROM contracts_service WHERE contract_id={$contract_id}";
		$contract = $this->db->query($query);
		return $contract->result_array();
	}
	/*get contract list*/
	public function getContractList($keyword="", $employment=99, $job=99, $office=99, $kana=0, $limit=-1, $start=0){
		
		$query = "SELECT * FROM contracts WHERE 1  ";

		if($keyword !="")
		{
			$query .= " AND (";
			$user_tbl_fields = $this->db->list_fields('contracts');
			foreach($user_tbl_fields as $key=>$field)
			{
				if($field !="password" and $field !="job_title" and $field !="office_id" and $field !="employment"){
					$query .= $field." LIKE '%{$keyword}%'";
					if($key != count($user_tbl_fields)-1)
						$query .= " OR ";
				}
			}
			$query .= ")";
		}
		/*
		if($employment != 99)
			$query .= " AND (employment = {$employment}) ";
		if($job != 99)
			$query .= " AND (job_title = {$job}) ";
		if($office != 99)
			$query .= " AND (office_id = {$office}) ";
		*/
		$kana_suitable = $this->getKanaSuitable($kana);

		if($kana != 0) {
			if($kana == 11) {
				$query .= " AND substr(c_username, 1, 1) NOT IN (";
			}else{
				$query .= " AND substr(c_username, 1, 1) IN (";
			}
			foreach ($kana_suitable as $key => $kana_array) {
				$query .= "'".$kana_array."'";
				if($key != count($kana_suitable)-1)
					$query .=",";
			}
			$query .= " )";
		}

		
		$query .= " ORDER BY created DESC";
		$total_list = $this->db->query($query);
		$total_count = count($total_list->result_array());
		if($limit>-1)
			$query .= " LIMIT ".$start." , ".$limit;
		
		$page_list = $this->db->query($query);
		$listall = $page_list->result_array();
		$lists = array($total_count, $listall);
		return $lists;
	}
	/*get manager contract list*/
	public function getManagerContractList($user_id, $keyword="", $employment=99, $job=99, $office=99, $kana=0, $limit=-1, $start=0){
		
		$query = "SELECT * FROM contracts WHERE  c_masternumber={$user_id} ";

		if($keyword !="")
		{
			$query .= " AND (";
			$user_tbl_fields = $this->db->list_fields('contracts');
			foreach($user_tbl_fields as $key=>$field)
			{
				if($field !="password" and $field !="job_title" and $field !="office_id" and $field !="employment"){
					$query .= $field." LIKE '%{$keyword}%'";
					if($key != count($user_tbl_fields)-1)
						$query .= " OR ";
				}
			}
			$query .= ")";
		}
		/*
		if($employment != 99)
			$query .= " AND (employment = {$employment}) ";
		if($job != 99)
			$query .= " AND (job_title = {$job}) ";
		if($office != 99)
			$query .= " AND (office_id = {$office}) ";
		*/
		$kana_suitable = $this->getKanaSuitable($kana);

		if($kana != 0) {
			if($kana == 11) {
				$query .= " AND substr(c_username, 1, 1) NOT IN (";
			}else{
				$query .= " AND substr(c_username, 1, 1) IN (";
			}
			foreach ($kana_suitable as $key => $kana_array) {
				$query .= "'".$kana_array."'";
				if($key != count($kana_suitable)-1)
					$query .=",";
			}
			$query .= " )";
		}

		
		$query .= " ORDER BY created DESC";
		$total_list = $this->db->query($query);
		$total_count = count($total_list->result_array());
		if($limit>-1)
			$query .= " LIMIT ".$start." , ".$limit;
		
		$page_list = $this->db->query($query);
		$listall = $page_list->result_array();
		$lists = array($total_count, $listall);
		return $lists;
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
}