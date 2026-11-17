// limpiarImporte(texto)
// Quita el € y los espacios y deja el punto como separador decimal
function limpiarImporte(texto) {
  // trim(): quita los espacios de los extremos
  // replace(): sustituye texto; con /g cambia todas las apariciones
  let limpio = texto.trim().replace(/€/g, "").replace(/\s/g, "");

  // includes(): true si el texto contiene ese carácter
  if (limpio.includes(",") && limpio.includes(".")) {
    // "1.234,56": el punto separa miles y la coma es decimal
    limpio = limpio.replace(/\./g, "").replace(",", ".");
  } else {
    // "12,50": la coma es el separador decimal
    limpio = limpio.replace(",", ".");
  }

  return limpio;
}

// convertirImporte(texto)
// Convierte el texto limpio a Number; devuelve NaN si no es un número
function convertirImporte(texto) {
  const limpio = limpiarImporte(texto);

  // Number("") vale 0, así que el campo vacío se descarta antes
  if (limpio === "") {
    return NaN;
  }

  // Number(): pasa el texto a número (NaN si no es numérico)
  return Number(limpio);
}

// validarFactura(base, iva)
// Devuelve el mensaje de error o "" si todo está bien
function validarFactura(base, iva) {
  // Number.isNaN(): true si el valor es NaN (por ejemplo, texto no numérico)
  // Number.isFinite(): true solo con números finitos; descarta NaN e Infinity
  if (Number.isNaN(base) || !Number.isFinite(base)) {
    return "El precio no es un número válido.";
  }

  if (base <= 0) {
    return "El precio tiene que ser mayor que 0.";
  }

  if (Number.isNaN(iva) || !Number.isFinite(iva)) {
    return "El porcentaje de IVA no es un número válido.";
  }

  if (iva < 0 || iva > 100) {
    return "El IVA tiene que estar entre 0 y 100.";
  }

  return "";
}

// calcularFactura(base, iva)
// Devuelve base, cuota y PVP con dos decimales
function calcularFactura(base, iva) {
  const cuota = base * iva / 100;
  const pvp = base + cuota;

  // toFixed(2): dos decimales (devuelve texto); Number() lo vuelve a número
  return {
    base: Number(base.toFixed(2)),
    cuota: Number(cuota.toFixed(2)),
    pvp: Number(pvp.toFixed(2)),
  };
}

// --- Enlace con la página ---

// getElementById(): busca en la página el elemento con ese id
const formulario = document.getElementById("form-factura");

// addEventListener("submit"): ejecuta el código al enviar el formulario
formulario.addEventListener("submit", (evento) => {
  // preventDefault(): cancela el envío y evita que la página se recargue
  evento.preventDefault();

  const base = convertirImporte(document.getElementById("precio").value);
  const iva = convertirImporte(document.getElementById("iva").value);
  const salida = document.getElementById("salida-factura");
  const cajaError = document.getElementById("error-factura");

  const error = validarFactura(base, iva);

  // Si hay error se muestra y no se calcula nada
  if (error !== "") {
    // textContent: escribe el texto dentro del elemento
    salida.textContent = "";
    cajaError.textContent = error;
    return;
  }

  const factura = calcularFactura(base, iva);
  cajaError.textContent = "";

  // innerHTML: escribe HTML dentro del elemento
  salida.innerHTML =
    `<div class="resultado"><span>Base imponible</span><span>${factura.base.toFixed(2)} €</span></div>` +
    `<div class="resultado"><span>IVA (${iva} %)</span><span>${factura.cuota.toFixed(2)} €</span></div>` +
    `<div class="resultado"><span>PVP</span><span>${factura.pvp.toFixed(2)} €</span></div>`;
});
