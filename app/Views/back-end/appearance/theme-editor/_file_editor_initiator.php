<script>
    $(document).ready(function() {
        // Initialize PHP Editor (if exists)
        try {
            var editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/php");
        } catch(e) {
            //console.log("PHP Editor not found");
        }

        // Initialize JS Editor (if exists)
        try {
            var editor2 = ace.edit("js_editor");
            editor2.setTheme("ace/theme/monokai");
            editor2.session.setMode("ace/mode/javascript");
        } catch(e) {
            //console.log("JS Editor not found");
        }

        // Initialize CSS Editor (if exists)
        try {
            var editor3 = ace.edit("css_editor");
            editor3.setTheme("ace/theme/monokai");
            editor3.session.setMode("ace/mode/css");
        } catch(e) {
            //console.log("CSS Editor not found");
        }

        // Save file content from whichever editor exists
        document.getElementById('saveFileForm').addEventListener('submit', function() {
            if (typeof editor !== 'undefined') {
                document.getElementById('fileContent').value = editor.getValue();
            } else if (typeof editor2 !== 'undefined') {
                document.getElementById('fileContent').value = editor2.getValue();
            } else if (typeof editor3 !== 'undefined') {
                document.getElementById('fileContent').value = editor3.getValue();
            }
        });
    });
</script>