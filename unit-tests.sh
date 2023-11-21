#!/bin/bash

# Het pad naar de root van de unittests
ROOT_DIR="cases"

composer i

# Vind en navigeer naar elke unit-test directory en voer daar phpunit uit
find "$ROOT_DIR" -type d -name "unit-tests" | while read -r test_dir; do
  # Voor elk PHP-bestand in de huidige unit-tests directory
  find "$test_dir" -type f -name "*.php" | while read -r test_file; do
    echo "Running PHPUnit on $test_file"   # Navigeer naar de unittest directory
    ./vendor/bin/phpunit "$test_file"      # Voer PHPUnit uit met huidige bestandsnaam
  done
done

echo "All tests have been run."