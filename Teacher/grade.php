<!DOCTYPE html>
<html>
  <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>MarksMate</title>

        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <!--Font Awesome Icons CDN-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!--Charts JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>

        <!--Custom Stylesheet-->
        <link rel="stylesheet" href="./assets/css/grade.css">

    </head>
  <body>

 <!--Desktop Sidebar-->
       <!--Desktop Sidebar-->
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxl-vuejs icon'></i>
                <div class="logo_name">MarksMate</div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav-list">
                <li>
                    <a href="index.html">
                        <i class='bx bx-user'></i>
                        <span class="links_name">Profile</span>
                    </a>
                    <span class="tooltip">Profile</span>
                </li>
                <li>
                    <a href="attendance.html">
                        <i class="bi bi-table"></i>
                        <span class="links_name">Attendance</span>
                    </a>
                    <span class="tooltip">Attendance</span>
                </li>
                <li>
                    <a href="marks.html">
                        <i class='bx bx-clipboard'></i>
                        <span class="links_name">Marks</span>
                    </a>
                    <span class="tooltip">Marks</span>
                </li>
               
                <li>
                    <a href="change-password.html">
                        <i class="bi bi-key"></i>
                        <span class="links_name">Change Password</span>
                    </a>
                    <span class="tooltip">Change Password</span>
                </li>
                <li class="profile">
                    <div class="profile-details">
                        <img src="assets/images/pp.jpg" alt="profileImg">
                        <div class="name_job">
                            <div class="name" id="student-name">Siftullah</div>
                            <div class="rollno" id="student-roll-no">21L-5263</div>
                        </div>
                    </div>
                    <i class='bx bx-log-out' id="log_out" style="cursor: pointer;"></i>
                </li>
            </ul>
        </div>
        <!--Desktop Sidebar End-->

        <!--Mobile Sidebar-->
        <header class="mobile-sidebar mobile-header" style="display: none;">
            <div class="header-name" style="display: flex;/* align-content: stretch; */align-items: center;">
                <i class="bx bxl-vuejs icon" style="font-size: 54px;"></i>
                <div class="logo_name" style="font-size: 28px;font-weight: bolder;">MarksMate</div>
            </div>
            <input type="checkbox" id="nav_check" hidden>
            <nav class="mobile-nav">
                <div class="header-name"
                    style="display: flex;/* align-content: stretch; */align-items: center; margin-top: 15px; padding: 0 8px;">
                    <i class="bx bxl-vuejs icon" style="font-size: 54px;"></i>
                    <div class="logo_name" style="font-size: 28px;font-weight: bolder;">MarksMate</div>
                </div>
                <ul class="mobile-navbar-list">
                    <li>
                        <a href="index.html" class="active"><i class='bx bx-user'></i>&nbsp;<span
                                class="links_name">Profile</span></a>
                    </li>
                    <li>
                        <a href="attendance.html"> <i class="bi bi-table"></i>&nbsp;
                            <span class="links_name">Attendance</span></a>
                    </li>
                    <li>
                        <a href="marks.html"> <i class='bx bx-clipboard'></i>&nbsp;
                            <span class="links_name">Marks</span></a>
                    </li>
                   
                    <li>
                        <a href="change-password.html"> <i class="bi bi-key"></i>&nbsp;
                            <span class="links_name">Change Password</span></a>
                    </li>
                    <li>
                        <a href="index.html"> <i class='bx bx-log-out bx-flip-vertical'></i>&nbsp;
                            <span class="links_name">Sign Out</span></a>
                    </li>
                </ul>
            </nav>
            <label for="nav_check" class="hamburger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </label>
        </header>
        <!--Mobile Sidebar End-->







   <h1>Set Grades</h1>
<form>
  <label for="student_name">Student Name:</label>
  <input type="text" id="student_name" name="student_name" class="input-field"><br><br>
<label for="marks">Marks:</label>
<input type="number" id="marks" name="marks" class="input-field"><br><br>

<button type="button" onclick="calculateGrade()" class="btn-calculate">Calculate Grade</button>

<div id="grade_output" class="output-field"></div>

</form>
<h2>Grade Settings</h2>
<form>
  <label for="A+">A+:</label>
  <input type="number" id="A+" name="A+" value="90" class="input-field"><br><br>
