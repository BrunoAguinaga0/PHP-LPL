document.getElementById("register-button").addEventListener("click", function(event) {
    const pass1 = document.getElementById('password').value;
    const pass2 = document.getElementById('confirm_password').value;
    const error = document.getElementById("error-mensaje");
    const form = document.getElementById("register-form");
    if(error) {
        form.style.height = '68vh';
        error.remove();
    }
    if (pass1 !== pass2) {
        event.preventDefault();
        const mensajeError = document.createElement("p");
        mensajeError.id = "error-mensaje";
        mensajeError.textContent = "Marinero, las contraseñas no coinciden!";;
        mensajeError.style.color = 'red';
        mensajeError.style.fontSize = '0.9rem';
        mensajeError.style.marginTop = '10px';
        mensajeError.style.textAlign = 'center';
        form.style.height = '71vh';
        const btnRegistrar = document.getElementById("register-button");
        btnRegistrar.parentNode.insertBefore(mensajeError, btnRegistrar);
        
    }
})