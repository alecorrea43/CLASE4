document.getElementById("usuario").addEventListener("blur", function () {
  var nombreUsuario = this.value;
  var nombreUsuarioError = document.getElementById("nombre-usuario-error");

 
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../backend/usuario_disponible.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var respuesta = xhr.responseText;

       
        if (respuesta === "disponible") {
          nombreUsuarioError.textContent = "Nombre de usuario disponible.";
        } else if (respuesta === "ocupado") {
          nombreUsuarioError.textContent = "Nombre de usuario ya ocupado.";
        }
      }
    }
  };

 
  xhr.send("nombreUsuario=" + encodeURIComponent(nombreUsuario));
});
