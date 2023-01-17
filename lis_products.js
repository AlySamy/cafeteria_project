async function getAllProducts() {
  let result = await fetch(
    "http://localhost:8080/cafeteria_project/php/list_product.php"
  );
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
  img.src = `./images/products/${obj.product_pic}`;
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
    postDataFprEdit(obj.name, obj.price, obj.category_id, obj.pic);
    window.open("update_product.html", "_self");

    // sendDatatoUpdate(obj.name, obj.price);
    // window.open("update_product.html");
  });

  deleteImg.addEventListener("click", () => {
    deletProduct(obj.id);
  });
}

function createUpdateElement() {
  let updateImg = document.createElement("i");
  updateImg.classList.add("btn");
  updateImg.classList.add("btn-success");
  updateImg.classList.add("fa-solid");
  updateImg.classList.add("fa-pen-to-square");
  return updateImg;
}

function createDeleteElement() {
  let deleteImg = document.createElement("i");
  deleteImg.classList.add("btn");
  deleteImg.classList.add("btn-danger");
  deleteImg.classList.add("fa-solid");
  deleteImg.classList.add("fa-trash");
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
  let result = await fetch(
    "http://localhost:8080/cafeteria_project/php/delete_product.php",
    {
      method: "post",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(product),
    }
  );
  let data = await result.json();
  cheackIFdeletedElement(data);
}

function cheackIFdeletedElement(obj) {
  if (obj.status == "deleted successfully") {
    location.reload();
  }
}

async function postDataFprEdit(name, price, category, pic) {
  let Data = {
    productName: `${name}`,
    productPrice: `${price}`,
    categoryID: `${category}`,
    categorypic: `${pic}`,
  };
  let result = await fetch(
    "http://localhost:8080/cafeteria_project/php/updateProductData.php",

    {
      method: "post",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(Data),
    }
  );
  let data = await result.json();
}
