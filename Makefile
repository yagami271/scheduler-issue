
start:
	docker compose up -d

stop:
	docker compose down

install:
	docker compose run php composer install

console:
	docker compose run --rm php php bin/console $(cmd)

composer-install:
	docker compose run --rm php composer install

bash:
	docker compose exec php bash