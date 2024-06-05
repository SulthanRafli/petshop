<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">List Data Penjualan</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a type="button" href="<?php echo base_url(); ?>C_crud/add_penjualan" class="btn btn-md btn-primary">Tambah Data Penjualan</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">No</th>
                                    <th class="text-center">Barang</th>
                                    <th class="text-center">Bulan</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                function mappingMonth($monthNumber)
                                {
                                    $months = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember'
                                    ];

                                    return isset($months[$monthNumber]) ? $months[$monthNumber] : 'Invalid Month';
                                }
                                $no = 1;
                                foreach ($data as $ll) {

                                    echo "
                                        <tr>
                                            <td>$no</td>
                                            <td>$ll->barang</td>
                                            <td>" . mappingMonth($ll->bulan) . "</td>
                                            <td>$ll->tahun</td>                                                                                                                       
                                            <td>$ll->qty</td>                                                                                                                       
                                            <td>
                                                <div class='btn-group-vertical'>
                                                    <a type='button' href='" . base_url() . "C_crud/view_penjualan/$ll->idPenjualan' class='btn btn-md btn-primary'>Lihat</a>
                                                    <a type='button' href='" . base_url() . "C_crud/edit_penjualan/$ll->idPenjualan' class='btn btn-md btn-warning text-white'>Ubah</a>
                                                    <button type='button' class='btn btn-md btn-danger' onclick='deleteData($ll->idPenjualan)'>Hapus</button>
                                                </div>
                                            </td>
                                        </tr>                                        
                                        ";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function deleteData(id) {
        swal({
            title: "Anda sudah yakin melakukan penghapusan data?",
            text: "Data yang sudah dihapus tidak dapat dikembalikan",
            icon: "warning",
            buttons: ["Tidak", "Iya"],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: baseUrl + "C_crud/delete_penjualan/" + id,
                    dataType: "json",
                    success: function(data) {
                        if (data.status === true) {
                            swal({
                                title: "Berhasil",
                                text: "Data Berhasil Terhapus",
                                icon: "success",
                                button: "OK",
                            }).then(function(isConfirm) {
                                window.location = baseUrl + "C_crud/list_penjualan";
                            });
                        } else {
                            swal({
                                title: "Error",
                                text: "Data Gagal Dihapus",
                                icon: "error",
                                button: "OK",
                            });
                        }
                    },
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
        return false;
    }
</script>