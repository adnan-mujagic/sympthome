<?php
class Config{
  //DATE FORMAT
  const DATE_FORMAT ="Y-m-d H:i:s";

  //JWT SECRET
  const JWT_SECRET = "banana";
  const JWT_TOKEN_TIME = 86400;

  //PDO DATABASE CONSTANTS
  public static function DB_HOST(){
    return Config::get_env("DB_HOST","localhost");
  }

  public static function DB_PORT(){
    return Config::get_env("DB_PORT","3306");
  }

  public static function DB_USERNAME(){
    return Config::get_env("DB_USERNAME","sympthomeadmin");
  }

  public static function DB_PASSWORD(){
    return Config::get_env("DB_PASSWORD","sympthomeadmin");
  }

  public static function DB_SCHEMA(){
    return Config::get_env("DB_SCHEMA","sympthomedb");
  }

  public static function SMTP(){
    return Config::get_env("SMTP","smtp.office365.com");
  }

  public static function SMTP_USERNAME(){
    return Config::get_env("SMTP","<your_email>");
  }

  public static function SMTP_PASSWORD(){
    return Config::get_env("SMTP_PASSWORD","<your_password>");
  }

  public static function SMTP_PORT(){
    return Config::get_env("SMTP_PORT",587);
  }

  public static function get_env($name, $default){
    return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }
}

?>
