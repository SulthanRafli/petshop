<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $jumlahBarang ?></h3>

                        <p>Total Barang</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?php echo base_url('C_crud/list_barang') ?>" class="small-box-footer">Lihat selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $jumlahLogin ?></h3>

                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo base_url('C_crud/list_login') ?>" class="small-box-footer ">Lihat selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $jumlahPenjualan ?></h3>

                        <p>Total Penjualan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo base_url('C_crud/list_penjualan') ?>" class="small-box-footer ">Lihat selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Grafik Penjualan (2020)</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var dataChart = <?php echo $chartPenjualan ?>;

    $(function() {
        const xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        let colors = ['#' + (Math.random() * 0xFFFFFF << 0).toString(16), '#' + (Math.random() * 0xFFFFFF << 0).toString(16), '#' + (Math.random() * 0xFFFFFF << 0).toString(16)];

        new Chart("lineChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: dataChart.map((dataset, index) => {
                    return {
                        data: dataset.data,
                        borderColor: colors[index],
                        fill: false,
                        label: dataset.barang
                    }
                })
            },
            options: {
                legend: {
                    display: true
                }
            }
        });
    })
</script>