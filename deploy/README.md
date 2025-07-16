# RetroShop SQLi Lab - Docker Deployment

This folder contains Docker Compose files and initialization scripts for the RetroShop SQL Injection lab.

## Quick Start

1. **Clone the repository:**
   ```
   git clone <repo-url>
   cd deploy
   ```

2. **Build and start the services:**
   ```
   docker-compose up --build
   ```

3. **Access the application:**
   - Main app: http://localhost:8000
   - phpMyAdmin: http://localhost:8080

## Services
- **php-app:** PHP 8.2 with Apache, serving the RetroShop application
- **mysql:** MySQL 8.0 (simulating legacy 4.x behavior for the lab)
- **phpmyadmin:** Web-based database management

## Database Initialization
- The database is seeded automatically using `init.sql` on first run.
- Default credentials:
  - User: `cyberctf`
  - Password: `cyberctf123`
  - Database: `cyberctf`

## Stopping Services
```
docker-compose down
```

## Support
For issues, visit: https://github.com/your-org/ctf-labs/issues 