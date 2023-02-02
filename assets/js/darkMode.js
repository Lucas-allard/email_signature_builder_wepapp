window.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;

    // Sélection des éléments de la page à mettre à jour en fonction du thème
    const elements = document.querySelectorAll("body, .bg-light, .bg-dark, .text-light, .text-dark, .btn-light, .btn-dark, .navbar-dark, .navbar-light, .border-light, .border-dark");
    console.log(elements);

    // Mise à jour des éléments en fonction des préférences de thème de l'utilisateur
    if (isDarkMode) {
        elements.forEach(element => {
            element.classList.replace("bg-light", "bg-dark");
            element.classList.replace("text-dark", "text-light");
            element.classList.replace("btn-dark", "btn-light");
            element.classList.replace("navbar-light", "navbar-dark");
            element.classList.replace("border-dark", "border-light");
        });
    } else {
        elements.forEach(element => {
            element.classList.replace("bg-dark", "bg-light");
            element.classList.replace("text-light", "text-dark");
            element.classList.replace("btn-light", "btn-dark");
            element.classList.replace("navbar-dark", "navbar-light");
            element.classList.replace("border-light", "border-dark");
        });
    }
})