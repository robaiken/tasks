start:
	php -S localhost:8080 -t public public/index.php

test:
	vendor/bin/phpunit tests/.

filter:
	vendor/bin/phpunit tests/. --filter $(test)

reset:
	cp storage/tasks.json.example storage/tasks.json