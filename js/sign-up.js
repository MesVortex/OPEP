
document.getElementById('next_btn').addEventListener('click',(e) => {
  e.preventDefault();

  function ToSelectRole(){
    console.log("m here");
    window.location.href = "http://localhost/brief6/OPEP/role_selection.php";
    console.log("i have passed");
  }
  
  ToSelectRole();
})