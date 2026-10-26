# -*- coding: utf-8 -*-
"""
Generador del PDF de teoría — Entorno Cliente, Unidad 2 (DWEC).

Maquetación propia sobre PyMuPDF:
  · portada e índice con números de página reales
  · texto justificado con jerarquía tipográfica
  · listas con sangría francesa
  · tablas con anchos proporcionales y celdas multilínea
  · cajas de aviso (idea / atención / truco / cuidado)
  · bloques de código con numeración, ajuste de línea y resaltado
"""
import re
import sys
from pathlib import Path

import pymupdf

# ==================================================================== RUTAS ====
BASE = Path(__file__).resolve().parent
ORIGEN = BASE / "Teoria_Unidad2_DWEC.md"
DESTINO = BASE / "Teoria_Unidad2_DWEC.pdf"

# ================================================================== MEDIDAS ====
ANCHO, ALTO = 595.276, 841.890          # A4 en puntos
MARGEN_X = 58.0
IZQ = MARGEN_X
DER = ANCHO - MARGEN_X
ANCHO_TEXTO = DER - IZQ                 # 479.28
SUP, INF = 66.0, 774.0                  # zona útil

# =================================================================== COLORES ===
C_NAVY = (13 / 255, 39 / 255, 63 / 255)
C_AZUL = (26 / 255, 107 / 255, 173 / 255)
C_AZUL_SUAVE = (91 / 255, 155 / 255, 204 / 255)
C_TEXTO = (31 / 255, 41 / 255, 51 / 255)
C_MUTED = (110 / 255, 124 / 255, 139 / 255)
C_LINEA = (213 / 255, 221 / 255, 230 / 255)
C_LINEA_FUERTE = (180 / 255, 194 / 255, 208 / 255)
C_FILA = (245 / 255, 248 / 255, 251 / 255)
C_CELDA = (255 / 255, 255 / 255, 255 / 255)
C_BLANCO = (1.0, 1.0, 1.0)
C_CODE_BG = (247 / 255, 248 / 255, 250 / 255)
C_CODE_NUM = (150 / 255, 163 / 255, 176 / 255)

# =================================================================== FUENTES ===
RUTAS = {
    "texto": r"C:\Windows\Fonts\times.ttf",
    "texto_b": r"C:\Windows\Fonts\timesbd.ttf",
    "texto_i": r"C:\Windows\Fonts\timesi.ttf",
    "texto_bi": r"C:\Windows\Fonts\timesbi.ttf",
    "sans": r"C:\Windows\Fonts\arial.ttf",
    "sans_b": r"C:\Windows\Fonts\arialbd.ttf",
    "sans_i": r"C:\Windows\Fonts\ariali.ttf",
    "mono": r"C:\Windows\Fonts\lucon.ttf",
    "mono_b": r"C:\Windows\Fonts\lucon.ttf",
    "mono_i": r"C:\Windows\Fonts\lucon.ttf",
}
MEDIDAS = {alias: pymupdf.Font(fontfile=ruta) for alias, ruta in RUTAS.items()}


def ancho(texto, alias, tam):
    return MEDIDAS[alias].text_length(texto, fontsize=tam)


def _calibrar(alias):
    """Distancia (en fracción del tamaño) entre la línea base y el borde superior."""
    prueba = pymupdf.open()
    pagina = prueba.new_page(width=200, height=200)
    pagina.insert_font(fontname="m", fontfile=RUTAS[alias])
    pagina.insert_text((20, 150), "H", fontname="m", fontsize=100)
    caja = pagina.get_text("dict")["blocks"][0]["lines"][0]["spans"][0]["bbox"]
    prueba.close()
    return (150 - caja[1]) / 100


_ASC = {alias: _calibrar(alias) for alias in RUTAS}


def asc(alias, tam):
    return _ASC[alias] * tam


# ================================================================== ESTILOS ====
# estilo -> (fuente, color, ajuste de tamaño)
ESTILOS = {
    "normal": ("texto", C_TEXTO, 0.0),
    "negrita": ("texto_b", C_TEXTO, 0.0),
    "cursiva": ("texto_i", C_TEXTO, 0.0),
    "negrita_cursiva": ("texto_bi", C_TEXTO, 0.0),
    "codigo": ("mono", (0.16, 0.28, 0.40), -0.7),
    "codigo_negrita": ("mono_b", (0.16, 0.28, 0.40), -0.7),
}

EMOJI = re.compile(
    "[\U0001F000-\U0001FAFF\u2600-\u27BF\u2B00-\u2BFF\uFE0F\u200D]"
)

RX_ENLINEA = re.compile(r"\*\*(.+?)\*\*|`([^`]+)`|(?<![\w*])_([^_\n]+)_(?![\w*])")


def limpiar(texto):
    texto = EMOJI.sub("", texto)
    texto = re.sub(r"<a\s[^>]*>\s*</a>", "", texto)
    texto = re.sub(r"\[([^\]]+)\]\([^)]*\)", r"\1", texto)
    texto = texto.replace("\u00ad", "")
    return re.sub(r"[ \t]{2,}", " ", texto).strip()


def texto_plano(texto):
    """Quita el marcado en línea para medir o para el índice."""
    return limpiar(re.sub(r"[*`]", "", texto))


