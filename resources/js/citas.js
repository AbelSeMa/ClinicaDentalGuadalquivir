document.addEventListener('DOMContentLoaded', function () {
    const btnsAtender = document.querySelectorAll('.btn-atender');
    const nombreInput = document.getElementById('name');
    const dniInput = document.getElementById('dni');

    btnsAtender.forEach(btn => {
        btn.addEventListener('click', function () {
            const citaId = this.getAttribute('data-cita-id');
            document.getElementById('cita-id').value = citaId;

            fetch(`datos-paciente/${citaId}`)
                .then(response => response.json())
                .then(data => {
                    nombreInput.value = data.paciente.usuario.first_name + ' ' + data
                        .paciente.usuario.last_name;
                    dniInput.value = data.paciente.usuario.dni
                })
                .catch(error => console.error(
                    'Error al obtener detalles del paciente:', error));
        });
    });
});

