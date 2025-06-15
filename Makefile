PACKAGE_MANAGER := $(shell \
	if command -v apt-get > /dev/null; then echo apt; \
	elif command -v dnf > /dev/null; then echo dnf; \
	elif command -v yum > /dev/null; then echo yum; \
	elif command -v pacman > /dev/null; then echo pacman; \
	elif command -v zypper > /dev/null; then echo zypper; \
	elif command -v brew > /dev/null; then echo brew; \
	elif command -v apk > /dev/null; then echo apk; \
	else echo unknown; fi)

.PHONY = help build up down delete detect-package-manager commit

include .env
export

help:
	@echo "make build  - Установить проект локально"
	@echo "make up     - Запустить проект"
	@echo "make down   - Остановить проект"
	@echo "make delete - Удалить проект"

build:
	docker compose build

up:
	docker compose up

down:
	docker compose down

delete:
	docker compose down -v

detect-package-manager:
	@echo "$(PACKAGE_MANAGER)"

commit:
	git add .
	git commit -m "$(m)"
	git push origin main

run:
	docker exec --interactive --tty php.umarket sh # php public/index.php "$(url)"
