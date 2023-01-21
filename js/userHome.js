window.onload = getProducts();
let arr = [];
async function getProducts() {
  fetch("./php/userHome.php", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      arr = data;
      numberOfPages(data);
    });
}

function numberOfPages(data) {
  let x = data.length / 8;
  NumberOfPages = Math.ceil(x);
  for (let i = 1; i < NumberOfPages + 1; i++) {
    let row = `<li class="page-item"><a onclick=page(event) class="page-link">${i}</a></li>`;
    document.getElementById("pagination").innerHTML += row;
  }
}

function page(e) {
  let index = e.target.innerHTML;
  let start = (index - 1) * 8;
  let end = index * 8;
  let numberOfElementsToDelete =
    document.getElementsByClassName("product").length;

  for (let i = 0; i < numberOfElementsToDelete; i++) {
    document.getElementsByClassName("product")[0].remove();
  }

  for (let k = start; k < end; k++) {
    if (k == arr.length) {
      return;
    }

    createProduct(arr[k]);
  }
}

async function search() {
  let element = document.getElementsByName("word")[0];
  let word = element.value;

  let res = await fetch("./php/search.php", {
    method: "POST",
    header: { "Content-Type": "application/json" },
    body: JSON.stringify({ words: word }),
  });
  let data = await res.json();
  displaySearchedData(data);
}

function displaySearchedData(data) {
  document.getElementById("products").style.display = "none";
  document
    .getElementsByClassName("pagination-div")[0]
    .classList.add("hidePagination");
  let numberOfElementsToDelete =
    document.getElementsByClassName("search-product").length;

  for (let i = 0; i < numberOfElementsToDelete; i++) {
    document.getElementsByClassName("search-product")[0].remove();
  }

  for (let k = 0; k < data.length; k++) {
    createSearchProduct(data[k]);
  }

  let input = document.getElementsByName("word")[0].value;

  if (input == "") {
    let numberOfElementsToDelete =
      document.getElementsByClassName("search-product").length;
    for (let i = 0; i < numberOfElementsToDelete; i++) {
      document.getElementsByClassName("search-product")[0].remove();
    }
    document.getElementById("products").style.display = "block";
    document
      .getElementsByClassName("pagination-div")[0]
      .classList.remove("hidePagination");
  }
}

async function getLatestOrder() {
  fetch("./php/getLatestOrder.php")
    .then((response) => response.json())
    .then((data) => {
      lastOrder(data);
    });
}
function lastOrder(data) {
  for (let k = 0; k < data.length; k++) {
    createLatestProduct(data[k]);
  }
}
getLatestOrder();

function createProduct(object) {
  let parent = document.getElementById("row");
  let div1 = document.createElement("div");
  let div2 = document.createElement("div");
  let img = document.createElement("img");
  let div3 = document.createElement("div");
  let h4 = document.createElement("h4");
  let p = document.createElement("p");
  div1.setAttribute("id", "cart-div");
  div1.classList.add("col-md-3", "product", "my-5");
  div2.classList.add("card", "px-3", "border-0");
  div2.style.width = "18rem";
  img.setAttribute("src", object.product_pic);
  img.classList.add("card-img-top", "rounded");
  div3.classList.add("card-body");
  h4.classList.add("card-title");
  h4.innerHTML = object.name;
  p.classList.add("card-text");
  p.innerHTML = object.price;
  div1.appendChild(div2);
  div2.appendChild(img);
  div2.appendChild(div3);
  div3.appendChild(h4);
  div3.appendChild(p);
  parent.appendChild(div1);
  div1.addEventListener("click", () => {
    addToCart(document.getElementById("cart-div"));
  });
}

function createLatestProduct(object) {
  let parent = document.getElementById("row1");
  let div1 = document.createElement("div");
  let div2 = document.createElement("div");
  let img = document.createElement("img");
  let div3 = document.createElement("div");
  let h4 = document.createElement("h4");
  let p = document.createElement("p");
  div1.setAttribute("id", "cart-div");
  div1.classList.add("col-md-3", "my-5");
  div2.classList.add("card", "px-3", "border-0");
  div2.style.width = "18rem";
  img.setAttribute("src", object.product_pic);
  img.classList.add("card-img-top");
  div3.classList.add("card-body");
  h4.classList.add("card-title");
  h4.innerHTML = object.name;
  p.classList.add("card-text");
  p.innerHTML = object.price;
  div1.appendChild(div2);
  div2.appendChild(img);
  div2.appendChild(div3);
  div3.appendChild(h4);
  div3.appendChild(p);
  parent.appendChild(div1);
  div1.addEventListener("click", () => {
    addToCart(document.getElementById("cart-div"));
  });
}

function createSearchProduct(object) {
  let parent = document.getElementById("search");
  let div1 = document.createElement("div");
  let div2 = document.createElement("div");
  let img = document.createElement("img");
  let div3 = document.createElement("div");
  let h4 = document.createElement("h4");
  let p = document.createElement("p");
  div1.setAttribute("id", "cart-div");
  div1.classList.add("col-md-3", "my-5", "search-product");
  div2.classList.add("card", "px-3", "border-0");
  div2.style.width = "18rem";
  img.setAttribute("src", object.product_pic);
  img.classList.add("card-img-top");
  div3.classList.add("card-body");
  h4.classList.add("card-title");
  h4.innerHTML = object.name;
  p.classList.add("card-text");
  p.innerHTML = object.price;
  div1.appendChild(div2);
  div2.appendChild(img);
  div2.appendChild(div3);
  div3.appendChild(h4);
  div3.appendChild(p);
  parent.appendChild(div1);
  div1.addEventListener("click", () => {
    addToCart(document.getElementById("cart-div"));
  });
}

function addToCart(x) {
  console.log(x);
}
