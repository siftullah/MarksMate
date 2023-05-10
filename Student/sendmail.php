<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="mailer.php" method="post" enctype="multipart/form-data">
            <input type="email" name="email">
            <input type="text" name="subject">
            <input type="text" name="message">
            <input type="file" id="file" name="vortex" />
            <input type="submit" value="submit" name="send">
        </form>
    </body>
</html>