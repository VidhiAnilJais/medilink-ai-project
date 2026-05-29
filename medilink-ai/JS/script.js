/* THEME SYSTEM */

const themeToggle =
document.getElementById("themeToggle");

/* LOAD SAVED THEME */

if(localStorage.getItem("theme") === "light"){

    document.body.classList.add("light-mode");
}

/* TOGGLE */

if(themeToggle){

    themeToggle.addEventListener("click",()=>{

        document.body.classList.toggle("light-mode");

        if(document.body.classList.contains("light-mode")){

            localStorage.setItem("theme","light");
        }

        else{

            localStorage.setItem("theme","dark");
        }
    });
}

