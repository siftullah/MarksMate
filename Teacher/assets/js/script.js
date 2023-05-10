let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");


closeBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("open");
  menuBtnChange();//calling the function
});

// following are the code to change sidebar button
function menuBtnChange() {
 if(sidebar.classList.contains("open")){
   closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the icons class
 }else {
   closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the icons class
 }
}

// for mobile menu

let mobilemenu = document.querySelector(".hamburger");
let mobilemenuclose = document.querySelector(".hamburger-close");

mobilemenu.addEventListener("click", ()=>{
  mobilemenu.classList.toggle("hamburger");
  mobilemenu.classList.toggle("bi");
  mobilemenu.classList.toggle("bi-x");
  mobilemenu.style.fontSize = '52px';
});

//Script for Semester GPA Chart

new Chart(document.getElementById("bar-chart"), {
  type: 'bar',
  data: {
  labels: ["Fall 2021", "Spring 2022", "Fall 2022", "Spring 2023"],
  datasets: [
      {
        
      label: "SGPA",
      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
      data: [3.2,2.4,2.8,3.9]
      }
  ]
  },
  options: {
    responsive: true,
  legend: { display: false },
  title: {
      display: true,
      text: 'GPA Earned Per Semester'
  },
  scales: {
    yAxes: [{
        ticks: {
            suggestedMin: 0,
            suggestedMax: 4,
        }
    }]
}
  },
});

new Chart(document.getElementById("bar-chart-mobile"), {
  type: 'bar',
  data: {
  labels: ["Fall 2021", "Spring 2022", "Fall 2022", "Spring 2023"],
  datasets: [
      {
      label: "SGPA",
      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
      data: [3.2,2.4,2.8,3.9]
      }
  ]
  },
  options: {
    responsive: true,
  legend: { display: false },
  title: {
      display: true,
      text: 'GPA Earned Per Semester'
  },
  scales: {
    yAxes: [{
        ticks: {
            suggestedMin: 0,
            suggestedMax: 4,
        }
    }]
}
  },
});

new Chart(document.getElementById("attendance-chart"), {
  type: 'horizontalBar',
  data: {
  labels: ["Operating Systems", "Database Systems", "Design & Analysis of Algorithms", "Probability & Statistics", "Sociology", "Operating Systems Lab", "Database Systems Lab"],
  datasets: [
      {
      label: "Course Lectures Attendance",
      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#a44850","#841309"],
      data: [90,100,86,96,100,88,88]
      }
  ]
  },
  options: {
    responsive: true,
  legend: { display: false },
  title: {
      display: true,
      text: 'Attendance of Current Courses'
  },
  scales: {
    xAxes: [{
        ticks: {
            suggestedMin: 0,
            suggestedMax: 100
        }
    }]
}
  },
});

new Chart(document.getElementById("attendance-chart-mobile"), {
  type: 'horizontalBar',
  data: {
  labels: ["CS2005", "CS2006", "CS2009", "MT4002", "SS2005", "CL2005", "CL2006"],
  datasets: [
      {
      label: "Course Lectures Attendance",
      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#a44850","#841309"],
      data: [90,100,86,96,100,88,88]
      }
  ]
  },
  options: {
    responsive: true,
  legend: { display: false },
  title: {
      display: true,
      text: 'Attendance of Current Courses'
  },
  scales: {
    xAxes: [{
        ticks: {
            suggestedMin: 0,
            suggestedMax: 100,
        }
    }]
}
  },
});