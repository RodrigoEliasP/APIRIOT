<?php
if(empty($_GET['Usuário'])){
    header('location: index.php');
}else{
    $user =$_GET['Usuário'];
}
require_once("config/key.php");
require_once("Classes/Usuario.php");
$teste = new Usuario($user);

/*
 * 1 = ID
 * 2 = nome
 * 3 = puuid
 * 4 = idicone
 * 5 = id conta
 * 6 = level
 * 7 = elo flex
 * 8 = rank flex
 * 9 = elo solo
 * 10 = rank solo
 * */
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="CSS/Styles.css" >
    <link rel="stylesheet" type="text/css" href="path/to/chartjs/dist/Chart.min.css">
  </head>
  <body class="body2">
    <div class="User-card">
        <img class="User-img" src="http://ddragon.leagueoflegends.com/cdn/10.5.1/img/profileicon/<?=$teste->getITEMS(4)?>.png">
        <div class="User-Info">
            <h2 style="font-size: 30px;" class="Centertext"><?=$teste->getITEMS(2)?></h2>
            <div class="User-Ranking">
                <div class="User-solo">
                    <h2 style="font-size: 20px;" class="Centertext">SOLOQ</h2>
                    <img class="League-img" src="CSS/images/Tier/<?php if($teste->getITEMS(9)!=null){echo $teste->getITEMS(9);}else{ echo "UNRANKED";}?>.png">
                    <h2 style="font-size: 20px;" class="Centertext"><?php if($teste->getITEMS(9)!=null){echo $teste->getITEMS(9) . "\n" . $teste->getITEMS(10);}else{echo "UNRANKED";}?></h2>
                </div>
                <div class="User-flex">
                    <h2 style="font-size: 20px;" class="Centertext">FLEX</h2>
                    <img class="League-img" src="CSS/images/Tier/<?php if($teste->getITEMS(7)!=null){echo($teste->getITEMS(7));}else{ echo ("UNRANKED");}?>.png">
                    <h2 style="font-size: 20px;" class="Centertext"><?php if($teste->getITEMS(7)!=null){echo $teste->getITEMS(7) . "\n" . $teste->getITEMS(8);}else{echo "UNRANKED";}?></h2>
                </div>
            </div>
        </div>

    </div>
    <div class="User-Winrate">
        <div class="tab">
            <button class="tablinks" onclick="queue(event, 'Solo')">Solo</button>
            <button class="tablinks" onclick="queue(event, 'Flex')">Flex</button>
        </div>
        <?php if($teste->getITEMS(14) != null):?>
        <div id="Solo" class="tabcontent">
            <h3 style="color: white;">Winrate SoloQueue <?php echo $teste->getITEMS(14)."%"?> / Jogadas <?= $teste->getITEMS(15)?></h3>
            <div class="container-porcentagem">
                <div style="width: <?=$teste->getITEMS(14)?>%;" class="porcentagem"></div>
            </div>
        </div>
        <?php else:?>
        <div id="Solo" class="tabcontent">
            <h3 style="color: white;">Unranked SoloQueue</h3>

        </div>
        <?php endif;?>

        <?php if($teste->getITEMS(12) != null):?>
        <div id="Flex" class="tabcontent">
            <h3 style="color: white;">Winrate Flex <?php echo $teste->getITEMS(12)."%"?> / Jogadas <?= $teste->getITEMS(13)?></h3>
            <div class="container-porcentagem">
                <div style="width: <?=$teste->getITEMS(12)?>%;" class="porcentagem"></div>
            </div>
        </div>
    <?php else:?>
        <div id="Flex" class="tabcontent">
            <h3 style="color: white;">Unranked Flex</h3>
        </div>
    <?php endif;?>
    </div>
  </body>
  <script src="JS/JS.js"></script>
</html>
