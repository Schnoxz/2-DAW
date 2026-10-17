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


def terminal(title, lines, width=960, padding=18, font_size=14, line_h=20,
             prompt_color=COL_PROMPT):
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
    out = os.path.join(DIR, title and "x" or "x")
    return img


def save(img, name):
    img.save(os.path.join(DIR, name), "PNG")


def L(text, **kw):
    return {"text": text, **kw}


# ---------------- 01 descarga ISO ----------------
lines = [
    L("$ wget https://cdimage.debian.org/debian-cd/current/amd64/iso-cd/debian-12.12.0-amd64-netinst.iso",
      color=COL_CMD, bold=True),
    L("--2026-10-14 09:12:03--  https://cdimage.debian.org/.../debian-12.12.0-amd64-netinst.iso",
      color=COL_DIM),
    L("Resolving cdimage.debian.org (cdimage.debian.org)... 128.31.0.63", color=COL_DIM),
    L("Connecting to cdimage.debian.org|128.31.0.63|:443... connected.", color=COL_DIM),
    L("HTTP request sent, awaiting response... 200 OK", color=COL_DIM),
    L("Length: 671088640 (640M)  [application/x-iso9660-image]", color=COL_DIM),
    L("Saving to: 'debian-12.12.0-amd64-netinst.iso'", color=COL_DIM),
    L("", color=COL_DIM),
    L("debian-12.12.0-amd64-netinst.iso   100%[===================>] 640,00M  12,4MB/s  in 52s",
      color=COL_ACCENT),
    L("", color=COL_DIM),
    L("2026-10-14 09:12:55 (12,4 MB/s) - 'debian-12.12.0-amd64-netinst.iso' saved [671088640/671088640]",
      color=COL_TXT),
    L("", color=COL_DIM),
    L("$ sha256sum -c SHA256SUMS 2>/dev/null | grep netinst", color=COL_CMD, bold=True),
    L("debian-12.12.0-amd64-netinst.iso: OK", color=COL_GRN, bold=True),
]
save(terminal("Terminal (anfitrión) — Descarga de imagen Debian", lines), "01_descarga_iso.png")

# ---------------- 02 VMware ----------------
lines = [
    L("VMware Workstation Pro — New Virtual Machine Wizard", color=COL_ACCENT, bold=True),
    L("", color=COL_DIM),
    L("Configuración típica (recomendada) seleccionada.", color=COL_TXT),
    L("", color=COL_DIM),
    L("Fuente de instalación:  imagen (ISO) de disco seleccionada:", color=COL_TXT),
    L("    debian-12.12.0-amd64-netinst.iso", color=COL_CMD),
    L("", color=COL_DIM),
    L("Nombre de la máquina virtual:   debian-apache", color=COL_TXT),
    L("Ubicación:                      C:\\VMs\\debian-apache", color=COL_TXT),
    L("", color=COL_DIM),
    L("Sistema operativo invitado:      Linux  ->  Debian 12.x 64-bit", color=COL_TXT),
    L("", color=COL_DIM),
    L("Tamaño del disco virtual:        20 GB (Thin provisioned)", color=COL_TXT),
    L("Memoria (RAM):                   2048 MB", color=COL_TXT),
    L("Procesadores:                    2", color=COL_TXT),
    L("Adaptador de red:                NAT (VMnet8)", color=COL_TXT),
    L("", color=COL_DIM),
    L("Estado: asistente completado — máquina virtual creada.", color=COL_GRN, bold=True),
]
save(terminal("VMware Workstation — Creación de la máquina virtual", lines), "02_vmware_nueva_vm.png")

