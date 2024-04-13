const lightContainer = document.querySelector(".lights");

const timeId = setTimeout( function upLight() {

    const light = document.createElement("div");
    light.classList.add("light");


    light.style.left = ` calc(${Math.round(Math.random() * 100)}% - 200px)`;

    lightContainer.appendChild( light );

    setTimeout(upLight, 500);

    setTimeout(() => {
        lightContainer.removeChild(light);
    }, 3000);
    
}, 500);