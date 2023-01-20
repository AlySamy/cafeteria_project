async function getUserData() {
  let result = await fetch("./php/chec_session.php");
  let data = await result.json();
  manpulateResponse(data);
}
function manpulateResponse(data) {
  if (data.login == "notValid") {
    window.open("./login page", "_self");
  } else {
    data.forEach((obj) => {
      addUserData(obj);
    });
  }
}

function addUserData(obj) {
  let userName = document.getElementById("name");
  userName.innerHTML = obj.name;
  let userPic = document.getElementById("img");
  userPic.src = `${obj.product_pic}`;
}

let logOutBtn = document.getAnimations("log_out_btn");
logOutBtn.addEventListener("click", () => {
  userLogOut();
});

async function userLogOut() {
  let result = await fetch("./php/log_out.php");
  let data = await result.json();
  manpulateuserData(data);
}

function manpulateuserData(user) {
  if (user.logout == valid) {
    window.open("./login page", "_self");
  }
}
