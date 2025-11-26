# Guía de Instalación - Sistema de Asistencias

## 📋 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP 8.2 o superior**
- **Composer** (gestor de dependencias de PHP)
- **Node.js 18+ y npm** (para compilar assets)
- **Base de datos**: SQLite (por defecto) o MySQL/MariaDB
- **Git** (opcional, para clonar el repositorio)

---

## 🚀 Pasos de Instalación

### 1. Clonar o copiar el proyecto

```bash
# Si usas Git
git clone <URL_DEL_REPOSITORIO>
cd asistencias

# O simplemente copia la carpeta del proyecto
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar variables de entorno

```bash
# Copia el archivo de ejemplo
cp .env.example .env

# O en Windows
copy .env.example .env
```

Edita el archivo `.env` y configura las siguientes variables:

```env
APP_NAME=Asistencias
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Base de datos (SQLite por defecto)
DB_CONNECTION=sqlite

# Para usar MySQL/MariaDB, descomenta y configura:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=asistencias
# DB_USERNAME=root
# DB_PASSWORD=

# WebSockets con Reverb
BROADCAST_CONNECTION=reverb

# Configuración de Reverb
REVERB_APP_ID=731980
REVERB_APP_KEY=cpxxox1grnzuero0m5kf
REVERB_APP_SECRET=voj5gt3riymiakmbcicm
REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http

# Variables para el frontend (Vite)
VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

### 4. Generar clave de aplicación

```bash
php artisan key:generate
```

### 5. Crear base de datos

Si usas **SQLite** (recomendado para desarrollo):

```bash
# Windows PowerShell
New-Item -Path database/database.sqlite -ItemType File

# Linux/Mac
touch database/database.sqlite
```

Si usas **MySQL/MariaDB**, crea la base de datos manualmente:

```sql
CREATE DATABASE asistencias CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Ejecutar migraciones

```bash
php artisan migrate
```

Si quieres datos de prueba (seeders):

```bash
php artisan migrate --seed
```

### 7. Crear enlace simbólico para archivos

```bash
php artisan storage:link
```

### 8. Instalar dependencias de Node.js

```bash
npm install
```

### 9. Compilar assets

Para **producción**:

```bash
npm run build
```

Para **desarrollo** (con hot reload):

```bash
npm run dev
```

### 10. Agregar imagen de bienvenida

Descarga una imagen de un aula o estudiantes y colócala en:

```
public/img/aula.jpg
```

Puedes usar sitios como:
- [Unsplash](https://unsplash.com/s/photos/classroom)
- [Pexels](https://www.pexels.com/search/classroom/)

---

## 🖥️ Ejecutar la Aplicación

### Servidor Laravel

```bash
php artisan serve
```

La aplicación estará disponible en: `http://127.0.0.1:8000`

### Servidor WebSocket (Reverb)

En otra terminal, ejecuta:

```bash
php artisan reverb:start
```

Esto iniciará el servidor WebSocket en el puerto 8080.

### Cola de trabajos (opcional)

Si usas jobs en cola:

```bash
php artisan queue:work
```

---

## 🌐 Configuración para Otra PC (Red Local)

### En la PC que ejecuta el servidor:

1. **Configura el archivo `.env`:**

```env
APP_URL=http://192.168.1.100:8000

REVERB_HOST=192.168.1.100
REVERB_PORT=8080

VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
```

> Reemplaza `192.168.1.100` con la IP real de tu PC.

2. **Recompila los assets:**

```bash
npm run build
```

3. **Inicia el servidor en todas las interfaces:**

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

4. **Inicia Reverb:**

```bash
php artisan reverb:start --host=0.0.0.0 --port=8080
```

### Configuración del Firewall

Asegúrate de que los puertos estén abiertos:

**Windows Firewall:**

```powershell
# Permitir puerto 8000 (Laravel)
New-NetFirewallRule -DisplayName "Laravel Dev Server" -Direction Inbound -LocalPort 8000 -Protocol TCP -Action Allow

# Permitir puerto 8080 (Reverb WebSocket)
New-NetFirewallRule -DisplayName "Reverb WebSocket" -Direction Inbound -LocalPort 8080 -Protocol TCP -Action Allow
```

### Desde otras PCs en la red:

Accede usando la IP del servidor:

```
http://192.168.1.100:8000
```

---

## 👥 Usuarios por Defecto (si ejecutaste seeders)

El seeder crea usuarios de ejemplo. Revisa `database/seeders/DatabaseSeeder.php` para conocer las credenciales.

Ejemplo:

```
Admin:
Email: admin@admin.com
Password: password

Profesor:
Email: profesor@profesor.com
Password: password

Alumno:
Email: alumno@alumno.com
Password: password
```

---

## 🔧 Problemas Comunes

### WebSocket no conecta

**Síntoma:** Los eventos en tiempo real no funcionan.

**Solución:**

1. Verifica que `php artisan reverb:start` esté ejecutándose
2. Revisa que las variables `VITE_REVERB_*` estén correctamente configuradas
3. Asegúrate de haber ejecutado `npm run build` después de cambiar el `.env`
4. Verifica el firewall
5. Revisa la consola del navegador (F12) para errores de conexión

### Error "Base de datos no encontrada"

**Solución:**

Si usas SQLite, verifica que existe `database/database.sqlite`.

Si usas MySQL, verifica las credenciales en `.env`.

### Error "NPM run dev" falla

**Solución:**

```bash
# Limpia cache y reinstala
rm -rf node_modules package-lock.json
npm install
npm run dev
```

### Página en blanco o error 500

**Solución:**

1. Verifica permisos de carpetas:

```bash
chmod -R 775 storage bootstrap/cache
```

2. Revisa logs:

```bash
tail -f storage/logs/laravel.log
```

---

## 📱 Uso de la Aplicación

### Roles de Usuario

1. **Admin**: Gestiona profesores, clases y configuración
2. **Profesor/Preceptor**: Toma asistencias de sus clases
3. **Alumno**: Visualiza sus asistencias

### Funcionalidades Principales

- ✅ **Registro en tiempo real** de asistencias con WebSockets
- 📊 **Dashboard** personalizado según rol
- 🎓 **Gestión de clases** y asignación de alumnos
- 📈 **Reportes** de asistencias por clase y alumno

---

## 🛠️ Comandos Útiles

```bash
# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Reiniciar base de datos
php artisan migrate:fresh --seed

# Ver rutas disponibles
php artisan route:list

# Crear enlace simbólico
php artisan storage:link

# Compilar assets en modo watch
npm run dev
```

---

## 📞 Soporte

Si encuentras problemas:

1. Revisa los logs en `storage/logs/laravel.log`
2. Verifica la consola del navegador (F12)
3. Revisa que todos los servicios estén corriendo (Laravel, Reverb, npm)

---

## 📄 Licencia

Este proyecto es de uso educativo/privado.
