// js/banner.js
// Actividad 3.7.5 · Banner de consentimiento RGPD con cookies.
// La cookie rgpd_consentimiento guarda "aceptado" o "rechazado".

var NOMBRE_COOKIE = "rgpd_consentimiento";
var banner = document.getElementById("bannerCookies");
var estadoConsentimiento = document.getElementById("estadoConsentimiento");

// actualizarBanner()
// Lee la cookie: si existe oculta el banner y escribe el estado.
// Si no existe, lo muestra. No devuelve nada.
function actualizarBanner() {
  var valor = getCookie(NOMBRE_COOKIE);

  if (valor === "aceptado") {
    banner.hidden = true;
    estadoConsentimiento.textContent = "Consentimiento aceptado. La cookie caduca en 30 días.";
  } else if (valor === "rechazado") {
    banner.hidden = true;
    estadoConsentimiento.textContent = "Consentimiento rechazado. La cookie se borrará al cerrar el navegador.";
  } else {
    banner.hidden = false;
    estadoConsentimiento.textContent = "Sin decisión guardada: el banner vuelve a mostrarse.";
  }
}

// aceptarCookies()
// Crea la cookie con 30 días de validez y SameSite=Lax.
// No devuelve nada.
function aceptarCookies() {
  // 30 días en segundos. No se usa setCookie() porque esa función no pone
  // SameSite y aquí el enunciado lo pide de forma explícita.
  document.cookie = NOMBRE_COOKIE + "=aceptado; max-age=2592000; path=/; SameSite=Lax";
  actualizarBanner();
}

// rechazarCookies()
// Crea una cookie de sesión: sin max-age, muere al cerrar el navegador.
// No devuelve nada.
function rechazarCookies() {
  document.cookie = NOMBRE_COOKIE + "=rechazado; path=/; SameSite=Lax";
  actualizarBanner();
}

// restablecerConsentimiento()
// Borra la cookie con max-age=0 y vuelve a enseñar el banner.
// No devuelve nada.
function restablecerConsentimiento() {
  deleteCookie(NOMBRE_COOKIE, "/");
  actualizarBanner();
}

document.getElementById("btnAceptarCookies").addEventListener("click", aceptarCookies);
document.getElementById("btnRechazarCookies").addEventListener("click", rechazarCookies);
document.getElementById("btnRestablecerConsentimiento").addEventListener("click", restablecerConsentimiento);

// Al cargar se decide si el banner se ve o no
actualizarBanner();
