# Tarea 2 - El cliente, la idea de negocio y los valores éticos y sociales · Solución

**Curso:** Proyecto Intermodular de Desarrollo de Aplicaciones Web  
**Proyecto:** TachoAviso — Control de vencimientos legales para transportistas autónomos y microflotas  
**Estado:** Completado  
**Enunciado:** `Tarea 2 - El cliente, la idea de negocio y los valores eticos y sociales.md`

---

## 1. Segmento de mercado y early adopters

### 1.1. Problemas actuales de los early adopters

El transportista autónomo y la microflota tienen un problema que no es de tecnología, sino de **memoria y de tiempo**: ningún plazo les avisa solo. Los problemas concretos que declaran son:

1. **Olvido de las descargas del tacógrafo.** La tarjeta del conductor se descarga cada **28 días** (56 en tacógrafos G2V2) y la unidad del vehículo cada **90 días**. Son plazos que no coinciden con ninguna fecha "redonda" y se pasan sin darse cuenta.
2. **Fechas legales dispersas en papeles distintos.** La ITV está en un papel, el seguro en la póliza, la tarjeta del conductor en la guantera y las descargas en la cabeza. No existe un único sitio donde verlo todo.
3. **Miedo a la sanción.** El incumplimiento de los plazos de descarga se considera **infracción grave** y se traduce en multas que en un autónomo pueden borrar el margen de varios meses.
4. **Dependencia de la gestoría o de la familia.** Muchos llevan las fechas "como pueden", con avisos de la asesoría, con una alarma del móvil o con la ayuda de su pareja. Si esa persona falla o cambia de gestoría, se pierde el control.
5. **Poco tiempo y poca paciencia digital.** Trabajan 10–12 horas al día, muchas veces desde la cabina. No van a aprender un programa complejo ni a rellenar formularios largos: si la herramienta no es inmediata, la abandonan.
6. **Desconfianza con los datos.** No quieren subir ficheros del tacógrafo ni dar datos personales de sus conductores a un servicio que no conocen.

### 1.2. Criterios de segmentación que realmente sirven

| Criterio | ¿Ayuda a segmentar mi producto? | Por qué |
|---|---|---|
| **Geográfico** | **Sí, mucho** | El nicho es local: Bahía de Algeciras y Campo de Gibraltar, con el puerto de Algeciras como motor (más de 200.000 camiones al año entre Algeciras y Tánger Med). Permite captar clientes en persona, en talleres, asociaciones y areas de descanso. |
| **Demográfico** | Poco | La edad o el sexo no cambian la necesidad: cambia el número de vehículos. |
| **Renta** | Sí, indirectamente | Son negocios con márgenes ajustados: el precio tiene que ser bajo (unos 4–6 €/mes), pero una multa evitable justifica el gasto. |
| **Profesión / sector** | **Sí, es el criterio principal** | Solo tiene sentido para quien tenga tacógrafo y vehículos sujetos a ITV, seguro y tarjeta: transporte de mercancías por carretera. |
| **Particular o empresa** | **Sí** | Autónomo (1–2 vehículos) y microempresa (3–10) tienen la misma necesidad pero distinto volumen; las asesorías son un tercer tipo de cliente. |
| **Rasgos psicológicos** | Sí | El cliente que ya ha sido sancionado o que es prudente por naturaleza valora el aviso automático; el que "nunca le pasa nada" es más difícil de convencer. |
| **Gustos / hábitos digitales** | Sí | Usa el móvil y WhatsApp a diario, pero no herramientas de gestión complejas: la sencillez es requisito, no un extra. |
| **Criterio propio: tamaño de flota** | **Sí, es el criterio que define el producto** | Determina cuántos vehículos y conductores hay que vigilar y, por tanto, el plan y el precio. |
| **Criterio propio: volumen de plazos por año** | Sí | Un vehículo genera 4–6 vencimientos anuales; con 3 vehículos el control manual ya es inviable y el dolor es mayor. |

### 1.3. Segmento de mercado y cliente objetivo

**Segmento principal:** transportistas autónomos y microempresas de transporte de mercancías por carretera de la Bahía de Algeciras y el Campo de Gibraltar, con **entre 1 y 10 vehículos**, que trabajan habitualmente con el puerto y con la frontera de Tánger Med.

**Cliente objetivo:** hombre o mujer de **35 a 55 años**, autónomo o socio de una microempresa familiar, con **1 a 3 camiones** y, en ocasiones, un conductor contratado. Nivel digital básico (móvil, WhatsApp, correo), acostumbrado a resolver los trámites con papel, Excel o la gestoría. Facturación ajustada y muy sensible al coste de una sanción.

**Segmento secundario:** **asesorías y gestorías** que llevan la documentación de varios transportistas y necesitan una herramienta común para no olvidar plazos de clientes distintos. No será el foco del MVP, pero es la vía natural de crecimiento.

