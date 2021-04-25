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
  if (n == 1){
    return 'Composite';
  } else {
    for (let i = 2; i < n; i ++){
      if (n % i == 0){
        return 'Composite';
      }
    } 
    return 'Prime';
  }
}

function solve(lines) {
  if ( Number(lines[0]) >= 1 && Number(lines[0] <= 100 )){
    let len = Number(lines[0]);
    let tmp;

    for (let i = 1; i < len + 1; i++){
      tmp = Number(lines[i]);
      if ( tmp >= 1 && tmp <= 100000 ) {
        console.log(isPrime(tmp));
      }
    }
  }
}

