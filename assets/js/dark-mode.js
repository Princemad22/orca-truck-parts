// Dark mode is intentionally disabled for this release; keep site in light mode only.
$(document).ready(function() {
    localStorage.setItem('theme', 'light');
    document.cookie = 'theme=light; path=/; max-age=31536000';

    $('body').removeClass('dark-mode').addClass('light-mode');

    const themeToggle = $('#themeToggle');
    themeToggle.addClass('disabled').css({ cursor: 'not-allowed', opacity: 0.5 });
    themeToggle.find('i').removeClass('fa-moon').addClass('fa-sun');

    themeToggle.on('click', function(e) {
        e.preventDefault();
    });
});
