const form = document.querySelector("form");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const username = document.querySelector("#name");

form.addEventListener("submit", (e) => {
  e.preventDefault(); // to prevent reloading of the page

  const formData = {
    name: username.value,
    email: email.value,
    password: password.value,
  };

  fetch("http://localhost/LoginAndSignupPHP/server/auth/signup.php", {
    method: "POST",
    body: JSON.stringify(formData),
  })
    .then((res) => res.json())
    .then((json) => {
      if (json.status == 404) {
        alert(json.message);
      } else if (json.status == 500) {
        throw new Error(json.message);
      } else {
        location.href = "../login"; // redirect to login page
      }
    })
    .catch((err) => {
      console.error(err);
    });
});
