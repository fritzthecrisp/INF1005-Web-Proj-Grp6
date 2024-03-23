document.addEventListener("DOMContentLoaded", function () {
    initializeCardNavigation('workout');
    initializeCardNavigation('exercise');
    registerEventListeners('workout');
    registerEventListeners('exercise');
});

function initializeCardNavigation(cardClass) {
    // Select all card elements with the specified class
    const cards = document.querySelectorAll('.' + cardClass);
    let startIndex = 0;

    // Show initial set of cards
    showCards(startIndex);

    // Add event listener to Next button
    document.querySelector('#' + cardClass + '-container .btn-next').addEventListener('click', showNextCards);

    function showCards(startIndex) {
        // Hide all cards with the specified class
        cards.forEach((card) => {
            card.style.display = 'none';
        });

        // Show the next two cards based on the startIndex
        for (let i = startIndex; i < startIndex + 2 && i < cards.length; i++) {
            cards[i].style.display = 'block';
        }
    }

    function showNextCards() {
        // Increment startIndex by 2
        startIndex += 2;

        // If startIndex exceeds the total number of cards, reset it to 0
        if (startIndex >= cards.length) {
            startIndex = 0;
        }

        // Show the next set of cards
        showCards(startIndex);
    }
}

// function registerEventListeners(cardClass) {
//     var cards = document.querySelectorAll('.' + cardClass);
//     if (cardClass == 'exercise') {
//         for (var i = 0; i < cards.length; i++) {
//             cards[i].addEventListener('click', function () {
//                 // Navigate to another page
//                 window.location.href = '<?= site_url("register") ?>';
//             });
//         }
//     } else if (cardClass == 'workout') {
//         for (var i = 0; i < cards.length; i++) {
//             cards[i].addEventListener('click', function () {
//                 // Navigate to another page
//                 window.location.href = '/workoutInfo.php';
//             });
//         }
//     }
// }
