// Main JavaScript file for ORCA Truck Parts website

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

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 70
            }, 1000);
        }
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
                showMessage('Success! Your message has been sent.', 'success');
                form[0].reset();
            },
            error: function(xhr, status, error) {
                // Handle error response
                showMessage('Error: ' + xhr.responseJSON?.message || 'An error occurred. Please try again.', 'error');
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
        $('main').prepend(alertHtml);
        
        // Auto dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    }

    // Handle language switching via dropdown
    $('#languageSwitch').on('change', function() {
        var selectedLang = $(this).val();
        window.location.href = '?lang=' + selectedLang;
    });

    // Handle search functionality
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#searchInput').val().trim();
        if (searchTerm) {
            window.location.href = 'search.php?q=' + encodeURIComponent(searchTerm);
        }
    });

    // Handle product filtering
    $('.filter-option').on('click', function(e) {
        e.preventDefault();
        var filterValue = $(this).data('filter');
        
        // Update active state
        $('.filter-option').removeClass('active');
        $(this).addClass('active');
        
        // Filter products (implement based on your needs)
        filterProducts(filterValue);
    });

    // Function to filter products
    function filterProducts(categoryId) {
        // This would typically make an AJAX call to fetch filtered products
        console.log('Filtering by category ID:', categoryId);
        
        // Example implementation:
        // $.get('api/products.php?category=' + categoryId, function(data) {
        //     $('#productsContainer').html(data);
        // });
    }

    // Handle image lazy loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Handle back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    $('.back-to-top').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });

    // Add back to top button to page
    $('body').append('<a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>');
});

// Utility functions
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

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