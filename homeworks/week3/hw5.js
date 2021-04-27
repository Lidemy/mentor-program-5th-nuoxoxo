// Parse

var readline = require('readline');
var rl = readline.createInterface({
  input: process.stdin
});

var lines = []

rl.on('line', function(line){
  lines.push(line);
});

rl.on('close', function(){
  solve(lines);
});

function solve(lines){

  let a = [];

  for (let i = 0; i < lines.length - 1; i++){
    a.push(lines[i + 1].split(' '));
    iif (a[i][0].length < 16){
      a[i][0] = Number(a[i][0]);
    } else {
      a[i][0] = BigInt(a[i][0]);
    }
    if (a[i][1].length < 16){
      a[i][1] = Number(a[i][1]);
    } else {
      a[i][1] = BigInt(a[i][1]);
    }
  }

  for (let i = 0; i < a.length; i++){
    console.log(judge(a[i]));
  }
}

function judge(arr){

  if (arr[1] === arr[0]){
    return 'DRAW';
  } else {
    if (arr[2] === '-1'){
      if (arr[1] > arr[0]){
        return 'A';
      } else {
        return 'B';
      }
    } else if (arr[2] === '1') {
      if (arr[1] > arr[0]){
        return 'B';
      } else {
        return 'A';
      }
    }
  }
  return false;
}
