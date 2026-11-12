# Tarea 3: El entorno y la competencia

Responde a todas las actividades, basándote en tu proyecto de empresa:

## 1. Analiza el macroentorno de tu proyecto emprendedor respondiendo a las siguientes preguntas (análisis del macroentorno o PEST):

**a) Políticos: ¿Hay estabilidad política y social? ¿Hay subvenciones?**

España es un país de la Unión Europea con democracia estable y con un marco normativo que no va a desaparecer de un día para otro. Para TachoAviso eso es importante por dos motivos. El primero es que el negocio nace precisamente de una obligación legal: el Reglamento (CE) 561/2006 y la normativa del tacógrafo obligan a descargar los datos de la tarjeta del conductor y de la unidad del vehículo cada 28, 56 o 90 días, y a pasar la ITV y mantener el seguro. Si esa normativa cambiara de golpe, el producto perdería parte de su sentido. El segundo es que un entorno estable permite planificar a medio plazo: puedo invertir en una landing, en un hosting y en el plugin sin miedo a que cambie el marco legal cada pocos meses.

La parte política también trae oportunidades. Las administraciones llevan años impulsando la digitalización de pymes y autónomos con programas de ayudas (por ejemplo, el Kit Digital en sus distintas convocatorias) y con planes de modernización del transporte. No puedo contar con una subvención concreta para montar el negocio, porque las convocatorias cambian y no siempre están abiertas, pero sí es razonable pensar que un transportista tenga parte del coste cubierto o que valore más digitalizarse si ha recibido una ayuda. La parte negativa es la carga burocrática: darse de alta como autónomo, cumplir la LSSI-CE y el RGPD, publicar aviso legal y política de cookies y gestionar las facturas. Para un proyecto unipersonal es trabajo real, aunque es un coste de tiempo más que de dinero.

En resumen: **estabilidad política y social alta**, con normativa favorable al nicho y ayudas posibles pero no garantizadas; la burocracia es la principal pega.

**b) Económicos: ¿Existe crisis en tu sector? ¿Hay desempleo?**

El transporte por carretera es un sector de márgenes ajustados y muy sensible al precio del gasóleo, a los tipos de interés y a la marcha del comercio. En la Bahía de Algeciras el volumen de trabajo no depende solo del consumo interno: el puerto mueve más de 200.000 camiones al año y buena parte del negocio viene del tráfico de mercancías y del paso del Estrecho. Eso da estabilidad de demanda, pero no garantiza margen: una subida del combustible o una bajada de fletes se nota en el bolsillo del autónomo casi de inmediato.

No considero que el sector esté «en crisis» en el sentido de que desaparezca; está en **transformación y con presión de costes**. El número de autónomos y microempresas se mantiene, pero cada euro cuenta. Por eso el precio de TachoAviso (4-6 €/mes) tiene que ser menor que el coste de una sola multa y tiene que poder compararse con lo que el cliente ya paga: nada en Excel, 30-60 €/mes de gestoría o 3-5 €/mes si ya usa un servicio como TachoTools.

El desempleo es otro dato del entorno. Andalucía tiene una de las tasas más altas de España y el mercado laboral es especialmente duro para los perfiles con menos cualificación. En el transporte, en cambio, hay escasez de conductores profesionales, y eso convive con el desempleo general: son dos problemas distintos. Para TachoAviso el desempleo influye sobre todo en el **coste de oportunidad del cliente**: si el negocio va justo, cualquier gasto nuevo se mira dos veces, y por eso la venta tiene que apoyarse en el riesgo de la multa y no en «modernizar por modernizar».

**c) Sociales: ¿Están cambiando los gustos de los clientes?**

El cliente típico de TachoAviso es un transportista de 35 a 55 años, autónomo o socio de una microempresa familiar, con nivel digital básico: usa el móvil, el correo y WhatsApp, pero no es un usuario avanzado. Sus hábitos están cambiando, aunque despacio. Cada vez más trámites se hacen por internet (la sede electrónica de la DGT, la Seguridad Social, la banca), y la pandemia acostumbró a mucha gente a resolver cosas sin ir a una oficina. Ese cambio es una oportunidad: el cliente ya acepta que un aviso le llegue por correo.

Al mismo tiempo hay dos frenos sociales claros. El primero es la **desconfianza a subir datos**: al transportista le preocupa que sus ficheros del tacógrafo o los datos de sus conductores acaben en un servidor ajeno. Por eso TachoAviso no pide nombres, DNI ni teléfonos, y no sube ficheros: solo alias, matrícula y fechas. El segundo es la **costumbre**: la libreta y el calendario del móvil funcionan y son gratis, así que el producto tiene que demostrar en diez segundos que merece la pena cambiar.

También cambia la forma de trabajar. La digitalización del transporte, el uso de la firma electrónica y la presión por cumplir plazos hacen que el cliente valore cada vez más un sistema que le avise antes de que sea tarde. La accesibilidad es otra tendencia social: hacer una web sencilla, con letra grande y sin pasos innecesarios, no es solo una obligación moral, es lo que necesita un usuario que coge el móvil con las manos sucias en la cabina del camión.

