# Inhoud van benchmark_merge_sort.py
import sys
import json

# Voeg het pad naar de map waar de cases directory zich bevindt toe
sys.path.append('/workspaces/ADP')

from cases.merge_sort.MergeSort import merge_sort

def process_json_file(file_path):
    with open(file_path, 'r') as file:
        data = json.load(file)

        for key, array in data.items():
            print(f"Sorted array for {key}:")
            sorted_array = merge_sort(array)
            print(f"{sorted_array}")

# Verander de pad naar het JSON-bestand indien nodig
json_file_path = 'assets/json/dataset_sorteren.json'
process_json_file(json_file_path)
