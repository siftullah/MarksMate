var config = require('./dbconfig')
const sql = require('mssql')

// async function getStudents()
// {
//     try{
//         let pool = await sql.connect(config)
//         let products = await pool.request().query("Select * from student_personal_info")
//         return products.recordsets
//     }
//     catch(error)
//     {
//         console.log(error)
//     }
// }

// async function getStudentsRollNo(rollNo)
// {
//     try{
//         let pool = await sql.connect(config)
//         let product = await pool.request()
//         .input('input_parameter',sql.Char,rollNo)
//         .query("Select * from student_personal_info where rollNo = @input_parameter")
//         return product.recordsets
//     }
//     catch(error)
//     {
//         console.log(error)
//     }
// }

// async function insertStudent(student)
// {
//     try{
//         let pool = await sql.connect(config)
//         let insertProduct = await pool.request()
//             .input('rollNo',sql.Char,student.rollNo)
//             .input('studentFirstName',sql.VarChar,student.studentFirstName)
//             .input('studentMiddleName',sql.VarChar,student.studentMiddleName)
//             .input('studentLastName',sql.VarChar,student.studentLastName)
//             .input('gender',sql.VarChar,student.gender)
//             .input('student_dob',sql.Date,student.student_dob)
//             .input('mobileNo',sql.Char,student.mobileNo)
//             .input('cnic',sql.Char,student.cnic)
//             .input('bloodGroup',sql.VarChar,student.bloodGroup)
//             .input('religion',sql.VarChar,student.religion)
//             .input('email',sql.VarChar,student.email)
//             .execute('insert_student_personal_info');
//         return insertProduct.recordsets;
//     }
//     catch(error)
//     {
//         console.log(error)
//     }
// }


async function getInvalidValues() {
  try {
    // Create a connection to the database
    const pool = await sql.connect(config);

    // Query the database to get the list of invalid values
    const result = await pool.request().query("SELECT value FROM InvalidValues");

    // Return the list of invalid values
    return result.recordset.map(row => row.value);
  } catch (err) {
    console.error(err);
  }
}



module.exports = 
{
    getInvalidValues:getInvalidValues
}