<script>
    function deleteBackup(tableName, pkName, pkValue, filePath, returnUrl) {
        Swal.fire({
            title: 'Are you sure you want to remove this backup?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create the form element
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?= base_url('/services/remove-backup') ?>`;

                // Add hidden input fields
                const tableNameInput = document.createElement('input');
                tableNameInput.type = 'hidden';
                tableNameInput.name = 'table_name';
                tableNameInput.value = tableName;
                form.appendChild(tableNameInput);

                const pkNameInput = document.createElement('input');
                pkNameInput.type = 'hidden';
                pkNameInput.name = 'pk_name';
                pkNameInput.value = pkName;
                form.appendChild(pkNameInput);

                const pkValueInput = document.createElement('input');
                pkValueInput.type = 'hidden';
                pkValueInput.name = 'pk_value';
                pkValueInput.value = pkValue;
                form.appendChild(pkValueInput);

                const filePathInput = document.createElement('input');
                filePathInput.type = 'hidden';
                filePathInput.name = 'file_path';
                filePathInput.value = filePath;
                form.appendChild(filePathInput);

                const returnUrlInput = document.createElement('input');
                returnUrlInput.type = 'hidden';
                returnUrlInput.name = 'return_url';
                returnUrlInput.value = returnUrl;
                form.appendChild(returnUrlInput);

                // Append the form to the body and submit it
                document.body.appendChild(form);
                form.submit();

                // Remove the form from the body after submit (optional)
                document.body.removeChild(form);
            }
        });
    }
</script>