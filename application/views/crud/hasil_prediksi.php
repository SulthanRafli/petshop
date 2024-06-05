<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Hasil Prediksi Metode Last Square</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Hasil Prediksi</li>
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
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-table"></i> <b>Nilai Y, X, XX, XY</b></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">&sum;<span>Y</span></th>
                                    <th class="text-center">&sum;<span>X</span></th>
                                    <th class="text-center">&sum;<span>X<sup>2</sup></span></th>
                                    <th class="text-center">&sum;<span>XY</span></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td><?php echo $hasil_prediksi->jumlahY ?></td>
                                    <td><?php echo $hasil_prediksi->jumlahX ?></td>
                                    <td><?php echo $hasil_prediksi->jumlahXX ?></td>
                                    <td><?php echo $hasil_prediksi->jumlahXY ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-table"></i> <b>Nilai A, B</b></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Nilai A</th>
                                    <th class="text-center">Nilai B</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td><?php echo $hasil_prediksi->nilaiA ?></td>
                                    <td><?php echo $hasil_prediksi->nilaiB ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-table"></i> <b>Hasil Prediksi</b></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Bulan</th>
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Hasil</th>
                                    <th class="text-center">Y-Y'</th>
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
                                $no = 0;
                                $total = 0;
                                foreach ($data as $ll) {
                                    echo "
                                        <tr>                                                                                        
                                            <td>" . mappingMonth($ll->bulan) . "</td>
                                            <td>$ll->tahun</td>                                                                                                                       
                                            <td>" . number_format($ll->hasil, 3) . "</td>                                                                                                                                                                  
                                            <td>" . number_format($ll->mad, 3) . "</td>                                                                                                                                                                  
                                        </tr>                                        
                                        ";
                                    $no++;
                                    $total += $ll->hasil;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>Hasil Prediksi</th>
                                    <th><?php echo mappingMonth($hasil_prediksi->bulan) ?></th>
                                    <th><?php echo $hasil_prediksi->tahun ?></th>
                                    <th><?php echo $hasil_prediksi->hasil ?></th>
                                </tr>
                                <tr class="text-left">
                                    <th colspan="3">Total</th>
                                    <th><?php echo number_format($total + $hasil_prediksi->hasil, 3) ?></th>
                                </tr>
                                <tr class="text-left">
                                    <th colspan="3">Data Aktual (n)</th>
                                    <th><?php echo $no ?></th>
                                </tr>
                                <tr class="text-left">
                                    <th colspan="3">MAD</th>
                                    <th><?php echo number_format($total + $hasil_prediksi->mad, 3) ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>