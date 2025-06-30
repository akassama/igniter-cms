
<!--bootstrap.bundle js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!--datatables js-->
<script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.0/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>

<!--HTMX cdn-->
<script src="https://unpkg.com/htmx.org@1.9.6/dist/htmx.min.js"></script>

<!--Alpine cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.min.js"></script>

<!--select2 js-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!--copy clipboard-->
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>

<!--toastr js-->
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>

<!-- Tippy JS -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="<?= base_url('public/back-end/assets/js/tippy-tooltips.js')?>"></script>

<!-- summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- cropper css -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- jqueryui js cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js"></script>

<!--js.cookie-->
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>

<!--file-input-validator.js-->
<script src="<?= base_url('public/back-end/assets/js/libs/file-input-validator/file-input-validator.js')?>"></script>

<!--js-input-validator.js-->
<script src="<?= base_url('public/back-end/assets/js/libs/js-input-validator/js-input-validator.js')?>"></script>

<!-- include CodeMirror JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/javascript/javascript.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/css/css.min.js"></script>

<!-- jQuery-Tags-Input js cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>

<!-- jquery.timepicker js cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!-- Tempus Dominus JS -->
<script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.7/dist/js/tempus-dominus.min.js"></script>

<!-- Moment.js (required for Tempus Dominus) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<!--ace editor js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.14/ace.js"></script>

<!--Syntax JS-->
<script src="https://cdn.jsdelivr.net/gh/williamtroup/Syntax.js@3.1.0/dist/syntax.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/williamtroup/Syntax.js@3.1.0/dist/languages/syntax.javascript.js"></script>
<script src="https://cdn.jsdelivr.net/gh/williamtroup/Syntax.js@3.1.0/dist/languages/syntax.html.js"></script>
<script src="https://cdn.jsdelivr.net/gh/williamtroup/Syntax.js@3.1.0/dist/languages/syntax.css.js"></script>

<!-- Check for showing demo message -->
<?php 
$currentUrl = current_url();
$demoMode = isset($_GET['demo']) && $_GET['demo'] === 'true';
?>
<?php if($demoMode):?>
<script>
    // Show demo message
    Swal.fire({
        title: 'Warning!',
        text: 'You are a demo user and not authorised for this action.',
        icon: 'warning',
        confirmButtonColor: '#ffc107',
        timer: 5000
    });
</script>
<?php endif;?>

<script>
$(document).ready(function(){
  $(".demo-submit-btn").click(function(){
    //Show demo message
    swal.fire({
        title: 'Warning!',
        text: 'You are a demo user and not authorised for this action.',
        icon: 'warning',
        confirmButtonColor: '#ffc107',
        timer: 5000
    });
  });
});
</script>

<script>
    //Set max file size upload
    $(document).ready(function() {
        const maxFileSize = "<?= getConfigData("MaxUploadFileSize") ?>"; 
        Cookies.set('max_file_size', maxFileSize, { expires: 7 });
    });
</script>

<!-- Check for enabling or disabling AI integration -->
<?php $enableGeminiAI = getConfigData("EnableGeminiAI"); ?>
<?php if(strtolower($enableGeminiAI) !== "yes"):?>
<script>
    //diabale AI buttons
    setTimeout(function (){
        var useAIbuttons = document.getElementsByClassName('use-ai-btn');
        for (var i = 0; i < useAIbuttons.length; i ++) {
            useAIbuttons[i].style.display = 'none';
        }          
    }, 500);
</script>
<?php endif;?>

<!--custom js-->
<script src="<?= base_url('public/back-end/assets/js/script.js')?>"></script>