**Estrategia de segmentación:** **concentrada**. TachoAviso no intenta ser un software de gestión de flotas para todo el mercado: se concentra en un nicho muy concreto (transporte ligero del Campo de Gibraltar) y resuelve una sola cosa muy bien. Dentro del nicho, el mismo producto se ofrece con dos límites de vehículos (Autónomo / Microflota), que es una diferenciación de precio, no de producto.

**Early adopters:** el autónomo de 1–2 camiones que **ya ha recibido un aviso, una multa o un susto** por un plazo olvidado. Le caracteriza:

- tiene entre 35 y 55 años y lleva años en el sector, pero poca herramientas digital;
- controla las fechas con la libreta, el calendario del móvil o la gestoría;
- ha vivido de cerca una sanción o conoce a alguien que la ha sufrido;
- busca algo **barato, en español, que no haya que instalar** y que le avise por correo;
- está dispuesto a probar si se lo cuenta alguien de confianza del sector (taller, asociación, compañero).

### 1.4. Estudio de los clientes

**a) Problemas que encuentran en productos parecidos**

- **TachoTools y similares:** exigen **subir los ficheros `.DDD` / `.TGD`** del tacógrafo, algo que al autónomo le da desconfianza (datos del conductor en un servidor ajeno) y que además llega **tarde**: analiza lo que ya pasó, no avisa de lo que viene. Tampoco cubre ITV ni seguro.
- **Software de flotas (Transportes, SAP, etc.):** pensado para flotas grandes, con implantación, formación y precios mensuales altos. Para 2 camiones es desproporcionado.
- **Excel y Google Calendar:** gratis, pero **no avisan solos** y se olvidan de actualizar; además nadie los revisa.
- **La gestoría:** resuelve el papeleo, pero el cliente no ve el estado de sus plazos ni tiene la información en tiempo real, y pagar más horas de asesoría no siempre es posible.

**b) ¿Qué producto usan actualmente? ¿Quién, dónde, cuándo y cuánto compra?**

| Aspecto | Situación actual |
|---|---|
| **Qué** | Libreta o agenda, hoja de Excel, alarmas del móvil, calendario de pared, avisos de la gestoría, la memoria. |
| **Quién** | El propio autónomo o su pareja/familiar que lleva la oficina; en microflotas, el encargado o la gestoría. |
| **Dónde** | En la cabina del camión, en casa o en una pequeña oficina. |
| **Cuándo** | Al renovar el seguro o la ITV, al recibir un aviso de la gestoría o cuando ya llega la carta de la inspección. |
| **Cuánto** | 0 € en herramientas propias (pero con coste en tiempo y riesgo) o **30–60 €/mes** de gestoría; los que ya usan un servicio tipo TachoTools pagan **3–5 €/mes**. |

**c) ¿Por qué motivos lo compran?**

- Para **evitar la multa** y el mal rato de una inspección.
- Para **dejar de depender de la memoria** y de "ya me avisará alguien".
- Para **tener tranquilidad** y poder demostrar que cumplen.
- Porque alguien de confianza del sector se lo ha recomendado.

**d) ¿Cómo preferirían que fuese ese producto?**

- **Muy simple**: registrar el vehículo y una fecha y listo, sin subir ficheros.
- **En español** y con lenguaje del sector (no "activos" ni "compliance").
- **Desde el móvil**, sin instalar nada.
- Con **avisos por correo** (y, más adelante, por WhatsApp) con antelación suficiente.
- **Barato**, sin permanencia y con posibilidad de darse de baja sin llamar a nadie.
- Que **no pida datos personales** de los conductores: un alias es suficiente.

---

## 2. Idea de negocio

**a) Actividad**

TachoAviso es una **aplicación web** (landing pública + área privada, desarrollada como plugin de WordPress a medida en PHP y JavaScript) que **calcula y avisa de los vencimientos legales** de un transportista: descargas del tacógrafo (28/56/90 días), ITV, seguro y tarjeta del conductor. El usuario da de alta sus vehículos y conductores (identificados por un **alias**) y las fechas de referencia; la aplicación calcula sola el siguiente vencimiento, lo muestra en un panel con semáforo (verde, ámbar, rojo) y envía avisos por correo con antelación configurable (30, 15 y 7 días por defecto).

No se vende un programa: se vende **un servicio de recordatorio** al que se accede desde el navegador.

**b) Clientes**

Se vende a **transportistas autónomos y microflotas de 1 a 10 vehículos** de la Bahía de Algeciras y, como segmento secundario, a **asesorías** que gestionan la documentación de varios clientes.

