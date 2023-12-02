import multiprocessing

def merge_sort(arr):
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

    def parallel_sort(arr, pool):
        size = len(arr)
        if size <= threshold:
            return __merge_sort(arr)
        else:
            mid = size // 2
            left, right = pool.map(__merge_sort, [arr[:mid], arr[mid:]])
            return merge(left, right)

    threshold = 1000  # Aanpassen op basis van de grootte van de dataset en de beschikbare resources
    with multiprocessing.Pool() as pool:
        return parallel_sort(arr, pool)