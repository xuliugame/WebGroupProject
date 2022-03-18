
window.onload = function() {
    var form = document.getElementById("form");
    var btn = document.getElementById("sub");
    btn.onclick = function() {
        // debuger to test php validation
        var debuger = false;
        var flag = true;
        // get name value
        var namevalue = document.getElementById("name").value;
        if (namevalue === undefined || namevalue == null || namevalue == "") {
            // didn't input name
            flag = false;
            document.getElementById("wname").style.display = "block";
        } else {
            document.getElementById("wname").style.display = "none";
        }
        // get comment value
        var comment = document.getElementById("comment").value;
        if (comment === undefined || comment == null || comment == "") {
            // didn't input comment
            flag = false;
            document.getElementById("wcoment").style.display = "block";
        } else {
            document.getElementById("wcoment").style.display = "none";
        }
        // submit form
        if (debuger || flag) {
            form.submit();
        }
    }
}








/*for mobile menu*/ 
const showMenu = (toggleId, navId)=>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)
  
    if(toggle && nav){
      toggle.addEventListener('click', ()=>{
        nav.classList.toggle('show')
        toggle.classList.toggle('bx-x')
      })
    }
  }
  showMenu('header-toggle','nav-menu')

  /*menue animetion*/
const navLink = document.querySelectorAll('.nav__link');   

function linkAction(){
 


 /*active link*/
  navLink.forEach(n => n.classList.remove('active'));
  this.classList.add('active');
}
navLink.forEach(n => n.addEventListener('click', linkAction));