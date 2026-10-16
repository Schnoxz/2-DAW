// Actividad 1 (Tema 2.3) - var frente a let en un bucle asíncrono

for (var i = 0; i < 3; i++) {
  setTimeout(() => console.log("var:", i), 100);   // 3, 3, 3
}

for (let j = 0; j < 3; j++) {
  setTimeout(() => console.log("let:", j), 100);   // 0, 1, 2
}
