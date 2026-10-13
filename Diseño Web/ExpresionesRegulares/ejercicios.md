Ejercicios de expreciones irregulares


1. Validar DNI
^\d{8}?[TRWAGMYFPDXBNJZSQVHLCKE]

2. Letra mayuscula seguida de dos a tres digitos
\b[A-Z]\d{2,3}\b

3. URL de tipo .org
^https?:\/\/(www\.)?[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.org(\/\S*)?$

4. Correo postal de España
   ^(0[1-9]|[1-4]\d|5[0-2])\d{3}$

5. Que en una linea hayan a lo sumo dos aes