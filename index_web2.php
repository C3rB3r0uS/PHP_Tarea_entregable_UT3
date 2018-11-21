<html>
    <head>
        <title>Consulta</title>
    </head>
    <body>

        <?php
        if (!$_POST) {

            include "formulario_web2.php";
        } else {

            include "formulario_web2.php";

            function codigoClienteExiste($codCliente) {
                
                echo "Prueba 1";

//                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
//                $error = $dwes->connect_errno;
//
//                if ($error == null) {
//
//                    $valorMaxClientes = $dwes->query("SELECT * FROM clientes WHERE codigo_cliente=$codCliente");
//
//                    if ($valorMaxClientes) {
//                        $existe = true;
//                    } else {
//                        $existe = false;
//                    }
//
//                    $dwes->close();
//                }
                
                $existe = false;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $resultado = $pdo->query("SELECT * FROM clientes WHERE codigo_cliente='$codCliente'");

                if ($resultado) {

                    $existe = true;
                }

                return $existe;
            }

            function numeroSimExiste($numeroSim) {
                
                echo "Prueba 2";

//                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
//                $error = $dwes->connect_errno;
//
//                if ($error == null) {
//
//                    $valorMaxClientes = $dwes->query("SELECT * FROM tarjetas_telefonicas WHERE numero_sim=$numeroSim");
//
//                    if ($valorMaxClientes) {
//                        $existe = true;
//                    } else {
//                        $existe = false;
//                    }
//
//                    $dwes->close();
//                }
                
                 $existe = false;

                $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                $resultado = $pdo->query("SELECT * FROM tarjetas_telefonicas WHERE numero_sim='$numeroSim'");

                if ($resultado) {

                    $existe = true;
                }

                return $existe;
            }

            function getTarjetasSIM($codCliente) {
                
                echo "Prueba 3";

//                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
//                $error = $dwes->connect_errno;
//
//                if ($error == null) {
//
//                    $tarjetasSIM = $dwes->query("SELECT numero_sim FROM tarjetas_telefonicas WHERE codigo_cliente_asociado = '$codCliente'");
//
//                    $dwes->close();
//                }

                if (codigoClienteExiste($codCliente) == true) {

                    $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                    $resultado = $pdo->query("SELECT numero_sim FROM tarjetas_telefonicas WHERE codigo_cliente_asociado = '$codCliente'");

                    while ($fila = $resultado->fetch()) {

                        echo $fila['numero_sim'] . "<br/>";
                    }
                    
                } else {

                    echo "No existe el código de cliente indicado";
                }
            }

            function getNrosLlamados($nroSIM) {
                
                echo "Prueba 4";

//                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
//                $error = $dwes->connect_errno;
//
//                if ($error == null) {
//
//                    $numerosLlamados = $dwes->query("SELECT numero_llamado FROM llamadas_emitidas WHERE sim_llamante='$nroSIM'");
//
//                    $dwes->close();
//                }

                if (numeroSimExiste($nroSIM) == true) {

                    $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                    $resultado = $pdo->query("SELECT numero_llamado FROM llamadas_emitidas WHERE sim_llamante='$nroSIM'");

                    while ($fila = $resultado->fetch()) {
                        echo sizeof($fila);

                        echo $fila['numero_llamado'] . "<br/>";
                    }
                }
            }

            if (isset($_POST['introCliente'])) {

                $codigo = $_POST['codcliente'];
                getTarjetasSIM($codigo);
            }

            if (isset($_POST['introSIM'])) {
                
                echo "Entro";

                $numSIM = $_POST['numsim'];
                getNrosLlamados($numSIM);
            }
        }
        ?>

    </body>
</html>