def _tokens(texto, estilo="normal"):
    salida = []
    pos = 0
    for m in RX_ENLINEA.finditer(texto):
        if m.start() > pos:
            salida.append((texto[pos:m.start()], estilo))
        if m.group(1) is not None:
            base = "negrita_cursiva" if "cursiva" in estilo else "negrita"
            salida.extend(_tokens(m.group(1), base))
        elif m.group(2) is not None:
            base = "codigo_negrita" if "negrita" in estilo else "codigo"
            salida.append((m.group(2), base))
        else:
            base = "negrita_cursiva" if "negrita" in estilo else "cursiva"
            salida.append((m.group(3), base))
        pos = m.end()
    if pos < len(texto):
        salida.append((texto[pos:], estilo))
    return salida


def piezas_texto(texto, tam, estilo="normal"):
    """Convierte Markdown en línea en piezas (texto, fuente, color, tamaño)."""
    return [(trozo, ESTILOS[est][0], ESTILOS[est][1], tam + ESTILOS[est][2])
            for trozo, est in _tokens(texto, estilo)]


def piezas_titulo(texto, tam, color):
    """Títulos: sans negrita, con los fragmentos de código en monoespaciada."""
    salida = []
    for i, parte in enumerate(re.split(r"(`[^`]+`)", texto)):
        if not parte:
            continue
        if parte.startswith("`") and parte.endswith("`"):
            salida.append((parte[1:-1], "mono_b", color, tam - 1.4))
        else:
            salida.append((parte, "sans_b", color, tam))
    return salida


# ============================================================== MAQUETACIÓN ====
def a_palabras(piezas):
    """Agrupa piezas en palabras; conserva los cambios de estilo dentro de cada una."""
    palabras, actual = [], []
    for texto, fuente, color, tam in piezas:
        for trozo in re.split(r"(\s+)", texto):
            if not trozo:
                continue
            if trozo.isspace():
                if actual:
                    palabras.append(actual)
                    actual = []
            else:
                actual.append((trozo, fuente, color, tam))
    if actual:
        palabras.append(actual)
    return palabras


def ancho_palabra(palabra):
    return sum(ancho(t, f, s) for t, f, _, s in palabra)


def partir_palabra(palabra, limite):
    """Trocea una palabra demasiado larga (URL, código) para que no desborde."""
    trozos, actual, usado = [], [], 0.0
    for texto, fuente, color, tam in palabra:
        resto = texto
        while resto:
            if usado + ancho(resto, fuente, tam) <= limite:
                actual.append((resto, fuente, color, tam))
                usado += ancho(resto, fuente, tam)
                resto = ""
                continue
            n = 0
            while n < len(resto) and usado + ancho(resto[: n + 1], fuente, tam) <= limite:
                n += 1
            if n == 0:
                if actual:
                    trozos.append(actual)
                    actual, usado = [], 0.0
                    continue
                n = 1
            actual.append((resto[:n], fuente, color, tam))
            usado += ancho(resto[:n], fuente, tam)
            trozos.append(actual)
            actual, usado = [], 0.0
            resto = resto[n:]
    if actual:
        trozos.append(actual)
    return trozos


def maquetar(piezas, ancho_max, tam_base):
    """Devuelve [(palabras, ancho_usado), ...] ajustado a `ancho_max`."""
    palabras = []
    for palabra in a_palabras(piezas):
        if ancho_palabra(palabra) > ancho_max:
            palabras.extend(partir_palabra(palabra, ancho_max))
        else:
            palabras.append(palabra)

    hueco = ancho(" ", "texto", tam_base)
    lineas, actual, usado = [], [], 0.0
    for palabra in palabras:
        w = ancho_palabra(palabra)
        extra = hueco if actual else 0.0
        if actual and usado + extra + w > ancho_max + 0.05:
            lineas.append((actual, usado))
            actual, usado = [palabra], w
        else:
            actual.append(palabra)
            usado += extra + w
    if actual:
        lineas.append((actual, usado))
    return lineas


# ========================================================== RESALTADO CÓDIGO ==
CLAVES_JS = {
    "const", "let", "var", "function", "return", "new", "if", "else", "for",
    "while", "do", "switch", "case", "break", "continue", "class", "extends",
    "import", "export", "default", "from", "try", "catch", "finally", "throw",
    "typeof", "instanceof", "delete", "in", "of", "async", "await", "yield",
    "true", "false", "null", "undefined", "this", "super", "void", "static",
}
GLOBALES_JS = {
    "document", "window", "console", "alert", "prompt", "confirm", "Math",
    "JSON", "Number", "String", "Boolean", "Array", "Object", "NaN",
    "Infinity", "setTimeout", "setInterval", "parseInt", "parseFloat",
}
RESERVADAS_HTML = {
    "html", "head", "body", "title", "meta", "link", "script", "style", "div",
    "span", "input", "form", "button", "p", "a", "ul", "li", "h1", "h2",
}

RX_JS = re.compile(
    r"""(?P<comentario>//[^\n]*)
      | (?P<cadena>'(?:[^'\\]|\\.)*'|"(?:[^"\\]|\\.)*"|`(?:[^`\\]|\\.)*`)
      | (?P<numero>\d+(?:[.,]\d+)?(?:[eE][+-]?\d+)?)
      | (?P<palabra>[A-Za-z_$\u00c0-\u024f][\w$\u00c0-\u024f]*)
      | (?P<espacio>\s+)
      | (?P<operador>===|!==|==|!=|=>|\+\+|--|&&|\|\||\?\?|\?\.|\.\.\.|[-+*/%<>=!|&?~^])
      | (?P<puntuacion>[(){}\[\];,.:])
      | (?P<otro>.)""",
    re.X,
)