<label for="A">A:</label>
<input type="number" id="A" name="A" value="80" class="input-field"><br><br>

<label for="B">B:</label>
<input type="number" id="B" name="B" value="70" class="input-field"><br><br>

<label for="C">C:</label>
<input type="number" id="C" name="C" value="60" class="input-field"><br><br>

<label for="D">D:</label>
<input type="number" id="D" name="D" value="50" class="input-field"><br><br>

<label for="F">F:</label>
<input type="number" id="F" name="F" value="0" class="input-field"><br><br>

<div class="success_container">
  <div class="success_text">
    <p>Settings have been saved</p>
  </div>
</div>

<button type="button" onclick="saveSettings()" class="btn-save">Save Settings</button>

</form>





<h2>Change Grade</h2>
<form style="margin-bottom: 50px;">
  <label for="student_name2">Student Name:</label>
  <input type="text" id="student_name2" name="student_name2" class="input-field"><br><br>
<label for="new_grade">New Grade:</label>
<select id="new_grade" name="new_grade" class="input-field">
<option value="A+">A+</option>
<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>
<option value="F">F</option>
</select><br><br>

<button type="button" onclick="changeGrade()" class="btn-change">Change Grade</button>

</form>
    
    <script>

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



function calculateGrade() {
  // Get the marks and grade settings values
  const marks = document.getElementById("marks").value;
  const aPlus = document.getElementById("A+").value;
  const a = document.getElementById("A").value;
  const b = document.getElementById("B").value;
  const c = document.getElementById("C").value;
  const d = document.getElementById("D").value;
  const f = document.getElementById("F").value;

  // Calculate the grade based on the marks and grade settings
  let grade;
  if (marks >= aPlus) {
    grade = "A+";
  } else if (marks >= a) {
    grade = "A";
  } else if (marks >= b) {
    grade = "B";
  } else if (marks >= c) {
    grade = "C";
  } else if (marks >= d) {
    grade = "D";
  } else {
    grade = "F";
  }

  let std_name = document.getElementById('student_name').value;


  // Show the grade on the page
  const gradeOutput = document.getElementById("grade_output");
  gradeOutput.innerHTML = `Grade of ${std_name} is ${grade}`;
}





      // Initialize grade settings
      let gradeSettings = {
        "A+": 90,
        "A": 80,
        "B": 70,
        "C": 60,
        "D": 50,
        "F": 0
      };


  const banner  = document.querySelector('.success_container');
  function removeBanner(){

 banner.classList.remove('show');
  }
      
      // Function to save grade settings
      function saveSettings() {
  const gradeSettings = {};
  const gradeInputs = document.querySelectorAll(".grade_input");
  
  gradeInputs.forEach(input => {
    const grade = input.getAttribute("data-grade");
    const marks = parseInt(input.value);
    gradeSettings[grade] = marks;
  });
  
  localStorage.setItem("gradeSettings", JSON.stringify(gradeSettings));
  banner.classList.add('show');
const myTimeout = setTimeout(removeBanner, 2000);

}



  
  // Function to change grade
  function changeGrade() {
    // Get input values
    const studentName = document.getElementById("student_name2").value;
    const newGrade = document.getElementById("new_grade").value;
    
    // Find student's current grade
    let currentGrade = "";
    const gradeOutput = document.getElementById("grade_output");
    for (let i = 0; i < gradeOutput.childNodes.length; i++) {
      const node = gradeOutput.childNodes[i];
      if (node.nodeName === "P") {
        const text = node.textContent;
        const parts = text.split(": ");
        if (parts.length === 2 && parts[0] === studentName + "'s grade is") {
          currentGrade = parts[1];
          break;
        }
      }
    }
    
    // Update grade if student has a current grade
    if (currentGrade !== "") {
      // Calculate marks for new grade
      const newGradeMarks = gradeSettings[newGrade];
      
      // Calculate marks for current grade
      const currentGradeMarks = gradeSettings[currentGrade];
      
      // Get marks input field and set its value to new grade marks
      const marksInput = document.getElementById("marks");
      marksInput.value = newGradeMarks;
      
      // Calculate and display new grade for student
      calculateGrade();
      
      // Reset marks input field to current grade marks
      marksInput.value = currentGradeMarks;
    }
  }














</script>

  </body>
</html>

