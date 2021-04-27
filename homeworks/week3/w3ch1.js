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

function solve(lines){

  // Load grid from lines

  let grid = [];
  for (let i = 1; i < lines.length; i++){
    grid.push(lines[i]);
  }

  
  // Set starting point, directions and queue
  
  let queue = [];
  queue.push({x: 0, y: 0});

  let moveX = [-1, 1, 0, 0];
  let moveY = [0, 0, 1, -1];

  let ans = [];
  for (let i = 0; i < grid.length; i++){
    ans[i] = [];
  }

  ans[0][0] = 0;


  // Search path until queue is emptied

  while (queue.length){
    
    let {x, y} = queue.shift();

    for (let i = 0; i < 4; i++){
      
      let nextX = x + moveX[i];
      let nextY = y + moveY[i]; 
      

      // Check: Is this move is legal

      if (nextX < 0 || nextY < 0 || nextX >= grid[0].length || nextY >= grid.length || grid[nextY][nextX] != '.'){
        continue;
      } 

      if (ans[y][x] + 1 >= ans[nextY][nextX] && ans[nextY][nextX] !== undefined){
        continue;
      }

      
      // If legal, take the move

      let point = {x: nextX, y: nextY};
      queue.push(point);
      ans[nextY][nextX] = ans[y][x] + 1;
    }
  } 

  console.log(ans[grid.length - 1][grid[0].length - 1]);
}
