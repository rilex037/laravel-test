.PHONY: start stop migrate seed shell

DOCKER_COMPOSE = docker compose -f .docker/docker-compose.yml

start:
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) up -d --build

stop:
	$(DOCKER_COMPOSE) down

migrate:
	$(DOCKER_COMPOSE) exec app php artisan migrate

seed:
	$(DOCKER_COMPOSE) exec app php artisan db:seed

shell:
	$(DOCKER_COMPOSE) exec app bash
