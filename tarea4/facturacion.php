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

        .contact-edit {
            border-left: black solid 1px;
            padding-left: 3%;
        }

        .contact-borrar {
            padding-left: 10%
        }

        .borrar-alert {
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

            .contact-borrar {
                padding: 1%;
            }

            .borrar-alert {
                margin-top: 5px;
            }

            .boton-danger {
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
                    <li><a href="../tarea3/contactos.php">Tarea III</a></li>
                    <li><a href="facturacion.php">Tarea IV</a></li>
                    <li><a href="../tarea5/facturacion.php">Tarea V</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php
session_start();
date_default_timezone_set('UTC');
$productos = array();
$factura = (object)array();
$impuestos = 0;
$total = 0;

$data = $_POST;
if ($data) {
    if ($data['tipo'] == "agregarProducto") {
        if ($_SESSION['id']) {
            agregarProducto($data, $_SESSION['id']);
        } else {
            $facturaId = crearFactura($data);
            $_SESSION['id'] = $facturaId;
        }
    }
    if ($data['tipo'] == "borrarProducto") {
        borrarProducto($data);
    }
    if ($data['tipo'] == "agregarFactura") {
        agregarFactura($data, $_SESSION['id']);
        $_SESSION['id'] = NULL;
    }
    if ($data['tipo'] == "mostrarFactura") {
        $factura = getInfoFactura($data['factura_id']);
        $productos = getProductosFactura($data['factura_id']);
        $_SESSION['id'] = $data['factura_id'];
    }
    if ($data['tipo'] == "cancelar") {
        $_SESSION['id'] = NULL;
    }
    if ($data['tipo'] == "borrar") {
        borrarFactura($_SESSION['id']);
        $_SESSION['id'] = NULL;
    }
}

if ($_SESSION['id']) {
    $factura = getInfoFactura($_SESSION['id']);
    $impuestos = $factura->impuestos;
    $total = $factura->monto_total;
    $productos = getProductosFactura($_SESSION['id']);
}

$facturas = getFacturas($_SESSION['id']);

function crearFactura($data)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $insert = "INSERT INTO facturas (numero, fecha, cliente, impuestos, monto_total) 
                VALUES (:numero, :fecha, :cliente, :impuestos, :monto_total)";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':impuestos', $impuestos);
        $stmt->bindParam(':monto_total', $monto_total);
        $numero = random();
        $fecha = '';
        $cliente = '';
        $impuestos = ($data['cantidad'] * $data['valor_unitario']) * 0.13;
        $monto_total = ($data['cantidad'] * $data['valor_unitario']) + (($data['cantidad'] * $data['valor_unitario']) * 0.13);
        $stmt->execute();

        $select = "SELECT id FROM facturas where numero = '" . $numero . "'";
        $stmt = $file_db->prepare($select);
        $stmt->execute();
        $factura = $stmt->fetchObject();

        $insert = "INSERT INTO productos (cantidad, descripcion, valor_unitario, subtotal, factura_id) 
                VALUES (:cantidad, :descripcion, :valor_unitario, :subtotal, :factura_id)";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':valor_unitario', $valor_unitario);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':factura_id', $factura_id);
        $cantidad = $data['cantidad'];
        $descripcion = $data['descripcion'];
        $valor_unitario = $data['valor_unitario'];
        $subtotal = $cantidad * $valor_unitario;
        $factura_id = $factura->id;
        $stmt->execute();

        $file_db = null;
        return $factura->id;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function agregarFactura($data, $id)
{
    try {
        $totalPrev = 0;
        $productos = getProductosFactura($id);
        if ($productos) {
            foreach ($productos as $producto) {
                $totalPrev += $producto['subtotal'];
            }
        }
        $impuestosPrev = $totalPrev * 0.13;

        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $numero = $data['numero'];
        $fecha = $data['fecha'];
        $cliente = $data['cliente'];
        $impuestos = $impuestosPrev;
        $monto_total = $impuestosPrev + $totalPrev;
        $update = "UPDATE facturas set numero = '{$numero}', fecha = '{$fecha}', cliente = '{$cliente}', 
                    impuestos = {$impuestos} , monto_total = {$monto_total} WHERE id = '" . $id . "'";
        $stmt = $file_db->prepare($update);
        $stmt->execute();

        $file_db = null;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function agregarProducto($data, $id)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $insert = "INSERT INTO productos (cantidad, descripcion, valor_unitario, subtotal, factura_id) 
                VALUES (:cantidad, :descripcion, :valor_unitario, :subtotal, :factura_id)";
        $stmt = $file_db->prepare($insert);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':valor_unitario', $valor_unitario);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':factura_id', $factura_id);
        $cantidad = $data['cantidad'];
        $descripcion = $data['descripcion'];
        $valor_unitario = $data['valor_unitario'];
        $subtotal = $cantidad * $valor_unitario;
        $factura_id = $id;
        $stmt->execute();


        $file_db = null;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function borrarProducto($data)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $delete = "DELETE FROM productos where id = '" . $data['producto_id'] . "'";
        $stmt = $file_db->prepare($delete);
        $stmt->execute();

        $file_db = null;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function borrarFactura($id)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $delete = "DELETE FROM productos where factura_id = '" . $id . "'";
        $stmt = $file_db->prepare($delete);
        $stmt->execute();

        $delete = "DELETE FROM facturas where id = '" . $id . "'";
        $stmt = $file_db->prepare($delete);
        $stmt->execute();

        $file_db = null;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function getProductosFactura($id)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $select = "SELECT * FROM productos where factura_id = '" . $id . "'";
        $stmt = $file_db->prepare($select);
        $stmt->execute();
        $productos = $stmt->fetchAll();

        $file_db = null;
        return $productos;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function getInfoFactura($id)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        $totalPrev = 0;
        $productos = getProductosFactura($id);

        if ($productos) {
            foreach ($productos as $producto) {
                $totalPrev += $producto['subtotal'];
            }
        }
        $impuestosPrev = $totalPrev * 0.13;
        $total = $totalPrev + $impuestosPrev;

        $update = "UPDATE facturas set impuestos = {$impuestosPrev} , monto_total = {$total} WHERE id = '" . $id . "'";
        $stmt = $file_db->prepare($update);
        $stmt->execute();

        $select = "SELECT * FROM facturas where id = '" . $id . "'";
        $stmt = $file_db->prepare($select);
        $stmt->execute();
        $factura = $stmt->fetchObject();

        $file_db = null;
        return $factura;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function getFacturas($id)
{
    try {
        $file_db = new PDO('sqlite:tarea4.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);

        if (!$id)
            $select = "SELECT * FROM facturas";
        else
            $select = "SELECT * FROM facturas WHERE id != '" . $id . "'";

        $stmt = $file_db->prepare($select);
        $stmt->execute();
        $factura = $stmt->fetchAll();

        $file_db = null;
        return $factura;
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function random($length = 8)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

?>

<div class="container">
    <h2>Facturación</h2>
    <div class="row">
        <div class="col-sm-4">
            <form action="facturacion.php" method="post"
                  style="border: black solid 1px; overflow: hidden;  background: cornsilk">

                <?php
                foreach ($facturas as $fact) {
                    if ($fact) {
                        echo '
                            <div class="contact">
                                <input type="radio" name="factura_id" value="' . $fact['id'] . '">
                                <span style="width: 70px;display: inline-block;">' . $fact['numero'] . '</span>
                                <span style="border-left: black solid 1px; padding: 1%">' . $fact['cliente'] . '</span>
                            </div>
                            <br>';
                    }
                }
                unset($fact);
                ?>

                <input type="hidden" name="tipo" value="mostrarFactura"> </input>
                <div class="form-group">
                    <button style="float: right; margin: 1%" type="submit" class="btn btn-success">Editar</button>
                </div>
            </form>
            <h6 style="
    background-color: aliceblue;
    border: green solid 1px;
    padding: 1%;
    color: green;">Seleccione una factura y presione "Editar"</h6>
        </div>
        <div class="col-sm-8">
            <form action="facturacion.php" class="contact-edit row"
                  method="post" id="contacto">

                <div class="form-group col-sm-12">
                    <input type="hidden" name="tipo" value="agregarFactura"/>
                    <input type="hidden" name="id" value="<?php echo $factura->id ?>"/>
                    <button style="float: right" type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <div class="form-group col-sm-6">
                    <label for="numero">Numero</label>
                    <input maxlength="30" type="text" class="form-control" name="numero" id="numero"
                           value="<?php echo $factura->numero ?>">
                </div>
                <div class="form-group col-sm-6">
                    <label for="fecha">Fecha</label>
                    <input maxlength="30" type="date" class="form-control" name="fecha" id="fecha"
                           value="<?php echo $factura->fecha ?>">
                </div>
                <div class="form-group col-sm-12">
                    <label for="cliente">Cliente</label>
                    <input maxlength="30" type="text" class="form-control" name="cliente" id="cliente"
                           value="<?php echo $factura->cliente ?>">
                </div>
            </form>

            <table class="tg" style="width: 100%">
                <tr>
                    <th width="210" class="tg-yw4l">
                        Qty
                    </th>
                    <th width="250" class="tg-yw4l">
                        Descripción
                    </th>
                    <th width="270" class="tg-yw4l">
                        Valor unitario
                    </th>
                    <th width="200" class="tg-yw4l">
                        Subtotal
                    </th>
                    <th class="tg-yw4l">
                        Operación
                    </th>
                </tr>

                <?php
                foreach ($productos as $key => $producto) {
                    echo '<tr>
                              <td> ' . $producto['cantidad'] . '</td>
                              <td> ' . $producto['descripcion'] . '</td>
                              <td> ' . $producto['valor_unitario'] . '</td>
                              <td> ' . $producto['subtotal'] . '</td>
                              <td> 
                                <form action="facturacion.php" method="post">
                                    <input type="hidden" name="tipo" value="borrarProducto" />
                                    <input type="hidden" name="producto_id" value="' . $producto['id'] . '"/>
                                    <button type="submit" class="btn btn-default">Borrar</button>
                                </form>
                              </td>
                                </tr>';
                }
                ?>

                <tr>
                    <td class="tg-yw4l" colspan="5">
                        <form action="facturacion.php" class="row" method="post">
                            <input type="hidden" name="tipo" value="agregarProducto"> </input>
                            <div class="form-group col-sm-2">
                                <input placeholder="Cant." type="number" class="form-control" name="cantidad">
                            </div>

                            <div class="form-group col-sm-3">
                                <input placeholder="Descripción" type="text" class="form-control" name="descripcion">
                            </div>

                            <div class="form-group col-sm-3">
                                <input placeholder="Valor unitario" type="number" class="form-control"
                                       name="valor_unitario">
                            </div>

                            <div class="form-group col-sm-2">

                            </div>

                            <div class="form-group col-sm-2">
                                <button type="submit" class="btn btn-default">Agregar</button>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>

            <div class="row">
                <div class="col-sm-6">
                    <strong>Impuestos: </strong> <?php echo $impuestos; ?>
                </div>
                <div class="col-sm-6">
                    <strong>Total: </strong> <?php echo $total; ?>
                </div>
            </div>

            <?php if ($_SESSION['id']): ?>
                <div class="row" style="margin-top: 10px; margin-bottom: 15px">
                    <form action="facturacion.php" class="col-sm-6"
                          method="post">
                        <div class="form-group">
                            <input type="hidden" name="tipo" value="borrar"/>
                            <button style="float: left" type="submit" class="btn btn-danger">Borrar</button>
                        </div>
                    </form>
                    <form style="overflow: hidden" action="facturacion.php" class="col-sm-6"
                          method="post">
                        <div class="form-group">
                            <input type="hidden" name="tipo" value="cancelar"/>
                            <button style="float: right" type="submit" class="btn btn-danger">Cancelar</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>




