-- Esquema de TachoAviso para WordPress.
-- {prefix} lo sustituye el plugin por el prefijo real (por defecto wp_).
-- {charset} lo sustituye por el juego de caracteres y la collation del sitio.

CREATE TABLE {prefix}ta_vehiculos (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  usuario_id bigint(20) unsigned NOT NULL,
  matricula varchar(12) NOT NULL,
  alias varchar(60) NOT NULL DEFAULT '',
  marca varchar(60) NOT NULL DEFAULT '',
  activo tinyint(1) NOT NULL DEFAULT 1,
  creado_en datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (id),
  KEY usuario_id (usuario_id),
  KEY matricula (matricula)
) {charset};

CREATE TABLE {prefix}ta_conductores (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  usuario_id bigint(20) unsigned NOT NULL,
  vehiculo_id bigint(20) unsigned DEFAULT NULL,
  alias varchar(60) NOT NULL,
  activo tinyint(1) NOT NULL DEFAULT 1,
  creado_en datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (id),
  KEY usuario_id (usuario_id),
  KEY vehiculo_id (vehiculo_id)
) {charset};

CREATE TABLE {prefix}ta_vencimientos (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  usuario_id bigint(20) unsigned NOT NULL,
  vehiculo_id bigint(20) unsigned DEFAULT NULL,
  conductor_id bigint(20) unsigned DEFAULT NULL,
  tipo varchar(40) NOT NULL,
  fecha_referencia date NOT NULL,
  intervalo_dias smallint(5) unsigned NOT NULL,
  fecha_vencimiento date NOT NULL,
  notas varchar(255) NOT NULL DEFAULT '',
  activo tinyint(1) NOT NULL DEFAULT 1,
  creado_en datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (id),
  KEY usuario_id (usuario_id),
  KEY vehiculo_id (vehiculo_id),
  KEY conductor_id (conductor_id),
  KEY fecha_vencimiento (fecha_vencimiento)
) {charset};

CREATE TABLE {prefix}ta_avisos (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  vencimiento_id bigint(20) unsigned NOT NULL,
  dias_antelacion smallint(5) unsigned NOT NULL,
  estado varchar(20) NOT NULL DEFAULT 'enviado',
  enviado_en datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY  (id),
  UNIQUE KEY vencimiento_antelacion (vencimiento_id, dias_antelacion)
) {charset};
