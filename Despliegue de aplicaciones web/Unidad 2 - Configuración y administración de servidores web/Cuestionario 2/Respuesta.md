# Cuestionario Unidad 2 (Bloque 2): VirtualHosts, Módulos y Seguridad SSL

**Módulo:** Despliegue de Aplicaciones Web (0614) - 2º DAW  
**Alumno/a:** Javier Jiménez Alonso  
**Fecha:** 22/11/2026

Responde a las catorce cuestiones siguiendo el orden de los apuntes de la
Unidad 2 (páginas 21 a 41).

---

## 1. Resolución local y directivas de VirtualHost

**¿Qué archivo del sistema hay que modificar si no hay un servidor DNS configurado
y qué limitación tiene?**

Hay que modificar **`/etc/hosts`** (en Windows, `C:\Windows\System32\drivers\etc\hosts`).
Es una tabla de traducción nombre → IP que consulta el sistema operativo **antes**
de preguntar al DNS. Añadiendo una línea como

```
127.0.0.1   www.empresa1.com
```

el navegador resuelve ese dominio a la máquina local y llega hasta el virtualhost
de Apache, sin necesidad de tener un servidor DNS propio.

La limitación es que el archivo es **local**: solo afecta al ordenador donde se
edita. Si el sitio lo tienen que probar diez personas o cualquier visitante de
Internet, habría que repetir la línea en las diez máquinas, y no admite
comodines ni delegación de subdominios. Sirve para probar, no para publicar.

**Función de las directivas:**

- **`DocumentRoot`**: indica el directorio del disco del que se sirven los
  archivos de ese sitio. Es la raíz visible del dominio; lo que hay por encima no
  es accesible por HTTP. Por ejemplo, `DocumentRoot /var/www/empresa1`.
- **`ServerName`**: es el nombre principal con el que se identifica el
  virtualhost. En los virtualhosts basados en nombre es la clave: Apache compara
  el nombre pedido en la cabecera `Host` con este valor para decidir qué bloque
  atiende la petición.
- **`ServerAlias`**: nombres alternativos que también deben responder en ese
  mismo virtualhost (`www.empresa1.com`, `empresa1.local`...). Sirve para no
  duplicar el bloque entero por cada variante del nombre.

---

## 2. Directiva `Listen` en Apache

`Listen` dice a Apache **en qué dirección IP y en qué puerto** debe quedarse
escuchando peticiones. Si un puerto no aparece en ningún `Listen`, Apache no
atiende nada por ahí, aunque haya un virtualhost configurado para ese puerto. En
Debian estas líneas están en `/etc/apache2/ports.conf`.

**Escuchar en los puertos 80 y 8080 a la vez** (dos líneas, una por puerto):

```apache
Listen 80
Listen 8080
```

**Escuchar en dos direcciones IP con puertos distintos:**

```apache
Listen 192.168.1.10:80
Listen 10.0.0.5:8080
```

Se pueden poner tantas directivas `Listen` como haga falta; Apache abre un
socket por cada una. Después, dentro de `ports.conf` o en los virtualhosts, hay
que asegurarse de que el `<VirtualHost>` correspondiente usa esa misma pareja
IP:puerto (`<VirtualHost 192.168.1.10:80>`), porque si no, la petición no casa
con ningún bloque.

---

## 3. Tipos de VirtualHosts

| Tipo | Cómo funciona | Inconveniente / cuándo se usa |
|---|---|---|
| **Basados en nombre** | Varios dominios comparten **una sola IP**; Apache distingue por la cabecera `Host` de la petición. | Es el método habitual y el que no tiene pegas: solo necesita un nombre por sitio. |
| **Basados en IP** | Cada sitio tiene **su propia dirección IP** y Apache distingue por la IP de destino. | Su inconveniente principal es que **consume una IP por cada sitio**: las IPv4 públicas son escasas y caras, y la configuración se complica cuando hay que añadir o mover direcciones. |
| **Varios servidores principales** | Se ejecutan **varias instancias de Apache**, cada una con su propio `apache2.conf` y sus propios módulos y usuarios. | Solo tiene sentido cuando los sitios necesitan **configuraciones totalmente independientes** (distinta versión de Apache, distintos módulos, distintos usuarios del sistema o aislamiento por seguridad). Para sitios normales es un desperdicio de recursos. |

