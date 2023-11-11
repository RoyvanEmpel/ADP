#!/bin/bash

# Het pad naar de root van de unittests
ROOT_DIR="cases"

composer i

# Vind en navigeer naar elke unit-test directory en voer daar phpunit uit
find . -type d -name "unit-tests" | while read -r test_dir; do
    echo "Running PHPUnit in $test_dir"
    pushd "$test_dir" > /dev/null                                  # Navigeer naar de unittest directory
    ./vendor/bin/phpunit $ROOT_DIR/$test_dir/--filename--          # Voer PHPUnit uit
    popd > /dev/null                                               # Ga terug naar de vorige directory
done

echo "All tests have been run."