# PHPUnit Boilerplate

[![CI](https://github.com/mohdhafizi83/PHPUnitBoilerplate/actions/workflows/ci.yml/badge.svg)](https://github.com/mohdhafizi83/PHPUnitBoilerplate/actions/workflows/ci.yml)
[![Coverage](https://raw.githubusercontent.com/mohdhafizi83/PHPUnitBoilerplate/gh-pages/coverage.svg)](coverage/clover.xml)

A clean, modern starting point for PHP projects with [PHPUnit](https://phpunit.de).
Includes error/deprecation logging, coverage-ready configuration, PHPStan static
analysis (level max), and a GitHub Actions CI workflow.

Tested with PHP 8.3–8.5, PHPUnit 13, and PHPStan 2.

## Project Structure

```
.
├── bootstrap.php            # Autoloader + error/fatal logging to tests/logs/error_log.txt
├── composer.json            # PSR-4 autoload: App\ -> src/, App\Tests\ -> tests/
├── phpstan.neon             # PHPStan config (level max, analyses src/ and tests/)
├── phpunit.xml              # PHPUnit config (strict mode, clover coverage, JUnit + TestDox logs)
├── src/                     # Your source code (namespace App\)
│   └── Sample.php
├── tests/Unit/              # Your tests (namespace App\Tests\)
│   └── SampleTest.php
├── tests/logs/              # Generated logs (gitignored)
│   └── error_log.txt
└── coverage/                # Generated coverage reports (gitignored)
    └── clover.xml
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

Requires Xdebug (or PCOV). With Xdebug 3, the composer script sets
`XDEBUG_MODE=coverage` automatically:

```sh
composer test:coverage
```

This prints a text summary and writes HTML + Clover reports into `coverage/`.

### Static Analysis (PHPStan)

```sh
composer stan          # PHPStan level max on src/ and tests/
composer check         # PHPStan + tests in one go
```

Config lives in `phpstan.neon`. Level `max` is the strictest; lower it to
`level: 8` (or less) if your existing code needs a gentler start.

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

`.github/workflows/ci.yml` runs three jobs on every push/PR:

| Job | What it does |
|---|---|
| `test` | `composer testdox` on PHP 8.3, 8.4, 8.5 |
| `phpstan` | `composer stan` (level max) on PHP 8.5 |
| `coverage` | `composer test:coverage` with Xdebug, generates `coverage.svg` badge |

The coverage badge is published to the `gh-pages` branch and displayed at the top
of this README via `raw.githubusercontent.com/.../gh-pages/coverage.svg`.
It only updates on pushes to `main` (not on PRs), so the badge always reflects
the latest merged code.

## License

MIT — see [LICENSE](LICENSE).
