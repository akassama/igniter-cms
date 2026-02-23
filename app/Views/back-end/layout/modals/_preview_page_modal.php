<!-- Preview Page Modal -->
<div class="modal fade" id="previewPageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark"> <div class="modal-header bg-white">
                <h5 class="modal-title">Page Preview</h5>
                
                <div class="ms-auto me-3">
                    <div class="btn-group" role="group" aria-label="Device Preview">
                        <button type="button" class="btn btn-outline-primary active preview-device-btn" data-device="desktop">
                            <i class="ri-computer-line"></i> <span class="d-none d-sm-inline">Desktop</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary preview-device-btn" data-device="tablet">
                            <i class="ri-tablet-line"></i> <span class="d-none d-sm-inline">Tablet</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary preview-device-btn" data-device="mobile">
                            <i class="ri-smartphone-line"></i> <span class="d-none d-sm-inline">Mobile</span>
                        </button>
                    </div>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 d-flex justify-content-center align-items-center" style="overflow: hidden;">
                <div id="preview-frame-wrapper" class="preview-desktop">
                    <iframe id="preview-iframe" src="about:blank" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #preview-frame-wrapper {
        background: #fff;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        margin: 20px auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        height: calc(100% - 40px);
    }

    /* Device Sizes */
    .preview-desktop { width: 100%; height: 100% !important; margin: 0 !important; }
    .preview-tablet { width: 768px; border-radius: 20px; border: 12px solid #333; }
    .preview-mobile { width: 375px; border-radius: 20px; border: 12px solid #333; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const previewModal = document.getElementById('previewPageModal');
    const previewIframe = document.getElementById('preview-iframe');
    const frameWrapper = document.getElementById('preview-frame-wrapper');
    const deviceButtons = document.querySelectorAll('.preview-device-btn');

    // 1. When modal opens, load the URL
    previewModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-page-url');
        
        // Reset to desktop view initially
        resetPreview();
        
        // Set the iframe source
        previewIframe.src = url;
    });

    // 2. Clear iframe when closing (stops videos/music if any)
    previewModal.addEventListener('hidden.bs.modal', function () {
        previewIframe.src = 'about:blank';
    });

    // 3. Handle Device Toggling
    deviceButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const device = this.getAttribute('data-device');
            
            // UI Updates
            deviceButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Change Frame Size
            frameWrapper.className = ''; 
            frameWrapper.classList.add('preview-' + device);
        });
    });

    function resetPreview() {
        frameWrapper.className = 'preview-desktop';
        deviceButtons.forEach(b => b.classList.remove('active'));
        document.querySelector('[data-device="desktop"]').classList.add('active');
    }
});
</script>