document.addEventListener('DOMContentLoaded', function () {
    // Utility function for input validation with error handling
    function createInputValidator(selector, validationFn, errorMessage) {
        document.querySelectorAll(selector).forEach(function (element) {
            element.addEventListener('keyup', function () {
                const originalValue = this.value;
                const sanitizedValue = validationFn(this.value);
                this.value = sanitizedValue;

                // Error handling for data-show-err
                const showErr = this.getAttribute('data-show-err') === 'true';
                const errorSpan = this.nextElementSibling;

                if (showErr) {
                    // Remove existing error if sanitized value matches original
                    if (sanitizedValue === originalValue) {
                        if (errorSpan && errorSpan.classList.contains('text-danger')) {
                            errorSpan.remove();
                        }
                    } 
                    // Add error message if value was modified
                    else {
                        // Remove existing error span if present
                        if (errorSpan && errorSpan.classList.contains('text-danger')) {
                            errorSpan.remove();
                        }
                        
                        // Create and insert new error span
                        const span = document.createElement('span');
                        span.className = 'text-danger';
                        span.textContent = typeof errorMessage === 'function' 
                            ? errorMessage.call(this) 
                            : errorMessage || 'Invalid input';
                        this.after(span);
                    }
                }
            });
        });
    }

    // Integer positive only (allows only positive integers)
    createInputValidator('.integer-plus-only', function(value) {
        return value.replace(/[^0-9]/g, '');
    }, 'Only positive integers are allowed');

    // Integer only (allows integers including negative)
    createInputValidator('.integer-only', function(value) {
        return value.replace(/[^0-9-]/g, '');
    }, 'Only integers are allowed');

    // Integer range validation
    createInputValidator('.integer-range', function(value) {
        const element = document.activeElement;
        const min = parseInt(element.getAttribute('data-min')) || 1;
        const max = parseInt(element.getAttribute('data-max')) || 100;
        
        // Remove non-numeric characters
        const numericValue = value.replace(/[^0-9]/g, '');
        
        // If input is empty, return empty string
        if (numericValue === '') return '';
        
        const enteredValue = parseInt(numericValue, 10);
        
        // If not a valid number, return min value
        if (isNaN(enteredValue)) return min.toString();
        
        // Clamp the value between min and max
        return Math.min(Math.max(enteredValue, min), max).toString();
    }, function() {
        const min = parseInt(this.getAttribute('data-min')) || 1;
        const max = parseInt(this.getAttribute('data-max')) || 100;
        return `Value must be between ${min} and ${max}`;
    });

    // Float number validation
    createInputValidator('.float-number', function(value) {
        const sanitized = value.replace(/[^0-9.]/g, '');
        const parts = sanitized.split('.');
        return parts.length > 2 
            ? parts[0] + '.' + parts.slice(1).join('') 
            : sanitized;
    }, 'Only numbers with optional decimal are allowed');

    // Title text validation
    createInputValidator('.title-text', function(value) {
        return value.replace(/[^A-Za-z0-9.,-\s#?()!@$£&:"']/g, '');
    });

    // Letters only (no spaces)
    createInputValidator('.letters-only', function(value) {
        return value.replace(/[^A-Za-z]/g, '');
    }, 'Only letters are allowed');

    // Letters with space and dot
    createInputValidator('.letters-only-plus-space', function(value) {
        return value.replace(/[^A-Za-z. ]/g, '');
    }, 'Only letters, spaces, and dots are allowed');

    // Alphanumeric with space
    createInputValidator('.alphanumeric', function(value) {
        return value.replace(/[^A-Za-z0-9-_]/g, '');
    }, 'Only alphanumeric characters and dashes are allowed');

    // Alphanumeric with space
    createInputValidator('.alphanumeric-plus-space', function(value) {
        return value.replace(/[^A-Za-z0-9 ]/g, '');
    }, 'Only alphanumeric characters and spaces are allowed');

    // Phone number validation
    createInputValidator('.phone-number', function(value) {
        const sanitized = value.replace(/[^0-9\s()+]/g, '');
        return sanitized.indexOf('+') > 0 
            ? sanitized.replace('+', '') 
            : sanitized;
    }, 'Invalid phone number format');

    // Currency validation
    createInputValidator('.currency', function(value) {
        return value.replace(/[^0-9.]|[.](?=.*[.])/g, '');
    }, 'Invalid currency format');

    // Date validation (GB format)
    createInputValidator('.date', function(value) {
        const sanitized = value.replace(/[^0-9/]/g, '');
        const parts = sanitized.split('/');
        const formattedValue = parts.length > 2 
            ? parts[0] + '/' + parts[1].substring(0, 2) + '/' + parts.slice(2).join('')
            : sanitized;
        return formattedValue.substring(0, 10);
    }, 'Invalid date format');

    // Year validation
    let yearTimeout;
    document.querySelectorAll('.year').forEach(function (element) {
        element.addEventListener('keyup', function () {
            const sanitized = this.value.replace(/[^0-9]/g, '').substring(0, 4);
            this.value = sanitized;

            clearTimeout(yearTimeout);
            if (sanitized.length === 4) {
                yearTimeout = setTimeout(() => {
                    const currentYear = new Date().getFullYear();
                    const yearValue = parseInt(sanitized);
                    
                    this.value = yearValue < 1400 
                        ? '1400' 
                        : Math.min(yearValue, currentYear).toString();
                }, 500);
            }
        });
    });

    // Regex filter validation
    document.querySelectorAll('.regex-filter').forEach(function (element) {
        element.addEventListener('input', function () {
            const regexPattern = this.getAttribute('data-regex');
            const regexObject = new RegExp(regexPattern);
            
            if (!regexObject.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });
    });
	
    // Email validation
    createInputValidator('.email', function(value) {
        return value.replace(/[^A-Za-z0-9@._-]/g, '');
    }, 'Invalid email format');

    // Credit card validation (basic formatting)
    document.querySelectorAll('.credit-card').forEach(function (element) {
        element.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, '');
            value = value.substring(0, 16);
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            this.value = value;
        });
    });

    // Password strength validation
    document.querySelectorAll('.password-strength').forEach(function (element) {
        element.addEventListener('input', function () {
            const value = this.value;
            const strengthIndicator = this.nextElementSibling;
            
            let strength = 0;
            if (value.length >= 8) strength++;
            if (value.match(/[A-Z]/)) strength++;
            if (value.match(/[a-z]/)) strength++;
            if (value.match(/[0-9]/)) strength++;
            if (value.match(/[^A-Za-z0-9]/)) strength++;

            if (strengthIndicator && strengthIndicator.classList.contains('password-strength-meter')) {
                strengthIndicator.innerHTML = `Strength: ${
                    strength <= 2 ? 'Weak' : 
                    strength <= 4 ? 'Medium' : 'Strong'
                }`;
            }
        });
    });

    // Social Security Number validation
    createInputValidator('.ssn', function(value) {
        const sanitized = value.replace(/\D/g, '');
        
        if (sanitized.length > 5) {
            return sanitized.substring(0, 3) + 
                   '-' + sanitized.substring(3, 5) + 
                   '-' + sanitized.substring(5, 9);
        }
        return sanitized;
    }, 'Invalid SSN format');

    // Yes/No validation
    createInputValidator('.yes-no', function(value) {
        const lowerValue = value.toLowerCase();
        if (lowerValue === 'yes' || lowerValue === 'no') {
            return value; // Return the original value if valid
        }
        return ''; // Clear the input if invalid
    }, 'Only "Yes" or "No" is allowed');

    // true/false validation
    createInputValidator('.true-false', function(value) {
        const lowerValue = value.toLowerCase();
        if (lowerValue === 'true' || lowerValue === 'false') {
            return value; // Return the original value if valid
        }
        return ''; // Clear the input if invalid
    }, 'Only "true" or "false" is allowed');
    
});