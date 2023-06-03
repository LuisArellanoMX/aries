<?php

class FTPService {

    public function subirArchivo($archivo, $nombreArchivo, $ruta) {
        $persistence = null;
        $sql = null;
        $lista = null;
        $server = null;
        $usuario = null;
        $contrasenia = null;
        $conn_id = null;
        $parametrosService = null;
        $login_result = null;
        $tmp = null;

        try {

            $server = '127.0.0.1';
            $usuario = 'usr_aries';
            $contrasenia = 'aries';


            // Conexión
            $conn_id = ftp_connect($server);

            // Login
            $login_result = ftp_login($conn_id, $usuario, $contrasenia); 

            // Ruta
            ftp_pasv ($conn_id, true);
            ftp_chdir($conn_id, $ruta);

            // Subir archivo
            $tmp = fopen('php://memory', 'r+');
            fputs($tmp, base64_decode($archivo));
            rewind($tmp);

            if (ftp_fput($conn_id, $nombreArchivo, $tmp, FTP_BINARY)) {
                ftp_close($conn_id); // Cerrar conexión
                return 1;
            } else {
                ftp_close($conn_id); // Cerrar conexión
                return -1;
            }

        } catch(Exception $e) {
            ftp_close($conn_id); // Cerrar conexión
            return -1;
        } finally {
            $persistence = null;
            $sql = null;
            $lista = null;
            $server = null;
            $usuario = null;
            $contrasenia = null;
            $conn_id = null;
            $parametrosService = null;
            $login_result = null;
            $tmp = null;
        }

    }
}

?>