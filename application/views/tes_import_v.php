<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-plus"></i>
                        Import Excel - Tes Covid-19
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
                        <a style="padding: .5rem;" class="nav-link" href="#"><i style="padding-right: 5px;" class="icon icon-file-excel-o"></i>Import Excel</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="animatedParent animateOnce">
        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body b-b">
                            <form method="post" enctype="multipart/form-data">
                                <h4>Form Import Tes</h4>
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
                                <div class="form-group">
                                    <label for="inputName" class="col-form-label">File</label>
                                    <input type="file" class="form-control" id="inputName" placeholder="Type Link URL Video"  name="file" required="">
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-form-label">Index</label>
                                    <input type="text" class="form-control" name="index" required="">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputName" class="col-form-label">Latitude</label>
                                    <input type="text" class="form-control" name="lat" required="">
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-form-label">Longitude</label>
                                    <input type="text" class="form-control" name="lng" required="">
                                </div> -->
                                <div class="form-group">
                                    <label for="inputName" class="col-form-label">Line Awal</label>
                                    <input type="text" class="form-control" name="start_line" required="">
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-form-label">Line Akhir</label>
                                    <input type="text" class="form-control" name="end_line" required="">
                                </div>
                                <button type="submit" class="btn btn-primary" name="save" value="save">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if(isset($import)){ ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header white"> Progress <span id="now"></span>  /  <span id="max"></span> &nbsp;&nbsp;&nbsp;<span class="text-red">*Jangan Tutup Halaman</span></div>
                        <div class="card-body">
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped" id="progress" role="progressbar" style="width: 10%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <h6 class="text-green"> <span id="sukses-item">0</span> Data Berhasil Import</h6> &nbsp;&nbsp;&nbsp; 
                            <h6 class="text-red"> <span id="error-item">0</span> Data Gagal Import</h6>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>

<?php include('footer.php'); ?> 
<?php if(isset($import)){ ?>
<script type="text/javascript">
    jQuery(function($){
        var val = 0, sukses=0, error=0;
        var max = <?= $import_count?>;
        function progres(){
            val++;
            $("#now").html(val);
            $("#max").html(max);
            var percent = val / max * 100;
            $("#progress").html(percent.toFixed(2)+" %");
            $("#progress").css("width",percent.toFixed(2)+"%");
            $("#sukses-item").html(sukses);
            $("#error-item").html(error);
        }
        function send(data_insert){
            $.ajax({
                type: 'post',
                url: '<?= base_url()?>tes/ajax_add/',
                data: data_insert,
                success: function (result) {
                    if(result == "success"){
                        sukses++;
                    } else {
                        error++;
                        console.log(data_insert);
                        console.log(result);
                    } 
                    progres();
                }
            });  
        }
        $.getJSON( "<?= base_url()?>assets/import-json/<?= $import?>.json", function( data ) {
            var items = [];
            $.each( data, function( key, val ) {
                send(val);
            });
        });
    });
</script>
<?php } ?>