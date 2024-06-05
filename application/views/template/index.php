<?php if($this->session->userdata('isLogin') !== true){    
    redirect(base_url());
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('template/meta') ?>
    <?php $this->load->view('template/js') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url('assets/') ?>dist/img/logo.png" alt="logo" height="60" width="60" />
        </div>

        <?php $this->load->view('template/navbar') ?>
        <?php $this->load->view('template/sidebar') ?>

        <div class="content-wrapper <?= $page === 'kanban' ? 'kanban' : '' ?>">
            <?php $this->load->view($page) ?>

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>

        <?php $this->load->view('template/footer') ?>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>    
</body>

</html>