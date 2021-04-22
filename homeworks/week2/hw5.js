function join(arr, concatStr) {
    var result = "";
    for (let i = 0; i < arr.length; i++){
        result += arr[i];
        if (i != arr.length - 1){
            result += concatStr;
        }
    }
    return result;
}

function repeat(str, times) {
    let result = str;
    for (let i = 0; i < times - 1; i++){
        result += str;
    }
    return result;
}
