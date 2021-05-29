<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-users"></i>
                        Tren Grafik - Kasus Covid-19
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
                        <a style="padding: .5rem;" class="nav-link" href="#"><i style="padding-right: 5px;" class="icon icon-users"></i>Tren Grafik  - Kasus Covid-19</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="animatedParent animateOnce">
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-md-12 mb-4">
                        <div class="card">
                            <form method="get" id="form-search">
                                <div class="card-body b-b">
                                    <h4>Form Cari Kasus Covid-19</h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputPhone" class="col-form-label">Tanggal Awal</label>
                                                <div class="input-group focused">
                                                    <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="str" value="<?= $str_date ?>" placeholder="Tanggal Lahir Pasien">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text add-on white">
                                                            <i class="icon-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputPhone" class="col-form-label">Tanggal Akhir</label>
                                                <div class="input-group focused">
                                                    <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="end" value="<?= $end_date ?>" placeholder="Tanggal Lahir Pasien">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text add-on white">
                                                            <i class="icon-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                                    <input type="text" class="form-control" value="<?= $kec;?>" name="kecamatan"  >
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary" name="save" value="save">Cari</button>
                                </div>
                            </form>

                        </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4>Trend Grafik Total Data Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4> Trend Grafik Kasus Kontak Erat Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus-kontak_erat" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4> Trend Grafik Kasus Pelaku Perjalanan Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus-perlaku_perjalanan" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4> Trend Grafik Kasus Probable Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus-probable" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4> Trend Grafik Kasus Suspek Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus-suspek" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 mb-4">
                        <div class="card no-b">
                            <div class="card-body">
                            <div class="card-title">
                                <h4> Trend Grafik Kasus Terkonfimasi Positif Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus-positif" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?> 
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    jQuery(function($){
        var chartColors ={
            orange:"#42a5f5",
            blue:"#fdd835",
            purple:"#ffa000",
            red:"#ef5350",
          }
         <?php  
            $hari = array(); 
            $summary_kontak_erat = array(); $summary_probable = array(); $summary_suspek = array(); $summary_konfirmasi = array();
            $kontak_erat_dipantau = array(); $kontak_erat_selesai_dipantau = array();
            $probable_isolasi = array(); $probable_selesai_isolasi = array(); $probable_meninggal = array();
            $suspek_isolasi = array(); $suspek_selesai_isolasi = array(); $suspek_meninggal = array();
            $konfirmasi_dirawat = array(); $konfirmasi_sembuh = array(); $konfirmasi_pengawasan = array();  $konfirmasi_meninggal = array();
            foreach($dailes as $dl){
                $hari[] = $dl->date_only;
                if(empty($kec)){
                    $summary_kontak_erat[] = $dl->kontak_erat->total;
                    $summary_probable[] = $dl->probable->total;
                    $summary_suspek[] = $dl->suspek->total;
                    $summary_konfirmasi[] = $dl->terkonfirmasi->total;
                    $summary_pelaku_perjalanan[] = $dl->pelaku_perjalanan->total;
                    
                    $kontak_erat_dipantau[] = $dl->kontak_erat->isolasi;
                    $kontak_erat_selesai_dipantau[] = $dl->kontak_erat->{"selesai-isolasi"};
                    
                    $pelaku_perjalanan_isolasi[] = $dl->pelaku_perjalanan->isolasi;
                    $pelaku_perjalanan_selesai_isolasi[] = $dl->pelaku_perjalanan->{"selesai-isolasi"};
                    
                    $probable_isolasi[] = $dl->probable->isolasi;
                    $probable_selesai_isolasi[] = $dl->probable->{"selesai-isolasi"};
                    $probable_meninggal[] = $dl->probable->meninggal;
                   
                    $suspek_isolasi[] = $dl->suspek->isolasi;
                    $suspek_selesai_isolasi[] = $dl->suspek->{"selesai-isolasi"};
                    $suspek_meninggal[] = $dl->suspek->meninggal;

                    $pelaku_perjalanan_isolasi[] = $dl->pelaku_perjalanan->isolasi;
                    $pelaku_perjalanan_selesai_isolasi[] = $dl->pelaku_perjalanan->{"selesai-isolasi"};

                    $konfirmasi_dirawat[] = $dl->terkonfirmasi->dirawat;
                    $konfirmasi_sembuh[] = $dl->terkonfirmasi->sembuh;
                    $konfirmasi_meninggal[] = $dl->terkonfirmasi->meninggal;
                    $konfirmasi_pengawasan[] = $dl->terkonfirmasi->pengawasan;    
                } else {
                    $dl = $dl->kecamatan->{$kec};
                    $summary_kontak_erat[] = $dl->kontak_erat;
                    $summary_probable[] = $dl->probable;
                    $summary_suspek[] = $dl->suspek;
                    $summary_konfirmasi[] = $dl->terkonfirmasi;
                    $summary_pelaku_perjalanan[] = $dl->pelaku_perjalanan;
                    $kontak_erat_dipantau[] = $dl->{'kontak_erat-isolasi'};
                    $kontak_erat_selesai_dipantau[] = $dl->{"kontak_erat-selesai-isolasi"};
                    $pelaku_perjalanan_isolasi[] = $dl->{'pelaku_perjalanan-isolasi'};
                    $pelaku_perjalanan_selesai_isolasi[] = $dl->{"pelaku_perjalanan-selesai-isolasi"};
                    $probable_isolasi[] = $dl->{"probable-isolasi"};
                    $probable_selesai_isolasi[] = $dl->{"probable-selesai-isolasi"};
                    $probable_meninggal[] = $dl->{"probable-meninggal"};
                    $suspek_isolasi[] = $dl->{"suspek-isolasi"};
                    $suspek_selesai_isolasi[] = $dl->{"suspek-selesai-isolasi"};
                    $suspek_meninggal[] = $dl->{"suspek-meninggal"};
                    $konfirmasi_dirawat[] = $dl->{"terkonfirmasi-dirawat"};
                    $konfirmasi_sembuh[] = $dl->{"terkonfirmasi-sembuh"};
                    $konfirmasi_meninggal[] = $dl->{"terkonfirmasi-meninggal"};
                    $konfirmasi_pengawasan[] = $dl->{"terkonfirmasi-pengawasan"};  

                }
                
            }
            ?>

            var kasustotal = {
              series: [{
                      name: 'Kontak Erat',
                      type: 'line',
                      data: [<?= implode(',', $summary_kontak_erat); ?>]
                  }, {
                      name: 'Pelaku Perjalanan',
                      type: 'line',
                      data: [<?= implode(',', $summary_kontak_erat); ?>]
                  },{
                      name: 'Probable',
                      type: 'line',
                      data: [<?= implode(',', $summary_probable); ?>]
                  }, {
                      name: 'Suspek',
                      type: 'line',
                      data: [<?= implode(',', $summary_suspek); ?>]
                  },
                  {
                      name: 'Postif',
                      type: 'line',
                      data: [<?= implode(',', $summary_konfirmasi); ?> ]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: [chartColors.orange, chartColors.blue, chartColors.purple, chartColors.red],
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: [chartColors.orange, chartColors.blue, chartColors.purple, chartColors.red],
                  opacity: [0.85, 0.25, 1],
                  gradient: {
                      inverseColors: false,
                      // shade: 'light',
                      type: "vertical",
                      // opacityFrom: 0.85,
                      // opacityTo: 0.55,
                      stops: [0, 100, 100, 100]
                  }
              },
              labels: ['<?= implode("','", $hari); ?>'],
              legend: {
                  show: true,
                  showForSingleSeries: false,
                  showForNullSeries: true,
                  showForZeroSeries: true,
                  position: 'bottom',
                  horizontalAlign: 'center',
                  floating: false,
                  fontSize: '14px',
                  fontFamily: 'Helvetica, Arial',
                  fontWeight: 400,
                  formatter: undefined,
                  inverseOrder: false,
                  width: undefined,
                  height: undefined,
                  tooltipHoverFormatter: undefined,
                  offsetX: 0,
                  offsetY: 0,
                  labels: {
                      colors: ['#000000'],
                      useSeriesColors: false
                  },
                  markers: {
                      width: 12,
                      height: 12,
                      strokeWidth: 0,
                      //strokeColor: '#fff',
                      fillColors: [chartColors.orange, '#ab47bc', chartColors.blue, chartColors.purple, chartColors.red],
                      radius: 12,
                      customHTML: undefined,
                      onClick: undefined,
                      offsetX: 0,
                      offsetY: 0
                  },
                  itemMargin: {
                      horizontal: 5,
                      vertical: 0
                  },
                  onItemClick: {
                      toggleDataSeries: true
                  },
                  onItemHover: {
                      highlightDataSeries: true
                  },
              },
              markers: {

                  size: 5,
                  hover: {
                      size: 9
                  }
              },
              xaxis: {
                  // type: 'datetime'
              },
              yaxis: {
                  title: {
                      text: 'Orang',
                  },
                  labels: {
                      formatter: function(val) {
                          return val.toFixed(0)
                      }
                  },
                  min: 0
              },
              tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                      formatter: function(y) {
                          if (typeof y !== "undefined") {
                              return y.toFixed(0) + " Orang";
                          }
                          return y;

                      }
                  }
              }
          };

          var kasus_kontak_erat = {
              series: [{
                      name: 'Kasus Kontak Erat',
                      type: 'column',
                      data: [<?= implode(',', $summary_kontak_erat); ?>]
                  }, {
                      name: 'Selesai Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $kontak_erat_selesai_dipantau); ?>]
                  }, {
                      name: 'Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $kontak_erat_dipantau); ?>]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: [chartColors.orange, '#35FD0B', '#f2f700'],
              stroke: {
                  width: [0, 5, 5, 5],
                  colors: ['#000000', '#2Cff00', '#04A7FF'],
                  curve: 'smooth',
                  // colors:['']
              },
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: [chartColors.orange, '#35FD0B', '#2303c2'],
                  opacity: [0.85, 0.25, 1],
                  gradient: {
                      inverseColors: false,
                      // shade: 'light',
                      type: "vertical",
                      // opacityFrom: 0.85,
                      // opacityTo: 0.55,
                      stops: [0, 100, 100, 100]
                  }
              },
              labels: ['<?= implode("','", $hari); ?>'],
              legend: {
                  show: true,
                  showForSingleSeries: false,
                  showForNullSeries: true,
                  showForZeroSeries: true,
                  position: 'bottom',
                  horizontalAlign: 'center',
                  floating: false,
                  fontSize: '14px',
                  fontFamily: 'Helvetica, Arial',
                  fontWeight: 400,
                  formatter: undefined,
                  inverseOrder: false,
                  width: undefined,
                  height: undefined,
                  tooltipHoverFormatter: undefined,
                  offsetX: 0,
                  offsetY: 0,
                  labels: {
                      colors: ['#000000'],
                      useSeriesColors: false
                  },
                  markers: {
                      width: 12,
                      height: 12,
                      strokeWidth: 0,
                      strokeColor: '#fff',
                      fillColors: [chartColors.orange, '#35FD0B', '#2303c2'],
                      radius: 12,
                      customHTML: undefined,
                      onClick: undefined,
                      offsetX: 0,
                      offsetY: 0
                  },
                  itemMargin: {
                      horizontal: 5,
                      vertical: 0
                  },
                  onItemClick: {
                      toggleDataSeries: true
                  },
                  onItemHover: {
                      highlightDataSeries: true
                  },
              },
              markers: {

                  size: 5,
                  hover: {
                      size: 9
                  }
              },
              xaxis: {
                  // type: 'datetime'
              },
              yaxis: {
                  title: {
                      text: 'Orang',
                  },
                  labels: {
                      formatter: function(val) {
                          return val.toFixed(0)
                      }
                  },
                  min: 0
              },
              tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                      formatter: function(y) {
                          if (typeof y !== "undefined") {
                              return y.toFixed(0) + " Orang";
                          }
                          return y;

                      }
                  }
              }
          };

          var kasus_probable = {
              series: [{
                      name: 'Kasus Probable',
                      type: 'column',
                      data: [<?= implode(',', $summary_probable); ?>]
                  }, {
                      name: 'Selesai Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $probable_selesai_isolasi); ?>]
                  }, {
                      name: 'Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $probable_isolasi); ?>]
                  }, {
                      name: 'Meninggal',
                      type: 'line',
                      data: [<?= implode(',', $probable_meninggal); ?>]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: [chartColors.blue, '#35FD0B', '#f2f700', '#000000'],
              stroke: {
                  width: [0, 5, 5, 5],
                  colors: ['#000000', '#2Cff00', '#04A7FF'],
                  curve: 'smooth',
                  // colors:['']
              },
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: [chartColors.blue, '#35FD0B', '#f2f700', '#000000'],
                  opacity: [0.85, 0.25, 1],
                  gradient: {
                      inverseColors: false,
                      // shade: 'light',
                      type: "vertical",
                      // opacityFrom: 0.85,
                      // opacityTo: 0.55,
                      stops: [0, 100, 100, 100]
                  }
              },
              labels: ['<?= implode("','", $hari); ?>'],
              legend: {
                  show: true,
                  showForSingleSeries: false,
                  showForNullSeries: true,
                  showForZeroSeries: true,
                  position: 'bottom',
                  horizontalAlign: 'center',
                  floating: false,
                  fontSize: '14px',
                  fontFamily: 'Helvetica, Arial',
                  fontWeight: 400,
                  formatter: undefined,
                  inverseOrder: false,
                  width: undefined,
                  height: undefined,
                  tooltipHoverFormatter: undefined,
                  offsetX: 0,
                  offsetY: 0,
                  labels: {
                      colors: ['#000000'],
                      useSeriesColors: false
                  },
                  markers: {
                      width: 12,
                      height: 12,
                      strokeWidth: 0,
                      strokeColor: '#fff',
                      fillColors: [chartColors.blue, '#35FD0B', '#f2f700', '#000000'],
                      radius: 12,
                      customHTML: undefined,
                      onClick: undefined,
                      offsetX: 0,
                      offsetY: 0
                  },
                  itemMargin: {
                      horizontal: 5,
                      vertical: 0
                  },
                  onItemClick: {
                      toggleDataSeries: true
                  },
                  onItemHover: {
                      highlightDataSeries: true
                  },
              },
              markers: {

                  size: 5,
                  hover: {
                      size: 9
                  }
              },
              xaxis: {
                  // type: 'datetime'
              },
              yaxis: {
                  title: {
                      text: 'Orang',
                  },
                  labels: {
                      formatter: function(val) {
                          return val.toFixed(0)
                      }
                  },
                  min: 0
              },
              tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                      formatter: function(y) {
                          if (typeof y !== "undefined") {
                              return y.toFixed(0) + " Orang";
                          }
                          return y;

                      }
                  }
              }
          };

          var kasus_suspek = {
              series: [{
                      name: 'Kasus Suspek',
                      type: 'column',
                      data: [<?= implode(',', $summary_suspek); ?>]
                  }, {
                      name: 'Selesai Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $suspek_selesai_isolasi); ?>]
                  }, {
                      name: 'Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $suspek_isolasi); ?>]
                  }, {
                      name: 'Meninggal',
                      type: 'line',
                      data: [<?= implode(',', $suspek_meninggal); ?>]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: [chartColors.purple, '#35FD0B', '#f2f700', '#000000'],
              stroke: {
                  width: [0, 5, 5, 5],
                  colors: ['#000000', '#2Cff00', '#04A7FF'],
                  curve: 'smooth',
                  // colors:['']
              },
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: [chartColors.purple, '#35FD0B', '#f2f700', '#000000'],
                  opacity: [0.85, 0.25, 1],
                  gradient: {
                      inverseColors: false,
                      // shade: 'light',
                      type: "vertical",
                      // opacityFrom: 0.85,
                      // opacityTo: 0.55,
                      stops: [0, 100, 100, 100]
                  }
              },
              labels: ['<?= implode("','", $hari); ?>'],
              legend: {
                  show: true,
                  showForSingleSeries: false,
                  showForNullSeries: true,
                  showForZeroSeries: true,
                  position: 'bottom',
                  horizontalAlign: 'center',
                  floating: false,
                  fontSize: '14px',
                  fontFamily: 'Helvetica, Arial',
                  fontWeight: 400,
                  formatter: undefined,
                  inverseOrder: false,
                  width: undefined,
                  height: undefined,
                  tooltipHoverFormatter: undefined,
                  offsetX: 0,
                  offsetY: 0,
                  labels: {
                      colors: ['#000000'],
                      useSeriesColors: false
                  },
                  markers: {
                      width: 12,
                      height: 12,
                      strokeWidth: 0,
                      strokeColor: '#fff',
                      fillColors: [chartColors.purple, '#35FD0B', '#f2f700', '#000000'],
                      radius: 12,
                      customHTML: undefined,
                      onClick: undefined,
                      offsetX: 0,
                      offsetY: 0
                  },
                  itemMargin: {
                      horizontal: 5,
                      vertical: 0
                  },
                  onItemClick: {
                      toggleDataSeries: true
                  },
                  onItemHover: {
                      highlightDataSeries: true
                  },
              },
              markers: {

                  size: 5,
                  hover: {
                      size: 9
                  }
              },
              xaxis: {
                  // type: 'datetime'
              },
              yaxis: {
                  title: {
                      text: 'Orang',
                  },
                  labels: {
                      formatter: function(val) {
                          return val.toFixed(0)
                      }
                  },
                  min: 0
              },
              tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                      formatter: function(y) {
                          if (typeof y !== "undefined") {
                              return y.toFixed(0) + " Orang";
                          }
                          return y;

                      }
                  }
              }
          };

          var kasus_konfirmasi = {
              series: [{
                      name: 'Konfirmasi Positif COVID-19',
                      type: 'column',
                      data: [<?= implode(',', $summary_konfirmasi); ?>]
                  }, {
                      name: 'Sembuh',
                      type: 'line',
                      data: [<?= implode(',', $konfirmasi_sembuh); ?>]
                  }, {
                      name: 'Pengawasan',
                      type: 'line',
                      data: [<?= implode(',', $konfirmasi_pengawasan); ?>]
                  }, {
                      name: 'Meninggal',
                      type: 'line',
                      data: [<?= implode(',', $probable_meninggal); ?>]
                  }, {
                      name: 'Dalam Perawatan',
                      type: 'line',
                      data: [<?= implode(',', $konfirmasi_dirawat); ?>]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: [chartColors.red, '#35FD0B', '#04a7ff', '#000000', '#f2f700'],
              stroke: {
                  width: [0, 5, 5, 5],
                  colors: ['#000000', '#2Cff00', '#04A7FF'],
                  curve: 'smooth',
                  // colors:['']
              },
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: [chartColors.red, '#35FD0B', '#04a7ff', '#000000', '#f2f700'],
                  opacity: [0.85, 0.25, 1],
                  gradient: {
                      inverseColors: false,
                      // shade: 'light',
                      type: "vertical",
                      // opacityFrom: 0.85,
                      // opacityTo: 0.55,
                      stops: [0, 100, 100, 100]
                  }
              },
              labels: ['<?= implode("','", $hari); ?>'],
              legend: {
                  show: true,
                  showForSingleSeries: false,
                  showForNullSeries: true,
                  showForZeroSeries: true,
                  position: 'bottom',
                  horizontalAlign: 'center',
                  floating: false,
                  fontSize: '14px',
                  fontFamily: 'Helvetica, Arial',
                  fontWeight: 400,
                  formatter: undefined,
                  inverseOrder: false,
                  width: undefined,
                  height: undefined,
                  tooltipHoverFormatter: undefined,
                  offsetX: 0,
                  offsetY: 0,
                  labels: {
                      colors: ['#000000'],
                      useSeriesColors: false
                  },
                  markers: {
                      width: 12,
                      height: 12,
                      strokeWidth: 0,
                      strokeColor: '#fff',
                      fillColors: [chartColors.red, '#35FD0B', '#04a7ff', '#000000', '#f2f700'],
                      radius: 12,
                      customHTML: undefined,
                      onClick: undefined,
                      offsetX: 0,
                      offsetY: 0
                  },
                  itemMargin: {
                      horizontal: 5,
                      vertical: 0
                  },
                  onItemClick: {
                      toggleDataSeries: true
                  },
                  onItemHover: {
                      highlightDataSeries: true
                  },
              },
              markers: {

                  size: 5,
                  hover: {
                      size: 9
                  }
              },
              xaxis: {
                  // type: 'datetime'
              },
              yaxis: {
                  title: {
                      text: 'Orang',
                  },
                  labels: {
                      formatter: function(val) {
                          return val.toFixed(0)
                      }
                  },
                  min: 0
              },
              tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                      formatter: function(y) {
                          if (typeof y !== "undefined") {
                              return y.toFixed(0) + " Orang";
                          }
                          return y;

                      }
                  }
              }
          };

          var kasus_perlaku_perjalanan =  {
              series: [{
                      name: 'Kasus Suspek',
                      type: 'column',
                      data: [<?= implode(',', $summary_probable); ?>]
                  }, {
                      name: 'Selesai Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $probable_selesai_isolasi); ?>]
                  }, {
                      name: 'Isolasi',
                      type: 'line',
                      data: [<?= implode(',', $probable_isolasi); ?>]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: ['#ab47bc', '#35FD0B', '#f2f700', '#000000'],
              stroke: {
                  width: [0, 5, 5, 5],
                  colors: ['#000000', '#2Cff00', '#04A7FF'],
                  curve: 'smooth',
                  // colors:['']
              },
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: ['#ab47bc', '#35FD0B', '#f2f700', '#000000'],
                  opacity: [0.85, 0.25, 1],
                  gradient: {
                      inverseColors: false,
                      // shade: 'light',
                      type: "vertical",
                      // opacityFrom: 0.85,
                      // opacityTo: 0.55,
                      stops: [0, 100, 100, 100]
                  }
              },
              labels: ['<?= implode("','", $hari); ?>'],
              legend: {
                  show: true,
                  showForSingleSeries: false,
                  showForNullSeries: true,
                  showForZeroSeries: true,
                  position: 'bottom',
                  horizontalAlign: 'center',
                  floating: false,
                  fontSize: '14px',
                  fontFamily: 'Helvetica, Arial',
                  fontWeight: 400,
                  formatter: undefined,
                  inverseOrder: false,
                  width: undefined,
                  height: undefined,
                  tooltipHoverFormatter: undefined,
                  offsetX: 0,
                  offsetY: 0,
                  labels: {
                      colors: ['#000000'],
                      useSeriesColors: false
                  },
                  markers: {
                      width: 12,
                      height: 12,
                      strokeWidth: 0,
                      strokeColor: '#fff',
                      fillColors: ['#ab47bc', '#35FD0B', '#f2f700', '#000000'],
                      radius: 12,
                      customHTML: undefined,
                      onClick: undefined,
                      offsetX: 0,
                      offsetY: 0
                  },
                  itemMargin: {
                      horizontal: 5,
                      vertical: 0
                  },
                  onItemClick: {
                      toggleDataSeries: true
                  },
                  onItemHover: {
                      highlightDataSeries: true
                  },
              },
              markers: {

                  size: 5,
                  hover: {
                      size: 9
                  }
              },
              xaxis: {
                  // type: 'datetime'
              },
              yaxis: {
                  title: {
                      text: 'Orang',
                  },
                  labels: {
                      formatter: function(val) {
                          return val.toFixed(0)
                      }
                  },
                  min: 0
              },
              tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                      formatter: function(y) {
                          if (typeof y !== "undefined") {
                              return y.toFixed(0) + " Orang";
                          }
                          return y;

                      }
                  }
              }
          };

          var chart = new ApexCharts(document.querySelector("#chart-kasus"), kasustotal);
          chart.render();

          var chart2 = new ApexCharts(document.querySelector("#chart-kasus-kontak_erat"), kasus_kontak_erat);
          chart2.render();

          var chart2 = new ApexCharts(document.querySelector("#chart-kasus-perlaku_perjalanan"), kasus_perlaku_perjalanan);
          chart2.render();

          var chart = new ApexCharts(document.querySelector("#chart-kasus-probable"), kasus_probable);
          chart.render();

          var chart2 = new ApexCharts(document.querySelector("#chart-kasus-suspek"), kasus_suspek);
          chart2.render();

          var chart2 = new ApexCharts(document.querySelector("#chart-kasus-positif"), kasus_konfirmasi);
          chart2.render();
            
    });
</script>