**d) Tecnológicos: ¿Hay cambios tecnológicos que influyen en mi empresa?**

La tecnología es el factor que más favorece a un proyecto como este. Hoy se puede montar una aplicación web con WordPress, PHP y JavaScript por muy poco dinero: el hosting cuesta entre 66 y 132 € al año y el dominio unos pocos euros. No hace falta comprar servidores ni instalar nada en el camión. El cliente entra con el móvil o el ordenador, da de alta el vehículo y las fechas, y recibe los avisos por correo.

Los cambios tecnológicos que más me afectan son cuatro:

- **La nube y el hosting barato**: permiten ofrecer el servicio sin inversión en infraestructura propia.
- **El correo electrónico**: es el canal de aviso, y depende de que los proveedores (Gmail, Outlook, etc.) no lo manden a spam. Hay que cuidar la configuración del dominio, el SPF, el DKIM y el DMARC.
- **El móvil**: la mayoría de los clientes van a usar la aplicación desde el teléfono, así que la web tiene que ser responsive y ligera.
- **El tacógrafo inteligente de segunda generación y la digitalización del sector**: cada vez hay más datos y más trámites electrónicos, lo que refuerza la necesidad de controlar plazos.

La inteligencia artificial también está entrando en el sector (análisis de ficheros, asistentes, clasificación de documentos). No forma parte del MVP, pero es una tecnología a vigilar: un competidor podría usarla para leer un `.DDD` o para responder dudas automáticamente. La obsolescencia tecnológica es real: una versión antigua de WordPress o de un plugin es una puerta abierta, y hay que actualizar.

**Conclusión del PEST:** el macroentorno es **favorable**. La obligación legal crea la necesidad, la tecnología abarata la solución, la sociedad acepta cada vez más los trámites digitales y la economía aprieta lo suficiente como para que un precio bajo sea un argumento, pero no tan bajo como para que el cliente no pague nada. Los riesgos son la burocracia, la dependencia del correo y la competencia de lo gratuito.

## 2. Analiza el microentorno de tu proyecto emprendedor respondiendo a las siguientes preguntas:

### 1°) ¿Cuál crees que es el grado de competencia entre las empresas actuales?

**a) ¿Hay muchas o pocas empresas sobre este negocio?**

Pocas. En el nicho concreto de «avisar de los vencimientos legales del transportista» no hay un mercado saturado. El competidor más directo que he encontrado es TachoTools, una empresa pequeña de Barcelona que analiza ficheros del tacógrafo y cobra 3-5 €/mes. Hay también software de flotas y gestorías, pero no ofrecen lo mismo: unos se centran en la telemática y otras en el papeleo. Lo que sí abunda es el sustituto gratuito: la libreta, el Excel y el calendario del móvil.

**b) ¿Está creciendo el sector?**

Sí, en el sentido de que la digitalización del transporte avanza y cada vez más trámites son electrónicos. El número de camiones que pasan por la Bahía de Algeciras (más de 200.000 al año) indica que el mercado potencial existe y no depende de modas. No es un sector que crezca a doble dígito, pero tampoco es un mercado que se esté muriendo: es un nicho estable con demanda recurrente.

**c) ¿Tu producto es similar a otros del mercado?**

Se parece en el problema que resuelve (no olvidar plazos) pero no en el enfoque. TachoTools analiza lo que ya ha pasado a partir de los ficheros; TachoAviso avisa de lo que viene a partir de fechas. La competencia directa real para el cliente es el Excel: gratis, conocido y sin aprender nada nuevo. Mi producto es similar en la función («que no se me olvide»), distinto en la forma (aviso automático por correo) y más amplio en el alcance (tacógrafo, ITV, seguro y tarjeta).

**d) ¿Las otras empresas pueden vender más de lo que venden?**

Sí. TachoTools declara más de 25 empresas y más de 700 conductores al mes, pero son cifras de su propia web, no auditadas. Es una empresa joven, con un producto en evolución («Dashboard 2.0» en desarrollo), y tiene margen para crecer. Las gestorías también pueden crecer, pero su modelo es de horas y no escala igual. El mercado no está copado: hay espacio para un producto sencillo y barato.

**e) ¿Qué barreras de salida existen si tuvieras que dejar el negocio?**

Pocas, y eso es a la vez bueno y malo. No hay fábrica, ni stock, ni hardware, ni contratos de permanencia con clientes. Si el proyecto no funciona, se deja de pagar el hosting y se cierra la web; la inversión perdida es pequeña (el tiempo y los 66-132 €/año del hosting). Esa facilidad para salir también significa que otros pueden entrar con la misma facilidad, así que la barrera tiene que ser el producto y la confianza, no el capital.

### 2°) ¿Hay posibilidad de que entren nuevos competidores?

**a) ¿Cuánto tendrían que invertir para entrar?**

Poco. Con WordPress, un hosting de 66-132 €/año y un plugin a medida se puede montar un MVP como el mío. Un competidor con conocimientos técnicos podría hacerlo en semanas. La inversión real no es el software: es el tiempo de desarrollarlo, el marketing para que te conozcan y la confianza para que alguien te dé sus datos.

