let search = document.getElementById('searchInput');
let products = document.getElementById('product_section');


search.addEventListener('keyup', (e) =>{
  let xhttp = new XMLHttpRequest();
  
  xhttp.onreadystatechange = function(){
    if(this.readyState = 4 && this.status == 200){
      products.innerHTML = this.responseText;
    }
  };

  let searchValue = search.value;
  xhttp.open("GET", "./phpScripts/showSearchResult.php?search="+searchValue, true);
  xhttp.send();
})

// ------------------------------------------------------------------------------------

let filter = document.querySelectorAll('filterSwitch');
console.log(filter);

filter.forEach(category => {
  category.addEventListener('click', (e) =>{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
      if(this.readyState = 4 && this.status == 200){
        products.innerHTML = this.responseText;
      }
    };

    let filterValue = category.value;
    xhttp.open("GET", "./phpScripts/showSearchResult.php?filter="+filterValue, true);
    xhttp.send();

  })  
});
