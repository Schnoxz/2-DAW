// Actividad 1 - Evaluación de cortocircuito y precedencia (Tema 2.2)

console.log(0 || "Fallback");   // "Fallback"
console.log(0 ?? "Fallback");   // 0
console.log(5 + "5");           // "55"
let i = 2;
console.log(i++ * ++i);         // 8
