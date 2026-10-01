# UD1 - Práctica 1: CDMON con WordPress

Documentación paso a paso de la práctica. En cada carpeta van las capturas de pantalla, nombradas con el prefijo del paso para que se lean en orden.

- **Profesor:** Juanma Ayala Masacarell
- **Asignatura:** Despliegue de aplicaciones web
- **PDF de la práctica:** `../Despliegue de aplicaciones web/Unidad 1 - Implantación de arquitecturas web/Práctica_1-CDMON con Wordpress.pdf`

---

## Aviso importante

> Para entrar a trabajar en la web **siempre** hay que seguir estos cuatro pasos en este orden:
>
> 1. Entrar en [CDMON](https://admin.cdmon.com/es/acceso) con tu usuario y contraseña
> 2. En el **listado de hostings**, clic en tu plataforma de pruebas
> 3. Clic en **"Acceder a la página"**
> 4. Desde el doc de Google, abrir tu dominio e introducir usuario y contraseña de WordPress
>
> Si te saltas pasos o entras directamente a la URL, **te bloquean la plataforma a toda la clase**.

Las plataformas de prueba hay que **renovarlas cada 90 días** desde el panel de CDMON. No tiene coste, es solo un botón.

---

## Documentación de claves

Guarda todo esto en un **documento de Google Drive**. Es imprescindible: más adelante se generan nuevas claves y hay que tenerlo siempre a mano.

| Dato | Valor |
|---|---|
| Usuario CDMON | _(pendiente)_ |
| Contraseña CDMON | _(pendiente)_ |
| Dominio de la plataforma | _(pendiente)_ |
| URL de WordPress (`/wp-admin`) | _(pendiente)_ |
| Usuario WordPress | _(pendiente)_ |
| Contraseña WordPress | _(pendiente)_ |

---

## Pasos

### 00 - Registro en CDMON

Cuenta creada en CDMON con el correo `@g.educaand.es`. Da acceso a 5 plataformas de prueba gratuitas.

- Panel: <https://admin.cdmon.com/es/acceso>
- Más info: <https://www.cdmon.com/es/hosting/plataforma-pruebas>

Capturas en `00-Registro CDMON/`

- [x] 00-01-formulario-alta.png
- [ ] 00-02-email-activacion.png
- [ ] 00-03-primer-acceso-panel.png

---

### 01 - Crear plataforma de pruebas

Desde el panel de CDMON, crear la plataforma con **tu dominio sin `www`**. Aceptar las condiciones y pulsar **"Crear plataforma de prueba"**.

Capturas en `01-Plataforma de pruebas/`

- [ ] 01-01-nueva-plataforma.png
- [ ] 01-02-dominio-sin-www.png
- [ ] 01-03-condiciones-aceptadas.png
- [ ] 01-04-plataforma-creada.png
- [ ] 01-05-configuracion.png

---

### 02 - Instalar WordPress

Desde **Configuración** de la plataforma, bajar hasta **Aplicaciones → Wordpress**, instalar y aceptar las políticas.

Llega un email con la URL `/wp-admin` y el usuario y contraseña de WordPress. **Copiarlo todo al doc de Google.**

Capturas en `02-Instalar WordPress/`

- [ ] 02-01-aplicaciones-wordpress.png
- [ ] 02-02-instalando.png
- [ ] 02-03-aceptar-politicas.png
- [ ] 02-04-wordpress-instalado.png
- [ ] 02-05-email-url-credenciales.png

---

### 03 - Acceso a WordPress

Abrir la URL del email en el navegador e introducir usuario y contraseña de WordPress. Debe aparecer el **Escritorio**.

Capturas en `03-Acceso a WordPress/`

- [ ] 03-01-doc-google-claves.png
- [ ] 03-02-login-wp-admin.png
- [ ] 03-03-escritorio-wordpress.png

---

### 04 - Tema Astra

Tema base de la web. **Apariencia → Temas → Añadir nuevo →** buscar `Astra` → **Instalar y activar**.

- Ficha: <https://wordpress.org/themes/astra/>

Capturas en `04-Tema Astra/`

- [ ] 04-01-apariencia-temas.png
- [ ] 04-02-anadir-nuevo-tema.png
- [ ] 04-03-buscar-astra.png
- [ ] 04-04-instalar-activar.png
- [ ] 04-05-astra-activo.png

---

### 05 - Plugin Elementor

Constructor visual de páginas. **Plugins → Añadir nuevo →** buscar `Elementor` → **Instalar y activar**.

- Ficha: <https://wordpress.org/plugins/elementor/>

Capturas en `05-Plugin Elementor/`

- [ ] 05-01-plugins-anadir-nuevo.png
- [ ] 05-02-buscar-elementor.png
- [ ] 05-03-instalar-activar.png
- [ ] 05-04-elementor-lista.png

---

### 06 - Header y Footer

Crear las plantillas de **cabecera y pie** con Elementor y aplicarlas al tema.

Capturas en `06-Header y Footer/`

- [ ] 06-01-plantillas-elementor.png
- [ ] 06-02-crear-header.png
- [ ] 06-03-header-diseno.png
- [ ] 06-04-header-aplicado.png
- [ ] 06-05-crear-footer.png
- [ ] 06-06-footer-aplicado.png

---

### 07 - Formulario de contacto con WPForms

Plugin **WPForms** → crear el formulario de contacto → guardarlo → insertarlo en la página con el widget de Elementor → darle formato (colores, fondos) desde las pestañas **Contenido**, **Estilo** y **Avanzado**.

- Ficha: <https://wordpress.org/plugins/wpforms-lite/>

Capturas en `07-Formulario WPForms/`

- [ ] 07-01-instalar-wpforms.png
- [ ] 07-02-nuevo-formulario.png
- [ ] 07-03-diseno-campos.png
- [ ] 07-04-configuracion-envio.png
- [ ] 07-05-formulario-guardado.png
- [ ] 07-06-abrir-pagina-elementor.png
- [ ] 07-07-insertar-widget-wpforms.png
- [ ] 07-08-formulario-en-pagina.png
- [ ] 07-09-formato-colores-fondos.png

---

### 08 - Blog con BlogMentor

Plugin **BlogMentor** → instalar y activar → crear la primera entrada del blog.

- Ficha: <https://wordpress.org/plugins/blogmentor/>

Capturas en `08-Blog BlogMentor/`

- [ ] 08-01-instalar-blogmentor.png
- [ ] 08-02-crear-primera-entrada.png
- [ ] 08-03-entrada-con-imagen.png
- [ ] 08-04-blog-publicado.png

---

## Script de apoyo

`practica.ps1` abre Brave directamente en la URL de cada paso y lleva la cuenta de en cuál estás.

```powershell
$p = ".\practica.ps1"

& $p dominio 2bcodewhool.educaand.es   # guarda tu dominio (obligatorio para los pasos 03+)
& $p ver                                # ver el paso actual y sus capturas pendientes
& $p abrir                              # abrir el paso actual en Brave
& $p hacer                              # marcar hecho, avanza al siguiente
& $p atras                              # retroceder un paso
& $p abrir 7                            # saltar a un paso concreto
```

## Cómo hacer las capturas

1. `Win + Shift + S` para capturar la pantalla
2. Abrir **Paint** y pegar (`Ctrl + V`)
3. `Ctrl + S` y escribir el nombre que aparece en la lista de este README, dentro de la carpeta del paso
