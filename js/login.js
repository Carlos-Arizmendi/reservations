document.getElementById('btnLogin').addEventListener('click', event => {
  event.preventDefault();
  const inputCorreo = document.getElementById('inputcorreo');
  const inputPasswords = document.getElementById('inputpasswords');

  if (inputCorreo.value === "" || inputPasswords.value === "") {
    alert("Completa todos los campos");
    return false;
  }

  const obj = {
    action: "login",
    correo: inputCorreo.value,
    passwords: inputPasswords.value
  }

  fetch("../includes/Users.php", {
    method: "POST",
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(obj)
  })
  .then(response => response.json())
  .then(json => {
    if (!json) {
      alert("No se pudo iniciar sesión");
      return false;
    }
    sessionStorage.setItem("users", JSON.stringify(json));
    location.href = "../modules/dashboard/index.php";
  })
  .catch(error => console.error('Error:', error));
});
