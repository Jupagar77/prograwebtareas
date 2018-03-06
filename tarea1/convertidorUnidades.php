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
        }

        table, th, td {
            border: 1px solid gainsboro;
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Tareas Programacion Web</a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="convertidorUnidades.php">Tarea I</a></li>
                    <li><a href="../tarea2/agendaCookies.php">Tarea II</a></li>
                    <li><a href="../tarea3/contactos.php">Tarea III</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php
$longitud = array(
    "milimetros" => '1',
    "centimetros" => '1',
    "metros" => '1',
    "kilometros" => '1',
    "pulgadas" => '2',
    "pies" => '2',
    "yardas" => '2',
    "brazas" => '2',
    "millas tierra" => '2',
    "millas mar (eu)" => '2',
    "millas mar (ru)" => '2'
);
$superficie = array(
    "milimetros²" => '1',
    "centimetros²" => '1',
    "metros²" => '1',
    "kilometros²" => '1',
    "hectareas" => '1',
    "pulgadas²" => '2',
    "pies²" => '2',
    "yardas²" => '2',
    "acres" => '2',
    "millas²" => '2'
);
$volumen = array(
    "centimetros³" => '1',
    "metros³" => '1',
    "pulgadas³" => '2',
    "pies³" => '2',
    "yardas³" => '2',
    "galones (eu)" => '2',
    "galones (ru)" => '2',
);
$capacidad = array(
    "litros" => '1',
    "hectolitros" => '1',
    "pintas liquidas" => '2',
    "quarter liquidos" => '2',
    "bushels (eu)" => '2',
    "bushels (ru)" => '2',
    "pulgadas³" => '2',
    "pies³" => '2',
    "galones (eu)" => '2',
    "galones (ru)" => '2',
);
$peso = array(
    "gramos" => '1',
    "kilogramos" => '1',
    "toneladas³" => '1',
    "onzas (av.)" => '2',
    "onzas (troy)" => '2',
    "libras (av.)" => '2',
    "libras (troy)" => '2',
    "libras" => '2',
    "toneladas (eu)" => '2',
    "toneladas (ru)" => '2'
);

$data = $_POST;
$type = NULL;
if ($data) {
    $type = $data['type'];
    $from = $data['unit1'];
    $to = $data['unit2'];
    $value = $data['number1'];
    switch ($type) {
        case "longitud":
            $medidas = $longitud;
            $escala = array(
                "kilometros",
                "hm",
                "dam",
                "metros",
                "dm",
                "centimetros",
                "milimetros",
            );
            $conversiones = array(
                "pulgadas" => array(
                    "milimetros" => 0.0394
                ),
                "pies" => array(
                    "metros" => 3.2808
                ),
                "yardas" => array(
                    "metros" => 1.0936
                ),
                "brazas" => array(
                    "metros" => 0.5468
                ),
                "millas tierra" => array(
                    "kilometros" => 0.6214
                ),
                "millas mar (eu)" => array(
                    "kilometros" => 0.5399
                ),
                "millas mar (ru)" => array(
                    "kilometros" => 0.5396
                )
            );
            $ten = 10;
            break;
        case "superficie":
            $medidas = $superficie;
            $escala = array(
                "hectareas",
                "kilometros²",
                "hm²",
                "dam²",
                "metros²",
                "dm²",
                "centimetros²",
                "milimetros²",
            );
            $conversiones = array(
                "pulgadas²" => array(
                    "milimetros²" => 0.001550
                ),
                "pies²" => array(
                    "metros²" => 10.7369
                ),
                "yardas²" => array(
                    "metros²" => 1.1960
                ),
                "acres" => array(
                    "kilometros²" => 247.105
                ),
                "millas²" => array(
                    "kilometros²" => 0.381
                )
            );
            $ten = 100;
            break;
        case "volumen":
            $medidas = $volumen;
            $escala = array(
                "kilometros³",
                "hm³",
                "dam³",
                "metros³",
                "dm³",
                "centimetros³",
                "milimetros³",
            );
            $conversiones = array(
                "pulgadas³" => array(
                    "centimetros³" => 0.0610
                ),
                "pies³" => array(
                    "metros³" => 35.3145
                ),
                "yardas³" => array(
                    "metros³" => 1.3079
                ),
                "galones (eu)" => array(
                    "metros³" => 264.178
                ),
                "galones (ru)" => array(
                    "kilometros³" => 219.976
                )
            );
            $ten = 1000;
            break;
        case "capacidad":
            $medidas = $capacidad;
            $escala = array(
                "kilolitros",
                "hectolitros",
                "dal",
                "litros",
                "dl",
                "centilitros",
                "mililitros",
            );
            $conversiones = array(
                "pulgadas³" => array(
                    "litros³" => 61.0238
                ),
                "pies³" => array(
                    "litros" => 0.0353
                ),
                "pintas liquidas" => array(
                    "litros" => 2.1134
                ),
                "quarter liquidos" => array(
                    "litros" => 1.0567
                ),
                "galones (eu)" => array(
                    "hectolitros" => 26.4178
                ),
                "galones (ru)" => array(
                    "hectolitros" => 21.9976
                ),
                "bushels (eu)" => array(
                    "hectolitros" => 2.8378
                ),
                "bushels (ru)" => array(
                    "hectolitros" => 2.7497
                )
            );
            $ten = 10;
            break;
        case "peso":
            $medidas = $peso;
            $escala = array(
                "toneladas³",
                "x",
                "y",
                "kilogramos",
                "hectogramos",
                "dag",
                "gramos",
                "dg",
                "centigramos",
                "miligramos",
            );
            $conversiones = array(
                "onzas (av.)" => array(
                    "gramos³" => 0.0353
                ),
                "onzas (troy)" => array(
                    "gramos" => 0.0321
                ),
                "libras (av)" => array(
                    "kilogramos" => 2.2046
                ),
                "libras (troy)" => array(
                    "kilogramos" => 2.6792
                ),
                "libras" => array(
                    "toneladas³" => 2204.612
                ),
                "toneladas (eu)" => array(
                    "toneladas³" => 1.1023
                ),
                "toneladas (ru)" => array(
                    "toneladas³" => 0.9842
                )
            );
            $ten = 10;
            break;
        default:break;
    }

    if ($medidas[$from] == 2 && $medidas[$to] == 1) {
        $valorFrom = $conversiones[$from];
        $conv1 = (float)($value / reset($valorFrom));
        $key1 = array_search(key($valorFrom), $escala);
        $key2 = array_search($to, $escala);
        if ($key1 > $key2) {
            $divideBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = $jumps - 1;
            while ($jumps) {
                $divideBy *= $ten;
                $jumps--;
            }
            $RESULT = $conv1 / $divideBy;
        }
        if ($key1 < $key2) {
            $multiplyBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = ($jumps * (-1));
            $jumps = $jumps - 1;
            while ($jumps) {
                $multiplyBy *= $ten;
                $jumps--;
            }
            $RESULT = $conv1 * $multiplyBy;
        }
        if ($key1 == $key2) {
            $RESULT = $conv1 * 1;
        }
    }
    if ($medidas[$from] == 1 && $medidas[$to] == 2) {
        $key1 = array_search($from, $escala);
        $key2 = array_search(key($conversiones[$to]), $escala);
        if ($key1 > $key2) {
            $divideBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = $jumps - 1;
            while ($jumps) {
                $divideBy *= 10;
                $jumps--;
            }
            $conv1 = $value / $divideBy;
        }
        if ($key1 < $key2) {
            $multiplyBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = ($jumps * (-1));
            $jumps = $jumps - 1;
            while ($jumps) {
                $multiplyBy *= 10;
                $jumps--;
            }
            $conv1 = $value * $multiplyBy;
        }
        if ($key1 == $key2) {
            $conv1 = $value * 1;
        }
        $RESULT = $conv1 * reset($conversiones[$to]);
    }
    if ($medidas[$from] == 1 && $medidas[$to] == 1) {
        $key1 = array_search($from, $escala);
        $key2 = array_search($to, $escala);
        if ($key1 > $key2) {
            $divideBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = $jumps - 1;
            while ($jumps) {
                $divideBy *= 10;
                $jumps--;
            }
            $conv1 = $value / $divideBy;
        }
        if ($key1 < $key2) {
            $multiplyBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = ($jumps * (-1));
            $jumps = $jumps - 1;
            while ($jumps) {
                $multiplyBy *= 10;
                $jumps--;
            }
            $conv1 = $value * $multiplyBy;
        }
        if ($key1 == $key2) {
            $conv1 = $value * 1;
        }
        $RESULT = $conv1;
    }
    if ($medidas[$from] == 2 && $medidas[$to] == 2) {
        $valorFrom = $conversiones[$from];
        $valorTo = $conversiones[$to];
        $conv1 = (float)($value / reset($valorFrom));
        $key1 = array_search(key($valorFrom), $escala);
        $key2 = array_search(key($valorTo), $escala);
        if ($key1 > $key2) {
            $divideBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = $jumps - 1;
            while ($jumps) {
                $divideBy *= 10;
                $jumps--;
            }
            $RESULT = $conv1 / $divideBy;
        }
        if ($key1 < $key2) {
            $multiplyBy = $ten;
            $jumps = $key1 - $key2;
            $jumps = ($jumps * (-1));
            $jumps = $jumps - 1;
            while ($jumps) {
                $multiplyBy *= 10;
                $jumps--;
            }
            $RESULT = $conv1 * $multiplyBy;
        }
        if ($key1 == $key2) {
            $RESULT = $conv1 * 1;
        }
        $RESULT = reset($valorTo) * $RESULT;
    }

}
?>

<div class="container">
    <h2 style="margin-bottom: 20px">Convertidores de unidades de medida:</h2>
    <table class="tg" style="margin-bottom: 20px">
        <tr>
            <td class="tg-yw4l">
                <form action="convertidorUnidades.php" style="padding: 10px; background: cornsilk" method="post">
                    <h2 style="margin-top:0">Longitud</h2>
                    <input type="hidden" class="form-control" value="longitud" name="type">
                    <div class="form-row" style="overflow: hidden">
                        <div class="form-group col-md-5" style="">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "longitud") {
                                        echo '<input type="number" class="form-control" value="' . $value . '" name="number1">';
                                    } else
                                        echo '<input type="number" class="form-control" name="number1">';
                                else
                                    echo '<input type="number" class="form-control" name="number1">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit1" style="background: ghostwhite">
                                    <?php
                                    foreach ($longitud as $lk => $l) {
                                        if ($type)
                                            if ($type == "longitud") {
                                                if($from == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($l);
                                    unset($lk);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-1" style="text-align: center;font-size: xx-large">
                            <label for="inputState">=</label>
                        </div>

                        <div class="form-group col-md-5">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "longitud") {
                                        echo '<input disabled value="' . $RESULT . '" style="color: green; background: white" type="number" class="form-control" name="number2">';
                                    } else
                                        echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                else
                                    echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit2" style="background: ghostwhite">
                                    <?php
                                    foreach ($longitud as $lk => $l) {
                                        if ($type)
                                            if ($type == "longitud") {
                                                if($to == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($lk);
                                    unset($l);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button style="" type="submit" class="btn btn-primary">Convertir</button>
                </form>
            </td>
            <td class="tg-yw4l">
                <form action="convertidorUnidades.php" style="padding: 10px;background: cornsilk" method="post">
                    <h2 style="margin-top:0">Superficie</h2>
                    <input type="hidden" class="form-control" value="superficie" name="type">
                    <div class="form-row" style="overflow: hidden">
                        <div class="form-group col-md-5" style="">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "superficie") {
                                        echo '<input type="number" class="form-control" value="' . $value . '" name="number1">';
                                    } else
                                        echo '<input type="number" class="form-control" name="number1">';
                                else
                                    echo '<input type="number" class="form-control" name="number1">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit1" style="background: ghostwhite">
                                    <?php
                                    foreach ($superficie as $lk => $l) {
                                        if ($type)
                                            if ($type == "superficie") {
                                                if($from == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($l);
                                    unset($lk);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-1" style="text-align: center;font-size: xx-large">
                            <label for="inputState">=</label>
                        </div>

                        <div class="form-group col-md-5">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "superficie") {
                                        echo '<input disabled value="' . $RESULT . '" style="color: green; background: white" type="number" class="form-control" name="number2">';
                                    } else
                                        echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                else
                                    echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit2" style="background: ghostwhite">
                                    <?php
                                    foreach ($superficie as $lk => $l) {
                                        if ($type)
                                            if ($type == "superficie") {
                                                if($to == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($lk);
                                    unset($l);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button style="" type="submit" class="btn btn-primary">Convertir</button>
                </form>
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l">
                <form action="convertidorUnidades.php" style="padding: 10px; background: cornsilk" method="post">
                    <h2 style="margin-top:0">Volumen</h2>
                    <input type="hidden" class="form-control" value="volumen" name="type">
                    <div class="form-row" style="overflow: hidden">
                        <div class="form-group col-md-5" style="">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "volumen") {
                                        echo '<input type="number" class="form-control" value="' . $value . '" name="number1">';
                                    } else
                                        echo '<input type="number" class="form-control" name="number1">';
                                else
                                    echo '<input type="number" class="form-control" name="number1">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit1" style="background: ghostwhite">
                                    <?php
                                    foreach ($volumen as $lk => $l) {
                                        if ($type)
                                            if ($type == "volumen") {
                                                if($from == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($l);
                                    unset($lk);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-1" style="text-align: center;font-size: xx-large">
                            <label for="inputState">=</label>
                        </div>

                        <div class="form-group col-md-5">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "volumen") {
                                        echo '<input disabled value="' . $RESULT . '" style="color: green; background: white" type="number" class="form-control" name="number2">';
                                    } else
                                        echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                else
                                    echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit2" style="background: ghostwhite">
                                    <?php
                                    foreach ($volumen as $lk => $l) {
                                        if ($type)
                                            if ($type == "volumen") {
                                                if($to == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($lk);
                                    unset($l);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button style="" type="submit" class="btn btn-primary">Convertir</button>
                </form>
            </td>
            <td class="tg-yw4l">
                <form action="convertidorUnidades.php" style="padding: 10px; background: cornsilk" method="post">
                    <h2 style="margin-top:0">Capacidad</h2>
                    <input type="hidden" class="form-control" value="capacidad" name="type">
                    <div class="form-row" style="overflow: hidden">
                        <div class="form-group col-md-5" style="">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "capacidad") {
                                        echo '<input type="number" class="form-control" value="' . $value . '" name="number1">';
                                    } else
                                        echo '<input type="number" class="form-control" name="number1">';
                                else
                                    echo '<input type="number" class="form-control" name="number1">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit1" style="background: ghostwhite">
                                    <?php
                                    foreach ($capacidad as $lk => $l) {
                                        if ($type)
                                            if ($type == "capacidad") {
                                                if($from == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($l);
                                    unset($lk);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-1" style="text-align: center;font-size: xx-large">
                            <label for="inputState">=</label>
                        </div>

                        <div class="form-group col-md-5">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "capacidad") {
                                        echo '<input disabled value="' . $RESULT . '" style="color: green; background: white" type="number" class="form-control" name="number2">';
                                    } else
                                        echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                else
                                    echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit2" style="background: ghostwhite">
                                    <?php
                                    foreach ($capacidad as $lk => $l) {
                                        if ($type)
                                            if ($type == "capacidad") {
                                                if($to == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($lk);
                                    unset($l);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button style="" type="submit" class="btn btn-primary">Convertir</button>
                </form>
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l">
                <form action="convertidorUnidades.php" style="padding: 10px; background: cornsilk" method="post">
                    <h2 style="margin-top:0">Peso</h2>
                    <input type="hidden" class="form-control" value="peso" name="type">
                    <div class="form-row" style="overflow: hidden">
                        <div class="form-group col-md-5" style="">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "peso") {
                                        echo '<input type="number" class="form-control" value="' . $value . '" name="number1">';
                                    } else
                                        echo '<input type="number" class="form-control" name="number1">';
                                else
                                    echo '<input type="number" class="form-control" name="number1">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit1" style="background: ghostwhite">
                                    <?php
                                    foreach ($peso as $lk => $l) {
                                        if ($type)
                                            if ($type == "peso") {
                                                if($from == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($l);
                                    unset($lk);
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-1" style="text-align: center;font-size: xx-large">
                            <label for="inputState">=</label>
                        </div>

                        <div class="form-group col-md-5">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php
                                if ($type)
                                    if ($type == "peso") {
                                        echo '<input disabled value="' . $RESULT . '" style="color: green; background: white" type="number" class="form-control" name="number2">';
                                    } else
                                        echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                else
                                    echo '<input disabled placeholder="Resultado" style="background: white" type="number" class="form-control" name="number2">';
                                ?>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="unit2" style="background: ghostwhite">
                                    <?php
                                    foreach ($peso as $lk => $l) {
                                        if ($type)
                                            if ($type == "peso") {
                                                if($to == $lk)
                                                    echo "<option selected='selected'>" . $lk . "</option>";
                                                else
                                                    echo "<option>" . $lk . "</option>";
                                            } else
                                                echo "<option>" . $lk . "</option>";
                                        else
                                            echo "<option>" . $lk . "</option>";
                                    }
                                    unset($lk);
                                    unset($l);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button style="" type="submit" class="btn btn-primary">Convertir</button>
                </form>
            </td>
            <td class="tg-yw4l"></td>
        </tr>
    </table>
</div>
</body>
</html>

