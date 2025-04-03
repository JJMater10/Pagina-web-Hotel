document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.querySelector(".form-register");

    if (!formulario) return; // Evita errores si el formulario no se encuentra

    formulario.addEventListener("submit", function (event) {
        let valido = true;
        const inputs = formulario.querySelectorAll("input, select");

        inputs.forEach(input => {
            let errorMensaje = input.nextElementSibling;

            // Si el siguiente elemento no es un mensaje de error, crearlo
            if (!errorMensaje || !errorMensaje.classList.contains("mensaje-error")) {
                errorMensaje = document.createElement("p");
                errorMensaje.classList.add("mensaje-error");
                input.parentNode.insertBefore(errorMensaje, input.nextSibling);
            }

            // Validar si el campo está vacío
            if (input.hasAttribute("required") && input.value.trim() === "") {
                input.classList.add("input-error");
                errorMensaje.textContent = "Este campo es obligatorio.";
                errorMensaje.style.display = "block";
                valido = false;
            } else {
                input.classList.remove("input-error");
                errorMensaje.textContent = "";
                errorMensaje.style.display = "none";
            }
        });

        if (!valido) {
            event.preventDefault(); // Detener el envío si hay errores
        }
    });
});
