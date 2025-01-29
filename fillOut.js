document.addEventListener('DOMContentLoaded', function() {
   
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('focus', () => input.parentNode.style.border = "2px solid blue");
        input.addEventListener('blur', () => input.parentNode.style.border = "1px solid black");
    });

    
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('input[type="radio"]').forEach(r => r.parentNode.style.backgroundColor = "");
            radio.parentNode.style.backgroundColor = "lightblue";
        });
    });

    
    const submitButton = document.querySelector('input[type="submit"]');
    submitButton.classList.add('submit-button');
    submitButton.addEventListener('click', () => {
        submitButton.style.backgroundColor = "lightgreen";
        submitButton.style.color = "white";
        setTimeout(() => { 
            submitButton.style.backgroundColor = "";
            submitButton.style.color = "";
        }, 5000);
    });
});
