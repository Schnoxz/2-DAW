// cryptoRandomFloat()
// Decimal aleatorio entre 0 y 1 con la entropía del sistema operativo
function cryptoRandomFloat() {
  // Uint32Array(1): array tipado con un solo entero sin signo de 32 bits
  const buffer = new Uint32Array(1);

  // getRandomValues(): rellena el array con bytes aleatorios del sistema
  crypto.getRandomValues(buffer);

  // buffer[0] es el número; se divide entre 2^32 para caer en [0, 1)
  return buffer[0] / 4294967296;
}
