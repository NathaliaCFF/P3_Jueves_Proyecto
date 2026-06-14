<div class="container">

<div class="card">

    <h1>Maestro de Cuentas</h1>

    <div class="form-grid">

        <div class="form-group">
            <label>Cuenta</label>
            <input type="text" id="cuenta">
        </div>

        <div class="form-group">
            <label>Nivel</label>
            <input type="text" id="nivel" readonly>
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <input type="text" id="descripcion">
        </div>

        <div class="form-group">
            <label>Origen</label>
            <select id="origen">
                <option value="D">Débito</option>
                <option value="C">Crédito</option>
            </select>
        </div>

        <div class="form-group">
            <label>Cuenta Auxiliar</label>
            <input type="text" id="auxiliar">
        </div>

    </div>

    <br>

    <div class="form-grid">

        <div class="check-group">
            <input type="checkbox" id="control">
            <label for="control">Control</label>
        </div>

        <div class="check-group">
            <input type="checkbox" id="conciliacion">
            <label for="conciliacion">Conciliación</label>
        </div>

        <div class="check-group">
            <input type="checkbox" id="estados">
            <label for="estados">Estados Financieros</label>
        </div>

        <div class="check-group">
            <input type="checkbox" id="impuestos">
            <label for="impuestos">Impuestos</label>
        </div>

    </div>

    <div class="saldos">

        <div class="form-group">
            <label>Balance Anterior</label>
            <input type="text" id="balAnt" readonly>
        </div>

        <div class="form-group">
            <label>Débito Mes</label>
            <input type="text" id="debMes" readonly>
        </div>

        <div class="form-group">
            <label>Crédito Mes</label>
            <input type="text" id="creMes" readonly>
        </div>

        <div class="form-group">
            <label>Balance Actual</label>
            <input type="text" id="balAct" readonly>
        </div>

    </div>

    <div class="botones">

        <button class="btn btn-primary" id="btnBuscarCuenta">
            Buscar
        </button>

        <button class="btn btn-success" id="guardarCuenta">
            Guardar
        </button>

        <button class="btn btn-danger" id="inactivarCuenta">
            Inactivar
        </button>

        <button class="btn btn-secondary" id="nuevoCuenta">
            Nuevo
        </button>

    </div>

</div>

</div>

<div id="modalBusqueda" class="modal">

<div class="modal-content">

    <div class="modal-header">

        <h2>Buscar Cuenta</h2>

        <span id="cerrarModal" class="close">
            &times;
        </span>

    </div>

    <input
        type="text"
        id="filtroCuenta"
        placeholder="Buscar cuenta o descripción..."
    >

    <table>

        <thead>
            <tr>
                <th>Cuenta</th>
                <th>Descripción</th>
            </tr>
        </thead>

        <tbody id="tablaCuentas">

        </tbody>

    </table>

</div>

</div>
