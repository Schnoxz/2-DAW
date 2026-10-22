// Datos de los libros que se venden en la tienda.
// Los ids coinciden con los botones "Añadir" de index.html.
const libros = [
  { id: 1, titulo: "Don Quijote de la Mancha", precio: 12.5 },
  { id: 2, titulo: "El Hobbit", precio: 15.9 },
  { id: 3, titulo: "Sapiens", precio: 21.0 },
  { id: 4, titulo: "Cien años de soledad", precio: 18.75 },
  { id: 5, titulo: "El nombre del viento", precio: 19.95 },
  { id: 6, titulo: "Código limpio", precio: 29.9 }
];

// ---------------------------------------------------------------- carrito ---

// Lee el carrito guardado en el navegador. Si no hay nada, devuelve una lista vacía.
function leerCarrito() {
  const guardado = localStorage.getItem("carrito");
  if (guardado) {
    return JSON.parse(guardado);
  }
  return [];
}

// Guarda el carrito en el navegador.
function guardarCarrito(carrito) {
  localStorage.setItem("carrito", JSON.stringify(carrito));
}

// Busca un libro por su id.
function buscarLibro(id) {
  for (let i = 0; i < libros.length; i++) {
    if (libros[i].id === id) {
      return libros[i];
    }
  }
  return null;
}

// Calcula subtotal, IVA (4 %), envío y total.
function calcularTotales(carrito) {
  let subtotal = 0;
  for (let i = 0; i < carrito.length; i++) {
    const libro = buscarLibro(carrito[i].id);
    if (libro) {
      subtotal = subtotal + libro.precio * carrito[i].cantidad;
    }
  }
  const iva = subtotal * 0.04;
  let envio = 3.95;
  if (subtotal >= 30 || subtotal === 0) {
    envio = 0;
  }
  return {
    subtotal: subtotal,
    iva: iva,
    envio: envio,
    total: subtotal + iva + envio
  };
}

// Convierte un número en un precio con dos decimales y el símbolo del euro.
function formatearPrecio(numero) {
  return numero.toFixed(2).replace(".", ",") + " €";
}

// -------------------------------------------------------- añadir al carrito -

// En index.html hay un botón "Añadir" por cada libro.
const botonesAnadir = document.querySelectorAll(".anadir");

for (let i = 0; i < botonesAnadir.length; i++) {
  botonesAnadir[i].addEventListener("click", function () {
    const id = Number(botonesAnadir[i].dataset.id);
    const carrito = leerCarrito();

    // Si el libro ya está en el carrito, se suma una unidad.
    let encontrado = false;
    for (let j = 0; j < carrito.length; j++) {
      if (carrito[j].id === id) {
        carrito[j].cantidad = carrito[j].cantidad + 1;
        encontrado = true;
      }
    }
    if (encontrado === false) {
      carrito.push({ id: id, cantidad: 1 });
    }

    guardarCarrito(carrito);
    alert("Libro añadido al carrito");
  });
}

// ------------------------------------------------------- página del carrito -

const tablaCarrito = document.getElementById("tabla-carrito");

if (tablaCarrito) {
  dibujarCarrito();
}

function dibujarCarrito() {
  const carrito = leerCarrito();
  const cuerpo = document.getElementById("cuerpo-carrito");
  cuerpo.innerHTML = "";

  if (carrito.length === 0) {
    cuerpo.innerHTML =
      '<tr><td colspan="5" class="text-center">El carrito está vacío.</td></tr>';
  }

  for (let i = 0; i < carrito.length; i++) {
    const libro = buscarLibro(carrito[i].id);
    if (!libro) {
      continue;
    }
    const fila = document.createElement("tr");
    fila.innerHTML =
      "<td>" + libro.titulo + "</td>" +
      '<td><input type="number" class="form-control cantidad" data-id="' +
      libro.id + '" value="' + carrito[i].cantidad + '" min="1" style="width: 80px"></td>' +
      "<td>" + formatearPrecio(libro.precio) + "</td>" +
      "<td>" + formatearPrecio(libro.precio * carrito[i].cantidad) + "</td>" +
      '<td><button class="btn btn-sm btn-danger quitar" data-id="' + libro.id + '">Quitar</button></td>';
    cuerpo.appendChild(fila);
  }

  // Botones para quitar un libro.
  const botonesQuitar = document.querySelectorAll(".quitar");
  for (let i = 0; i < botonesQuitar.length; i++) {
    botonesQuitar[i].addEventListener("click", function () {
      quitarLibro(Number(botonesQuitar[i].dataset.id));
    });
  }

  // Cambiar la cantidad con el campo number.
  const camposCantidad = document.querySelectorAll(".cantidad");
  for (let i = 0; i < camposCantidad.length; i++) {
    camposCantidad[i].addEventListener("change", function () {
      cambiarCantidad(Number(camposCantidad[i].dataset.id), Number(camposCantidad[i].value));
    });
  }

  const totales = calcularTotales(carrito);
  document.getElementById("subtotal").textContent = formatearPrecio(totales.subtotal);
  document.getElementById("iva").textContent = formatearPrecio(totales.iva);
  document.getElementById("envio").textContent = formatearPrecio(totales.envio);
  document.getElementById("total").textContent = formatearPrecio(totales.total);
}

