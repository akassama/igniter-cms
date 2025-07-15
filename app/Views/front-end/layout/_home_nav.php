<?php
    //get site config values
    $siteName = getConfigData("SiteName");
    $backendLogoLink = getConfigData("BackendLogoLink");
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/'); ?>">
            <?php if (!empty($backendLogoLink)): ?>
            <img src="<?= getImageUrl($backendLogoLink ?? getDefaultImagePath()) ?>" alt="Logo" class="img-thumbnail" style="max-height: 3.4rem;">
            <?php else: ?>
                <?=$siteName;?>
            <?php endif; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('/'); ?>">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-5">
                <li class="nav-item">
                    <a class="nav-link <?=strtolower(getFileNameFromUrl(current_url())) === "sign-in" ? "active" : ""?>" href="<?= base_url('/sign-in'); ?>">Sign-In</a>
                </li>
                <?php
                    $allowRegistration = getConfigData("EnableRegistration");
                    if(strtolower($allowRegistration) === "yes"){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?=strtolower(getFileNameFromUrl(current_url())) === "sign-up" ? "active" : ""?>" href="<?= base_url('/sign-up'); ?>">Sign-Up</a>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>