**¿Están dispuestos a pagar?** Sí, y ya lo demuestran: existe un competidor (TachoTools) que cobra **3–5 €/mes** por un servicio del mismo nicho, y los propios transportistas pagan 30–60 €/mes de gestoría. El precio del MVP se plantea en **4–6 €/mes**, por debajo del coste de una sola multa y en la franja que el mercado ya tolera.

**c) Problema o necesidad que cubre**

Cubre el **riesgo de olvidar un plazo legal** y su consecuencia económica. La necesidad no es "digitalizar la flota" (eso ya lo hacen las grandes), sino **no perder una fecha**: la descarga del tacógrafo, la ITV, el seguro o la tarjeta. Es una necesidad de **tranquilidad y de cumplimiento**, y se resuelve con un aviso a tiempo, no con un informe.

**d) Propuesta de valor**

> **Para el transportista autónomo que no puede permitirse una multa por un plazo olvidado, TachoAviso vigila sus vencimientos legales y le avisa por correo antes de que caduquen, sin subir ficheros del tacógrafo y sin ceder datos personales de sus conductores.**

Se diferencia de la competencia en tres cosas concretas:

1. **Enfoque preventivo, no retrospectivo.** TachoTools analiza lo que ya ha pasado; TachoAviso avisa de lo que viene.
2. **Huella de datos mínima (RGPD).** No se suben ficheros `.DDD` ni nombres de conductores: solo un alias y unas fechas. Se elimina el riesgo de tratar datos personales sensibles.
3. **Cobertura más amplia.** No solo las descargas del tacógrafo: también **ITV, seguro y tarjeta del conductor**, que los competidores del nicho no tocan.

Y con tres reglas de producto que refuerzan la promesa: **sencillo** (menos de dos minutos para dar de alta un vehículo), **barato** (sin permanencia) y **en español**, con el lenguaje del sector.

**e) Objetivo a 1 año**

El objetivo realista del primer año **no es ganar dinero, es cubrir gastos y validar que el producto se usa**:

| Objetivo | Meta a 12 meses |
|---|---|
| Producto | MVP desplegado, con registro, vehículos, conductores, motor de vencimientos, panel, avisos por correo y CSV |
| Usuarios | **30–40 cuentas activas** (autónomos y microflotas de la comarca) |
| Ingresos | Unos **120–200 €/mes** con cuota de 4–5 €/mes, suficientes para cubrir el coste de explotación (66–132 €/año de hosting y dominio) |
| Retención | Que **al menos el 70 %** de los usuarios siga activo a los 3 meses: es la prueba de que el aviso sirve |
| Validación | 5 entrevistas con transportistas y 1 acuerdo con un taller o asociación local para captar los primeros clientes |

Traducido: **cubrir gastos y demostrar que hay demanda**, no obtener un sueldo todavía.

---

## 3. Indicadores y elementos sociales del balance social

Se incorporan tres elementos del balance social, con ejemplos concretos y medibles:

**1. Privacidad y minimización de datos (transparencia y buen gobierno).**

- **Compromiso:** TachoAviso solo guarda lo imprescindible: alias del conductor, matrícula y fechas. No se suben ficheros del tacógrafo ni se piden nombres, DNI o teléfonos.
- **Ejemplo concreto:** la política de privacidad se escribe en dos niveles (resumen de una página + texto completo), se publica la lista de datos tratados y se ofrece un botón de **"descargar mis datos"** y otro de **"borrar mi cuenta y todos mis datos"** que funciona sin escribir a nadie.
- **Indicador:** *nº de datos personales tratados por cuenta* (objetivo: 3) y *tiempo medio de respuesta a una solicitud de supresión* (objetivo: menos de 24 h).

**2. Accesibilidad e inclusión digital (elemento social).**

- **Compromiso:** la aplicación se diseña para que la use cualquiera, incluido un transportista de 55 años con poca vista o que entra desde el móvil en la cabina.
- **Ejemplo concreto:** contraste y tamaño de letra conformes a **WCAG 2.1 AA**, botones grandes, formularios de un solo paso, textos en lenguaje claro (sin "dashboard", "compliance" ni "onboarding") y funcionamiento sin ratón.
- **Indicador:** *puntuación de accesibilidad* (objetivo: 100 en Lighthouse y 0 errores críticos en una auditoría manual) y *nº de pasos para dar de alta un vehículo* (objetivo: 3).

**3. Compras sostenibles y apoyo al entorno local (elemento medioambiental y social).**

- **Compromiso:** el servicio se aloja en un proveedor con **energía renovable** y servidores en Europa, y el negocio se apoya en el tejido local.
- **Ejemplo concreto:** hosting con certificado de energía verde y centro de datos en la UE; acuerdos con **talleres y asociaciones de transportistas del Campo de Gibraltar** para difundir la herramienta; una **charla anual gratuita** sobre plazos de tacógrafo y sanciones; y descuento del 50 % a autónomos en situación de baja actividad.
- **Indicador:** *% de proveedores tecnológicos con certificación ambiental* (objetivo: 100 %) y *nº de autónomos formados en las charlas* (objetivo: 40 al año).

