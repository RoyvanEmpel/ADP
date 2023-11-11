#!/bin/bash

# Verander naar de 'cases' directory
cd /cases || exit

# Lijst van alle mappen (projecten) binnen 'cases'
projects=$(find . -maxdepth 1 -type d)

# Loop door elk project
for project in $projects
do
    if [ "$project" != "." ]; then
        # Controleer of het een map is
        if [ -d "$project/unit-tests" ]; then
            echo "Running PHPUnit tests for project: $project"
            cd "$project/unit-tests" || exit

            # Voer PHPUnit-tests uit als ze bestaan
            if [ -f "phpunit.xml" ]; then
                phpunit
            else
                echo "No PHPUnit tests found for $project"
            fi

            cd ../../ || exit
        else
            echo "No unit-tests directory found for $project"
        fi
    fi
done
