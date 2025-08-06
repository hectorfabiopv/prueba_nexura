document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("empleadoForm");
    if (!form) return;

    // ========================
    // Funciones de validación
    // ========================

    function validateNombre() {
        const input = form.querySelector('#nombre');
        const value = input.value.trim();
        toggleInvalid(input, value.length < 3);
    }

    function validateEmail() {
        const input = form.querySelector('#email');
        const regex = /^[\w.%+\-]+@[\w.\-]+\.[A-Za-z]{2,}$/;
        toggleInvalid(input, !regex.test(input.value.trim()));
    }

    function validateSexo() {
        const radios = form.querySelectorAll('input[name="sexo"]');
        const error = document.getElementById('sexoError');
        const checked = [...radios].some(r => r.checked);
        error.style.display = checked ? 'none' : 'block';
        return checked;
    }

    function validateArea() {
        const select = form.querySelector('#area_id');
        toggleInvalid(select, !select.value);
    }

    function validateDescripcion() {
        const textarea = form.querySelector('#descripcion');
        toggleInvalid(textarea, textarea.value.trim().length < 10);
    }

    function validateRoles() {
        const wrapper = form.querySelector('.roles-wrapper');
        const checked = wrapper.querySelectorAll('input[name="roles[]"]:checked').length > 0;
        const feedback = wrapper.querySelector('.invalid-feedback');
        feedback.style.display = checked ? 'none' : 'block';
        return checked;
    }

    function toggleInvalid(element, hasError) {
        if (hasError) {
            element.classList.add('is-invalid');
        } else {
            element.classList.remove('is-invalid');
        }
    }

    // ========================
    // Eventos por campo
    // ========================

    form.querySelector('#nombre')?.addEventListener('blur', validateNombre);
    form.querySelector('#email')?.addEventListener('blur', validateEmail);
    form.querySelectorAll('input[name="sexo"]').forEach(r => r.addEventListener('change', validateSexo));
    form.querySelector('#area_id')?.addEventListener('change', validateArea);
    form.querySelector('#descripcion')?.addEventListener('blur', validateDescripcion);
    form.querySelectorAll('input[name="roles[]"]').forEach(c => c.addEventListener('change', validateRoles));

    // ========================
    // Validación al enviar
    // ========================

    form.addEventListener("submit", function (e) {
        // Ejecuta todas las validaciones
        validateNombre();
        validateEmail();
        const validSexo = validateSexo();
        validateArea();
        validateDescripcion();
        const validRoles = validateRoles();

        // Si algún campo tiene is-invalid o feedback visible, cancela
        const errors = form.querySelectorAll('.is-invalid').length > 0 || !validSexo || !validRoles;

        if (errors) {
            e.preventDefault();
        }
    });
});