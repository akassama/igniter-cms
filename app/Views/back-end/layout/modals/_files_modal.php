<?php
$session = session();
// Get session data
$sessionUserId = $session->get('user_id');
?>
<!-- File Manager Modals -->
<div class="modal fade" id="ciFileManagerModal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body position-relative">
                <!-- Preloader -->
                <div class="cifm-preloader">
                    <div class="cifm-spinner"></div>
                    <span class="cifm-preloader-text">Loading File Manager...</span>
                </div>
                <embed class="w-100 h-100 cifm-embed" type="text/html" src="<?=base_url(env("CI_FM_ROUTE"))."?modal=true"?>">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php if (isFeatureEnabled('FEATURE_FILE_MANAGER')): ?>
    <!--File Manager Modals-->

    <style>
    .cifm-preloader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        transition: opacity 0.3s ease;
    }

    .cifm-preloader.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .cifm-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid <?=env("CI_FM_PRIMARY_COLOR", "#ef4322")?>;
        border-radius: 50%;
        animation: cifm-spin 1s linear infinite;
    }

    .cifm-preloader-text {
        margin-top: 10px;
        font-size: 1rem;
        color: #495057;
    }

    @keyframes cifm-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const embeds = document.querySelectorAll('.cifm-embed');

    embeds.forEach(embed => {
        // Find the closest .modal-body container
        const modalBody = embed.closest('.modal-body');

        if (!modalBody) return;

        // Find the preloader within the same modal
        const preloader = modalBody.querySelector('.cifm-preloader');

        if (!preloader) return;

        embed.addEventListener('load', function () {
            preloader.classList.add('hidden');
            // Remove preloader after transition completes
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 300); // Match transition duration
        });

        // Optional fallback timeout (10 seconds)
        setTimeout(() => {
            if (!preloader.classList.contains('hidden')) {
                preloader.classList.add('hidden');
                preloader.style.display = 'none';
            }
        }, 10000);
    });
});
</script>
<?php endif; ?>
