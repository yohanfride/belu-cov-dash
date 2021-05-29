<?php include('header.php'); ?>
<header class="blue accent-3 relative nav-sticky">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-box"></i>
                    Halaman Utama
                </h4>
            </div>
        </div>
        <div class="row" style="padding-left: 20px;">
            <form method="get" id="form-search">
                <div class="form-group" style="display: flex;">
                    <label for="inputPhone" class="col-form-label" style="min-width: 100px;">Data Tanggal</label>
                    <div class="input-group focused">
                        <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="str" value="<?= $str_date ?>" placeholder="Tanggal Lahir Pasien" required>
                        <span class="input-group-append">
                            <span class="input-group-text add-on white">
                                <i class="icon-calendar" style="color: #000 !important;"></i>
                            </span>
                        </span>
                    </div>
                    &nbsp; &nbsp;
                    <input class="btn btn-success btn-lg" value="Ambil Data" type="submit">
                </div>
            </form>
        </div>
    </div>
</header>
<div class="container-fluid animatedParent animateOnce my-3">
 
    <div class="animated fadeInUpShort show active pt-4" id="v-pills-1">
        <?php if(!isset($error_found)){ ?>
        <div class="card mb-3">
            <div class="card-header white">
                <h6> STATUS  <?php if($str_date== date("Y-m-d")){ echo 'SAAT INI';}else{ echo 'TANGGAL : '.$str_date; } ?> </h6>
            </div>
            <div class="card-body p-0">
                <div class="lightSlider"  data-item="6" data-item-xl="4" data-item-md="2" data-item-sm="1" data-pause="7000" data-pager="false" data-auto="true"
                     data-loop="true">
                    <div class="p-5 bg-primary red lighten-1 text-white">
                        <h5 class="font-weight-normal s-14">Positif<br/>Covid-19</h5>
                        <span class="s-48 font-weight-lighter text-primary"><?= $new->terkonfirmasi;?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->terkonfirmasi;
                                }
                                $jarak = $new->terkonfirmasi - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="text-primary"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                    <div class="p-5 ">
                        <h5 class="font-weight-normal s-14">Positif -<br/>Sembuh</h5>
                        <span class="s-48 font-weight-lighter light-green-text"><?= $new->{'terkonfirmasi-sembuh'};?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->{ 'terkonfirmasi-sembuh' };
                                }
                                $jarak = $new->{'terkonfirmasi-sembuh'} - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="light-green-text"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                    <div class="p-5 light">
                        <h5 class="font-weight-normal s-14">Positif -<br/>Meninggal</h5>
                        <span class="s-48 font-weight-lighter light-red-text"><?= $new->{ 'terkonfirmasi-meninggal' }?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->{'terkonfirmasi-meninggal'};
                                }
                                $jarak = $new->{'terkonfirmasi-meninggal'} - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="light-red-text"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>

                    <div class="p-5 bg-primary amber darken-2  text-white">
                        <h5 class="font-weight-normal s-14">Suspek<br/>&nbsp;</h5>
                        <span class="s-48 font-weight-lighter text-primary"><?= $new->suspek;?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->suspek;
                                }
                                $jarak = $new->suspek - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="text-primary"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                    <div class="p-5 ">
                        <h5 class="font-weight-normal s-14">Probable<br/>&nbsp;</h5>
                        <span class="s-48 font-weight-lighter yellow-text"><?= $new->probable;?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->probable;
                                }
                                $jarak = $new->probable - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="yellow-text"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                    <div class="p-5 light">
                        <h5 class="font-weight-normal s-14">Kontak Erat<br/>&nbsp;</h5>
                        <span class="s-48 font-weight-lighter text-primary"><?= $new->kontak_erat;?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->kontak_erat;
                                }
                                $jarak = $new->kontak_erat - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="text-primary"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                    <div class="p-5 bg-primary red darken-2 text-white">
                        <h5 class="font-weight-normal s-14">Positif Dengan Gejala<br/>&nbsp;</h5>
                        <span class="s-48 font-weight-lighter yellow-text"><?= $new->{"terkonfirmasi-dengan-gejala"};?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->{"terkonfirmasi-dengan-gejala"};
                                }
                                $jarak = $new->{"terkonfirmasi-dengan-gejala"} - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="yellow-text"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                    <div class="p-5 bg-primary red darken-1 text-white">
                        <h5 class="font-weight-normal s-14">Positif Tanpa Gejala<br/>&nbsp;</h5>
                        <span class="s-48 font-weight-lighter text-primary"><?= $new->{"terkonfirmasi-tanpa-gejala"};?></span>
                        <div> Kasus &nbsp;&nbsp;
                            <?php 
                                $old_data = 0;
                                if($old){
                                    $old_data = $old->{"terkonfirmasi-tanpa-gejala"};
                                }
                                $jarak = $new->{"terkonfirmasi-tanpa-gejala"} - $old_data ;
                                if($jarak==0)
                                    $icon = "icon-arrows-h";
                                else if($jarak>0)
                                    $icon = "icon-arrow_upward";
                                else if($jarak<0)
                                    $icon = "icon-arrow_downward";
                                $jarak = abs($jarak)  
                            ?>
                            <span class="text-primary"><i class="icon <?= $icon;?>"></i> <?= $jarak;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header white">
                                <strong> QR Code </strong>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="white text-center">
                                            <h6 class="mb-3">Penggunaan QRCode</h6>
                                            <span class="easy-pie-chart" data-percent="<?= ($user_all-$user_no_qr) / $user_all * 100; ?>"
                                               data-options='{
                                               "lineCap":"square",
                                               "lineWidth": 10,
                                               "barColor": "#03a9f4"
                                               }' style="margin-top: 10px;">
                                            <span class="percent" style="font-size: 25px;"><?= round( ($user_all-$user_no_qr) / $user_all * 100); ?></span>
                                            <div class="mt-3"><span class="badge badge-success r-30"><i class="icon-check mr-2"></i>User Terdaftar</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-4 " style="width: 199.867px; margin-right: 10px;">
                                        <h5 class="font-weight-normal s-14">Jumlah Pengguna </h5>
                                        <span class="s-48 font-weight-lighter text-primary"><?= ($user_all-$user_no_qr); ?></span>
                                        <h5 class="font-weight-normal s-14">Dari total </h5>
                                        <span class="s-48 font-weight-lighter text-primary"><?= $user_all; ?></span>
                                        <div> User Terdaftar
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="card">
                            <div class="card-header white">
                                <strong> User Baru </strong>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-4">
                                        <h5 class="font-weight-normal s-14">Jumlah Kasus Baru Yang Terdaftar </h5>
                                        <span class="s-48 font-weight-lighter text-primary"><?= ($new_user)?$new_user:'0'; ?></span>
                                        <h5 class="font-weight-normal s-14"> Pada hari sebelumnya </h5>
                                        <span class="s-48 font-weight-lighter text-primary"><?= ($old_user)?$old_user:'0'; ?></span>
                                        <div> User Terdaftar
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>                   
                </div>
            </div>
            <div class="col-md-4">
                <div class="white">
                    <div class="card">
                        <div class="card-header bg-primary text-white b-b-light">
                            <div class="row justify-content-end">
                                <div class="col">
                                    <ul id="myTab4" role="tablist" class="nav nav-tabs card-header-tabs nav-material nav-material-white float-right">
                                        <li class="nav-item">
                                            <a class="nav-link active show" id="tab1" data-toggle="tab" href="#v-pills-tab1" role="tab" aria-controls="tab1" aria-expanded="true" aria-selected="true">Jumlah Log Absen</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body no-p">
                            <div class="tab-content">
                                <div class="tab-pane animated fadeIn go active show" id="v-pills-tab1" role="tabpanel" aria-labelledby="v-pills-tab1">
                                    <div class="bg-primary text-white lighten-2"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                        <div class="pt-5 pb-2 pl-5 pr-5">
                                            <h5 class="font-weight-normal s-14">Jumlah Log Absen</h5>
                                            <span class="s-48 font-weight-lighter text-primary"><?= ($log_total)?$log_total:'0'; ?></span>
                                            <div class="float-right">
                                                <span class="icon icon-money-bag s-48"></span>
                                            </div>
                                        </div>
                                        <canvas width="480" height="118" data-chart="spark" data-chart-type="line" data-dataset="[[28,530,200,430]]" data-labels="['a','b','c','d']" data-dataset-options="[
                                { borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                ]" class="chartjs-render-monitor js-chart-drawn" style="display: block; height: 95px; width: 384px;">
                                        </canvas>
                                    </div>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 385px;"><div class="slimScroll b-b" data-height="385" style="overflow: hidden; width: auto; height: 385px;">
                                        

                                    <div class="table-responsive">
                                        <table class="table table-hover earning-box">
                                            <thead class="no-b">
                                            <tr>
                                                <th colspan="2">Nama</th>
                                                <th>Waktu</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($log_data as $s) { ?>
                                                <tr>
                                                    <td class="w-10">
                                                         <span class="round">
                                                         <img src="assets/img/dummy/u1.png" alt="user">
                                                         </span>
                                                    </td>
                                                    <td>
                                                        <h6><?= $s->nama ?></h6>
                                                        <small class="text-muted"><?= $s->kelurahan ?></small>
                                                    </td>
                                                    <td><?= date( "H:i:s", strtotime( $s->date_add)) ?></td>
                                                    <td>
                                                        <?php if(strtoupper($s->level) == "terkonfirmasi"){ ?>
                                                        <span class="badge badge-primary red lighten-1 r-20" style="font-size: 12px;">terkonfirmasi</span>
                                                        <?php } else if(strtoupper($s->level) == "suspek"){ ?>
                                                        <span class="badge badge-primary purple darken-1 r-20" style="font-size: 12px;">suspek</span>
                                                        <?php } else if(strtoupper($s->level) == "probable"){ ?>
                                                        <span class="badge badge-primary blue lighten-1 r-20" style="font-size: 12px;">probable</span>
                                                        <?php } else if(strtoupper($s->level) == "kontak_erat"){ ?>
                                                        <span class="badge badge-primary amber darken-2 r-20" style="font-size: 12px;">kontak_erat</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    </div><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.95); width: 5px; position: absolute; top: 34px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 351.244px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php } else { ?>

        <?php } ?>
    </div>
      
</div>
<?php include('footer.php'); ?>  