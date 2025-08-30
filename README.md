# Cotizador de Auxiliares Auditivos

Este es un sistema web simple para generar cotizaciones en formato PDF para auxiliares auditivos, desarrollado para el Dr. Alejandro Viveros®.

## Características

- **Acceso Seguro:** Portal de inicio de sesión para proteger el acceso al cotizador.
- **Generación de PDF:** Crea documentos PDF con un formato profesional para las cotizaciones.
- **Gestión de Dependencias:** Incluye un script para instalar las bibliotecas necesarias.

---

## Instalación y Despliegue

Sigue estos pasos para desplegar la aplicación en un servidor con PHP y Nginx.

### 1. Clonar el Repositorio

Clona este repositorio en el directorio donde alojarás la aplicación en tu servidor (p. ej., `/var/www/html/cotizador`).

```bash
git clone https://github.com/soreviv/cotizador.git
```

### 2. Instalar Dependencias

El proyecto depende de la biblioteca TCPDF. Para instalarla, ejecuta el siguiente script desde la raíz del proyecto:

```bash
# Dar permisos de ejecución
chmod +x install_dependencies.sh

# Ejecutar el script
./install_dependencies.sh
```

### 3. Configurar Nginx

Crea un archivo de configuración para Nginx en `/etc/nginx/sites-available/cotizador.conf` con el siguiente contenido:

```nginx
server {
    listen 80;
    server_name cotizador.otorrinonet.com;

    root /var/www/otorrinonet.com/cotizador; # Asegúrate de que esta sea la ruta correcta
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        # La ruta al socket de PHP-FPM puede variar
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock; # Ajusta tu versión de PHP
    }

    location ~ /\.git {
        deny all;
    }
}
```

Después, activa la configuración y recarga Nginx:

```bash
sudo ln -s /etc/nginx/sites-available/cotizador.conf /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 4. Configurar DNS

Asegúrate de haber creado un registro DNS de tipo `A` para el subdominio `cotizador` que apunte a la IP de tu servidor (`148.230.94.171`).

---

## Uso

1.  Accede a `http://cotizador.otorrinonet.com` en tu navegador.
2.  Inicia sesión con la contraseña. La contraseña por defecto es `admin`.
3.  Para cambiar la contraseña, edita la variable `$password` en el archivo `login.php`.
