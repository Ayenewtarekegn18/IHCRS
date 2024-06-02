const  registerButton=document.getElementById("register");
const  loginButton=document.getElementById("login");
const  container=document.getElementById("container-acc");
const  sign=document.getElementsByName("signup_btn");
registerButton.addEventListener("click",()=>{
    container.classList.add("right-panel-active");
})
loginButton.addEventListener("click",()=>{
    container.classList.remove("right-panel-active");
}) 
 
sign.addEventListener("click",()=>{
    container.classList.add("right-panel-active");
})