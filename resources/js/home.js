console.log("js ok");

document.addEventListener("DOMContentLoaded", () => {
    const title = document.querySelector(".title");
    const bodyText = document.getElementById("body-text");

    // imposta le posizioni iniziali fuori dalla finestra
    title.style.position = "absolute";
    title.style.left = "-100%"; // parte da fuori dello schermo a sinistra
    title.style.opacity = "0";
    title.style.transition = "left 1s ease-out, opacity 1s ease-out";

    bodyText.style.position = "absolute";
    bodyText.style.right = "-100%"; // parte da fuori dello schermo a destra
    bodyText.style.opacity = "0";
    bodyText.style.transition =
        "right 1s ease-out 0.7s, opacity 1s ease-out 0.1s";

    // avvia l'animazione quando la pagina è pronta
    setTimeout(() => {
        title.style.left = "50%"; // centrato
        title.style.transform = "translateX(-50%) translatey(-200%)";
        title.style.opacity = "1";

        bodyText.style.right = "50%"; // centrato
        bodyText.style.transform = "translateX(50%) translatey(-40%)";
        bodyText.style.opacity = "1";
    }, 100);
});
