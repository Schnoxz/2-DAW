// Actividad 3.2.2 - Analizador de la URL actual a partir de location.

// crearParte(nombre, valor)
// Monta una línea del visor con el nombre de la parte y su valor.
// Devuelve el div ya construido para que lo inserte quien llama.
function crearParte(nombre, valor) {
  const fila = document.createElement("div");
  fila.className = "resultado";

  const etiqueta = document.createElement("span");
  etiqueta.textContent = nombre;

  const dato = document.createElement("span");
  dato.textContent = valor === "" ? "(vacío)" : valor;

  fila.appendChild(etiqueta);
  fila.appendChild(dato);
  return fila;
}

// analizarURL()
// Descompone window.location y muestra cada parte por separado.
// No devuelve nada: escribe el resultado en el visor.
function analizarURL() {
  const visor = document.getElementById("salida-url");
  visor.innerHTML = "";

  // href es la URL completa; el resto son trozos ya separados por el navegador
  visor.appendChild(crearParte("URL completa", location.href));
  visor.appendChild(crearParte("Protocolo", location.protocol));
  visor.appendChild(crearParte("Servidor (hostname)", location.hostname));

  // El puerto va vacío cuando se usa el puerto por defecto del protocolo
  visor.appendChild(crearParte("Puerto", location.port || "(el del protocolo)"));
  visor.appendChild(crearParte("Ruta (pathname)", location.pathname));
  visor.appendChild(crearParte("Parámetros (search)", location.search));

  // URLSearchParams permite recorrer los parámetros sin cortar el texto a mano
  const parametros = new URLSearchParams(location.search);
  if (parametros.toString() === "") {
    visor.appendChild(crearParte("Parámetros sueltos", "Ninguno en esta URL"));
  } else {
    parametros.forEach(function (valor, clave) {
      visor.appendChild(crearParte("Parámetro " + clave, valor));
    });
  }

  // El hash es lo que va detrás de la almohadilla
  visor.appendChild(crearParte("Ancla (hash)", location.hash));
}

document.getElementById("btn-analizar").addEventListener("click", analizarURL);

// El botón de recarga no toca el historial: reload() vuelve a pedir la página
document.getElementById("btn-recargar").addEventListener("click", function () {
  location.reload();
});

// Al cargar la página ya se analiza una vez, así no arranca vacía
analizarURL();
