param(
  [Parameter(Position = 0)]
  [ValidateSet('ver', 'abrir', 'hacer', 'atras', 'dominio')]
  [string]$Accion = 'ver',

  [Parameter(Position = 1)]
  [string]$Valor = ''
)

$ErrorActionPreference = 'Stop'
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8

$Brave   = "$env:ProgramFiles\BraveSoftware\Brave-Browser\Application\brave.exe"
$Raiz    = $PSScriptRoot
$State   = Join-Path $Raiz 'estado.json'

$Etapas = @(
  @{ N = 0; T = 'Registro en CDMON';            C = '00-Registro CDMON';         U = 'https://admin.cdmon.com/es/registro'; D = 'Cuenta creada con el correo @g.educaand.es. Copia usuario y contrasena al doc de Google.'
    P = @('00-01-formulario-alta.png', '00-02-email-activacion.png', '00-03-primer-acceso-panel.png') }

  @{ N = 1; T = 'Crear plataforma de pruebas';  C = '01-Plataforma de pruebas';  U = 'https://admin.cdmon.com/es/acceso';    D = 'Crea la plataforma con tu dominio SIN www. Acepta condiciones y pulsa "Crear plataforma de prueba".'
    P = @('01-01-nueva-plataforma.png', '01-02-dominio-sin-www.png', '01-03-condiciones-aceptadas.png', '01-04-plataforma-creada.png', '01-05-configuracion.png') }

  @{ N = 2; T = 'Instalar WordPress';           C = '02-Instalar WordPress';     U = 'https://admin.cdmon.com/es/acceso';    D = 'Configuracion > Aplicaciones > Wordpress. Instala, acepta las politicas y copia del email la URL y las claves al doc de Google.'
    P = @('02-01-aplicaciones-wordpress.png', '02-02-instalando.png', '02-03-aceptar-politicas.png', '02-04-wordpress-instalado.png', '02-05-email-url-credenciales.png') }

  @{ N = 3; T = 'Acceso a WordPress';           C = '03-Acceso a WordPress';     U = 'DOMINIO/wp-admin';            D = 'Abre la URL /wp-admin del email e introduce usuario y contrasena de WordPress. Debe salir el Escritorio.'
    P = @('03-01-doc-google-claves.png', '03-02-login-wp-admin.png', '03-03-escritorio-wordpress.png') }

  @{ N = 4; T = 'Tema Astra';                   C = '04-Tema Astra';             U = 'DOMINIO/wp-admin/themes.php'; D = 'Apariencia > Temas > Anadir nuevo. Busca "Astra", Instalar y Activar.'
    P = @('04-01-apariencia-temas.png', '04-02-anadir-nuevo-tema.png', '04-03-buscar-astra.png', '04-04-instalar-activar.png', '04-05-astra-activo.png') }

  @{ N = 5; T = 'Plugin Elementor';             C = '05-Plugin Elementor';       U = 'DOMINIO/wp-admin/plugin-install.php?s=elementor'; D = 'Plugins > Anadir nuevo. Busca "Elementor", Instalar y Activar.'
    P = @('05-01-plugins-anadir-nuevo.png', '05-02-buscar-elementor.png', '05-03-instalar-activar.png', '05-04-elementor-lista.png') }

  @{ N = 6; T = 'Header y Footer';              C = '06-Header y Footer';        U = 'DOMINIO/wp-admin/edit.php?post_type=elementor_library'; D = 'Crea en Elementor las plantillas de cabecera y pie, y aplicalas al tema.'
    P = @('06-01-plantillas-elementor.png', '06-02-crear-header.png', '06-03-header-diseno.png', '06-04-header-aplicado.png', '06-05-crear-footer.png', '06-06-footer-aplicado.png') }

  @{ N = 7; T = 'Formulario WPForms';            C = '07-Formulario WPForms';     U = 'DOMINIO/wp-admin/plugin-install.php?s=wpforms'; D = 'Instala WPForms, crea el formulario de contacto, insertalo en la pagina con el widget de Elementor y dale formato.'
    P = @('07-01-instalar-wpforms.png', '07-02-nuevo-formulario.png', '07-03-diseno-campos.png', '07-04-configuracion-envio.png', '07-05-formulario-guardado.png', '07-06-abrir-pagina-elementor.png', '07-07-insertar-widget-wpforms.png', '07-08-formulario-en-pagina.png', '07-09-formato-colores-fondos.png') }

  @{ N = 8; T = 'Blog con BlogMentor';          C = '08-Blog BlogMentor';        U = 'DOMINIO/wp-admin/plugin-install.php?s=blogmentor'; D = 'Instala y activa BlogMentor, y crea la primera entrada del blog.'
    P = @('08-01-instalar-blogmentor.png', '08-02-crear-primera-entrada.png', '08-03-entrada-con-imagen.png', '08-04-blog-publicado.png') }
)

