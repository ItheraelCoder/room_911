# ROOM_911 - Sistema de Control de Acceso

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 11">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP 8.2+">
    <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql" alt="MySQL">
    <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap" alt="Bootstrap 5.3">
</p>

## 📋 Descripción del Proyecto

**ROOM_911** es un sistema de control de acceso desarrollado en Laravel que permite gestionar y monitorear el acceso de empleados a áreas restringidas. El sistema proporciona un simulador de punto de acceso y un panel administrativo completo para la gestión de empleados y generación de reportes.

## ✨ Características Principales

### 🔐 Sistema de Acceso

-   **Simulador de Punto de Acceso**: Interface pública para registrar intentos de acceso
-   **Verificación Automática**: Validación de permisos en tiempo real
-   **Registro de Logs**: Histórico completo de todos los intentos de acceso

### 👥 Gestión de Empleados

-   **CRUD Completo**: Crear, leer, actualizar y eliminar empleados
-   **Organización por Departamentos**: Estructura jerárquica de empleados
-   **Gestión de Permisos**: Activar/desactivar acceso individualmente
-   **Importación Masiva**: Carga de empleados desde archivos CSV

### 📊 Panel Administrativo

-   **Dashboard Interactivo**: Vista general con filtros y búsquedas
-   **Historial de Acceso**: Seguimiento detallado por empleado
-   **Reportes PDF**: Generación de reportes descargables
-   **Autenticación Segura**: Sistema de login para administradores

## 🏗️ Arquitectura del Sistema

### Modelos de Datos

-   **Employee**: Información de empleados (ID interno, nombre, departamento, permisos)
-   **Department**: Departamentos organizacionales
-   **AccessLog**: Registro de intentos de acceso con timestamp y estado
-   **Admin**: Usuarios administrativos del sistema

### Estados de Acceso

-   `granted`: Acceso concedido (empleado registrado con permisos)
-   `denied`: Acceso denegado (empleado registrado sin permisos)
-   `not_registered`: Empleado no encontrado en el sistema

## 🚀 Instalación y Configuración

### Requisitos Previos

-   PHP 8.2 o superior
-   Composer
-   Node.js y npm
-   MySQL/MariaDB

### Pasos de Instalación

1. **Clonar el repositorio**

```bash
git clone https://github.com/ItheraelCoder/room_911.git
cd room_911
```

2. **Instalar dependencias**

```bash
composer install
npm install
```

3. **Configurar el entorno**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar la base de datos**
   Edita el archivo `.env` con tus credenciales de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=room_911
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. **Ejecutar migraciones**

```bash
php artisan migrate
```

6. **Compilar assets**

```bash
npm run build
```

7. **Iniciar el servidor**

```bash
php artisan serve
```

## 📖 Uso del Sistema

### Para Empleados (Acceso Público)

1. Accede a la URL principal del sistema
2. Ingresa tu ID interno de empleado
3. El sistema registrará automáticamente el intento de acceso

### Para Administradores

1. **Acceso al Panel**: Ve a `/admin/login`
2. **Registro de Admin**: Si es la primera vez, registra un administrador en `/admin/register`
3. **Dashboard**: Gestiona empleados, departamentos y visualiza logs
4. **Importación**: Usa la función de importación CSV para cargar empleados masivamente
5. **Reportes**: Genera y descarga reportes PDF del historial de acceso

## 📁 Estructura del Proyecto

```
app/
├── Http/Controllers/
│   ├── AccessController.php        # Simulador de acceso
│   ├── Admin/
│   │   └── EmployeeController.php  # Gestión de empleados
│   └── Auth/
│       └── AdminController.php     # Autenticación admin
├── Models/
│   ├── Employee.php               # Modelo de empleados
│   ├── Department.php            # Modelo de departamentos
│   ├── AccessLog.php             # Modelo de logs
│   └── Admin.php                 # Modelo de administradores
resources/views/
├── access_simulator.blade.php    # Vista del simulador
├── admin/                        # Vistas administrativas
└── layouts/                      # Layouts base
```

## 🛠️ Tecnologías Utilizadas

-   **Backend**: Laravel 11, PHP 8.2+
-   **Frontend**: Blade Templates, Bootstrap 5.3
-   **Base de Datos**: MySQL/MariaDB
-   **PDF Generation**: DomPDF
-   **CSV Processing**: League CSV
-   **Autenticación**: Sistema personalizado

## 📝 Funcionalidades Futuras

-   [ ] API REST para integración con sistemas externos
-   [ ] Notificaciones en tiempo real
-   [ ] Reportes avanzados con gráficos
-   [ ] Integración con lectores de tarjetas RFID
-   [ ] Auditoría de seguridad avanzada

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 📞 Contacto

**Desarrollador**: ItheraelCoder  
**Proyecto**: [https://github.com/ItheraelCoder/room_911](https://github.com/ItheraelCoder/room_911)
