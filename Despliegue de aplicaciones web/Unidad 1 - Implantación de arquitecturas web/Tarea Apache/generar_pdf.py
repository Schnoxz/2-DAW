"""
Motor de maquetacion: markdown -> PDF con el estilo de una entrega de
apuntes (A4, sin marco, columna de texto, Times + Consolas resaltado, reglas
finas entre ejercicios).

Copia este archivo y cambia solo el bloque METRICAS y la lista ORIGENES.
El resto (flujo, salto de pagina, resaltado) ya funciona.

    python plantilla_entrega.py

Por que estas decisiones y no otras (leer SKILL.md para el detalle):
  - La Times va con TextWriter para que PyMuPDF la incruste. Con insert_text la
    cambia por las base14 y el guion largo (—) se dibuja como un punto medio.
  - El codigo necesita color y TextWriter.append() no lo admite, asi que la
    Consolas va con insert_text. Son dos vias distintas con dos bases de linea
    distintas, de ahi la calibracion.
  - Se guardan numeros de pagina, no objetos Page: al anadir paginas las
    referencias anteriores dejan de ser validas.
"""
import re
import sys
from pathlib import Path

import pymupdf

# ================================================================== METRICAS ==
# Cambiar aqui. Los valores por defecto reproducen la entrega del Tema 1.4 de
# "Entorno Cliente / U1"; mide otra referencia con medir_referencia.py.
ORIGEN = Path(r"C:\Users\javie\Desktop\2-DAW\Despliegue de aplicaciones web\Tarea Apache\Instalacion_Apache_Debian.md")
DESTINO = Path(r"C:\Users\javie\Desktop\2-DAW\Despliegue de aplicaciones web\Tarea Apache\Instalacion_Apache_Debian.pdf")
IMAGENES_BASE = Path(r"C:\Users\javie\Desktop\2-DAW\Despliegue de aplicaciones web\Tarea Apache")          # las rutas del markdown son relativas a esto

ANCHO, ALTO = 595.0, 842.0              # A4
IZQ, DER = 81.8, 513.0                  # columna de texto, como la referencia
ANCHO_TEXTO = DER - IZQ                  # 431.2
SUP, INF = 42.0, 795.0                   # margenes verticales utiles
ANCHO_IMAGEN = ANCHO_TEXTO               # capturas al ancho completo, uniforme
ALTO_MAX_IMAGEN = None                   # None = sin tope; o un float en pt
CON_MARCO = False                       # False = sin marco, como el 1.4

CUERPO, INTERLINEA = 12.0, 13.5
CODIGO, INTERLINEA_CODIGO = 10.2, 12.0
TITULO, INTERLINEA_TITULO = 24.0, 27.8
SECCION, INTERLINEA_SECCION = 18.0, 21.0
EJERCICIO, INTERLINEA_EJERCICIO = 14.0, 17.0
CODIGO_EN_TITULO = 11.9
SANGRIA_CODIGO = 51.0                    # sangria francesa al partir codigo

ANTES_TITULO, DESPUES_TITULO = 0.0, 15.1
ANTES_SECCION, DESPUES_SECCION = 0.0, 14.7
ANTES_EJERCICIO, DESPUES_EJERCICIO = 16.0, 13.3
DESPUES_PARRAFO = 12.0
ANTES_CODIGO, DESPUES_CODIGO = 0.5, 14.0
ANTES_IMAGEN, HUECO_IMAGEN_PIE, DESPUES_IMAGEN = 0.2, 0.0, 14.5
ANTES_REGLA, DESPUES_REGLA = 0.5, 15.2
GROSOR_REGLA = 0.75
GRIS_REGLA = 26 / 255

# Rótulo centrado de la primera pagina y punto donde arranca el titulo.
ROTULO = "Tarea — Servidor Apache (Debian 12)"
Y_ROTULO = 113.6
Y_TITULO = 171.4

# ================================================================== FUENTES ==
ARCHIVOS_FUENTE = {
    "tiro": r"C:\Windows\Fonts\times.ttf",
    "tibo": r"C:\Windows\Fonts\timesbd.ttf",
    "tiit": r"C:\Windows\Fonts\timesi.ttf",
    "tiboi": r"C:\Windows\Fonts\timesbi.ttf",
    "cons": r"C:\Windows\Fonts\consola.ttf",
    "consb": r"C:\Windows\Fonts\consolab.ttf",
    "consi": r"C:\Windows\Fonts\consolai.ttf",
    "consz": r"C:\Windows\Fonts\consolaz.ttf",
}
# Las que van por TextWriter (necesitan color no) y las que van por insert_text.
FUENTES_TEXTWRITER = ("tiro", "tibo", "tiit", "tiboi")
FUENTES_INSERT = ("cons", "consb", "consi", "consz")
FUENTE_MEDIDA = {
    alias: pymupdf.Font(fontfile=archivo) for alias, archivo in ARCHIVOS_FUENTE.items()
}

