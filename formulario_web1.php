<html>
    <head>
        <title>Web inserción en tablas</title>
    </head>
    <body>

        <h1>WEB DE INSERCIÓN EN TABLAS</h1>

        <form action = "<?= $_SERVER["PHP_SELF"] ?>" method="POST">

            <h3>Insertar cliente</h3>    
    
            Nombre cliente: <input type="text" name="nombrecliente" value="" />
            <br>
            DNI cliente: <input type="text" name="dnicliente" value="" />
            <br>
            <input type="submit" name="introCliente" value="INTRO" />

        </form>

        <form action = "<?= $_SERVER["PHP_SELF"] ?>" method="POST">

            <h3>Insertar tarjeta telefónica</h3>

            Código de cliente asociado: <input type="text" name="codcliente" value="" />
            <br>
            <input type="submit" name="introTarjeta" value="INTRO" />

        </form>

        <form action = "<?= $_SERVER["PHP_SELF"] ?>" method="POST">

            <h3>Insertar llamada emitida</h3>

            SIM llamante: <input type="text" name="simllamante" value="" />
            <br>
            Número llamado: <input type="text" name="numllamado" value="" />
            <br>
            Duración llamada: <input type="text" name="durllamada" value="" />
            <br>
            Importe llamada: <input type="text" name="costllamada" value="" />
            <br>
            <input type="submit" name="introLlamada" value="INTRO" />

        </form>

    </body>
</html>


