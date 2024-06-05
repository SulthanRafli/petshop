<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Form Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">List Data Barang</a></li>
                    <li class="breadcrumb-item active">Lihat Data Barang</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <form id="basic">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="<?php echo $data->nama ?>" name="nama" readonly placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" min="0" class="form-control" placeholder="Harga" name="harga" value="<?php echo $data->harga ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" min="0" class="form-control" placeholder="Stok" name="stok" value="<?php echo $data->stok ?>" readonly>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a type="button" class="btn btn-danger" href="<?php echo base_url(); ?>C_crud/list_barang">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>