---

## 4. Texto para el plan de empresa

TachoAviso nace de un problema muy concreto del entorno en el que vivo: en la Bahía de Algeciras el transporte de mercancías mueve más de 200.000 camiones al año, y la mayoría de esos camiones no pertenecen a grandes flotas, sino a autónomos y microempresas de una a diez unidades. Estos transportistas tienen que vigilar a la vez la tarjeta del conductor, la descarga del tacógrafo (cada 28, 56 o 90 días), la ITV, el seguro y la tarjeta del conductor, y lo hacen con una libreta, una hoja de Excel, alarmas del móvil o los avisos de la gestoría. El resultado es que un plazo se olvida, y olvidarlo se considera infracción grave: una multa puede borrar el margen de varios meses de trabajo.

El segmento al que me dirijo es, por tanto, un nicho: transportistas autónomos y microflotas de una a diez unidades de la comarca, con un perfil muy definido. Son personas de 35 a 55 años, con un negocio familiar, nivel digital básico y márgenes ajustados, que valoran la sencillez por encima de cualquier función avanzada. El criterio que mejor los clasifica no es la edad ni el sexo, sino el **número de vehículos** y el **volumen de plazos que generan al año**: con un solo camión el control manual aún es posible; con tres, ya es una lotería. La estrategia es **concentrada**: no quiero competir con los grandes software de flotas, quiero resolver una sola cosa muy bien para un grupo muy concreto. Mis *early adopters* son los autónomos que ya han recibido un aviso, una multa o un susto por un plazo olvidado: son los que entienden el problema en diez segundos y los que pueden recomendarlo en el taller o en la asociación del sector.

Al estudiar a esos clientes aparece el hueco. Los productos parecidos tienen tres fallos: los que analizan el tacógrafo exigen **subir ficheros** con datos del conductor, algo que genera desconfianza y que además llega tarde, porque analizan lo que ya ha pasado; los software de flotas son **caros y complejos** para dos camiones; y el Excel y el calendario **no avisan solos**. Por eso TachoAviso se define al revés que la competencia: es **preventivo** (avisa de lo que viene, no analiza lo que pasó), **minimiza los datos** (alias y fechas, sin ficheros ni nombres) y **cubre más plazos** (no solo el tacógrafo, también ITV, seguro y tarjeta). Su propuesta de valor es exactamente esa: *para el transportista autónomo que no puede permitirse una multa por un plazo olvidado, TachoAviso vigila sus vencimientos legales y le avisa por correo antes de que caduquen, sin subir ficheros del tacógrafo y sin ceder datos personales de sus conductores*.

El negocio se plantea con los pies en el suelo. El MVP se desarrolla como plugin de WordPress con PHP y JavaScript, se despliega en un hosting de unos 66–132 € al año y se cobra a **4–6 € al mes**, por debajo del precio de una sola multa y en la franja que el mercado ya tolera (el competidor directo cobra 3–5 €). El objetivo del primer año **no es ganar un sueldo, sino cubrir gastos y demostrar que el producto se usa**: 30–40 cuentas activas, unos 120–200 € al mes de ingresos, un 70 % de retención a los tres meses, cinco entrevistas con transportistas y un acuerdo con un taller o una asociación local para captar a los primeros clientes. Si esos números se cumplen, el segundo año se puede plantear crecer hacia asesorías y hacia otras comarcas con puerto.

Por último, el proyecto incorpora desde el diseño tres elementos del balance social. El primero es la **privacidad**: solo se guardan tres datos por cuenta (alias, matrícula y fechas), la política se escribe en lenguaje claro y el usuario puede descargar o borrar todo con un botón. El segundo es la **accesibilidad**, entendida como inclusión digital: contraste y tamaño de letra conformes a WCAG 2.1 AA, botones grandes, formularios de un solo paso y lenguaje del sector, para que lo use también un transportista de 55 años desde la cabina. El tercero son las **compras sostenibles y el apoyo al entorno**: hosting con energía renovable y servidores en Europa, acuerdos con talleres y asociaciones del Campo de Gibraltar, una charla anual gratuita sobre plazos y sanciones y un descuento del 50 % para autónomos en baja actividad. No son adornos: son la forma de que un negocio pequeño compita por confianza en un sector donde la confianza es el único marketing que funciona.

---

> **Nota:** Respuesta lista para entregar en Moodle (Proyecto Intermodular, Tarea 2).
> Enlace del enunciado: https://educacionadistancia.juntadeandalucia.es/centros/cadiz/mod/assign/view.php?id=455539
