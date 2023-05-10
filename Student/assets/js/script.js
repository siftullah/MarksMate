//Sidebar

let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");


closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  menuBtnChange();//calling the function
});

// following are the code to change sidebar button
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the icons class
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the icons class
  }
}

// for mobile menu

let mobilemenu = document.querySelector(".hamburger");
let mobilemenuclose = document.querySelector(".hamburger-close");

mobilemenu.addEventListener("click", () => {
  mobilemenu.classList.toggle("hamburger");
  mobilemenu.classList.toggle("bi");
  mobilemenu.classList.toggle("bi-x");
  mobilemenu.style.fontSize = '52px';
});


function disablepreloader() {

  for(let i=1; i<=1000000000; i++);  //to make preloader appear properly

  document.getElementById('preloader').style.display = 'none';
  document.getElementById('page-body').style.display = 'block';
};

//random generator for rgb
var randomBetween = (min, max) => min + Math.floor(Math.random() * (max - min + 1));

var temp = document.getElementsByClassName('notifi_count');

if(document.body.contains(temp[0]))
{
  
}
else
{
  var ele = document.getElementsByClassName('notifi_link');
  ele[0].style.marginLeft = "16px";
}