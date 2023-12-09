import multiprocessing

def __merge_sort(arr):
    if len(arr) <= 1:
        return arr
    mid = len(arr) // 2
    left = __merge_sort(arr[:mid])
    right = __merge_sort(arr[mid:])
    return merge(left, right)

def merge(left, right):
    result = []
    i = j = 0
    while i < len(left) and j < len(right):
        if left[i] < right[j]:
            result.append(left[i])
            i += 1
        else:
            result.append(right[j])
            j += 1
    result.extend(left[i:])
    result.extend(right[j:])
    return result

def merge_sort(arr):
    filtered_arr = [x for x in arr if isinstance(x, (int, float))]

    threshold = 1000
    if len(filtered_arr) <= threshold:
        return __merge_sort(filtered_arr)
    else:
        with multiprocessing.Pool() as pool:
            size = len(filtered_arr)
            mid = size // 2
            left, right = pool.map(__merge_sort, [filtered_arr[:mid], filtered_arr[mid:]])
            return merge(left, right)
