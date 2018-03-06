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

        .container {
            height: 100%;
        }

        .contact {
            padding: 2%;
            border-bottom: black solid 1px;
        }

        .contact-edit{
            border-left: black solid 1px;padding-left: 3%;
        }

        .contact-borrar{
            padding-left: 10%
        }

        .borrar-alert{
            margin-top: 0;
            background-color: antiquewhite;
            border: red solid 1px;
            padding: 1%;
            color: red;
        }

        @media only screen and (max-width: 767px) {
            .contact-edit {
                border: none;
                padding: 1%;
            }

            .contact-borrar{
                padding: 1%;
            }

            .borrar-alert{
                margin-top: 5px;
            }

            .boton-danger{
                float: right;
            }
        }

    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-inverse" style="margin-bottom:0">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Tareas Programacion Web</a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="../tarea1/convertidorUnidades.php">Tarea I</a></li>
                    <li><a href="../tarea2/agendaCookies.php">Tarea II</a></li>
                    <li><a href="contactos.php">Tarea III</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php
$filename = "contactos.txt";

$indice = "0";
$nombre = "";
$trabajo = "";
$movil = "";
$email = "";
$direccion = "";

$data = $_POST;
if ($data) {
    if ($data['tipo'] == "agregar") {
        $access_log = fopen($filename, "r");
        if ($access_log) {
            if (!$data['indice']) {
                if ($data["nombre"] && $data["trabajo"] && $data["celular"] && $data["email"] && $data["direccion"]) {
                    $i = 0;
                    while (!feof($access_log)) {
                        $line = fgets($access_log);
                        $i++;
                    }
                    fclose($access_log);
                    $index = str_pad($i, 4, "&");
                    $name = str_pad($data["nombre"], 30, "&");
                    $string = $index . $name . "\n";
                    $fileWrite = fopen($filename, "a");
                    fwrite($fileWrite, $string);
                    fclose($fileWrite);

                    $work = str_pad($data["trabajo"], 30, "&");
                    $mobile = str_pad($data["celular"], 30, "&");
                    $email = str_pad($data["email"], 30, "&");
                    $address = str_pad($data["direccion"], 30, "&");
                    $fileWrite = fopen("detalles.txt", "a");
                    fwrite($fileWrite, $name);
                    fwrite($fileWrite, $work);
                    fwrite($fileWrite, $mobile);
                    fwrite($fileWrite, $email);
                    fwrite($fileWrite, $address);
                    fclose($fileWrite);
                    $email = '';
                }
            } else {
                $i = 0;
                $access_log = fopen($filename, "r");
                $completeFile = "";
                while (!feof($access_log)) {
                    $line = fgets($access_log);
                    $i++;
                    if ($i == $data['indice']) {
                        $newName = str_pad($data["nombre"], 30, "&") . "\n";
                        $line = substr_replace($line, $newName, 4, strlen($line));
                    }
                    $completeFile .= $line;
                }
                fclose($access_log);
                $fileWrite = fopen($filename, "w");
                fwrite($fileWrite, $completeFile);
                fclose($fileWrite);

                $detalles = file_get_contents("detalles.txt");
                $detallesRewrite = "";
                $i = 0;
                for ($k = 0; $k < strlen($detalles); $k += 150) {
                    $i++;
                    $lineTwo = substr($detalles, $k, 150);
                    if ($i == $data['indice']) {
                        $name = str_pad($data["nombre"], 30, "&");
                        $work = str_pad($data["trabajo"], 30, "&");
                        $mobile = str_pad($data["celular"], 30, "&");
                        $email = str_pad($data["email"], 30, "&");
                        $address = str_pad($data["direccion"], 30, "&");
                        $lineTwo = substr_replace($lineTwo, $name, 0, 30);
                        $lineTwo = substr_replace($lineTwo, $work, 30, 30);
                        $lineTwo = substr_replace($lineTwo, $mobile, 60, 30);
                        $lineTwo = substr_replace($lineTwo, $email, 90, 30);
                        $lineTwo = substr_replace($lineTwo, $address, 120, 30);
                        $email = '';
                    }
                    $detallesRewrite .= $lineTwo;
                }
                $fileWrite = fopen("detalles.txt", "w");
                fwrite($fileWrite, $detallesRewrite);
                fclose($fileWrite);
            }
        }
    } else {
        if ($data['tipo'] == "mostrar") {
            $indice = $data['contacto'];
            $data['contacto'] -= 1;
            $index = $data['contacto'] * 150;
            $fp = fopen("detalles.txt", 'r');
            $data = fgets($fp);
            fseek($fp, $index);
            $data = fgets($fp);
            $data = substr($data, 0, 150);
            $nombre = str_replace('&', '', (substr($data, 0, 30)));
            $trabajo = str_replace('&', '', (substr($data, 30, 30)));
            $movil = str_replace('&', '', (substr($data, 60, 30)));
            $email = str_replace('&', '', (substr($data, 90, 30)));
            $direccion = str_replace('&', '', (substr($data, 120, 30)));
        } else {
            if ($data['tipo'] == "borrar") {
                if ($data['indice']) {
                    $i = 0;
                    $access_log = fopen($filename, "r");
                    $completeFile = "";
                    while (!feof($access_log)) {
                        $line = fgets($access_log);
                        $i++;
                        if ($i == $data['indice']) {
                            $line = substr_replace($line, '0   ', 0, 4);
                        }
                        $completeFile .= $line;
                    }
                    fclose($access_log);
                    $fileWrite = fopen($filename, "w");
                    fwrite($fileWrite, $completeFile);
                    fclose($fileWrite);
                }
            }
        }
    }
}

