// Actividad 3.4.1 - Crear una lista entera desde JavaScript.
// No se usa innerHTML: cada etiqueta y cada texto se crean como nodos.

const contenedorLista = document.getElementById("contenedorLista");

// crearElemento(etiqueta, texto)
// Crea un elemento con la etiqueta indicada y le mete un nodo de texto dentro.
// Devuelve el elemento montado, todavía fuera del documento.
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
    lista.appendChild(crearElemento("li", modulos[i]));
  }

  // El <ul> se monta en el documento de una vez, ya con sus hijos dentro
  contenedorLista.appendChild(lista);
}

document.getElementById("btn-generar").addEventListener("click", generarLista);
