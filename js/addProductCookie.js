let cookies = document.cookie.split("=");
let errors = Cookies.get("errors");
console.log(errors);
if (errors) {
  errors = JSON.parse(errors);
  insertErrorMessages(errors);
}

function insertErrorMessages(ob) {
  for (const key in ob) {
    let input = document.querySelector(`input[name=${key}`);
    let error = input.nextElementSibling;
    error.textContent = errors[key];
    input.nextElementSibling.classList.add("active");
  }
}
// errors = JSON.parse(errors);
// let decodedCookie = decodeURIComponent(errors);
// console.log(decodedCookie.split(";"));
// let cookies = document.cookie.split("=");

// console.log(cookies);

//***********************for massages errors */
// var errors = Cookies.get("errors");
// console.log(errors);

// if (errors) {
//   errors = JSON.parse(errors);
//   insertErrorMessages(errors);
// console.log(errors);
// }
// function insertErrorMessages(ob) {
//   for (const key in ob) {
//     let input = document.querySelector(`input[name=${key}]`);
//     // console.log(ob[key]);
//     let error = input.nextElementSibling;
//     error.textContent = ob[key];
//     error.classList.add("active");
//   }
// }

//******************** frr massages success register*/
// let cookiesuccess = document.cookie;
// var success = Cookies.get("success");
// console.log(success);
// if (success) {
//   success = JSON.parse(success);
//   console.log(success);
//   insertSuccessMessages(success);
// }
// function insertSuccessMessages(obj) {
//   for (const key in obj) {
//     let div = document.querySelector(`div[name=${key}]`);
//     console.log(div);
//     div.innerHTML = obj[key];
//     div.classList.add("active");
//   }
// }
