function printFactor(n) {
    for (let i = 0; i <= Math.abs(n); i++){
        if (n % i == 0){
            console.log(i);
        }
    }
}


/*

printFactor(10);
printFactor(7);

*/
