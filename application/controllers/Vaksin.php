<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vaksin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('vaksin_m');
		$this->load->model('daily_m');
		if(!$this->session->userdata('covid-admin')) redirect(base_url() . "auth/login");
	}	
	
    public function add(){ 
    	$data=array();
		$data['success']='';
		$data['error']='';
		$data['title']='Tambah Vaksin';
		if($this->input->post('save')){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Nama vaksin', 'required');
			$this->form_validation->set_rules('kelompok', 'kelompok', 'required');
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			} else{

				$input=array(
					'kelompok' => $this->input->post('kelompok'),
					'nama' => $this->input->post('name'),
					'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
					'kecamatan' => $this->input->post('kecamatan'),
					'kelurahan' =>  $this->input->post('kelurahan'),
					'alamat' =>  $this->input->post('alamat'),
					'tgl_lahir' =>  $this->input->post('tgl_lahir'),
					'umur' => $this->input->post('umur'),
					'phone' => $this->input->post('phone'),
					'faskes_vaksinasi' => $this->input->post('faskes'),
					// 'loc_lat' => $this->input->post('loc_lat'),
					// 'loc_long' => $this->input->post('loc_long'),
					'tgl_vaksinasi1' => $this->input->post('tgl_vaksinasi1'),
					'tgl_vaksinasi2' => $this->input->post('tgl_vaksinasi2')
				);
				$respo = $this->vaksin_m->add($input);
				if($respo->is_success){	
					$data['success']='Data berhasil ditambahkan';
				} else {				
					$data['error']='Data gagal ditambahkan';
				}
		    }
		}	
		$data['kelompok_status'] = ["Guru","Lansia","Nakes","Wartawan","Masyarakat"];
		$json = file_get_contents('data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');							
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$data['kec'] = $data['user_now']->level;
		} else {
			$data['kec'] = $data['kecamatan']['Kecamatan'][0];
		}
		$this->load->view('vaksin_add_v', $data);		
	}

	public function edit($id){  
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['title']='Ubah Vaksin';
		if($this->input->post('save')){
			$input=array(
				'kelompok' => $this->input->post('kelompok'),
				'nama' => $this->input->post('name'),
				'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
				'kecamatan' => $this->input->post('kecamatan'),
				'kelurahan' =>  $this->input->post('kelurahan'),
				'alamat' =>  $this->input->post('alamat'),
				'tgl_lahir' =>  $this->input->post('tgl_lahir'),
				'umur' => $this->input->post('umur'),
				'phone' => $this->input->post('phone'),
				'faskes_vaksinasi' => $this->input->post('faskes'),
				// 'loc_lat' => $this->input->post('loc_lat'),
				// 'loc_long' => $this->input->post('loc_long'),
				'tgl_vaksinasi1' => $this->input->post('tgl_vaksinasi1'),
				'tgl_vaksinasi2' => $this->input->post('tgl_vaksinasi2')
			);
			$respo = $this->vaksin_m->edit($id,$input);
			if($respo->is_success){				
				$data['success']='Data berhasil diubah';
			} else {				
				$data['error']='Data gagal diubah';
			}								
		}
		$data['data'] = $this->vaksin_m->get_detail($id)->data;
		if(!$data['data']){
			$data['error']='Tidak ada data';
		}	
		$data['kelompok_status'] = ["Guru","Lansia","Nakes","Wartawan","Masyarakat"];
		$json = file_get_contents('data-sampang.json');
		$data['kecamatan'] = json_decode($json,true);
		$data['user_now'] = $this->session->userdata('covid-admin');					
		$this->load->view('vaksin_edit_v', $data);		
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
		if($this->input->get('grup')){
			$data['grup'] = $this->input->get('grup');
			$query['kelompok'] = $data['grup'];
			$query2['kelompok'] = $data['grup'];
		}
		$data['kelompok_status'] = ["Guru","Lansia","Nakes","Wartawan","Masyarakat"];
		
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
		$data['data'] = $this->vaksin_m->search($query)->data;
		$data['total'] = $this->vaksin_m->search_count($query2)->data;
		$data['pagination'] = $this->vaksin_m->page($data['total'],$limit,$hal);
		$this->load->view('vaksin_v', $data);
	}


	

	public function grafik(){
		$data=array();
		$data['success']='';
		$data['error']='';
		$data['user_now'] = $this->session->userdata('covid-admin');

		$data['title']='Tren Grafik - Vaksinasi Covid-19';
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
		$data['kelompok_status'] = ["Guru","Lansia","Nakes","Wartawan","Masyarakat"];
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// exit();
		$this->load->view('vaksin_graph_v', $data);
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
		$data['grup'] = '';
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
		if($this->input->get('grup')){
			$data['grup'] = $this->input->get('grup');
			$query['kelompok'] = $data['grup'];
			$query2['kelompok'] = $data['grup'];
		}
		
		$data['kelompok_status'] = ["Guru","Lansia","Nakes","Wartawan","Masyarakat"];
		
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
		$data['total'] = $this->vaksin_m->search_count($query2)->data;
		$data['total'] = ($data['total'])?$data['total']:0;

		$data['limit'] = $limit;
		$data['current'] = $this->daily_m->today()->data;
		// echo '<pre>';
		// 	print_r($data);
		// 	echo '</pre>';
		// 	exit();
		$this->load->view('vaksin_maps_v', $data);
	}

	public function get_data_vaksin(){
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
		if($this->input->get('grup')){
			$query['kelompok'] = $this->input->get('grup');
		}

		$data['user_now'] = $this->session->userdata('covid-admin');
		if($data['user_now']->level != 'admin' && $data['user_now']->level != 'master-admin' && $data['user_now']->level != 'pusat'){
			$query['kecamatan'] = $data['user_now']->level;
		} 
		$data['data'] = $this->vaksin_m->search($query)->data;
		$res = array();
		foreach ($data['data'] as $key => $value) {
			if(!empty($value->lokasi)){
				if($value->tgl_lahir)
					$umur = date_diff(date_create(date( "Y-m-d", strtotime( $value->tgl_lahir))), date_create('today'))->y;
				else 
					$umur = $value->umur;
				$res[] = array(
					'nama' => $value->nama,
					'umur' => $umur,
					'phone' => $value->phone,
					'alamat' => $value->alamat,
					'kelompok' => $value->kelompok,
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
		$this->load->view('vaksin_graph_v2', $data);
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
	            $kode_import = date("dhis");
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
   		$this->load->view('vaksin_import_v', $data);	
	}

	function excel_format_puskesmas($sheet, $start_row, $end_row, $kode_import,$loc,$lng){
		$data_excel = array();
	    $numrow = 1;
		foreach($sheet as $row){
            if($numrow >= $start_row){
				$item['kelompok'] = ucwords(strtolower($row['J'])); 
				$item['nama'] = $row['C'] ;
				$item['umur'] =  strtolower($row['D']);
				if($row['E'] == 'L' || strtolower($row['E']) == 'laki-laki' || strtolower($row['E']) == 'laki - laki' || strtolower($row['E']) == 'pria' )
					$item['jenis_kelamin'] = 'Laki-laki';
				else if($row['E'] == 'P' || strtolower($row['E']) == 'perempuan' || strtolower($row['E']) == 'wanita')
					$item['jenis_kelamin'] = 'Perempuan';
				else 
					$item['jenis_kelamin'] = '-';
				$item['kecamatan'] = ucwords(strtolower($row['G']));
				$item['kelurahan'] = ucwords(strtolower($row['H']));
				$item['faskes'] = $row['K'];
				$item['alamat'] = $row['F'];
				$item['phone'] = $row['I'];
				if($row['B'])
					$item['date_add'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['B'])));
				else 
					$item['date_add'] = '';

				if($row['L'])
					$item['tgl_vaksinasi1'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['L'])));
				else 
					$item['tgl_vaksinasi1'] = '';

				if($row['M'])
					$item['tgl_vaksinasi2'] = date("Y-m-d",strtotime(str_replace('/', '-', $row['M'])));
				else 
					$item['tgl_vaksinasi2'] = '';

				$cek_kecamatan = $this->cekkecamatan($item['kecamatan']);
				$cek_kelurahan = $this->cekkecamatan($item['kecamatan'],$item['kelurahan']);
				// echo $row['C'].' '.$row['B'].' '.$row['K'].' - '.$item['kecamatan'].' - '.$item['kelurahan'].' - '.$item['date_add'].' - '.$item['tgl_vaksinasi1'].' - '.$item['tgl_vaksinasi2'].' kecamatan'.$cek_kecamatan.' -- kelurahan'.$cek_kelurahan.'<br/>';
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
		$input=array(
			'kelompok' => $this->input->post('kelompok'),
			'nama' => $this->input->post('nama'),
			'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
			'kecamatan' => $this->input->post('kecamatan'),
			'kelurahan' =>  $this->input->post('kelurahan'),
			'alamat' =>  $this->input->post('alamat'),
			'tgl_lahir' =>  $this->input->post('tgl_lahir'),
			'umur' => $this->input->post('umur'),
			'phone' => $this->input->post('phone'),
			'faskes_vaksinasi' => $this->input->post('faskes'),
			// 'loc_lat' => $this->input->post('loc_lat'),
			// 'loc_long' => $this->input->post('loc_long'),
			'tgl_vaksinasi1' => $this->input->post('tgl_vaksinasi1'),
			'tgl_vaksinasi2' => $this->input->post('tgl_vaksinasi2'),
			'date_add' => $this->input->post('date_add'),
			'kode_import' => $this->input->post('kode_import')
		);

		$respo = $this->vaksin_m->add($input);
		if($respo->is_success){	
			echo 'success';
		} else {				
			echo 'error';
		}
	}

	public function delete($id=''){					
		//if(!$this->antrian_m->cek_hapus_g($data->NIP)){
			$del=$this->vaksin_m->del($id);
			if($del->is_success){
				redirect(base_url().'vaksin/?alert=success') ; 			
			} 
		//}
		redirect(base_url().'vaksin/?alert=failed') ; 			
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
