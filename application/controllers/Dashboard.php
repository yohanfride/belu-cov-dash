<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {

	public function __construct() {

        parent::__construct();        
		$this->load->model('user_m');
		$this->load->model('qrcode_m');
		$this->load->model('gugustugas_m');
		$this->load->model('user_m');
		$this->load->model('qrcode_m');
		$this->load->model('gugustugas_m');
		$this->load->model('homeslide_m');
		$this->load->model('infografis_m');
		$this->load->model('faskes_m');
		$this->load->model('video_m');
		$this->load->model('daily_m');
		if(!$this->session->userdata('covid-admin')) redirect(base_url() . "auth/login");
    }

	public function index()
	{        
		$data=array();
		$data['title']='Beranda';
		$data['user_now'] = $this->session->userdata('covid-admin');		
		$data['user_now']->role = $this->session->userdata('covid-admin-role');
		$data['str_date'] = date("Y-m-d");
		$data['end_date'] = date("Y-m-d");
		
		if($this->input->get('str')){
			$data['str_date'] = $this->input->get('str');
			$data['end_date'] = $this->input->get('str');
		}

		
		
		if($data['user_now']->level == 'admin' || $data['user_now']->level == 'master-admin' || $data['user_now']->level == 'pusat'){
			///get dailes///
			if($data['str_date'] == date("Y-m-d")){	
				$data['new'] = $this->daily_m->today()->data;
			} else {
				$yesterday = date('Y-n-j',strtotime($data['str_date']));
				$data['new'] = $this->daily_m->search(array('date_only'=>$yesterday));
				print_r($data['new']);
				exit();
				if(!$data['new']){
					$data['error_found'] = true;
				} else {
					$data['new'] = $data['new'][0];
				}
			}
			$yesterday = date('Y-n-j',strtotime("-1 days",strtotime($data['str_date'])));
			$data['old'] = $this->daily_m->search(array('date_only'=>$yesterday))->data;
			if(!$data['old']) 
				$data['old'] = array();
			else 
				$data['old'] = $data['old'][0];
			$res = $this->hitung_kecamatan($data['new']);
			$data['most_kec'] = $res[0];
			$data['most_kec2'] = $res[1];
			//-----------///

			///get Pasien///
			$src = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date']
			);
			$data['new_user'] = $this->user_m->search_count($src)->data;
			$src = array(
				"str_date" => date("Y-m-d",strtotime("-1 days",strtotime($data['str_date']))),
				"end_date" => date("Y-m-d",strtotime("-1 days",strtotime($data['end_date'])))
			);
			$data['old_user'] = $this->user_m->search_count($src)->data;		
			//-----------///
			///get Log Montoring///
			$limit = 10;
			$query = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date'],
				'limit' => $limit,
				'skip' => 0
			);
			$data['log_data'] = $this->user_m->search_log($query)->data;
			$query2 = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date']
			);
			$data['log_total'] = $this->user_m->search_count_log($query2)->data;
			//-----------///
			///get User without QR///
			$data['user_all'] = $this->user_m->search_count(array())->data;
			$data['user_no_qr'] = $this->user_m->search_count(array('noqr'=>true))->data;
			//-----------///
			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			// exit();

			$this->load->view('dashboard_v', $data);
		} else {
			$data['kec'] =  $data['user_now']->level;

			///get dailes///
			if($data['str_date'] == date("Y-m-d")){	
				$data['new'] = $this->daily_m->today()->data->kecamatan->{$data['kec']};
			} else {
				$yesterday = date('Y-n-j',strtotime($data['str_date']));
				$data['new'] = $this->daily_m->search(array('date_only'=>$yesterday))->data;
				if(!$data['new']){
					$data['error_found'] = true;
				} else {
					$data['new'] = $data['new'][0]->kecamatan->{$data['kec']};
				}
			}
			$yesterday = date('Y-n-j',strtotime("-1 days",strtotime($data['str_date'])));
			$data['old'] = $this->daily_m->search(array('date_only'=>$yesterday))->data;
			if(!$data['old']) 
				$data['old'] = array();
			else 
				$data['old'] = $data['old'][0]->kecamatan->{$data['kec']};

			
			///get Pasien///
			$src = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date'],
				"kecamatan" => $data['kec']
			);
			$data['new_user'] = $this->user_m->search_count($src)->data;
			$src = array(
				"str_date" => date("Y-m-d",strtotime("-1 days",strtotime($data['str_date']))),
				"end_date" => date("Y-m-d",strtotime("-1 days",strtotime($data['end_date']))),
				"kecamatan" => $data['kec']
			);
			$data['old_user'] = $this->user_m->search_count($src)->data;		
			//-----------///
			///get Log Montoring///
			$limit = 10;
			$query = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date'],
				'limit' => $limit,
				'skip' => 0,
				"kecamatan" => $data['kec']
			);
			$data['log_data'] = $this->user_m->search_log($query)->data;
			$query2 = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date'],
				"kecamatan" => $data['kec']
			);
			$data['log_total'] = $this->user_m->search_count_log($query2)->data;
			//-----------///
			///get User without QR///
			$data['user_all'] = $this->user_m->search_count(array())->data;
			$data['user_no_qr'] = $this->user_m->search_count(array('noqr'=>true))->data;

			// echo '<pre>';
			// print_r($data);
			// echo '</pre>';
			// exit();


			$this->load->view('dashboard_gugustugas_v', $data);
		}

        //$data['user'] = $this->auth_m->get_admin_by_id($this->session->userdata('antrian_admin'));        		
	}	

	function hari($i){
		$days = ['Minggu','Senin', 'Selasa','Rabu','Kamis','Jumat','Sabtu'];
		return $days[$i];
	}

	function bulan($i){
		$days = array("Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $days[$i-1];
	}

	function hitung_kecamatan($data){
		if($data){
			$up_kec=''; $up_val = 0;
	        $low_kec=''; $low_val = 100000;
	        foreach($data->kecamatan as $kec_key => $kec_value){

	         	$confirm = (int)$kec_value->terkonfirmasi;
	          	if($up_val<$confirm){
	          		$up_kec = $kec_key;
	          		$up_val = $confirm;
	          	}
	          	if($low_val>$confirm){
	          		$low_kec = $kec_key;
	          		$low_val = $confirm;
	          	}
	        }
	        return [$up_kec,$low_kec];
		} else {
			return ['',''];
		}
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
