async function getAllCategory() {
  let result = await fetch(
    "http://localhost:8080/php%20cafitiria/php/getAllCategory.php"
  );
  let data = await result.json();

  manpulateResponse(data);
}
getAllCategory();

function manpulateResponse(data) {
  data.forEach((obj) => {
    createNewOption(obj);
  });
}
let select = document.getElementById("category");
function createNewOption(obj) {
  let opteion = document.createElement("option");
  //   let idSpan = document.createElement("span");
  //   idSpan.className = "d-none";
  opteion.innerHTML = obj.name;
  opteion.setAttribute("value", obj.id);
  //   console.log(obj.name);
  //   opteion.innerHTML = obj.id;
  //   opteion.appendChild(idSpan);
  select.appendChild(opteion);
}
