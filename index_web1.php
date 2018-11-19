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

                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $valorMaxClientes = $dwes->query("SELECT MAX(CODIGO_CLIENTE)+1 from clientes");
                    $resultados = $valorMaxClientes->fetch_array();
                    $valor = $resultados[0];
                    $dwes->close();
                }

                return $valor;
            }

            function getValorMaxCodSIMs() {

                $valor = 0;

                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $valorMaxClientes = $dwes->query("SELECT MAX(numero_sim)+1 FROM tarjetas_telefonicas");
                    $resultados = $valorMaxClientes->fetch_array();
                    $valor = $resultados[0];
                    $dwes->close();
                }

                return $valor;
            }

            function getValorMaxCodLlamadas() {

                $valor = 0;

                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $valorMaxClientes = $dwes->query("SELECT MAX(codigo_llamada)+1 FROM llamadas_emitidas");
                    $resultados = $valorMaxClientes->fetch_array();
                    $valor = $resultados[0];
                    $dwes->close();
                }

                return $valor;
            }

            function codigoClienteExiste($codCliente) {

                $existe = false;

                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $valorMaxClientes = $dwes->query("SELECT * FROM clientes WHERE codigo_cliente=$codCliente");

                    if ($valorMaxClientes) {
                        $existe = true;
                    } else {
                        $existe = false;
                    }

                    $dwes->close();
                }

                return $existe;
            }

            function numeroSimExiste($numeroSim) {

                $existe = false;

                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $valorMaxClientes = $dwes->query("SELECT * FROM tarjetas_telefonicas WHERE numero_sim=$numeroSim");

                    if ($valorMaxClientes) {
                        $existe = true;
                    } else {
                        $existe = false;
                    }

                    $dwes->close();
                }

                return $existe;
            }

            if (isset($_POST['introCliente'])) {

                if (!empty($_POST['nombrecliente']) && !empty($_POST['dnicliente'])) {

                    $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                    $error = $dwes->connect_errno;

                    if ($error == null) {

                        $codigoCliente = getValorMaxCodCliente();
                        $nombreCliente = $_POST['nombrecliente'];
                        $dniCliente = $_POST['dnicliente'];

                        $insertCliente = $dwes->query("INSERT INTO clientes VALUES ('$codigoCliente','$nombreCliente','$dniCliente')");

                        $dwes->close();
                    }
                }
            }

            if (isset($_POST['introTarjeta'])) {

                if (!empty($_POST['codcliente'])) {

                    $codClienteAsociado = $_POST['codcliente'];

                    if (codigoClienteExiste($codClienteAsociado) == true) {

                        $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                        $error = $dwes->connect_errno;

                        if ($error == null) {

                            $numeroSIM = getValorMaxCodSIMs();
                            $insertCliente = $dwes->query("INSERT INTO tarjetas_telefonicas VALUES ('$numeroSIM','$codClienteAsociado')");

                            $dwes->close();
                        }
                    }
                }
            }
        }

        if (isset($_POST['introLlamada'])) {

            if (!empty($_POST['simllamante']) && !empty($_POST['numllamado']) && !empty($_POST['durllamada']) && !empty($_POST['costllamada'])) {

                $simLlamante = $_POST['simllamante'];

                if (numeroSimExiste($simLlamante) == true) {

                    $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                    $error = $dwes->connect_errno;

                    if ($error == null) {

                        $codLlamada = getValorMaxCodLlamadas();
                        $numLlamado = $_POST['numllamado'];
                        $durLlamada = $_POST['durllamada'];
                        $costLlamada = $_POST['costllamada'];

                        $insertCliente = $dwes->query("INSERT INTO llamadas_emitidas VALUES ('$codLlamada','$simLlamante','$numLlamado','$durLlamada','$costLlamada')");
                         //echo "Se ha realizado la query: " . "$dwes->affected_rows";
                        $dwes->close();
                    }
                }
            }
        }
        ?>

    </body>
</html>


