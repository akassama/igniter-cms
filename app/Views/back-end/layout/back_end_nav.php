<?php
    //get site config values
    $siteName = getConfigData("SiteName");
    $backendLogoLink = getConfigData("BackendLogoLink");
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?= base_url('/account'); ?>">
        <?php if (!empty($backendLogoLink)): ?>
            <img src="<?= getImageUrl($backendLogoLink ?? getDefaultImagePath()) ?>" alt="Logo" class="img-thumbnail mt-4" style="max-height: 65px;">
        <?php else: ?>
            <?=$siteName;?>
        <?php endif; ?>
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="ri-list-check h5"></i></button>
    
    <!-- Navbar Search-->
    <form action="<?= base_url('search/modules') ?>" method="get" class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" id="q" name="q" type="text" placeholder="<?= lang('App.search_for') ?>" aria-label="<?= lang('App.search_for') ?>" aria-describedby="btnNavbarSearch" minlength="1" required/>
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="ri-search-line"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-group-fill h5"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= base_url('/'); ?>" target="_blank"><i class="ri-home-8-line"></i> <?= lang('App.view_site') ?></a></li>
                <li><a class="dropdown-item" href="<?= base_url('/account/settings'); ?>"><i class="ri-user-settings-line"></i> <?= lang('App.settings') ?></a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" id="logout-link" href="javascript:void(0)"><i class="ri-logout-circle-line"></i> <?= lang('App.logout') ?></a></li>
            </ul>
        </li>
    </ul>
</nav>

<script>
    // When the logout link is clicked
    document.getElementById('logout-link').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default link behavior

        // Show a confirmation modal
        Swal.fire({
            title: <?= json_encode(lang('App.confirm_sign_out')) ?>,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: <?= json_encode(lang('App.yes')) ?>,
            cancelButtonText: <?= json_encode(lang('App.no')) ?>
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the sign-out link
                window.location.href = '<?= base_url('/sign-out'); ?>';
            }
        });
    });
</script>