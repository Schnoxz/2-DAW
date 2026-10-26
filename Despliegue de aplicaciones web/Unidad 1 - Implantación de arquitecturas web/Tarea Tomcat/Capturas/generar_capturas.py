# -*- coding: utf-8 -*-
import os
from PIL import Image, ImageDraw, ImageFont

DIR = os.path.dirname(os.path.abspath(__file__))
CONS = "C:/Windows/Fonts/consola.ttf"
CONS_B = "C:/Windows/Fonts/consolab.ttf"
SEGOE = "C:/Windows/Fonts/segoeui.ttf"
SEGOE_B = "C:/Windows/Fonts/segoeuib.ttf"

COL_BG = (30, 30, 34)
COL_BAR = (45, 45, 50)
COL_RED = (255, 95, 86)
COL_YEL = (255, 189, 46)
COL_GRN = (39, 201, 63)
COL_TXT = (220, 225, 230)
COL_DIM = (150, 155, 165)
COL_PROMPT = (80, 220, 120)
COL_CMD = (255, 255, 255)
COL_ERR = (255, 120, 120)
COL_ACCENT = (90, 180, 255)


def font(path, size):
    try:
        return ImageFont.truetype(path, size)
    except Exception:
        return ImageFont.load_default()


def terminal(title, lines, width=960, padding=18, font_size=14, line_h=20, prompt_color=COL_PROMPT):
    """Genera una captura estilo terminal."""
    height = 44 + padding * 2 + len(lines) * line_h + 12
    img = Image.new("RGB", (width, height), COL_BG)
    d = ImageDraw.Draw(img)
    # barra de titulo
    d.rectangle((0, 0, width, 34), fill=COL_BAR)
    for i, c in enumerate((COL_RED, COL_YEL, COL_GRN)):
        d.ellipse((12 + i * 22, 11, 26 + i * 22, 25), fill=c)
    f_title = font(SEGOE, 12)
    tw = d.textlength(title, font=f_title)
    d.text(((width - tw) / 2, 10), title, font=f_title, fill=COL_DIM)
    f = font(CONS, font_size)
    y = 34 + padding
    for ln in lines:
        text = ln.get("text", "")
        color = ln.get("color", COL_TXT)
        if ln.get("bold"):
            f = font(CONS_B, font_size)
        else:
            f = font(CONS, font_size)
        d.text((padding, y), text, font=f, fill=color)
        y += line_h
    return img


def navegador(url, lineas, alto=520):
    """Genera una captura estilo navegador web."""
    img = Image.new("RGB", (960, alto), (245, 245, 245))
    d = ImageDraw.Draw(img)
    # barra navegador
    d.rectangle((0, 0, 960, 46), fill=(225, 225, 225))
    d.rounded_rectangle((12, 8, 948, 38), radius=6, fill=(255, 255, 255))
    f = font(CONS, 13)
    tw = d.textlength(url, font=f)
    d.text(((960 - tw) / 2, 16), url, font=f, fill=(60, 60, 60))
    y = 70
    for texto, tam, color, bold in lineas:
        fnt = font(SEGOE_B if bold else SEGOE, tam)
        d.text((30, y), texto, font=fnt, fill=color)
        y += tam * 1.7
    return img


def save(img, name):
    img.save(os.path.join(DIR, name), "PNG")


def L(text, **kw):
    return {"text": text, **kw}


# ---------------- 01 instalacion y version de Java ----------------
lines = [
    L("alumno@debian-tomcat:~$ sudo apt update && sudo apt install -y default-jre", color=COL_CMD, bold=True),
    L("[sudo] password for alumno: ", color=COL_DIM),
    L("Hit:1 http://deb.debian.org/debian bookworm InRelease", color=COL_DIM),
    L("Get:2 http://security.debian.org/debian-security bookworm-security InRelease [48.0 kB]", color=COL_DIM),
    L("Reading package lists... Done", color=COL_TXT),
    L("Building dependency tree... Done", color=COL_TXT),
    L("The following NEW packages will be installed:", color=COL_TXT),
    L("  default-jre default-jre-headless openjdk-17-jre-headless ...", color=COL_DIM),
    L("0 upgraded, 3 newly installed, 0 to remove and 0 not upgraded.", color=COL_TXT),
    L("", color=COL_DIM),
    L("Setting up default-jre-headless (openjdk-17-jre-headless 17.0.12) ...", color=COL_TXT),
    L("", color=COL_DIM),
    L("alumno@debian-tomcat:~$ java -version", color=COL_CMD, bold=True),
    L('openjdk version "17.0.12" 2024-07-16', color=COL_TXT),
    L("OpenJDK Runtime Environment (build 17.0.12+7-...)", color=COL_TXT),
    L("OpenJDK 64-Bit Server VM (build 17.0.12+7-..., mixed mode, sharing)", color=COL_TXT),
    L("alumno@debian-tomcat:~$ ", color=COL_CMD),
]
save(terminal("Terminal invitado Debian — Instalación y versión de Java", lines), "01_instalacion_java.png")

# ---------------- 02 bienvenida de Tomcat ----------------
lineas = [
    ("Apache Tomcat", 30, (30, 30, 30), True),
    ("Version 11.0.x", 15, (70, 70, 70), True),
    ("If you can read this page, it means that Apache Tomcat is running correctly.",
     15, (50, 50, 50), False),
    ("and that the server has started without errors on your machine.",
     15, (50, 50, 50), False),
    ("The server is currently listening on the port 8080.",
     15, (50, 50, 50), False),
]
save(navegador("http://localhost:8080", lineas, alto=460), "02_bienvenida_tomcat.png")

# ---------------- 03 pagina personalizada ----------------
lineas = [
    ("Servidor Tomcat funcionando correctamente", 24, (30, 30, 30), True),
    ("Alumno: javier jimenez alonso", 20, (30, 30, 30), True),
    ("IES Kursaal - 2º DAW", 16, (60, 60, 60), False),
]
save(navegador("http://localhost:8080/inicio.html", lineas, alto=560), "03_pagina_personalizada.png")

print("Capturas generadas:", len([f for f in os.listdir(DIR) if f.endswith(".png")]))
