
function localStorageAvailable(){
    return (typeof localStorage !== 'undefined');
}

function readLocalStorage(){
    if (localStorageAvailable()){
        document.getElementById("host").value = localStorage.getItem("host");
        document.getElementById("porta").value = localStorage.getItem("porta");
        document.getElementById("usuario").value = localStorage.getItem("usuario");
        document.getElementById("senha").value = localStorage.getItem("senha");
    }
}

function writeLocalStorage(key, value){
    if (localStorageAvailable()){
        localStorage.setItem(key, value);
    }
}