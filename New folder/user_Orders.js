            getUserOrders();
            
            
            
            let currentPage = 1;
            let itemsPerPage = 5;
            //users will recive the data from the server
            let users = []; 
            let dataWithImg=[];
            let manyOrders=[];

            //getuserorders () to return promise 
async function getUserOrders()
{
    let res=await fetch("http://localhost/PHP_Project/cafeteria_project/user_Orders.php");
    let data=await res.json();

    users = data;
   
    displayUserOrders();
    
    
    
}

var indexoforder=1;


function displayUserOrders() {

        let startIndex = (currentPage - 1) * itemsPerPage;
        let endIndex = startIndex + itemsPerPage;
        let usersToDisplay = users.slice(startIndex, endIndex);
        let startDate = document.getElementById("start").value + " 00:00:00";
        let endDate = document.getElementById("end").value + " 00:00:00";
        let tableData="";
       
       
       
        usersToDisplay.forEach((user) => {
          // console.log(user);
            if (user.created_at >= startDate && user.created_at <= endDate) {
            
                tableData += userOrderRawData(user);
              createPagination();
            
                
                // document.getElementById
                // createPagination();
                // console.log(user);
                
            }
            
            
        });
       
            document.querySelector("#table-data").innerHTML = tableData;
          
          }
        

    function createPagination() {
        let pagination = document.querySelector(".pagination");
        pagination.innerHTML = "";
        let totalPages = Math.ceil(users.length / itemsPerPage);
        let liPrevious = document.createElement("li");
        liPrevious.classList.add("page-item");
        let aPrevious = document.createElement("a");
        aPrevious.classList.add("page-link");
        aPrevious.textContent = "Previous";
        aPrevious.href = "#";
        aPrevious.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                displayUserOrders();
              
            }
        });
        liPrevious.appendChild(aPrevious);
        pagination.appendChild(liPrevious);

        let liNext = document.createElement("li");
        liNext.classList.add("page-item");
        let aNext = document.createElement("a");
        aNext.classList.add("page-link");
        aNext.textContent = "Next";
        aNext.href = "#";
        aNext.addEventListener("click", (e) => {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                displayUserOrders();
            }
        });
        liNext.appendChild(aNext);
        pagination.appendChild(liNext);

        if(currentPage === 1) {
            liPrevious.classList.add("disabled");
        }
        if(currentPage === totalPages) {
            liNext.classList.add("disabled");
        }
    }


    var userindex=0;
    function userOrderRawData(user) {
        let action = '';
        
        if (user.status == 'Processing') {
            action = `<button class="btn btn-danger">Cancel</button>`
        }
        let str = '<tr id="'+user.id+'" onclick="viewOrders(this.id)"><td>'+user.id+'</td><td>' + user.created_at + ' </td><td>' + user.status + '</td><td>' + user.total_price + '</td><td>' + action + '</td></tr>'
       if(userindex==5){userindex=0} userindex++
        // document.getElementsByTagName("a")[0].id
        return str;
    }

    function onclicksubmit() {
        event.preventDefault();
        // getUserOrders();
        displayUserOrders()
        
    } 



    ///////////////////////////////////////img////////////////////////////////////


    var currentimgPage = 0;
  var imagesPerPage = 3;
  
  
  function previousPage() {
    if (currentPage > 0) {
      currentPage--;
      updatePage();
    }
  }
  
  function nextPage() {
    if (currentimgPage < numPages() - 1) {
      currentPage++;
      updatePage();
    }
  }
  
  function updatePage() {
    var imageContainer = document.getElementById("image-container");
    var images = imageContainer.getElementsByTagName("img");
    for (var i = 0; i < images.length; i++) {
      images[i].style.display = "none";
    }
    var start = currentPage * imagesPerPage;
    var end = start + imagesPerPage;
    for (var i = start; i < end; i++) {
      if (i < images.length) {
        images[i].style.display = "block";
      }
    }
  }
  
  function numPages() {
    var imageContainer = document.getElementById("image-container");
    var images = imageContainer.getElementsByTagName("img");
    return Math.ceil(images.length / imagesPerPage);
  }
  
  //updatePage();

 
  
   ////////////get order details////////////
function displayOrderimg(userId)
{
  

let user={id:userId}
fetch('http://localhost/PHP_Project/cafeteria_project/orderDetails.php', {
    method: 'POST',
    body: JSON.stringify(user),
 
})

.then(response => response.json())
.then(data => {
    console.log(data);
    return data;
   
})
}
//////////////////////////////////////////////////////////////////////

function createUrl(id)

{

}


function displayImg(imageUrl)
{
  var imageContainer = document.getElementById("image-container");
var url = `
<div><img src="./images/misc/

`;
var url2='"3.png" class="col-md-3" style="display: block;"></div>'
var info='<div class="product-info"><p class="product-name">Product Name : '+imageUrl.name+'</p><p class="product-price">Price : '+imageUrl.price+'</p></div>'
imageContainer.innerHTML += (url+imageUrl.product_pic+url2+info);
updatePage();
var np='<ul class="pagination justify-content-center"><li class="page-item"><a  class="page-link" href="#" onclick="previousPage()">Previous</a></li><li class="page-item"><a  class="page-link" href="#" onclick="nextPage() ">Next</a></li></ul>'
document.getElementById("prenext").innerHTML=np;

}


function orderMenu(userorder)
{
    console.log(userorder);
}
///////////////////////viewOrders////////////////////////
function viewOrders(clicked_id)
{
  document.getElementById("image-container").innerHTML="";
  previousPage();
  
  var returnOrderNumber=get_how_many_orders(clicked_id);
  //console.log(returnOrderNumber);
 
  
  for(var i=0;i<=manyOrders.length;i++)
  {
    displayImg(manyOrders[i])

  }




    //console.log("viewOrders");
    // var table = document.getElementById("table-data");
    // var rows = table.getElementsByTagName("tr");
    // for (i = 0; i < rows.length; i++) {
    //     var currentRow = table.rows[i];
    //     var createClickHandler = function (row) {
    //         return function () {
    //             var cell = row.getElementsByTagName("td")[0];
    //             var id = cell.innerHTML;
    //             console.log(id);
    //             // displayImg(id);
    //             // displayImg();
    //         };
    //     };
    //     currentRow.onclick = createClickHandler(currentRow);
    //     var display = displayOrderimg(id);
    //     displayImg(display.product_pic);

    // }
}
////////////////////////////////get_how_many_orders////////////////////////////

async function get_how_many_orders(orderNum)
{
  let user={id:orderNum}
  let fetcH=await fetch('http://localhost/PHP_Project/cafeteria_project/getAllOrder.php', {
    method: 'POST',
    body: JSON.stringify(user),
 
})

let data=await fetcH.json();
manyOrders=data;

// .then(response => response.json())
// .then(data => {
//     console.log(data);
//     return data;
   
// })

}
