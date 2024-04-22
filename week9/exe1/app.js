const btnLoad = document.querySelector(".btn-load");
const resultTag = document.querySelector(".result");
const profileFrame = document.querySelector(".profile");
profileFrame.innerHTML = "Loading...";

btnLoad.addEventListener("click", () => {
  load(resultTag);
});

async function load(container) {
  const u = "./api/users.php";

  const d = {
    name: "Kane",
  };

  container.textContent = "Loading...";

  fetch(u, {
    method: "POST",
    body: JSON.stringify(d),
  })
    .then((res) => res.json())
    .then((users) => {
      container.textContent = "";

      users.forEach((user, index) => {
        container.innerHTML += "<ul>";
        container.innerHTML += `<li>
            <b onclick="showAge(this, ${index}) && showUser(${index}) ">
                ${user["name"]}
            </b> 
            <i>
            </i>
        </li>`; 
        container.innerHTML += "</ul>";
      });
    })
    .catch((err) => {
      container.textContent = err;
    });
}

async function showAge(container, index) {
  const u = "./api/get_age.php";

  container.nextElementSibling.textContent = `(...)`;

  const d = {
    index: index,
  };

  fetch(u, {
    method: "POST",
    body: JSON.stringify(d),
  })
    .then((res) => res.json())
    .then((age) => {
      container.nextElementSibling.textContent = `(${age})`;
    })
    .catch((err) => {
      container.nextElementSibling.textContent = `(...)`;
    });
}

async function showUser(index) {
  const u = "./api/get_user.php";

  profileFrame.innerHTML = "Loading...";

  const d = {
    index: index,
  };

  fetch(u, {
    method: "POST",
    body: JSON.stringify(d),
  })
    .then((res) => res.json())
    .then((user) => {
      profileFrame.innerHTML = 
      `
      <span><b>Name: </b><i>${user.name}</i></span> 
      <br/>
      <span><b>Age: </b><i>${user.age}</i></span>
      `
      ;
    })
    .catch((err) => {
        profileFrame.innerHTML = "Loading...";
    });
}
