function test(){
    let errorMessage = document.getElementById("forTest"),
        email = document.getElementById("email"),
        password = document.getElementById("password");

    if(email.value === "" || password.value === ""){
        errorMessage.innerHTML = "email va passwordni toldir";
        errorMessage.style.color = "red";
    }
}