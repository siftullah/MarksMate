<?php
    if(session_id())
    {
        // session has been started
    }
    else
    {
        // session has NOT been started
        session_start();
    }

    function connectDatabase()
    {
        $serverName = "DESKTOP-1R84RK0";
        $database = "vortexFlex";
        $uid = "sa";
        $pass = "12345678";

        $connection = [
            "Database" => $database,
            "Uid" => $uid,
            "PWD" => $pass,
            'ReturnDatesAsStrings'=>true
        ];

        $conn = sqlsrv_connect($serverName,$connection);

        if(!$conn)
            die(print_r(sqlsrv_errors(),true));

        return $conn;
    }

    function generateNumericOTP()
    {
        $generator = "1357902468";
        $n = 6;
        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, rand() % strlen($generator), 1);
        }

        return $result;
    }

?>