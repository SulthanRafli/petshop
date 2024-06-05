<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>List Data Prediksi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">List Data Prediksi</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
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
                                    <th class="text-center">Hasil Prediksi</th>
                                    <th class="text-center">Y-Y' Error</th>
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
                                            <td>" . number_format($ll->hasil, 3) . "</td>                                                                                                                                                                  
                                            <td>" . number_format($ll->mad, 3) . "</td>                                                                                                                                                                  
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
</script>