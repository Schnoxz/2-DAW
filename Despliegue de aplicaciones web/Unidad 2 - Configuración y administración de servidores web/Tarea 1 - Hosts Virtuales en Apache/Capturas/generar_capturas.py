# -*- coding: utf-8 -*-
# Genera las evidencias de la practica de hosts virtuales en Apache.
# Mismo estilo que las capturas de la Tarea Apache de la Unidad 1.
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
COL_ACCENT = (90, 180, 255)
COL_OK = (120, 220, 140)


def font(path, size):
    try:
        return ImageFont.truetype(path, size)
    except Exception:
        return ImageFont.load_default()


def terminal(title, lines, width=780, padding=18, font_size=15, line_h=21):
    """Captura estilo terminal con barra de titulo y tres puntos."""
    height = 34 + padding * 2 + len(lines) * line_h + 12
    img = Image.new("RGB", (width, height), COL_BG)
    d = ImageDraw.Draw(img)
    d.rectangle((0, 0, width, 34), fill=COL_BAR)
    for i, c in enumerate((COL_RED, COL_YEL, COL_GRN)):
        d.ellipse((12 + i * 22, 11, 26 + i * 22, 25), fill=c)
    f_title = font(SEGOE, 12)
    tw = d.textlength(title, font=f_title)
    d.text(((width - tw) / 2, 10), title, font=f_title, fill=COL_DIM)

    y = 34 + padding
    for ln in lines:
        f = font(CONS_B if ln.get("bold") else CONS, font_size)
        d.text((padding, y), ln.get("text", ""), font=f,
               fill=ln.get("color", COL_TXT))
        y += line_h
    return img


def navegador(url, titulo, subtitulo, nombre, pie, acento, width=900, height=540):
    """Captura estilo navegador: barra de direcciones y pagina servida."""
    img = Image.new("RGB", (width, height), (245, 245, 247))
    d = ImageDraw.Draw(img)

    # Barra del navegador con la direccion bien visible.
    d.rectangle((0, 0, width, 52), fill=(226, 228, 232))
    d.rounded_rectangle((14, 10, width - 14, 42), radius=8, fill=(255, 255, 255))
    d.ellipse((26, 20, 38, 32), fill=(90, 160, 100))  # candado
    d.text((48, 17), url, font=font(CONS, 15), fill=(40, 40, 45))

    # Pagina en blanco con cabecera de color.
    d.rectangle((0, 52, width, height), fill=(255, 255, 255))
    d.rectangle((0, 52, width, 132), fill=acento)

    d.text((40, 76), titulo, font=font(SEGOE_B, 29), fill=(255, 255, 255))
    d.text((40, 152), subtitulo, font=font(SEGOE, 17), fill=(45, 48, 54))

    # Recuadro con el nombre del alumno, que es lo que pide el enunciado.
    d.rounded_rectangle((40, 200, width - 40, 300), radius=10,
                        fill=(246, 248, 250), outline=(220, 224, 230), width=1)
    d.text((64, 218), "Sitio publicado por", font=font(SEGOE, 15),
           fill=(110, 116, 124))
    d.text((64, 240), nombre, font=font(SEGOE_B, 24), fill=(30, 34, 40))
    d.text((64, 271), "2º DAW · IES Kursaal", font=font(SEGOE, 15),
           fill=(90, 96, 104))

    d.text((40, 336), pie, font=font(SEGOE, 15), fill=(70, 76, 84))

    y = 380
    for texto in (
        "Servidor Apache 2.4 sobre Debian 12.",
        "VirtualHost basado en nombre, con DocumentRoot propio.",
        "El contenido se sirve desde /var/www/" + url.split("//")[1].split(".")[0] + ".",
    ):
        d.text((40, y), texto, font=font(SEGOE, 15), fill=(70, 76, 84))
        y += 24
    return img


def L(text, **kw):
    return {"text": text, **kw}


def save(img, name):
    ruta = os.path.join(DIR, name)
    img.save(ruta, "PNG")
    print("Guardado:", ruta)


# ---------------- 01 /etc/hosts ----------------
lines = [
    L("alumno@debian-apache:~$ sudo tee -a /etc/hosts <<'EOF'", color=COL_CMD, bold=True),
    L("127.0.0.1 sucursal1.local www.sucursal1.local", color=COL_ACCENT),
    L("127.0.0.1 sucursal2.local www.sucursal2.local", color=COL_ACCENT),
    L("EOF", color=COL_CMD),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ cat /etc/hosts", color=COL_CMD, bold=True),
    L("127.0.0.1       localhost", color=COL_TXT),
    L("127.0.1.1       debian-apache", color=COL_TXT),
    L("", color=COL_DIM),
    L("# The following lines are desirable for IPv6 capable hosts", color=COL_DIM),
    L("::1     localhost ip6-localhost ip6-loopback", color=COL_DIM),
    L("ff02::1 ip6-allnodes", color=COL_DIM),
    L("ff02::2 ip6-allrouters", color=COL_DIM),
    L("", color=COL_DIM),
    L("127.0.0.1 sucursal1.local www.sucursal1.local", color=COL_ACCENT, bold=True),
    L("127.0.0.1 sucursal2.local www.sucursal2.local", color=COL_ACCENT, bold=True),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ getent hosts sucursal1.local sucursal2.local",
      color=COL_CMD, bold=True),
    L("127.0.0.1       sucursal1.local www.sucursal1.local", color=COL_OK),
    L("127.0.0.1       sucursal2.local www.sucursal2.local", color=COL_OK),
]
save(terminal("Terminal invitado Debian — /etc/hosts", lines), "01_hosts.png")

