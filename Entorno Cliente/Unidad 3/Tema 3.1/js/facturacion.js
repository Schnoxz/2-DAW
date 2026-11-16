// limpiarImporte(texto)
// Deja el precio en un formato que Number() entienda: sin €, sin espacios y
// con el punto como separador decimal. Devuelve un String.
function limpiarImporte(texto) {
  // trim() quita los espacios de los extremos; el resto desaparecen con \s
  let limpio = texto.trim().replace(/€/g, "").replace(/\s/g, "");

  if (limpio.includes(",") && limpio.includes(".")) {
    // Si vienen los dos, el punto separa miles ("1.234,56") y la coma decimales
    limpio = limpio.replace(/\./g, "").replace(",", ".");
  } else {
    // Con un solo separador, la coma es la decimal ("12,50")
    limpio = limpio.replace(",", ".");
  }

  return limpio;
}

// convertirImporte(texto)
// Limpia el texto y lo convierte a Number. Devuelve NaN si no es un número.
function convertirImporte(texto) {
  const limpio = limpiarImporte(texto);

  // Number("") vale 0, así que un campo vacío hay que descartarlo antes
  if (limpio === "") {
    return NaN;
  }

  return Number(limpio);
}

// validarFactura(base, iva)
// Comprueba que la base sea un número real positivo y el IVA un porcentaje
// razonable. Devuelve un String con el error, o un String vacío si todo va bien.
function validarFactura(base, iva) {
  // isNaN() pregunta si el valor es NaN; isFinite() descarta además Infinity
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
// Calcula la cuota de IVA y el precio de venta al público. Devuelve un objeto
// con base, cuota y pvp, los tres ya redondeados a dos decimales como Number.
function calcularFactura(base, iva) {
  const cuota = base * iva / 100;
  const pvp = base + cuota;

  // toFixed() devuelve un String para conservar los ceros finales; para volver
  // a operar con el valor se convierte otra vez con Number()
  return {
    base: Number(base.toFixed(2)),
    cuota: Number(cuota.toFixed(2)),
    pvp: Number(pvp.toFixed(2)),
  };
}

// --- Enlace con la página ---

const formulario = document.getElementById("form-factura");

formulario.addEventListener("submit", (evento) => {
  // Sin esto, el navegador recarga la página al enviar el formulario
  evento.preventDefault();

  const base = convertirImporte(document.getElementById("precio").value);
  const iva = convertirImporte(document.getElementById("iva").value);
  const salida = document.getElementById("salida-factura");
  const cajaError = document.getElementById("error-factura");

  const error = validarFactura(base, iva);

  if (error !== "") {
    salida.textContent = "";
    cajaError.textContent = error;
    return;
  }

  const factura = calcularFactura(base, iva);
  cajaError.textContent = "";

  salida.innerHTML =
    `<div class="resultado"><span>Base imponible</span><span>${factura.base.toFixed(2)} €</span></div>` +
    `<div class="resultado"><span>IVA (${iva} %)</span><span>${factura.cuota.toFixed(2)} €</span></div>` +
    `<div class="resultado"><span>PVP</span><span>${factura.pvp.toFixed(2)} €</span></div>`;
});