**b) ¿Pueden ofrecer un producto distinto del tuyo?**

Sí, y de hecho es lo que hace TachoTools: un producto complementario, centrado en analizar ficheros y calcular multas. También pueden aparecer productos gratuitos o integrados en el software de la gestoría. La diferenciación de TachoAviso no es tecnológica (cualquiera puede programar un calendario con avisos), es de enfoque: preventivo, con huella mínima de datos y cubriendo más plazos.

**c) ¿Pueden acceder a los canales de distribución, mayoristas, minoristas, clientes, etc.?**

Sí. Internet está abierto a todos y las asesorías, talleres y asociaciones son accesibles para cualquiera que llame a su puerta. No hay un canal cerrado ni un distribuidor exclusivo. Por eso la ventaja tiene que construirse con relaciones locales (talleres, asociaciones, gestorías) y con contenido útil, no con exclusividades.

**d) ¿Se necesitan requisitos legales exigentes?**

No para entrar, pero sí para quedarse. Cualquiera puede publicar una web, pero para tratar datos personales hay que cumplir el RGPD y la LOPDGDD, publicar aviso legal y política de privacidad, y para usar cookies no exentas hay que pedir consentimiento. No es una barrera que impida entrar, pero sí un coste que muchos competidores descuidan: TachoTools, por ejemplo, carga Google Analytics sin que se vea un banner de consentimiento en la portada, y no envía cabeceras de seguridad como la CSP. Ese descuido es una oportunidad para diferenciarme haciéndolo bien.

### 3°) ¿Hay otros productos que puedan sustituir al tuyo? ¿Qué productos pueden satisfacer la misma necesidad sin llegar a ser lo mismo?

El sustituto más importante es **gratis**: la libreta, la hoja de Excel, el calendario del móvil o la agenda de pared. Cubren la misma necesidad («no olvidarme») y el cliente ya los tiene. Su punto débil es que no avisan solos: si la persona que lleva las fechas se pone mala o se va de vacaciones, el plazo se olvida.

Otros sustitutos son:

- **La gestoría**: lleva el papeleo y avisa, pero cuesta 30-60 €/mes, el cliente no ve el estado de sus plazos en tiempo real y depende de su horario.
- **TachoTools**: analiza los ficheros y avisa de retrasos en las descargas. Es complementario, no sustituto: quien ya lo usa puede seguir usándolo y añadir TachoAviso para ITV, seguro y tarjeta.
- **El software de flotas**: hace mucho más (localización, mantenimiento, conducción), pero es caro y complejo para dos camiones. Para una microflota es desproporcionado.
- **La memoria y el «ya me avisará el taller»**: es el sustituto más peligroso porque no cuesta nada y funciona hasta que falla.

La conclusión es que el enemigo no es la competencia, es la **comodidad de lo gratuito**. El producto tiene que ser tan fácil que sustituir el Excel no dé pereza.

### 4°) ¿Qué poder tienen los proveedores?

**a) ¿Hay muchos proveedores donde elegir?**

Sí. Para hosting hay decenas de opciones (Raiola, SiteGround, CDMON, DonDominio, etc.), para dominio otras tantas y para envío de correo también (Amazon SES, Mailgun, Brevo, el propio SMTP del hosting). Los plugins de WordPress son mayoritariamente gratuitos o de precio bajo. En conjunto, el poder de los proveedores es **bajo**.

**b) ¿Si un proveedor no te gusta, puedes cambiar y comprar otro producto similar?**

Sí, con matices. Cambiar de hosting o de dominio es relativamente fácil si el proyecto está bien montado (copias de seguridad, exportar la base de datos, cambiar los DNS). Cambiar de proveedor de correo también. Lo que no se puede cambiar es el «proveedor» que decide si un correo llega a la bandeja de entrada: Gmail, Outlook y los filtros antispam. Ahí el poder es alto y la dependencia es real.

**c) ¿Le compras gran cantidad de producto al proveedor y ello permite negociar precios, o le compras poco y no hay fuerza para negociar?**

No. TachoAviso compra muy poco: un hosting, un dominio y un plan de correo básico. No hay volumen para negociar precios. La ventaja es que el coste es tan bajo que no hace falta negociar: 66-132 €/año de hosting es asumible incluso con pocos clientes. La desventaja es que no puedo exigir condiciones especiales; si el proveedor sube el precio, tengo que aceptarlo o migrar.

### 5°) ¿Qué poder tienen los clientes a la hora de negociar?

**a) ¿Hay escasos y no puedes negociar mucho?**

No, hay muchos clientes potenciales: más de 200.000 camiones al año pasan por la comarca y la mayoría son autónomos o microempresas. Lo que hay es **muchos clientes pequeños**, cada uno con un pago de 4-6 €/mes. Individualmente no tienen poder de negociación (a nadie le van a hacer un descuento especial por 5 €/mes), pero en conjunto sí: si el producto no convence, se van a Excel y no vuelven.

**b) ¿Pueden comprar otro producto similar al tuyo que cubra su necesidad?**