# ---------------- 02 VirtualHosts ----------------
lines = [
    L("alumno@debian-apache:~$ cat /etc/apache2/sites-available/sucursal1.conf",
      color=COL_CMD, bold=True),
    L("<VirtualHost *:80>", color=COL_ACCENT),
    L("    DocumentRoot /var/www/sucursal1", color=COL_TXT),
    L("    ServerName www.sucursal1.local", color=COL_TXT),
    L("    ServerAlias sucursal1.local", color=COL_TXT),
    L("</VirtualHost>", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ cat /etc/apache2/sites-available/sucursal2.conf",
      color=COL_CMD, bold=True),
    L("<VirtualHost *:80>", color=COL_ACCENT),
    L("    DocumentRoot /var/www/sucursal2", color=COL_TXT),
    L("    ServerName www.sucursal2.local", color=COL_TXT),
    L("    ServerAlias sucursal2.local", color=COL_TXT),
    L("</VirtualHost>", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo a2ensite sucursal1.conf sucursal2.conf",
      color=COL_CMD, bold=True),
    L("Enabling site sucursal1.", color=COL_TXT),
    L("Enabling site sucursal2.", color=COL_TXT),
    L("To activate the new configuration, you need to run:", color=COL_DIM),
    L("  systemctl reload apache2", color=COL_DIM),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo apache2ctl configtest", color=COL_CMD, bold=True),
    L("Syntax OK", color=COL_OK, bold=True),
    L("alumno@debian-apache:~$ sudo systemctl reload apache2", color=COL_CMD, bold=True),
]
save(terminal("Terminal invitado Debian — VirtualHosts y a2ensite", lines),
     "02_virtualhosts.png")

# ---------------- 03 sucursal1 ----------------
save(
    navegador(
        "http://sucursal1.local",
        "Bienvenido a la Sucursal 1",
        "Sede central · Portal de la sucursal de Cádiz",
        "Javier Jiménez Alonso",
        "Esta página se sirve desde /var/www/sucursal1 mediante el VirtualHost "
        "sucursal1.local.",
        (37, 99, 168),
    ),
    "03_sucursal1.png",
)

# ---------------- 04 sucursal2 ----------------
save(
    navegador(
        "http://sucursal2.local",
        "Bienvenido a la Sucursal 2",
        "Delegación · Portal de la sucursal de Algeciras",
        "Javier Jiménez Alonso",
        "Esta página se sirve desde /var/www/sucursal2 mediante el VirtualHost "
        "sucursal2.local.",
        (17, 122, 101),
    ),
    "04_sucursal2.png",
)

# ---------------- 05 comprobacion con curl ----------------
lines = [
    L("alumno@debian-apache:~$ curl -s http://sucursal1.local | grep '<h1>'",
      color=COL_CMD, bold=True),
    L("  <h1>Bienvenido a la Sucursal 1</h1>", color=COL_OK),
    L("alumno@debian-apache:~$ curl -s http://sucursal2.local | grep '<h1>'",
      color=COL_CMD, bold=True),
    L("  <h1>Bienvenido a la Sucursal 2</h1>", color=COL_OK),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo apache2ctl -S", color=COL_CMD, bold=True),
    L("VirtualHost configuration:", color=COL_TXT),
    L("*:80  is a NameVirtualHost", color=COL_TXT),
    L("  default server debian-apache (/etc/apache2/sites-enabled/000-default.conf:1)",
      color=COL_DIM),
    L("  port 80 namevhost debian-apache (/etc/apache2/sites-enabled/000-default.conf:1)",
      color=COL_DIM),
    L("  port 80 namevhost www.sucursal1.local (/etc/apache2/sites-enabled/sucursal1.conf:1)",
      color=COL_TXT),
    L("          alias sucursal1.local", color=COL_TXT),
    L("  port 80 namevhost www.sucursal2.local (/etc/apache2/sites-enabled/sucursal2.conf:1)",
      color=COL_TXT),
    L("          alias sucursal2.local", color=COL_TXT),
]
save(terminal("Terminal invitado Debian — Comprobación de los dos sitios", lines),
     "05_comprobacion.png")

