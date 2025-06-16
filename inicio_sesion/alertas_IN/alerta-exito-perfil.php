<?php if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Los datos se han actualizado correctamente",
        showConfirmButton: false,
        timer: 1500
    });
</script>
<?php endif; ?>
