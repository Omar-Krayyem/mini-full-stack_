document.getElementById("signin_btn").addEventListener('click', getUser);

// Get User
function getUser(e) {
  e.preventDefault();

  const username = document.getElementById("username_signin").value;
  const password = document.getElementById("password_signin").value;

  const checkUser = {
    username: username,
    password: password,
  };

  fetch("http://localhost/minifullstack_backend/signin.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(checkUser),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status == 'loggedin') {
        localStorage.setItem("username", data.username);
        window.location.href = "dashboard.html";
      } else {
        console.log("error");
      }
      console.log(data);
    })
    .catch((error) => console.log(error));
}