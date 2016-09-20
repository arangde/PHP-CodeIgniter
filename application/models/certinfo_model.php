<?php
/**
 * Certinfo Model
 * Created by: kgh
 * Date: 07/21/16
 *
 */
class Certinfo_model extends Base_model
{
	/*add Cert info*/
	public function addCertinfo($data) {
		return $this->add('certinfos', $data);
	}
	/*modify Cert info */
	public function modifyCertinfo($certinfo_id, $data) {
		$where = 'certinfo_id = ' . $certinfo_id;
		return $this->update('certinfos', $data, $where);
	}
	/*update Cert info */
	public function updateCertinfo($certinfo_id, $data) {
		$where = 'certinfo_id = ' . $certinfo_id;
		return $this->update('certinfos', $data, $where);
	}
	/*delete Cert info*/
	public function deleteCertinfo($list_pattern) {
		$where = 'certinfo_id IN (' . $list_pattern . ')';
		return $this->delete('certinfos', $where);
	}
	/* get Cert info by contract id*/
	public function getCertinfoByContractId($contract_id) {
			$query = "SELECT c.*, ct.c_username as contract_name, ins.insurer_name  
			FROM certinfos c LEFT JOIN contracts ct on c.contract_id = ct.contract_id 
			LEFT JOIN insurers ins on c.insurer_id = ins.insurer_id  
			WHERE  c.contract_id = {$contract_id}";
		$certinfo = $this->db->query($query);
		return $certinfo->result_array();
	}

	/* get Cert info by cert info id */
	public function getCertinfoByCertinfoId($certinfo_id){
		$query = "SELECT c.*, ct.c_username as contract_name, ins.insurer_name  
			FROM certinfos c LEFT JOIN contracts ct on c.contract_id = ct.contract_id 
			LEFT JOIN insurers ins on c.insurer_id = ins.insurer_id  
			WHERE  c.certinfo_id = {$certinfo_id}";
		$certinfo = $this->db->query($query);
		return $certinfo->result_array();
	}
}