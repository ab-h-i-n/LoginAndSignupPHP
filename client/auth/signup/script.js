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

  fetch("/TodoPHP/server/auth/signup.php", {
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

        alert(json.message + " Redirecting to login page...");

        // redirect to login page
        setTimeout(() => {
          location.href = "../login"; //redirect after 1 second
        }, 1000);

      }
    })
    .catch((err) => {
      console.error(err);
    });
});
