// depurador_lab_corregido.js — VERSIÓN ARREGLADA DEL LABORATORIO
//
// Los tres cambios están marcados con «// FIX:». Para grabar el vídeo se puede
// empezar con depurador_lab.js (el defectuoso) y dejar este abierto al lado,
// para enseñar el antes y el después con el mismo botón.
//
// Se puede cargar en index.html cambiando la última línea:
//   <script src="depurador_lab_corregido.js"></script>

"use strict"; // FIX: todo el archivo en modo estricto, así una variable sin declarar da error

function calcularRecargo(base) {
  const FACTOR_AJUSTE = 1.05;
  return base * FACTOR_AJUSTE;
}

function procesarLote() {
  // FIX: Number() convierte el texto del input en número de verdad
  const unidades = Number(document.getElementById("campoUnidades").value);
  const precioBase = Number(document.getElementById("campoPrecio").value);
  const visor = document.getElementById("pantallaSalida");

  // FIX: declarada con let en lugar de crear una global en window
  let acumuladoTotal = 0;

  debugger;

  const precioConRecargo = calcularRecargo(precioBase);

  const lotes = [10, 20, 30, 40, 50];
  let sumaLotes = 0;

  // FIX: `<` en vez de `<=`, para no leer lotes[5] (undefined) y romper la suma
  for (let i = 0; i < lotes.length; i++) {
    sumaLotes += lotes[i];
  }

  // Este bucle se queda a propósito: sirve para el breakpoint condicional
  let contadorAuditoria = 0;
  for (let k = 0; k < 10000; k++) {
    contadorAuditoria += 1;
  }

  acumuladoTotal = (precioConRecargo * unidades) + sumaLotes;

  visor.innerHTML = `
    Subtotal lotes: ${sumaLotes}<br>
    Precio con recargo (unitario): ${precioConRecargo.toFixed(2)} €<br>
    Total final computado: ${acumuladoTotal.toFixed(2)} €<br>
    Auditoría masiva completada: ${contadorAuditoria} ciclos<br>
    ¿Se contaminó window?: ${typeof window.acumuladoTotal !== "undefined" ? "SÍ (Fuga)" : "NO"}
  `;
}

function alterarEstructuraDOM() {
  const contenedor = document.getElementById("zonaMonitorizada");
  const nodo = document.getElementById("nodoObjetivo");

  contenedor.setAttribute("data-estado", "actualizado");

  const nuevoElemento = document.createElement("p");
  nuevoElemento.textContent = `Elemento inyectado a las ${new Date().toLocaleTimeString()}`;
  nuevoElemento.style.color = "#38bdf8";
  contenedor.appendChild(nuevoElemento);

  if (nodo) {
    nodo.remove();
  }
}

document.getElementById("btnEjecutar").addEventListener("click", procesarLote);
document.getElementById("btnModificarDOM").addEventListener("click", alterarEstructuraDOM);
