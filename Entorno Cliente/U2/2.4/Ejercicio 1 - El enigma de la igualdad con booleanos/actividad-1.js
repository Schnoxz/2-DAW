// Actividad 1 (Tema 2.4) - El enigma de la igualdad con booleanos

if ("0" == false) console.log("A se cumple");   // se cumple
if ("0") console.log("B se cumple");            // se cumple

console.log("0" == false);   // true  (coerción: 0 == 0)
console.log(!!"0");          // true  (la cadena "0" no está vacía, es truthy)
console.log("0" === false);  // false (la igualdad estricta exige el mismo tipo)
