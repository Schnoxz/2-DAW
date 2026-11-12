# Genera el PDF del cuadernillo a partir del Markdown y el CSS.
# Uso:  .\build.ps1
# Requiere pandoc y Microsoft Edge instalados.

$ErrorActionPreference = 'Stop'

$dir  = Split-Path -Parent $MyInvocation.MyCommand.Path
$md   = Join-Path $dir 'teoria-examen-html.md'
$css  = Join-Path $dir 'estilo-print.css'
$html = Join-Path $dir '_teoria.html'
$pdf  = Join-Path $dir 'Tema2_HTML_Teoria_Examen.pdf'

pandoc $md -f markdown -t html5 -s --embed-resources --css $css `
  --metadata pagetitle="Tema 2 · HTML — Teoría y ejercicios resueltos" `
  -o $html

$edge = 'C:\Program Files (x86)\Microsoft\Edge\Application\msedge.exe'
$url  = 'file:///' + ($html -replace '\\', '/')

& $edge --headless=new --disable-gpu --no-pdf-header-footer `
  --print-to-pdf="$pdf" $url

Start-Sleep -Seconds 2
Write-Host "PDF generado: $pdf"
