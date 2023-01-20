async function getUserData() {
  let result = await fetch("./php/chec_session.php");
  let data = await result.jsop();
  manpulateResponse(data);
}
function manpulateResponse(data) {
  data.forEach((obj) => {
    addUserData(obj);
  });
}

function addUserData(obj) {
  let userName = document.getElementById("name");
  userName.innerHTML = obj.name;
  let userPic = document.getElementById("img");
  userPic.src = `${obj.product_pic}`;
}
