async function getAllProducts() {
  let result = await fetch("./php/list_product.php");
  let data = await result.json();
  manpulateResponse(data);
}
getAllProducts();

function manpulateResponse(data) {
  data.forEach((obj) => {
    createRow(obj);
  });
}

let tableBody = document.querySelector("tbody");
function createRow(obj) {
  let newRow = document.createElement("tr");
  let productName = document.createElement("td");
  let productPrice = document.createElement("td");
  let productImg = document.createElement("td");
  let productStatues = document.createElement("td");
  let events = document.createElement("td");
  let updateImg = createUpdateElement();
  let deleteImg = createDeleteElement();
  let img = document.createElement("img");
  img.src = `${obj.product_pic}`;
  console.log(`${obj.product_pic}`);
  productName.innerHTML = obj.name;
  productPrice.innerHTML = obj.price;
  productStatues.innerHTML = obj.status;
  productImg.appendChild(img);
  events.appendChild(updateImg);
  events.appendChild(deleteImg);
  newRow.appendChild(productName);
  newRow.appendChild(productPrice);
  newRow.appendChild(productImg);
  newRow.appendChild(productStatues);
  newRow.appendChild(events);
  tableBody.appendChild(newRow);

  updateImg.addEventListener("click", () => {
    document.getElementsByName("name")[0].value = obj.name;
    document.getElementsByName("price")[0].value = obj.price;
    document.getElementsByName("status")[0].value = obj.status;
    // document.getElementsByName("img")[0].src = `./images/products/${obj.product_pic}`;
    // console.log((src = `./images/products/${obj.product_pic}`));

    document.getElementsByName("id")[0].value = obj.id;
    // console.log(obj.product_pic);
    getAllCategory();
  });

  deleteImg.addEventListener("click", () => {
    deletProduct(obj.id);
  });
}

function createUpdateElement() {
  let updateImg = document.createElement("i");
  updateImg.classList.add("btn", "editBtn", "mx-2");
  updateImg.innerHTML = "edit";
  updateImg.setAttribute("data-bs-target", "#exampleModal");
  updateImg.setAttribute("data-bs-toggle", "modal");
  return updateImg;
}

function createDeleteElement() {
  let deleteImg = document.createElement("i");
  deleteImg.classList.add("btn", "btn-danger", "mx-2");
  deleteImg.innerHTML = "delete";
  return deleteImg;
}

// async function deletProduct(productName) {
//   console.log("test");
//   let formdata = new FormData();
//   formdata.append("productToDelete", productName);
//   let result = fetch(
//     "http://localhost:8080/cafeteria_project/php/delete_product.php",
//     {
//       method: "post",
//       body: formdata,
//     }
//   );
//   let data = await result.json();
//   console.log(data);
// }

async function deletProduct(productId) {
  let product = {
    productToDelete: `${productId}`,
  };
  let result = await fetch("./php/delete_product.php", {
    method: "post",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(product),
  });
  let data = await result.json();
  cheackIFdeletedElement(data);
}

function cheackIFdeletedElement(obj) {
  if (obj.status == "deleted successfully") {
    location.reload();
  }
}

// async function postDataFprEdit(name, price, category, pic) {
//   let Data = {
//     productName: `${name}`,
//     productPrice: `${price}`,
//     categoryID: `${category}`,
//     categorypic: `${pic}`,
//   };
//   let result = await fetch(
//     "http://localhost:8080/cafeteria_project/php/updateProductData.php",

//     {
//       method: "post",
//       headers: {
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify(Data),
//     }
//   );
//   let data = await result.json();
// }]
// add catagory for edit
let select = document.getElementById("category");
async function getAllCategory() {
  let result = await fetch("./php/getAllCategory.php");
  let data = await result.json();
  console.log(data);
  for (const key in data) {
    let opteion = document.createElement("option");
    console.log(key);
    opteion.innerHTML = data[key].name;
    opteion.setAttribute("value", data[key].id);
    select.appendChild(opteion);
  }
  // manpulateResponse(data);
}
// getAllCategory();

// function manpulateResponse(data) {
//   data.forEach((obj) => {
//     // createNewOption(obj);
//     console.log(obj);
//   });
// }

// let select = document.getElementById("category");
// function createNewOption(obj) {
// let opteion = document.createElement("option");
//   let idSpan = document.createElement("span");
//   idSpan.className = "d-none";
// obj.forEach((ob) => {
// console.log(ob);
// opteion.innerHTML = object.name;
// opteion.setAttribute("value", object.id);
// select.appendChild(opteion);
// });

// console.log(obj[0].name);
//   console.log(obj.name);
//   opteion.innerHTML = obj.id;
//   opteion.appendChild(idSpan);
// }
