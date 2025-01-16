const patterns = {
    nombre: /^[A-Z][a-zA-ZáéíóúÁÉÍÓÚÑñ]+$/i, 
    apellidos: /^[A-Z][a-záéíóúÁÉÍÓÚÑñ]+$/i,
    dni: /^[A-Z0-9]{1,8}[A-Z]$/i,
    fechaNacimiento: /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/,
    codigoPostal: /^\d{5}$/,
    email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
    telFijo: /^\d{9}$/,
    telMovil: /^(\+34|34)?\d{9}$/,
    iban: /^[A-Z]{2}\d{2}[A-Z0-9]{4,24}$/,
    tarjetaCredito: /^(?:\d{4}[- ]?){3}\d{4}$/,
    password: /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{12,}$/,
    confirmarPassword: /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[\W_]).{12,}$/
};


document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form');
  

   
    // Función para recuperar los datos guardados
/*    function recuperarDatos() {
        const datos = JSON.parse(localStorage.getItem('formularioDatos'));
        if (datos) {
            form.querySelectorAll('input').forEach(input => {
                input.value = datos[input.placeholder] || '';
            });
            alert('Datos recuperados correctamente');
        } else {
            alert('No hay datos guardados');
        }
    }*/

    // Eventos para los botones
    document.getElementById('cargarJson').addEventListener('click', obtenerDatosJson);
    document.getElementById('pubPhp').addEventListener('click', publicarPhp);
    document.getElementById('cargarPhp').addEventListener('click', obtenerDatosPhp);
    document.getElementById('pubBbdd').addEventListener('click', publicarBbdd);

    

    // Validación de campos en tiempo real
    form.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('invalid');
                this.classList.add('valid');
            } else {
                this.classList.remove('valid');
                this.classList.add('invalid');
            }
        });
    });
});

function validate(field, regex){

    if(regex.test(field.value)){
        field.className = 'valid';
    } else {
        field.className = 'invalid';
    }

}

// Función para rellenar el formulario con los datos
function rellenarFormulario(data) {
    const inputs = document.querySelectorAll('input'); // Seleccionar todos los inputs
    inputs.forEach(input => {
      const fieldName = input.name; // Nombre del campo en el formulario
      if (data[fieldName]) {
        input.value = data[fieldName]; // Asignar el valor correspondiente
      }
    });
  }

const campos = [
    'nombre', 'apellidos', 'dni', 'fechaNacimiento',
    'codigoPostal', 'email', 'telefonoFijo', 'telefonoMovil',
    'iban', 'tarjetaCredito', 'password', 'repeatPassword'
];



function obtenerDatosJson(){
    fetch ('usuario.json')              // Se usa fetch para realizar solicitudes HTTP ya que es más simple que usar XML
        .then(res => res.json())
        .then(data => {
            const fields = {
                nombre: document.getElementById('nombre').value = data.nombre,
                apellidos: document.getElementById('apellido').value = data.apellidos,
                dni: document.getElementById('dni').value = data.dni,
                fechaNacimiento: document.getElementById('nacimiento').value = data.fecha,
                codigoPostal: document.getElementById('cp').value = data.cp,
                email: document.getElementById('email').value = data.correo,
                telFijo: document.getElementById('fijo').value = data.fijo,
                telMovil: document.getElementById('movil').value = data.movil,
                iban: document.getElementById('iban').value = data.iban,
                tarjetaCredito: document.getElementById('tarjeta').value = data.tarjeta,
                password: document.getElementById('passwd').value = data.contrasena,
                confirmarPassword: document.getElementById('confirmar').value = data.contrasena,
            };

            // Asignar valores dinámicamente y validar
            for (const key in fields) {
                if (fields.hasOwnProperty(key) && patterns.hasOwnProperty(key)) {
                    fields[key].value = data[key] || ''; // Asignar valor desde JSON o vacío si no existe
                    validate(fields[key], patterns[key]); // Validar campo con su expresión regular
                }
            }
        })
        .catch(error => {
            console.error('error: ', error);
        })
}

