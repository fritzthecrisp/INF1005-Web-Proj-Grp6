document.addEventListener('DOMContentLoaded', () => {
    const startButtons = document.querySelectorAll('.start-btn');
  
    startButtons.forEach(button => {
      button.addEventListener('click', function() {
        const exerciseDiv = this.parentElement.parentElement;
        const sets = exerciseDiv.dataset.sets;
        const inputsContainer = exerciseDiv.querySelector('.exercise-inputs');
        inputsContainer.innerHTML = ''; // Clear previous inputs if any
        inputsContainer.style.display = 'block'; // Show the inputs
  
        for (let i = 0; i < sets; i++) {
          inputsContainer.innerHTML += `
            <div class="set">
              <span>Set ${i + 1}: </span>
              <input type="number" placeholder="Reps" class="reps-input">
              <input type="number" placeholder="Weight" class="weight-input">
            </div>
          `;
        }
      });
    });
  });
  