---

## 4. Gestión de módulos en Debian

**Instalado** significa que los archivos del módulo están en el disco, dentro de
`/etc/apache2/mods-available/` (y la librería `.so` en su ruta). **Habilitado**
significa que Apache lo **carga al arrancar**, porque existe un enlace en
`/etc/apache2/mods-enabled/`.

Comandos:

```bash
a2enmod ssl        # habilitar
a2dismod ssl       # deshabilitar
```

**Qué ocurre exactamente en los directorios:**

- Al ejecutar `a2enmod ssl` se crean **enlaces simbólicos** en
  `/etc/apache2/mods-enabled/` que apuntan a los archivos del mismo nombre en
  `/etc/apache2/mods-available/` (`ssl.load` y `ssl.conf`). No se copia nada: se
  enlaza.
- Al ejecutar `a2dismod ssl` se **borran esos enlaces** de
  `mods-enabled/`. Los archivos originales de `mods-available/` siguen ahí.

Como `apache2.conf` incluye todo lo que haya en `mods-enabled/`, un módulo
deshabilitado simplemente desaparece de esa carga. Después hay que recargar el
servicio para que el cambio surta efecto.

---

## 5. Habilitación de sitios virtuales (`a2ensite`)

Los ficheros de configuración de los virtualhosts se guardan en
**`/etc/apache2/sites-available/`**. Cada sitio tiene allí su propio `.conf`.

`a2ensite` activa uno de esos sitios: crea en
**`/etc/apache2/sites-enabled/`** un enlace simbólico al archivo
correspondiente de `sites-available`. El servidor solo lee lo que está en
`sites-enabled/`, así que un sitio con su `.conf` en `sites-available` pero sin
enlace **no se sirve**.

`a2dissite` hace lo contrario: borra el enlace de `sites-enabled/` sin tocar el
archivo original, que queda disponible por si se quiere volver a activar. En los
dos casos hay que recargar Apache después.

---

## 6. Ficheros `.conf` y `.load` y recarga del servicio

En `/etc/apache2/mods-available/` cada módulo suele traer dos archivos:

- **`ssl.load`**: contiene la directiva de carga del módulo, es decir, la línea
  `LoadModule ssl_module /usr/lib/apache2/modules/mod_ssl.so`. Es lo que hace
  que Apache cargue la librería en memoria.
- **`ssl.conf`**: contiene la **configuración** que ese módulo necesita, como
  `SSLRandomSeed`, `SSLSessionCache` o los ajustes por defecto del motor SSL.
  No carga nada: solo ajusta cómo funciona el módulo una vez cargado.

**`restart` frente a `reload`:**

- **`/etc/init.d/apache2 restart`** (o `systemctl restart apache2`) **para el
  proceso y lo arranca de nuevo**. Se pierden las conexiones abiertas y hay un
  instante en el que el servidor no atiende. Es lo que se usa cuando se cambia
  algo que no se puede aplicar en caliente.
- **`/etc/init.d/apache2 reload`** (o `systemctl reload apache2`) manda al
  proceso la orden de **volver a leer la configuración sin dejar de atender**.
  Es más rápido y no corta a los usuarios conectados, así que es lo normal
  después de `a2ensite`, `a2enmod` o de editar un `.conf`.

Si después de un `reload` el cambio no aparece, o el módulo es nuevo, se usa
`restart` para asegurarse.

---

## 7. Habilitación manual de módulos

Si no existieran `a2enmod` y `a2dismod`, el trabajo que hacen es exactamente
crear o borrar enlaces simbólicos. Para habilitar `ssl` a mano:

