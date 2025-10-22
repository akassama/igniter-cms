<?php if(session()->getFlashdata('toastrSuccessAlert')):?>
    <!-- Toastr Success -->
    <script>
        toastr.success('<?= session()->getFlashdata('toastrSuccessAlert') ?>', 'Success', {
            closeButton: true,
            progressBar: true,
            timeOut: 3000,
            extendedTimeOut: 1000
        });
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('toastrErrorAlert')):?>
    <!-- Toastr Error -->
    <script>
        toastr.error('<?= session()->getFlashdata('toastrErrorAlert') ?>', 'Error', {
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 1000
        });
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('toastrWarningAlert')):?>
    <!-- Toastr Warning -->
    <script>
        toastr.warning('<?= session()->getFlashdata('toastrWarningAlert') ?>', 'Warning', {
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 1000
        });
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('toastrInfoAlert')):?>
    <!-- Toastr Info -->
    <script>
        toastr.info('<?= session()->getFlashdata('toastrInfoAlert') ?>', 'Info', {
            closeButton: true,
            progressBar: true,
            timeOut: 5000,
            extendedTimeOut: 1000
        });
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('toastrMessageAlert')):?>
    <!-- Toastr Message -->
    <script>
        toastr.info('<?= session()->getFlashdata('toastrMessageAlert') ?>', '', {
            closeButton: true,
            progressBar: true,
            timeOut: 4000,
            extendedTimeOut: 1000
        });
    </script>
<?php endif;?>

<?php
    // Clear toastr flash data
    session()->setFlashdata('toastrSuccessAlert', '');
    session()->setFlashdata('toastrErrorAlert', '');
    session()->setFlashdata('toastrWarningAlert', '');
    session()->setFlashdata('toastrInfoAlert', '');
    session()->setFlashdata('toastrMessageAlert', '');
?>
