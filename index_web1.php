<html>
    <head>
        <title>Web inserción</title>
    </head>
    <body>

        <?php
        if (!$_POST) {

            include "formulario_web1.php";
        } else {

            include "formulario_web1.php";

            function getValorMaxCodCliente() {

                $valor = 0;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $resultado = $pdo->query("SELECT MAX(CODIGO_CLIENTE)+1 from clientes");

                    while ($fila = $resultado->fetch()) {

                        $valor = $fila[0];
                    }
                } catch (PDOException $ex) {

                    echo "Error " . $ex->getMessage() . "</br>";
                }

                return $valor;
            }

            function getValorMaxCodSIMs() {

                $valor = 0;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $resultado = $pdo->query("SELECT MAX(numero_sim)+1 FROM tarjetas_telefonicas");

                    while ($fila = $resultado->fetch()) {

                        $valor = $fila[0];
                    }
                } catch (PDOException $ex) {


                    echo "Error " . $ex->getMessage() . "</br>";
                }

                return $valor;
            }

            function getValorMaxCodLlamadas() {

                $valor = 0;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $resultado = $pdo->query("SELECT MAX(codigo_llamada)+1 FROM llamadas_emitidas");

                    while ($fila = $resultado->fetch()) {

                        $valor = $fila[0];
                    }
                } catch (PDOException $ex) {

                    echo "Error " . $ex->getMessage() . "</br>";
                }

                return $valor;
            }

            function codigoClienteExiste($codCliente) {

                $existe = false;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $resultado = $pdo->query("SELECT * FROM clientes WHERE codigo_cliente=$codCliente");

                    if ($resultado) {
                        $existe = true;
                    }
                } catch (Exception $ex) {

                    echo "Error " . $ex->getMessage() . "</br>";
                }

                return $existe;
            }

            function numeroSimExiste($numeroSim) {

                $existe = false;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $resultado = $pdo->query("SELECT * FROM tarjetas_telefonicas WHERE numero_sim=$numeroSim");

                    if ($resultado) {
                        $existe = true;
                    }
                } catch (Exception $ex) {

                    echo "Error " . $ex->getMessage() . "</br>";
                }

                return $existe;
            }

            if (isset($_POST['introCliente'])) {

                if (!empty($_POST['nombrecliente']) && !empty($_POST['dnicliente'])) {

                    $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $codigoCliente = getValorMaxCodCliente();
                    $nombreCliente = $_POST['nombrecliente'];
                    $dniCliente = $_POST['dnicliente'];

                    try {

                        $insertCliente = $pdo->exec("INSERT INTO clientes VALUES ('$codigoCliente','$nombreCliente','$dniCliente')");
                        
                    } catch (Exception $ex) {

                        echo "Error " . $ex->getMessage() . "</br>";
                    }
                }
            }

            if (isset($_POST['introTarjeta'])) {

                if (!empty($_POST['codcliente'])) {

                    $codClienteAsociado = $_POST['codcliente'];

                    $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $numeroSIM = getValorMaxCodSIMs();

                    try {

                        $insertTarjeta = $pdo->exec("INSERT INTO tarjetas_telefonicas VALUES ('$numeroSIM','$codClienteAsociado')");
                        
                    } catch (Exception $ex) {

                        echo "Error " . $ex->getMessage() . "</br>";
                    }
                }
            }
        }

        if (isset($_POST['introLlamada'])) {

            if (!empty($_POST['simllamante']) && !empty($_POST['numllamado']) && !empty($_POST['durllamada']) && !empty($_POST['costllamada'])) {

                $codLlamada = getValorMaxCodLlamadas();
                $simLlamante = $_POST['simllamante'];
                $numLlamado = $_POST['numllamado'];
                $durLlamada = $_POST['durllamada'];
                $costLlamada = $_POST['costllamada'];

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try {

                    $insertarLlamada = $pdo->exec("INSERT INTO llamadas_emitidas VALUES ('$codLlamada','$simLlamante','$numLlamado','$durLlamada','$costLlamada')");
                    
                } catch (Exception $ex) {

                    echo "Error " . $ex->getMessage() . "</br>";
                }
            }
        }
        ?>

    </body>
</html>