Sí, y es muy fácil: el Excel es gratis, la libreta también y TachoTools cuesta 3-5 €/mes. El coste de cambio es bajo, así que la retención tiene que ganarse cada mes con el servicio. La ventaja es que, una vez que el cliente ha metido sus vehículos y sus fechas, volver a la libreta le cuesta trabajo; ahí está la verdadera barrera.

**c) ¿Te compran mucho los clientes y tienen poder para negociar precios?**

No compran mucho individualmente y el precio es bajo, así que no hay una negociación clásica. Pero son muy sensibles al precio y comparan con «gratis». El poder real del cliente es el de **decidir no pagar**: si no ve el valor, no contrata. Por eso el precio tiene que ser inferior al de una multa y el producto tiene que demostrar el ahorro de tiempo desde el primer día.

## 3. Analiza el entorno de tu proyecto emprendedor respondiendo a las siguientes preguntas sobre el entorno sencillo/cambiante:

**a) ¿Es un entorno donde se producen muchos cambios o pocos? ¿Por qué?**

Es un entorno **dinámico en la normativa y la tecnología, pero sencillo en el día a día**. Cambian las normas (tacógrafo, tiempos de conducción, ITV, seguro), cambian las versiones de WordPress y de los plugins y cambian los filtros de correo. Pero el núcleo del negocio no cambia: el transportista sigue teniendo que descargar datos, pasar la ITV y renovar el seguro. No es un sector de modas rápidas como la telefonía; es un sector de obligaciones estables con cambios normativos puntuales.

**b) ¿Se requieren muchos conocimientos para dirigir una empresa de ese sector o no se necesita estar actualizándose constantemente?**

Sí, pero no tantos como en otros sectores tecnológicos. Hay que entender la normativa del tacógrafo y los plazos, saber programar y mantener una web, y conocer el RGPD. No hace falta un equipo de ingenieros: el MVP se puede mantener con WordPress, PHP y JavaScript. Ahora bien, hay que **actualizarse**: una norma nueva o una vulnerabilidad de un plugin puede romper el servicio. La actitud correcta es preactiva: revisar la normativa y las actualizaciones cada cierto tiempo, no esperar a que pase algo.

**c) ¿Se va a vender el producto en un solo mercado o hay distintos mercados donde puede venderse?**

En el MVP se vende en **un solo mercado**: la Bahía de Algeciras y el Campo de Gibraltar. La normativa es la misma en toda España y el producto podría venderse en otras zonas, pero la venta inicial es local porque la confianza y el boca a boca funcionan mejor cerca. Más adelante se puede ampliar a otras comarcas con puerto y, sobre todo, al segmento de asesorías que gestionan clientes de varias provincias.

**d) ¿Hay mucha competencia en el sector y hay que responder con rapidez? ¿En el sector la competencia no para de sacar innovaciones?**

No hay mucha competencia directa, pero sí mucha competencia indirecta (gratuitos, gestorías, software de flotas). No hay una guerra de innovaciones como en las apps de móvil; las novedades llegan poco a poco. Eso permite un desarrollo pausado, pero también significa que no puedo dormirme: si TachoTools añade avisos de ITV o si una gestoría lanza su propia herramienta, perdería el diferencial. La respuesta debe ser rápida en lo que importa (fiabilidad del aviso, facilidad de alta) y lenta en lo accesorio (funciones que no usa nadie).

**Clasificación:** entorno **simple** (pocos factores y fáciles de entender), **dinámico** (normativa y tecnología cambian), **integrado** (misma normativa y misma cultura en el mercado inicial) y **moderadamente favorable** (poca competencia directa, pero un sustituto gratuito muy fuerte). La actitud estratégica es **preactiva**: prever los cambios y avisar antes que el competidor.

## 4. Identificar cuáles son las mejores empresas del sector y qué hacen bien, así como la competencia directa.

En el mercado ya existen empresas que ofrecen ese producto o uno similar. Se trata de preguntarse:

**1°) ¿Quiénes son las mejores empresas de la competencia que ya hacen bien las cosas?**

He mirado tres referencias:

1. **TachoTools** (<https://tachotools.com/>), competidor directo en el nicho del tacógrafo. Es la referencia más cercana y la he analizado a fondo.
2. **Webfleet (Bridgestone)**, plataforma de gestión de flotas con telemática. No compite en mi nicho exacto, pero marca el estándar de lo que un software de flotas ofrece hoy.
3. **Las asesorías y gestorías de transporte de la comarca**, que son la competencia directa real para muchos clientes: llevan los plazos y el papeleo a cambio de una cuota mensual.

No he encontrado en la zona una empresa que haga exactamente lo que hace TachoAviso (avisos de tacógrafo, ITV, seguro y tarjeta en una sola web). Eso es una señal de que el hueco existe, pero también de que el mercado es pequeño y hay que validarlo con clientes reales.

**2°) Después de visitar las webs de la competencia, elige las que creas que son las 2-3 mejores empresas de la competencia.**

