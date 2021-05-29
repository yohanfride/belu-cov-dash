<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-edit"></i>
                        Edit Kasus Covid-19
                    </h4>
                </div>
            </div>
            <div class="row ">
                <ul class="nav responsive-tab">
                    <li class="nav-item" style="padding-left: 7px;">
                        <a style="padding: .5rem;" class="nav-link active" href="<?= base_url(); ?>"><i style="padding-right: 5px;" class="icon icon-home"></i>Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a style="padding: .5rem;" class="nav-link active" href="#"><i style="padding-right: 0px;" class="icon icon-keyboard_arrow_right"></i></a>
                    </li>
                    <li class="nav-item">
                        <a style="padding: .5rem;" class="nav-link" href="<?= base_url(); ?>user"><i style="padding-right: 5px;" class="icon icon-users"></i>Tampilan Tabel Kasus Covid-19</a>
                    </li>
                    <li class="nav-item">
                        <a style="padding: .5rem;" class="nav-link active" href="#"><i style="padding-right: 0px;" class="icon icon-keyboard_arrow_right"></i></a>
                    </li>
                    <li class="nav-item">
                        <a style="padding: .5rem;" class="nav-link" href="#"><i style="padding-right: 5px;" class="icon icon-pencil"></i>Edit</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="animatedParent animateOnce">
        <div class="container-fluid my-3">
            <form method="post" >
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body b-b">
                            <h4>Form Edit Kasus Covid-19</h4>
                            <?php if($error){ ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 14px;">&#10006;</span>
                                    </button>
                                    <strong>Peringatan!</strong> ulangi lagi.</span><br/><?= $error?> 
                                </div>
                            <?php } if($success){ ?>
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 14px;">&#10006;</span>
                                    </button>
                                    <strong>Proses Berhasil!</strong> <?= $success;?></span> 
                                </div>
                            <?php } ?>
                            <?php if($error != "Tidak ada data"){ ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" id="inputName" placeholder="Type Name"  name="name"  value="<?= $data->nama?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Tanggal Awal Pemantauan</label>
                                        <div class="input-group focused">
                                            <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="date_add" placeholder="Tahun - Bulan - Tanggal (yyyy-mm-dd)" value="<?=  (!empty($data->tgl_pemantauan_start))?date( "Y-m-d", strtotime( $data->tgl_pemantauan_start)):'' ?>">
                                            <span class="input-group-append">
                                                <span class="input-group-text add-on white">
                                                    <i class="icon-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-form-label">Status Pemantauan <span class="text-danger small ml-3">*)Data dimasukkan ke proses rekapitulasi</span> </label>
                                        <select id="inputState" class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                            <option <?= ($data->status_pantau == 1)?"selected":""; ?> value="laki-laki">Aktif (Data Dalam Pemantauan)</option>
                                            <option <?= ($data->status_pantau == 0)?"selected":""; ?> value="perempuan">Tidak Aktif (Data Tidak Dalam Pemantauan)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-form-label">Kondisi</label>
                                        <select  class="form-control" name="level" id="level" required>
                                            <option value="terkonfirmasi" <?= (strtoupper($data->level) == "TERKONFIRMASI")?"selected":""; ?> >Terkonfirmasi</option>
                                            <option value="suspek" <?= (strtoupper($data->level) == "SUSPEK")?"selected":""; ?> >Suspek</option>
                                            <option value="probable" <?= (strtoupper($data->level) == "PROBABLE")?"selected":""; ?> >Probable</option>
                                            <option value="kontak_erat" <?= (strtoupper($data->level) == "KONTAK_ERAT")?"selected":""; ?> >Kontak Erat</option>
                                            <option value="pelaku_perjalanan" <?= (strtoupper($data->level) == "PELAKU_PERJALANAN")?"selected":""; ?> >Pelaku Perjalanan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Status</label>
                                        <select class="form-control" name="level_status" id="level_status" required>
                                        <?php 
                                            if((strtoupper($data->level) == "TERKONFIRMASI"))
                                                $list = $level_status['terkonfirmasi'];   
                                            if((strtoupper($data->level) == "SUSPEK"))
                                                $list = $level_status['suspek'];
                                            if((strtoupper($data->level) == "PROBABLE"))
                                                $list = $level_status['probable'];
                                            if((strtoupper($data->level) == "KONTAK_ERAT"))
                                                $list = $level_status['kontak_erat'];
                                            if((strtoupper($data->level) == "PELAKU_PERJALANAN"))
                                                $list = $level_status['pelaku_perjalanan'];
                                            foreach($list as $l){ ?>
                                            <option value="<?= $l?>" <?= ( $data->level_status == $l )?"selected":""; ?>><?= $l?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <?php 
                                        if(isset($data->konfirmasi_gejala)){
                                            $konfirmasi_gejala = $data->konfirmasi_gejala;
                                        } else {
                                            $konfirmasi_gejala = '-';
                                        }
                                    ?>
                                    <div class="form-group" id="form_gejala">
                                        <label for="inputName" class="col-form-label">Status Konfirmasi</label>
                                        <select  class="form-control" name="gejala" id="gejala" >
                                            <option value="Dengan Gejala" <?= ($konfirmasi_gejala == "Dengan Gejala")?"selected":""; ?> >Dengan Gejala</option>
                                            <option value="Tanpa Gejala" <?= ($konfirmasi_gejala == "Tanpa Gejala")?"selected":""; ?> >Tanpa Gejala</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Tanggal Lahir</label>
                                        <div class="input-group focused">
                                            <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="tgl_lahir" value="<?=  (!empty($data->tgl_lahir))?date( "Y-m-d", strtotime( $data->tgl_lahir)):'' ?>" placeholder="Tanggal Lahir Pasien">
                                            <span class="input-group-append">
                                                <span class="input-group-text add-on white">
                                                    <i class="icon-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Umur</label>
                                        <input type="text" class="form-control" id="inputUmur" placeholder="Umur"  name="umur" value="<?= (array_key_exists("umur",$data))?$data->umur:''; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-form-label">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                            <option  value="-">-</option>
                                            <option <?= ($data->jenis_kelamin == "laki-laki")?"selected":""; ?> value="laki-laki">Laki-laki</option>
                                            <option <?= ($data->jenis_kelamin == "perempuan")?"selected":""; ?> value="perempuan">Perempuan</option>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">No. Telp.</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Phone"  name="phone"  value="<?= $data->phone?>">
                                    </div> 
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Keluhan</label>
                                        <textarea class="form-control r-0" id="keluhan" rows="3" style="resize: none;" name="keluhan" ><?= $data->keluhan ?></textarea>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Kecamatan</label>
                                        <select class="form-control" name="kecamatan" id="kecamatan" required>
                                        <?php foreach($kecamatan['Kecamatan'] as $l){ ?>
                                            <option value="<?= $l?>" <?= ( $data->kecamatan == $l )?"selected":""; ?> ><?= $l?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Kelurahan</label>
                                        <select class="form-control" name="kelurahan" id="kelurahan" required>
                                        <?php foreach($kecamatan[$data->kecamatan] as $l){ ?>
                                            <option value="<?= $l?>" <?= ( $data->kelurahan == $l )?"selected":""; ?> ><?= $l?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Puskesmas</label>
                                        <input type="text" class="form-control" id="puskesmas" placeholder="Puskesmas"  name="puskesmas"  value="<?= (array_key_exists("puskesmas",$data))?$data->puskesmas:''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Alamat</label>
                                        <textarea class="form-control r-0" id="alamat" rows="2" style="resize: none;" name="alamat"  required><?= $data->alamat ?></textarea>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Lokasi</label>
                                        <div id="map" style="min-width: 400px; width: 100%; min-height: 195px;"></div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">
                                            Lokasi 
                                            <button class="btn btn-sm btn-success" type="button" onclick="getmylocation()" style="position: absolute; right: 1px; top: 35px; z-index: 100;">Lokasi Saya</button> 
                                            <?php if(array_key_exists('lokasi',$data)){ ?>
                                             <button class="btn btn-sm btn-primary" type="button" onclick="backlocation()" style="position: absolute; right: 1px; top: 70px; z-index: 100;">Lokasi Sebelumnya</button>    
                                            <?php } ?>
                                        </label>
                                        <div id="map" style="min-width: 400px; width: 100%; min-height: 195px; z-index: 1;"></div>
                                        <input type="hidden" class="form-control" id="location-lat"  name="loc_lat">
                                        <input type="hidden" class="form-control" id="location-lng"  name="loc_long">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Riwayat Perjalanan</label>
                                        <textarea class="form-control r-0" id="exampleFormControlTextarea2" rows="3" style="resize: none;" name="riwayat_perjalanan"  required><?= $data->riwayat_perjalanan ?></textarea>
                                    </div>
                                </div>
                            </div> 
                            <button type="submit" class="btn btn-primary" name="save" value="save">Ubah</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

<?php include('footer.php'); ?> 
<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css" />
<script src="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js"></script>

<script>
    <?php
        if(!array_key_exists('lokasi',$data)){
            $data->lokasi = false;
        }
    ?>
    // function initAutocomplete() {
    //     var map = new google.maps.Map(document.getElementById('map'), {
    //       center: {lat: <?= ($data->lokasi)?$data->lokasi->coordinates[1]:'-7.1968026'; ?>, lng: <?= ($data->lokasi)?$data->lokasi->coordinates[0]:'113.2415155'; ?>},
    //       zoom: 15,
    //       mapTypeId: 'roadmap'
    //     });
    //     var marker;
        
    //     <?php if($data->lokasi){ ?>
    //         marker = new google.maps.Marker({
    //             position: {lat: <?= $data->lokasi->coordinates[1]; ?>, lng: <?= $data->lokasi->coordinates[0]; ?>},
    //             map: map
    //         });
    //     <?php } ?>
    // }  
    // //Depending on what I use it for I sometimes parse the json so I can work with a straight forward array:
    level_status = JSON.parse('<?php echo JSON_encode($level_status);?>');
    console.log(level_status);
    kecamatan = JSON.parse('<?php echo JSON_encode($kecamatan);?>');
    console.log(kecamatan);

    <?php
        if((strtoupper($data->level) != "TERKONFIRMASI")){
            echo '$("#form_gejala").hide();';
        }
    ?>

    $("#level").on('change', function() {
        var level = $(this).find(":selected").val();
        var level_item = level_status[level];
        var i;
        var text='';
        for (i = 0; i < level_item.length; i++) {
          text += '<option value="'+level_item[i]+'" >'+level_item[i]+'</option>';
        }
        $("#level_status").html(text);
        if(level == 'konfirmasi'){
            $("#form_gejala").show();
        } else {
            $("#form_gejala").hide();
        }
    });
    $("#kecamatan").on('change', function() {
        var level = $(this).find(":selected").val();
        var level_item = kecamatan[level];
        var i;
        var text='';
        for (i = 0; i < level_item.length; i++) {
          text += '<option value="'+level_item[i]+'" >'+level_item[i]+'</option>';
        }
        $("#kelurahan").html(text);
    });

</script>

<script type="text/javascript">
    var map,marker,geocodeService;
    
    function initMaps(center){
        console.log(center);
        map = L.map('map').setView(center, 15);
        L.tileLayer(
          'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18
          }).addTo(map);
        $("#location-lat").val(center[0]);
        $("#location-lng").val(center[1]);


        <?php if($data->lokasi){ ?>
        var popLocation= [<?= $data->lokasi->coordinates[1]; ?>,<?= $data->lokasi->coordinates[0]; ?>]; 
        marker = L.marker(popLocation).addTo(map); 
        <?php } ?>

        map.on('click', function(e) {        
            var popLocation= [e.latlng.lat,e.latlng.lng]; 
            map.removeLayer(marker);
            marker = L.marker(popLocation).addTo(map); 
            $("#location-lat").val(e.latlng.lat);
            $("#location-lng").val(e.latlng.lng);
        });
    }
    
    <?php if($data->lokasi){ ?>
    function backlocation(){
        var popLocation= [<?= $data->lokasi->coordinates[1]; ?>,<?= $data->lokasi->coordinates[0]; ?>]; 
        map.removeLayer(marker);
        marker = L.marker(popLocation).addTo(map); 
        map.setView(popLocation, 15);
        $("#location-lat").val(position.coords.latitude.toFixed(6));
        $("#location-lng").val(position.coords.longitude.toFixed(6));
    }
    <?php } ?>

    function getmylocation(){
        navigator.geolocation.getCurrentPosition(function(position){
            var popLocation= [position.coords.latitude.toFixed(6),position.coords.longitude.toFixed(6)]; 
            map.removeLayer(marker);
            marker = L.marker(popLocation).addTo(map); 
            map.setView(popLocation, 15);
            $("#location-lat").val(position.coords.latitude.toFixed(6));
            $("#location-lng").val(position.coords.longitude.toFixed(6));
        }, function onError(err) {
            $("#btnError").click();
            //alert("Sistem tidak dapat mengakes sensor GPS Anda");
        }, {maximumAge:60000, timeout: 2000}); //{timeout:10000}
    }
    $(document).ready(function() {
        var center = [<?= ($data->lokasi)?$data->lokasi->coordinates[1]:'-7.1968026'; ?>, <?= ($data->lokasi)?$data->lokasi->coordinates[0]:'113.2415155'; ?>];  
        initMaps(center);
    });
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDq2h9qLZ1zKRHMT5Qv2QBfGWL0sAKDzI&libraries=places&callback=initAutocomplete"
     async defer></script> -->