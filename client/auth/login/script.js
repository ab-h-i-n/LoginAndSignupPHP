const form = document.querySelector("form");
const email = document.querySelector("#email");
const password = document.querySelector("#password");

form.addEventListener("submit", (e) => {
  e.preventDefault(); // to prevent reloading of the page

  const formData = {
    email: email.value,
    password: password.value,
  };

  fetch("/TodoPHP/server/auth/login.php", {
    method: "POST",
    body: JSON.stringify(formData),
  })
    .then((res) => res.json())
    .then((json) => {
      console.log(json);
      if (json.status == 404) {
        alert(json.message);
      } else if (json.status == 500) {
        throw new Error(json.message);
      } else {
        localStorage.setItem("user", json.data.id);
        location.href = "../../home/"; // home page
      }
    })
    .catch((err) => {
      console.error(err);
    });
});
