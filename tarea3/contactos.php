<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 17/02/18
 * Time: 12:34 PM
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tareas Programacion Web - UNA - 115920802</title>

    <script rel="script" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <link rel="shortcut icon" type="image/png" href="../images/icon.png"/>

    <style rel="stylesheet">
        html, body {
            background: gainsboro;
            height: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .container{
            height: 100%;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-inverse" style="margin-bottom:0">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">Tareas Programacion Web</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../tarea1/convertidorUnidades.php">Tarea I</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li><a href="../tarea2/agendaCookies.php">Tarea II</a></li>
            </ul>
        </div>
    </nav>
</header>

<?php
$data = $_POST;
?>

<div class="container">
    <h2>Agenda de Contactos</h2>
    <div class="row">
        <div class="col-sm-6">
            <ul>
                <li>Carlos</li>
                <li>Juan</li>
                <li>Andres</li>
            </ul>
        </div>
        <div class="col-sm-6">

            <form action="agendaCookies.php" class="row" method="post" id="contacto">
                <input type="hidden" name="tipo" value="agregar"> </input>
                <div class="form-group">
                    <label for="nombre">Email address</label>
                    <input type="text" class="form-control" name="nombre" id="nombre">
                </div>

                <div class="form-group">
                    <label for="trabajo">Email address</label>
                    <input type="text" class="form-control" name="trabajo" id="trabajo">
                </div>

                <div class="form-group">
                    <label for="celular">Email address</label>
                    <input type="text" class="form-control" name="celular" id="celular">
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="direccion">Email address</label>
                    <textarea rows="4" cols="69" name="direccion" id="direccion" form="contacto"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <button type="submit" class="btn btn-default">Nuevo</button>
                </div>
            </form>

        </div>
    </div>
</div>

<footer style="height:60px;padding: 10px; border-top: #333333 solid 1px; background: black; color: white">
    <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a
            href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a
            href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC
            3.0 BY</a></div>
</footer>

</body>
</html>




