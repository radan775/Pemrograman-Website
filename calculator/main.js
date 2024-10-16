let outputscreen = document.getElementById("outputscreen");
const operators = [".","^", "/", "x", "-", "+", "mod"];

function display(num) {
    const lastChar = outputscreen.value.slice(-1);
    if (operators.includes(lastChar) && operators.includes(num)) {
        outputscreen.value = outputscreen.value.slice(0, -1) + num; 

    } else if(outputscreen.value.endsWith("mod") && isNaN(num)){
        outputscreen.value = outputscreen.value.slice(0, -3) + num;

    } else if(outputscreen.value.startsWith("mod") || operators.some(op => outputscreen.value.startsWith(op))){
        outputscreen.value = num;

    } else {
        outputscreen.value += num; 
    }
}

function calculate(){
    let data = outputscreen.value;
    const lastChar = data.slice(-1);
    if (operators.includes(lastChar) || data.endsWith("mod")) {
        outputscreen.value = "";
        return;
    }

    if(data.includes("x")){
        data = data.replace(/x/g, "*");
    }

    if (data.includes("mod")){
        data = data.replace(/mod/g,"%");
    }

    if (data.includes("^")){
        data = data.replace(/\^/g, "**");
    }

    if (data === ''){
        return;
    }

    try{
        outputscreen.value = eval(data);
    } catch (err){
        outputscreen.value = err;
    }
}

function clearOutput(){
    outputscreen.value = "";
}

function del(){
    outputscreen.value = outputscreen.value.slice(0, -1);
}

document.addEventListener("DOMContentLoaded", function() {
    let outputscreen = document.getElementById("outputscreen");
    outputscreen.value = "";
});