NEGRO = (0.0, 0.0, 0.0)
PALETA_CODIGO = {
    "normal": ("cons", NEGRO),
    "negrita": ("consb", NEGRO),
    "comentario": ("consi", (0x60 / 255, 0xA0 / 255, 0xB0 / 255)),
    "cadena": ("cons", (0x40 / 255, 0x70 / 255, 0xA0 / 255)),
    "etiqueta": ("consb", (0x00, 0x72 / 255, 0x20 / 255)),
    "operador": ("cons", (0x66 / 255, 0x66 / 255, 0x66 / 255)),
    "puntuacion": ("cons", (0x90 / 255, 0x20 / 255, 0.00)),
    "global": ("cons", (0.00, 0x80 / 255, 0x00)),
}
CLAVES_JS = {
    "const", "let", "var", "function", "return", "new", "if", "else",
    "for", "while", "true", "false", "null", "typeof", "class", "import", "export",
}
GLOBALES_JS = {"document", "window", "console", "alert", "this"}
RESERVADAS_HTML = {"html", "head", "body", "title", "meta", "link", "script", "style", "div"}

PATRON_JS = re.compile(
    r"""(?P<comentario>//[^\n]*)
      | (?P<cadena>'(?:[^'\\]|\\.)*'|"(?:[^"\\]|\\.)*")
      | (?P<palabra>[A-Za-z_$][A-Za-z0-9_$]*)
      | (?P<espacio>[ \t]+)
      | (?P<operador>===|!==|==|!=|=>|&&|\|\||[-+*/%<>=!|&?])
      | (?P<puntuacion>[(){}\[\];,.])""",
    re.X,
)
PATRON_HTML = re.compile(
    r"""(?P<comentario><!--.*?-->)
      | (?P<apertura><)(?P<nombre>[A-Za-z][A-Za-z0-9]*)
      | (?P<cierra></)(?P<nombre2>[A-Za-z][A-Za-z0-9]*)(?P<final>>)
      | (?P<atributo>[A-Za-z-]+(?=[ \t]*=))
      | (?P<igual>=)
      | (?P<cadena>"[^"]*"|'[^']*')
      | (?P<espacio>[ \t]+)
      | (?P<puntuacion>>)""",
    re.X,
)


def _primera_caja(pagina):
    for bloque in pagina.get_text("dict")["blocks"]:
        for linea in bloque.get("lines", []):
            for span in linea["spans"]:
                return span["bbox"][1]
    raise RuntimeError("no se encontro el texto de calibracion")


def _calibrar_ascendentes():
    """Font.ascender no coincide con la caja que PyMuPDF escribe, asi que se
    deduce escribiendo un texto de prueba. Cada via mide distinto, de ahi una
    calibracion por (via, fuente)."""
    factores = {}
    for alias in FUENTES_TEXTWRITER:
        prueba = pymupdf.open()
        pagina = prueba.new_page(width=300, height=300)
        escritor = pymupdf.TextWriter(pagina.rect)
        escritor.append((20, 200), "HÁxy", font=FUENTE_MEDIDA[alias], fontsize=100)
        escritor.write_text(pagina)
        factores[alias] = (200 - _primera_caja(pagina)) / 100
        prueba.close()
    for alias in FUENTES_INSERT:
        prueba = pymupdf.open()
        pagina = prueba.new_page(width=300, height=300)
        pagina.insert_font(fontname=alias, fontfile=ARCHIVOS_FUENTE[alias])
        pagina.insert_text((20, 200), "HÁxy", fontname=alias, fontsize=100)
        factores[alias] = (200 - _primera_caja(pagina)) / 100
        prueba.close()
    return factores


FACTOR_ASCENDENTE = _calibrar_ascendentes()


def ascender(fuente, tamano):
    return FACTOR_ASCENDENTE[fuente] * tamano


def ancho(texto, fuente, tamano):
    return FUENTE_MEDIDA[fuente].text_length(texto, fontsize=tamano)