$contacts = array();
$access_log = fopen($filename, "r");
if ($access_log) {
    while (!feof($access_log)) {
        $line = fgets($access_log);
        $name = substr($line, 4, strlen($line));
        $id = (integer)(substr($line, 0, 4));
        if ($id) {
            $contacts[$id]["name"] = $name;
            $contacts[$id]["id"] = $id;
        }
    }
    fclose($access_log);
}

?>

<div class="container">
    <h2>Agenda de Contactos</h2>
    <div class="row">
        <div class="col-sm-5">
            <form action="contactos.php" method="post"
                  style="border: black solid 1px; overflow: hidden;  background: cornsilk">

                <?php
                foreach ($contacts as $contact) {
                    if ($contact) {
                        echo '
                    <div class="contact">
                    <input type="radio" name="contacto" value="' . $contact["id"] . '"> ' . str_replace('&', '', $contact["name"]) . '
                    </div>
                    <br>';
                    }
                }
                ?>

                <input type="hidden" name="tipo" value="mostrar"> </input>
                <div class="form-group">
                    <button style="float: right; margin: 1%" type="submit" class="btn btn-success">Editar</button>
                </div>
            </form>
            <h6 style="
    background-color: aliceblue;
    border: green solid 1px;
    padding: 1%;
    color: green;">Seleccione un contacto y presione "Editar"</h6>
        </div>
        <div class="col-sm-5">
            <form action="contactos.php" class="contact-edit row"
                  method="post" id="contacto">
                <input type="hidden" name="tipo" value="agregar"> </input>
                <input type="hidden" name="indice" value="<?php echo $indice ?>"> </input>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input maxlength="30" type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>">
                </div>

                <div class="form-group">
                    <label for="trabajo">Teléfono del trabajo</label>
                    <input maxlength="30" type="text" class="form-control" name="trabajo" id="trabajo" value="<?php echo $trabajo ?>">
                </div>

                <div class="form-group">
                    <label for="celular">Teléfono móvil</label>
                    <input maxlength="30" type="text" class="form-control" name="celular" id="celular" value="<?php echo $movil ?>">
                </div>

                <div class="form-group">
                    <label for="email">Dirección electrónica</label>
                    <input maxlength="30" type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección postal</label>
                    <input maxlength="30" name="direccion" id="direccion" style="height: 90px; width: 100%" value="<?php echo $direccion ?>">
                </div>

                <div class="form-group">
                    <button style="float: right" type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
        <div class="col-sm-2">
            <form action="contactos.php" class="contact-borrar row" method="post" id="contacto">
                <input type="hidden" name="tipo" value="borrar"> </input>
                <input type="hidden" name="indice" value="<?php echo $indice ?>"> </input>
                <div class="form-group">
                    <button type="submit" class="boton-danger btn btn-danger">Borrar</button>
                </div>
            </form>
            <h6 class="borrar-alert">Para "Borrar" debe seleccionar el contacto para "Editar".</h6>
        </div>
    </div>
</div>
</body>
</html>




