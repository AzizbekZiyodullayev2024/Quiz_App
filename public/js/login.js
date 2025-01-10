async function login(){

    let form = document.getElementById("login"),
        formData = new FormData(form);
    const {default: apiFetch} = await import('./js/utils/apiFetch.js');

    await apiFetch('./login',{method:'POST',body:formData})
        .then(data => console.log(data))
            .catch((error) => {
                console.error(error.data.errors)
                Object.keys(error.data.errors).forEach(err => {
                    document.getElementById('error').innerHTML += `<p class="text-red-500 mt-1" >${error.data.errors[err]}</p>`;
                })
    })

    //AJAX

    // const xhr = new XMLHttpRequest();
    // xhr.open("POST","http://localhost:8080/api/login",true);
    // xhr.onload = function () {
    //     if(xhr.status === 200){
    //         const data = JSON.parse(xhr.responseText);
    //         console.log(data)
    //     } else{
    //         console.error(xhr.statusText)
    //     }
    // }
    // xhr.onerror = function () {
    // }
    // xhr.send(formData)

    // Fetch

    // fetch('http://localhost:8080/api/login',{method:'POST'})
    //     .then(function (response) {
    //         if(response.ok){
    //             return response.json()
    //         }
    //         return Promise.reject(response)
    //     })
    //     .then(function (data) {
    //         localStorage.setItem('token',data.token);
    //         console.log(localStorage.getItem('token'));
    //     })
    //     .catch(function(error){
    //         console.error(error)
    //     })
}
