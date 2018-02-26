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
                <li><a href="agendaCookies.php">Tarea II</a></li>
            </ul>
        </div>
    </nav>
</header>

<?php
$data = $_POST;
$eventos = [];
session_start();
if ($data) {
    if ($data['tipo'] == "agregar") {
        $eventos = $_SESSION['eventos'];
        if ($eventos) {
            $eventos = json_decode($eventos);
            $evento = [
                "dia" => $data['dia'],
                "hora" => $data['hora'],
                "evento" => $data['evento'],
            ];
            if(!is_array($eventos)){
                $eventos = (array)($eventos);
            }
            $eventos[] = (object)$evento;
            $_SESSION['eventos'] = json_encode($eventos);
        } else {
            $evento = [
                "dia" => $data['dia'],
                "hora" => $data['hora'],
                "evento" => $data['evento'],
            ];
            $eventos[] = (object)$evento;
            $_SESSION['eventos'] = json_encode($eventos);
        }
    } else {
        if ($data['tipo'] == "borrar") {
            if ($_SESSION['eventos']) {
                $eventos = json_decode($_SESSION['eventos']);

                if(is_array($eventos))
                    unset($eventos[$data["evento"]]);
                else{
                    $id = $data["evento"];
                    unset($eventos->$id);
                }
                $_SESSION['eventos'] = json_encode($eventos);
            }
        }
    }
} else {
    if ($_SESSION['eventos'])
        $eventos = json_decode($_SESSION['eventos']);
}

?>

<div class="container" style="height: 580px">
    <h2>Calendario de eventos ( $_SESSION ) </h2>
    <a style="margin-bottom: 20px" href="agendaCookies.php">Usar cookies</a>
    <table class="tg" style="width: 100%">
        <tr>
            <th width="300" class="tg-yw4l">
                Día
            </th>
            <th width="290" class="tg-yw4l">
                Hora
            </th>
            <th width="290" class="tg-yw4l">
                Evento
            </th>
            <th class="tg-yw4l">
                Operación
            </th>
        </tr>

        <?php
        foreach ($eventos as $key => $evento) {
            echo '<tr>
                  <td> ' . $evento->dia . '</td>
                  <td> ' . $evento->hora . '</td>
                  <td> ' . $evento->evento . '</td>
                  <td> 
                    <form action="agendaSessions.php" method="post">
                    <input type="hidden" name="tipo" value="borrar"></input>
                    <input type="hidden" name="evento" value="' . $key . '"></input>
                    <button type="submit" class="btn btn-default">Borrar</button>
                    </form>
                  </td>
                    </tr>';
        }
        ?>
        <tr>
            <td class="tg-yw4l" colspan="4">
                <form action="agendaSessions.php" class="row" method="post">
                    <input type="hidden" name="tipo" value="agregar"> </input>
                    <div class="form-group col-sm-3">
                        <input type="date" class="form-control" name="dia">
                    </div>

                    <div class="form-group col-sm-3">
                        <input type="time" class="form-control" name="hora">
                    </div>

                    <div class="form-group col-sm-3">
                        <input type="text" class="form-control" name="evento">
                    </div>

                    <div class="form-group col-sm-3">
                        <button type="submit" class="btn btn-default">Nuevo</button>
                    </div>
                </form>
            </td>
        </tr>
    </table>
</div>

<footer style="height:60px;padding: 10px; border-top: #333333 solid 1px; background: black; color: white">
    <div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a
            href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a
            href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC
            3.0 BY</a></div>
</footer>

</body>
</html>



