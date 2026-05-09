<?php

function rentify_install() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Tabla Usuarios
    $tabla_usuarios = $wpdb->prefix . 'rentify_usuarios';
    $sql_usuarios = "CREATE TABLE $tabla_usuarios (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        rol ENUM('usuario','superusuario','admin') DEFAULT 'usuario',
        nombre VARCHAR(100) NOT NULL,
        apellido VARCHAR(100) NOT NULL,
        correo VARCHAR(150) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        token VARCHAR(255),
        token_expiry DATETIME
    ) $charset_collate;";

    // Tabla Superusuarios
    $tabla_superusuarios = $wpdb->prefix . 'rentify_superusuarios';
    $sql_superusuarios = "CREATE TABLE $tabla_superusuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT NOT NULL,
        nivel VARCHAR(50),
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (id_usuario) REFERENCES $tabla_usuarios(id_usuario)
    ) $charset_collate;";

    // Tabla Contratos
    $tabla_contratos = $wpdb->prefix . 'rentify_contratos';
    $sql_contratos = "CREATE TABLE $tabla_contratos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT NOT NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        calle VARCHAR(150),
        numero VARCHAR(20),
        manzana VARCHAR(20),
        solar VARCHAR(20),
        barrio VARCHAR(100),
        departamento VARCHAR(100),
        apartamento VARCHAR(50),
        garage VARCHAR(50),
        prop_nombre VARCHAR(100),
        prop_apellido VARCHAR(100),
        prop_telefono VARCHAR(20),
        prop_mail VARCHAR(150),
        inq_nombre VARCHAR(100),
        inq_apellido VARCHAR(100),
        inq_telefono VARCHAR(20),
        inq_mail VARCHAR(150),
        precio_alquiler DECIMAL(10,2),
        moneda VARCHAR(10),
        tipo_reajuste VARCHAR(50),
        garantia VARCHAR(50),
        tiempo_contrato VARCHAR(50),
        duracion_anios INT,
        duracion_meses INT,
        inicio DATE,
        fin DATE,
        link_drive VARCHAR(255),
        papelera TINYINT(1) DEFAULT 0,
        notas TEXT,
        FOREIGN KEY (id_usuario) REFERENCES $tabla_usuarios(id_usuario)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_usuarios);
    dbDelta($sql_superusuarios);
    dbDelta($sql_contratos);
}
