const wrapper = document.querySelector(".wrapper");
const snowMan = document.querySelector(".snow-man");
let snowManHeight = 0;

const timeID = setTimeout(function addSnow() {
    const snow = document.createElement("div");
    snow.classList.add("snow");
    
    const snowSize = Math.round(5 + Math.random() * 10);
    snow.style.width = snowSize + "px";
    snow.style.height = snowSize + "px";
    
    snow.style.left = Math.round(Math.random() * 100) + "%";
    snow.style.top = `-${snowSize}px`;

    const fallStyle = `var(--animation-fall-${(Math.round(1 + Math.random() * 3) * 2 + 1)})`;
    const zigZagStyle = `var(--animation-zig-zag-${(Math.round(1 + Math.random() * 3) * 2)})`;

    snow.style.animation = fallStyle + "," + zigZagStyle;

    snow.style.filter = `blur(${2 + Math.round(Math.random() *3)}px)`;

    wrapper.append(snow);
    snowManHeight += snowManHeight < 30 ? 0.1 : 0.2;

    if(snowManHeight <= 220) {
        snowMan.style.height = `${snowManHeight}px`;
        setTimeout(addSnow, 20);
    }

    setTimeout(() => {
        wrapper.removeChild(snow);
    }, 20000);

}, 20);