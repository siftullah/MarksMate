const config = {
    user :'Ruman',
    password :'mypassword',
    server:'127.0.0.1',
    database:'VortexFlex',
    options:{
        trustedconnection: true,
        enableArithAbort : true,
        trustServerCertificate: true, 
        instancename :'MSSQLSERVER'
    },
    port : 1433,
    secret: "87bcca91-9dbd-4e9e-89f8-d41a658ce714"
}

module.exports = config; 