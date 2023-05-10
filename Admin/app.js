const express = require("express");
const session = require("express-session");
const bodyParser = require("body-parser");
const ejs = require("ejs");
const _ = require("lodash")
const cors = require('cors')
const sql = require('mssql')
const generator = require('generate-password');
const path = require("path");
const passport = require("passport")

var config = require('./dbconfig')
var router = express.Router();
const app = express();

/*****************************Global Variables*************************************** */
let transaction
let login = []
let CAMPUSID = []
let CAMPUSNAME = []

/*******************************Edit Information************************************** */

/*******************Students****************** */
let name1,dob1,phone1,cnic1,blood1,address1,religion1,email1
let gName1,gPhone1,gRelation1,gCnic1,gEmail1

/*******************Teachers****************** */
let id1,name2,dob2,phone2,cnic2,address2,email2

/*******************Course********************** */
let code1,courseName1,creditHours1

/*******************Departments********************** */

let deptID1,deptName1,deptAbbr1

/*******************Degree********************** */
let degID1,degName1,degAbbr1

/*****************TimeTable***************************** */

let timeID1,startTime1,endTime1

/*********************Batch******** */

let batchID1,batchYear1

/***********************Classroom ***********/

let classID1,roomNo1

/*****************Semester************************** */

let semID1,semYear1,crdLimit1

/*********************Registration************************** */

let regID1,sectionName1,totalSeats1,availableSeats1

/********************************app.use******************************************** */

app.set('view engine', 'ejs');
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use('/public', express.static('public'));
app.use(cors())
app.use('/app',router)

router.use((req,res,next)=>{
  console.log('middleware')
  next()
})

// app.use(session({
//   secret: 'keyboard cat',
//   resave: false,
//   saveUninitialized: false
// }));

// app.use(passport.initialize());
// app.use(passport.session());

/**************************General Requests********************************** */

app.route("/")
.get(function(req,res)
{
  try
  {
    res.render("login")
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{user,password} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const result = await request
      .input("user",sql.VarChar,user)
      .input("password",sql.VarChar,password)
      .execute("GetAdminLoginInfo");


    if (result.recordset.length === 0) 
    {
      res.redirect("/")
    }
    else
    {
      login = user
      const pool1 = await sql.connect(config);
      const request1 = new sql.Request(pool1);
      const posts1 = await request1
        .input("user",sql.VarChar,login)
        .execute("GetAdminInfo");

      CAMPUSNAME = posts1.recordset[0].campus_name
      CAMPUSID = posts1.recordset[0].id

      res.redirect("/dashboard")
    }
  }
  catch(error)
  {
    console.log(error)
  }

});

app.route("/profile")
.get(async function(req,res)
{ 
  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
      .input("user",sql.VarChar,login)
      .execute("GetAdminInfo");

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
      .input("user_id",sql.VarChar,login)
      .execute("GetAdminPersonalInfo");

    const pool2 = await sql.connect(config);
    const request2 = new sql.Request(pool2);
    const posts2 = await request2
      .input("user_ID",sql.VarChar,login)
      .execute("GetAdminAge");


    res.render("profile",{
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }

});

app.route("/dashboard")
.get(async function(req,res)
{ 
  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusName",sql.VarChar,CAMPUSNAME)
    .execute("StudentCount")

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
      .input("user",sql.VarChar,login)
      .execute("GetAdminInfo");

    const pool2 = await sql.connect(config);
    const request2 = new sql.Request(pool2);
    const posts2 = await request2
      .input("user_id",sql.VarChar,login)
      .execute("GetAdminPersonalInfo");

    const pool3 = await sql.connect(config);
    const request3 = new sql.Request(pool3);
    const posts3 = await request3
      .input("user_ID",sql.VarChar,login)
      .execute("GetAdminAge");

    const pool4 = await sql.connect(config);
    const request4 = new sql.Request(pool4);
    const posts4 = await request4
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_notification_count_info")

    const pool5 = await sql.connect(config);
    const request5 = new sql.Request(pool5);
    const posts5 = await request5
    .input("campusName",sql.VarChar,CAMPUSNAME)
    .execute("GetMaleStudents")

    const pool6 = await sql.connect(config);
    const request6 = new sql.Request(pool6);
    const posts6 = await request6
    .input("campusName",sql.VarChar,CAMPUSNAME)
    .execute("GetFemaleStudents")

    const pool7 = await sql.connect(config);
    const request7 = new sql.Request(pool7);
    const posts7 = await request7
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_notification_info")

    const pool8 = await sql.connect(config);
    const request8 = new sql.Request(pool8);
    const posts8 = await request8
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_info")

    const pool9 = await sql.connect(config);
    const request9 = new sql.Request(pool9);
    const posts9 = await request9
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_notification_rollNo_info")

    const pool10 = await sql.connect(config);
    const request10 = new sql.Request(pool10);
    const posts10 = await request10
    .input("campusId",sql.Int,CAMPUSID)
    .execute("get_teacher_count_info")

    res.render("index",{
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset,
      data3:posts3.recordset,
      data4:posts4.recordset,
      data5:posts5.recordset,
      data6:posts6.recordset,
      data7:posts7.recordset,
      data8:posts8.recordset,
      data9:posts9.recordset,
      data10:posts10.recordset

    })
  }
  catch(error)
  {
    console.log(error)
  }

});

