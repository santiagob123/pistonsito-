document.addEventListener("DOMContentLoaded", () => {
  const titulo = document.getElementById("titulo-principal");

  // Aplicar la animación al título
  titulo.style.animation =
    "fadeInOut 5s ease-in-out infinite, colorChange 10s linear infinite";
});
