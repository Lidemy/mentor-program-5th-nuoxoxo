const process = require('process');
let a = process.argv[2];
let b = process.argv[3];

function add(a, b){
    let tmp;
    while (b != 0){
        tmp = a & b;
        a = a ^ b;
        b = tmp << 1;
    }

    return a;
}

console.log(add(a, b));
