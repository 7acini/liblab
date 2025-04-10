<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="images/art.png">
    <title>Menu Principal</title>
    <script src="js/TopResponsivo.js"></script>
</head>
<body class="alfa">

    <div class="topnav" id="myTopnav">
        <a href="index.php" class="active"><i><b>LIB-LAB</b></i></a>
        <a href="sair.php" id="sair" class="right">Sair</a>
        <a href="conteudo.php" class="right">Conteúdo</a>
        <a href="javascript:void(0);" class="icon" onclick="topResp()">
            <img src="images/menu.png" class="icomenu" alt="menu">
        </a>
    </div>

    <div class="conteudo">
        <h1>Menu Principal - Bem-vindo, <?= htmlspecialchars($nome) ?></h1>

        <?php
        for ($i = 1; $i <= 10; $i++) {
            if ($niv >= $i) {
                echo "
                <button class='accordion' id='mod{$i}'>Nível {$i}</button>
                <div class='panel'>
                    <br><a href='libras1.php'><button class='btNiv'>Começar</button></a><br>
                </div>
                <br><br>";
            }
        }
        ?>
    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
        for (let i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>

</body>
</html>
