// Parsing

var readline = require('readline');
var rl = readline.createInterface({
  input: process.stdin
});

var lines = []

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function() {
  solve(lines)
});


// Solver function

function solve(arr) {
  let [ n, m ] = arr[0].split(' ').map(Number);
  let sum, len, a, b;

  for (let i = n; i < m + 1; i++){
    let len = 0;
    a = i;
    while (a != 0){
      a = Math.floor(a / 10);
      len++;
    }
  
    sum = 0;
    b = i;

    for (let j = 0; j < len; j++){
      sum += b % 10 ** len;
      b = Math.floor(b / 10);
    }

    if (sum == i){
      console.log(sum);
    }
  }
}
