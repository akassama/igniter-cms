<script>
    $(document).ready(function() {
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/php");

        document.getElementById('saveFileForm').addEventListener('submit', function() {
            document.getElementById('fileContent').value = editor.getValue();
        });
    });
</script>