# Inhoud van benchmark_merge_sort.py
import sys
import time
import random
import multiprocessing

# Voeg het pad naar de map waar de cases directory zich bevindt toe
sys.path.append('/var/www/ADP')

from cases.merge_sort.MergeSort import merge_sort

def benchmark(test_name, data):
    start_time = time.time()
    merge_sort(data)
    end_time = time.time()
    print(f"{test_name}: {end_time - start_time} seconden")

testing_size = 10000

# Genereer willekeurige, oplopend gesorteerde en aflopend gesorteerde data
test_random = [random.randint(0, 10000) for _ in range(testing_size)]
test_sorted_asc = list(range(testing_size))
test_sorted_desc = list(range(testing_size, 0, -1))

# Voer benchmarks uit
print("Testing MergeSort - Random")
benchmark("MergeSort - Random", test_random.copy())

print("Testing MergeSort - Sort already sorted")
benchmark("MergeSort - Sort already sorted", test_sorted_asc.copy())

print("Testing MergeSort - Desc sort to asc")
benchmark("MergeSort - Desc sort to asc", test_sorted_desc.copy())
