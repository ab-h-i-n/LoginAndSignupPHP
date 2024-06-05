const user = window.localStorage.getItem("user");
const logoutBTN = document.querySelector(".logout");

const getUserDetails = () => {
    fetch("http://localhost/LoginAndSignupPHP/server/user/get-data.php", {
      method: "GET",
      headers: {
        Authorization: user,
      },
    })
      .then((res) => res.json())
      .then((json) => {
        if (json.status == 404) {
          alert(json.message);
        } else if (json.status == 500) {
          throw new Error(json.message);
        } else {
          console.log(json.data);
          document.querySelector(".username").innerHTML = json.data.name;
        }
      })
      .catch((err) => {
        console.error(err);
      });
};


if (!user) {
  window.location.href = "./auth/login";
} else {
  getUserDetails();
}


logoutBTN.addEventListener("click", () => {
  localStorage.removeItem("user");
  location.href = "./auth/login";
});
