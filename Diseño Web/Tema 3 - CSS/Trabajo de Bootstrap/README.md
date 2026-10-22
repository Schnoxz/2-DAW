# Librería Kursaal - Trabajo de Bootstrap

Tienda de libros hecha con Bootstrap 5 para el módulo de Diseño de Interfaces Web.

## Páginas

- `index.html`: catálogo con seis libros.
- `carrito.html`: libros añadidos, cantidades, IVA, envío y total.
- `checkout.html`: formulario con los datos de envío.
- `factura.html`: factura del último pedido.

## Funcionamiento

1. En el catálogo se pulsa "Añadir al carrito".
2. En el carrito se pueden cambiar las cantidades o quitar libros.
3. En el formulario se rellenan los datos de envío y se confirma el pedido.
4. La factura muestra el número, la fecha, el cliente, los libros y los totales.

El carrito se guarda en `localStorage`, así que no se pierde al cambiar de página.

## Reglas de la tienda

- IVA del 4 % (libros).
- Gastos de envío: 3,95 €. Gratis a partir de 30 €.

## Estructura

```
Trabajo de Bootstrap/
├── index.html
├── carrito.html
├── checkout.html
├── factura.html
├── css/estilos.css
├── js/tienda.js
├── img/            (portadas de los libros)
└── README.md
```

## Cómo abrirlo

Se abre `index.html` con doble clic. Bootstrap se carga desde su CDN, así que hace falta conexión a Internet.

## Tecnologías

HTML5, CSS3, Bootstrap 5.3 y JavaScript.

## Autoría

Trabajo académico de 2.º DAW - I.E.S. Kursaal.
