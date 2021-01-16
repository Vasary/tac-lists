PROJECT_NAME=lists
NETWORK=tac-develop-vlan0

build:
	docker build -t $(PROJECT_NAME) .

create-network:
	docker network create $(NETWORK) || echo "Network already exists"

install-deps:
	docker exec $(PROJECT_NAME) composer install

update-deps:
	docker exec $(PROJECT_NAME) composer update

clear-cache:
	docker exec $(PROJECT_NAME) bin/console cache:clear

db-create:
	docker exec $(PROJECT_NAME) bin/console do:da:cr

db-delete:
	docker exec $(PROJECT_NAME) bin/console do:da:dr --force

db-update:
	docker exec $(PROJECT_NAME) bin/console do:sc:up --force

start-container:
	docker run --rm --name $(PROJECT_NAME) --network=$(NETWORK) -it -p 8080:8080 -v $(PWD)/app:/application $(PROJECT_NAME) php -S 0.0.0.0:8080 -t public

start-postgres:
	docker run --rm --name $(PROJECT_NAME)-db --network=$(NETWORK) -e POSTGRES_PASSWORD=postgres -d -p 5432:5432 -e POSTGRES_DB=lists postgres:13

run: create-network start-container install-deps clear-cache
