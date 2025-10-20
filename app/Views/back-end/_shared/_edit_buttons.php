
<?php 
$demoMode = boolval(env('DEMO_MODE', "false"));
?>

<?php if($demoMode): ?>
    <button type="button" class="btn btn-outline-primary float-end demo-submit-btn" id="submit-btn">
        <i class="ri-edit-box-line"></i>
        Update
    </button>
<?php else: ?>
    <button type="submit" class="btn btn-outline-primary float-end live-edit-btn" id="submit-btn">
        <i class="ri-edit-box-line"></i>
        Update
    </button>
<?php endif; ?>

<script>
// Form submission loading states - Vanilla JS
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submissions
    document.addEventListener('submit', function(e) {
        const form = e.target;
        const submitBtn = form.querySelector('.live-edit-btn');
        
        if (submitBtn && form.checkValidity()) {
            showButtonLoading(submitBtn);
        }
    });
    
    // Handle button clicks
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('live-edit-btn')) {
            const btn = e.target;
            const form = btn.closest('form');
            
            if (form && btn.getAttribute('type') === 'button') {
                if (form.checkValidity()) {
                    showButtonLoading(btn);
                    form.dispatchEvent(new Event('submit', { cancelable: true }));
                } else {
                    form.classList.add('was-validated');
                }
            }
        }
    });
    
    // Function to show loading state
    function showButtonLoading(button) {
        const originalHtml = button.innerHTML;
        const originalWidth = button.offsetWidth + 'px';
        
        // Set fixed width to prevent button from resizing
        button.style.width = originalWidth;
        
        // Store original content for later restoration
        button.setAttribute('data-original-html', originalHtml);
        
        // Replace with loading content
        button.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Processing...
        `;
        
        // Disable the button
        button.disabled = true;
        button.classList.add('disabled');
    }
    
    // Function to hide loading state
    function hideButtonLoading(button) {
        const originalHtml = button.getAttribute('data-original-html');
        if (originalHtml) {
            button.innerHTML = originalHtml;
        }
        button.disabled = false;
        button.classList.remove('disabled');
        button.style.width = ''; // Reset width
    }
    
    // Make functions available globally
    window.showButtonLoading = showButtonLoading;
    window.hideButtonLoading = hideButtonLoading;
});

// HTMX integration
document.addEventListener('htmx:beforeRequest', function(e) {
    const form = e.target.closest('form');
    if (form) {
        const submitBtn = form.querySelector('.live-edit-btn');
        if (submitBtn) {
            showButtonLoading(submitBtn);
        }
    }
});

document.addEventListener('htmx:afterRequest', function(e) {
    const form = e.target.closest('form');
    if (form) {
        const submitBtn = form.querySelector('.live-edit-btn');
        if (submitBtn) {
            hideButtonLoading(submitBtn);
        }
    }
});
</script>