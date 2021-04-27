// Parse 

var readline = require('readline');
var rl = readline.createInterface({
  input: process.stdin
});
var lines = []
rl.on('line', function(line) {
  lines.push(line)
});
rl.on('close', function() {
  solve(lines);
});


// Solve

function solve(lines) {

  for (let i = 0; i < Math.floor(lines[0].length / 2); i++){
    if (lines[0][i] != lines[0][lines[0].length - 1 - i]){
      console.log("False");
      return;
    }
  }
  console.log("True");
  return;
}

