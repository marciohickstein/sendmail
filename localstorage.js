
function storageAvailable(){
    return (typeof localStorage !== 'undefined');
}

function readLocalStorage(){
    if (storageAvailable()){
        var host, porta, usuario, senha;

        host = localStorage.getItem("host");
        porta = localStorage.getItem("porta");
        usuario = localStorage.getItem("usuario");
        senha = localStorage.getItem("senha");
        document.getElementById("host").value = host;
        document.getElementById("porta").value = porta;
        document.getElementById("usuario").value = usuario;
        document.getElementById("senha").value = senha;
    }
}

function writeLocalStorage(key, value){
    if (storageAvailable()){
        localStorage.setItem(key, value);
    }
}