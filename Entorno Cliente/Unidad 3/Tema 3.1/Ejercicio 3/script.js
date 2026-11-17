// Actividad 3.1.3 - Factura con IVA

"use strict";

// getElementById(): busca en la página el elemento con ese id
const formulario = document.getElementById("formulario");
const resultado = document.getElementById("resultado");

// Limpia el precio escrito y lo convierte a número
function convertirNumero(texto) {
  // trim(): quita los espacios de los extremos
  // replace(): cambia una parte del texto; con /g, todas las apariciones
  let limpio = texto.trim().replace("€", "").replace(/\s/g, "");
  // includes(): true si el texto contiene una coma
  if (limpio.includes(",")) {
    limpio = limpio.replace(/\./g, "").replace(",", ".");
  }
  // parseFloat(): pasa el texto a número decimal; si no puede, da NaN
  return Number.parseFloat(limpio);
}

// addEventListener("submit"): ejecuta el código al enviar el formulario
formulario.addEventListener("submit", (evento) => {
  // preventDefault(): cancela el envío y evita que la página se recargue
  evento.preventDefault();

  const precio = convertirNumero(document.getElementById("precio").value);
  const iva = convertirNumero(document.getElementById("iva").value || "21");

  // Number.isNaN(): true si el valor no es un número
  // Number.isFinite(): true solo con números finitos (descarta NaN e Infinity)
  if (Number.isNaN(precio) || !Number.isFinite(precio) || precio <= 0) {
    // className: cambia la clase CSS del párrafo (aquí, la de error)
    // textContent: escribe el texto dentro del elemento
    resultado.className = "error";
    resultado.textContent = "El precio debe ser un número positivo.";
    return;
  }

  // El IVA tiene que estar entre 0 y 100
  if (Number.isNaN(iva) || !Number.isFinite(iva) || iva < 0 || iva > 100) {
    resultado.className = "error";
    resultado.textContent = "El IVA debe ser un número entre 0 y 100.";
    return;
  }

  // Cuota de IVA y total
  const cuota = (precio * iva) / 100;
  const total = precio + cuota;

  // innerHTML: escribe HTML dentro del elemento; toFixed(2): dos decimales
  resultado.className = "";
  resultado.innerHTML =
    "Base imponible: " + precio.toFixed(2) + " €<br>" +
    "Cuota de IVA (" + iva + " %): " + cuota.toFixed(2) + " €<br>" +
    "Total (PVP): " + total.toFixed(2) + " €";
});
