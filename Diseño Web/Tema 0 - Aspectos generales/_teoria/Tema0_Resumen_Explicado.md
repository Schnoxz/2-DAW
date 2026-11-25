# Tema 0 - Aspectos Generales: Resumen Explicado

> Resumen reestructurado y explicado del documento `resumen_introduccion.pdf` del módulo de **Diseño de Interfaces Web** (DAW, 2º curso).
> El material enlaza dos bloques de teoría base: los **conceptos arquitectónicos del computador** y una **introducción a los sistemas operativos**, necesarios para entender sobre qué plataforma se ejecutan las aplicaciones web.

## Índice

1. [Conceptos arquitectónicos del computador](#1-conceptos-arquitectónicos-del-computador)
   - 1.1 [Estructura y funcionamiento del computador](#11-estructura-y-funcionamiento-del-computador)
   - 1.2 [Componentes internos del computador](#12-componentes-internos-del-computador)
   - 1.3 [Secuencia de funcionamiento del procesador](#13-secuencia-de-funcionamiento-del-procesador)
   - 1.4 [Registros de control y estado](#14-registros-de-control-y-estado)
   - 1.5 [Interrupciones](#15-interrupciones)
   - 1.6 [El reloj](#16-el-reloj)
   - 1.7 [Jerarquía de memoria](#17-jerarquía-de-memoria)
2. [Introducción a los sistemas operativos](#2-introducción-a-los-sistemas-operativos)
   - 2.1 [Gestión de procesos](#21-gestión-de-procesos)
   - 2.2 [Gestión de memoria](#22-gestión-de-memoria)
   - 2.3 [Comunicación y sincronización entre procesos](#23-comunicación-y-sincronización-entre-procesos)
   - 2.4 [Seguridad y protección](#24-seguridad-y-protección)

---

## 1. Conceptos arquitectónicos del computador

### 1.1 Estructura y funcionamiento del computador

El computador es una **máquina destinada a procesar datos**. Para entenderlo de forma sencilla, podemos imaginárnoslo como un circuito cerrado por el que circulan **dos flujos de información**:

- **Flujo de datos**: la información que se introduce y el resultado que se obtiene.
- **Flujo de instrucciones**: el *programa de máquina*, que indica al computador qué hacer con esos datos.

Dicho de otra forma: el computador lee un **programa**, lo ejecuta instrucción a instrucción y, como consecuencia, **produce un resultado** a partir de los datos de entrada.

El modelo de referencia es el conocido como **arquitectura von Neumann**, que describe un computador formado por **cuatro componentes básicos**:

| Componente | Función resumida |
|---|---|
| **Memoria principal** | Almacena los datos y el programa en ejecución (RAM/ROM). |
| **Unidad aritmético-lógica (UAL)** | Realiza las operaciones aritméticas y lógicas. |
| **Unidad de control (UC)** | Dirige y coordina todo el proceso de ejecución. |
| **Unidad de entrada/salida (E/S)** | Intercambia información con los periféricos. |

> **Nota:** al conjunto de la **unidad aritmético-lógica + unidad de control** (más la unidad de gestión de memoria) se le denomina **procesador** o **unidad central de proceso (UCP)**.

Desde la perspectiva de los sistemas operativos, nos interesa más el **funcionamiento interno** que los componentes físicos en sí, porque el sistema operativo es quien explota precisamente esas características para gestionar recursos.

### 1.2 Componentes internos del computador

#### 1.2.1 Memoria principal

- Se construye con memorias **RAM** (de lectura/escritura) y **ROM** (solo lectura).
- Está formada por un conjunto de **celdas idénticas**, cada una seleccionable mediante una **dirección**.
- El direccionamiento actual es a nivel de *byte*: cada dirección identifica un byte concreto.
- Sin embargo, el acceso se realiza normalmente sobre una **palabra** (grupo de 4 u 8 bytes), cuyo primer byte está situado en una dirección múltiplo de la longitud de la palabra (4 u 8).

**Concepto clave (Aclaración 1.1):** se llama **programa máquina (o código)** al conjunto de instrucciones de máquina. Todo programa escrito en cualquier lenguaje debe traducirse a programa máquina para poder ejecutarse.

#### 1.2.2 Unidad aritmético-lógica (UAL)

Su misión es realizar **operaciones aritméticas y lógicas** sobre operandos. Está formada por:

- **Banco de registros**: almacén temporal de los datos con los que opera.
- **Operador**: la circuitería que realiza la operación concreta.
- **Registro de estado**: guarda los **resultados adicionales** de la operación, que son los famosos **bits de estado**:

| Bit | Se activa cuando... |
|---|---|
| **Cero** | El resultado es 0. |
| **Signo** | El resultado es negativo. |
| **Acarreo** | La operación genera acarreo. |
| **Desbordamiento** | El resultado desborda la capacidad del registro. |

> **Por qué importan:** las **instrucciones de salto condicional** se apoyan en estos bits, es decir, son los que permiten que un programa **tome decisiones**.

#### 1.2.3 Unidad de control (UC)

Es la parte "que manda" en el computador. Ejecuta de forma cíclica la siguiente secuencia:

1. **Lee** de memoria la siguiente instrucción de máquina.
2. **Interpreta** la instrucción leída (aritmética, lógica, salto, etc.).
3. **Lee**, si los hay, los datos referenciados por la instrucción.
4. **Ejecuta** la instrucción.
5. **Almacena**, si procede, el resultado.

Tiene asociados registros fundamentales, de los que hablaremos en el apartado 1.4.

#### 1.2.4 Unidad de entrada/salida (E/S)

Se encarga de **transferir información entre la memoria principal (o los registros) y los periféricos** (teclado, disco, tarjeta de red...). Puede funcionar:

- **E/S programada**: bajo el gobierno de la unidad de control (el procesador se implica en cada transferencia).
- **DMA (acceso directo a memoria)**: la transferencia se hace de forma independiente del procesador, lo que libera a la UCP para otras tareas.

### 1.3 Secuencia de funcionamiento del procesador

El procesador, en realidad, **"solo sabe hacer una cosa"**: repetir sin parar y a una velocidad altísima (miles de millones de veces por segundo) una secuencia de tres pasos:

1. **a) Lectura** de la instrucción de máquina apuntada por el **contador de programa (PC)**.
2. **b) Incremento del PC** para que apunte a la siguiente instrucción.
3. **c) Interpretación y ejecución** de la instrucción (puede incluir lectura de operandos o guardar resultados).

Esta secuencia tiene dos propiedades fundamentales:

- Es **lineal**: ejecuta de forma consecutiva las instrucciones que están en direcciones consecutivas.
- Es un **bucle infinito**: la unidad de control nunca deja de repetirla.

> **Advertencia:** existen instrucciones de parada (p. ej. `HALT`, útil para ahorrar batería), pero en la práctica podemos considerar que la unidad de control **no se detiene nunca**.

**Ruptura de secuencia.** El esquema lineal es muy limitado, así que se añaden mecanismos para alterarlo. Todos se basan en **modificar el contenido del PC** para saltar a otra sección. Los tres mecanismos básicos son:

1. **Instrucciones de salto o bifurcación**: rompen la linealidad dentro del propio programa.
2. **Interrupciones** (externas o internas): fuerzan el salto a otro programa (normalmente el **sistema operativo**).
3. **Instrucciones de llamada al sistema** (`TRAP`, `INT`, `SC`): como una interrupción "solicitada" por el programa, saltan también al sistema operativo.

### 1.4 Registros de control y estado

La unidad de control tiene una serie de **registros de control y estado**. Los más importantes:

- **Contador de programa (PC, *Program Counter*)**: contiene la dirección de la *siguiente* instrucción de máquina.
- **Puntero de pila (SP, *Stack Pointer*)**: gestiona la pila del sistema (hay dos, una para el sistema operativo y otra para el usuario).
- **Registro de instrucción (RI)**: almacena la instrucción en curso de ejecución.
- **Registro de estado (RE)**:
  - **Bits de estado aritméticos**: Signo, Acarreo, Cero y Desbordamiento.
  - **Bits de modo de ejecución**: indican en qué modo ejecuta el procesador (usuario / núcleo).
  - **Bits de control de interrupciones**: qué interrupciones se pueden aceptar.
  - Bits de gestión de memoria / espacio de direccionamiento.

**Conceptos importantes:**

- **Estado del procesador**: todo el contenido de los registros en un instante dado.
- **Estado visible del procesador**: el subconjunto de registros visibles en modo usuario (el PC, el SP y parte del estado sí lo son; los de gestión de memoria no).

> **Seguridad en dos modos:** en **modo usuario** no se permiten operaciones de E/S directas ni modificar la mayor parte del registro de estado; esas tareas quedan reservadas al **modo privilegiado o núcleo**, que solo usa el sistema operativo.

### 1.5 Interrupciones

Una interrupción es una **señal** que llega a la unidad de control. El agente que la genera la activa cuando necesita que se le atienda, es decir, que se ejecute un programa que le dé servicio (la **rutina de tratamiento de interrupción**).

#### Ciclo de aceptación

Si la interrupción está **habilitada**, al terminar la instrucción en curso la unidad de control realiza el **ciclo de aceptación**:

1. **Salva** algunos registros (estado y PC), normalmente en la **pila de sistema** (gestión del SP').
2. **Eleva el modo de ejecución** a núcleo (privilegiado).
3. **Salta al programa que la atiende**; normalmente el sistema operativo.
4. En muchos procesadores, **inhibe las interrupciones** mientras se atiende la actual.

En la **interrupción vectorizada** (la solución habitual), el agente que interrumpe suministra un **vector de interrupción**, que indica la dirección de comienzo de su rutina de tratamiento. La unidad de control, mediante direccionamiento indirecto, toma esa dirección de una **tabla de interrupciones (IDT)** y la carga en el PC.

> **Por qué la IDT y la rutina pertenecen al sistema operativo:** la rutina de tratamiento ejecuta en **modo privilegiado**. Si un programa de usuario pudiera manejarla, podría acceder sin límites a datos y programas de otros usuarios. Proteger el tratamiento de interrupciones es una de las funciones esenciales del sistema operativo.

#### Tipos de interrupciones

Se clasifican según su naturaleza:

| Tipo | Naturaleza | Ejemplos |
|---|---|---|
| **Excepciones síncronas** (problemas de ejecución) | Consecuencia directa de las instrucciones en ejecución | División por cero, operación inválida, desbordamiento, memoria inválida o privilegiada, código de operación inválido... |
| **Excepciones síncronas** (depuración) | Producidas por el programa | Puntos de ruptura (breakpoints), fallo de página. |
| **Excepciones hardware asíncronas** | Errores de hardware | Error de paridad en bus o memoria, fallo de alimentación, límite de temperatura. |
| **Interrupciones externas** | Elementos externos al procesador | Reloj (tics), controladores de dispositivos E/S, otros procesadores. |
| **Llamadas al sistema** | Instrucciones del programa (`TRAP`, `INT`, `SYSENTER`, `SC`) | Sirven para que un programa de usuario solicite servicios del sistema operativo. |

> **Terminología:** una interrupción es **síncrona** cuando es consecuencia de la instrucción que se está ejecutando; en el resto de casos es **asíncrona**. Las excepciones de hardware síncronas se denominan a menudo "excepciones software".

#### Niveles y prioridad (inhibición)

Los procesadores suelen tener **varias líneas de solicitud de interrupción**, cada una con su **prioridad**. Si se activan varias a la vez, se atiende la de mayor prioridad (normalmente las más prioritarias son las graves y las llamadas al sistema).

Para controlarlas hay tres mecanismos de **inhibición selectiva**:

- **Máscara**: un bit por línea; permite inhibir líneas concretas.
- **Registro de nivel**: inhibe todas las interrupciones con prioridad menor o igual a un valor.
- **BGI (Bit de inhibición global)**: mientras está activo, no se admite ninguna interrupción.

Estos valores solo pueden modificarse en **modo privilegiado**, por lo que su control queda restringido al sistema operativo.

#### Tratamiento de interrupciones

- En el ciclo de aceptación solo se salvan algunos registros, pero un **tratamiento correcto** exige preservar el valor del **resto de registros** del programa interrumpido para poder reanudarlo sin problemas.
- La rutina debe **restituir cuanto antes los registros de inhibición** para admitir nuevas interrupciones.
- La instrucción **`RETI` (retorno de interrupción)** hace la función inversa al ciclo de aceptación: restituye el estado y el PC salvados. Al restaurar el estado con el bit de modo "usuario" activo, de forma indirecta el procesador **vuelve a modo usuario** y continúa ejecutando el programa interrumpido justo donde se quedó.
- El **anidamiento** de interrupciones (aceptar una sin haber terminado la anterior) lo resuelve el sistema operativo.

### 1.6 El reloj

El término "reloj" abarca **tres conceptos distintos** pero relacionados:

1. **Reloj o señal CLK**: gobierna el *ritmo de ejecución* de las instrucciones de máquina. Cuando se dice que un microprocesador es de "5 GHz" se indica la frecuencia del oscilador que marca ese ritmo (~5 mil millones de ciclos por segundo).
2. **Temporizador**: un divisor de frecuencia genera **interrupciones periódicas** (los *tics*) cada cierto intervalo (típicamente entre 1 y 100 ms). Su objetivo es que el sistema operativo entre a ejecutarse de forma periódica y el planificador pueda dar turno a los procesos.
3. **Reloj de tiempo real (RTC)**: un contador que permite conocer la **fecha y la hora** tomando como referencia un instante dado (en UNIX, las 00:00 del 1 de enero de 1970; en otros sistemas, 1990).

**Herramienta de precisión:** el **TSC (Time-Stamp Counter)**, un registro de 64 bits presente en los procesadores modernos, cuenta **ciclos de la señal CLK** (no tiempo real): ofrece una resolución muy alta, pero hay que saber que depende de la frecuencia del oscilador (p. ej. 4.000 ciclos son 2 µs en un procesador de 2 GHz y 1 µs en uno de 4 GHz).

### 1.7 Jerarquía de memoria

La memoria de alta velocidad es **cara y de reducido tamaño**. Por eso los computadores organizan la memoria como una **jerarquía de niveles** con distinta velocidad, precio y tamaño:

| Nivel | Capacidad típica | Tiempo de acceso | Tipo de acceso |
|---|---|---|---|
| **Registros** | 64 B – 1 KiB | 0,25 – 0,5 ns | Palabra |
| **Caché** | 8 KiB – 8 MiB | 0,5 – 20 ns | Palabra |
| **Memoria principal** | 128 MiB – 64 GiB | 60 – 200 ns | Palabra |
| **SSD (disco electrónico)** | 128 GiB – 1 TiB | ~50 µs | Sector |
| **Discos magnéticos** | 256 GiB – 4 TiB | 5 – 30 ms | Sector |

**Cómo funciona:** la información va **migrando** de los niveles lentos a los rápidos cuando se necesita (p. ej. un programa se carga de disco a memoria principal y de ahí se va ejecutando instrucción a instrucción) y, a la inversa, cuando se modifica información en un nivel rápido hay que **llevarla al nivel permanente** (disco) para que no se pierda.

La gestión de esta jerarquía es compleja y recae en buena parte sobre el **sistema operativo**, apoyado por el **hardware**.

#### 1.7.1 Memoria caché

- La palabra *caché* viene del francés *cacher* (**ocultar**): es una memoria **no visible para el programa**, que no está en el mapa de memoria.
- Es una memoria de apoyo a la principal que **acelera los accesos**: almacena la **información utilizada recientemente** con la esperanza de que se vuelva a usar pronto (principio de **localidad**).
- El bloque de información que se migra entre memoria principal y caché se llama **línea**.
- Su gestión se hace **por hardware**, porque debe ser rapidísima. Actualmente se usan **tres niveles de caché** integrados en el propio chip del procesador.
- Optimizar el código para que genere **pocos fallos de caché** puede acelerar espectacularmente la ejecución de un programa.

#### 1.7.2 Memoria virtual vs. memoria real

- Una máquina con **memoria real** solo usa la memoria principal para ubicar el mapa de memoria de los procesos.
- La **memoria virtual** es un mecanismo de **migración automática** entre dos niveles: la **memoria principal** y una **memoria de respaldo en disco** (el **swap** o zona de intercambio).
- La gestiona el **sistema operativo** con ayuda de una unidad hardware dedicada: la **MMU** (*Memory Management Unit*).
- El espacio virtual y la memoria se dividen en **páginas**. La **tabla de páginas** guarda dónde está cada página virtual (en un marco de página o en el swap). La **MMU** la usa para **traducir direcciones virtuales a físicas**.
- Si la página no está en memoria, se produce un **fallo de página** y el sistema operativo la trae del disco.
- Para acelerar las traducciones, la MMU usa una **TLB** (*Translation Look-aside Buffer*), una memoria asociativa rapidísima que recuerda las últimas parejas *página → marco*, evitando acceder a la tabla de páginas en memoria principal.

> **Modo real:** cuando el computador arranca aún no existen tablas de páginas, así que la MMU funciona en **modo real** (se limita a pasar la dirección tal cual). En este modo el computador funciona **sin memoria virtual**.

---

## 2. Introducción a los sistemas operativos

El sistema operativo se puede entender como un **conjunto de componentes que ofrecen servicios** a los programas a través de una **interfaz de llamadas al sistema** (las *system calls*). Cada interfaz define una **máquina extendida**: por ejemplo, un sistema puede ofrecer interfaces de tipo **Windows** y de tipo **UNIX**, y un programa elige sobre cuál ejecutarse (sin mezclar servicios de varias).

Sus componentes principales son:

- **Gestor de procesos**: generar y gestionar los procesos.
- **Gestor de memoria**: asignar y controlar la memoria de los procesos.
- **Gestor de comunicación y sincronización** entre procesos.
- **Gestor de seguridad**: identificar usuarios, definir qué puede hacer cada uno y controlar el acceso a los recursos.

### 2.1 Gestión de procesos

**¿Qué es un proceso?** Un proceso es **un programa en ejecución**, la unidad de procesamiento que gestiona el sistema operativo.

> **Programa ≠ Proceso.** El programa es solo un conjunto de instrucciones de máquina (un fichero ejecutable); el **proceso** surge cuando ese programa **se pone en ejecución**. Por eso varios procesos pueden ejecutar el mismo programa a la vez (p. ej. varias ventanas del mismo navegador). El programa es **permanente**; el proceso es **volátil** (desaparece con su ejecución).

**Elementos de un proceso:** registros (su estado del procesador), su **imagen de memoria** (código y datos en el mapa de memoria) y su **Bloque de Control de Proceso (BCP)**, una estructura de información donde el sistema operativo guarda sus características y recursos asignados.

**Servicios (fases de vida del proceso):**

- **Crear un proceso**: un proceso padre lo solicita. Dos modalidades básicas:
  - **A partir de la imagen del padre** (clon): servicio `fork` de UNIX.
  - **A partir de un fichero ejecutable**: servicio `CreateProcess` de Windows.
- **Ejecutar un proceso**, de tres formas:
  - **Batch (lote)**: toma los datos de ficheros y deposita los resultados en ficheros, sin interacción (p. ej. un proceso de nóminas).
  - **Interactiva**: asociado a un terminal; recibe la información del usuario y responde los resultados (p. ej. un editor de texto).
  - **Segundo plano (background)**: como batch, pero lanzado desde sistemas interactivos y sin terminal asociado.
- **Matar un proceso**, cuando: llega a su final, se produce un error (división por cero, acceso no permitido) o otro proceso/usuario decide terminarlo (servicio `kill` de UNIX).
- **Cambiar el ejecutable de un proceso**: sustituir el ejecutable actual por uno nuevo manteniendo el mismo proceso; lo realiza el servicio `exec` de UNIX.

### 2.2 Gestión de memoria

El **gestor de memoria** se encarga de:

- **Asignar memoria** a los procesos para construir su imagen de memoria.
- Tratar los **errores de acceso a memoria**, evitando que unos procesos interfieran en la memoria de otros.
- Hacer posible la **comunicación** entre procesos mediante memoria compartida.
- **Gestionar la jerarquía de memoria** y tratar los **fallos de página** en sistemas con memoria virtual.

**Servicios que ofrece:**

- **Solicitar memoria**: aumenta la imagen de memoria del proceso (dentro de sus recursos o cuota). Devuelve un apuntador a la nueva memoria, con la que se trabaja mediante direccionamientos relativos.
- **Liberar memoria**: devuelve trozos de memoria al sistema operativo, que los añade a sus listas de recursos libres para reutilizarlos.
- **Compartir memoria**: crear y liberar regiones de memoria compartidas, base de la comunicación entre procesos.

En cuanto a las **alternativas de asignación**: el sistema operativo establece la imagen de memoria según sea un sistema **real monoproceso** (una sola región), un sistema **real multiproceso** (una región por proceso) o un sistema **virtual** (regiones de memoria virtual por proceso).

### 2.3 Comunicación y sincronización entre procesos

Cuando varios procesos **cooperan** para realizar un trabajo complejo, necesitan **comunicarse** (transmitirse datos y órdenes) y **sincronizarse** (coordinar la ejecución de sus acciones). El sistema ofrece servicios de comunicación y sincronización que, **sin romper los esquemas de protección**, permiten la cooperación.

**Mecanismos de comunicación** (muchos sirven también para sincronizar):

- **Tuberías o *pipes***.
- **Memoria compartida**.
- **Sockets** (comunicación entre máquinas distintas, incluso en red).

La comunicación puede ser:
- **Local** (procesos de la misma máquina) o **remota** (procesos en máquinas distintas).
- **Síncrona**: el emisor y el receptor han de ejecutar sus servicios de comunicación a la vez (uno espera al otro). O **asíncrona**: no necesitan coincidir en el tiempo.

**Servicios básicos de comunicación:**

| Servicio | Función | Ejemplo UNIX | Ejemplo Windows |
|---|---|---|---|
| **Crear** | Crear el mecanismo | `pipe` | `CreatePipe` |
| **Enviar / escribir** | Enviar información | `write` | `WriteFile` |
| **Recibir / leer** | Recibir información | `read` | `ReadFile` |
| **Destruir** | Cerrar el mecanismo | `close` | `CloseHandle` |

> Los mecanismos son **entidades vivas**: tienen una vida con fases de **creación, utilización y destrucción**, igual que los procesos.

### 2.4 Seguridad y protección

El **gestor de seguridad** se encarga de:

- **Identificar** a los usuarios del sistema.
- Definir **qué puede hacer cada uno** con los recursos (permisos y políticas).
- **Controlar el acceso** a los recursos (protección interna y defensa frente a ataques externos).

Todo ello apoya la idea central de que el sistema operativo es quien **garantiza el aislamiento** entre procesos y usuarios, incluso cuando les ofrece mecanismos para comunicarse y cooperar.

---

## Conclusiones

Este tema sienta las bases para entender sobre qué hardware y qué software se ejecutan nuestras aplicaciones: el procesador (su ciclo de ejecución, registros e interrupciones), la memoria (jerarquía, caché y memoria virtual) y el sistema operativo (gestión de procesos, memoria, comunicación y seguridad). Como futuros desarrolladores de interfaces web, entender estas bases ayuda a razonar el **rendimiento** de las aplicaciones y por qué el sistema operativo gestiona recursos de la forma en que lo hace.

*Fuente: apuntes basados en el resumen del Tema 0 - Aspectos generales (Diseño de Interfaces Web, 2º DAW).*