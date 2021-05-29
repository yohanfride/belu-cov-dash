<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-users"></i>
                        Tren Grafik - Vaksinasi Covid-19
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
                        <a style="padding: .5rem;" class="nav-link" href="#"><i style="padding-right: 5px;" class="icon icon-users"></i>Tren Grafik  - Vaksinasi Covid-19</a>
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
                                    <h4>Form Cari Vaksinasi Covid-19</h4>
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
                                <h4>Trend Grafik Total Vaksinasi Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kasus" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <?php foreach ($kelompok_status as $value) { ?>
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card no-b">
                        <div class="card-body">
                            <div class="card-title">
                                <h4> Trend Grafik Vaksinasi Kelompok <?= $value; ?> <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            </div>
                            <br/>
                            <div class="row">
                                <div  id="chart-kelompok-<?= strtolower($value); ?>" class="chart-canvas" style="width: 100%;"></div >  
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?> -->
                

            </div>
        </div>
    </div>

<?php include('footer.php'); ?> 
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
    jQuery(function($){
        var chartColors ={
            orange:"#ffa000",
            blue:"#42a5f5",
            purple:"#8e24aa",
            red:"#ef5350",
            yellow:"#fdd835",
          }
         <?php  
            $hari = array(); 
            $summary_wartawan = array(); $summary_nakes = array(); 
            $summary_lansia = array(); $summary_guru = array();
            $summary_masyarakat = array();
            foreach($dailes as $dl){
                $hari[] = $dl->date_only;
                $dl = $dl->vaksin;
                if(empty($kec)){
                    $summary_masyarakat[] = $dl->masyarakat;
                    $summary_wartawan[] = $dl->wartawan;
                    $summary_nakes[] = $dl->nakes;
                    $summary_lansia[] = $dl->lansia;
                    $summary_guru[] = $dl->guru;
                } else {
                    $dl = $dl->kecamatan->{$kec};
                    $summary_wartawan[] = $dl->{'vaksin-wartawan'};
                    $summary_nakes[] = $dl->{'vaksin-nakes'};
                    $summary_lansia[] = $dl->{'vaksin-lansia'};
                    $summary_guru[] = $dl->{'vaksin-guru'};
                    $summary_masyarakat[] = $dl->{'vaksin-masyarakat'};
                }
                
            }
            ?>

            var kasustotal = {
              series: [ {
                      name: 'Masyrakat',
                      type: 'line',
                      data: [<?= implode(',', $summary_wartawan); ?>]
                  },{
                      name: 'Wartawan',
                      type: 'line',
                      data: [<?= implode(',', $summary_wartawan); ?>]
                  },{
                      name: 'Nakes',
                      type: 'line',
                      data: [<?= implode(',', $summary_nakes); ?>]
                  }, {
                      name: 'Lansia',
                      type: 'line',
                      data: [<?= implode(',', $summary_lansia); ?>]
                  },
                  {
                      name: 'Guru',
                      type: 'line',
                      data: [<?= implode(',', $summary_guru); ?> ]
                  }
              ],
              chart: {
                  height: 350,
                  type: 'line',
                  stacked: false,
              },
              colors: [chartColors.purple,chartColors.blue,chartColors.yellow,chartColors.orange,chartColors.red],
              plotOptions: {
                  bar: {
                      columnWidth: '50%'
                  }
              },

              fill: {
                  colors: [chartColors.purple,chartColors.blue,chartColors.yellow,chartColors.orange,chartColors.red],
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
                      fillColors: [chartColors.purple,chartColors.blue,chartColors.yellow,chartColors.orange,chartColors.red],
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
          
          setTimeout(function(){  $(window).trigger('resize'); }, 5000);
    });
</script>