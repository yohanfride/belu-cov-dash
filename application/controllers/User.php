<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
		$this->load->model('daily_m');
		if(!$this->session->userdata('covid-admin')) redirect(base_url() . "auth/login");
	}	
	
    public function add(){ 
    	$data=array();
		$data['success']='';
		$data['error']='';
		$data['title']='Tambah User';
		if($this->input->post('save')){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Nama User', 'required');
			$this->form_validation->set_rules('level', 'Level', 'required');
			$this->form_validation->set_rules('level_status', 'Level Status', 'required');
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			} else{
				if($this->input->post('level') == 'terkonfirmasi'){
					$gejala = $this->input->post('gejala');
				} else {
					$gejala = '';
				}
				$date_add = $this->input->post('date_add');

				if($this->input->post('level') != 'terkonfirmasi'){
					$date_end =  date( 'Y-m-d', strtotime("+14 days",strtotime($date_add)));
				} else {
					$date_end =date( 'Y-m-d', strtotime("+500 days",strtotime($date_add)));
				}
				$input=array(
					'level' => $this->input->post('level'),
					'level_status' => $this->input->post('level_status'),
					'konfirmasi_gejala' => $gejala,
					'nama' => $this->input->post('name'),
					'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
					'kecamatan' => $this->input->post('kecamatan'),
					'kelurahan' =>  $this->input->post('kelurahan'),
					'alamat' =>  $this->input->post('alamat'),
					'tgl_lahir' =>  $this->input->post('tgl_lahir'),
					'umur' => $this->input->post('umur'),
					'phone' => $this->input->post('phone'),
					'riwayat_perjalanan' =>  $this->input->post('riwayat_perjalanan'),
					'status_pantau' => $this->input->post('status_pantau'),
					'puskesmas' => $this->input->post('puskesmas'),
					'loc_lat' => $this->input->post('loc_lat'),
					'loc_long' => $this->input->post('loc_long'),
					'keluhan' =>  $this->input->post('keluhan'),
					'tgl_pemantauan_start' => $date_add,
					'tgl_pemantauan_end' => $date_end
				);
				$respo = $this->user_m->add($input);
				if($respo->is_success){	
					$data['success']='Data berhasil ditambahkan';
				} else {				
					$data['error']='Data gagal ditambahkan';
				}
		    }
		}	
		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
		$json = file_get_contents('data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');							
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$data['kec'] = $data['user_now']->level;
		} else {
			$data['kec'] = $data['kecamatan']['Kecamatan'][0];
		}
		$this->load->view('user_add_v', $data);		
	}

	public function edit($id){  
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['title']='Ubah User';
		if($this->input->post('save')){
			if($this->input->post('level') == 'terkonfirmasi'){
				$gejala = $this->input->post('gejala');
			} else {
				$gejala = '';
			}
			$date_add = $this->input->post('date_add');
			if($this->input->post('level') != 'terkonfirmasi'){
				$date_end =  date( 'Y-m-d', strtotime("+14 days",strtotime($date_add)));
			} else {
				$date_end =date( 'Y-m-d', strtotime("+500 days",strtotime($date_add)));
			}
			$input=array(
				'level' => $this->input->post('level'),
				'level_status' => $this->input->post('level_status'),
				'konfirmasi_gejala' => $gejala,
				'nama' => $this->input->post('nama'),
				'tgl_lahir' =>  $this->input->post('tgl_lahir'),
				'umur' => $this->input->post('umur'),
				'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kelurahan' =>  $this->input->post('kelurahan'),
				'alamat' =>  $this->input->post('alamat'),
				'phone' => $this->input->post('phone'),
				'loc_lat' => $this->input->post('loc_lat'),
				'loc_long' => $this->input->post('loc_long'),
				'status_pantau' => $this->input->post('status_pantau'),
				'puskesmas' => $this->input->post('puskesmas'),
				'riwayat_perjalanan' =>  $this->input->post('riwayat_perjalanan'),
				'keluhan' =>  $this->input->post('keluhan'),
				'tgl_pemantauan_start' => $date_add,
				'tgl_pemantauan_end' => $date_end
			);
			$respo = $this->user_m->edit($id,$input);
			if($respo->is_success){				
				$data['success']='Data berhasil diubah';
			} else {				
				$data['error']='Data gagal diubah';
			}								
		}
		$data['data'] = $this->user_m->get_detail($id)->data;
		if(!$data['data']){
			$data['error']='Tidak ada data';
		}	
		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
		$json = file_get_contents('data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');					
		$this->load->view('user_edit_v', $data);		
	}

    public function index(){        
		$data=array();
		$data['success']='';
		$data['error']='';
		if($this->input->get('alert')=='success') $data['success']='Data berhasil dihapus';	
		if($this->input->get('alert')=='failed') $data['error']="Data gagal dihapus";
		$data['title']='Tampilan tabel - Pasien Covid-19';

		$hal = $this->input->get('hal');
		if( $this->input->get('hal') == '' ) $hal = 1;
		$data['kec'] = '';
		$data['kel'] = '';
		$data['nama'] = '';
		$data['lvl'] = '';
		$data['lvlstat'] = '';
		$data['gejala'] = '';
		$limit = 20;
		$query = array(
			'limit' => $limit,
			'skip' => ($hal-1) * $limit
		);
		$query2 = array();

		if($this->input->get('kec')){
			$data['kec'] = $this->input->get('kec');
			$query['kecamatan'] = $data['kec'];
			$query2['kecamatan'] = $data['kec'];
		}
		if($this->input->get('kel')){
			$data['kel'] = $this->input->get('kel');
			$query['kelurahan'] = $data['kel'];
			$query2['kelurahan'] = $data['kel'];
		}
		if($this->input->get('nama')){
			$data['nama'] = $this->input->get('nama');
			$query['nama'] = $data['nama'];
			$query2['nama'] = $data['nama'];
		}
		if($this->input->get('lvl')){
			$data['lvl'] = $this->input->get('lvl');
			$query['level'] = $data['lvl'];
			$query2['level'] = $data['lvl'];
		}
		if($this->input->get('lvlstat')){
			$data['lvlstat'] = $this->input->get('lvlstat');
			$query['level_status'] = $data['lvlstat'];
			$query2['level_status'] = $data['lvlstat'];
		}
		if($this->input->get('gejala')){
			$data['gejala'] = $this->input->get('gejala');
			$query['konfirmasi_gejala'] = $data['gejala'];
			$query2['konfirmasi_gejala'] = $data['gejala'];
		}

		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
		
		$json = file_get_contents('./data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$query['kecamatan'] = $data['user_now']->level;
			$query2['kecamatan'] = $data['user_now']->level;
			$data['kec'] =  $data['user_now']->level;
		} else {
			$data['pusat'] = true;
		}
		$data['data'] = $this->user_m->search($query)->data;
		$data['total'] = $this->user_m->search_count($query2)->data;
		$data['pagination'] = $this->user_m->page($data['total'],$limit,$hal);
		$this->load->view('user_v', $data);
	}

	public function detaillog($id){  
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['title']='Ubah User';
		$data['log'] = $this->user_m->get_detail_log($id)->data;
		if($data['log']){
			$data['data'] = $this->user_m->get_detail($data['log']->iduser)->data;
			if(!$data['data']){
				$data['error']='Tidak ada data';
			}
		} else {
			$data['error']='Tidak ada data';
		}

		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
		$json = file_get_contents('data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');					
		$this->load->view('user_log_detail_v', $data);		
	}

	public function log(){        
		$data=array();
		$data['success']='';
		$data['error']='';

		$data['title']='Manajemen Log - Pasien Covid-19';

		$hal = $this->input->get('hal');
		if( $this->input->get('hal') == '' ) $hal = 1;
		
		$data['str_date'] = date("Y-m-d");
		$data['end_date'] = date("Y-m-d");
		$data['kec'] = '';
		$data['kel'] = '';
		$data['nama'] = '';
		$data['lvl'] = '';
		$data['lvlstat'] = '';
		$data['gejala'] = '';
		if($this->input->get('str')){
			$data['str_date'] = $this->input->get('str');
		}
		if($this->input->get('end')){
			$data['end_date'] = $this->input->get('end');
		}
		$limit = 20;
		$query = array(
			"str_date" => $data['str_date'],
			"end_date" => $data['end_date'],
			'limit' => $limit,
			'skip' => ($hal-1) * $limit
		);
		$query2 = array(
			"str_date" => $data['str_date'],
			"end_date" => $data['end_date']
		);

		if($this->input->get('kec')){
			$data['kec'] = $this->input->get('kec');
			$query['kecamatan'] = $data['kec'];
			$query2['kecamatan'] = $data['kec'];
		}
		if($this->input->get('kel')){
			$data['kel'] = $this->input->get('kel');
			$query['kelurahan'] = $data['kel'];
			$query2['kelurahan'] = $data['kel'];
		}
		if($this->input->get('nama')){
			$data['nama'] = $this->input->get('nama');
			$query['nama'] = $data['nama'];
			$query2['nama'] = $data['nama'];
		}
		if($this->input->get('lvl')){
			$data['lvl'] = $this->input->get('lvl');
			$query['level'] = $data['lvl'];
			$query2['level'] = $data['lvl'];
		}
		if($this->input->get('lvlstat')){
			$data['lvlstat'] = $this->input->get('lvlstat');
			$query['level_status'] = $data['lvlstat'];
			$query2['level_status'] = $data['lvlstat'];
		}

		if($this->input->get('gejala')){
			$data['gejala'] = $this->input->get('gejala');
			$query['konfirmasi_gejala'] = $data['gejala'];
			$query2['konfirmasi_gejala'] = $data['gejala'];
		}

		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
		
		$json = file_get_contents('./data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);

		$data['user_now'] = $this->session->userdata('covid-admin');
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$query['kecamatan'] = $data['user_now']->level;
			$query2['kecamatan'] = $data['user_now']->level;
			$data['kec'] =  $data['user_now']->level;
		} else {
			$data['pusat'] = true;
		}

		$data['data'] = $this->user_m->search_log($query)->data;
		$data['total'] = $this->user_m->search_count_log($query2)->data;
		$data['pagination'] = $this->user_m->page($data['total'],$limit,$hal);
		$this->load->view('user_log_v', $data);
	}

	public function maps(){        
		$data=array();
		$data['success']='';
		$data['error']='';
		if($this->input->get('alert')=='success') $data['success']='Data berhasil dihapus';	
		if($this->input->get('alert')=='failed') $data['error']="Data gagal dihapus";
		$data['title']='Tampilan Maps - Pasien Covid-19';

		$hal = $this->input->get('hal');
		if( $this->input->get('hal') == '' ) $hal = 1;
		$data['kec'] = '';
		$data['kel'] = '';
		$data['lvl'] = '';
		$data['lvlstat'] = '';
		$data['gejala'] = '';
		$limit = 200;
		$query = array(
			'status_pantau' => 1,
			'limit' => $limit,
			'skip' => ($hal-1) * $limit
		);
		$query2 = array('status_pantau' => 1);

		if($this->input->get('kec')){
			$data['kec'] = $this->input->get('kec');
			$query['kecamatan'] = $data['kec'];
			$query2['kecamatan'] = $data['kec'];
		}
		if($this->input->get('kel')){
			$data['kel'] = $this->input->get('kel');
			$query['kelurahan'] = $data['kel'];
			$query2['kelurahan'] = $data['kel'];
		}
		if($this->input->get('lvl')){
			$data['lvl'] = $this->input->get('lvl');
			$query['level'] = $data['lvl'];
			$query2['level'] = $data['lvl'];
		}
		if($this->input->get('lvlstat')){
			$data['lvlstat'] = $this->input->get('lvlstat');
			$query['level_status'] = $data['lvlstat'];
			$query2['level_status'] = $data['lvlstat'];
		}
		if($this->input->get('gejala')){
			$data['gejala'] = $this->input->get('gejala');
			$query['konfirmasi_gejala'] = $data['gejala'];
			$query2['konfirmasi_gejala'] = $data['gejala'];
		}

		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
		
		$json = file_get_contents('./data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$query['kecamatan'] = $data['user_now']->level;
			$query2['kecamatan'] = $data['user_now']->level;
			$data['kec'] =  $data['user_now']->level;
		} else {
			$data['pusat'] = true;
		}
		$data['total'] = $this->user_m->search_count($query2)->data;
		$data['total'] = ($data['total'])?$data['total']:0;

		$data['limit'] = $limit;
		$data['current'] = $this->daily_m->today()->data;
		// echo '<pre>';
		// 	print_r($data);
		// 	echo '</pre>';
		// 	exit();
		$this->load->view('user_maps_v', $data);
	}

	public function get_data_user(){
		$data=array();
		$hal = $this->input->get('hal');
		if( $this->input->get('hal') == '' ) $hal = 1;
		$limit = 200;
		$query = array(
			'status_pantau' => 1,
			'limit' => $limit,
			'skip' => ($hal-1) * $limit
		);
		if($this->input->get('kec')){
			$query['kecamatan'] = $this->input->get('kec');
		}
		if($this->input->get('kel')){
			$query['kelurahan'] = $this->input->get('kel');
		}
		if($this->input->get('lvl')){
			$query['level'] = $this->input->get('lvl');
		}
		if($this->input->get('lvlstat')){
			$query['level_status'] = $this->input->get('lvlstat');
		}
		if($this->input->get('gejala')){
			$query['konfirmasi_gejala'] = $this->input->get('gejala');
		}

		$data['user_now'] = $this->session->userdata('covid-admin');
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$query['kecamatan'] = $data['user_now']->level;
		} 
		$data['data'] = $this->user_m->search($query)->data;
		$res = array();
		foreach ($data['data'] as $key => $value) {
			if(!empty($value->lokasi)){
				$lvlstat = $value->level_status;
				if($value->level_status == "Dipantau")
					$lvlstat = "Dalam Pemantauan";
				if($value->level_status == "Dirawat")
					$lvlstat = "Dalam Perawatan";
				if($value->level_status == "Pengawasan")
					$lvlstat = "Dalam Pengawasan";
				if($value->level_status == "Selesai dipantau")
					$lvlstat = "Selesai Pemantauan";

				if($value->tgl_lahir)
					$umur = date_diff(date_create(date( "Y-m-d", strtotime( $value->tgl_lahir))), date_create('today'))->y;
				else 
					$umur = $value->umur;

				$res[] = array(
					'nama' => $value->nama,
					'umur' => $umur,
					'phone' => $value->phone,
					'alamat' => $value->alamat,
					'level' => $value->level,
					'levelstat' => $lvlstat,
					'konfirmasi_gejala' =>  $value->konfirmasi_gejala,
					'jenis_kelamin' => $value->jenis_kelamin,
					'kelurahan' => $value->kelurahan,
					'kecamatan' => $value->kecamatan,
					'last_update' => date( "Y-m-d H:i:s", strtotime( $value->date_updated)) ,
					'latitude' => $value->lokasi->coordinates[1],
					'longitude' => $value->lokasi->coordinates[0],
				);
			}
		}
		header('Content-Type: application/json');
    	echo json_encode( $res );
	}

	public function grafik(){
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['user_now'] = $this->session->userdata('covid-admin');

		$data['title']='Tren Grafik - Pasien Covid-19';
		$data['str_date'] = '';
		$data['end_date'] = '';
		$data['kec'] = '';
		if($this->input->get('str')){
			$data['str_date'] = $this->input->get('str');
		}
		if($this->input->get('end')){
			$data['end_date'] = $this->input->get('end');
		}

		if(!empty($data['str_date']) && !empty($data['str_date']) ){
			$query2 = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date'],
				'sort'=>'date_add'
			);
			$data['dailes'] = $this->daily_m->search($query2)->data;	
		} else {
			$data['str_date'] = date("Y-m-d");
			$data['end_date'] = date("Y-m-d");
		}
		if($this->input->get('kec')){
			$data['kec'] = $this->input->get('kec');
		}	
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$data['kec'] =  $data['user_now']->level;
		} else {
			$data['pusat'] = true;
		}
		$json = file_get_contents('./data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);	
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// exit();
		$this->load->view('user_graph_v', $data);
	}

	public function grafik2(){
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['user_now'] = $this->session->userdata('covid-admin');

		$data['title']='Tren Grafik - Pasien Covid-19';
		$data['str_date'] = '';
		$data['end_date'] = '';
		$data['kec'] = '';
		if($this->input->get('str')){
			$data['str_date'] = $this->input->get('str');
		}
		if($this->input->get('end')){
			$data['end_date'] = $this->input->get('end');
		}

		if(!empty($data['str_date']) && !empty($data['str_date']) ){
			$query2 = array(
				"str_date" => $data['str_date'],
				"end_date" => $data['end_date'],
				'sort'=>'date_add'
			);
			$data['dailes'] = $this->daily_m->search($query2)->data;	
		} else {
			$data['str_date'] = date("Y-m-d");
			$data['end_date'] = date("Y-m-d");
		}
		if($this->input->get('kec')){
			$data['kec'] = $this->input->get('kec');
		}	
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$data['kec'] =  $data['user_now']->level;
		} else {
			$data['pusat'] = true;
		}
		$json = file_get_contents('./data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);	
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// exit();
		$this->load->view('user_graph_v2', $data);
	}

	public function import(){
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['title']='Import Excel - Pasien Covid-19';
		if($this->input->post('save')){
			include APPPATH.'libraries/PHPExcel/PHPExcel.php';
			$config['upload_path'] = 'assets/excel';
	        $config['allowed_types'] = 'xlsx|xls|csv';
	        $config['max_size'] = '10000';
	        $config['encrypt_name'] = true;
	        $this->load->library('upload', $config);
	        if (!$this->upload->do_upload('file')) {
	            $data['error']= $this->upload->display_errors();//'Import gagal';
	        } else {
	            $data_upload = $this->upload->data();
	            $excelreader     = new PHPExcel_Reader_Excel2007();
	            $loadexcel         = $excelreader->load('assets/excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
	            $index = $this->input->post('index');
	            if($index) $index = 0;
	            $sheet             = $loadexcel->getActiveSheet($index)->toArray(null, true, true ,true);
	            $lat = $this->input->post('lat');
	            $lng = $this->input->post('lng');
	            $str = $this->input->post('start_line');
	            $end = $this->input->post('end_line');
	            $kec = $this->input->post('kecamatan');
	            $kode_import = date("dhis");
	            //$data_excel = $this->excel_format($sheet,$kec,$str,$end,$kode_import,$lat,$lng);
	            $data_excel = $this->excel_format_puskesmas($sheet,$str,$end,$kode_import,$lat,$lng);

	            //delete file from server
	            unlink(realpath('assets/excel/'.$data_upload['file_name']));
	            //upload success
	            // echo "<pre>";
	            // print_r($data_excel);
	            // echo "</pre>";
	            // exit();
	            $data['import'] = $kode_import;
	            $data['import_count'] = count($data_excel);
	            $data['success']='Import dalam proses';         
	        }
	    }
		$json = file_get_contents('./data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');					
   		$this->load->view('user_impport_v', $data);	
	}

	function excel_camplong($sheet, $kecamatan, $start_row, $end_row, $kode_import,$loc,$lng){
		$data_excel = array();
	    $numrow = 1;
		foreach($sheet as $row){
            if($numrow >= $start_row){
				$item['level'] = strtolower($row['S']) ;
				if($row['W']){
					$item['status'] = 0;
					$item['level_status'] = 'Selesai dipantau';
				} else {
					$item['level_status'] = 'Dipantau';
					$item['status'] = 1;
				}
				$item['nama'] = $row['C'] ;
				if($row['E'] == 'L')
					$item['jenis_kelamin'] = 'Laki-laki';
				else 
					$item['jenis_kelamin'] = 'Perempuan';

				$item['kecamatan'] = $kecamatan ;
				$item['kelurahan'] = $row['H'];
				$item['alamat'] = $row['G'];
				$item['tgl_lahir'] = '';
				$item['umur'] =  strtolower($row['D']);
				$item['phone'] = '-';
				$item['riwayat_perjalanan'] = ($row['M'] != '')?$row['M']:$row['N'];
				$item['loc_lat'] = $loc;
				$item['loc_long'] = $lng;
				$item['date_add'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['J'])));
				$item['date_end'] = date("Y-m-d",strtotime(str_replace("'","", $row['X'])));;
				$keluhan = array();
				if($row['O']) $keluhan[] = 'Demam';
				if($row['P']) $keluhan[] = 'Batuk-Pilek';
				if($row['Q']) $keluhan[] = 'Sesak Nafas';
				if($row['R']) $keluhan[] = 'Gejala Lain';
				$item['keluhan'] = implode(', ', $keluhan);
				$item['kode_import'] = $kode_import ;
                array_push($data_excel,$item);
    		}
            $numrow++;
            if($numrow > $end_row)
            	break;
        }

        $fp = fopen('assets/import-json/'.$kode_import.'.json', 'w');
		fwrite($fp, json_encode($data_excel));
		fclose($fp);
        return $data_excel;
	}

	function excel_format($sheet, $kecamatan, $start_row, $end_row, $kode_import,$loc,$lng){
		$data_excel = array();
	    $numrow = 1;
	    /*
		$data['level_status'] = array(
			"terkonfirmasi" => ["Dirawat", "Pengawasan" ,"Sembuh", "Meninggal","Dengan Gejala", "Tanpa Gejala"],
			"suspek" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"probable" => ["Isolasi", "Selesai Isolasi", "Meninggal"],
			"kontak_erat" => ["Isolasi", "Selesai Isolasi"],
			"pelaku_perjalanan" => ["Isolasi", "Selesai Isolasi"]
		);
	    */
		foreach($sheet as $row){
            if($numrow >= $start_row){
				$item['level'] = strtolower($row['P']) ;
				if($row['T']){
					$item['status'] = 0;
					$item['level_status'] = 'Selesai dipantau';
				} else {
					$item['level_status'] = 'Dipantau';
					$item['status'] = 1;
				}
				$item['nama'] = $row['C'] ;
				if($row['E'] == 'L')
					$item['jenis_kelamin'] = 'Laki-laki';
				else 
					$item['jenis_kelamin'] = 'Perempuan';

				$item['kecamatan'] = $kecamatan ;
				$item['kelurahan'] = $row['H'];
				$item['alamat'] = $row['G'];
				$item['tgl_lahir'] = '';
				$item['umur'] =  strtolower($row['D']);
				$item['phone'] = '-';
				$item['riwayat_perjalanan'] = ($row['M'] != '')?$row['M']:$row['N'];
				$item['loc_lat'] = $loc;
				$item['loc_long'] = $lng;
				$item['date_add'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['J'])));
				$item['date_end'] = date("Y-m-d",strtotime(str_replace("'","", $row['U'])));;
				$item['keluhan'] = $row['O'];
				$item['kode_import'] = $kode_import ;
                array_push($data_excel,$item);
    		}
            $numrow++;
            if($numrow > $end_row)
            	break;
        }

        $fp = fopen('assets/import-json/'.$kode_import.'.json', 'w');
		fwrite($fp, json_encode($data_excel));
		fclose($fp);
        return $data_excel;
	}

	function excel_format_puskesmas($sheet, $start_row, $end_row, $kode_import,$loc,$lng){
		$data_excel = array();
	    $numrow = 1;
		foreach($sheet as $row){
            if($numrow >= $start_row){
				$item['level'] = strtolower($row['P']) ;
				$item['level'] = str_replace(' ','_',$item['level']) ;
				$item['level_status'] = ucwords(strtolower($row['S'])); 
				
				if($item['level_status'] == "Selesai Dipantau"){
					$item['level_status'] = 'Selesai Isolasi';
				}

				if($item['level_status'] == "Baik"){
					$item['level_status'] = 'Selesai Isolasi';
				}

				if($item['level_status'] == "Dalam Pemantauan"){
					$item['level_status'] = 'Isolasi';
				}

				if($item['level_status']){
					if($item['level_status'] == 'Selesai Isolasi' || $row['T']){
						$item['status'] = 0;
					} else {
						$item['status'] = 1;
					}
				} else {
					if($item['level'] == 'probable' || $item['level'] == 'kontak_erat' || $item['level'] == 'pelaku_perjalanan'|| $item['level'] == 'suspek'){
						if($row['T']){
							$item['status'] = 0;
							$item['level_status'] = 'Selesai Isolasi';
						} else {
							$item['level_status'] = 'Isolasi';
							$item['status'] = 1;
						}	
					} else {
						$item['status'] = 1;
					}

					if($item['level'] == 'terkonfirmasi')
						$item['level_status'] = 'Dirawat';	
				}

				$item['nama'] = $row['C'] ;
				if($row['E'] == 'L')
					$item['jenis_kelamin'] = 'Laki-laki';
				else if($row['E'] == 'P')
					$item['jenis_kelamin'] = 'Perempuan';
				else 
					$item['jenis_kelamin'] = '-';

				$item['kecamatan'] = ucwords(strtolower($row['H']));
				$item['kelurahan'] = ucwords(strtolower($row['I']));
				$item['puskesmas'] = $row['L'];
				$item['alamat'] = $row['G'];
				$item['tgl_lahir'] = '';
				$item['umur'] =  strtolower($row['D']);
				$item['phone'] = '-';
				$item['riwayat_perjalanan'] = ($row['M'] != '')?$row['M']:$row['N'];
				
				$item['loc_lat'] = $row['Q'];
				$item['loc_long'] = $row['R'];

				if(!$item['loc_lat']){
					$item['loc_lat'] = ( rand(1,2000) - 1000 ) / 1000000 + $loc ;
					$item['loc_long'] = ( rand(1,2000) - 1000 ) / 1000000 + $lng ;
				}

				// if($row['K'])
				// 	$item['date_add'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['K'])));
				// else 
				if($row['B'])
					$item['date_add'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['B'])));
				else 
					$item['date_add'] = '';

				
				if($item['level'] == 'probable' || $item['level'] == 'kontak_erat' || $item['level'] == 'pelaku_perjalanan'|| $item['level'] == 'suspek'){
					/*if($row['U'])
						$item['date_end'] = date("Y-m-d",strtotime(str_replace("'","", $row['U'])));
					else*/ if($item['status'] == 0) 
						$item['date_end'] =  date( 'Y-m-d', strtotime("+14 days",strtotime($item['date_add'])));
					else 
						$item['date_end'] =date( 'Y-m-d', strtotime("+500 days",strtotime(date("Y-m-d"))));
				} else {
					if($item['status'] == 1)
						$item['date_end'] =date( 'Y-m-d', strtotime("+500 days",strtotime(date("Y-m-d"))));
				}
				
				$item['keluhan'] = $row['O'];
				if(!$this->cekkeluhan($item['keluhan'])){
					$item['konfirmasi_gejala'] = 'Tanpa Gejala';
				} else {
					$item['konfirmasi_gejala'] = 'Dengan Gejala';
				}
				
				$cek_kecamatan = $this->cekkecamatan($item['kecamatan']);
				$cek_kelurahan = $this->cekkecamatan($item['kecamatan'],$item['kelurahan']);
				// echo $row['C'].' '.$row['B'].' '.$row['K'].' - '.$item['kecamatan'].' - '.$item['kelurahan'].' - '.$item['date_add'].' - '.$item['date_end'].' kecamatan'.$cek_kecamatan.' -- kelurahan'.$cek_kelurahan.'<br/>';
				$item['kode_import'] = $kode_import ;
                array_push($data_excel,$item);
    		}
            $numrow++;
            if($numrow > $end_row)
            	break;
        }
        // exit();
        $fp = fopen('assets/import-json/'.$kode_import.'.json', 'w');
		fwrite($fp, json_encode($data_excel));
		fclose($fp);
        return $data_excel;
	}

	function cekkeluhan($test){
		$stat = false;
		$penyakit = ['batuk','demam','pusing','pilek','meriang','pneumonia','bapil','nyeri','sesak','penciuman','sakit'];
		$test = strtolower($test);
		foreach($penyakit as $p){
			if(strpos($test,$p)){
				$stat = true;
				break;
			}
		}
		return $stat;
	}

	function cekkecamatan($kec){
		$json = file_get_contents('data-sampang.json');
		$kecamatan = json_decode($json,true);
		$stat = 0;
		foreach ($kecamatan['Kecamatan'] as  $value) {
			if($value == $kec){
				$stat = 1;
				break;
			}
		}
		return $stat;
	}

	function cekkeluarahan($kec,$kel){
		$json = file_get_contents('data-sampang.json');
		$kecamatan = json_decode($json,true);
		$stat = 0;
		foreach ($kecamatan[$kec] as  $value) {
			if($value == $kel){
				$stat = 1;
				break;
			}
		}
		return $stat;
	}

	public function ajax_add(){
		$level = $this->input->post('level');
		$date_add = $this->input->post('date_add');		
		$input=array(
			'level' => $this->input->post('level'),
			'level_status' => $this->input->post('level_status'),
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kelurahan' =>  $this->input->post('kelurahan'),
			'alamat' =>  $this->input->post('alamat'),
			'tgl_lahir' =>  $this->input->post('tgl_lahir'),
			'umur' =>  $this->input->post('umur'),
			'phone' => $this->input->post('phone'),
			'riwayat_perjalanan' =>  $this->input->post('riwayat_perjalanan'),
			'loc_lat' => $this->input->post('loc_lat'),
			'loc_long' => $this->input->post('loc_long'),
			'date_add' => $date_add,
			'tgl_pemantauan_start' => $date_add,
			'tgl_pemantauan_end' => $this->input->post('date_end'),
			'keluhan' =>  $this->input->post('keluhan'),
			'puskesmas' => $this->input->post('puskesmas'),
			'konfirmasi_gejala' => $this->input->post('konfirmasi_gejala'),
			'kode_import' => $this->input->post('kode_import')
		);

		// if($item['level'] == 'probable' || $item['level'] == 'kontak erat' || $item['level'] == 'pelaku perjalanan'|| $item['level'] == 'suspek'){
		// 	$date_end = $this->input->post('date_end');	
		// 	if($date_end){
		// 		$date_end =  date( 'Y-m-d', strtotime("-6 days",strtotime($date_add)));
		// 		$input['date_end'] = $date_end;
		// 		$dateTimestamp1 = strtotime(date("Y-m-d")); 
		// 		$dateTimestamp2 = strtotime($date_end); 
		// 		if ($dateTimestamp1 > $dateTimestamp2) 
		// 			$input['status_pantau'] = false;
		// 	}
		// }

		if( $this->input->post('status') == 0 ){
			$input['status_pantau'] = $this->input->post('status');
		}
		$respo = $this->user_m->add($input);
		if($respo->is_success){	
			echo 'success';
		} else {				
			echo 'error';
		}
	}

	public function delete($id=''){					
		//if(!$this->antrian_m->cek_hapus_g($data->NIP)){
			$del=$this->user_m->del($id);
			if($del->is_success){
				redirect(base_url().'user/?alert=success') ; 			
			} 
		//}
		redirect(base_url().'user/?alert=failed') ; 			
	}

    public function _doupload_file($name,$target){
		$img						= $name;
		$config['file_name']  		= date('dmYHis').'_'.preg_replace("/[^0-9a-zA-Z ]/", "", $_FILES[$img]['name']);
		$config['upload_path'] 		= $target;
		$config['overwrite'] 		= FALSE;
		$config['allowed_types'] 	= '*';
		$config['max_size']			= '100000';
		$config['max_width']  		= '10000';
		$config['max_height']  		= '10000';
		$config['remove_spaces']  	= TRUE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($img)){
			$return['error'] 	 = $this->upload->display_errors();
			$return['file_name'] = '';
		}else{
			$data = array('upload_data' => $this->upload->data());
			$return['error'] 	 = '-';
			$return['file_name'] = $data['upload_data']['file_name'];
		}

		$this->upload->file_name = '';
		if($return['file_name']==''){
			return $return['error'];
			//return '-';
		}else{
			return $return['file_name'];
		}
	}


}

/* End of file  */
/* Location: ./application/controllers/ */