// Función para publicar los datos (POST)
function publicarPhp() {
    const formData = new FormData(document.querySelector('.form'));

    // Convertir FormData en un objeto JSON
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    fetch('http://zonzamas.lan/publicar_php.php', {
        method: 'POST',
        body: formData // Enviar los datos como FormData
    })
        .then(res => res.json())
        .then(data => {
            console.log('Respuesta servidor: ', data);

            if (data.message === "Datos guardados correctamente") {
                // Limpiar y ocultar el formulario
                const formElement = document.querySelector('.form');
                formElement.querySelectorAll('input').forEach(input => input.value = '');
                formElement.style.display = 'none'; 

                // Esperar 2 segundos antes de recargar los datos
                setTimeout(() => {

                    // Solicitar datos al servidor
                    fetch('http://zonzamas.lan/get_php.php', {
                        method: 'GET',
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.message === "Datos recuperados correctamente") {
                                const userData = data.data;

                                // Poblar el formulario con los datos recibidos
                                document.getElementById('nombre').value = userData.nombre || '';
                                document.getElementById('apellido').value = userData.apellido || '';
                                document.getElementById('dni').value = userData.dni || '';
                                document.getElementById('nacimiento').value = userData.fechaNacimiento || '';
                                document.getElementById('cp').value = userData.codigoPostal || '';
                                document.getElementById('email').value = userData.email || '';
                                document.getElementById('fijo').value = userData.telefonoFijo || '';
                                document.getElementById('movil').value = userData.telefonoMovil || '';
                                document.getElementById('iban').value = userData.iban || '';
                                document.getElementById('tarjeta').value = userData.tarjetaCredito || '';
                                document.getElementById('passwd').value = userData.password || '';
                                document.getElementById('confirmar').value = userData.password || '';
                            } else {
                                console.error('No se encontraron datos guardados');
                            }
                        })
                        .catch(error => console.error('Error al cargar datos: ', error));
                }, 2000); // Esperar 2 segundos
            }
        })
        .catch(error => {
            console.error('Error: ', error);
        });
}


// Función para obtener los datos guardados (GET)
function obtenerDatosPhp() {
    fetch('http://zonzamas.lan/get_php.php', {
        method: 'GET',
    })
        .then(res => res.json())
        .then(data => {
            if (data.message === "Datos recuperados correctamente") {
                // Poblar el formulario con los datos recibidos
                const userData = data.data;
                document.getElementById('nombre').value = userData.nombre || '';
                document.getElementById('apellido').value = userData.apellido || '';
                document.getElementById('dni').value = userData.dni || '';
                document.getElementById('nacimiento').value = userData.fechaNacimiento || '';
                document.getElementById('cp').value = userData.codigoPostal || '';
                document.getElementById('email').value = userData.email || '';
                document.getElementById('fijo').value = userData.telFijo || '';
                document.getElementById('movil').value = userData.telMovil || '';
                document.getElementById('iban').value = userData.iban || '';
                document.getElementById('tarjeta').value = userData.tarjetaCredito || '';
                document.getElementById('passwd').value = userData.password || '';
                document.getElementById('confirmar').value = userData.password || '';
            } else {
                console.error('No se encontraron datos guardados');
            }
        })
        .catch(error => console.error('Error al cargar datos: ', error));
}


// Función para publicar los datos en la base de datos (POST)
function publicarBbdd() {
    const formData = new FormData(document.querySelector('.form'));

    // Convertir FormData en un objeto JSON
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    fetch('http://zonzamas.lan/publicar_mysql.php', {
        method: 'POST',
        body: formData // Enviar los datos como FormData
    })
    .then(res => res.text()) // Primero obtenemos el cuerpo como texto
    .then(text => {
        console.log('Respuesta del servidor: ', text); // Ver el contenido de la respuesta
        try {
            return JSON.parse(text); // Intentamos convertir a JSON
        } catch (e) {
            throw new Error('La respuesta no es un JSON válido');
        }
    })
    .then(data => {
        console.log('Datos procesados: ', data);
        if (data.mensaje === "Los datos se han guardado correctamente en la base de datos") {
            // Limpiar y ocultar el formulario
            const formElement = document.querySelector('.form');
            formElement.querySelectorAll('input').forEach(input => input.value = '');
            formElement.style.display = 'none'; 
        } else {
            alert("Hubo un error al guardar los datos: " + data.error);
        }
    })
    .catch(error => {
        console.error('Error: ', error);
    });
}

// Función para obtener los datos desde la base de datos (GET)
function obtenerBbdd() {
    const dni = document.getElementById('dni').value;  // Obtener el DNI del formulario

    // Verificar si el DNI está vacío
    if (!dni) {
        alert("Por favor, ingresa un DNI para recuperar los datos.");
        return;
    }

    fetch(`http://zonzamas.lan/obtener_mysql.php?dni=${dni}`, {
        method: 'GET',
    })
    .then(res => res.json())
    .then(data => {
        if (data.success === false) {
            alert("No se encontraron datos para el DNI proporcionado.");
        } else {
            // Poblar el formulario con los datos recibidos de la base de datos
            document.getElementById('nombre').value = data.nombre || '';
            document.getElementById('apellido').value = data.apellidos || '';
            document.getElementById('dni').value = data.dni || '';
            document.getElementById('nacimiento').value = data.fechaNacimiento || '';
            document.getElementById('cp').value = data.cp || '';
            document.getElementById('email').value = data.email || '';
            document.getElementById('fijo').value = data.telFijo || '';
            document.getElementById('movil').value = data.telMovil || '';
            document.getElementById('iban').value = data.iban || '';
            document.getElementById('tarjeta').value = data.tarjeta || '';
            document.getElementById('passwd').value = data.contrasena || '';
            document.getElementById('confirmar').value = data.contrasena || '';
        }
    })
    .catch(error => {
        console.error('Error al cargar datos: ', error);
    });
}