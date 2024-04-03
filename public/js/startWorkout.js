document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.start-btn').forEach(function(button){
      button.addEventListener('click', function(){
          // Find the `.exercise-inputs` in the same `.exercise` container and toggle visibility
          var inputs = this.closest('.exercise').querySelectorAll('.exercise-inputs .set');
          inputs.forEach(function(input){
              input.style.display = input.style.display === 'none' ? '' : 'none';
          });

          // Toggle the visibility of the `.info` element
          var info = this.closest('.exercise-container').previousElementSibling;
          info.style.display = info.style.display === 'none' ? '' : 'none';
      });
  });
});