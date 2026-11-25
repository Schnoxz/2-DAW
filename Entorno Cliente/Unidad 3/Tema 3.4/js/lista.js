// Actividad 3.4.1 - Crear una lista entera desde JavaScript.
// No se usa innerHTML en ningún momento: cada etiqueta y cada texto se crean
// como nodos y se van colgando unos de otros.

const contenedorLista = document.getElementById("contenedorLista");
const salidaLista = document.getElementById("salida-lista");

// crearElemento(etiqueta, texto)
// Crea un elemento con la etiqueta indicada y le mete un nodo de texto dentro.
// Devuelve el elemento ya montado, todavía fuera del documento.
function crearElemento(etiqueta, texto) {
  const elemento = document.createElement(etiqueta);
  const nodoTexto = document.createTextNode(texto);
  elemento.appendChild(nodoTexto);
  return elemento;
}

// generarLista()
// Construye un <ul> con los tres módulos y lo añade al contenedor.
// No devuelve nada: escribe en la página.
function generarLista() {
  // Si se pulsa dos veces, se borra lo anterior. Vaciar con textContent es
  // seguro porque no interpreta la cadena como HTML.
  contenedorLista.textContent = "";

  const lista = document.createElement("ul");

  const modulos = ["DWEC", "DWES", "DIW"];
  for (let i = 0; i < modulos.length; i++) {
    const item = crearElemento("li", modulos[i]);
    lista.appendChild(item);
  }

  // El <ul> se monta en el documento de una sola vez, con sus hijos dentro
  contenedorLista.appendChild(lista);

  salidaLista.textContent = "Lista creada con " + modulos.length + " elementos: " + modulos.join(", ") + ".";
}

document.getElementById("btn-generar").addEventListener("click", generarLista);
