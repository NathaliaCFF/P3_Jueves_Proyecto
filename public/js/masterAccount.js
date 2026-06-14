function initmasterAccount() {

```
const cuenta = document.getElementById('cuenta');
const descripcion = document.getElementById('descripcion');
const nivel = document.getElementById('nivel');
const origen = document.getElementById('origen');
const auxiliar = document.getElementById('auxiliar');

const control = document.getElementById('control');
const conciliacion = document.getElementById('conciliacion');
const estados = document.getElementById('estados');
const impuestos = document.getElementById('impuestos');

const balAnt = document.getElementById('balAnt');
const debMes = document.getElementById('debMes');
const creMes = document.getElementById('creMes');
const balAct = document.getElementById('balAct');

const modalBusqueda = document.getElementById('modalBusqueda');
const tablaCuentas = document.getElementById('tablaCuentas');
const filtroCuenta = document.getElementById('filtroCuenta');

if (!cuenta) {
    console.error('No se encontró el formulario Master Account');
    return;
}

function calcularNivel(cta) {
    return cta.length <= 1
        ? cta.length
        : 1 + Math.ceil(cta.length / 2);
}

function limpiarFormulario() {

    cuenta.value = '';
    descripcion.value = '';
    nivel.value = '';
    auxiliar.value = '';

    origen.value = 'D';

    control.checked = false;
    conciliacion.checked = false;
    estados.checked = false;
    impuestos.checked = false;

    balAnt.value = '';
    debMes.value = '';
    creMes.value = '';
    balAct.value = '';

    cuenta.focus();
}

function cargarLista(q = '') {

    fetch('../controller/masterAccountController.php?action=listar&q=' + encodeURIComponent(q))
        .then(response => response.json())
        .then(data => {

            tablaCuentas.innerHTML = '';

            data.forEach(c => {

                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${c.CUENTA}</td>
                    <td>${c.DESCRIPCION}</td>
                `;

                tr.addEventListener('click', () => {

                    cuenta.value = c.CUENTA;

                    modalBusqueda.style.display = 'none';

                    buscarCuenta(c.CUENTA);

                });

                tablaCuentas.appendChild(tr);

            });

        })
        .catch(error => {

            console.error(error);
            alert('Error cargando cuentas');

        });
}

function buscarCuenta(id) {

    if (!id) return;

    nivel.value = calcularNivel(id);

    fetch('../controller/masterAccountController.php?action=buscar&id=' + id)

        .then(response => response.json())

        .then(res => {

            if (!res.success) {
                return;
            }

            const d = res.datos;

            descripcion.value = d.DESCRIPCION || '';
            origen.value = d.ORIGEN || 'D';
            auxiliar.value = d.AUXILIAR || '';

            control.checked = d.CONTROL === 'S';
            conciliacion.checked = Number(d.CONCILIACION) === 1;
            estados.checked = Number(d.ESTADO) === 1;
            impuestos.checked = Number(d.IMPUESTO) === 1;

            balAnt.value = d.BALANCEANTERIOR || 0;
            debMes.value = d.DEBITO || 0;
            creMes.value = d.CREDITO || 0;
            balAct.value = d.BALANCEACTUAL || 0;

        })

        .catch(error => {

            console.error(error);

        });
}

document.getElementById('btnBuscarCuenta').onclick = function () {

    modalBusqueda.style.display = 'flex';

    cargarLista('');

};

document.getElementById('cerrarModal').onclick = function () {

    modalBusqueda.style.display = 'none';

};

filtroCuenta.onkeyup = function () {

    cargarLista(filtroCuenta.value);

};

document.getElementById('nuevoCuenta').onclick = limpiarFormulario;

document.getElementById('guardarCuenta').onclick = function () {

    if (!cuenta.value.trim()) {
        alert('Debe indicar una cuenta');
        return;
    }

    if (!descripcion.value.trim()) {
        alert('Debe indicar una descripción');
        return;
    }

    const datos = {

        Cuenta: cuenta.value,
        Descripcion: descripcion.value,
        Origen: origen.value,
        Auxiliar: auxiliar.value,
        Nivel: nivel.value,

        Control: control.checked ? 'S' : 'N',
        Conciliacion: conciliacion.checked ? 1 : 0,
        Estado: estados.checked ? 1 : 0,
        Impuesto: impuestos.checked ? 1 : 0

    };

    fetch('../controller/masterAccountController.php?action=guardar', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify(datos)

    })

    .then(response => response.json())

    .then(res => {

        alert(res.message);

    })

    .catch(error => {

        console.error(error);
        alert('Error al guardar');

    });

};

document.getElementById('inactivarCuenta').onclick = function () {

    if (!cuenta.value.trim()) {
        alert('Seleccione una cuenta');
        return;
    }

    if (!confirm('¿Desea inactivar esta cuenta?')) {
        return;
    }

    fetch('../controller/masterAccountController.php?action=inactivar', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({
            cuenta: cuenta.value
        })

    })

    .then(response => response.json())

    .then(res => {

        alert(res.message);

        if (res.success) {

            limpiarFormulario();

        }

    });

};

console.log('Master Account inicializado');
```

}