PALETA = {
    "normal": ("mono", (0.11, 0.15, 0.20)),
    "clave": ("mono", (0.05, 0.26, 0.50)),
    "global": ("mono", (0.11, 0.42, 0.56)),
    "cadena": ("mono", (0.55, 0.14, 0.14)),
    "numero": ("mono", (0.05, 0.42, 0.36)),
    "comentario": ("mono", (0.42, 0.49, 0.42)),
    "operador": ("mono", (0.30, 0.34, 0.38)),
    "puntuacion": ("mono", (0.30, 0.34, 0.38)),
    "etiqueta": ("mono", (0.05, 0.33, 0.55)),
}

RX_HTML = re.compile(
    r"""(?P<comentario><!--.*?-->)
      | (?P<apertura><)(?P<nombre>[A-Za-z][\w-]*)
      | (?P<cierra></)(?P<nombre2>[A-Za-z][\w-]*)
      | (?P<cadena>"[^"]*"|'[^']*')
      | (?P<espacio>\s+)
      | (?P<operador>=)
      | (?P<puntuacion>[>/])""",
    re.X,
)


def resaltar(linea, lenguaje="js"):
    """Devuelve piezas (texto, fuente, color, tamaño). No pierde ningún carácter."""
    patron = RX_HTML if lenguaje.lower() in {"html", "xml"} else RX_JS
    piezas = []
    for m in patron.finditer(linea):
        grupo = m.lastgroup
        if grupo == "comentario":
            estilo = "comentario"
        elif grupo == "cadena":
            estilo = "cadena"
        elif grupo in {"nombre", "nombre2"}:
            estilo = "etiqueta"
        elif grupo in {"apertura", "cierra", "puntuacion"}:
            estilo = "puntuacion"
        elif grupo in {"operador"}:
            estilo = "operador"
        elif grupo == "numero":
            estilo = "numero"
        elif grupo == "palabra":
            palabra = m.group(0)
            if lenguaje.lower() in {"html", "xml"}:
                estilo = "etiqueta" if palabra.lower() in RESERVADAS_HTML else "normal"
            elif palabra in CLAVES_JS:
                estilo = "clave"
            elif palabra in GLOBALES_JS:
                estilo = "global"
            else:
                estilo = "normal"
        else:
            estilo = "normal"
        fuente, color = PALETA[estilo]
        piezas.append((m.group(0), fuente, color, TAM_CODIGO))
    if not piezas and linea:
        piezas.append((linea, "mono", PALETA["normal"][1], TAM_CODIGO))
    return piezas


TAM_CODIGO = 8.7
ALTO_CODIGO = 12.0
SANGRIA_CODIGO = 38.0

# ==================================================================== AVISOS ==
AVISOS = {
    "idea": ((232 / 255, 241 / 255, 250 / 255), C_AZUL, "IDEA CLAVE"),
    "ojo": ((253 / 255, 246 / 255, 227 / 255), (196 / 255, 145 / 255, 40 / 255), "ATENCIÓN"),
    "truco": ((233 / 255, 246 / 255, 236 / 255), (56 / 255, 142 / 255, 79 / 255), "TRUCO"),
    "error": ((252 / 255, 236 / 255, 235 / 255), (176 / 255, 48 / 255, 42 / 255), "CUIDADO"),
}


def clasificar(titulo):
    t = titulo.lower()
    if "analog" in t or "idea" in t or "fin de la teor" in t:
        return "idea"
    if "truco" in t or "consejo" in t:
        return "truco"
    if "nunca" in t or "error" in t or "cuidado" in t or "antipatr" in t:
        return "error"
    return "ojo"


# ================================================================= DOCUMENTO ==
def _atoms_codigo(piezas):
    """Divide el código en átomos: palabras y tramos exactos de espacios."""
    atoms, buffer, tipo = [], [], None
    for texto, fuente, color, tam in piezas:
        for trozo in re.split(r"( +)", texto):
            if not trozo:
                continue
            nuevo = "espacio" if trozo[0] == " " else "palabra"
            if nuevo != tipo and buffer:
                atoms.append((tipo, buffer))
                buffer = []
            tipo = nuevo
            buffer.append((trozo, fuente, color, tam))
    if buffer:
        atoms.append((tipo, buffer))
    return atoms


def _ancho_piezas(piezas):
    return sum(ancho(t, f, s) for t, f, _, s in piezas)


