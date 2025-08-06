document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("empleadoForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        // Limpiar errores anteriores
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        let isValid = true;

        // Validar nombre
        const nombre = form.querySelector('#nombre');
        if (!nombre.value.trim() || nombre.value.length < 3) {
            nombre.classList.add('is-invalid');
            isValid = false;
        }

        // Validar email
        const email = form.querySelector('#email');
        const emailRegex = /^[\w.%+\-]+@[\w.\-]+\.[A-Za-z]{2,}$/;
        if (!emailRegex.test(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        }

        // Validar sexo
        const sexo = form.querySelector('#sexo');
        if (!sexo.value) {
            sexo.classList.add('is-invalid');
            isValid = false;
        }

        // Validar área
        const area = form.querySelector('#area_id');
        if (!area.value) {
            area.classList.add('is-invalid');
            isValid = false;
        }

        // Validar descripción
        const descripcion = form.querySelector('#descripcion');
        if (!descripcion.value.trim() || descripcion.value.length < 10) {
            descripcion.classList.add('is-invalid');
            isValid = false;
        }

        // Validar roles
        const rolesWrapper = form.querySelector('.roles-wrapper');
        const roles = rolesWrapper.querySelectorAll('input[name="roles[]"]:checked');
        const roleWarning = rolesWrapper.querySelector('.invalid-feedback');
            
        if (roles.length === 0) {
            roleWarning.style.display = 'block';
            isValid = false;
        } else {
            roleWarning.style.display = 'none';
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});