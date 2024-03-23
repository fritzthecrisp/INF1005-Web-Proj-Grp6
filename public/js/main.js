document.addEventListener("DOMContentLoaded", function () {
    activateMenu();
});

window.addEventListener('popstate', activateMenu);

/*
* This function sets the currently selected menu item to the 'active' state.
* It should be called whenever the page first loads.
*/
function activateMenu() {
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        if (link.href === location.href) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    })
}