class Documento:
    def __init__(self):
        self.doc = pymupdf.open()
        self.pagina = None
        self.y = SUP
        self.indice = []          # (numero, titulo, pagina)

    # ------------------------------------------------------------ páginas --
    def nueva_pagina(self):
        pagina = self.doc.new_page(width=ANCHO, height=ALTO)
        for alias, ruta in RUTAS.items():
            pagina.insert_font(fontname=alias, fontfile=ruta)
        self.pagina = pagina
        self.y = SUP
        return pagina

    def ir_a(self, indice):
        self.pagina = self.doc[indice]
        self.y = SUP

    @property
    def numero_pagina(self):
        return self.pagina.number + 1

    def reservar(self, alto):
        if self.y + alto > INF:
            self.nueva_pagina()

    # ------------------------------------------------------------- texto ----
    def escribir(self, x, base, texto, fuente, tam, color):
        if not texto:
            return
        self.pagina.insert_text((x, base), texto, fontname=fuente, fontsize=tam, color=color)

    def linea(self, palabras, usado, x0, ancho_max, justificar):
        if not palabras:
            return
        n = len(palabras)
        tam = max(p[0][3] for p in palabras)
        hueco = ancho(" ", "texto", tam)
        if justificar and n > 1:
            hueco += max(0.0, (ancho_max - usado) / (n - 1))
        base = self.y + max(asc(p[0][1], p[0][3]) for p in palabras)
        x = x0
        for palabra in palabras:
            for texto, fuente, color, t in palabra:
                self.escribir(x, base, texto, fuente, t, color)
                x += ancho(texto, fuente, t)
            x += hueco
        return x

    def flujo(self, piezas, x0, ancho_max, tam, alto_linea, justificar=True,
              antes=0.0, despues=0.0):
        lineas = maquetar(piezas, ancho_max, tam)
        if not lineas:
            return
        self.y += antes
        ultima = len(lineas) - 1
        for i, (palabras, usado) in enumerate(lineas):
            if self.y + alto_linea > INF:
                self.nueva_pagina()
            self.linea(palabras, usado, x0, ancho_max, justificar and i != ultima)
            self.y += alto_linea
        self.y += despues

    def parrafo(self, texto, tam=10.4, alto_linea=15.0, antes=0.0, despues=7.5,
                justificar=True):
        piezas = piezas_texto(limpiar(texto), tam)
        self.flujo(piezas, IZQ, ANCHO_TEXTO, tam, alto_linea, justificar, antes, despues)

    # --------------------------------------------------------- encabezados --
    def titulo1(self, texto, numero=None):
        """Encabezado de capítulo: separador si continúa en la misma página."""
        if self.y > SUP + 1:
            if INF - self.y < 260:
                self.nueva_pagina()
            else:
                self.y += 12
                self.pagina.draw_rect(
                    pymupdf.Rect(IZQ, self.y, DER, self.y + 0.7),
                    color=C_LINEA, fill=C_LINEA, width=0)
                self.y += 26

        piezas = piezas_titulo(limpiar(texto), 16.0, C_NAVY)
        lineas = maquetar(piezas, ANCHO_TEXTO - 32, 16.0)
        alto = len(lineas) * 21.0 + 14

        y0 = self.y
        self.pagina.draw_rect(pymupdf.Rect(IZQ, y0 + 1, IZQ + 3.2, y0 + alto - 10),
                              color=C_AZUL, fill=C_AZUL, width=0)
        if numero:
            self.escribir(IZQ + 12, y0 + 15, numero, "sans_b", 19, C_AZUL_SUAVE)
            x0 = IZQ + 34
            ancho_max = ANCHO_TEXTO - 34
        else:
            x0 = IZQ + 12
            ancho_max = ANCHO_TEXTO - 12
        self.y = y0 + 2
        self.flujo(piezas, x0, ancho_max, 16.0, 21.0, justificar=False, despues=2)
        self.pagina.draw_rect(pymupdf.Rect(IZQ, self.y + 4, DER, self.y + 5.2),
                              color=C_LINEA_FUERTE, fill=C_LINEA_FUERTE, width=0)
        self.y += 16

    def titulo2(self, texto):
        piezas = piezas_titulo(limpiar(texto), 11.8, C_AZUL)
        lineas = maquetar(piezas, ANCHO_TEXTO - 14, 11.8)
        alto = len(lineas) * 15.0
        if self.y + alto + 15 * 2 > INF:
            self.nueva_pagina()
        y0 = self.y + 11
        self.y = y0
        self.pagina.draw_rect(pymupdf.Rect(IZQ, y0 + 3.5, IZQ + 4.6, y0 + 9.4),
                              color=C_AZUL, fill=C_AZUL, width=0)
        self.flujo(piezas, IZQ + 13, ANCHO_TEXTO - 13, 11.8, 15.0,
                   justificar=False, despues=6)

    def titulo3(self, texto):
        piezas = piezas_titulo(limpiar(texto), 10.6, C_NAVY)
        lineas = maquetar(piezas, ANCHO_TEXTO, 10.6)
        alto = len(lineas) * 13.8
        if self.y + alto + 15 * 2 > INF:
            self.nueva_pagina()
        self.y += 8
        self.flujo(piezas, IZQ, ANCHO_TEXTO, 10.6, 13.8, justificar=False, despues=4)

    # --------------------------------------------------------------- listas -
    def lista(self, items, ordenada=False):
        tam = 10.4
        sangria = 17.0
        for i, item in enumerate(items, start=1):
            piezas = piezas_texto(limpiar(item), tam)
            lineas = maquetar(piezas, ANCHO_TEXTO - sangria, tam)
            if not lineas:
                continue
            if self.y + 15.0 * min(2, len(lineas)) > INF:
                self.nueva_pagina()
            marca = f"{i}." if ordenada else "\u2022"
            base = self.y + asc("texto", tam)
            if ordenada:
                self.escribir(IZQ + sangria - 6 - ancho(marca, "texto_b", tam), base,
                              marca, "texto_b", tam, C_AZUL)
            else:
                self.escribir(IZQ + 3, base, marca, "texto_b", 12.5, C_AZUL)
            ultima = len(lineas) - 1
            for j, (palabras, usado) in enumerate(lineas):
                if self.y + 15.0 > INF:
                    self.nueva_pagina()
                    base = self.y + asc("texto", tam)
                if j > 0:
                    base = self.y + asc("texto", tam)
                self.linea(palabras, usado, IZQ + sangria, ANCHO_TEXTO - sangria,
                           j != ultima)
                self.y += 15.0
            self.y += 2.6
        self.y += 4.0

    # ---------------------------------------------------------------- código
    def _envolver_codigo(self, piezas, disponible, sangria=0):
        """Ajusta una línea de código por palabras, conservando la sangría.

        Los tramos de espacios se mantienen tal cual (así las columnas de
        comentarios siguen alineadas) y solo se trocea una palabra cuando
        ella sola no cabe en el ancho útil.
        """
        blanco = PALETA["normal"][1]

        # La sangría inicial se separa del contenido para poder repetirla
        # en las líneas de continuación.
        cuerpo = []
        restante = sangria
        for texto, fuente, color, tam in piezas:
            if restante > 0:
                quitados = 0
                while (quitados < restante and quitados < len(texto)
                       and texto[quitados] == " "):
                    quitados += 1
                restante -= quitados
                texto = texto[quitados:]
                if not texto:
                    continue
            cuerpo.append((texto, fuente, color, tam))

        atoms = _atoms_codigo(cuerpo)
        prefijo = " " * sangria
        continuacion = " " * (sangria + 2)

        lineas = []
        actual, usado = [], 0.0
        pendiente, pendiente_w = [], 0.0
        cabecera = prefijo

        def cerrar():
            nonlocal actual, usado, pendiente, pendiente_w
            piezas_linea = []
            if cabecera:
                piezas_linea.append((cabecera, "mono", blanco, TAM_CODIGO))
            piezas_linea.extend(actual)
            lineas.append((piezas_linea,
                           ancho(cabecera, "mono", TAM_CODIGO) + usado))
            actual, usado = [], 0.0
            pendiente, pendiente_w = [], 0.0

        for tipo, trozo in atoms:
            if tipo == "espacio":
                if actual:
                    pendiente, pendiente_w = trozo, _ancho_piezas(trozo)
                continue

            w = _ancho_piezas(trozo)
            if actual:
                previo = ancho(cabecera, "mono", TAM_CODIGO) + usado + pendiente_w
                if previo + w <= disponible + 0.05:
                    actual.extend(pendiente)
                    usado += pendiente_w
                    actual.extend(trozo)
                    usado += w
                    pendiente, pendiente_w = [], 0.0
                    continue
                cerrar()
                cabecera = continuacion

            limite = max(disponible - ancho(cabecera, "mono", TAM_CODIGO), 24.0)
            if w <= limite:
                actual, usado = list(trozo), w
                continue
            trozos = partir_palabra(trozo, limite)
            for indice, parte in enumerate(trozos):
                actual, usado = list(parte), _ancho_piezas(parte)
                if indice < len(trozos) - 1:
                    cerrar()
                    cabecera = continuacion

        if actual or not lineas:
            cerrar()
        return lineas

    def codigo(self, codigo, lenguaje="js"):
        disponible = ANCHO_TEXTO - SANGRIA_CODIGO - 6
        registros = []                      # (numero | None, piezas, usado)
        numero = 0
        for bruta in codigo.replace("\t", "    ").split("\n"):
            if not bruta.strip():
                numero += 1
                registros.append((None, [], 0.0))
                continue
            numero += 1
            sangria = len(bruta) - len(bruta.lstrip(" "))
            piezas = resaltar(bruta, lenguaje)
            for i, (pzas, usado) in enumerate(
                    self._envolver_codigo(piezas, disponible, sangria)):
                registros.append((numero if i == 0 else None, pzas, usado))

        relleno = 8.0
        while registros:
            espacio = INF - self.y
            caben = int((espacio - 2 * relleno) // ALTO_CODIGO)
            if caben < 2:
                self.nueva_pagina()
                continue
            if caben < len(registros) and espacio < 300:
                self.nueva_pagina()
                continue
            caben = min(caben, len(registros))
            trozo, registros = registros[:caben], registros[caben:]
            self._panel_codigo(trozo, relleno)

        self.y += 4

    def _panel_codigo(self, trozo, relleno):
        alto = relleno * 2 + len(trozo) * ALTO_CODIGO
        x0, x1 = IZQ - 7, DER + 7
        y0 = self.y
        self.pagina.draw_rect(pymupdf.Rect(x0, y0, x1, y0 + alto),
                              color=C_CODE_BG, fill=C_CODE_BG, width=0)
        self.pagina.draw_rect(pymupdf.Rect(x0, y0, x0 + 2.8, y0 + alto),
                              color=C_AZUL, fill=C_AZUL, width=0)
        self.pagina.draw_line(pymupdf.Point(IZQ + 26, y0 + 5),
                              pymupdf.Point(IZQ + 26, y0 + alto - 5),
                              color=C_LINEA, width=0.5)
        for i, (numero, piezas, usado) in enumerate(trozo):
            base = y0 + relleno + i * ALTO_CODIGO + asc("mono", TAM_CODIGO) + 1.6
            if numero is not None:
                etiqueta = f"{numero:>3}"
                self.escribir(IZQ + 22 - ancho(etiqueta, "mono", 7.6), base,
                              etiqueta, "mono", 7.6, C_CODE_NUM)
            x = IZQ + SANGRIA_CODIGO
            for texto, fuente, color, tam in piezas:
                self.escribir(x, base, texto, fuente, tam, color)
                x += ancho(texto, fuente, tam)
        self.y = y0 + alto

    # ---------------------------------------------------------------- tablas
    def tabla(self, filas):
        if not filas:
            return
        n_cols = max(len(f) for f in filas)
        filas = [f + [""] * (n_cols - len(f)) for f in filas]
        tam = 8.9
        pad_x, pad_y = 6.0, 5.0
        alto_linea = 11.4

        # Piezas reales de cada celda: la cabecera usa sans negrita y cuerpo
        # blanco; el resto, el texto con sus estilos en línea.
        piezas_filas = []
        for indice, fila in enumerate(filas):
            if indice == 0:
                piezas_filas.append([
                    [(t, "sans_b", C_BLANCO, tam - 0.3) for t, _, _, _ in
                     piezas_texto(limpiar(celda), tam, "negrita")]
                    for celda in fila
                ])
            else:
                piezas_filas.append([piezas_texto(limpiar(c), tam) for c in fila])

        # Ancho mínimo = palabra más larga de la columna; ideal = celda más
        # ancha, acotada para que ninguna columna se coma la tabla.
        minimos, ideales = [], []
        for j in range(n_cols):
            palabras = []
            for fila in piezas_filas:
                palabras.extend(ancho_palabra(p) for p in a_palabras(fila[j]))
            minimos.append((max(palabras) if palabras else 0.0) + 2 * pad_x + 1.5)
            completo = max(sum(ancho(t, f, s) for t, f, _, s in fila[j])
                           for fila in piezas_filas)
            ideales.append(min(max(completo + 2 * pad_x, minimos[-1]), 250.0))

        anchos = self._repartir_anchos(minimos, ideales)

        # Contenido y altura de cada fila.
        contenido = []
        for fila in piezas_filas:
            celdas = [maquetar(piezas, anchos[j] - 2 * pad_x, tam)
                      for j, piezas in enumerate(fila)]
            alto = max(len(c) for c in celdas) * alto_linea + 2 * pad_y
            contenido.append((celdas, max(alto, 19.0)))

        cabecera_lineas, alto_cabecera = contenido[0]

        if self.y + alto_cabecera + sum(h for _, h in contenido[1:3]) > INF:
            self.nueva_pagina()

        self._dibujar_tabla(contenido, cabecera_lineas, alto_cabecera, anchos,
                            tam, pad_x, pad_y, alto_linea)
        self.y += 8

    @staticmethod
    def _repartir_anchos(minimos, ideales):
        """Reparte el ancho útil respetando el mínimo de cada columna."""
        total_min = sum(minimos)
        total_ideal = sum(ideales)

        if total_min >= ANCHO_TEXTO:          # caso extremo: no cabe ni el mínimo
            factor = ANCHO_TEXTO / total_min
            return [m * factor for m in minimos]

        if total_ideal <= ANCHO_TEXTO:
            anchos = [i * ANCHO_TEXTO / total_ideal for i in ideales]
        else:
            anchos = list(ideales)

        # Subir las columnas que quedan por debajo del mínimo, quitando el
        # espacio a las que tienen holgura, en proporción a esa holgura.
        for _ in range(6):
            deficit = sum(max(0.0, m - a) for m, a in zip(minimos, anchos))
            if deficit <= 0.01:
                break
            holgura = sum(a - m for m, a in zip(minimos, anchos) if a > m)
            if holgura <= 0.01:
                break
            anchos = [m if a < m else a - (a - m) * deficit / holgura
                      for m, a in zip(minimos, anchos)]

        # Ajuste fino para que el total cuadre exactamente con el ancho útil.
        desvio = ANCHO_TEXTO - sum(anchos)
        if abs(desvio) > 0.01:
            holgura = sum(a - m for m, a in zip(minimos, anchos) if a > m)
            if holgura > 0.01:
                anchos = [a + desvio * (a - m) / holgura if a > m else a
                          for m, a in zip(minimos, anchos)]
            else:
                anchos[-1] += desvio
        return anchos

    def _dibujar_tabla(self, contenido, cabecera, alto_cabecera, anchos,
                       tam, pad_x, pad_y, alto_linea):
        x0 = IZQ
        columnas = len(anchos)
        total = sum(anchos)

        def pintar_fila(celdas, alto, fondo):
            y0 = self.y
            x = x0
            for j in range(columnas):
                self.pagina.draw_rect(
                    pymupdf.Rect(x, y0, x + anchos[j], y0 + alto),
                    color=fondo, fill=fondo, width=0)
                self._celda(celdas[j], x, y0, pad_x, pad_y, alto_linea, tam)
                x += anchos[j]
            self.pagina.draw_line(pymupdf.Point(x0, y0 + alto),
                                  pymupdf.Point(x0 + total, y0 + alto),
                                  color=C_LINEA, width=0.5)
            self.y = y0 + alto

        def pintar_verticales(tope):
            x = x0
            for j in range(columnas + 1):
                self.pagina.draw_line(pymupdf.Point(x, tope),
                                      pymupdf.Point(x, self.y),
                                      color=C_LINEA, width=0.5)
                if j < columnas:
                    x += anchos[j]

        tope = self.y
        pintar_fila(cabecera, alto_cabecera, C_NAVY)

        for indice_fila, (celdas, alto) in enumerate(contenido[1:], start=1):
            if self.y + alto > INF:
                pintar_verticales(tope)
                self.nueva_pagina()
                tope = self.y
                pintar_fila(cabecera, alto_cabecera, C_NAVY)
            fondo = C_FILA if indice_fila % 2 == 0 else C_CELDA
            pintar_fila(celdas, alto, fondo)

        pintar_verticales(tope)

    def _celda(self, lineas, x, y, pad_x, pad_y, alto_linea, tam):
        yy = y + pad_y
        for palabras, usado in lineas:
            if not palabras:
                yy += alto_linea
                continue
            base = yy + max(asc(p[0][1], p[0][3]) for p in palabras)
            xx = x + pad_x
            for palabra in palabras:
                for texto, fuente, col, t in palabra:
                    self.escribir(xx, base, texto, fuente, t, col)
                    xx += ancho(texto, fuente, t)
                xx += ancho(" ", "texto", tam)
            yy += alto_linea

    # --------------------------------------------------------------- avisos -
    def aviso(self, titulo, cuerpo):
        tono = clasificar(titulo)
        fondo, barra, etiqueta = AVISOS[tono]
        pad = 10.0
        alto_linea = 13.4
        ancho_int = ANCHO_TEXTO - 2 * pad - 6

        piezas_cuerpo = piezas_texto(limpiar(cuerpo), 9.7)
        lineas_cuerpo = maquetar(piezas_cuerpo, ancho_int, 9.7) if cuerpo.strip() else []
        piezas_tit = piezas_texto(limpiar(titulo), 10.1, "negrita")
        lineas_tit = maquetar(piezas_tit, ancho_int, 10.1)

        alto = pad + 11 + 3 + len(lineas_tit) * 13.6 + 3 + len(lineas_cuerpo) * alto_linea + pad - 2
        if self.y + alto > INF:
            self.nueva_pagina()

        x0, x1 = IZQ - 7, DER + 7
        y0 = self.y
        self.pagina.draw_rect(pymupdf.Rect(x0, y0, x1, y0 + alto),
                              color=fondo, fill=fondo, width=0)
        self.pagina.draw_rect(pymupdf.Rect(x0, y0, x0 + 3.2, y0 + alto),
                              color=barra, fill=barra, width=0)

        self.escribir(IZQ + 3, y0 + pad + 7, etiqueta, "sans_b", 7.7, barra)
        y = y0 + pad + 11 + 3

        for palabras, usado in lineas_tit:
            base = y + asc("texto_b", 10.1)
            self._palabras_en(palabras, IZQ + 3, base, C_NAVY, 10.1)
            y += 13.6
        y += 3
        for palabras, usado in lineas_cuerpo:
            base = y + asc("texto", 9.7)
            self._palabras_en(palabras, IZQ + 3, base, C_TEXTO, 9.7)
            y += alto_linea

        self.y = y0 + alto + 8

    def _palabras_en(self, palabras, x, base, color, tam):
        for palabra in palabras:
            for texto, fuente, col, t in palabra:
                self.escribir(x, base, texto, fuente, t, color)
                x += ancho(texto, fuente, t)
            x += ancho(" ", "texto", tam)

    # --------------------------------------------------------------- guardar
    def guardar(self, destino=None):
        destino = destino or DESTINO
        self.doc.save(str(destino), garbage=4, deflate=True)
        self.doc.close()
        return destino


# ==================================================================== PORTADA ==
def dibujar_portada(doc):
    pagina = doc.pagina
    pagina.draw_rect(pymupdf.Rect(0, 0, ANCHO, 322), color=C_NAVY, fill=C_NAVY, width=0)
    pagina.draw_rect(pymupdf.Rect(0, 322, ANCHO, 328), color=C_AZUL, fill=C_AZUL, width=0)

    doc.escribir(IZQ, 84, "2.\u00ba DAW  ·  DESARROLLO DE APLICACIONES WEB",
                 "sans_b", 9, C_AZUL_SUAVE)
    doc.escribir(IZQ, 140, "Entorno Cliente", "sans_b", 38, C_BLANCO)
    doc.escribir(IZQ, 176, "Unidad 2", "sans", 25, (0.80, 0.87, 0.93))
    pagina.draw_rect(pymupdf.Rect(IZQ, 196, IZQ + 110, 198.4),
                     color=C_AZUL_SUAVE, fill=C_AZUL_SUAVE, width=0)
    doc.escribir(IZQ, 222, "Programación en el cliente con JavaScript",
                 "texto_i", 13.5, (0.82, 0.88, 0.93))
    doc.escribir(IZQ, 248, "Variables  ·  tipos  ·  operadores  ·  ámbito  ·  decisiones  ·  bucles",
                 "sans", 8.8, (0.62, 0.72, 0.81))


def dibujar_indice(doc, entradas):
    doc.ir_a(0)
    pagina = doc.pagina
    arriba = 372.0
    doc.escribir(IZQ, arriba, "Índice", "sans_b", 22, C_NAVY)
    pagina.draw_rect(pymupdf.Rect(IZQ, arriba + 10, IZQ + 40, arriba + 12.6),
                     color=C_AZUL, fill=C_AZUL, width=0)

    y = arriba + 44
    for numero, titulo, pagina_num in entradas:
        doc.escribir(IZQ, y, numero, "sans_b", 14, C_AZUL_SUAVE)
        doc.escribir(IZQ + 32, y, titulo, "sans_b", 10.2, C_NAVY)
        ancho_titulo = ancho(titulo, "sans_b", 10.2)
        ancho_num = ancho(str(pagina_num), "sans_b", 10.2)
        inicio = IZQ + 32 + ancho_titulo + 6
        fin = DER - ancho_num - 6
        if fin > inicio:
            puntos = int((fin - inicio) / ancho(".", "texto", 10.2))
            if puntos > 0:
                doc.escribir(inicio, y, "." * puntos, "texto", 10.2, C_LINEA_FUERTE)
        doc.escribir(DER - ancho_num, y, str(pagina_num), "sans_b", 10.2, C_AZUL)
        pagina.draw_line(pymupdf.Point(IZQ, y + 9), pymupdf.Point(DER, y + 9),
                         color=C_LINEA, width=0.5)
        y += 30


# ===================================================================== PARSER ==
def _celdas_tabla(linea):
    """Divide una fila de tabla por `|` sin romper los tramos de código."""
    texto = linea.strip()
    if texto.startswith("|"):
        texto = texto[1:]
    if texto.endswith("|"):
        texto = texto[:-1]
    celdas, actual, dentro = [], [], False
    for caracter in texto:
        if caracter == "`":
            dentro = not dentro
        if caracter == "|" and not dentro:
            celdas.append("".join(actual).strip())
            actual = []
        else:
            actual.append(caracter)
    celdas.append("".join(actual).strip())
    return celdas


def analizar(md):
    bloques = []
    parrafo = []
    lineas = md.split("\n")
    i, total = 0, len(md.split("\n"))
    lineas = md.split("\n")

    def cerrar():
        if parrafo:
            bloques.append(("parrafo", " ".join(parrafo).strip()))
            parrafo.clear()

    while i < total:
        linea = lineas[i]
        lim = linea.strip()

        if lim.startswith("```"):
            cerrar()
            lenguaje = lim[3:].strip() or "js"
            i += 1
            codigo = []
            while i < total and not lineas[i].strip().startswith("```"):
                codigo.append(lineas[i].rstrip())
                i += 1
            i += 1
            bloques.append(("codigo", lenguaje, "\n".join(codigo)))
            continue

        if not lim:
            cerrar()
            i += 1
            continue

        if re.match(r"<a\s", lim) or lim.startswith("<!--"):
            cerrar()
            i += 1
            continue

        m = re.match(r"^(#{1,6})\s+(.*)$", lim)
        if m:
            cerrar()
            bloques.append(("titulo", len(m.group(1)), m.group(2).strip()))
            i += 1
            continue

        if re.match(r"^[-*_]{3,}$", lim.replace(" ", "")):
            cerrar()
            i += 1
            continue

        if lim.startswith("|"):
            cerrar()
            filas = []
            while i < total and lineas[i].strip().startswith("|"):
                celdas = _celdas_tabla(lineas[i])
                if not all(re.match(r"^:?-{2,}:?$", c) for c in celdas):
                    filas.append(celdas)
                i += 1
            if filas:
                bloques.append(("tabla", filas))
            continue

        if lim.startswith(">"):
            cerrar()
            trozos = []
            while i < total and lineas[i].strip().startswith(">"):
                trozos.append(lineas[i].strip()[1:].strip())
                i += 1
            texto = " ".join(t for t in trozos if t)
            m = re.match(r"^\*\*(.+?)\*\*\s*(.*)$", texto)
            if m:
                titulo, cuerpo = m.group(1).strip(), m.group(2).strip()
            else:
                titulo, cuerpo = "Nota", texto
            bloques.append(("aviso", titulo, cuerpo))
            continue

        m = re.match(r"^\s*([-*+])\s+(.*)$", linea)
        if m:
            cerrar()
            items = []
            while i < total:
                mm = re.match(r"^\s*[-*+]\s+(.*)$", lineas[i])
                if not mm:
                    break
                items.append(mm.group(1).strip())
                i += 1
            bloques.append(("lista", items, False))
            continue

        m = re.match(r"^\s*(\d+)[.)]\s+(.*)$", linea)
        if m:
            cerrar()
            items = []
            while i < total:
                mm = re.match(r"^\s*\d+[.)]\s+(.*)$", lineas[i])
                if not mm:
                    break
                items.append(mm.group(1).strip())
                i += 1
            bloques.append(("lista", items, True))
            continue

        parrafo.append(lim)
        i += 1

    cerrar()
    return bloques


# ======================================================================= MAIN ==
def principal():
    if not ORIGEN.exists():
        raise SystemExit(f"No se encuentra el Markdown: {ORIGEN}")

    bloques = analizar(ORIGEN.read_text(encoding="utf-8"))

    # Recortar la cabecera del Markdown (título, datos e índice manual).
    inicio = 0
    for i, bloque in enumerate(bloques):
        if bloque[0] == "titulo" and bloque[1] == 2:
            if texto_plano(bloque[2]).lower().startswith("índice"):
                continue
            inicio = i
            break
    bloques = bloques[inicio:]

    doc = Documento()
    doc.nueva_pagina()                 # 1 · cabecera + índice (se rellena al final)
    dibujar_portada(doc)
    doc.nueva_pagina()                 # 2 · contenido

    for bloque in bloques:
        tipo = bloque[0]
        if tipo == "titulo":
            nivel = bloque[1]
            texto = bloque[2]
            if nivel == 1:
                continue
            if nivel == 2:
                m = re.match(r"^(\d+)\.\s*(.*)$", texto)
                if m:
                    doc.titulo1(m.group(2), numero=m.group(1))
                    doc.indice.append((m.group(1), texto_plano(m.group(2)),
                                       doc.numero_pagina))
                else:
                    doc.titulo1(texto)
                    doc.indice.append(("", texto_plano(texto), doc.numero_pagina))
            elif nivel == 3:
                doc.titulo2(texto)
            else:
                doc.titulo3(texto)
        elif tipo == "parrafo":
            doc.parrafo(bloque[1])
        elif tipo == "codigo":
            doc.codigo(bloque[2], bloque[1])
        elif tipo == "lista":
            doc.lista(bloque[1], bloque[2])
        elif tipo == "tabla":
            doc.tabla(bloque[1])
        elif tipo == "aviso":
            doc.aviso(bloque[1], bloque[2])

    dibujar_indice(doc, doc.indice)
    destino = doc.guardar()
    print(f"PDF generado: {destino}")
    print(f"Páginas: {len(pymupdf.open(str(destino)))}  ·  "
          f"Tamaño: {destino.stat().st_size / 1024:.0f} KB")


if __name__ == "__main__":
    try:
        principal()
    except Exception as error:            # pragma: no cover
        print(f"ERROR: {error}", file=sys.stderr)
        import traceback
        traceback.print_exc()
        raise
