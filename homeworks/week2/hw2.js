function capitalize(str) {
    if (str[0].match(/[a-z]/i)){
        var str = str[0].toUpperCase() + str.slice(1);
    }
    return str;
}

