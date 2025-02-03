<!--Alert Success-->
<?php if(session()->getFlashdata('successAlert')):?>
    <script>
        swal.fire({
            title: 'Success!',
            text: '<?= session()->getFlashdata('successAlert') ?>',
            icon: 'success',
            confirmButtonColor: '#28a745',
            timer: 5000 // Close after 5 seconds
        });
    </script>
<?php endif;?>

<!--Alert Error-->
<?php if(session()->getFlashdata('errorAlert')):?>
    <script>
        swal.fire({
            title: 'Errror!',
            text: '<?= session()->getFlashdata('errorAlert') ?>',
            icon: 'error',
            confirmButtonColor: '#dc3545',
            timer: 5000
        });
    </script>
<?php endif;?>

<!--Alert Warning-->
<?php if(session()->getFlashdata('warningAlert')):?>
    <script>
        swal.fire({
            title: 'Warning!',
            text: '<?= session()->getFlashdata('warningAlert') ?>',
            icon: 'warning',
            confirmButtonColor: '#ffc107',
            timer: 5000
        });
    </script>
<?php endif;?>

<!--Alert Info-->
<?php if(session()->getFlashdata('infoAlert')):?>
    <script>
        swal.fire({
            title: 'Info!',
            text: '<?= session()->getFlashdata('infoAlert') ?>',
            icon: 'info',
            confirmButtonColor: '#54B4D3',
            timer: 5000
        });
    </script>
<?php endif;?>

<!--Message Alert-->
<?php if(session()->getFlashdata('messageAlert')):?>
    <script>
        swal.fire('<?= session()->getFlashdata('messageAlert') ?>');
    </script>
<?php endif;?>

<?php
    //Clear flash data
    session()->setFlashdata('successAlert', '');
    session()->setFlashdata('errorAlert', '');
    session()->setFlashdata('warningAlert', '');
    session()->setFlashdata('infoAlert', '');
?>