app.route("/teachers")
.get(async function(req,res)
{
  try
  {
      let pool = await sql.connect(config)
      const posts = await pool.request()
      .input("campusID",sql.Int,CAMPUSID)
      .execute("get_teacher_info")
      

    console.log(posts)

    res.render("teachers",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {teacherID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      
      const request = new sql.Request();

      await request
        .input("teacherID",sql.Char,teacherID)
        .input("campusID",sql.Int,CAMPUSID)
        .execute("delete_teacher")

      res.redirect("/teachers")

    }
    catch(error)
    {
      console.log(error)
    }
});


app.route("/students")
.get(async function(req,res)
{
  try{
      let pool = await sql.connect(config)
      const posts = await pool.request()
      .input("campusID",sql.Int,CAMPUSID)
      .execute("student_info")

      let pool1 = await sql.connect(config)
      const posts1 = await pool1.request()
      .input("campusID",sql.Int,CAMPUSID)
      .execute("get_student_roll_info")

      res.render("students",{
        data:posts.recordset,
        data1:posts1.recordset
      })
    }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  const {rollNo} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      
      const request = new sql.Request();

      await request
        .input("rollNo",sql.Char,rollNo)
        .input("campusID",sql.Int,CAMPUSID)
        .execute("delete_student")

      res.redirect("/students")

    }
    catch(error)
    {
      console.log(error)
    }
});


app.route("/notification")
.get(async function(req,res)
{
  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_notification_info")


    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_info")

    
    const pool2 = await sql.connect(config);
    const request2 = new sql.Request(pool2);
    const posts2 = await request2
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_notification_rollNo_info")


    res.render("notification",
    {
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {title} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      
      const request = new sql.Request();

      await request
        .input("notification_title",sql.VarChar,title)
        .execute("delete_student_notification")

      res.redirect("/notification")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/courses")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .query("SELECT * FROM Course")
    res.render("courses",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {courseCode} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("course_code",sql.Char,courseCode)
        .execute("DeleteCourse")

      res.redirect("/courses")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/departments")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .query("SELECT * FROM Department")
    res.render("departments",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {departmentID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,departmentID)
        .execute("delete_department")

      res.redirect("/departments")

    }
    catch(error)
    {
      console.log(error)
    }
});


app.route("/degrees")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .query("SELECT * FROM Degree")
    res.render("degrees",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {degID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,degID)
        .execute("DeleteDegree")

      res.redirect("/degrees")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/timetable")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowTimeTable")

    res.render("timetable",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {timeID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,timeID)
        .execute("deleteTimetableRow")

      res.redirect("/timetable")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/batch")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowBatch")

    res.render("batch",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {batchID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,batchID)
        .execute("DeleteBatch")

      res.redirect("/batch")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/classroom")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowClassroom")

    res.render("classroom",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {classID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,classID)
        .execute("DeleteClassroom")

      res.redirect("/classroom")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/semester")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("select_by_campus_id")

    res.render("semester",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {semID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,semID)
        .execute("DeleteSemesterList")

      res.redirect("/semester")

    }
    catch(error)
    {
      console.log(error)
    }
});

app.route("/register")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("ShowCS")

    res.render("register",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const {regID} = req.body;

  try 
    {
      const pool = await sql.connect(config);
      const request = new sql.Request(pool);

      await request
        .input("id",sql.Int,regID)
        .execute("deleteCourseSection")

      res.redirect("/register")

    }
    catch(error)
    {
      console.log(error)
    }
});


/********************************************Specific Requests************************************************** */

/***************************Teachers************************** */
app.route("/teachers/addteacher")
.get(async function(req,res)
{
  try
  {
    res.render("addteacher")
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  const {Name,gender,dob,phone,address,cnic,email} = req.body

  let id;
  let isUnique = false;

  let randomPassword;

  const password = generator.generate({
    length: 10,
    numbers: true
  });

  while (!isUnique) 
  {
    const randomNumber = Math.floor(Math.random() * 9000) + 1000;
    
    id = "TL-" + randomNumber.toString();

    randomPassword = password;

    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const result = await request
      .input('id', sql.Char, id)
      .query('SELECT * FROM teacher_login_info WHERE teacher_id = @id');

    if (result.recordset.length === 0) {
      isUnique = true;
    }
  }
    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('teacher_id', sql.Char, id)
          .input('teacher_password', sql.VarChar, randomPassword)
          .input('campus', sql.Int, CAMPUSID)
          .input('Teacher_Name', sql.VarChar, Name)
          .input('teacher_gender', sql.VarChar, gender)
          .input('teacher__dob', sql.Date, dob)
          .input('teacher_mobileNo', sql.Char, phone)
          .input('cnic', sql.Char, cnic)
          .input('teacher_email', sql.VarChar, email)
          .input('teacher_Address', sql.VarChar, address)
          .execute('InsertTeacherInfo')

        await transaction.commit();

        res.redirect("/teachers")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});

app.route("/teachers/teacherinfo")
.get(async function (req,res)
{
  try{

    let teacherID = req.query.teacherID
    
    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("teacherID",sql.Char,teacherID)
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_teacher_specific_info")

    res.render("teacherinfo",
    {
      data:posts.recordset
    })

  }
  catch(error)
  {
      console.log(error)
  }
});

app.route("/teachers/editteacher")
.get(async function(req,res)
{
  try
  {
    id1 = req.query.teacherID

    console.log(id1)

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("teacherId",sql.Char,id1)
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_teacher_specific_info")

    console.log(posts)

    name2 = posts.recordset[0].Teacher_Name
    dob2 = posts.recordset[0].teacher__dob
    phone2 = posts.recordset[0].teacher_mobileNo
    cnic2 = posts.recordset[0].cnic
    address2 = posts.recordset[0].teacher_Address
    email2 = posts.recordset[0].teacher_email

    res.render("editteacher")
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
    let {Name,gender,dob,phone,address,cnic,email} = req.body

    console.log(Name.length)
    console.log(name2.length)


    if (Name.length === 0 && name2.length !== 0) {
      Name = name2;
    } else if (Name.length !== 0 && name2.length === 0) {
        Name = Name;
    } else if (Name.length !== 0 && name2.length !== 0) {
        Name = Name;
    } else {
        Name = "";
    }

    if (dob.length === 0 && dob2.length !== 0) {
      dob = dob2;
      console.log("1st")
  } else if (dob.length !== 0 && dob2.length === 0) {
      dob = dob;
      console.log("2nd")
  } else if (dob.length !== 0 && dob2.length !== 0) {
      dob = dob;
      console.log(typeof dob)
      console.log("3rd")
  } else {
      dob = "";
      console.log("4th")
  }

    if (phone.length === 0 && phone2.length !== 0) {
        phone = phone2;
        console.log("1")
    } else if (phone.length !== 0 && phone2.length === 0) {
        phone = phone;
        console.log("2")

    } else if (phone.length !== 0 && phone2.length !== 0) {
        phone = phone;
        console.log("3")

    } else {
        phone = "";
        console.log("4")

    }
  
  if (address.length === 0 && address2.length !== 0) {
      address = address2;
  } else if (address.length !== 0 && address2.length === 0) {
      address = address;
  } else if (address.length !== 0 && address2.length !== 0) {
      address = address;
  } else {
      address = "";
  }
  
  if (cnic.length === 0 && cnic2.length !== 0) {
      cnic = cnic2;
  } else if (cnic.length !== 0 && cnic2.length === 0) {
      cnic = cnic;
  } else if (cnic.length !== 0 && cnic2.length !==0) {
      cnic = cnic;
  } else {
      cnic = ""
  }

  
  if(email.length===0&&email2.length!==0){
    email=email2
  }else if(email.length!==0&&email2.length===0){
    email=email
  }else if(email.length!==0&&email2.length!==0){
    email=email
  }else{
    email=""
  }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('teacher_id', sql.Char, id1)
          .input('Teacher_Name', sql.VarChar, Name)
          .input('teacher_gender', sql.VarChar, gender)
          .input('teacher__dob', sql.Date, dob)
          .input('teacher_mobileNo', sql.Char, phone)
          .input('cnic', sql.Char, cnic)
          .input('teacher_email', sql.VarChar, email)
          .input('teacher_Address', sql.VarChar, address)
          .execute('UpdateTeacherInfo')

        await transaction.commit();

        res.redirect("/teachers")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});


/***************************Students************************** */

app.route("/students/addstudent")
.get(async function(req,res)
{
  try{
    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("batch_view_student")

    let pool1 = await sql.connect(config)
    const posts1 = await pool1.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("dept_view_student")

    let pool2 = await sql.connect(config)
    const posts2 = await pool2.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("deg_id_view_student")

    let pool3 = await sql.connect(config)
    const posts3 = await pool3.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("batch_id_view_student")

    res.render("addstudent",{
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset,
      data3:posts3.recordset
    })
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  const {Name,gender,dob,phone,address,cnic,bloodGroup,religion,email,
    guardianName,guardianGender,guardianrelation,guardianCNIC,guardianPhone,guardianEmail,
    batchId,degreeId,batchYear,
    enrollmentStatus} = req.body

  let roll;
  let isUnique = false;

  let randomPassword;

  const password = generator.generate({
    length: 10,
    numbers: true
  });

  while (!isUnique) 
  {
    const randomNumber = Math.floor(Math.random() * 9000) + 1000;
    
    roll = (req.body.batchYear.slice(2, 4)).toString() + "L-" + randomNumber.toString();

    randomPassword = password;

    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const result = await request
      .input('roll', sql.Char, roll)
      .query('SELECT * FROM student_login_info WHERE rollNo = @roll');

    if (result.recordset.length === 0) {
      isUnique = true;
    }
  }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('Name', sql.VarChar, Name)
          .input('gender', sql.VarChar, gender)
          .input('dob', sql.Date, dob)
          .input('phone', sql.Char, phone)
          .input('cnic', sql.Char, cnic)
          .input('bloodGroup', sql.VarChar, bloodGroup)
          .input('religion', sql.VarChar, religion)
          .input('email', sql.VarChar, email)
          .input('guardianName', sql.VarChar, guardianName)
          .input('guardianGender', sql.VarChar, guardianGender)
          .input('guardianrelation', sql.VarChar, guardianrelation)
          .input('guardianCNIC', sql.Char, guardianCNIC)
          .input('guardianPhone', sql.VarChar, guardianPhone)
          .input('guardianEmail', sql.VarChar, guardianEmail)
          .input('address', sql.VarChar, address)
          .input('batchId', sql.Int, batchId)
          .input('degreeId', sql.Int, degreeId)
          .input('roll', sql.Char, roll)
          .input('password', sql.VarChar, randomPassword)
          .input('enrollmentStatus', sql.VarChar, enrollmentStatus)
          .execute('InsertStudentInfo')

        await transaction.commit();

        res.redirect("/students")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});


app.route("/students/studentinfo")
.get(async function (req,res)
{
  try{

    let rollNo = req.query.rollNo
    
    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("rollNo",sql.Char,rollNo)
    .execute("GetStudentInfo")

    let pool1 = await sql.connect(config)
    const posts1 = await pool1.request()
    .input("rollNo",sql.Char,rollNo)
    .execute("GetSpecificPersonalInfo")

    let pool2 = await sql.connect(config)
    const posts2 = await pool2.request()
    .input("rollNo",sql.Char,rollNo)
    .execute("GetSpecificStudentDepartmentInfo")

    res.render("studentinfo",
    {
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset,
    })

  }
  catch(error)
  {
      console.log(error)
  }
});

app.route("/students/editstudent")
.get(async function(req,res)
{
  try
  {
    roll1 = req.query.rollNo

    console.log(roll1)

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("batch_view_student")


    let pool2 = await sql.connect(config)
    const posts2 = await pool2.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("deg_id_view_student")

    let pool3 = await sql.connect(config)
    const posts3 = await pool3.request()
    .input("campusID",sql.Int,CAMPUSID)
    .execute("batch_id_view_student")

    let pool4 = await sql.connect(config)
    const posts4 = await pool4.request()
    .input("rollNo",sql.Char,roll1)
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_specific_info")

    name1 = posts4.recordset[0].studentName
    dob1 = posts4.recordset[0].student_dob
    phone1 = posts4.recordset[0].mobileNo
    cnic1 = posts4.recordset[0].cnic
    blood1 = posts4.recordset[0].bloodGroup
    address1 = posts4.recordset[0].studentAddress
    religion1 = posts4.recordset[0].religion
    email1 = posts4.recordset[0].email

    gName1 = posts4.recordset[0].guardianName
    gPhone1 = posts4.recordset[0].guardian_mobileNo
    gRelation1 = posts4.recordset[0].guardian_relation
    gCnic1 = posts4.recordset[0].guardian_cnic
    gEmail1 = posts4.recordset[0].guardian_email


    res.render("editstudent",{
      data:posts.recordset,
      data2:posts2.recordset,
      data3:posts3.recordset
    })
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  var {Name,dob,gender,phone,address,cnic,bloodGroup,religion,email,
    guardianName,guardianGender,guardianrelation,guardianCNIC,guardianPhone,guardianEmail,
    batchId,degreeId,
    enrollmentStatus} = req.body

    console.log(Name.length)
    console.log(name1.length)

    if (Name.length === 0 && name1.length !== 0) {
      Name = name1;
    } else if (Name.length !== 0 && name1.length === 0) {
        Name = Name;
    } else if (Name.length !== 0 && name1.length !== 0) {
        Name = Name;
    } else {
        Name = "";
    }

    if (dob.length === 0 && dob1.length !== 0) {
      dob = dob1;
      console.log("1st")
  } else if (dob.length !== 0 && dob1.length === 0) {
      dob = dob;
      console.log("2nd")
  } else if (dob.length !== 0 && dob1.length !== 0) {
      dob = dob;
      console.log(typeof dob)
      console.log("3rd")
  } else {
      dob = "";
      console.log("4th")
  }

    if (phone.length === 0 && phone1.length !== 0) {
        phone = phone1;
        console.log("1")
    } else if (phone.length !== 0 && phone1.length === 0) {
        phone = phone;
        console.log("2")

    } else if (phone.length !== 0 && phone1.length !== 0) {
        phone = phone;
        console.log("3")

    } else {
        phone = "";
        console.log("4")

    }
  
  if (address.length === 0 && address1.length !== 0) {
      address = address1;
  } else if (address.length !== 0 && address1.length === 0) {
      address = address;
  } else if (address.length !== 0 && address1.length !== 0) {
      address = address;
  } else {
      address = "";
  }
  
  if (cnic.length === 0 && cnic1.length !== 0) {
      cnic = cnic1;
  } else if (cnic.length !== 0 && cnic1.length === 0) {
      cnic = cnic;
  } else if (cnic.length !== 0 && cnic1.length !==0) {
      cnic = cnic;
  } else {
      cnic = ""
  }
  
  if (bloodGroup.length ===0&& blood1.length!==0){
    bloodGroup=blood1
  }else if(bloodGroup.length!==0&&blood1.length===0){
    bloodGroup=bloodGroup
  }else if(bloodGroup.length!==0&&blood1.length!==0){
    bloodGroup=bloodGroup
  }else{
    bloodGroup=""
  }
  
  if(religion.length===0&&religion1.length!==0){
    religion=religion1
  }else if(religion.length!==0&&religion1.length===0){
    religion=religion
  }else if(religion.length!==0&&religion1.length!==0){
    religion=religion
  }else{
    religion=""
  }
  
  if(email.length===0&&email1.length!==0){
    email=email1
  }else if(email.length!==0&&email1.length===0){
    email=email
  }else if(email.length!==0&&email1.length!==0){
    email=email
  }else{
    email=""
  }
  
  if(guardianName.length===0&&gName1.length!==0){
    guardianName=gName1
  }else if(guardianName.length!==0&&gName1.length===0){
    guardianName=guardianName
  }else if(guardianName.length!==0&&gName1.length!==0){
    guardianName=guardianName
  }else{
    guardianName=""
  }
  
  if(guardianrelation.length===0&&gRelation1.length!==0)
  {
    guardianrelation=gRelation1
  }
  else if(guardianrelation.length!==0&&gRelation1.length===0)
  {
    guardianrelation=guardianrelation
  }
  else if(guardianrelation.length!==0&&gRelation1.length!==0)
  {
    guardianrelation=guardianrelation
  }
  else{
    guardianrelation=""
  }
  
  if (guardianCNIC.length === 0 && gCnic1.length !== 0) {
      guardianCNIC = gCnic1;
  } else if (guardianCNIC.length !== 0 && gCnic1.length === 0) {
      guardianCNIC = guardianCNIC;
  } else if (guardianCNIC.length !== 0 && gCnic1.length !== 0) {
      guardianCNIC = guardianCNIC;
  } else {
      guardianCNIC = "";
  }
  
  if (guardianPhone.length === 0 && gPhone1.length !== 0) {
      guardianPhone = gPhone1;
  } else if (guardianPhone.length !== 0 && gPhone1.length === 0) {
      guardianPhone = guardianPhone;
  } else if (guardianPhone.length !== 0 && gPhone1.length !== 0) {
      guardianPhone = guardianPhone;
  } else {
      guardianPhone = "";
  }
  
  if (guardianEmail.length === 0 && gEmail1.length !== 0) {
      guardianEmail = gEmail1;
  } else if (guardianEmail.length !== 0 && gEmail1.length === 0) {
      guardianEmail = guardianEmail;
  } else if (guardianEmail.length !== 0 && gEmail1.length !== 0) {
      guardianEmail = guardianEmail;
  } else {
      guardianEmail = "";
  }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('rollNo',sql.Char,roll1)
          .input('studentName', sql.VarChar, Name)
          .input('gender', sql.VarChar, gender)
          .input('mobileNo', sql.Char, phone)
          .input('studentAddress', sql.VarChar, address)
          .input('student_dob', sql.Date, dob)
          .input('cnic', sql.Char, cnic)
          .input('bloodGroup', sql.VarChar, bloodGroup)
          .input('religion', sql.VarChar, religion)
          .input('email', sql.VarChar, email)
          .input('batch', sql.Int, batchId)
          .input('degree', sql.Int, degreeId)
          .input('enrollment_status', sql.VarChar, enrollmentStatus)
          .input('guardianName', sql.VarChar, guardianName)
          .input('guardian_gender', sql.VarChar, guardianGender)
          .input('guardian_relation', sql.VarChar, guardianrelation)
          .input('guardian_cnic', sql.Char, guardianCNIC)
          .input('guardian_mobileNo', sql.VarChar, guardianPhone)
          .input('guardian_email', sql.VarChar, guardianEmail)
          .execute('UpdateStudentInfo')

        await transaction.commit();


        res.redirect("/students")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});



/*******************************Notification********************************* */
app.route("/notification/addnotification")
.get(async function(req,res)
{
  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusID",sql.Int,CAMPUSID)
    .execute("get_student_roll_info")

    res.render("addnotification",{
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{title,recipient,message} = req.body
  console.log(req.body)
  console.log(title)
  console.log(recipient)
  console.log(typeof recipient)
  console.log(typeof NULL)


  console.log(message)

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("rollNo",sql.Char,recipient)
    .input("notification_title",sql.VarChar,title)
    .input("notification_text",sql.VarChar,message)
    .execute("insert_student_notification")

    res.redirect("/notification")
  }
  catch(error)
  {
    console.log(error)
  }
}); 


/******************Courses********************* */

app.route("/courses/addcourse")
.get(async function(req,res)
{
  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .query("SELECT * FROM Course")
    res.render("addcourse",
    {
      data:posts.recordset
    })

  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{courseCode,courseName,courseType,creditHours,courseRelation,preReq} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("course_code",sql.Char,courseCode)
    .input("course_name",sql.VarChar,courseName)
    .input("course_type",sql.Int,courseType)
    .input("credit_hours",sql.Int,creditHours)
    .input("relation",sql.Int,courseRelation)
    .input("pre_requisite",sql.Char,preReq)
    .execute("InsertCourse")

    res.redirect("/courses")
  }
  catch(error)
  {
    console.log(error)
  }
}); 


app.route("/courses/editcourse")
.get(async function(req,res)
{
  try
  {
    code1 = req.query.courseCode

    console.log(code1)

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("course_code",sql.Char,code1)
    .execute("SelectCourse")

    let pool1 = await sql.connect(config)
    const posts1 = await pool1.request()
    .query("SELECT * FROM Course")

    console.log(posts)

    courseName1 = posts.recordset[0].course_name
    creditHours1 = posts.recordset[0].credit_hours

    res.render("editcourse",
    {
      data:posts1.recordset
    })
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{courseName,courseType,creditHours,courseRelation,preReq} = req.body

    if (courseName.length === 0 && courseName1.length !== 0) {
      courseName = courseName1;
      console.log("1st")
  } else if (courseName.length !== 0 && courseName1.length === 0) {
    courseName = courseName;
      console.log("2nd")
  } else if (courseName.length !== 0 && courseName1.length !== 0) {
    courseName = courseName;
      console.log("3rd")
  } else {
    courseName = "";
      console.log("4th")
  }

    if (creditHours.length === 0 && creditHours1.length !== 0) 
    {
      creditHours = creditHours1;
        console.log("1")
    } 
    else if (creditHours.length !== 0 && creditHours1.length === 0) {
      creditHours = creditHours;
        console.log("2")

    } else if (creditHours.length !== 0 && creditHours1.length !== 0) {
      creditHours = creditHours;
        console.log("3")

    } else {
      creditHours = "";
        console.log("4")

    }
  

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('course_code', sql.Char, code1)
          .input('course_name', sql.VarChar, courseName)
          .input('course_type', sql.Int, courseType)
          .input('credit_hours', sql.Int, creditHours)
          .input('relation', sql.Int, courseRelation)
          .input('pre_requisite', sql.Char, preReq)
          .execute('UpdateCourseInfo')

        await transaction.commit();

        res.redirect("/courses")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});

/*****************Departments************************ */

app.route("/departments/adddepartment")
.get(async function(req,res)
{
  try{

    res.render("adddepartment")
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{deptName,deptAbbr} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("department_name",sql.VarChar,deptName)
    .input("name_abbreviation",sql.VarChar,deptAbbr)
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("InsertDepartment")

    res.redirect("/departments")
  }
  catch(error)
  {
    console.log(error)
  }
}); 


app.route("/departments/editdepartment")
.get(async function(req,res)
{
  try
  {
    deptID1 = req.query.departmentID

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("id",sql.Int,deptID1)
    .execute("select_department_by_id")

    console.log(posts)

    deptName1 = posts.recordset[0].department_name
    deptAbbr1 = posts.recordset[0].name_abbreviation
    
    res.render("editdepartment")
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{deptName,deptAbbr} = req.body


  if (deptName.length === 0 && deptName1.length !== 0) {
    deptName = deptName1;
    console.log("1st")
  } else if (deptName.length !== 0 && deptName1.length === 0) {
    deptName = deptName;
      console.log("2nd")
  } else if (deptName.length !== 0 && deptName1.length !== 0) {
    deptName = deptName;
      console.log("3rd")
  } else {
    deptName = "";
      console.log("4th")
  }

  if (deptAbbr.length === 0 && deptAbbr1.length !== 0) {
    deptAbbr = deptAbbr1;
    console.log("1st")
  } else if (deptAbbr.length !== 0 && deptAbbr1.length === 0) {
    deptAbbr = deptAbbr;
      console.log("2nd")
  } else if (deptAbbr.length !== 0 && deptAbbr1.length !== 0) {
    deptAbbr = deptAbbr;
      console.log("3rd")
  } else {
    deptAbbr = "";
      console.log("4th")
  }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('id', sql.Int, deptID1)
          .input('department_name', sql.VarChar, deptName)
          .input('name_abbreviation', sql.VarChar, deptAbbr)
          .execute('UpdateDepartmentInfo')

        await transaction.commit();

        res.redirect("/departments")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});


/*****************Degrees************************ */

app.route("/degrees/adddegree")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .query("SELECT * FROM Department")

    res.render("adddegree",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{degreeLevel,degreeName,degreeAbbr,deptID} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("degree_level",sql.Int,degreeLevel)
    .input("degree_name",sql.VarChar,degreeName)
    .input("name_abbreviation",sql.VarChar,degreeAbbr)
    .input("department",sql.Int,deptID)
    .execute("InsertDegree")

    res.redirect("/degrees")
  }
  catch(error)
  {
    console.log(error)
  }
}); 


app.route("/degrees/editdegree")
.get(async function(req,res)
{
  try
  {
    degID1 = req.query.degID

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("id",sql.Int,degID1)
    .execute("GetDegreeById")

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .query("SELECT * FROM Department")


    degName1 = posts.recordset[0].degree_name
    degAbbr1 = posts.recordset[0].name_abbreviation
    
    res.render("editdegree",
    {
      data:posts.recordset
    }) 
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{degLevel,degName,degAbbr,deptID} = req.body


  if (degName.length === 0 && degName1.length !== 0) {
    degName = degName1;
    console.log("1st")
  } else if (degName.length !== 0 && degName1.length === 0) {
    degName = degName;
      console.log("2nd")
  } else if (degName.length !== 0 && degName1.length !== 0) {
    degName = degName;
      console.log("3rd")
  } else {
    degName = "";
      console.log("4th")
  }

  if (degAbbr.length === 0 && degAbbr1.length !== 0) {
    degAbbr = deptAbbr1;
    console.log("1st")
  } else if (degAbbr.length !== 0 && degAbbr1.length === 0) {
    degAbbr = degAbbr;
      console.log("2nd")
  } else if (degAbbr.length !== 0 && degAbbr1.length !== 0) {
    degAbbr = degAbbr;
      console.log("3rd")
  } else {
    degAbbr = "";
      console.log("4th")
  }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('id', sql.Int, degID1)
          .input('degree_level', sql.Int, degLevel)
          .input('degree_name', sql.VarChar, degName)
          .input('name_abbreviation', sql.VarChar, degAbbr)
          .input('department', sql.Int, deptID)
          .execute('UpdateDegreeInfo')

        await transaction.commit();

        res.redirect("/degrees")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});

/********************TimeTable*************************** */

app.route("/timetable/addtime")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowCourseSection")

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowClassroom")

    res.render("addtime",
    {
      data:posts.recordset,
      data1:posts1.recordset

    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  let{secID,startTime,endTime,dayNo,venue} = req.body  

  const timeValue = startTime;
  const paddedTimeValue = timeValue.padEnd(18, ':00.0000000');

  const timeValue1 = endTime;
  const paddedTimeValue1 = timeValue1.padEnd(18, ':00.0000000');


  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("section_id",sql.Int,secID)
    .input("start_time",sql.Time,paddedTimeValue)
    .input("end_time",sql.Time,paddedTimeValue1)
    .input("day_no",sql.Int,dayNo)
    .input("venue",sql.Int,venue)
    .execute("insert_timetable")

    res.redirect("/timetable")
  }
  catch(error)
  {
    console.log(error)
  }
}); 


app.route("/timetable/edittime")
.get(async function(req,res)
{
  try
  {
    timeID1 = req.query.timeID

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("id",sql.Int,timeID1)
    .input("campusID",sql.Int,CAMPUSID)
    .execute("SelectTimetableRow")

    startTime1 = posts.recordset[0].start_time
    endTime1 = posts.recordset[0].end_time

    console.log(startTime1)
    console.log(typeof startTime1)
    console.log(endTime1)
    console.log(typeof endTime1)

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowCourseSection")

    const pool2 = await sql.connect(config);
    const request2 = new sql.Request(pool2);
    const posts2 = await request2
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowClassroom")
    
    res.render("edittime",
    {
      data:posts1.recordset,
      data1:posts2.recordset
    }) 
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{secID,startTime,endTime,dayNo,venue} = req.body

  console.log(req.body)


  if (startTime.length === 0 && startTime1.length !== 0) {
    startTime = startTime1;
    console.log("1st")
  } else if (startTime.length !== 0 && startTime1.length === 0) {
    startTime = startTime;
      console.log("2nd")
  } else if (startTime.length !== 0 && startTime1.length !== 0) {
    startTime = startTime;
      console.log("3rd")
  } else {
    startTime = "";
      console.log("4th")
  }

  if (endTime.length === 0 && endTime1.length !== 0) {
    endTime = endTime1;
    console.log("1st")
  } else if (endTime.length !== 0 && endTime1.length === 0) {
    endTime = endTime;
      console.log("2nd")
  } else if (endTime.length !== 0 && endTime1.length !== 0) {
    endTime = endTime;
      console.log("3rd")
  } else {
    endTime = "";
      console.log("4th")
  }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      const timeValue = startTime;
      const paddedTimeValue = timeValue.padEnd(18, ':00.0000000');
    
      const timeValue1 = endTime;
      const paddedTimeValue1 = timeValue1.padEnd(18, ':00.0000000');

      await request
          .input("id",sql.Int,timeID1)
          .input("section_id",sql.Int,secID)
          .input("start_time",sql.Time,paddedTimeValue)
          .input("end_time",sql.Time,paddedTimeValue1)
          .input("day_no",sql.Int,dayNo)
          .input("venue",sql.Int,venue)
          .execute('UpdateTimetable')

        await transaction.commit();

        res.redirect("/timetable")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});


/********************Batch****************************** */

app.route("/batch/addbatch")
.get(async function(req,res)
{
  try
  {
    res.render("addbatch")
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{batchSession,batchYear} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("batch_session",sql.VarChar,batchSession)
    .input("batch_year",sql.Int,batchYear)
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("InsertBatch")

    res.redirect("/batch")
  }
  catch(error)
  {
    console.log(error)
  }
}); 


app.route("/batch/editbatch")
.get(async function(req,res)
{
  try
  {
    batchID1 = req.query.batchID

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("id",sql.Int,batchID1)
    .execute("GetBatch")


    batchYear1 = posts.recordset[0].batch_year
    
    res.render("editbatch") 
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{batchSession,batchYear} = req.body

  if (batchYear.length === 0 && batchYear1.length !== 0) {
    batchYear = batchYear1;
    console.log("1st")
  } else if (batchYear.length !== 0 && batchYear1.length === 0) {
    batchYear = batchYear;
      console.log("2nd")
  } else if (batchYear.length !== 0 && batchYear1.length !== 0) {
    batchYear = batchYear;
      console.log("3rd")
  } else {
    batchYear = "";
      console.log("4th")
  }


    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('id', sql.Int, batchID1)
          .input('batch_session', sql.VarChar, batchSession)
          .input('batch_year', sql.Int, batchYear)
          .execute('UpdateBatch')

        await transaction.commit();

        res.redirect("/batch")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});


/********************Classroom******************************** */

app.route("/classroom/addclassroom")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("select_departments_by_campus_id")

    res.render("addclassroom",
    {
      data:posts.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{roomNo,department,roomType} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("room_no",sql.VarChar,roomNo)
    .input("department",sql.Int,department)
    .input("room_type",sql.Int,roomType)
    .execute("InsertClassroom")

    res.redirect("/classroom")
  }
  catch(error)
  {
    console.log(error)
  }
}); 

app.route("/classroom/editclassroom")
.get(async function(req,res)
{
  try
  {
    classID1 = req.query.classID

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("id",sql.Int,classID1)
    .input("campusID",sql.Int,CAMPUSID)
    .execute("SelectClassroomRow")

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("select_departments_by_campus_id")

    roomNo1 = posts.recordset[0].room_no
    
    res.render("editclassroom",
    {
      data:posts.recordset
    }) 
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{roomNo,department,roomType} = req.body

    if (roomNo.length === 0 && roomNo1.length !== 0) {
      roomNo = roomNo1;
      console.log("1st")
    } else if (roomNo.length !== 0 && roomNo1.length === 0) {
      roomNo = roomNo;
        console.log("2nd")
    } else if (roomNo.length !== 0 && roomNo1.length !== 0) {
      roomNo = roomNo;
        console.log("3rd")
    } else {
      roomNo = "";
        console.log("4th")
    }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      await request
          .input('id', sql.Int, classID1)
          .input('room_no', sql.Int, roomNo)
          .input('department', sql.Int, department)
          .input('room_type', sql.Int, roomType)
          .execute('UpdateClassroom')

        await transaction.commit();

        res.redirect("/classroom")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});


/**********************Semester*************************************** */

app.route("/semester/addsemester")
.get(async function(req,res)
{
  try
  {
    res.render("addsemester")
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{semSession,semYear,crdLimit} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("semester_session",sql.VarChar,semSession)
    .input("semester_year",sql.Int,semYear)
    .input("credit_hrs_limit",sql.Int,crdLimit)
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("InsertSemesterList")

    res.redirect("/semester")
  }
  catch(error)
  {
    console.log(error)
  }
}); 

app.route("/semester/editsemester")
.get(async function(req,res)
{
  try
  {
    semID1 = req.query.semID

    let pool = await sql.connect(config)
    const posts = await pool.request()
    .input("id",sql.Int,semID1)
    .input("campusID",sql.Int,CAMPUSID)
    .execute("SelectSemesterList")

    semYear1 = posts.recordset[0].semester_year
    crdLimit1 = posts.recordset[0].credit_hrs_limit
    
    res.render("editsemester",
    {
      data:posts.recordset
    }) 
  }
  catch(error)
  {
      console.log(error)
  }
})
.post(async function(req,res)
{
  let{semSession,semYear,crdLimit} = req.body

    if (semYear.length === 0 && semYear1.length !== 0) {
      semYear = semYear1;
      console.log("1st")
    } else if (semYear.length !== 0 && semYear1.length === 0) {
      semYear = semYear;
        console.log("2nd")
    } else if (semYear.length !== 0 && semYear1.length !== 0) {
      semYear = semYear;
        console.log("3rd")
    } else {
      semYear = "";
        console.log("4th")
    }

    if (crdLimit.length === 0 && crdLimit1.length !== 0) {
      crdLimit = crdLimit1;
      console.log("1st")
    } else if (crdLimit.length !== 0 && crdLimit1.length === 0) {
      crdLimit = crdLimit;
        console.log("2nd")
    } else if (crdLimit.length !== 0 && crdLimit1.length !== 0) {
      crdLimit = crdLimit;
        console.log("3rd")
    } else {
      crdLimit = "";
        console.log("4th")
    }

    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);

      console.log(semID1)

      console.log(semYear)
      console.log(crdLimit)


      await request
          .input('id', sql.Int, semID1)
          .input('semester_session', sql.VarChar, semSession)
          .input('semester_year', sql.Int, semYear)
          .input('credit_hrs_limit', sql.Int, crdLimit)
          .input('campus_id', sql.Int, CAMPUSID)
          .execute('UpdateSemesterList')

        await transaction.commit();

        res.redirect("/semester")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});

/*********************Register*********************** */

app.route("/register/addregister")
.get(async function(req,res)
{
  try
  {
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("ShowTeach")

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .query("SELECT *FROM Course")

    // Semester
    const pool2 = await sql.connect(config);
    const request2 = new sql.Request(pool2);
    const posts2 = await request2
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("select_by_campus_id")

    const pool3 = await sql.connect(config);
    const request3 = new sql.Request(pool3);
    const posts3 = await request3
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("ShowDeg")

    const pool4 = await sql.connect(config);
    const request4 = new sql.Request(pool4);
    const posts4 = await request4
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowBatch")

    res.render("addregister",
    {
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset,
      data3:posts3.recordset,
      data4:posts4.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  const{teachID,secName,courseCode,semID,degID,batchID,totalSeats,availableSeats} = req.body

  try{
    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("teacher_id",sql.Char,teachID)
    .input("section_name",sql.VarChar,secName)
    .input("course_code",sql.Char,courseCode)
    .input("semester_id",sql.Int,semID)
    .input("degree_id",sql.Int,degID)
    .input("batch_id",sql.Int,batchID)
    .input("total_seats",sql.Int,totalSeats)
    .input("available_seats",sql.Int,availableSeats)
    .execute("insertCourseSection")

    res.redirect("/register")
  }
  catch(error)
  {
    console.log(error)
  }
}); 

app.route("/register/editregister")
.get(async function(req,res)
{
  try
  {
    regID1 = req.query.regID

    const pool = await sql.connect(config);
    const request = new sql.Request(pool);
    const posts = await request
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("ShowTeach")

    const pool1 = await sql.connect(config);
    const request1 = new sql.Request(pool1);
    const posts1 = await request1
    .query("SELECT *FROM Course")

    // Semester
    const pool2 = await sql.connect(config);
    const request2 = new sql.Request(pool2);
    const posts2 = await request2
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("select_by_campus_id")

    const pool3 = await sql.connect(config);
    const request3 = new sql.Request(pool3);
    const posts3 = await request3
    .input("campus_id",sql.Int,CAMPUSID)
    .execute("ShowDeg")

    const pool4 = await sql.connect(config);
    const request4 = new sql.Request(pool4);
    const posts4 = await request4
    .input("campusID",sql.Int,CAMPUSID)
    .execute("ShowBatch")

    const pool5 = await sql.connect(config);
    const request5 = new sql.Request(pool5);
    const posts5 = await request5
    .input('id', sql.Int, regID1)
    .execute("getCourseSection")

    sectionName1 = posts5.recordset[0].section_name
    totalSeats1 = posts5.recordset[0].total_seats
    availableSeats1 = posts5.recordset[0].available_seats


    res.render("editregister",
    {
      data:posts.recordset,
      data1:posts1.recordset,
      data2:posts2.recordset,
      data3:posts3.recordset,
      data4:posts4.recordset
    })
  }
  catch(error)
  {
    console.log(error)
  }
})
.post(async function(req,res)
{
  let{teachID,secName,courseCode,semID,degID,batchID,totalSeats,availableSeats} = req.body

    if (secName.length === 0 && sectionName1.length !== 0) {
      secName = sectionName1;
      console.log("1st")
    } else if (secName.length !== 0 && sectionName1.length === 0) {
      secName = secName;
        console.log("2nd")
    } else if (secName.length !== 0 && sectionName1.length !== 0) {
      secName = secName;
        console.log("3rd")
    } else {
      secName = "";
        console.log("4th")
    }

    if (totalSeats.length === 0 && totalSeats1.length !== 0) {
      totalSeats = totalSeats1;
      console.log("1st")
    } else if (totalSeats.length !== 0 && totalSeats1.length === 0) {
      totalSeats = totalSeats;
        console.log("2nd")
    } else if (totalSeats.length !== 0 && totalSeats1.length !== 0) {
      totalSeats = totalSeats;
        console.log("3rd")
    } else {
      totalSeats = "";
        console.log("4th")
    }

    if (availableSeats.length === 0 && availableSeats1.length !== 0) {
      availableSeats = availableSeats1;
      console.log("1st")
    } else if (availableSeats.length !== 0 && availableSeats1.length === 0) {
      availableSeats = availableSeats;
        console.log("2nd")
    } else if (availableSeats.length !== 0 && availableSeats1.length !== 0) {
      availableSeats = availableSeats;
        console.log("3rd")
    } else {
      totalSeats = "";
        console.log("4th")
    }
    try 
    {
      const pool = await sql.connect(config);
      transaction = new sql.Transaction(pool);
      
      await transaction.begin();

      const request = new sql.Request(transaction);


      await request
          .input('id', sql.Int, regID1)
          .input('section_name', sql.VarChar, secName)
          .input('course_code', sql.Char, courseCode)
          .input('semester_id', sql.Int, semID)
          .input('degree_id', sql.Int, degID)
          .input('batch_id', sql.Int, batchID)
          .input('total_seats', sql.Int, totalSeats)
          .input('available_seats', sql.Int, availableSeats)
          .input('teacher_id', sql.Char, teachID)
          .execute('updateCourseSection')

        await transaction.commit();

        res.redirect("/register")

    }
    catch(error)
    {
      await transaction.rollback();

      console.log(error)
    }
});

/********************PORT************************* */

let port = 3000 || process.env.PORT
app.listen(port, function() {
  console.log("Server started on port " + port);
});
