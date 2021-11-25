# Mysqllion
It's a database to CSV converter that works in docker. It takes ~240 seconds to generate CSV from database with 1kk entries.
## Installation
Be sure that you have Docker installed
```bash
# Initialize containers
docker-compose up

# Enter container bash
docker exec -it app bash

# Make database migrations
php artisan migrate

# Seed fake data, this will generate 1kk entries in your database
php artisan db:seed

# Execute job worker
php artisan queue:work

# Serve the app
php artisan serve
```
## Endpoints
| Method | URI | Description |
|----------------|---------|----------------|
| **GET** | api/tasks | Create new task for generation. |
| **GET** | api/tasks/{id} | Check the status of the task. |
| **GET** | api/files/{path} | Download generated file. |
