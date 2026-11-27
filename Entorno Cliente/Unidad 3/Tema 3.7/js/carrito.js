// js/carrito.js
// Actividad 3.7.4 · Carrito reactivo entre pestañas.
// El carrito vive en localStorage y el evento storage avisa a las demás
// pestañas del mismo origen cuando cambia.

var CLAVE_CARRITO = "carrito_tienda";

// Catálogo fijo de la tienda de componentes del departamento
var PRODUCTOS = [
  { id: 101, nombre: "Cable Cat 6A", precio: 4.5 },
  { id: 102, nombre: "Switch 8 puertos", precio: 29.9 },
  { id: 103, nombre: "Roseta RJ45", precio: 6.25 }
];

var cuerpoCarrito = document.getElementById("cuerpoCarrito");
var totalArticulos = document.getElementById("totalArticulos");
var totalImporte = document.getElementById("totalImporte");
var visorCarrito = document.getElementById("visorCarrito");

// leerCarrito()
// Devuelve el array de productos guardado. Si no hay nada válido, un array vacío.
function leerCarrito() {
  var crudo = localStorage.getItem(CLAVE_CARRITO);
  if (crudo === null) {
    return [];
  }

  try {
    var datos = JSON.parse(crudo);
    return Array.isArray(datos) ? datos : [];
  } catch (error) {
    console.error("El carrito guardado no es un JSON válido:", error);
    return [];
  }
}

// guardarCarrito($carrito)
// Serializa el array completo en localStorage.
// No devuelve nada.
function guardarCarrito(carrito) {
  localStorage.setItem(CLAVE_CARRITO, JSON.stringify(carrito));
}

// pintarCarrito()
// Reconstruye la tabla y los totales a partir de localStorage.
// No devuelve nada.
function pintarCarrito() {
  var carrito = leerCarrito();
  cuerpoCarrito.replaceChildren();

  if (carrito.length === 0) {
    var filaVacia = document.createElement("tr");
    var celdaVacia = document.createElement("td");
    celdaVacia.colSpan = 3;
    celdaVacia.className = "vacio";
    celdaVacia.textContent = "El carrito está vacío.";
    filaVacia.appendChild(celdaVacia);
    cuerpoCarrito.appendChild(filaVacia);
  } else {
    for (var i = 0; i < carrito.length; i++) {
      var producto = carrito[i];

      var fila = document.createElement("tr");

      var celdaNombre = document.createElement("td");
      celdaNombre.textContent = producto.nombre;

      var celdaPrecio = document.createElement("td");
      celdaPrecio.className = "numero";
      celdaPrecio.textContent = producto.precio.toFixed(2) + " €";

      var celdaAccion = document.createElement("td");
      var boton = document.createElement("button");
      boton.className = "peligro";
      boton.textContent = "Quitar";
      boton.dataset.indice = i;
      celdaAccion.appendChild(boton);

      fila.appendChild(celdaNombre);
      fila.appendChild(celdaPrecio);
      fila.appendChild(celdaAccion);
      cuerpoCarrito.appendChild(fila);
    }
  }

  totalArticulos.textContent = carrito.length;
  totalImporte.textContent = calcularTotal(carrito).toFixed(2) + " €";
}

// calcularTotal($carrito)
// Suma los precios y devuelve el importe sin formatear.
function calcularTotal(carrito) {
  var total = 0;
  for (var i = 0; i < carrito.length; i++) {
    total = total + carrito[i].precio;
  }
  return total;
}

// anadirProducto($id)
// Busca el producto en el catálogo, lo copia al carrito y guarda.
// No devuelve nada.
function anadirProducto(id) {
  var producto = null;

  for (var i = 0; i < PRODUCTOS.length; i++) {
    if (PRODUCTOS[i].id === id) {
      producto = PRODUCTOS[i];
    }
  }

  if (producto === null) {
    return;
  }

  var carrito = leerCarrito();
  // Se guarda una copia, no la referencia al objeto del catálogo
  carrito.push({
    id: producto.id,
    nombre: producto.nombre,
    precio: producto.precio
  });
  guardarCarrito(carrito);
  visorCarrito.textContent = 'Añadido "' + producto.nombre + '".';
  pintarCarrito();
}

// quitarProducto($indice)
// Elimina la posición indicada con splice y vuelve a guardar.
// No devuelve nada.
function quitarProducto(indice) {
  var carrito = leerCarrito();
  carrito.splice(indice, 1);
  guardarCarrito(carrito);
  visorCarrito.textContent = "Producto quitado del carrito.";
  pintarCarrito();
}

// vaciarCarrito()
// Borra la clave entera de localStorage.
// No devuelve nada.
function vaciarCarrito() {
  localStorage.removeItem(CLAVE_CARRITO);
  visorCarrito.textContent = "Carrito vaciado.";
  pintarCarrito();
}

// Los botones del catálogo se generan aquí para no repetir HTML
var catalogo = document.getElementById("catalogo");
for (var i = 0; i < PRODUCTOS.length; i++) {
  var producto = PRODUCTOS[i];

  var tarjeta = document.createElement("div");
  tarjeta.className = "campo";

  var nombre = document.createElement("strong");
  nombre.textContent = producto.nombre + " · " + producto.precio.toFixed(2) + " €";

  var boton = document.createElement("button");
  boton.textContent = "Añadir al carrito";
  boton.dataset.id = producto.id;
  boton.style.marginTop = "8px";
  boton.style.display = "block";

  tarjeta.appendChild(nombre);
  tarjeta.appendChild(boton);
  catalogo.appendChild(tarjeta);
}

// Delegación: un solo listener para todos los botones del catálogo
catalogo.addEventListener("click", function (evento) {
  if (evento.target.tagName === "BUTTON") {
    anadirProducto(parseInt(evento.target.dataset.id, 10));
  }
});

// Delegación para los botones Quitar de la tabla
cuerpoCarrito.addEventListener("click", function (evento) {
  if (evento.target.tagName === "BUTTON") {
    quitarProducto(parseInt(evento.target.dataset.indice, 10));
  }
});

document.getElementById("btnVaciarCarrito").addEventListener("click", vaciarCarrito);

// El evento storage solo salta en las OTRAS pestañas, no en la que escribe.
// Por eso su función es repintar aquí cuando el cambio viene de fuera.
window.addEventListener("storage", function (evento) {
  if (evento.key === CLAVE_CARRITO || evento.key === null) {
    visorCarrito.textContent = "Cambio recibido desde otra pestaña.";
    pintarCarrito();
  }
});

// Al cargar, se pinta lo que ya hubiera
pintarCarrito();