De las tres, me quedo con **TachoTools**, **Webfleet** y **las gestorías de transporte**. TachoTools es la mejor en el nicho del tacógrafo y la única que resuelve un problema muy parecido al mío; Webfleet es la mejor en gestión de flotas y sirve para ver qué nivel de servicio espera un cliente cuando paga; y las gestorías son las mejores en trato personal y en conocimiento del papeleo, que es justo lo que un autónomo valora cuando no quiere complicarse.

**3°) ¿Cuáles crees que son sus puntos fuertes que le hacen ser las mejores? ¿Tienen algún punto débil que puedas mejorar?**

| Empresa | Puntos fuertes | Puntos débiles que puedo mejorar |
|---|---|---|
| **TachoTools** | Producto joven y muy centrado; analiza `.DDD` y `.TGD`, valida la firma, genera un PDF para inspección, calcula multas estimadas y avisa de descargas con retraso; precios claros (3 €/mes y 5 €/mes); web rápida (TTFB de 19 ms) y con landings de cola larga; multiusuario y API en planes superiores. | Enfoque retrospectivo: analiza lo que ya pasó, no avisa de lo que viene. Exige subir ficheros con datos del conductor. No cubre ITV, seguro ni tarjeta. Es una empresa pequeña con cifras de uso no auditadas. Su web carga Google Analytics sin consentimiento visible y no envía cabeceras de seguridad como la CSP. |
| **Webfleet (Bridgestone)** | Plataforma madura, con hardware en el vehículo, localización, mantenimiento, tiempos de conducción y soporte de un fabricante grande; mucha experiencia y confianza. | Es caro y complejo para dos camiones; requiere instalar hardware y formación; no está pensado para el autónomo que solo quiere que no se le olvide un plazo. |
| **Asesorías y gestorías** | Confianza personal, trato directo, conocen al cliente y llevan el papeleo completo; el cliente no tiene que aprender nada. | Cuestan 30-60 €/mes, el cliente no ve el estado de sus plazos en tiempo real, dependen de su horario y de sus personas; si la gestoría falla, el cliente se queda sin control. |

**MI COMPETENCIA DIRECTA:** puede ser que tu competencia directa, en tu zona o de tu producto, no sean las mejores empresas ya que vendéis en ámbitos distintos. Elige 2-3 empresas que sean tu competencia directa y analízalas en profundidad.

En mi caso la competencia directa son **TachoTools** (el único que hace algo parecido en toda España), **las gestorías de transporte de la comarca** de Algeciras, La Línea y San Roque, y **el Excel y la libreta**, que no son una empresa pero son el competidor real al que hay que ganar.

**4°) ¿Qué necesitas saber de tu competencia directa?**

**a) Cuántos son y dónde están.**

TachoTools es una empresa pequeña con sede en Barcelona y ámbito nacional (y versiones en inglés, alemán y polaco). Las asesorías y gestorías de transporte son varias decenas en la comarca (Algeciras, La Línea, San Roque), aunque no he encontrado un censo público que las cuente con exactitud: es una **estimación** a partir de las que anuncian servicios de transporte. No hay una empresa local dedicada solo a los plazos del tacógrafo.

**b) Cuánto venden, si son grandes o pequeñas empresas.**

TachoTools declara más de 25 empresas y más de 700 conductores al mes, pero son datos de su web y no están auditados. Es una microempresa o pequeña empresa. Las gestorías son negocios locales de pocos trabajadores; su facturación depende del número de clientes y de las horas. No hay cifras públicas fiables, así que trabajo con la **estimación** de que ninguna domina el mercado.

**c) Sus productos, su calidad, sus precios, cómo venden.**

TachoTools vende un servicio online con tres planes: Custodio (3 €/mes), Pyme Digital (5 €/mes) y API Business (precio no publicado). Se contrata por internet, con un análisis gratuito sin registro como gancho. La calidad técnica es buena (validación de firma, informes, panel de flota), aunque el producto está en evolución. Las gestorías venden un servicio presencial y telefónico, con cuota mensual de 30-60 €/mes, y la calidad depende de la persona que lleve al cliente. TachoAviso se venderá online, con una demo y una prueba gratuita, a 4-6 €/mes, con la posibilidad de darse de alta desde el móvil en pocos minutos.

**d) Las estrategias de publicidad y marketing que siguen.**

TachoTools apuesta por el SEO: tiene unas 20 landings de cola larga sobre normativa, infracciones, dietas, ADR, laboral, formación y multiempresa, además de redes sociales y WhatsApp. Es una estrategia de contenido madura y replicable. Las gestorías se anuncian con el boca a boca, el cartel en la oficina y la relación con talleres y asociaciones. TachoAviso puede combinar las dos: contenido útil para transportistas (guías de plazos, calendario de descargas) y presencia en talleres y asociaciones locales.

**e) El nivel de satisfacción de sus clientes.**

No he encontrado encuestas públicas ni reseñas verificables de TachoTools. Su web muestra testimonios y cifras de uso, pero son declaraciones propias. De las gestorías, la satisfacción suele ser alta mientras la persona de contacto responde; el problema aparece cuando hay cambios de personal o vacaciones. Es una **observación cualitativa**, no un dato medido.

**f) La estrategia de mercado que siguen: innovar, crecer, estable.**

