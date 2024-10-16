function calculateSum(event){
    event.preventDefault();
    var firstNum = document.getElementById("first_number").value;
    var secondNum = document.getElementById("second_number").value;

    if (firstNum === '' || secondNum === ''){
        document.getElementById('hasil').innerHTML = 'Input tidak boleh kosong!';
        return;
    }
    
    firstNum = parseFloat(firstNum);
    secondNum = parseFloat(secondNum);
    
    if (!isNaN(firstNum) && !isNaN(secondNum)){
        document.getElementById('hasil').innerText = 'Hasil: ' + (firstNum + secondNum);

    } else {
        document.getElementById('hasil').innerHTML = 'Hasil: Input only number!' ;
    }
}

function resetForm(){
    document.getElementById('first_number').value = ''
    document.getElementById('second_number').value = ''
    document.getElementById('hasil').innerText = 'Hasil:'
}