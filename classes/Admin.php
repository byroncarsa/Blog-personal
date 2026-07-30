<?php

namespace App;

class Admin extends ActiveRecord{
    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'usuario', 'password'];

    public $id;
    public $nombre;
    public $password;

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
        $query = "SELECT * FROM usuarios WHERE nombre = '" . $this->nombre . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            return [
                true,
                $resultado
            ];
        } else {
            self::$errores[] = 'El Usuario No Existe';
            return [
                false,
                self::$errores
            ];
        } 
    }

    public function verificarPassword($resultado) {

        $nombre = $resultado->fetch_assoc();
        $auth = password_verify($this->password, $nombre['password']);


        if($auth) {

            // El usuario esta autenticado
            session_start();

            // Llenar el arreglo de la sesión
            $_SESSION['usuario'] = $nombre['nombre'];
            $_SESSION['login'] = true;
            return true;
        } else {
            self::$errores[] = 'Password Incorrecto';
            return [
                false,
                self::$errores
            ];
        }


    }


}