function Leer-Estado {
  if (Test-Path -LiteralPath $State) { return Get-Content -LiteralPath $State -Raw | ConvertFrom-Json }
  return [pscustomobject]@{ Dominio = ''; Actual = 0 }
}

function Guardar-Estado($e) { $e | ConvertTo-Json | Set-Content -LiteralPath $State -Encoding utf8 }

function Resolver-Url($u, $dom) {
  if ($u -notlike '*DOMINIO*') { return $u }
  if ([string]::IsNullOrWhiteSpace($dom)) { return $null }
  return $u.Replace('DOMINIO', $dom.Trim())
}

function Mostrar($e) {
  $s = $Etapas[$e.Actual]
  Write-Host ''
  Write-Host ('=' * 64) -ForegroundColor DarkCyan
  Write-Host ("  PASO {0}  -  {1}" -f $s.N, $s.T) -ForegroundColor Cyan
  Write-Host ('=' * 64) -ForegroundColor DarkCyan
  Write-Host ''
  Write-Host '  Que hacer:' -ForegroundColor White
  Write-Host ("  " + $s.D) -ForegroundColor Gray
  Write-Host ''

  $url = Resolver-Url $s.U $e.Dominio
  if ($url) {
    Write-Host "  URL: $url" -ForegroundColor Yellow
  }
  else {
    Write-Host '  URL: falta el dominio ->  .\practica.ps1 dominio 2bcodewhool.educaand.es' -ForegroundColor Red
  }
  Write-Host ''
  Write-Host ("  Guardar capturas en:  {0}\" -f $s.C) -ForegroundColor Magenta
  foreach ($c in $s.P) {
    $ruta = Join-Path $Raiz (Join-Path $s.C $c)
    $marca = if (Test-Path -LiteralPath $ruta) { '[x]' } else { '[ ]' }
    $col = if ($marca -eq '[x]') { 'DarkGreen' } else { 'DarkGray' }
    Write-Host ("    $marca $c") -ForegroundColor $col
  }
  Write-Host ''
  Write-Host '  Abrir en Brave   ->  .\practica.ps1 abrir' -ForegroundColor Green
  Write-Host '  Marcar hecho     ->  .\practica.ps1 hacer' -ForegroundColor Green
  Write-Host ''
}

$e = Leer-Estado

switch ($Accion) {
  'ver' { Mostrar $e }

  'dominio' {
    if ([string]::IsNullOrWhiteSpace($Valor)) {
      Write-Host 'Uso:  .\practica.ps1 dominio 2bcodewhool.educaand.es' -ForegroundColor Yellow
      break
    }
    $e.Dominio = $Valor
    Guardar-Estado $e
    Write-Host "Dominio guardado: $($e.Dominio)" -ForegroundColor Green
    Mostrar $e
  }

  'hacer' {
    if ($e.Actual -lt ($Etapas.Count - 1)) { $e.Actual++ }
    Guardar-Estado $e
    Mostrar $e
  }

  'atras' {
    if ($e.Actual -gt 0) { $e.Actual-- }
    Guardar-Estado $e
    Mostrar $e
  }

  'abrir' {
    $n = $e.Actual
    if ($Valor -match '^\d+$') { $n = [Math]::Min([int]$Valor, $Etapas.Count - 1); $e.Actual = $n; Guardar-Estado $e }
    $url = Resolver-Url $Etapas[$n].U $e.Dominio
    if (-not $url) {
      Write-Host 'Falta el dominio. Primero:  .\practica.ps1 dominio 2bcodewhool.educaand.es' -ForegroundColor Red
      break
    }
    Start-Process -FilePath $Brave -ArgumentList @('--new-window', $url)
    Write-Host "Brave abierto -> $url" -ForegroundColor Green
    Mostrar $e
  }
}
