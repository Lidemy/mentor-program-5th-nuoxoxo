// use regex and .slice()

function capitalize(str) {
    if (str[0].match(/[a-z]/i)){
        var str = str[0].toUpperCase() + str.slice(1);
    }
    return str;
}


/*

console.log(capitalize('nick'));
console.log(capitalize('Nick'));
console.log(capitalize(',hello'));

*/
