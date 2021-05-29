<?php include('header.php'); ?>
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-users"></i>
                        Tampilan Tabel - Vaksinasi Covid-19
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
                        <a style="padding: .5rem;" class="nav-link" href="#"><i style="padding-right: 5px;" class="icon icon-users"></i>Tampilan Tabel - Vaksinasi Covid-19</a>
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
                                            <label for="inputName" class="col-form-label">Kelompok</label>
                                            <select  class="form-control" name="grup" id="level" >
                                                <option value="" >-- Semua --</option>
                                                <?php foreach ($kelompok_status as $value) { ?>
                                                    <option value="<?= $value; ?>" <?= ( strtoupper($lvl) ==  strtoupper($value) )?"selected":""; ?> ><?= $value; ?></option>    
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row">   
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
                                    
                                    <div class="col-md-4">
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputName" class="col-form-label">Nama <span class="text-primary s-12">(Tidak harus nama lengkap)</span> </label>
                                            <input type="text" class="form-control" id="inputName" placeholder="Tuliskan nama"  name="nama" value="<?= $nama;?>">
                                        </div>
                                    </div> 
                                </div> 
                                <button type="submit" class="btn btn-primary" name="save" value="save">Cari</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-12">
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
                    <div class="card no-b">

                        <div class="card-body">
                        <div class="card-title">
                            <h4>Data Covid-19 <?php if($user_now->level != 'master-admin' && $user_now->level != 'admin'){ echo '- Kecamatan '.$user_now->level; } ?></h4> 
                            <a href="<?= base_url()?>vaksin/add" style="position: absolute; right:35px; top:15px;z-index: 1;">
                                <button type="button" class="btn btn-primary r-20"><i class="icon-plus"></i> Tambah Data Baru</button>
                            </a>
                        </div>
                        <br/>
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Update</th>
                                                <th>Nama</th>
                                                <th>Jenis kelamin</th>
                                                <th>Kelompok</th>
                                                <th>Status</th>
                                                <?php if($user_now->level == 'admin' || $user_now->level == 'master-admin'){ ?>
                                                <th>Kecamatan</th>
                                                <?php } ?>
                                                <th>Kelurahan</th>
                                                <th width="14%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Tanggal Update</th>
                                                <th>Nama</th>
                                                <th>Jenis kelamin</th>
                                                <th>Kelompok</th>
                                                <th>Status</th>
                                                <?php if($user_now->level == 'admin' || $user_now->level == 'master-admin'){ ?>
                                                <th>Kecamatan</th>
                                                <?php } ?>
                                                <th>Kelurahan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            <?php foreach ($data as $s) { ?>
                                            <tr>
                                                <td><?= date( "Y-m-d H:i:s", strtotime( $s->date_updated)) ?></td>
                                                <td><?= $s->nama ?></td>
                                                <td><?= $s->jenis_kelamin ?></td>
                                                <td style="text-align: center;">
                                                    <?php if($s->kelompok == "Guru"){ ?>
                                                    <span class="badge badge-primary red lighten-1 r-20" style="font-size: 12px;">Guru</span>
                                                    <?php } else if($s->kelompok == "Lansia"){ ?>
                                                    <span class="badge badge-primary amber darken-2 r-20" style="font-size: 12px;">Lansia</span>
                                                    <?php } else if($s->kelompok == "Nakes"){ ?>
                                                    <span class="badge badge-primary yellow darken-1 r-20" style="font-size: 12px;">Nakes</span>
                                                    <?php } else if($s->kelompok == "Wartawan"){ ?>
                                                    <span class="badge badge-primary blue lighten-1 r-20" style="font-size: 12px;">Wartawan</span>
                                                    <?php } else if($s->kelompok == "Masyarakat"){ ?>
                                                    <span class="badge badge-primary purple lighten-1 r-20" style="font-size: 12px;">Masyarakat</span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php
                                                    if(isset($s->tgl_vaksinasi2)){
                                                        echo "Vaksinasi Tahap 2";
                                                    } else {
                                                        echo "Vaksinasi Tahap 1";
                                                    }
                                                ?></td>
                                                <?php if($user_now->level == 'admin' || $user_now->level == 'master-admin'){ ?>
                                                <td><?= $s->kecamatan ?></td>
                                                <?php } ?>
                                                <td><?= $s->kelurahan ?></td>
                                                <td>
                                                   <a href="<?= base_url()?>vaksin/edit/<?= $s->_id?>"><button type="button" class="btn  btn-xs btn-warning r-20"><i class="icon-pencil"></i> Edit</button></a>
                                                   <a href="<?= base_url()?>vaksin/delete/<?= $s->_id?>" class="btn-delete"><button type="button" class="btn  btn-xs btn-danger r-20 "><i class="icon-trash"></i> Hapus</button></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <?= $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?> 

<script>
    kecamatan = JSON.parse('<?php echo JSON_encode($kecamatan);?>');
    console.log(kecamatan);
    $("#kecamatan").on('change', function() {
        var level = $(this).find(":selected").val();
        var level_item = kecamatan[level];
        var i;
        var text='<option value="" >-- Semua Kelurahan--</option>';
        for (i = 0; i < level_item.length; i++) {
          text += '<option value="'+level_item[i]+'" >'+level_item[i]+'</option>';
        }
        $("#kelurahan").html(text);
    });
     $(document).ready(function() {  
        navigator.geolocation.getCurrentPosition(onSuccess, onError, {timeout:10000}); 
    });
</script>