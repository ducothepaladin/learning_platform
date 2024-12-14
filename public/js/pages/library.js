const newForm = document.getElementById("new-form");
const addNewFormBtn = document.getElementById("add-new-form");
const closeNewFormBtn = document.getElementById("close-new-form");



const openForm = () => {
    if(newForm) newForm.classList.toggle("hidden");
}

const closeForm = () => {
    if(newForm) newForm.classList.add("hidden");
}


addNewFormBtn.addEventListener('click' , openForm);
closeNewFormBtn.addEventListener('click' , closeForm);