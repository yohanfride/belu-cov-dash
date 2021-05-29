<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-users"></i>
                        Tampilan Peta - Kasus Covid-19
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
                        <a style="padding: .5rem;" class="nav-link" href="#"><i style="padding-right: 5px;" class="icon icon-users"></i>Tampilan Peta - Kasus Covid-19</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="animatedParent animateOnce">
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <form method="get" id="form-search">
                            <div class="card-body b-b">
                                <h4>Form Filter Kasus Covid-19</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName" class="col-form-label">Kondisi</label>
                                            <select  class="form-control" name="lvl" id="level" >
                                                <option value="" >-- Semua --</option>
                                                <option value="terkonfirmasi" <?= (strtoupper($lvl) == "TERKONFIRMASI")?"selected":""; ?> >Terkonfirmasi</option>
                                                <option value="suspek" <?= (strtoupper($lvl) == "SUSPEK")?"selected":""; ?> >Suspek</option>
                                                <option value="probable" <?= (strtoupper($lvl) == "PROBABLE")?"selected":""; ?> >Probable</option>
                                                <option value="kontak_erat" <?= (strtoupper($lvl) == "KONTAK_ERAT")?"selected":""; ?> >Kontak Erat</option>
                                                <option value="pelaku_perjalanan" <?= (strtoupper($lvl) == "PELAKU_PERJALANAN")?"selected":""; ?> >Pelaku Perjalanan</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPhone" class="col-form-label">Status</label>
                                            <select class="form-control" name="lvlstat" id="level_status">
                                            <option value="" >-- Semua --</option>
                                            <?php 
                                                $list = array();
                                                if((strtoupper($lvl) == "TERKONFIRMASI"))
                                                    $list = $level_status['terkonfirmasi'];   
                                                if((strtoupper($lvl) == "SUSPEK"))
                                                    $list = $level_status['suspek'];
                                                if((strtoupper($lvl) == "PROBABLE"))
                                                    $list = $level_status['probable'];
                                                if((strtoupper($lvl) == "KONTAK_ERAT"))
                                                    $list = $level_status['kontak_erat'];
                                                if((strtoupper($lvl) == "PELAKU_PERJALANAN"))
                                                    $list = $level_status['pelaku_perjalanan'];

                                                foreach($list as $l){ ?>
                                                <option value="<?= $l?>" <?= ( $lvlstat == $l )?"selected":""; ?>><?= $l?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-md-6" id="form_gejala">
                                            <div class="form-group">
                                                <label for="inputGejala" class="col-form-label">Konfirmasi Gejala</label>
                                                <select  class="form-control" name="gejala" id="gejala" >
                                                    <option value="" >-- Semua --</option>
                                                    <option value="Dengan Gejala" <?= ($gejala == "Dengan Gejala")?"selected":""; ?> >Dengan Gejala</option>
                                                    <option value="Tanpa Gejala" <?= ($gejala == "Tanpa Gejala")?"selected":""; ?> >Tanpa Gejala</option>
                                                </select>
                                            </div>
                                        </div> 
                                </div>
                                <div class="row">   
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label for="inputPhone" class="col-form-label">Kecamatan</label>
                                            <?php if(isset($pusat)){ ?>
                                                <select class="form-control" name="kec" id="kecamatan" >
                                                <option value="" >-- Semua Kecamatan --</option>
                                                <?php foreach($kecamatan['Kecamatan'] as $l){ ?>
                                                    <option value="<?= $l?>" <?= ($kec == $l)?'selected':''; ?> ><?= $l?></option>
                                                <?php } ?>
                                                </select>
                                            <?php } else { ?>
                                                <input type="text" class="form-control" value="<?= $kec;?>" name="kec"  >
                                            <?php } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPhone" class="col-form-label">Kelurahan</label>
                                            <select class="form-control" name="kel" id="kelurahan" >
                                                <option value="" >-- Semua Kelurahan --</option>
                                            <?php foreach($kecamatan[$kec] as $l){ ?>
                                                <option value="<?= $l?>" <?= ($kel == $l)?'selected':''; ?> ><?= $l?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <button type="submit" class="btn btn-primary" name="save" value="save">Cari</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header white">Jumlah Kasus yang Muncul</div>
                        <div class="card-body p-0">
                            <div class="bg-primary text-white lighten-2"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                <div class="pt-5 pb-2 pl-5 pr-5">
                                    <h5 class="font-weight-normal s-14">Jumlah Kasus</h5>
                                    <span class="s-48 font-weight-lighter text-primary">
                                        <?= number_format($total,0,',','.'); ?></span>
                                    <div class="float-right">
                                        <span class="icon icon-chart s-48"></span>
                                    </div>
                                </div>
                                <canvas width="350" height="86" data-chart="spark" data-chart-type="line" data-dataset="[[28,530,200,430]]" data-labels="['a','b','c','d']" data-dataset-options="[
                                                { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                                ]" class="chartjs-render-monitor js-chart-drawn" style="display: block; height: 69px; width: 280px;">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Data Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <div class="" bis_skin_checked="1" style="text-align: center;">
                              <span class="info-peta bg-ppicon"></span> Kasus Pelaku Perjalanan &nbsp;&nbsp;
                              <span class="info-peta bg-odricon"></span> Kasus Kontak Erat &nbsp;&nbsp;
                              <span class="info-peta bg-odpicon"></span> Kasus Probable &nbsp;&nbsp;
                              <span class="info-peta bg-pdpicon"></span> Kasus Suspek &nbsp;&nbsp;
                              <span class="info-peta bg-confirm"></span> Kasus Konfirmasi Positif Covid-19
                          </div>
                        <br/>
                        <div id="map" style="width: 100%;height: 80vh;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?> 
<script type="text/javascript" src="<?= base_url();?>assets/leaflet/dist/leaflet-src.js"></script>
<script src='<?= base_url();?>assets/leaflet/Leaflet.GoogleMutant.js'></script>
<script src='<?= base_url();?>assets/leaflet/sampang-maps.js'></script>

<script type="text/javascript">
    jQuery(function($){
      // Maps 
      var maps = L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', { 
      //var maps = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
            //attribution: 'Data © <a href="http://sampangkab.go.id">SIM PUPR Kabupaten sampang</a>',
            maxZoom: 18,
            minZoom: 10,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiYWRlc3VsYWltYW4iLCJhIjoiY2prcWFqcW85MW00YzNsbW54ZThscmpvdSJ9.ai7YM6Pj5ayquazYjHnOCA'
          }),
        satelit = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/256/{z}/{x}/{y}?access_token={accessToken}', { 
            //attribution: 'Data © <a href="http://sampangkab.go.id">SIM PUPR Kabupaten sampang</a>',
            maxZoom: 18,
            minZoom: 10,
            accessToken: 'pk.eyJ1IjoiYWRlc3VsYWltYW4iLCJhIjoiY2prcWFqcW85MW00YzNsbW54ZThscmpvdSJ9.ai7YM6Pj5ayquazYjHnOCA'
          });

      var bounds_group = new L.featureGroup([]);

      var map = L.map('map',  {
        editable: true,
        center: [-9.107193,124.8882573],
        zoom: 12,
        //scrollWheelZoom: false,
        zoomControl: true,
        layers: [maps, bounds_group]
      });
      level_status = JSON.parse('<?php echo JSON_encode($level_status);?>');
      console.log(level_status);
      <?php
        if((strtoupper($lvl) != "TERKONFIRMASI")){
            echo '$("#form_gejala").hide();';
        }
      ?>
      $("#level").on('change', function() {
          var level = $(this).find(":selected").val();
          if(level){
              var level_item = level_status[level];
              var i;
              var text='<option value="" >-- Semua --</option>';
              for (i = 0; i < level_item.length; i++) {
                text += '<option value="'+level_item[i]+'" >'+level_item[i]+'</option>';
              }
              console.log(text);
              $("#level_status").html(text);
              if(level == 'terkonfirmasi'){
                  $("#form_gejala").show();
              } else {
                  $("#form_gejala").hide();
              }    
          } else {
              var text='<option value="" >-- Semua --</option>';
              $("#level_status").html(text);
              $("#form_gejala").hide();
          }
      });

      <?php
      $js_array = json_encode($current->kecamatan);
      echo "var dataKecamatan = ". $js_array . ";\n";
      ?>
      kelerahan = JSON.parse('<?php echo JSON_encode($kecamatan);?>');
      $("#kecamatan").on('change', function() {
          var level = $(this).find(":selected").val();
          var level_item = kelerahan[level];
          var i;
          var text='<option value="" >-- Semua Kelurahan --</option>';
          for (i = 0; i < level_item.length; i++) {
            text += '<option value="'+level_item[i]+'" >'+level_item[i]+'</option>';
          }
          $("#kelurahan").html(text);
      });

      function pop_kecamatan(feature, layer) {
      }

      var layer_kecamatan = new L.geoJson(kecamatan, {
        onEachFeature: pop_kecamatan,
        style: function(feature) {
          var color;
          var fitur = dataKecamatan[feature.properties['kecamatan']];
          // if( fitur.confirm > 0){
          //   color = '#ef5350';
          // } else if( fitur.pdp > 0){
          //   color = '#8e24aa';
          // } else if( fitur.odp > 0){
          //   color = '#42a5f5';
          // } else if( fitur.odr > 0){
          //   color = '#ffa000';
          // } else {
          //   color = '#4caf50';
          // }
          return {fillOpacity: 0.3,color: "white", fillColor: '#424242', weight:0.5};
        }
      });

      bounds_group.addLayer(layer_kecamatan);
      map.addLayer(layer_kecamatan);
      var totalhal = <?= ceil($total/$limit); ?>;

      function update_maps(hal){
        url_jsaon = "<?= base_url();?>user/get_data_user/?hal="+hal+"&kec=<?= str_replace(" ", "+", $kec); ?>&kel=<?= str_replace(" ", "+", $kel); ?>&lvl=<?= str_replace(" ", "+", $lvl); ?>&lvlstat=<?= str_replace(" ", "+", $lvlstat); ?>&gejala=<?= str_replace(" ", "+", $gejala); ?>";
        var hasilpasien=$.getJSON(url_jsaon, function (data) {
        for (var i = 0; i < data.length; i++) {
            var lat =data[i].latitude;
            var lng =data[i].longitude;
            var nama=data[i].nama;
            var umur=data[i].umur;
            var no_tel=data[i].phone;
            var alamat=data[i].alamat;
            var jk=data[i].jenis_kelamin;
            var kel_user=data[i].kelurahan;
            var kec_user=data[i].kecamatan;
            var updated=data[i].last_update;
            var level=data[i].level;
            var levelstat=data[i].levelstat;
            var konfirmasi_gejala = data[i].konfirmasi_gejala;
            var confirmIcon = L.divIcon({ className: 'circle bg-confirm shadow', iconSize: [12, 12]});
            var pdpIcon = L.divIcon({ className: 'circle bg-pdpicon shadow', iconSize: [12, 12]});
            var odpIcon = L.divIcon({ className: 'circle bg-odpicon shadow', iconSize: [12, 12]});
            var odrIcon = L.divIcon({ className: 'circle bg-odricon shadow', iconSize: [12, 12]});
            var ppIcon = L.divIcon({ className: 'circle bg-ppicon shadow', iconSize: [12, 12]});

            if(level == 'terkonfirmasi'){
                var stat = "Terkonfirmasi Positif Covid-19";
                var greenIcon = confirmIcon;
                var levelname = 'Terkonfirmasi';
            } else if(level == 'suspek'){
                var stat = "Suspek";
                var levelname = 'Suspek';
                var greenIcon = pdpIcon;
            } else if(level == 'probable'){
                var stat = "Probable";
                var levelname = 'Probable';
                var greenIcon = odpIcon;
            } else if(level == 'pelaku_perjalanan'){
                var stat = "Pelaku Perjalanan";
                var levelname = 'Pelaku Perjalanan';
                var greenIcon = ppIcon;
            } else {
                var stat = "Kontak Erat";
                var levelname = 'Kontak Erat';
                var greenIcon = odrIcon;
            } 

            var customPopup =
                  "<h4>Kasus "+stat+"</h4>"
                  +"<span>Nama: <b>"+nama+"</b></span><br>"
                  +"<span>Umur: <b>"+umur+"</b></span><br>"
                  +"<span>Status Pasien: <b>"+levelname+" - "+levelstat+"</b></span><br>"
                  +"<span>Jenis Kelamin: <b>"+jk+"</b></span><br>"
                  +"<span>Kelurahan: <b>"+kel_user+"</b></span><br>"
                  +"<span>Kecamatan: <b>"+kec_user+"</b></span><br>"
                  +"<span>Update Terakhir: <b>"+updated+"</b></span><br>"
              ;
            if(level == 'terkonfirmasi'){
              customPopup+="<span>Konfirmasi Gejala : <b>"+konfirmasi_gejala+"</b></span><br>"
            }
              console.log(greenIcon);
              L.marker([lat, lng],{icon:greenIcon}).addTo(map).bindPopup(customPopup);
            }
        });

        if(totalhal>hal){
            setTimeout(function(){
                update_maps(hal+1);
            }, 1000);
        }
      }
      update_maps(1);
      // End Maps ///
    });
</script>