```bash
cd /etc/apache2/mods-enabled
ln -s ../mods-available/ssl.load ssl.load
ln -s ../mods-available/ssl.conf ssl.conf
```

Y para deshabilitarlo, borrar los enlaces:

```bash
rm /etc/apache2/mods-enabled/ssl.load
rm /etc/apache2/mods-enabled/ssl.conf
```

**El paso obligatorio es recargar el servicio** (`/etc/init.d/apache2 reload`, o
`restart`). Crear el enlace no cambia nada por sí solo: Apache lee los
`mods-enabled` al arrancar o al recargar, así que hasta ese momento el módulo
sigue sin estar activo.

---

## 8. Cifrado asimétrico o de clave pública

En el cifrado asimétrico cada parte tiene **dos claves relacionadas
matemáticamente**: una **pública** (`kpub`), que se puede repartir sin problema,
y una **privada** (`kpriv`), que no sale nunca del equipo. Lo que se cifra con
una solo se puede descifrar con la otra.

Entre un navegador **A** y un servidor **B**:

1. **B** genera su pareja de claves y publica su clave pública `kpub_B`. La
   privada `kpriv_B` se queda en el servidor, protegida.
2. **A** obtiene `kpub_B` (en HTTPS, dentro del certificado del servidor) y
   **cifra** con ella el secreto de sesión o el mensaje.
3. El mensaje cifrado viaja por la red. Si alguien lo intercepta, no puede
   leerlo: para descifrarlo haría falta `kpriv_B`, que solo tiene **B**.
4. **B** descifra con `kpriv_B` y lee la información.

La clave pública garantiza la **confidencialidad** (cualquiera puede cifrar,
solo el dueño de la privada descifra) y, usada al revés, la **autenticidad**: si
B firma con `kpriv_B`, cualquiera puede comprobar la firma con `kpub_B` y saber
que efectivamente fue B. Ese es el papel de la clave privada en el certificado:
demostrar que el servidor es quien dice ser.

En la práctica TLS usa el cifrado asimétrico solo al principio, para acordar una
clave simétrica de sesión, porque el asimétrico es mucho más lento.

---

## 9. Rendimiento del cifrado y certificados autofirmados

**Repercusión sobre el servidor:** cifrar cuesta CPU. Cada conexión HTTPS
necesita hacer el intercambio de claves y cifrar/descifrar todo el tráfico, lo
que se traduce en **más consumo de procesador y más latencia** que HTTP, y por
tanto en menos peticiones simultáneas para el mismo hardware. Por eso los
navegadores y servidores modernos negocian una clave **simétrica** para los
datos y reservan el cifrado asimétrico para el saludo inicial, que es mucho más
barato.

**Cuándo es aceptable un certificado autofirmado:** el tema indica que sí puede
usarse cuando **no se necesita la confianza de un tercero**, es decir, en
**redes internas o entornos controlados**: intranet de una empresa, paneles de
administración, servidores de desarrollo y pruebas, o comunicaciones entre
servicios dentro de la misma máquina. En esos casos el cliente se puede
configurar para confiar en el certificado. Para un sitio público, en cambio, no
sirve, porque el visitante verá el aviso de conexión no verificada.

---

## 10. Certificados digitales, AC y AR

Un **certificado digital** es un archivo que **vincula una clave pública con una
identidad** (un dominio, una organización o una persona) y que está **firmado por
una autoridad de confianza**. Incluye el titular, la clave pública, la validez,
el emisor y la firma, y sirve para que el cliente sepa que la clave pública que
está usando pertenece de verdad a ese servidor.

Dentro de una **ICP/PKI**:

- La **Autoridad de Certificación (AC o CA)** es la que **emite y firma** los
  certificados. Es la raíz de confianza: los navegadores llevan su certificado
  instalado. También mantiene las listas de revocación y responde a las consultas
  de estado.
- La **Autoridad de Registro (AR o RA)** es la que **verifica la identidad** del
  solicitante antes de que se emita el certificado: comprueba documentos, datos
  de la empresa o del dominio. **No firma** certificados; solo valida y pasa la
  petición a la AC.

