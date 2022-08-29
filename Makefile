.DEFAULT_GOAL := check

check:
	clear
	./vendor/bin/phpstan analyse app
	./vendor/bin/pint --test

test:
	clear
	./vendor/bin/pest

production:
	clear
	composer install
	npm install
	npm run build
	php artisan storage:link

clear_all: clear
	clear
	rm -f .idea/httpRequests/*
	rm -f storage/backup/*

clear:
	php artisan route:clear
	php artisan config:clear
	php artisan view:clear

update:
	@echo "Running php version:"
	@php --version
	@echo "Are you sure is it OK? [y/N] " && read ans && [ $${ans:-N} = y ]
	@echo "Current Laravel Version"
	php artisan --version
	@echo "\nUpdating..."
	composer update
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	php artisan livewire:discover
	php artisan filament:upgrade
	@echo "UPDATED Laravel Version"
	php artisan --version

backup:
	php artisan backup:run

recreate:
	clear
	php artisan migrate:fresh --seed

format_code:
	clear
	./vendor/bin/pint