TachoTools está en fase de **crecimiento e innovación**: declara un «Dashboard 2.0» en desarrollo y amplía funcionalidades. Las gestorías siguen una estrategia **estable**: viven de la cartera de clientes y crecen poco. TachoAviso debe empezar estable (producto mínimo, pocos clientes, mucha calidad) y crecer después hacia asesorías y otras comarcas.

**g) Sus puntos fuertes, qué hacen bien, y sus puntos débiles, los motivos por los que los clientes dejarían de comprarles.**

Ya están en la tabla anterior. El resumen: TachoTools es fuerte en análisis y contenido, débil en prevención y en protección de datos; Webfleet es fuerte en tecnología y confianza, débil en precio y complejidad; las gestorías son fuertes en confianza, débiles en transparencia y escalabilidad. El cliente dejaría a TachoTools si no quiere subir ficheros o si necesita ITV y seguro; dejaría a Webfleet por precio; dejaría a la gestoría si quiere ver sus plazos él mismo.

**5°) Saca conclusiones:**

**a) ¿Qué hace la competencia mejor que vosotros? ¿Qué podríais hacer mejor que ellos?**

TachoTools hace mejor el análisis técnico del tacógrafo y el SEO; Webfleet hace mejor la telemática y el soporte; las gestorías hacen mejor el trato personal. TachoAviso puede hacer mejor tres cosas: **prevenir** (avisar antes, no analizar después), **minimizar datos** (sin ficheros ni nombres) y **cubrir más plazos** (ITV, seguro y tarjeta además del tacógrafo). Además puede hacerlo con una web accesible y con consentimiento real de cookies, que es justo lo que la competencia descuida.

**b) ¿En qué cambiaría la idea original tras este estudio? ¿Cambiaríamos a otros clientes?**

La idea original ponía el acento en la sencillez, el idioma y el precio. Después de estudiar a TachoTools, esos tres argumentos ya no diferencian: el competidor es español, sencillo y barato. El discurso tiene que cambiar a **«preventivo, sin subir ficheros y con más plazos»**. No cambio de cliente: sigo apuntando al autónomo y a la microflota de la comarca, porque es el que más sufre el problema y el que menos herramientas tiene. Lo que sí añado es un segmento secundario, las **asesorías**, como canal de venta y no como cliente principal. Y mantengo fuera del MVP la lectura de ficheros `.DDD`: es la fortaleza de TachoTools y no está en el alcance aprobado.

## 5. A partir del proyecto de empresa, y consultando los ejemplos del libro y de las fichas del CEEI de Alcoi, elabora la matriz D.A.F.O.

| | Positivo | Negativo |
|---|---|---|
| **Interno** | **Fortalezas:** enfoque preventivo; minimización de datos (alias, matrícula y fechas, sin ficheros ni nombres); cubre tacógrafo, ITV, seguro y tarjeta; precio bajo (4-6 €/mes); MVP como plugin de WordPress, barato de mantener; avisos configurables a 30, 15 y 7 días. | **Debilidades:** marca nueva sin reputación; equipo unipersonal; alta manual de vehículos y fechas; avisos solo por correo; objetivo pequeño (30-40 cuentas); dependencia de que el correo no caiga en spam; sin app móvil nativa. |
| **Externo** | **Oportunidades:** más de 200.000 camiones al año en la comarca; normativa que no desaparece; digitalización del sector; asesorías como canal de venta; ayudas a la digitalización; competencia directa escasa; hueco en ITV, seguro y tarjeta. | **Amenazas:** el Excel, la libreta y el calendario son gratis; TachoTools puede añadir avisos de ITV o seguro; las gestorías ya lo hacen; cambios de normativa; subida de precios del hosting o del correo; que un competidor grande (software de flotas) baje precios. |

**DEBILIDADES**

- ¿Cuáles son tus puntos débiles? La marca nueva, el equipo unipersonal, el alta manual, los avisos solo por correo y un objetivo de clientes pequeño.
- ¿Son solamente personales o hacen referencia a la tecnología y el capital? No son solo personales. Hay una parte personal (no tengo reputación ni equipo), pero también tecnológica (no hay app móvil nativa y el aviso depende del correo) y de capital (no puedo hacer campañas de publicidad grandes ni contratar a nadie).

**FORTALEZAS**

- ¿Qué puntos fuertes tiene tu idea? Que es preventiva, que no necesita ficheros ni datos personales, que cubre cuatro plazos en un solo sitio y que cuesta 4-6 €/mes sin permanencia.
- ¿Qué crees que puedes hacer mejor que otros? Avisar antes de que venza el plazo sin pedirle al cliente que suba nada, y hacerlo con una web sencilla y accesible que se usa desde el móvil.

**OPORTUNIDADES**

- ¿Qué oportunidades crees que existen en tu entorno? Más de 200.000 camiones al año en la comarca, una normativa que obliga y no desaparece, competencia directa escasa y asesorías y talleres que pueden actuar como canal de venta.
- ¿Y en un futuro inmediato? Las ayudas a la digitalización, la extensión a otras comarcas con puerto y el segmento de las asesorías que gestionan plazos de varios clientes.

