<?php
// Get current theme
$theme = getCurrentTheme();

$primaryThemeColor = getThemeData($theme, "primary_color");

//global search icon
$enableGlobalSearchIcon = getConfigData("EnableGlobalSearchIcon");
?>

<style>
#globalSearchIcon {
    position: fixed;
    bottom: 2.5rem;
    left: 20px;
    background-color: <?=$primaryThemeColor?>; 
    color: white;
    padding: 15px;
    border-radius: 50%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    z-index: 1000;
    cursor: pointer;
}
</style>


<?php
if (strtolower($enableGlobalSearchIcon) === "yes") {
?>
<a href="javascript:void(0);" class="global-search-modal text-decoration-none h4" id="globalSearchIcon">
    <i class="ri-search-line"></i>
</a>
<script>
    document.getElementById("globalSearchIcon").addEventListener("click", function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Search',
            html: `
                <div class="flex flex-col items-center">
                    <input id="swal-input-q" class="swal2-input mb-4" placeholder="Enter your search query..." aria-label="Search site" minlength="2">
                    <p class="text-sm text-gray-500 mt-2">Press Enter or click 'Search'</p>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Search',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            allowOutsideClick: () => !Swal.isLoading(),
            preConfirm: () => {
                const query = Swal.getPopup().querySelector('#swal-input-q').value;
                if (!query || query.length < 2) {
                    Swal.showValidationMessage('Please enter at least 2 characters.');
                    return false; // Prevent closing the modal
                }

                const searchUrl = `<?= base_url('search') ?>?q=${encodeURIComponent(query)}`;

                // Redirect to the search URL
                window.location.href = searchUrl;
                return true; // Allow modal to close
            }
        }).then((result) => {
            // This block executes after the modal closes
            if (result.isConfirmed) {
                // Action already handled by preConfirm for redirection
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log('Search cancelled');
            }
        });

        // Auto-focus and handle Enter key for the input field
        Swal.getPopup().querySelector('#swal-input-q').addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                Swal.clickConfirm();
            }
        });
    });
</script>
<?php
}
?>