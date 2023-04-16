.DEFAULT_GOAL:=help

install: ## Install the project
	cp --no-clobber .env.dist .env
	docker-compose build
	docker-compose run php composer install
	make reset-db

reset-db: ## Reset the database
	docker-compose run php bin/console doctrine:database:drop --if-exists --force
	docker-compose run php bin/console doctrine:database:create
	docker-compose run php bin/console doctrine:migrations:migrate --no-interaction

up: ## Start the project
	docker-compose up -d

help: ## Display this current help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-25s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)
