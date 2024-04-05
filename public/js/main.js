/**This function sets the currently viewed webpage that is indicatd on the navigtaion bar to the 
 * 'active' state. As such, the navigation bar for that particular tab will turn blue, showing
 * responsiveness and interaction.*/

activateMenuonDropdown();
activateMenuNormal();


// For dropdown menu navigation bar

function activateMenuonDropdown() {
    let currentPage = window.location.href;
    console.log()
    const navLinks = document.querySelectorAll('.dropdown-menu li a');
    navLinks.forEach(link => {
        if (link.href === currentPage) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    })
}

// For navigation bar on Window Size

function activateMenuNormal() {
    let currentPage = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        if (link.href === currentPage) {
            link.classList.add('active', 'button-primary');
        } else {
            link.classList.remove('active');
        }
    })
}

// This function let user copy the link of the Workout

function copyCurrentUrl() {
    // Use window.location.href to get the current URL
    navigator.clipboard.writeText(window.location.href)
        .then(() => {
            // Success message
            alert("URL copied to clipboard!");
        })
        .catch(err => {
            // Error handling
            console.error('Failed to copy: ', err);
        });
}