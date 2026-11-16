// Actividad 3.1.3 - Validador de facturación y conversión numérica (Tema 3.1)

"use strict";

const formulario = document.getElementById("formulario");
const resultado = document.getElementById("resultado");

// Quita espacios y €, cambia la coma decimal por punto y convierte a Number.
function convertirNumero(texto) {
  let limpio = texto.trim().replace("€", "").replace(/\s/g, "");
  if (limpio.includes(",")) {
    limpio = limpio.replace(/\./g, "").replace(",", ".");
  }
  return Number.parseFloat(limpio);
}

formulario.addEventListener("submit", (evento) => {
  evento.preventDefault();

  const precio = convertirNumero(document.getElementById("precio").value);
  const iva = convertirNumero(document.getElementById("iva").value || "21");

  if (Number.isNaN(precio) || !Number.isFinite(precio) || precio <= 0) {
    resultado.className = "error";
    resultado.textContent = "El precio debe ser un número positivo.";
    return;
  }

  if (Number.isNaN(iva) || !Number.isFinite(iva) || iva < 0 || iva > 100) {
    resultado.className = "error";
    resultado.textContent = "El IVA debe ser un número entre 0 y 100.";
    return;
  }

  const cuota = (precio * iva) / 100;
  const total = precio + cuota;

  resultado.className = "";
  resultado.innerHTML =
    "Base imponible: " + precio.toFixed(2) + " €<br>" +
    "Cuota de IVA (" + iva + " %): " + cuota.toFixed(2) + " €<br>" +
    "Total (PVP): " + total.toFixed(2) + " €";
});
