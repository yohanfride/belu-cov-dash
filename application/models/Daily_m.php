<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class daily_m extends My_Model{
	private $aes;
	
	function __construct() {
		parent::__construct();		
	}			

	function get_all(){
		$url = $this->config->item('url_node')."daily/";				
		return json_decode($this->getData($url));
	}

	function get_detail($daily){
		$url = $this->config->item('url_node')."daily/detail/".$daily;				
		return json_decode($this->getData($url));
	}

	function edit($daily,$data){
		$url = $this->config->item('url_node')."daily/edit/".$daily;				
		return json_decode($this->sendPost($url,$data));
	}

	function add($data){
		$url = $this->config->item('url_node')."daily/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search($data){
		$url = $this->config->item('url_node')."daily/search/";		
		return json_decode($this->sendPost($url,$data));
	}

	function search_count($data){
		$url = $this->config->item('url_node')."daily/count/";				
		return json_decode($this->sendPost($url,$data));
	}

	function today($data=array()){
		$url = $this->config->item('url_node')."daily/today/";				
		return json_decode($this->sendPost($url,$data));
	}
}

/* End of file daily_model.php */
/* Location: ./application/models/daily_Model.php */
