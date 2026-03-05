// Dark mode toggle functionality
$(document).ready(function() {
    const themeToggle = $('#themeToggle');
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    // Apply saved theme on page load
    applyTheme(currentTheme);
    
    // Toggle theme when button is clicked
    themeToggle.on('click', function(e) {
        e.preventDefault();
        
        const currentTheme = $('body').hasClass('dark-mode') ? 'light' : 'dark';
        applyTheme(currentTheme);
        
        // Save preference to local storage
        localStorage.setItem('theme', currentTheme);
        
        // Also save to cookie for server-side detection
        document.cookie = `theme=${currentTheme}; path=/; max-age=31536000`; // 1 year
        
        // Update icon
        updateThemeIcon(currentTheme);
    });
    
    // Apply theme to the page
    function applyTheme(theme) {
        if (theme === 'dark') {
            $('body').addClass('dark-mode');
        } else {
            $('body').removeClass('dark-mode');
        }
        
        updateThemeIcon(theme);
    }
    
    // Update theme toggle icon
    function updateThemeIcon(theme) {
        const icon = themeToggle.find('i');
        if (theme === 'dark') {
            icon.removeClass('fa-moon').addClass('fa-sun');
        } else {
            icon.removeClass('fa-sun').addClass('fa-moon');
        }
    }
});

// Alternative approach using pure JavaScript (without jQuery)
/*
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    // Apply saved theme on page load
    applyTheme(currentTheme);
    updateThemeIcon(currentTheme);
    
    // Toggle theme when button is clicked
    themeToggle.addEventListener('click', function(e) {
        e.preventDefault();
        
        const currentTheme = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
        applyTheme(currentTheme);
        
        // Save preference to local storage
        localStorage.setItem('theme', currentTheme);
        
        // Also save to cookie for server-side detection
        document.cookie = `theme=${currentTheme}; path=/; max-age=31536000`; // 1 year
        
        // Update icon
        updateThemeIcon(currentTheme);
    });
    
    // Apply theme to the page
    function applyTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    }
    
    // Update theme toggle icon
    function updateThemeIcon(theme) {
        const icon = themeToggle.querySelector('i');
        if (theme === 'dark') {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    }
});
*/