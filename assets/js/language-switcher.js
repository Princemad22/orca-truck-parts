// Language switcher functionality
$(document).ready(function() {
    // Handle language switcher dropdown
    $('.language-switcher select').on('change', function() {
        var selectedLang = $(this).val();
        window.location.href = '?lang=' + selectedLang;
    });
    
    // Handle language switcher links
    $('.language-switcher a').on('click', function(e) {
        e.preventDefault();
        var selectedLang = $(this).data('lang');
        window.location.href = '?lang=' + selectedLang;
    });
    
    // Auto-detect browser language if no preference is set
    function detectBrowserLanguage() {
        var userLang = navigator.language || navigator.userLanguage;
        var langCode = userLang.split('-')[0]; // Get base language code
        
        // Only handle supported languages
        if (langCode === 'ar' || langCode === 'en') {
            // Check if language is already set in URL or cookies
            var params = new URLSearchParams(window.location.search);
            var urlLang = params.get('lang');
            var cookieLang = getCookie('language');
            
            if (!urlLang && !cookieLang) {
                // Ask user if they want to switch to detected language
                if (langCode !== 'en') { // Assuming English is default
                    var switchConfirm = confirm('Would you like to switch to ' + 
                        (langCode === 'ar' ? 'العربية' : 'English') + '?');
                    if (switchConfirm) {
                        window.location.href = '?lang=' + langCode;
                    }
                }
            }
        }
    }
    
    // Helper function to get cookie value
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    
    // Run browser language detection
    // Commenting out for now to avoid annoying prompts
    // detectBrowserLanguage();
});

// Alternative approach using pure JavaScript
/*
document.addEventListener('DOMContentLoaded', function() {
    // Handle language switcher dropdown
    const languageSelector = document.querySelector('.language-switcher select');
    if (languageSelector) {
        languageSelector.addEventListener('change', function() {
            const selectedLang = this.value;
            window.location.href = '?lang=' + selectedLang;
        });
    }
    
    // Handle language switcher links
    const languageLinks = document.querySelectorAll('.language-switcher a');
    languageLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedLang = this.getAttribute('data-lang');
            window.location.href = '?lang=' + selectedLang;
        });
    });
    
    // Helper function to get cookie value
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i=0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
});
*/