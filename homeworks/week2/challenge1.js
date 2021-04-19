// CHA 1: 位元運算，回傳 a+b 的結果
// 但是函式裡面不能出現 +-*/ 任何一個符號

const process = require('process');
let a = process.argv[2];
let b = process.argv[3];

function add(a, b){
    let tmp;
    while (b != 0){
        tmp = a & b;
        //console.log(`carry ${tmp}`);
        
        a = a ^ b;
        b = tmp << 1;
    }

    return a;
}

console.log(add(a, b));
