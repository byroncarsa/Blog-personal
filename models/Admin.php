<?php

namespace Model;

class Admin extends ActiveRecord {
   
    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'password'];

    public $id;
    public $nombre;
    public $password;
    public $autenticado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El nombre de usuario es obligatorio";
        }
        if(!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    public function existeUsuario() {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM " . self::$tabla . " WHERE nombre = '" . $this->nombre . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows) {
            self::$errores[] = 'El Usuario No Existe';
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();

        $this->autenticado = password_verify( $this->password, $usuario->password );

        if(!$this->autenticado) {
            self::$errores[] = 'El Password es Incorrecto';
            return;
        } 
    }

    public function autenticar() {
         // El usuario esta autenticado
         session_start();

         // Llenar el arreglo de la sesión
         $_SESSION['usuario'] = $this->nombre;
         $_SESSION['login'] = true;

         header('Location: /articulos');
    }

}