def resaltar(texto, lenguaje):
    if not texto.strip():
        return [(" ", "normal")]
    patron = PATRON_HTML if lenguaje == "html" else PATRON_JS
    partes = []
    for c in patron.finditer(texto):
        grupo = c.lastgroup
        if grupo == "comentario":
            estilo = "comentario"
        elif grupo == "cadena":
            estilo = "cadena"
        elif grupo in {"nombre", "nombre2", "atributo"}:
            estilo = "etiqueta"
        elif grupo in {"apertura", "cierra", "final", "puntuacion"}:
            estilo = "puntuacion"
        elif grupo in {"igual", "operador"}:
            estilo = "operador"
        elif grupo == "palabra":
            palabra = c.group(0)
            if lenguaje == "html":
                estilo = "etiqueta" if palabra.lower() in RESERVADAS_HTML else "normal"
            elif palabra in CLAVES_JS:
                estilo = "negrita"
            elif palabra in GLOBALES_JS:
                estilo = "global"
            else:
                estilo = "normal"
        else:
            estilo = "normal"
        partes.append((c.group(0), estilo))
    return partes or [(" ", "normal")]


def partir_codigo(linea, lenguaje):
    """Parte una linea larga de codigo con sangria francesa. Si un token no cabe
    entero se parte por caracteres, porque si no se desbordaria el margen."""
    disponible = ANCHO_TEXTO - SANGRIA_CODIGO
    salida, actual, usado = [], [], 0.0

    def cerrar():
        nonlocal actual, usado
        salida.append(actual)
        actual, usado = [], SANGRIA_CODIGO

    for texto, estilo in resaltar(linea, lenguaje):
        fuente = PALETA_CODIGO[estilo][0]
        while True:
            if usado + ancho(texto, fuente, CODIGO) <= disponible or not texto:
                break
            cabe = 0
            while cabe < len(texto) - 1:
                if usado + ancho(texto[: cabe + 1], fuente, CODIGO) > disponible:
                    break
                cabe += 1
            if cabe == 0:
                if not actual:
                    cabe = 1
                else:
                    cerrar()
                    continue
            actual.append((texto[:cabe], estilo))
            usado += ancho(texto[:cabe], fuente, CODIGO)
            texto = texto[cabe:]
            cerrar()
        if not texto:
            continue
        medida = ancho(texto, fuente, CODIGO)
        if usado + medida > disponible and actual:
            cerrar()
        actual.append((texto, estilo))
        usado += medida

    salida.append(actual)
    return salida


