document.getElementById("register-button").addEventListener("click", function(event) {
    const pass1 = document.getElementById('password').value;
    const pass2 = document.getElementById('confirm_password').value;
    const error = document.getElementById("error-mensaje");
    const form = document.getElementById("register-form");
    const error_servidor = document.getElementById("error-servidor");

    if(error) {
        error.remove();
    }
    if(error_servidor) {
        error_servidor.remove();
    }
    if (pass1 !== pass2) {
        event.preventDefault();
        const mensajeError = document.createElement("p");
        mensajeError.id = "error-mensaje";
        mensajeError.className = "error-message";
        mensajeError.textContent = "Marinero, las contraseñas no coinciden!";;
        const btnRegistrar = document.getElementById("register-button");
        btnRegistrar.parentNode.insertBefore(mensajeError, btnRegistrar);
        
    }
})