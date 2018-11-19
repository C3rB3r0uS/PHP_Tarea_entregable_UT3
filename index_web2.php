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

            function getTarjetasSIM($codCliente) {

                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $tarjetasSIM = $dwes->query("SELECT numero_sim FROM tarjetas_telefonicas WHERE codigo_cliente_asociado = '$codCliente'");

                    $dwes->close();
                }
            }
            
            function getNrosLlamados($nroSIM){
                
                $dwes = new mysqli('localhost', 'root', '', 'telefonia');
                $error = $dwes->connect_errno;

                if ($error == null) {

                    $numerosLlamados = $dwes->query("SELECT numero_llamado FROM llamadas_emitidas WHERE sim_llamante='$nroSIM'");

                    $dwes->close();
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



