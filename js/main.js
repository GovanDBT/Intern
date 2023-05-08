let form = document.querySelector(".form");
let formHeader = form.querySelector(".form-btn");
let formHeaderElement = form.querySelectorAll(".form-btn > div");
let formBody = form.querySelector(".form-body");
let formBodyElement = form.querySelectorAll(".form-body > div");

for(let i=0;i<formHeaderElement.length;i++) {
    formHeaderElement[i].addEventListener("click",function(){
        formHeader.querySelector(".active").classList.remove("active");
        formHeaderElement[i].classList.add("active");
        formBody.querySelector(".active").classList.remove("active");
        formBodyElement[i].classList.add("active");
    });
}