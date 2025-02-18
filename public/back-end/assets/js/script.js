/* Set Cookies */
Cookies.set('max_file_size', '5', { expires: 7 });
Cookies.set('screen_resolution', getScreenResolution(), { expires: 1 });
/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
//
// Scripts
//

/**
 * Adds functionality to toggle the side navigation menu.
 * Listens for clicks on the element with the ID 'sidebarToggle'.
 * Toggles the 'sb-sidenav-toggled' class on the body element to control visibility.
 * Saves the toggle state to localStorage for persistence (currently commented out).
 */
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
             document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

// Initialize tags input
$(document).ready(function() {
    // Initialize tags input
    $('.tags-input').tagsInput({
        width: 'auto',
        height: 'auto',
        onAddTag: function(tag) {
            if ($('.tags-input').attr('readonly')) {
                $('.tags-input').removeTag(tag); // Prevent adding new tags if readonly
            }
        }
    });

    // Check if the input is readonly and disable adding new tags
    if ($('.tags-input').attr('readonly')) {
        $('.tags-input').siblings('.tagsinput').find('input').prop('disabled', true);
    }
});

// Select 2 options
$(document).ready(function() {
    $('.select2-options').select2({
      minimumInputLength: 2,
      maximumInputLength: 25
    });
});


/**
 * Disables form submissions if there are invalid fields, applying custom Bootstrap validation styles.
 */
(function () {
    'use strict';

    /**
     * Fetches all forms with the class 'needs-validation'.
     * @type {NodeListOf<HTMLFormElement>}
     */
    var forms = document.querySelectorAll('.needs-validation');

    /**
     * Prevents form submission, applies custom Bootstrap validation styles, and stops event propagation.
     * @param {Event} event - The submit event object.
     */
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
})();


/**
 * Initializes a DataTable instance for the element with the class "datatable".
 */
$(document).ready(function () {
    $('.datatable').DataTable();
});

/**
 * Initializes a DataTable export instance for the element with the class "datatable".
 */
$(document).ready(function () {
    new DataTable('.datatable-export', {
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        }
    });
});


/**
 * Initializes a DataTable instance for the element with the class "simple-datatable"
 * without the search or filter options.
 */
$(document).ready(function () {
    $('.simple-datatable').DataTable({
        searching: false,
        paging: false,
        info: false
    });
});


/**
 * This code initializes the Summernote editor on elements with the class "content-editor" when the DOM is ready.
 *
 * @summary Initializes Summernote editor on content-editor elements.
 */
$(document).ready(function () {
    $('.content-editor').summernote({
        placeholder: 'Enter content here...',
        tabsize: 2,
        height: 150
    });
});

/**
 * Configures toastr options for displaying notification messages.
 */
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

/**
 * Copies text to the clipboard using the Clipboard API.
 * Shows success/error messages using toastr.
 * @param {string} text - The text to copy.
 */
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        toastr.success('Copied successfully!', '', {timeOut: 2000});
    }, function(err) {
        toastr.error('Could not copy text', '', {timeOut: 2000});
    });
}

// Event delegation for dynamically added buttons
$(document).on('click', '.btn-copy, .btn-modal-copy', function(e) {
    e.preventDefault();
    const textToCopy = $(this).data('clipboard-text');
    copyToClipboard(textToCopy);
});

//clipboard js
var clipboard = new ClipboardJS('.copy-btn');

$(document).on('click', '.copy-btn, .copy-modal-btn', function(e) {
    e.preventDefault();
    toastr.success('Copied successfully!', '', {timeOut: 2000});
});

$(document).ready(function(){
    $('[data-bs-toggle="tooltip"]').tooltip();
});

/**
 * Sets the 'max_file_size' cookie with a value of 5.
 */
// File input validator settings
$(document).ready(function () {
    new FileInputValidator('.file-input', {
        accept: 'all',
        maxSize:  parseInt(Cookies.get('max_file_size'))
    });
});

 /**
 * This JavaScript code initializes datepicker functionality for various elements on the page.
 *
 * @function
 * @param {jQuery} $ - The jQuery object.
 */
 $( function(){
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
    });
    const date = new Date();
    $(".future-datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(date.getFullYear(), date.getMonth(), date.getDate())
    });
    $(".past-datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: new Date(date.getFullYear(), date.getMonth(), date.getDate())
    });
});

/**
 * Initializes a timepicker for elements with the class 'time-picker'.
 */
$(document).ready(function() {
    $('.time-picker').timepicker({   
      timeFormat: 'h:mm p',
      interval: 30,
      startTime: '06:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
    });
});


/**
 * Initializes CodeMirror editors on the page when the DOM content is fully loaded.
 */
