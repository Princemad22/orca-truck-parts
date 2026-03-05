// Admin Dashboard JavaScript

$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Handle form submissions with AJAX
    $('form[data-ajax]').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        var originalText = submitBtn.html();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
        
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(response) {
                // Handle success response
                showMessage('Success! Operation completed successfully.', 'success');
            },
            error: function(xhr, status, error) {
                // Handle error response
                showMessage('Error: ' + (xhr.responseJSON?.message || 'An error occurred. Please try again.'), 'error');
            },
            complete: function() {
                // Reset button state
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Function to show messages
    function showMessage(message, type) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                           message +
                           '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                       '</div>';
        
        // Insert message at the top of the page
        $('.container-fluid').prepend(alertHtml);
        
        // Auto dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    }

    // Confirm delete actions
    $('.confirm-delete').on('click', function(e) {
        var form = $(this).closest('form');
        var message = $(this).data('confirm-message') || 'Are you sure you want to delete this item?';
        
        if (confirm(message)) {
            form.submit();
        } else {
            e.preventDefault();
        }
    });

    // Handle bulk actions
    $('#selectAll').on('change', function() {
        $('.item-checkbox').prop('checked', this.checked);
    });

    $('.item-checkbox').on('change', function() {
        if (!this.checked) {
            $('#selectAll').prop('checked', false);
        }
    });

    // Handle image preview
    $('.image-upload').on('change', function() {
        var input = this;
        var reader = new FileReader();
        
        reader.onload = function(e) {
            $(input).siblings('.image-preview').attr('src', e.target.result);
        };
        
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert:not(.permanent)').fadeOut('slow');
    }, 5000);

    // Handle sidebar toggle on mobile
    $('#sidebarToggle').on('click', function() {
        $('#sidebar').toggleClass('collapsed');
        $('#mainPanel').toggleClass('expanded');
    });
});

// Utility functions
function confirmAction(message) {
    return confirm(message);
}

function showAlert(message, type = 'info') {
    const alertTypes = {
        'success': 'alert-success',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'info': 'alert-info'
    };
    
    const alertClass = alertTypes[type] || 'alert-info';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    
    $('.container-fluid').prepend(alertHtml);
}

// Format currency
function formatCurrency(amount, currency = 'USD') {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency
    }).format(amount);
}

// Debounce function to limit rate of function calls
function debounce(func, wait, immediate) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}