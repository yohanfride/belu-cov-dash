<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-edit"></i>
                        Edit Tes Covid-19
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
                        <a style="padding: .5rem;" class="nav-link" href="<?= base_url(); ?>tes"><i style="padding-right: 5px;" class="icon icon-users"></i>Tampilan Tabel Tes Covid-19</a>
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
                            <h4>Form Edit Tes Covid-19</h4>
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
                                        <input type="text" class="form-control" id="inputName" placeholder="Type Name"   value="<?= $data->nama?>" name="name" required>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="inputName" class="col-form-label">Jenis Tes</label>
                                        <select  class="form-control" name="jenis" id="jenis" required>
                                            <?php foreach ($jenis_status as $value) { ?>
                                                    <option value="<?= $value; ?>"  <?= ($data->jenis == $value)?"selected":""; ?> ><?= $value; ?></option>    
                                            <?php } ?>    
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
                                        <label for="inputPhone" class="col-form-label">Faskes Tes</label>
                                        <input type="text" class="form-control" id="faskes" placeholder="Faskes Tes"  name="faskes" value="<?= (array_key_exists("faskes",$data))?$data->faskes:''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Alamat</label>
                                        <textarea class="form-control r-0" id="exampleFormControlTextarea2" rows="2" style="resize: none;" name="alamat"  required><?= $data->alamat ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">Tanggal Tes Tahap 1</label>
                                        <div class="input-group focused">
                                            <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="tgl_tes" placeholder="Tahun - Bulan - Tanggal (yyyy-mm-dd)" value="<?=  (!empty($data->tgl_tes))?date( "Y-m-d", strtotime( $data->tgl_tes)):'' ?>" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text add-on white">
                                                    <i class="icon-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="inputPhone" class="col-form-label">Hasil Tes</label>
                                        <select id="inputState" class="form-control" name="hasil" id="hasil" required>
                                            <option value="Positif / Reaktif"  <?= ($data->hasil == "Positif / Reaktif")?"selected":""; ?>>Positif / Reaktif</option>
                                            <option value="Negatif / Non-Reaktif"  <?= ($data->hasil == "Negatif / Non-Reaktif")?"selected":""; ?>>Negatif / Non-Reaktif</option>
                                        </select>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="inputPhone" class="col-form-label">
                                            Lokasi 
                                            <button class="btn btn-sm btn-success" type="button" onclick="getmylocation()" style="position: absolute; right: 1px; top: 35px; z-index: 100;">Lokasi Saya</button> 
                                        </label>
                                        <div id="map" style="min-width: 400px; width: 100%; min-height: 195px; z-index: 1;"></div>
                                        <input type="hidden" class="form-control" id="location-lat"  name="loc_lat">
                                        <input type="hidden" class="form-control" id="location-lng"  name="loc_long">
                                    </div> -->

                                </div>
                            </div> 
                            <button type="submit" class="btn btn-primary" name="save" value="save">Edit</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

<?php include('footer.php'); ?> 
<!--/#app -->
<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css" />
<script src="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js"></script>

<script>

    kecamatan = JSON.parse('<?php echo JSON_encode($kecamatan);?>');
    console.log(kecamatan);

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
    $(document).ready(function() {  
        navigator.geolocation.getCurrentPosition(onSuccess, onError, {timeout:10000}); 
    });
</script>
<!-- <script type="text/javascript">
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
        marker = L.marker(center).addTo(map);
        map.on('click', function(e) {        
            var popLocation= [e.latlng.lat,e.latlng.lng]; 
            map.removeLayer(marker);
            marker = L.marker(popLocation).addTo(map); 
            $("#location-lat").val(e.latlng.lat);
            $("#location-lng").val(e.latlng.lng);
        });
    }
    
    // get location using the Geolocation interface
    var geoLocationOptions = {
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 0
    }

    function onSuccess(position) {
        console.log('success');
        myLat = position.coords.latitude.toFixed(6);
        myLng = position.coords.longitude.toFixed(6);
        latLng = [myLat, myLng];
        initMaps(latLng);
    }

    function onError(err) {
        var center = [-9.0949745,124.8933411];
        console.log(`ERROR(${err.code}): ${err.message}`);
        $("#btnError").click();
        //alert("Sistem tidak dapat mengakes sensor GPS Anda");
        initMaps(center);
    }

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
</script> -->

