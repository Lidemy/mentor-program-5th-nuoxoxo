// Solve

function multiply(a, b){
  let lena = a.length;
  let lenb = b.length;
  let result = [];
  
  // Prepare a result array of enough ZEROS, all ints
  
  for (let i = 0; i < lena + lenb; i++){
    result.push(0);
  }
  
  // Populate the result array without any carry
  
  let pos, tmp, L, R;
  for (let i = lenb - 1; i >= 0; i--){
    for (let j = lena - 1; j >= 0; j--){
      pos = i + j + 1;
      tmp = Number(b[i]) * Number(a[j]);
      R = tmp % 10
      L = Math.floor(tmp / 10);
      result[pos] += R;
      result[pos - 1] += L;
      pos--;
    }
  }
  
  // Add carries in place
  
  for (let i = result.length - 1; i > 0; i--){
    tmp = result[i];
    R = tmp % 10;
    L = Math.floor(tmp / 10);
    result[i] = R;
    result[i - 1] += L;
  }

  // Corner case: pop the first ZERO if it exists
  
  if (result[0] === 0){
    result.shift();
  }

  // To string

  let str = result.map(String).join('');

  return str;
}


// Drive

console.log(multiply('3','5'));

let a = '98', b = '86';
console.log(multiply(a, b));

a = '986';
b = '865';
console.log(multiply(a, b));

a = '123';
b = '134';
console.log(multiply(a, b));

a = '124902814902890825902840917490127902791247902479027210970941724092174091274902749012740921759037590347438758957283947234273942304239403274093275902375902374092410937290371093719023729103790123';
b = '1239128192048129048129021830918209318239018239018239018249082490182490182903182390128390128903182309812093812093820938190380192381029380192381092380192380123802913810381203';
console.log(multiply(a, b));

