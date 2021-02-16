<?php

/**
 *
 * Configurasi Variabel yang dibutuhkan
 *
 * 
 * @package   DBCOMPARE
 * @author    Rizki Pebrianto <rizkipebrianto96@gmail.com>
 * @param     ...
 * @return    ...
 *
 */

define('ROOT_DIR', dirname(__FILE__));
define('ENV_FILE', ROOT_DIR . '/.env');
define('DRIVER_DIR', ROOT_DIR . '/driver/');
define('TEMPLATE_DIR', ROOT_DIR . '/template/');

if (isset($_ENV['DATABASE_DRIVER']) && isset($_ENV['DATABASE_HOST']) && isset($_ENV['DATABASE_HOST_SECONDARY'])) {
  $params = $_ENV;
} else {
  if (!file_exists(ENV_FILE)) die('File "' . ENV_FILE . '" tidak ada. Buat file gann..');
  $params = parse_ini_file(ENV_FILE, false, INI_SCANNER_RAW);
}

$_paramEnv = array(
  'DATABASE_DRIVER',
  'DATABASE_ENCODING',
  'SAMPLE_DATA_LENGTH',

  'DATABASE_HOST',
  'DATABASE_PORT',
  'DATABASE_NAME',
  'DATABASE_USER',
  'DATABASE_PASSWORD',
  'DATABASE_DESCRIPTION',

  'DATABASE_HOST_SECONDARY',
  'DATABASE_PORT_SECONDARY',
  'DATABASE_NAME_SECONDARY',
  'DATABASE_USER_SECONDARY',
  'DATABASE_PASSWORD_SECONDARY',
  'DATABASE_DESCRIPTION_SECONDARY',
);

array_map(function ($name) use ($params) {
  if (!isset($params[$name])) {
    die('Atribut ' . $name . ' tidak ditemukan di file ' . ENV_FILE);
  } else {
    define($name, $params[$name]);
  }
}, $_paramEnv);

define('DEV_DSN',  DATABASE_DRIVER . '://' . DATABASE_USER . ':' . DATABASE_PASSWORD . '@' . DATABASE_HOST . ':' . DATABASE_PORT . '/' . DATABASE_NAME);
define('PROD_DSN',  DATABASE_DRIVER . '://' . DATABASE_USER_SECONDARY . ':' . DATABASE_PASSWORD_SECONDARY . '@' . DATABASE_HOST_SECONDARY . ':' . DATABASE_PORT_SECONDARY . '/' . DATABASE_NAME_SECONDARY);

/* End of file compare.php */