**AMENAZAS**

- ¿Qué amenazas ves más importantes del entorno? El sustituto gratuito (Excel, libreta, calendario) y que TachoTools o las gestorías amplíen lo que ofrecen.
- ¿Vienen de la competencia o de otros factores? Vienen de las dos partes. De la competencia viene que TachoTools añada avisos de ITV o que una gestoría lance su herramienta; de otros factores vienen los cambios de normativa y la subida de precios del hosting o del correo.

**Elabora una estrategia para cada cuadrante de la matriz C.A.M.E. para el D.A.F.O. anterior:**

| Cuadrante | Estrategia |
|---|---|
| **CORREGIR LAS DEBILIDADES** | Lanzar una demo y una prueba gratuita para compensar la falta de reputación; hacer el alta guiada y con pocos campos; versión móvil cuidada; copias de seguridad y plan de contingencia; configurar SPF, DKIM y DMARC para que los avisos lleguen; pedir feedback a los primeros clientes. |
| **MANTENER LAS FORTALEZAS** | Seguir sin subir ficheros ni pedir datos personales; mantener los avisos a 30, 15 y 7 días; cuidar la accesibilidad y la sencillez; mantener el precio en 4-6 €/mes; conservar el enfoque preventivo en toda la comunicación. |
| **EXPLOTAR LAS OPORTUNIDADES** | Entrar por las asesorías y los talleres de la comarca; publicar contenido útil sobre plazos y normativa; aprovechar las ayudas a la digitalización en la comunicación; ampliar después a otras comarcas con puerto; ofrecer un plan para microflotas. |
| **AFRONTAR LAS AMENAZAS** | Comparativa pública contra el Excel (cuánto tiempo se pierde y qué riesgo hay); integrarse con TachoTools en lugar de competir frontalmente; revisar la normativa cada trimestre; acuerdos con talleres y asociaciones para tener presencia local; precio bajo y sin permanencia para que probar no dé miedo. |

**Estrategia elegida:** **FO** (usar las fortalezas para aprovechar las oportunidades: entrar por las asesorías con un producto preventivo, barato y sin ficheros) con apoyo **DA** (reducir la debilidad de marca y evitar la amenaza del Excel con demo, prueba gratuita y comparativa). El problema no es la competencia: es el sustituto gratuito.

## Con la información que has obtenido en las actividades 1 a 5 de la unidad 5 redacta el siguiente epígrafe de tu plan de empresa: «El entorno y la competencia».

### El macroentorno

TachoAviso se mueve en un macroentorno favorable. En el plano político-legal, España es un país estable y la obligación de controlar los plazos del tacógrafo, la ITV y el seguro no va a desaparecer: es una norma europea que afecta a todos los transportistas. Esa estabilidad permite planificar y, a la vez, explica por qué existe el negocio. Las administraciones impulsan la digitalización de pymes y autónomos con ayudas, aunque no se puede depender de una convocatoria concreta. El principal coste político es la burocracia: alta de autónomo, RGPD, LSSI-CE y facturación.

En el plano económico, el transporte es un sector de márgenes ajustados, sensible al gasóleo y a los tipos de interés, pero con demanda estable en la comarca: el puerto de Algeciras mueve más de 200.000 camiones al año y la mayoría son autónomos y microempresas. El desempleo andaluz es alto y el cliente mira cada euro, así que el precio de 4-6 €/mes tiene que compararse con el coste de una multa y con lo que ya paga (nada en Excel, 30-60 €/mes de gestoría, 3-5 €/mes si usa TachoTools).

En el plano social, el cliente es un transportista de 35 a 55 años, con nivel digital básico, que usa el móvil y el correo pero desconfía de subir datos. Cada vez acepta más los trámites electrónicos, pero sigue prefiriendo lo sencillo y lo gratuito. La accesibilidad y la claridad son parte de la propuesta, no un adorno.

En el plano tecnológico, la nube y WordPress abaratan el desarrollo; el correo es el canal de aviso y exige cuidar la entregabilidad; el móvil es el dispositivo principal; y el tacógrafo inteligente y la digitalización del sector refuerzan la necesidad de controlar plazos. La inteligencia artificial aún no forma parte del MVP, pero conviene vigilarla.

### El microentorno

El grado de competencia directa es bajo: en el nicho de los avisos de vencimientos legales solo he encontrado a TachoTools, una empresa pequeña de Barcelona con precios de 3-5 €/mes y un producto centrado en analizar ficheros del tacógrafo. Hay también software de flotas y gestorías, pero no ofrecen lo mismo. El competidor más fuerte, en la práctica, es gratis: la libreta, el Excel y el calendario del móvil.

La posibilidad de que entren nuevos competidores es alta, porque la inversión para montar un MVP es pequeña (hosting de 66-132 €/año y desarrollo propio) y no hay canales cerrados. Las barreras no son económicas sino de confianza y de conocimiento del nicho: cumplir el RGPD, conseguir que los correos lleguen y ganarse la reputación lleva tiempo. Las barreras de salida también son bajas: no hay stock, ni hardware, ni permanencia; si el proyecto no funciona, se cierra con poco coste.

