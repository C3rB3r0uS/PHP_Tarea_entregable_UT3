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
                
                //echo "Prueba 1 <br/>";

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

//                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
//                $error = $dwes->connect_errno;
//
//                if ($error == null) {
//
//                    $tarjetasSIM = $dwes->query("SELECT numero_sim FROM tarjetas_telefonicas WHERE codigo_cliente_asociado = '$codCliente'");
//
//                    $dwes->close();
//                }
                
                echo "<h3>Lista de tarjetas SIM del cliente $codCliente</h3>";

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
                    
                    echo "<h3>Lista de llamadas realizadas por la tarjeta SIM $nroSIM</h3>";

                    $pdo = new PDO('mysql:host=localhost;dbname=telefonia', 'root', '');
                    $resultado = $pdo->query("SELECT numero_llamado FROM llamadas_emitidas WHERE sim_llamante='$nroSIM'");

                    while ($fila = $resultado->fetch()) {              
                        echo $fila['numero_llamado'] . "<br/>";
                    }
                }
            }

            if (isset($_POST['introCliente'])) {

                $codigo = $_POST['codcliente'];
                getTarjetasSIM($codigo);
            }

            if (isset($_POST['introSIM'])) {

                $numSIM = $_POST['numsim'];
                getNrosLlamados($numSIM);
            }
        }
        ?>

    </body>
</html>



