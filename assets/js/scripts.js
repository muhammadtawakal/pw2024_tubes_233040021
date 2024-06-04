$(document).ready(function() {
    $('#darkModeToggle').click(function() {
        $('body').toggleClass('dark-mode');
        $('.navbar').toggleClass('dark-mode');
        $('.footer').toggleClass('dark-mode');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.body.classList.add('dark-mode');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            document.body.classList.remove('dark-mode');
        }    
    }

    toggleSwitch.addEventListener('change', switchTheme, false);

    // Check local storage for theme preference
    if(localStorage.getItem('theme') === 'dark') {
        toggleSwitch.checked = true;
        document.documentElement.setAttribute('data-theme', 'dark');
        document.body.classList.add('dark-mode');
    } else {
        toggleSwitch.checked = false;
        document.documentElement.setAttribute('data-theme', 'light');
        document.body.classList.remove('dark-mode');
    }

    toggleSwitch.addEventListener('change', function() {
        if (toggleSwitch.checked) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        } 
    });
});