Los productos sustitutivos son la libreta, el Excel, el calendario, la gestoría (30-60 €/mes), TachoTools (complementario) y el software de flotas (caro y complejo para dos camiones). El poder de los proveedores es bajo, porque hay muchos hostings, dominios y servicios de correo, aunque existe una dependencia real de los filtros antispam de Gmail y Outlook. El poder de los clientes es medio: son muchos y pequeños, no negocian precio individualmente, pero pueden volver a lo gratuito con facilidad; su verdadero poder es decidir no pagar.

El entorno es **simple** (pocos factores, fáciles de entender), **dinámico** (la normativa y la tecnología cambian), **integrado** (misma normativa y cultura en el mercado inicial) y **moderadamente favorable** (poca competencia directa, pero un sustituto gratuito muy fuerte). La actitud estratégica es **preactiva**: anticiparse a los cambios normativos y avisar antes de que el plazo venza.

### La competencia

Las mejores referencias del sector son TachoTools, Webfleet (Bridgestone) y las asesorías y gestorías de transporte. TachoTools es el competidor directo en el nicho: analiza ficheros `.DDD` y `.TGD`, valida la firma, genera informes para inspección, calcula multas estimadas y avisa de descargas con retraso; cobra 3 €/mes (Custodio) y 5 €/mes (Pyme Digital) y declara más de 25 empresas y 700 conductores al mes, cifras no auditadas. Su punto fuerte es el análisis técnico y su estrategia de contenido; su punto débil es que es retrospectivo, exige subir ficheros con datos del conductor, no cubre ITV, seguro ni tarjeta y descuida el consentimiento de cookies y las cabeceras de seguridad.

Webfleet es el estándar de la telemática de flotas: hardware en el vehículo, localización, mantenimiento y tiempos de conducción, con el respaldo de Bridgestone. Es muy potente, pero caro y complejo para un autónomo con dos camiones. Las gestorías son la competencia local real: cobran 30-60 €/mes, dan confianza y llevan el papeleo, pero el cliente no ve sus plazos en tiempo real y depende de sus horarios y de sus personas.

La conclusión es que TachoAviso no debe competir en análisis de ficheros (sería entrar en el terreno de TachoTools) ni en telemática (sería entrar en el de Webfleet). Debe competir en **prevención sencilla y barata**: avisar antes de que venza el plazo, sin subir ficheros y cubriendo también ITV, seguro y tarjeta. Ese es el hueco que no cubre nadie y el que justifica el precio de 4-6 €/mes.

### Análisis DAFO y CAME

El DAFO de TachoAviso deja claras sus fortalezas (enfoque preventivo, minimización de datos, cobertura de cuatro plazos, precio bajo, MVP barato), sus debilidades (marca nueva, equipo unipersonal, alta manual, avisos solo por correo, objetivo pequeño), sus oportunidades (200.000 camiones al año, normativa estable, digitalización, asesorías como canal, ayudas públicas) y sus amenazas (el Excel y la libreta gratis, TachoTools si amplía funciones, las gestorías, los cambios normativos y la subida de costes del hosting o del correo).

Del DAFO sale el CAME. Para **corregir las debilidades** hay que lanzar una demo y una prueba gratuita, simplificar el alta, cuidar la versión móvil, configurar SPF, DKIM y DMARC y pedir feedback a los primeros clientes. Para **afrontar las amenazas** hay que publicar una comparativa contra el Excel, integrarse con TachoTools en lugar de competir de frente, revisar la normativa cada trimestre y tener presencia en talleres y asociaciones. Para **mantener las fortalezas** hay que seguir sin subir ficheros ni pedir datos personales, conservar los avisos a 30, 15 y 7 días y cuidar la accesibilidad y la sencillez. Para **explotar las oportunidades** hay que entrar por las asesorías y los talleres de la comarca, publicar contenido útil sobre plazos y normativa y ampliar después a otras comarcas con puerto.

La estrategia elegida es **FO** (usar las fortalezas para aprovechar las oportunidades: entrar por las asesorías con un producto preventivo, barato y sin ficheros) con apoyo **DA** (reducir la debilidad de marca y evitar la amenaza del Excel con demo, prueba gratuita y comparativa). El problema no es la competencia: es el sustituto gratuito.

## Fuentes

- Datos del proyecto: documentos del plan de empresa de TachoAviso (cliente, propuesta de valor, precios, competencia y objetivos) y el informe de empresa del Hito 1.
- Análisis de competencia de TachoTools, 25/10/2026: portada, precios, FAQ, páginas de subida y `robots.txt` del sitio <https://tachotools.com/>. Las cifras de uso de TachoTools son declaraciones de su propia web y se citan como tales.
- Reglamento (CE) 561/2006, sobre tiempos de conducción y descanso, y normativa del tacógrafo.
- Actividades previas de análisis del entorno (macroentorno, microentorno, DAFO-CAME) y los apuntes de la unidad.
- Las cifras marcadas como **estimación** (número de gestorías de la comarca, satisfacción de clientes, ventas de las gestorías) no proceden de un censo público y se usan solo como orden de magnitud.
