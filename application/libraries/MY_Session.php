<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session
{

    public function __construct($params = array())
    {
        parent::__construct($params);
    }
    /**
     * Update an existing session
     *
     * @access    public
     * @return    void
     */
    public function sess_update()
    {
        $CI = & get_instance();

        if ( ! $CI->input->is_ajax_request())
        {
            parent::sess_update();
        }
    }

}

/* End of file MY_Session.php */
/* Location: ./application/libraries/MY_Session.php */ 