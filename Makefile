.PHONY: up down restart bash artisan queue-work tinker test

up:
	docker-compose up -d --build

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d --build

bash:
	docker exec -it laravel-app bash

artisan:
	docker exec -it laravel-app php artisan $(cmd)

queue-work:
	docker exec -it laravel-app php artisan queue:work

tinker:
	docker exec -it laravel-app php artisan tinker

test:
	docker exec -it laravel-app php artisan test
