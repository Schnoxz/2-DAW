# 01 · Sintaxis y ejecución

> Apuntes §2 y §2.2 (págs. 3-10) · Guía de repaso §01 (pág. 2).

## 1. Qué es PHP y dónde se ejecuta

PHP (*PHP: Hypertext Preprocessor*) es un lenguaje de **lado servidor**: el
código se ejecuta en el servidor, nunca en el navegador.

Una página PHP es un fichero **HTML normal con bloques de PHP incrustados**.
Cuando el navegador la pide:

1. El servidor recorre el fichero.
2. Lo que está **fuera** de los bloques PHP se envía tal cual.
3. Cada bloque PHP **se ejecuta** y se sustituye por su salida (`echo`).

Consecuencias que caen en el examen:

- El navegador **nunca recibe código PHP**: con `Ctrl + U` solo se ve el HTML
  con los resultados ya puestos.
- El fichero tiene que estar **dentro del servidor**: en
  `C:\xampp\htdocs\` con Apache arrancado, y se visita como
  `http://localhost/fichero.php`.
- **Abrir el `.php` con doble clic no lo ejecuta**: se vería el código sin
  interpretar (o se descargaría).
- En una carpeta de proyecto (`htdocs\proyecto1\`), la página que se abre por
  defecto es **`index.php`**: `http://localhost/proyecto1/`. Las demás piden su
  nombre completo.

## 2. El bloque PHP

```php
<?php
  echo "Hola Mundo";
?>
```

- El elemento básico es el **bloque** `<?php ... ?>`, que permite *entrar y
  salir del modo PHP* tantas veces como haga falta dentro del HTML.
- Cada **sentencia** termina en **punto y coma** `;`.
- Si el fichero es **solo PHP**, se recomienda **omitir el `?>` final**: al
  incluir ese fichero desde otro, cualquier espacio o salto de línea que quede
  detrás del cierre se enviaría al navegador y podría romper cabeceras.

Ejemplo completo (así es el `hola_mundo.php` de los apuntes):

```php
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Hola mundo</title>
</head>
<body>
  <p>Mi primera página</p>
  <?php echo "Hola Mundo"; ?>
</body>
</html>
```

Lo que recibe el navegador es `<p>Mi primera página</p><p>Hola Mundo</p>`: el
bloque PHP ha desaparecido y en su sitio está su salida.

## 3. Comentarios

| Forma | Tipo |
|---|---|
| `// comentario` | una línea (estilo C++) |
| `# comentario` | una línea (estilo consola) |
| `/* ... */` | bloque, varias líneas |

Comentar el código es buena práctica y **se valora en los exámenes prácticos**.

## 4. Mostrar cosas por pantalla

- `echo` es la orden de salida que se usa en todo el tema.
- Lo que se imprime se mezcla con el HTML: si quieres una línea nueva en la
  página, hay que escribir `<br>` (no vale `\n`, que solo se ve en el código
  fuente).
- Con **comillas dobles** la cadena interpola variables; con **simples**, no
  (ver capítulo 07).

```php
<?php
  $nombre = "Ana";
  echo "<p>Hola $nombre</p>";   // Hola Ana
  echo '<p>Hola $nombre</p>';   // Hola $nombre
?>
```

Detalle de examen: dentro de una cadena con comillas dobles, los atributos HTML
van con **comillas simples** para no cerrar la cadena antes de tiempo:

```php
echo "<p style='font-size: 30px;'>$numero</p>";
```

## 5. Errores típicos de sintaxis

| Error | Qué pasa |
|---|---|
| Falta el `;` de una sentencia | `Parse error: syntax error, unexpected ...` |
| Etiqueta de apertura mal escrita (`<?ph`) | El bloque no se ejecuta y se envía como texto |
| `?>` partido o duplicado | `Parse error` (los apuntes lo tienen en las págs. 43 y 58) |
| Usar comillas tipográficas `“ ”` en el código | `Parse error` (pág. 47 de los apuntes) |
| Guardar como `.html` | El servidor no interpreta el PHP |
| Abrir con `file:///` | Igual: no hay servidor que lo ejecute |
