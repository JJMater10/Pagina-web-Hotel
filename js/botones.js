$('#enviar_boton').click(function(event) {
    event.preventDefault(); // Evita que el formulario se envíe si está dentro de uno
    Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success"
    });
});
