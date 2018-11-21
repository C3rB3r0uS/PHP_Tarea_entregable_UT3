<html>
    <head>
        <title>Formulario</title>
    </head>
    <body>

        <h1>Consulta de tarjetas SIMs</h1>          

        <form action= "<?= $_SERVER["PHP_SELF"] ?>" method="POST">

            Código cliente: <input type="text" name="codcliente" value="" />
            <input type="submit" name="introCliente" value="Intro" />
  
        <h1>Consulta de llamadas</h1>
   
            Número SIM: <input type="text" name="numsim" value="" />
            <input type="submit" name=introSIM"" value="Intro" />
            
        </form>

    </body>
</html>


