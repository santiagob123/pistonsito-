document.addEventListener("DOMContentLoaded", () => {
  const editButton = document.getElementById("editButton");
  const saveButton = document.getElementById("saveButton");
  const profileFields = document.querySelectorAll(
    "#profileForm input, #profileForm textarea"
  );
  const uploadInput = document.getElementById("upload");
  const profileImg = document.getElementById("profileImg");

  // Habilitar edición
  editButton.addEventListener("click", () => {
    profileFields.forEach((field) => field.removeAttribute("readonly"));
    editButton.classList.add("d-none");
    saveButton.classList.remove("d-none");
    uploadInput.removeAttribute("disabled");
  });

  // Guardar cambios y deshabilitar edición
  saveButton.addEventListener("click", () => {
    profileFields.forEach((field) =>
      field.setAttribute("readonly", "readonly")
    );
    saveButton.classList.add("d-none");
    editButton.classList.remove("d-none");
    uploadInput.setAttribute("disabled", "disabled");
    alert("Cambios guardados exitosamente");
  });

  // Cambiar foto de perfil al hacer clic en la imagen
  profileImg.addEventListener("click", () => {
    uploadInput.click();
  });

  // Actualizar imagen de perfil al seleccionar un archivo
  uploadInput.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        profileImg.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // Cerrar sesión
  document.getElementById("logoutButton").addEventListener("click", () => {
    alert("Sección cerrada exitosamente");
    // Aquí podrías redirigir a la página de login o realizar otra acción
  });

  // Cambiar contraseña
  document
    .getElementById("changePasswordButton")
    .addEventListener("click", () => {
      alert("Redirigiendo a la página de cambio de contraseña");
      // Aquí podrías redirigir a una página específica para cambiar la contraseña
    });
});
