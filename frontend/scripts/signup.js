document.getElementById("signup_btn").addEventListener('click', createUser);

// Create User
function createUser(e) {
    e.preventDefault()
  
    const username = document.getElementById("username_signup").value;
    const password = document.getElementById("password_signup").value;
    const first_name = document.getElementById("first_name").value;
    const last_name = document.getElementById("last_name").value;
  
    const newUser = {
      username : username,
      password: password,
      first_name: first_name,
      last_name: last_name
    }
  
    fetch("http://localhost/minifullstack_backend/signup.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(newUser)
    })
      .then(response => response.json())
      .then(data => {
        if(data.status === "failed"){
          console.log("error")
        }
        else{
          console.log(data)
          localStorage.setItem("username", data.username);
          window.location.href = "dashboard.html"
        }
        
      })
      .catch(error => console.log(error))
  }