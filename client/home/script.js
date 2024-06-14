const user = window.localStorage.getItem("user");
const logoutBTN = document.querySelector(".logout");
const addTaskBTN = document.querySelector(".add-task");

const getUserDetails = () => {
  fetch("http://localhost/TodoPHP/server/user/get-data.php", {
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
        document.querySelector(".useremail").innerHTML = json.data.email;
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Something went wrong!");
    });
};

const getTasks = () => {
  fetch("http://localhost/TodoPHP/server/task/get.php", {
    method: "GET",
    headers: {
      Authorization: user,
    },
  })
    .then((res) => res.json())
    .then((json) => {
      if (json.status == 404) {
        const tasks = document.querySelector("main");
        const noTasks = document.createElement("div");
        noTasks.innerHTML = `<div class="no-tasks">Add tasks!</div>`;
        tasks.appendChild(noTasks);
      } else if (json.status == 500) {
        throw new Error(json.message);
      } else {
        console.log("data", json.data);
        const tasks = document.querySelector(".task-container");
        json.data.forEach((task) => {
          const taskDiv = document.createElement("div");
          taskDiv.classList.add("task");
          taskDiv.id = task.id;
          taskDiv.innerHTML = `
            <span class="task-title">${task.title}</span>
          <p class="task-desc">${task.description}</p>`;
          tasks.appendChild(taskDiv);
        });
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Something went wrong!");
    });
};

if (!user) {
  window.location.href = "../auth/login";
} else {
  getUserDetails();
  getTasks();
}

logoutBTN.addEventListener("click", () => {
  localStorage.removeItem("user");
  location.href = "../auth/login";
});

const addTask = () => {
  const task = document.querySelector(".task-input").value;
  const taskTitle = document.querySelector(".task-title").value;

  if (!task || !taskTitle) {
    alert("Please enter a task and its title!");
    return;
  }

  const tasks = {
    title: taskTitle,
    user_id: user,
    desc: task,
  };

  console.log(tasks);

  fetch("http://localhost/TodoPHP/server/task/add.php", {
    method: "POST",
    body: JSON.stringify(tasks),
  })
    .then((res) => res.json())
    .then((json) => {
      console.log("json", json);
      if (json.status == 404) {
        alert(json.message);
      } else if (json.status == 500) {
        throw new Error(json.message);
      } else {
        alert(json.message);
        location.reload();
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Something went wrong!");
    });
};

addTaskBTN.addEventListener("click", () => {
  addTask();
});
