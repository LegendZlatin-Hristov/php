# PR Review Template - Docker Compose with Apache2

This is a Docker Compose template for running PHP applications with Apache2 web server, designed for PR reviews and development environments.

## Features

- **Apache2 Web Server**: Pre-configured Apache2 with PHP support
- **PHP 8.2**: Latest stable PHP version with commonly used extensions
- **Custom Configuration**: Easily customizable Apache virtual host configuration
- **Volume Mounts**: Persistent storage for application files, configurations, and logs
- **Security Headers**: Pre-configured security headers for better protection
- **Hot Reload**: Changes to your code are immediately reflected

## Directory Structure

```
.
├── docker-compose.yml           # Docker Compose configuration
├── Dockerfile.apache            # Apache2 + PHP Dockerfile
├── apache/
│   ├── conf/
│   │   └── 000-default.conf    # Apache virtual host configuration
│   └── logs/                   # Apache access and error logs
├── public/
│   ├── index.php               # Sample PHP application
│   └── phpinfo.php             # PHP information page
└── PR_REVIEW_TEMPLATE.md       # This file
```

## Quick Start

### Prerequisites

- Docker (version 20.10 or higher)
- Docker Compose (version 2.0 or higher)

### Starting the Environment

1. **Clone the repository** (if not already done):
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. **Start the containers**:
   ```bash
   docker-compose up -d
   ```

3. **Access the application**:
   - Main application: http://localhost:8080
   - PHP Info: http://localhost:8080/phpinfo.php

4. **View logs**:
   ```bash
   docker-compose logs -f apache
   ```

### Stopping the Environment

```bash
docker-compose down
```

To remove volumes as well:
```bash
docker-compose down -v
```

## Configuration

### Apache Configuration

Edit `apache/conf/000-default.conf` to customize your Apache virtual host settings:

- Document root location
- Directory permissions
- Rewrite rules
- Security headers
- SSL/TLS settings (commented out by default)

After changing the configuration, rebuild and restart:
```bash
docker-compose up -d --build
```

### PHP Configuration

To customize PHP settings, add a custom `php.ini` file:

1. Create `apache/php.ini` with your settings
2. Update `Dockerfile.apache` to copy the file:
   ```dockerfile
   COPY apache/php.ini /usr/local/etc/php/conf.d/custom.ini
   ```
3. Rebuild the container:
   ```bash
   docker-compose up -d --build
   ```

### Environment Variables

The following environment variables are configured in `docker-compose.yml`:

- `APACHE_RUN_USER`: User for running Apache (default: www-data)
- `APACHE_RUN_GROUP`: Group for running Apache (default: www-data)
- `APACHE_LOG_DIR`: Directory for Apache logs (default: /var/log/apache2)

## Installed PHP Extensions

The template includes the following PHP extensions:

- pdo_mysql
- mbstring
- exif
- pcntl
- bcmath
- gd
- opcache

To add more extensions, edit `Dockerfile.apache` and add them to the `docker-php-ext-install` command.

## Port Mapping

- `8080:80` - HTTP traffic
- `8443:443` - HTTPS traffic (requires SSL configuration)

To change ports, edit the `ports` section in `docker-compose.yml`.

## Volumes

Three volumes are mounted for development:

1. `./public:/var/www/html` - Your application files
2. `./apache/conf:/etc/apache2/sites-available` - Apache configuration
3. `./apache/logs:/var/log/apache2` - Apache logs

## Security Features

The template includes several security best practices:

- Security headers (X-Content-Type-Options, X-Frame-Options, X-XSS-Protection)
- Hidden Apache version information
- Proper file permissions
- Isolated network

For production use, consider:
- Enabling SSL/TLS
- Configuring firewall rules
- Using secrets management for sensitive data
- Regular security updates

## Troubleshooting

### Container won't start

Check the logs:
```bash
docker-compose logs apache
```

### Permission issues

Ensure proper ownership:
```bash
sudo chown -R $USER:$USER public/ apache/
```

### Port already in use

Change the port mapping in `docker-compose.yml` or stop the conflicting service.

### Apache configuration syntax errors

Test the configuration:
```bash
docker-compose exec apache apachectl configtest
```

## Development Workflow

1. Place your PHP application files in the `public/` directory
2. Edit files using your favorite editor/IDE
3. Changes are automatically reflected (no restart needed for PHP files)
4. For configuration changes, restart the container:
   ```bash
   docker-compose restart apache
   ```

## PR Review Usage

This template is specifically designed for PR reviews:

1. **Checkout the PR branch**
2. **Start the environment**: `docker-compose up -d`
3. **Review the application** in your browser at http://localhost:8080
4. **Check logs** for any errors: `docker-compose logs apache`
5. **Stop when done**: `docker-compose down`

## Additional Commands

### Access container shell

```bash
docker-compose exec apache bash
```

### Rebuild without cache

```bash
docker-compose build --no-cache
docker-compose up -d
```

### View Apache modules

```bash
docker-compose exec apache apache2ctl -M
```

### Test Apache configuration

```bash
docker-compose exec apache apachectl configtest
```

## Extending the Template

### Adding MySQL Database

Add to `docker-compose.yml`:

```yaml
  mysql:
    image: mysql:8.0
    container_name: php-mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: app_db
      MYSQL_USER: app_user
      MYSQL_PASSWORD: app_pass
    ports:
      - "3306:3306"
    volumes:
      - mysql-data:/var/lib/mysql
    networks:
      - php-network

volumes:
  mysql-data:
```

### Adding phpMyAdmin

```yaml
  phpmyadmin:
    image: phpmyadmin:latest
    container_name: php-phpmyadmin
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
    ports:
      - "8081:80"
    networks:
      - php-network
    depends_on:
      - mysql
```

## License

This template is provided as-is for development and PR review purposes.

## Support

For issues or questions, please open an issue in the repository.
