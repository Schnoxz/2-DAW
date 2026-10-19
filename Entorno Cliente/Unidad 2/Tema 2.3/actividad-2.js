// Actividad 2 (Tema 2.3) - Zona Muerta Temporal (TDZ)
// Al ejecutarlo lanza: ReferenceError: Cannot access 'usuario' before initialization

let usuario = "Carlos";

function configurarPerfil() {
  console.log(usuario);   // el let de abajo está en TDZ aquí
  let usuario = "Marta";
}

configurarPerfil();
