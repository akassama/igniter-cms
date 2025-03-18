<?php if(session()->getFlashdata('successAlert')):?>
    <!--Alert Success-->
    <script>
        swal.fire({
            title: 'Success!',
            text: '<?= session()->getFlashdata('successAlert') ?>',
            icon: 'success',
            confirmButtonColor: '#28a745',
            timer: 3000 // Close after 3 seconds
        });
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('errorAlert')):?>
    <!--Alert Error-->
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

<?php if(session()->getFlashdata('warningAlert')):?>
    <!--Alert Warning-->
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

<?php if(session()->getFlashdata('infoAlert')):?>
    <!--Alert Info-->
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

<?php if(session()->getFlashdata('messageAlert')):?>
    <!--Message Alert-->
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
