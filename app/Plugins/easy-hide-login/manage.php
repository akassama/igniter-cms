<?php
// Generate a random 8-character ID if one doesn't exist
$randomId = bin2hex(random_bytes(4)); // 8-character random string
?>

<div class="container-fluid p-3">
    <h4 class="mb-4">Sign-In URL Generator</h4>
    
    <form id="urlGeneratorForm">
        <!-- Random ID Field -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="uniqueId" class="form-label">Unique Identifier</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="uniqueId" name="uniqueId" value="<?= $randomId ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="generateNewId">
                        <i class="bi bi-arrow-repeat"></i> Generate New
                    </button>
                </div>
                <small class="text-muted">This ID will be used in your sign-in URL</small>
            </div>
        </div>

        <!-- Generated URL Display -->
        <div class="row mb-3">
            <div class="col-md-8">
                <label class="form-label">Your Sign-In URL</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="generatedUrl" value="<?= base_url("sign-in?id={$randomId}") ?>" readonly>
                    <button class="btn btn-primary" type="button" id="copyUrlBtn">
                        <i class="bi bi-clipboard"></i> Copy URL
                    </button>
                </div>
            </div>
        </div>

        <!-- Redirect Option -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="enableRedirect" name="enableRedirect">
                    <label class="form-check-label" for="enableRedirect">Enable Redirect (After invalid URL)</label>
                </div>
            </div>
        </div>

        <!-- Redirect URL (hidden by default) -->
        <div class="row mb-3" id="redirectUrlContainer" style="display:none;">
            <div class="col-md-8">
                <label for="redirectUrl" class="form-label">Redirect URL</label>
                <input type="url" class="form-control" id="redirectUrl" name="redirectUrl" placeholder="https://example.com/welcome">
                <small class="text-muted">Where users should be redirected after signing in</small>
            </div>
        </div>

        <!-- Custom Error Message -->
        <div class="row mb-3">
            <div class="col-md-8">
                <label for="errorMessage" class="form-label">Custom Error Message (Optional)</label>
                <textarea class="form-control" id="errorMessage" name="errorMessage" rows="3" placeholder="Something went wrong. Please try again later."></textarea>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="row mt-4">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success me-2">
                    <i class="bi bi-save"></i> Save Settings
                </button>
                <button type="button" class="btn btn-outline-secondary" id="resetForm">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

<script>
$(document).ready(function() {
    // Toggle redirect URL field
    $('#enableRedirect').change(function() {
        if(this.checked) {
            $('#redirectUrlContainer').slideDown();
        } else {
            $('#redirectUrlContainer').slideUp();
        }
    });

    // Generate new random ID
    $('#generateNewId').click(function() {
        var randomId = createRandomString(8);
        var newSignInURL = "<?=base_url("sign-in?id=") ?>"+randomId;
        $('#uniqueId').val(randomId);
        $('#generatedUrl').val(newSignInURL);
    });

    function createRandomString(length) {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let result = "";
        for (let i = 0; i < length; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return result;
    }


    // Copy URL to clipboard
    $('#copyUrlBtn').click(function() {
        const url = $('#generatedUrl').val();
        navigator.clipboard.writeText(url).then(() => {
            $(this).html('<i class="bi bi-check"></i> Copied!');
            setTimeout(() => {
                $(this).html('<i class="bi bi-clipboard"></i> Copy URL');
            }, 2000);
        });
    });

    // Update generated URL when ID changes
    function updateGeneratedUrl() {
        const newId = $('#uniqueId').val();
        $('#generatedUrl').val(`<?= base_url("signin/") ?>${newId}`);
    }

    // Form submission
    $('#urlGeneratorForm').submit(function(e) {
        e.preventDefault();
        
        const formData = {
            uniqueId: $('#uniqueId').val(),
            enableRedirect: $('#enableRedirect').is(':checked'),
            redirectUrl: $('#redirectUrl').val(),
            errorMessage: $('#errorMessage').val()
        };

        // Here you would typically make an AJAX call to save the settings
        console.log('Form data to be saved:', formData);
        alert('Settings saved successfully!');
    });

    // Reset form
    $('#resetForm').click(function() {
        $('#urlGeneratorForm')[0].reset();
        $('#redirectUrlContainer').hide();
    });
});
</script>