document.addEventListener('DOMContentLoaded', () => {

    /**
     * Initialize CodeMirror for the JavaScript editor.
     * @type {CodeMirror.EditorFromTextArea}
     */
    document.querySelectorAll('.js-editor').forEach((el) => {
        CodeMirror.fromTextArea(el, {
            mode: 'javascript',       // Set the editor mode to JavaScript
            theme: 'dracula',          // Use the Dracula theme
            styleActiveLine: true,     // Highlight the active line
            matchBrackets: true,       // Enable bracket matching
            lineNumbers: true          // Show line numbers
        });
    });

    /**
     * Initialize CodeMirror for the JavaScript editor.
     * @type {CodeMirror.EditorFromTextArea}
     */
    document.querySelectorAll('.html-editor').forEach((el) => {
        CodeMirror.fromTextArea(el, {
            mode: 'text/html',
            theme: 'dracula',
            styleActiveLine: true,
            matchBrackets: true,
            lineNumbers: true,
            htmlMode: true
        });
    });

    /**
     * Initialize CodeMirror for the CSS editor.
     * @type {CodeMirror.EditorFromTextArea}
     */
    document.querySelectorAll('.css-editor').forEach((el) => {
        CodeMirror.fromTextArea(el, {
            mode: 'css',               // Set the editor mode to CSS
            theme: 'dracula',          // Use the Dracula theme
            styleActiveLine: true,     // Highlight the active line
            matchBrackets: true,       // Enable bracket matching
            lineNumbers: true          // Show line numbers
        });
    });

    /**
     * Initializes CodeMirror for each text area with the class `code-editor`.
     * @param {NodeListOf<HTMLTextAreaElement>} textAreas - List of text area elements with class `code-editor`.
     */
    document.querySelectorAll('.code-editor').forEach((el) => {
        CodeMirror.fromTextArea(el, {
            theme: 'dracula',       // Use the Dracula theme
            lineNumbers: true,      // Show line numbers
            mode: 'javascript'      // Default mode set to JavaScript
        });
    });
});


/**
 * Listens for DOMContentLoaded event and handles form submission and unsaved changes prompts.
 */
document.addEventListener("DOMContentLoaded", function () {
    /**
     * Flag to track if a form has been submitted.
     * @type {boolean}
     */
    let formSubmitted = false;
  
    /**
     * Flag to bypass the unsaved changes prompt when a submit button is clicked.
     * @type {boolean}
     */
    let bypassPrompt = false;
  
    /**
     * Selects the form with the class or ID "save-changes".
     * If none is found, the script exits.
     * @type {HTMLFormElement|null}
     */
    const saveChangesForm = document.querySelector("form.save-changes, form#save-changes");
  
    if (saveChangesForm) {
      /**
       * Adds an event listener to the save-changes form for the submit event.
       * Sets the `formSubmitted` flag to true when the form is submitted.
       * @param {SubmitEvent} event The submit event object.
       */
      saveChangesForm.addEventListener("submit", function (event) {
        formSubmitted = true;
      });
  
      /**
       * Adds an event listener for the "beforeunload" event to prompt the user for unsaved changes.
       * The prompt is only shown if the form hasn't been submitted and the bypass prompt flag isn't set.
       * @param {BeforeUnloadEvent} event The beforeunload event object.
       */
      window.addEventListener("beforeunload", function (event) {
        if (!formSubmitted && !bypassPrompt) {
          const confirmationMessage = "You have unsaved changes. Are you sure you want to leave this page?";
          (event || window.event).returnValue = confirmationMessage; // For older browsers
          return confirmationMessage; // For modern browsers
        }
      });
    }
  
    /**
     * Handles submit button clicks. Bypasses the unsaved changes prompt and submits the associated form.
     * @param {NodeList} submitButtons A NodeList of elements with the class "submit-btn".
     */
    document.querySelectorAll(".submit-btn").forEach(function (button) {
      /**
       * Adds an event listener to each submit button for the click event.
       * @param {MouseEvent} event The click event object.
       */
      button.addEventListener("click", function (event) {
        const formId = button.getAttribute("data-submit-form");
        const formToSubmit = document.getElementById(formId);
        if (formToSubmit) {
          bypassPrompt = true; // Bypass the unsaved changes prompt
          formToSubmit.submit(); // Submit the form
        }
      });
    });
  });

/**
 * Get the screen resolution of the client device
 * 
 * @returns {string} The screen resolution in the format "width x height"
 */
function getScreenResolution() {
    return `${screen.width} x ${screen.height}`;
}

/**
 * Initialize Tempus Dominus for all elements with the class "tempus-datetime-picker"
 */
$(document).ready(function () {
    document.querySelectorAll('.tempus-datetime-picker').forEach(function (input) {
      new tempusDominus.TempusDominus(input, {
        display: {
          components: {
            decades: true,
            year: true,
            month: true,
            date: true,
            hours: true,
            minutes: true,
            seconds: false,
          },
          buttons: {
            today: true,
            clear: true,
            close: true,
          },
        },
        localization: {
          format: 'yyyy-MM-dd HH:mm:ss', // Customize the datetime format
        },
      });
    });
  });