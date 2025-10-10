<script>
    $(document).ready(function() {
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/php");

        document.getElementById('saveFileForm').addEventListener('submit', function() {
            document.getElementById('fileContent').value = editor.getValue();
        });
    });

    $(document).ready(function() {
        var editor2 = ace.edit("js_editor");
        editor2.setTheme("ace/theme/monokai");
        editor2.session.setMode("ace/mode/javascript");

        document.getElementById('saveFileForm').addEventListener('submit', function() {
            document.getElementById('fileContent').value = editor2.getValue();
        });
    });

    $(document).ready(function() {
        var editor3 = ace.edit("css_editor");
        editor3.setTheme("ace/theme/monokai");
        editor3.session.setMode("ace/mode/javascript");

        document.getElementById('saveFileForm').addEventListener('submit', function() {
            document.getElementById('fileContent').value = editor3.getValue();
        });
    });
</script>
