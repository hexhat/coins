PATH_HTML_REPORT := builds/phpunit-coverage-html-report


debug:
	@ composer exec --verbose psysh

install:
	@ composer install

lint:
	@ composer exec --verbose phpcs -- --standard=PSR12 bin src tests
	@ composer exec --verbose phpstan -- --level=6 analyse bin src tests

lint-fix:
	@ composer exec --verbose phpcbf -- --standard=PSR12 bin src tests

test:
	@ composer exec --verbose phpunit tests

test-with-coverage:
	@ mkdir -pv 'builds'
	@ rm -rfv "${PATH_HTML_REPORT}"
	@ composer exec --verbose phpunit tests -- --coverage-text --coverage-html "${PATH_HTML_REPORT}"

before-commit:
	make lint
	make test-with-coverage
	git --no-pager diff --color-words
	git --no-pager diff --staged --color-words
	${BROWSER} "${PATH_HTML_REPORT}/index.html"
