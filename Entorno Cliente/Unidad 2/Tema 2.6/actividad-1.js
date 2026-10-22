// Array de partida del enunciado
const numeros = [2, 4, 6, 8, 9];


// El bucle avanza de izquierda a derecha. Cuando splice() borra un elemento, los siguientes se desplazan una posicion a la izquierda, pero el contador i sigue subiendo: el elemento que ocupa el hueco se queda sin revisar
for (let i = 0; i < numeros.length; i++) {
  if (numeros[i] % 2 === 0) {
    numeros.splice(i, 1);   // borra 1 elemento en la posicion i
  }
}

// [4, 8, 9]
// El [4, 6, 9] es incorrecto
console.log("Creciente:", numeros);

// Ahora se empieza por el ultimo indice. Al borrar con splice(), los elementos que se desplazan ya han sido visitados, asi que no se salta ninguno.
const otros = [2, 4, 6, 8, 9];

for (let i = otros.length - 1; i >= 0; i--) {
  if (otros[i] % 2 === 0) {
    otros.splice(i, 1);
  }
}

// Resultado: [9], el unico impar que queda
console.log("Decreciente:", otros);
