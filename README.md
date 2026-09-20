# PHPUnit Boilerplate

A clean, modern starting point for PHP projects with [PHPUnit](https://phpunit.de).
Includes error/deprecation logging, coverage-ready configuration, and a GitHub Actions CI workflow.

Tested with PHP 8.3–8.5 and PHPUnit 13.

## Project Structure

```
.
├── bootstrap.php            # Autoloader + error/fatal logging to tests/logs/error_log.txt
├── composer.json            # PSR-4 autoload: App\ -> src/, App\Tests\ -> tests/
├── phpunit.xml              # PHPUnit config (strict mode, JUnit + TestDox HTML logs)
├── src/                     # Your source code (namespace App\)
│   └── Sample.php
├── tests/Unit/              # Your tests (namespace App\Tests\)
│   └── SampleTest.php
└── tests/logs/              # Generated logs (gitignored)
    └── error_log.txt
```

## Quick Start

### 1. Install Composer

If you haven't installed Composer yet, see [getcomposer.org/download](https://getcomposer.org/download/).

On Linux/macOS:

```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 2. Install Dependencies

From the project root:

```sh
composer install
```

### 3. Run the Tests

```sh
composer test        # plain output
composer testdox   # human-readable TestDox output
```

Expected output:

```
Sample (App\Tests\Unit\Sample)
 [x] Reset session removes known keys
 [x] Reset session leaves unrelated keys untouched

OK (2 tests, 5 assertions)
```

### Coverage (optional)

Requires Xdebug or PCOV:

```sh
composer test:coverage
```

## Adapting This Boilerplate

1. Rename `your-vendor/your-project` in `composer.json` to your own vendor/package name.
2. Replace the `App\` namespace with your own (update `autoload`, `autoload-dev`, and the
   `namespace` lines in `src/` and `tests/`).
3. Delete `src/Sample.php` and `tests/Unit/SampleTest.php`, then add your own classes and tests.
4. Run `composer dump-autoload` after changing namespaces.

## What bootstrap.php Does

You normally do **not** need to modify it:

- Loads `vendor/autoload.php` so tests never need manual `require_once` calls.
- Sets `error_reporting(E_ALL)`.
- Logs every error/warning/deprecation to `tests/logs/error_log.txt` with timestamps.
- Catches fatal errors on shutdown and logs them too.

## Strict Mode

`phpunit.xml` is configured strictly so problems surface early:

- `failOnWarning` / `failOnNotice` / `failOnDeprecation` — any PHP diagnostic fails the build.
- `failOnRisky` + `beStrictAboutOutputDuringTests` — tests that echo output or assert nothing are errors.

Relax these in `phpunit.xml` if your project needs it.

## CI

`.github/workflows/ci.yml` runs `composer testdox` on every push/PR against PHP 8.3, 8.4, and 8.5.
Add the status badge to your README once the workflow is active:

```md
![CI](https://github.com/mohdhafizi83/PHPUnitBoilerplate/actions/workflows/ci.yml/badge.svg)
```

## License

MIT — see [LICENSE](LICENSE).
