async function register() {
    let form = document.getElementById("register"),
        formData = new FormData(form);
    const { default: apiFetch } = await import('./js/utils/apiFetch.js');

    await apiFetch('./register', { method: 'POST', body: formData })
        .then(data => console.log(data))
        .catch((error) => {
            console.error(error.data.errors);
            Object.keys(error.data.errors).forEach(err => {
                document.getElementById('error').innerHTML += `<p class="text-red-500 mt-1">${error.data.errors[err]}</p>`;
            });
        });
}