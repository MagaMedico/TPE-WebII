"use strict";

document.addEventListener("DOMContentLoaded", function(){
    
    document.querySelector("#btn_alert").addEventListener("click", function(e){
        e.preventDefault();
        document.querySelector("#alert").classList.add("close");
    });
});