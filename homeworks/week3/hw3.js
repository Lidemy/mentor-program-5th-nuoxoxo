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

function isPrime(n){
  if (n === 1) return false;
  for (let i = 2; i < n; i ++){
      if (n % i === 0) {
        return false;
      }
  }
  return true;
}


function solve(lines) {
  for (let i = 1; i < lines.length; i++){
    console.log( isPrime(Number(lines[i]) ) ? 'Prime' : 'Composite')
  }
}

