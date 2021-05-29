<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class vaksin_m extends My_Model{
	private $aes;
	
	function __construct() {
		parent::__construct();		
	}			

	function get_all(){
		$url = $this->config->item('url_node')."vaksin/";				
		return json_decode($this->getData($url));
	}

	function get_detail($vaksin){
		$url = $this->config->item('url_node')."vaksin/detail/".$vaksin;				
		return json_decode($this->getData($url));
	}

	function edit($vaksin,$data){
		$url = $this->config->item('url_node')."vaksin/edit/".$vaksin;				
		return json_decode($this->sendPost($url,$data));
	}

	function del($id){
		$url = $this->config->item('url_node')."vaksin/delete/".$id;				
		return json_decode($this->getData($url));
	}
	
	function status($vaksin,$status){
		$url = $this->config->item('url_node')."vaksin/status/".$vaksin."/".$status;				
		return json_decode($this->getData($url));
	}

	function pass($vaksin,$data){
		$url = $this->config->item('url_node')."vaksin/pass/".$vaksin;				
		return json_decode($this->sendPost($url,$data));
	}

	function resetpass($vaksin,$data){
		$url = $this->config->item('url_node')."vaksin/resetpass/".$vaksin;				
		return json_decode($this->sendPost($url,$data));
	}

	function add($data){
		$url = $this->config->item('url_node')."vaksin/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search($data){
		$url = $this->config->item('url_node')."vaksin/search/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search_count($data){
		$url = $this->config->item('url_node')."vaksin/count/";				
		return json_decode($this->sendPost($url,$data));
	}

	function scan($vaksin,$data){
		$url = $this->config->item('url_node')."vaksin/scan/".$vaksin;				
		return json_decode($this->sendPost($url,$data));
	}

	function search_radius($data){
		$url = $this->config->item('url_node')."vaksin/radius/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search_log($data){
		$url = $this->config->item('url_node')."log/search/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search_count_log($data){
		$url = $this->config->item('url_node')."log/count/";				
		return json_decode($this->sendPost($url,$data));
	}

	function get_detail_log($vaksin){
		$url = $this->config->item('url_node')."log/detail/".$vaksin;				
		return json_decode($this->getData($url));
	}
}

/* End of file vaksin_model.php */
/* Location: ./application/models/vaksin_Model.php */
