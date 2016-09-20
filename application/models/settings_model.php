<?php
/**
 * Settings Model
 * Created by: arangde
 * Date: 11/21/13
 *
 */
class Settings_model extends Base_model
{
    public function getSettings( $module="" ) {
        $this->db->select('*');
        $this->db->from('settings');
    
        if($module != "") {
            $this->db->where('module', $module);
        }
    
        $query = $this->db->get();
    
        if($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $data[$row['option_key']] = $row['option_value'];
            }
            return $data;
        }
        return array();
    }
    
    public function getSetting( $data ) {
        $this->db->select('*');
        $this->db->from('settings');
        
        /*$this->db->where('module', $data['module']);
        $this->db->where('option_key', $data['option_key']);
        */
        $this->db->where('module', $data['module']);
        $this->db->where('option_key', $data['option_key']);
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        return array();
    }
    
    public function saveSettings($bind, $module="system") {
        foreach($bind as $row) {
            $data = $this->getSetting($row);
            
            if(empty($data)) {
                $this->add('settings', $row);
            }
            else {
                $this->update('settings', $row, array('module'=>$row['module'], 'option_key'=>$row['option_key']));
            }
        }
        
        return;
    }
    
    public function saveSetting($bind) {
        $data = $this->getSetting($bind);
            
        if(empty($data)) {
            $this->add('settings', $bind);
        }
        else {
            $this->update('settings', $bind, array('module'=>$bind['module'], 'option_key'=>$bind['option_key']));
        }
    
    }
    
    public function logMessage($from_id, $to_id, $post_id, $type, $message, $content = array()) {
        $data = array(
            'from_id' => $from_id,
            'to_id' => $to_id,
            'post_id' => $post_id,
            'type' => $type,
            'message' => $message,
            'content' => $content,
            'created' => date('Y-m-d H:i:s')
        );
        
        return $this->db->insert('notifications', $data);
    }
    
    public function getNotifications($user_id, $where='', $limit=-1, $start=0) {
        $this->db->select('notifications.*, posts.clothing_id, posts.photo_url AS cover_photo, users.first_name, users.last_name, users.user_name, users.photo_url, users.gender, specs.*', false);
        $this->db->from('notifications');
        $this->db->join('users', 'users.user_id=notifications.from_id', 'left');
        $this->db->join('specs', 'specs.user_id=notifications.from_id', 'left');
        $this->db->join('posts', 'posts.post_id=notifications.post_id', 'left');
        $this->db->order_by("notifications.created", "DESC");
        $this->db->where('notifications.to_id', $user_id);
        if($where != '')
            $this->db->where($where);
        if($limit>-1)
            $this->db->limit($limit, $start);
    
        $query = $this->db->get();
    
        return $query->result_array();
    }
    
    public function updateIn($ids) {
        $this->db->where_in('notification_id', $ids);
        $this->db->update('notifications', array('read' => '1'));
    }
}