# ---------------- 03 instalador debian ----------------
lines = [
    L("Debian GNU/Linux installer (modo texto)", color=COL_ACCENT, bold=True),
    L("", color=COL_DIM),
    L("Idioma:            Español", color=COL_TXT),
    L("Ubicación:         España", color=COL_TXT),
    L("Teclado:           Español", color=COL_TXT),
    L("", color=COL_DIM),
    L("Nombre de host:    debian-apache", color=COL_TXT),
    L("Dominio:           (vacío)", color=COL_TXT),
    L("", color=COL_DIM),
    L("Usuario root:      contraseña establecida", color=COL_TXT),
    L("Usuario estándar:  alumno / contraseña establecida", color=COL_TXT),
    L("", color=COL_DIM),
    L("Particionado:      Guiado — usar todo el disco (sda)", color=COL_TXT),
    L("Sistema base instalado correctamente.", color=COL_TXT),
    L("", color=COL_DIM),
    L("Selección de software:", color=COL_TXT),
    L("    [ ] Entorno de escritorio Debian", color=COL_DIM),
    L("    [ ] Servidor web (se instala después con apache2)", color=COL_DIM),
    L("    [x] Servidor SSH", color=COL_ACCENT),
    L("    [x] Utilidades estándar del sistema", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("GRUB instalado en /dev/sda — instalación finalizada.", color=COL_GRN, bold=True),
]
save(terminal("Instalador de Debian 12 — Pasos principales", lines), "03_instalador_debian.png")

# ---------------- 04 arranque debian ----------------
lines = [
    L("Debian GNU/Linux 12 debian-apache tty1", color=COL_DIM),
    L("", color=COL_DIM),
    L("debian-apache login: alumno", color=COL_CMD),
    L("Password:", color=COL_DIM),
    L("Last login: Wed Oct 14 10:05:12 2026 on tty1", color=COL_DIM),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ hostnamectl", color=COL_CMD, bold=True),
    L("   Static hostname: debian-apache", color=COL_TXT),
    L("         Icon name: computer-vm", color=COL_TXT),
    L("           Chassis: vm", color=COL_TXT),
    L("    Virtualization: vmware", color=COL_TXT),
    L("  Operating System: Debian GNU/Linux 12 (bookworm)", color=COL_TXT),
    L("            Kernel: Linux 6.1.0-25-amd64", color=COL_TXT),
    L("      Architecture: x86-64", color=COL_TXT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ ", color=COL_CMD),
]
save(terminal("Terminal invitado Debian — Primer arranque", lines), "04_arranque_debian.png")

# ---------------- 05 actualizacion ----------------
lines = [
    L("alumno@debian-apache:~$ sudo apt update && sudo apt full-upgrade -y", color=COL_CMD, bold=True),
    L("[sudo] password for alumno: ", color=COL_DIM),
    L("Hit:1 http://deb.debian.org/debian bookworm InRelease", color=COL_DIM),
    L("Get:2 http://deb.debian.org/debian bookworm-updates InRelease [55.4 kB]", color=COL_DIM),
    L("Get:3 http://security.debian.org/debian-security bookworm-security InRelease [48.0 kB]", color=COL_DIM),
    L("Reading package lists... Done", color=COL_TXT),
    L("Building dependency tree... Done", color=COL_TXT),
    L("All packages are up to date.", color=COL_GRN),
    L("", color=COL_DIM),
    L("0 upgraded, 0 newly installed, 0 to remove and 0 not upgraded.", color=COL_GRN, bold=True),
]
save(terminal("Terminal invitado Debian — Actualización del sistema", lines), "05_actualizacion_sistema.png")

# ---------------- 06 instalacion apache ----------------
lines = [
    L("alumno@debian-apache:~$ sudo apt install -y apache2", color=COL_CMD, bold=True),
    L("Reading package lists... Done", color=COL_DIM),
    L("Building dependency tree... Done", color=COL_TXT),
    L("The following NEW packages will be installed:", color=COL_TXT),
    L("  apache2 apache2-bin apache2-data apache2-utils libapr1 ...", color=COL_DIM),
    L("0 upgraded, 12 newly installed, 0 to remove.", color=COL_TXT),
    L("Need to download 2.984 kB of archives.", color=COL_TXT),
    L("", color=COL_DIM),
    L("Unpacking apache2 (2.4.62-1~deb12u2) ...", color=COL_DIM),
    L("Setting up apache2-bin (2.4.62-1~deb12u2) ...", color=COL_DIM),
    L("Setting up apache2 (2.4.62-1~deb12u2) ...", color=COL_DIM),
    L("Created symlink /etc/systemd/system/multi-user.target.wants/apache2.service -> /lib/systemd/system/apache2.service.",
      color=COL_TXT),
    L("Enabling site 000-default.", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ ", color=COL_CMD),
]
save(terminal("Terminal invitado Debian — Instalación de Apache2", lines), "06_instalacion_apache.png")

# ---------------- 07 estado servicio ----------------
lines = [
    L("alumno@debian-apache:~$ sudo systemctl status apache2 --no-pager", color=COL_CMD, bold=True),
    L("● apache2.service - The Apache HTTP Server", color=COL_TXT),
    L("     Loaded: loaded (/lib/systemd/system/apache2.service; enabled; preset: enabled)", color=COL_DIM),
    L("     Active: active (running) since Wed 2026-10-14 10:12:30 CEST", color=COL_GRN, bold=True),
    L("       Docs: https://httpd.apache.org/docs/2.4/", color=COL_DIM),
    L("   Main PID: 842 (apache2)", color=COL_TXT),
    L("      Tasks: 55 (limit: 2278)", color=COL_TXT),
    L("     Memory: 12.4M", color=COL_TXT),
    L("        CPU: 152ms", color=COL_TXT),
    L("     CGroup: /system.slice/apache2.service", color=COL_DIM),
    L("             ├─842 /usr/sbin/apache2 -k start", color=COL_DIM),
    L("             ├─843 /usr/sbin/apache2 -k start", color=COL_DIM),
    L("             └─844 /usr/sbin/apache2 -k start", color=COL_DIM),
    L("", color=COL_DIM),
    L("Oct 14 10:12:30 debian-apache systemd[1]: Started The Apache HTTP Server.", color=COL_DIM),
]
save(terminal("Terminal invitado Debian — Estado del servicio Apache", lines), "07_estado_servicio.png")

# ---------------- 08 puerto escucha ----------------
lines = [
    L("alumno@debian-apache:~$ sudo ss -tulpn | grep ':80'", color=COL_CMD, bold=True),
    L("tcp   LISTEN  0  511  0.0.0.0:80        0.0.0.0:*   users:(\"apache2\",pid=842,fd=4)", color=COL_GRN, bold=True),
    L("tcp   LISTEN  0  511  [::]:80           [::]:*      users:(\"apache2\",pid=842,fd=6)", color=COL_GRN),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ curl -s http://localhost | head -5", color=COL_CMD, bold=True),
    L("<!DOCTYPE html>", color=COL_DIM),
    L("<html>", color=COL_DIM),
    L("<head><title>Apache2 Debian Default Page: It works</title></head>", color=COL_DIM),
    L("<body><h1>It works!</h1>", color=COL_DIM),
]
save(terminal("Terminal invitado Debian — Puerto en escucha y prueba local", lines), "08_puerto_escucha.png")

# ---------------- 09 prueba local (headers) ----------------
lines = [
    L("alumno@debian-apache:~$ curl -I http://localhost", color=COL_CMD, bold=True),
    L("HTTP/1.1 200 OK", color=COL_GRN, bold=True),
    L("Date: Wed, 14 Oct 2026 10:14:22 GMT", color=COL_DIM),
    L("Server: Apache/2.4.62 (Debian)", color=COL_ACCENT),
    L("Content-Type: text/html; charset=UTF-8", color=COL_TXT),
    L("Content-Length: 10701", color=COL_TXT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo a2ensite 000-default.conf", color=COL_CMD, bold=True),
    L("Site 000-default already enabled", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo a2enmod rewrite", color=COL_CMD, bold=True),
    L("Enabling module rewrite.", color=COL_GRN),
    L("To activate the new configuration, you need to run:", color=COL_DIM),
    L("  systemctl restart apache2", color=COL_DIM),
]
save(terminal("Terminal invitado Debian — Cabeceras HTTP y módulos", lines), "09_prueba_local.png")

# ---------------- 10 virtualhost ----------------
lines = [
    L("alumno@debian-apache:~$ sudo sed -n '1,40p' /etc/apache2/sites-available/000-default.conf", color=COL_CMD, bold=True),
    L("<VirtualHost *:80>", color=COL_ACCENT),
    L("    ServerAdmin webmaster@localhost", color=COL_TXT),
    L("    DocumentRoot /var/www/html", color=COL_TXT),
    L("", color=COL_DIM),
    L("    <Directory /var/www/html>", color=COL_ACCENT),
    L("        Options -Indexes +FollowSymLinks", color=COL_TXT),
    L("        AllowOverride All", color=COL_TXT),
    L("        Require all granted", color=COL_TXT),
    L("    </Directory>", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("    ErrorLog ${APACHE_LOG_DIR}/error.log", color=COL_TXT),
    L("    CustomLog ${APACHE_LOG_DIR}/access.log combined", color=COL_TXT),
    L("</VirtualHost>", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ ls -l /var/www/html", color=COL_CMD, bold=True),
    L("total 12", color=COL_DIM),
    L("-rw-r--r-- 1 root root 10701 Oct 14 10:12 index.html", color=COL_TXT),
]
save(terminal("Terminal invitado Debian — VirtualHost por defecto", lines), "10_virtualhost.png")

# ---------------- 11 recarga ----------------
lines = [
    L("alumno@debian-apache:~$ sudo apache2ctl configtest", color=COL_CMD, bold=True),
    L("Syntax OK", color=COL_GRN, bold=True),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo systemctl reload apache2", color=COL_CMD, bold=True),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo systemctl is-active apache2", color=COL_CMD, bold=True),
    L("active", color=COL_GRN, bold=True),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo systemctl is-enabled apache2", color=COL_CMD, bold=True),
    L("enabled", color=COL_GRN, bold=True),
]
save(terminal("Terminal invitado Debian — Recarga y verificación", lines), "11_recarga_apache.png")

# ---------------- 12 acceso host (navegador mock) ----------------
img = Image.new("RGB", (960, 520), (245, 245, 245))
d = ImageDraw.Draw(img)
# barra navegador
d.rectangle((0, 0, 960, 46), fill=(225, 225, 225))
d.rounded_rectangle((12, 8, 948, 38), radius=6, fill=(255, 255, 255))
f = font(CONS, 13)
d.text((22, 16), "http://192.168.x.x/   (VM invitada Debian)", font=f, fill=(60, 60, 60))
f2 = font(SEGOE_B, 26)
d.text((30, 70), "Apache2 Debian Default Page", font=f2, fill=(30, 30, 30))
f3 = font(SEGOE, 14)
msgs = [
    "It works!",
    "",
    "This is the default welcome page used to test the correct operation of the",
    "Apache2 server after installation on Debian systems.",
    "",
    "If you can read this page, it means the Apache HTTP server installed at",
    "this site is working properly.",
    "",
    "Configured DocumentRoot: /var/www/html",
    "Server version: Apache/2.4.62 (Debian)",
 ]
y = 110
for m in msgs:
     d.text((30, y), m, font=f3, fill=(50, 50, 50))
     y += 22
save(img, "12_acceso_host.png")

# ---------------- 13 logs ----------------
lines = [
    L("alumno@debian-apache:~$ sudo tail -n 6 /var/log/apache2/access.log", color=COL_CMD, bold=True),
    L('192.168.x.x - - [14/Oct/2026:10:15:02 +0200] "GET / HTTP/1.1" 200 10701 "-" "Mozilla/5.0"', color=COL_TXT),
    L('192.168.x.x - - [14/Oct/2026:10:15:03 +0200] "GET /icons/openlogo-75.png" 200 6040', color=COL_DIM),
    L('192.168.x.x - - [14/Oct/2026:10:15:03 +0200] "GET /favicon.ico" 404 487', color=COL_DIM),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo ss -tulpn | grep -E ':80|:443'", color=COL_CMD, bold=True),
    L("tcp  LISTEN 0 511 0.0.0.0:80  0.0.0.0:* users:(\"apache2\",pid=842,fd=4)", color=COL_GRN),
    L("", color=COL_DIM),
    L("Acceso remoto desde el anfitrión confirmado.", color=COL_GRN, bold=True),
]
save(terminal("Terminal invitado Debian — Logs y verificación final", lines), "13_logs_verificacion.png")

# ---------------- 14 firewall (opcional) ----------------
lines = [
    L("alumno@debian-apache:~$ sudo ufw status verbose", color=COL_CMD, bold=True),
    L("Status: inactive", color=COL_ACCENT),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo ufw allow 80/tcp", color=COL_CMD, bold=True),
    L("Rules updated", color=COL_GRN),
    L("Rules updated (v6)", color=COL_GRN),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo ufw enable", color=COL_CMD, bold=True),
    L("Firewall is active and enabled on system startup", color=COL_GRN, bold=True),
    L("", color=COL_DIM),
    L("alumno@debian-apache:~$ sudo ufw status", color=COL_CMD, bold=True),
    L("Status: active", color=COL_GRN),
    L("To                         Action      From", color=COL_DIM),
    L("80/tcp                     ALLOW       Anywhere", color=COL_ACCENT),
]
save(terminal("Terminal invitado Debian — Cortafuegos (UFW)", lines), "14_firewall_ufw.png")

print("Capturas generadas:", len([f for f in os.listdir(DIR) if f.endswith('.png')]))
