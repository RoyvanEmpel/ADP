import concurrent.futures

def merge_sort(array):
    if len(array) <= 1:
        return array

    mid = len(array) // 2
    left_half = array[:mid]
    right_half = array[mid:]

    with concurrent.futures.ThreadPoolExecutor() as executor:
        futures = [executor.submit(merge_sort, left_half),
                   executor.submit(merge_sort, right_half)]
        left_half, right_half = [f.result() for f in futures]

    return merge(left_half, right_half)

def merge(left_half, right_half):
    merged = []
    i = j = 0
    while i < len(left_half) and j < len(right_half):
        if left_half[i] < right_half[j]:
            merged.append(left_half[i])
            i += 1
        else:
            merged.append(right_half[j])
            j += 1

    while i < len(left_half):
        merged.append(left_half[i])
        i += 1

    while j < len(right_half):
        merged.append(right_half[j])
        j += 1
    
    return merged

# Test the function
data = [38, 27, 43, 3, 9, 82, 10]
sorted_data = merge_sort(data)
print(sorted_data)