<footer class="py-3 mt-auto">
    <?php
        if(strtolower(env("CI_ENVIRONMENT")) === "development"){
            ?>
                <div class="text-center p-3">
                    <p>Page rendered in {elapsed_time} seconds using {memory_usage} MB of memory.</p>

                    <p>Environment: <?= ENVIRONMENT ?></p>
                    <p>
                        <?= CodeIgniter\CodeIgniter::CI_VERSION ?>
                    </p>
                </div>
            <?php
        }
    ?>
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="<?= base_url('/'); ?>" class="nav-link px-2 text-body-secondary">Home</a></li>
    </ul>
    <p class="text-center text-body-secondary">&copy; <?= date('Y') ?> <?=getConfigData("SiteName");?></p>
</footer>