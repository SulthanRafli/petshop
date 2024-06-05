<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Form Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">List Data Penjualan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Penjualan</li>
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
                                <label>Barang</label>
                                <select class="form-control select2bs4" data-placeholder="Pilih.." name="idBarang" id="idBarang" style="width: 100%;" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($data_barang as $dm) {
                                        echo "<option value='$dm->idBarang'>$dm->nama</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control select2bs4" data-placeholder="Pilih.." name="bulan" id="bulan" style="width: 100%;" required>
                                    <option value="">Pilih</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun</label>
                                <select id="yearpicker" class="form-control select2bs4" data-placeholder="Pilih.." name="tahun" style="width: 100%;" required></select>
                            </div>
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" min="0" class="form-control" placeholder="Qty" name="qty" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a type="button" class="btn btn-danger" href="<?php echo base_url(); ?>C_crud/list_penjualan">Kembali</a>
                            <button type="button-submit" class="btn btn-primary" onclick="save()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $(document).ready(function() {
        // Function to populate year dropdown
        function populateYearDropdown(startYear, endYear, elementId) {
            var select = $('#' + elementId);
            select.append($('<option>', {
                value: "",
                text: "Pilih"
            }))
            for (var year = endYear; year >= startYear; year--) {
                select.append($('<option>', {
                    value: year,
                    text: year
                }));
            }
        }

        // Define the range of years
        var startYear = 1900;
        var endYear = new Date().getFullYear(); // Current year

        // Populate the year dropdown
        populateYearDropdown(startYear, endYear, 'yearpicker');
    });

    function save() {
        $("#basic").submit(function(e) {
            swal({
                title: "Apa anda yakin ingin menyimpan data ?",
                text: "Pastikan data yang diinput benar!",
                icon: "warning",
                buttons: ["Tidak", "Iya"],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "C_crud/save_penjualan",
                        data: $(e.target).serialize(),
                        dataType: "json",
                        success: function(data) {
                            if (data.status === true) {
                                swal({
                                    title: "Berhasil",
                                    text: "Data Berhasil Tersimpan",
                                    icon: "success",
                                    button: "OK",
                                }).then(function(isConfirm) {
                                    window.location = baseUrl + "C_crud/list_penjualan";
                                });
                            } else {
                                $(".load").modal("hide");
                                swal({
                                    title: "Error",
                                    text: "Data Gagal Disimpan",
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
        });
    }
</script>