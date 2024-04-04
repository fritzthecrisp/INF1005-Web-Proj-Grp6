// window.addEventListener("onload", function () {
    activateMenuonDropdown();
    activateMenuNormal();
// });

console.log("Imported")

/*
* This function sets the currently selected menu item to the 'active' state.
* It should be called whenever the page first loads.
*/
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

function activateMenuNormal() {
    let currentPage = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        if (link.href === currentPage) {
            link.classList.add('active','button-primary');
        } else {
            link.classList.remove('active');
        }
    })
}

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

