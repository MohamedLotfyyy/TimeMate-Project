const TDLinput = document.querySelector('.todo-input');
const addToListBtn = document.getElementById('btn_id');
const listTasks = document.querySelector('.list-tasks');
const filter = document.querySelector('.filter-todo');
const addtoTT = document.querySelector('.add-to-do-to-timetable');

function setDate(){
    // gets today's date
    var date = new Date();
    var day = date.getDate();
    if (day < 10){day = "0" + day;}
    var month = date.getMonth()+1;
    if (month < 10){month = "0" + month;}
    var year = date.getFullYear();
    var minimumDate = year + "-" + month + "-" + day;
    // sets the date as the minimum date for the deadline
    document.querySelector(".deadline").setAttribute('min', minimumDate);
    d = date.toString().split(" ");
    document.querySelector("#date").innerHTML =`${d[1]} ${d[2]} ${d[3]}`;
    console.log(d);
}

let buttonClicked = false;

// Retrieve existing tasks from storage, if any
let storedTasks = localStorage.getItem('tasks');
if (storedTasks) {
  listTasks.innerHTML = storedTasks;
}

addToListBtn.addEventListener("click",  () =>{
    if(TDLinput.value.trim()!=0){
        // adding the task on screen when user 
        let newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.innerHTML= `
        <p>${TDLinput.value}</p>
        <div class="item-btn">
            <i class="fa-solid fa-pen-to-square"></i>
            <i class="fa-solid fa-xmark"></i>
        </div>
        `
        listTasks.appendChild(newItem);

        // Save tasks to storage
        localStorage.setItem('tasks', listTasks.innerHTML);

        if (addtoTT.value == "add"){
            const deadline = document.querySelector('.deadline').value;
            // Call the PHP file 
        }
    } else {
        alert('Please enter a task');
    }


    
});
listTasks.addEventListener('click', (e)=>{
    if (e.target.classList.contains('fa-xmark')){
        e.target.parentElement.parentElement.remove();
    }
})
listTasks.addEventListener('click', (e)=>{

    if (e.target.classList.contains('fa-pen-to-square')){
        e.target.parentElement.parentElement.classList.toggle('completed');
    }
})


window.onload = function(){
    setDate()
}


