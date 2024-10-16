let inputBox = document.getElementById('input-box');
let listContainer = document.getElementById('list-container');

function addTask(){
    if (inputBox.value === ''){
        return;

    } else {
        let li = document.createElement("li");
        //li.classList.add("checked");
        li.innerHTML = inputBox.value;
        listContainer.appendChild(li);

        let edit = document.createElement('button');
        edit.innerHTML = '✏️';
        edit.classList.add('edit-btn');
        li.appendChild(edit);

        let del = document.createElement('span');
        del.innerHTML = "🗑";
        del.id = 'tong-sampah';
        li.appendChild(del);

        inputBox.value = '';
        saveData();
    }
}

listContainer.addEventListener("click", function(e){
    if(e.target.tagName === "LI"){
        e.target.classList.toggle("checked");
        saveData();
    } else if (e.target.tagName === "SPAN"){
        e.target.parentElement.remove();
        saveData();
    } else if(e.target.classList.contains('edit-btn')) {
        let li = e.target.parentElement;
        inputBox.value = li.firstChild.textContent.trim();
        li.remove();
        saveData();
    }
}, false);

document.addEventListener("DOMContentLoaded", function() {
    let inputBox = document.getElementById('input-box');
    inputBox.value = "";
});

function saveData(){
    localStorage.setItem("data", listContainer.innerHTML);
}

function showTask(){
    listContainer.innerHTML = localStorage.getItem("data");
}
showTask();