class Documento:
    """Flujo vertical con salto de pagina. self.y es el borde superior de la
    caja de la siguiente linea, no la linea base."""

    def __init__(self, alto_pagina=ALTO, limite_inferior=INF, ancho_imagen=ANCHO_IMAGEN):
        self.doc = pymupdf.open()
        self.alto = alto_pagina
        self.inf = limite_inferior
        self.ancho_imagen = ancho_imagen
        self.y = SUP
        self.escritores = []
        self.nueva_pagina()

    def nueva_pagina(self):
        self.pagina = self.doc.new_page(width=ANCHO, height=self.alto)
        for alias in FUENTES_INSERT:
            self.pagina.insert_font(fontname=alias, fontfile=ARCHIVOS_FUENTE[alias])
        if CON_MARCO:
            self.pagina.draw_rect(
                pymupdf.Rect(IZQ - 20, 30, DER + 20, self.alto - 30),
                color=(0, 0, 0), width=0.7,
            )
        self.escritor = pymupdf.TextWriter(self.pagina.rect)
        # numero y no objeto Page: al anadir paginas, las referencias caducan
        self.escritores.append((self.pagina.number, self.escritor))
        self.y = SUP

    def escribir(self, x, base, texto, fuente, tamano, color):
        if not texto.strip():
            return
        if fuente in FUENTES_TEXTWRITER:
            self.escritor.append(
                (x, base), texto, font=FUENTE_MEDIDA[fuente], fontsize=tamano
            )
        else:
            self.pagina.insert_text(
                (x, base), texto, fontname=fuente, fontsize=tamano, color=color
            )

    def reservar(self, alto):
        if self.y + alto > self.inf:
            self.nueva_pagina()

    def separador(self, forzado=False):
        """Regla fina entre secciones. Si no caben la regla, el titulo y un par
        de lineas, corta pagina: un titulo solo al pie queda raro."""
        if not forzado and (
            self.y + ANTES_REGLA + DESPUES_REGLA + INTERLINEA_EJERCICIO + 2 * INTERLINEA
            > self.inf
        ):
            self.nueva_pagina()
            return
        self.y += ANTES_REGLA
        gris = (GRIS_REGLA, GRIS_REGLA, GRIS_REGLA)
        self.pagina.draw_rect(
            pymupdf.Rect(IZQ, self.y, DER, self.y + GROSOR_REGLA),
            color=gris, fill=gris, width=0,
        )
        self.y += DESPUES_REGLA

    def dibujar_linea(self, x, y, segmentos, alineacion="izq"):
        if not segmentos:
            return 0.0
        total = sum(ancho(t, f, s) for t, f, s, _ in segmentos)
        if alineacion == "centro":
            cursor = (ANCHO - total) / 2
        elif alineacion == "derecha":
            cursor = DER - total
        else:
            cursor = x
        base = y + ascender(segmentos[0][1], segmentos[0][2])
        for texto, fuente, tamano, color in segmentos:
            self.escribir(cursor, base, texto, fuente, tamano, color)
            cursor += ancho(texto, fuente, tamano)
        return total

    @staticmethod
    def _trocear(texto, fuente_texto, tam_texto, fuente_codigo, tam_codigo, color):
        """Parte el texto en trozos normal / `codigo`."""
        trozos = []
        for indice, parte in enumerate(re.split(r"`([^`]+)`", texto)):
            if not parte:
                continue
            if indice % 2:
                trozos.append((parte, fuente_codigo, tam_codigo, color))
            else:
                trozos.append((parte, fuente_texto, tam_texto, color))
        return trozos

    def _partir_lineas(self, trozos):
        palabras = []
        for texto, fuente, tamano, color in trozos:
            for palabra in re.split(r"(\s+)", texto):
                if palabra:
                    palabras.append((palabra, fuente, tamano, color))
        lineas, actual, usado = [], [], 0.0
        for palabra, fuente, tamano, color in palabras:
            if usado + ancho(palabra, fuente, tamano) > ANCHO_TEXTO and actual:
                if actual[-1][0].strip() == "":
                    actual.pop()
                lineas.append(actual)
                actual, usado = [], 0.0
            actual.append((palabra, fuente, tamano, color))
            usado += ancho(palabra, fuente, tamano)
        if actual:
            if actual[-1][0].strip() == "":
                actual.pop()
            lineas.append(actual)
        return lineas

    def parrafo(self, texto, tamano=CUERPO):
        """A la izquierda, no justificado: justificar deja rios de blanco."""
        trozos = self._trocear(texto, "tiro", tamano, "cons", CODIGO, NEGRO)
        for linea in self._partir_lineas(trozos):
            self.reservar(INTERLINEA)
            self.dibujar_linea(IZQ, self.y, linea)
            self.y += INTERLINEA
        self.y += DESPUES_PARRAFO

    def bloque_codigo(self, codigo, lenguaje):
        lineas = []
        for bruta in codigo.split("\n"):
            lineas.extend(partir_codigo(bruta, lenguaje))
        self.reservar(ANTES_CODIGO + len(lineas) * INTERLINEA_CODIGO)
        self.y += ANTES_CODIGO
        for trozo in lineas:
            self.reservar(INTERLINEA_CODIGO)
            base = self.y + ascender("cons", CODIGO)
            cursor = IZQ
            for texto, estilo in trozo:
                fuente, color = PALETA_CODIGO[estilo]
                self.escribir(cursor, base, texto, fuente, CODIGO, color)
                cursor += ancho(texto, fuente, CODIGO)
            self.y += INTERLINEA_CODIGO
        self.y += DESPUES_CODIGO

    def imagen(self, ruta, pie=""):
        pix = pymupdf.Pixmap(str(ruta))
        ancho_img = self.ancho_imagen
        if ALTO_MAX_IMAGEN and ancho_img * pix.height / pix.width > ALTO_MAX_IMAGEN:
            ancho_img = ALTO_MAX_IMAGEN * pix.width / pix.height
        alto = ancho_img * pix.height / pix.width
        del pix

        lineas_pie, actual, usado = [], [], 0.0
        for palabra in pie.split():
            medida = ancho(palabra + " ", "tiro", CUERPO)
            if usado + medida > ancho_img and actual:
                lineas_pie.append(" ".join(actual) + " ")
                actual, usado = [], 0.0
            actual.append(palabra)
            usado += medida
        if actual:
            lineas_pie.append(" ".join(actual) + " ")

        self.reservar(alto + len(lineas_pie) * INTERLINEA)
        self.y += ANTES_IMAGEN
        x = (ANCHO - ancho_img) / 2
        self.pagina.insert_image(
            pymupdf.Rect(x, self.y, x + ancho_img, self.y + alto), filename=str(ruta)
        )
        self.y += alto + HUECO_IMAGEN_PIE
        for linea in lineas_pie:
            self.dibujar_linea(x, self.y, [(linea, "tiro", CUERPO, NEGRO)])
            self.y += INTERLINEA
        self.y += DESPUES_IMAGEN

    def encabezado(self, nivel, texto, sin_espacio_antes=False):
        if nivel == 1:
            tam, interlinea = TITULO, INTERLINEA_TITULO
            antes, despues = ANTES_TITULO, DESPUES_TITULO
            fuente_texto, fuente_codigo = "tibo", "consb"
        elif nivel == 2:
            tam, interlinea = SECCION, INTERLINEA_SECCION
            antes, despues = ANTES_SECCION, DESPUES_SECCION
            fuente_texto, fuente_codigo = "tibo", "consb"
        else:
            tam, interlinea = EJERCICIO, INTERLINEA_EJERCICIO
            antes, despues = ANTES_EJERCICIO, DESPUES_EJERCICIO
            fuente_texto, fuente_codigo = "tibo", "consb"
        if sin_espacio_antes or self.y <= SUP + 0.01:
            antes = 0.0
        self.reservar(antes + interlinea)
        self.y += antes
        trozos = self._trocear(texto, fuente_texto, tam, fuente_codigo, CODIGO_EN_TITULO, NEGRO)
        for linea in self._partir_lineas(trozos):
            self.reservar(interlinea)
            self.dibujar_linea(IZQ, self.y, linea)
            self.y += interlinea
        self.y += despues

    def guardar(self, destino=None):
        destino = destino or DESTINO
        for numero, escritor in self.escritores:
            escritor.write_text(self.doc[numero])
        self.doc.save(str(destino), garbage=3, deflate=True)
        self.doc.close()
        return destino


