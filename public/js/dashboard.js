document.addEventListener('DOMContentLoaded', function(){

```
const sidebar = document.getElementById('sidebar');
const btncollapse = document.getElementById('sidebarCollapse');
const contenedor = document.getElementById('contenedor-principal');

btncollapse.addEventListener('click', () => {
    sidebar.classList.toggle('active');
});

window.cargarContenido = function(archivo){

    contenedor.innerHTML =
        '<div class="loader">Cargando módulo...</div>';

    fetch(archivo)

    .then(res => {

        if(!res.ok){
            throw new Error('Archivo no encontrado');
        }

        return res.text();

    })

    .then(html => {

        contenedor.innerHTML = html;

        switch(archivo){

            case 'masterAccount.php':

                if (!window.masterAccountLoaded) {

                    const script = document.createElement('script');

                    script.src = '../public/js/masterAccount.js';

                    script.onload = () => {

                        window.masterAccountLoaded = true;

                        if (typeof initmasterAccount === 'function') {
                            initmasterAccount();
                        }

                    };

                    document.body.appendChild(script);

                } else {

                    if (typeof initmasterAccount === 'function') {
                        initmasterAccount();
                    }

                }

                break;

            case 'moveAccount.php':

                if (!window.moveAccountLoaded) {

                    const script = document.createElement('script');

                    script.src = '../public/js/moveAccount.js';

                    script.onload = () => {

                        window.moveAccountLoaded = true;

                        if (typeof initmoveAccount === 'function') {
                            initmoveAccount();
                        }

                    };

                    document.body.appendChild(script);

                } else {

                    if (typeof initmoveAccount === 'function') {
                        initmoveAccount();
                    }

                }

                break;
        }

        if(window.innerWidth <= 768){
            sidebar.classList.remove('active');
        }

    })

    .catch(err => {

        contenedor.innerHTML = `
            <div class="card" style="border-left:5px solid red;">
                <h3>Error</h3>
                <p>No se pudo cargar el módulo:</p>
                <p>${archivo}</p>
                <p style="color:red">${err.message}</p>
            </div>
        `;

        console.error(err);

    });

};
```

});