La diferencia, en una frase: la AR comprueba quién eres, la AC lo certifica
firmando.

---

## 11. Servicios de una Infraestructura de Clave Pública

1. **Emisión de certificados**: generar y firmar los certificados que solicitan
   los usuarios y servidores.
2. **Registro y verificación de identidad**: comprobar que quien pide el
   certificado es quien dice ser y que controla el dominio o la organización.
3. **Distribución y publicación**: poner a disposición de los clientes los
   certificados y las claves públicas, y publicar el certificado raíz de la
   propia autoridad.
4. **Revocación y consulta de estado**: retirar un certificado antes de que
   caduque (porque la clave se ha comprometido o el titular ya no es quien era) y
   publicar esa información en listas CRL o mediante OCSP.
5. **Gestión de claves y sellado de tiempo**: custodiar las claves de la propia
   autoridad y dar fe de que un documento existía en una fecha determinada
   (sellado de tiempo), además de dar soporte a la firma electrónica.

---

## 12. Estándar de certificados digitales X.509

El estándar más utilizado es **X.509**, definido por la UIT-T y adoptado por
PKIX (RFC 5280). Es el formato que usan los certificados de servidor web,
de correo y de firma electrónica.

Campos de un certificado X.509 (al menos cinco):

1. **Versión** del formato (normalmente v3).
2. **Número de serie**, único dentro de la autoridad que lo emite.
3. **Algoritmo de firma** utilizado por la autoridad.
4. **Emisor** (*Issuer*): la autoridad que firma el certificado.
5. **Validez**: fecha de inicio (*not before*) y de fin (*not after*).
6. **Titular** (*Subject*): a quién identifica el certificado.
7. **Clave pública del titular** y el algoritmo con el que se usa.
8. **Extensiones** (por ejemplo, los nombres alternativos del dominio) y la
   **firma** de la autoridad al final.

---

## 13. Módulo SSL en Apache

El comando es:

```bash
a2enmod ssl
```

seguido de una recarga del servicio. El módulo es **`mod_ssl`** y se apoya en la
biblioteca **OpenSSL** para todas las operaciones criptográficas.

Proporciona el cifrado de las conexiones mediante **SSL/TLS**: históricamente
SSLv2 y SSLv3, después **TLS 1.0, 1.1 y 1.2**, y en las versiones actuales
**TLS 1.3**. Las versiones antiguas (SSLv2, SSLv3 y TLS 1.0/1.1) están
deshabilitadas por defecto en las instalaciones modernas por considerarse
inseguras.

---

## 14. Servidor virtual seguro en Debian

El archivo que trae la configuración SSL por defecto es
**`/etc/apache2/sites-available/default-ssl`** (en las versiones recientes,
`default-ssl.conf`), que se activa con `a2ensite default-ssl`. Los parámetros
generales del motor están en `/etc/apache2/mods-available/ssl.conf`.

Las tres directivas principales:

- **`SSLEngine on`**: activa el motor SSL para ese virtualhost. Sin ella, el
  bloque ignora el resto de directivas SSL y el sitio responde en claro.
- **`SSLCertificateFile`**: ruta del **certificado público** del servidor
  (incluye la clave pública y la firma de la autoridad).
- **`SSLCertificateKeyFile`**: ruta de la **clave privada** correspondiente, que
  debe estar protegida y solo legible por el usuario de Apache.

**Por qué aparece `sec_error_untrusted_issuer`:** porque el certificado que trae
Debian por defecto es **autofirmado** (lo genera el propio servidor al instalar
`ssl-cert`). El navegador comprueba la cadena de firma y no encuentra ninguna
autoridad de confianza en su almacén que avale ese certificado, así que avisa de
que el emisor no es de confianza. El cifrado funciona, pero no hay una tercera
parte que garantice que ese certificado pertenece al dominio; el aviso
desaparece al instalar un certificado emitido por una CA reconocida.