def analizar(md):
    """Markdown -> lista de bloques: parrafo, codigo, imagen, titulo."""
    bloques, parrafo = [], []
    lineas = md.split("\n")
    indice = 0

    def cerrar_parrafo():
        if parrafo:
            bloques.append(("parrafo", " ".join(parrafo).strip()))
            parrafo.clear()

    while indice < len(lineas):
        linea = lineas[indice]
        if linea.startswith("```"):
            lenguaje = linea[3:].strip() or "js"
            cerrar_parrafo()
            indice += 1
            codigo = []
            while indice < len(lineas) and not lineas[indice].startswith("```"):
                codigo.append(lineas[indice])
                indice += 1
            bloques.append(("codigo", lenguaje, "\n".join(codigo)))
            indice += 1
            continue
        if linea.startswith("#"):
            cerrar_parrafo()
            nivel = len(linea) - len(linea.lstrip("#"))
            bloques.append(("titulo", nivel, linea[nivel:].strip()))
            indice += 1
            continue
        if linea.startswith("!["):
            cerrar_parrafo()
            c = re.match(r"!\[(.*?)\]\((.*?)\)", linea)
            bloques.append(("imagen", c.group(2), c.group(1)))
            indice += 1
            continue
        if not linea.strip():
            cerrar_parrafo()
            indice += 1
            continue
        parrafo.append(linea.strip())
        indice += 1

    cerrar_parrafo()
    return bloques


def dibujar_bloque(doc, bloque):
    tipo = bloque[0]
    if tipo == "parrafo":
        doc.parrafo(bloque[1])
    elif tipo == "codigo":
        doc.bloque_codigo(bloque[2], bloque[1])
    elif tipo == "imagen":
        doc.imagen(IMAGENES_BASE / bloque[1], bloque[2])
    else:
        doc.encabezado(bloque[1], bloque[2], sin_espacio_antes=True)


def principal():
    doc = Documento()
    if ROTULO:
        doc.dibujar_linea(0, Y_ROTULO, [(ROTULO, "tibo", TITULO, NEGRO)],
                          alineacion="centro")
        doc.y = Y_TITULO

    anterior = None
    primer_ejercicio = True
    for bloque in analizar(ORIGEN.read_text(encoding="utf-8")):
        if bloque[0] == "titulo" and "11. Comandos" in bloque[2]:
            doc.reservar(9999)  # forzar salto de pagina
        if bloque[0] == "titulo":
            con_regla = bloque[1] >= 3 and not primer_ejercicio
            if con_regla:
                doc.separador()
            doc.encabezado(
                bloque[1], bloque[2],
                sin_espacio_antes=con_regla
                or (primer_ejercicio
                    and bool(anterior and anterior[0] == "titulo" and anterior[1] == 2)),
            )
            if bloque[1] >= 3:
                primer_ejercicio = False
        else:
            dibujar_bloque(doc, bloque)
        anterior = bloque

    destino = doc.guardar()
    print(f"PDF generado: {destino}  ({destino.stat().st_size / 1024:.0f} KB)")


if __name__ == "__main__":
    try:
        principal()
    except Exception as error:  # noqa: BLE001
        print(f"ERROR: {error}", file=sys.stderr)
        raise
