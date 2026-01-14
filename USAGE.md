# Quick Usage Guide

This guide provides quick commands to get started with the Docker Compose Apache2 template.

## Start the Server

```bash
docker compose up -d
```

## Access the Application

- **Main Page**: http://localhost:8080
- **PHP Info**: http://localhost:8080/phpinfo.php

## View Logs

```bash
# Follow logs in real-time
docker compose logs -f apache

# View last 100 lines
docker compose logs --tail=100 apache
```

## Stop the Server

```bash
docker compose down
```

## Rebuild After Configuration Changes

```bash
docker compose up -d --build
```

## Access Container Shell

```bash
docker compose exec apache bash
```

## Common Tasks

### Test Apache Configuration
```bash
docker compose exec apache apachectl configtest
```

### Restart Apache
```bash
docker compose restart apache
```

### View Apache Modules
```bash
docker compose exec apache apache2ctl -M
```

### Clear and Rebuild
```bash
docker compose down -v
docker compose build --no-cache
docker compose up -d
```

## Troubleshooting

If port 8080 is already in use, edit `docker-compose.yml` and change:
```yaml
ports:
  - "9090:80"  # Changed from 8080 to 9090
```

For more detailed information, see [PR_REVIEW_TEMPLATE.md](PR_REVIEW_TEMPLATE.md).
