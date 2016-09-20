<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Y'ALL
 *
 * Yet Another Layout Library for CodeIgniter
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @version     0.2.0
 * @author      Visual Chefs, LLC <hello@visualchefs.com>
 * @author      Aaron Kuzemchak <aaron@visualchefs.com>
 * @link        http://github.com/eecoder
 * @copyright   Copyright (c) 2011, Visual Chefs, LLC
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Yall {
	
	/**
	 * @var     object
	 * @access  protected
	 */
	protected $CI;
	
	/**
	 * @var     array
	 * @access  protected
	 */
	protected $data = array();
	
	/**
	 * @var  string
	 */
	public $layout = '';
	
	/**
	 * Constructor
	 *
	 * @param  array
	 */
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		
		// setup config options
		if( ! empty($config))
		{
			$this->layout = $config['default_layout'];
		}
	}
	
	/**
	 * Render the layout
	 *
	 * @param   string
	 * @param   bool
	 * @return  string|void
	 */
	public function render($layout = '', $return = FALSE)
	{
		// if layout is passed, use it instead of default
		$layout = ( ! $layout) ? $this->layout : $layout;
		
		return $this->CI->load->view($layout, $this->data, $return);
	}
	
	/**
	 * Set layout variables
	 *
	 * @param   string
	 * @param   mixed
	 * @param   bool
	 * @return  object
	 */
	public function set($name, $val, $encode = FALSE)
	{
		// encode html if specified
		$val = ($encode) ? htmlentities($val) : $val;
		
		$this->data[$name] = $val;
		
		return $this;
	}
	
	/**
	 * Set layout partial
	 *
	 * @param   string
	 * @param   string
	 * @param   array
	 * @return  object
	 */
	public function partial($name, $view, $data = array())
	{
		$this->data[$name] = $this->CI->load->view($view, $data, TRUE);
		
		return $this;
	}
	
	/**
	 * Set global variables to be used in both layout and child views
	 *
	 * @param   string
	 * @param   mixed
	 * @param   bool
	 * @return  object
	 */
	public function set_global($name, $val, $encode = FALSE)
	{
		// encode html if specified
		$val = ($encode) ? htmlentities($val) : $val;
		
		$this->CI->load->vars(array(
			$name => $val
		));
		
		return $this;
	}
	
}

/* End of file yall.php */