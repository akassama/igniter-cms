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
