export function changeRoute(route){
    window.location.href = `http://127.0.0.1:8000/${route}`
}

export function getToken(){
    const url = '/api/v1/users/tokens'; 
    axios.get(url)
        .then(response => {
            // token store sccussfully
        })
        .catch(error => {
            console.error(error);
        });
}