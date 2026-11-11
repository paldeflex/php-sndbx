.PHONY: composer

composer:
	docker compose exec --user $$(id -u):$$(id -g) -e COMPOSER_HOME=/tmp/composer php composer $(c)