function quitarLibro(id) {
  let carrito = leerCarrito();
  const nuevo = [];
  for (let i = 0; i < carrito.length; i++) {
    if (carrito[i].id !== id) {
      nuevo.push(carrito[i]);
    }
  }
  guardarCarrito(nuevo);
  dibujarCarrito();
}

function cambiarCantidad(id, cantidad) {
  if (cantidad < 1) {
    cantidad = 1;
  }
  const carrito = leerCarrito();
  for (let i = 0; i < carrito.length; i++) {
    if (carrito[i].id === id) {
      carrito[i].cantidad = cantidad;
    }
  }
  guardarCarrito(carrito);
  dibujarCarrito();
}

// En checkout.html se muestra el resumen, pero no hay tabla del carrito.
if (tablaCarrito === null && document.getElementById("subtotal")) {
  const totales = calcularTotales(leerCarrito());
  document.getElementById("subtotal").textContent = formatearPrecio(totales.subtotal);
  document.getElementById("iva").textContent = formatearPrecio(totales.iva);
  document.getElementById("envio").textContent = formatearPrecio(totales.envio);
  document.getElementById("total").textContent = formatearPrecio(totales.total);
}

// ------------------------------------------------------ página de checkout --

const formulario = document.getElementById("formulario-pedido");

if (formulario) {
  formulario.addEventListener("submit", function (evento) {
    evento.preventDefault();

    if (formulario.checkValidity() === false) {
      formulario.classList.add("was-validated");
      return;
    }

    const carrito = leerCarrito();
    if (carrito.length === 0) {
      alert("El carrito está vacío.");
      return;
    }

    const totales = calcularTotales(carrito);

    // Guardamos el pedido para poder mostrarlo en la factura.
    const pedido = {
      numero: "FAC-" + new Date().getFullYear() + "-" + Math.floor(Math.random() * 900 + 100),
      fecha: new Date().toLocaleDateString("es-ES"),
      nombre: document.getElementById("nombre").value,
      direccion: document.getElementById("direccion").value,
      ciudad: document.getElementById("ciudad").value,
      codigoPostal: document.getElementById("codigo-postal").value,
      correo: document.getElementById("correo").value,
      lineas: carrito,
      totales: totales
    };

    localStorage.setItem("ultimoPedido", JSON.stringify(pedido));
    localStorage.removeItem("carrito");
    window.location.href = "factura.html";
  });
}

// ------------------------------------------------------- página de factura --

const cajaFactura = document.getElementById("caja-factura");

if (cajaFactura) {
  const guardado = localStorage.getItem("ultimoPedido");

  if (!guardado) {
    cajaFactura.innerHTML =
      '<div class="alert alert-warning">No hay ningún pedido guardado. ' +
      'Vuelve a la tienda y compra un libro.</div>';
  } else {
    const pedido = JSON.parse(guardado);
    let filas = "";

    for (let i = 0; i < pedido.lineas.length; i++) {
      const libro = buscarLibro(pedido.lineas[i].id);
      filas +=
        "<tr><td>" + libro.titulo + "</td>" +
        "<td>" + pedido.lineas[i].cantidad + "</td>" +
        "<td>" + formatearPrecio(libro.precio) + "</td>" +
        "<td>" + formatearPrecio(libro.precio * pedido.lineas[i].cantidad) + "</td></tr>";
    }

    cajaFactura.innerHTML =
      "<h2>Factura " + pedido.numero + "</h2>" +
      "<p>Fecha: " + pedido.fecha + "</p>" +
      "<p><strong>Cliente:</strong> " + pedido.nombre + "<br>" +
      pedido.direccion + "<br>" + pedido.codigoPostal + " " + pedido.ciudad + "<br>" +
      pedido.correo + "</p>" +
      '<table class="table tabla-carrito">' +
      "<thead><tr><th>Libro</th><th>Cantidad</th><th>Precio</th><th>Importe</th></tr></thead>" +
      "<tbody>" + filas + "</tbody></table>" +
      '<p class="text-end">Subtotal: ' + formatearPrecio(pedido.totales.subtotal) + "<br>" +
      "IVA (4 %): " + formatearPrecio(pedido.totales.iva) + "<br>" +
      "Envío: " + formatearPrecio(pedido.totales.envio) + "</p>" +
      '<p class="text-end fs-4"><strong>Total: ' +
      formatearPrecio(pedido.totales.total) + "</strong></p>";
  }
}
