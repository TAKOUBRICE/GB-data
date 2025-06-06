const pswrdfield = document.querySelector("form input[type='password']"),
    togglebtn = document.querySelector("form #Check ");

togglebtn.onclick = () => {
    if (pswrdfield.type == "password") {
        pswrdfield.type = "text";
        togglebtn.classList.add("active");
    } else {
        pswrdfield.type = "password";
        togglebtn.classList.remove("active");
    }
};
