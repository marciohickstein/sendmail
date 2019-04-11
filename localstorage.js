function localStorageAvailable(){
    return (typeof localStorage !== 'undefined');
}

function writeLocalStorage(key, value){
    if (localStorageAvailable()){
        localStorage.setItem(key, value);
    }
}        
