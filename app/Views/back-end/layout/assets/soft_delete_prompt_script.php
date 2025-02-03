<script>
    function deleteRecord(tableName, pkName, pkValue, childTables, returnUrl) {
        Swal.fire({
            title: 'Are you sure you want to remove this record?',
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
                form.action = `<?= base_url('/services/soft-remove-record') ?>`;

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

                const childTablesInput = document.createElement('input');
                childTablesInput.type = 'hidden';
                childTablesInput.name = 'child_tables';
                childTablesInput.value = childTables;
                form.appendChild(childTablesInput);

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