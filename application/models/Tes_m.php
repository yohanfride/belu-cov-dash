<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class tes_m extends My_Model{
	private $aes;
	
	function __construct() {
		parent::__construct();		
	}			

	function get_all(){
		$url = $this->config->item('url_node')."tes/";				
		return json_decode($this->getData($url));
	}

	function get_detail($tes){
		$url = $this->config->item('url_node')."tes/detail/".$tes;				
		return json_decode($this->getData($url));
	}

	function edit($tes,$data){
		$url = $this->config->item('url_node')."tes/edit/".$tes;				
		return json_decode($this->sendPost($url,$data));
	}

	function del($id){
		$url = $this->config->item('url_node')."tes/delete/".$id;				
		return json_decode($this->getData($url));
	}
	
	function status($tes,$status){
		$url = $this->config->item('url_node')."tes/status/".$tes."/".$status;				
		return json_decode($this->getData($url));
	}

	function pass($tes,$data){
		$url = $this->config->item('url_node')."tes/pass/".$tes;				
		return json_decode($this->sendPost($url,$data));
	}

	function resetpass($tes,$data){
		$url = $this->config->item('url_node')."tes/resetpass/".$tes;				
		return json_decode($this->sendPost($url,$data));
	}

	function add($data){
		$url = $this->config->item('url_node')."tes/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search($data){
		$url = $this->config->item('url_node')."tes/search/";				
		return json_decode($this->sendPost($url,$data));
	}

	function search_count($data){
		$url = $this->config->item('url_node')."tes/count/";				
		return json_decode($this->sendPost($url,$data));
	}

	function scan($tes,$data){
		$url = $this->config->item('url_node')."tes/scan/".$tes;				
		return json_decode($this->sendPost($url,$data));
	}

	function search_radius($data){
		$url = $this->config->item('url_node')."tes/radius/";				
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

	function get_detail_log($tes){
		$url = $this->config->item('url_node')."log/detail/".$tes;				
		return json_decode($this->getData($url));
	}
}

/* End of file tes_model.php */
/* Location: ./application/models/tes_Model.php */
