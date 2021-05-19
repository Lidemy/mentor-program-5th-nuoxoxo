function search(arr, n, low = 0, high = arr.length - 1) {
  
  if (low > high) {
    return (-1);
  }
  
  let midpoint = Math.floor((low + high) / 2);
  
  if (arr[midpoint] === n) {
    return midpoint;
  } else if (arr[midpoint] > n) {
    return search(arr, n, low, midpoint - 1);
  } else {
    return search(arr, n, midpoint + 1, high);
  }

}
