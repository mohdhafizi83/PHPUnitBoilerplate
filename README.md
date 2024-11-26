# PHPUnit Boilerplate

This is a pre-written template for PHPUnit with an example. Your script should be located in the src folder, while your test script should be in the tests folder. You do not need to modify anything in bootstrap.php; it is a script designed to log errors and deprecations in the tests/logs/error_logs.txt file. This setup has been tested for PHP 8.3.9, PHPUnit 11.4.3, and above.

## Windows Users

### Step 1: Open Command Prompt
Open Command Prompt (cmd) and change the directory to your project root. Let's say your project is in `C:\laragon\www\PHPUnitBoilerplate`, then run the following command:

```sh
cd C:\laragon\www\PHPUnitBoilerplate
```

### Step 2: Install Composer
If you haven't installed Composer yet, download it from [Composer Download](https://getcomposer.org/download/).

### Step 3: Install PHPUnit
Run the following command to install PHPUnit:

```sh
composer require --dev phpunit/phpunit
```

### Step 4: Change Directory to `vendor/bin`
Run the following command:

```sh
cd vendor/bin
```

### Step 5: Execute Your Test Script
Run the following command to execute your test script:

```sh
phpunit --configuration ../../phpunit.xml --testdox
```

To get a detailed view of any errors or warnings during your PHPUnit tests, use the following command:

```sh
phpunit --debug --configuration ../../phpunit.xml --testdox
```

### Output
```
SampleTest
[x] Reset session

OK (1 test, 4 assertions)
```

## Linux and macOS Users

### Step 1: Open Terminal
Open Terminal and change the directory to your project root. For example, if your project is in `~/projects/PHPUnitBoilerplate`, run the following command:

```sh
cd ~/projects/PHPUnitBoilerplate
```

### Step 2: Install Composer
If you haven't installed Composer yet, you can install it by running the following command in the terminal:

```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Step 3: Install PHPUnit
Run the following command to install PHPUnit:

```sh
composer require --dev phpunit/phpunit
```

### Step 4: Change Directory to `vendor/bin`
Run the following command:

```sh
cd vendor/bin
```

### Step 5: Execute Your Test Script
Run the following command to execute your test script:

```sh
./phpunit --testdox ../../tests/SampleTest.php
```

### Output
```
SampleTest
[x] Reset session

OK (1 test, 4 assertions)
```