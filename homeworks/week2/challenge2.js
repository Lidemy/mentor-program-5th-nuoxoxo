function search(arr, n)
{
  if (arr.includes(n)) return arr.indexOf(n);
  else return (-1);
}

console.log(search([1, 3, 10, 14, 39], 14));
console.log(search([1, 3, 10, 14, 39], 299));
