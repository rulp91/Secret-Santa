<?php
/**
 * Implementación de un controlador frontal que servirá de punto de entrada a la aplicación
 * User: Raul
 * Date: 15/08/2017
 * Time: 9:20
 */

use SecretSanta\Controllers\GameController;

$loader = require __DIR__ . '/vendor/autoload.php';

$results = GameController::getInstance()->play();

$gamers = array();
$giftReceivers = array();
foreach ($results as $pair) {
    $gamers[] = $pair->getGamer();
    $giftReceivers[] = $pair->getGiftReceiver();
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basic Form</title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">
    <script src="assets/jquery-3.2.1.min.js"></script>
</head>

<body>

<header>
    <h1>El amigo invisible en la familia P&eacute;rez</h1>
</header>

<div class="main-content">

    <form class="form-basic" method="post" action="#" id="formBasic">
        <div class="form-title-row">
            <h1>Selecciona tu nombre en el desplegable y veras a quien te toca regalarle</h1>
        </div>

<!--        <div class="inline">-->
<!--            <select id="selectGamer">-->
<!--                <option value="-1">......Seleccione.....</option>-->
<!--                --><?php
//                $i = 0;
//                foreach ($gamers as $gamer) {
//                    ?>
<!--                    <option value="--><?php //echo $i; ?><!--">--><?php //echo $gamer; ?><!--</option>-->
<!--                    --><?php
//                    $i++;
//                }
//                ?>
<!--            </select>-->
<!--        </div>-->
<!--        <div class="inline">-->
<!--            <span id="showGiftReceiver"></span>-->
<!--        </div>-->
<!--        <br class="clearBoth"/>-->
<!---->
<!--        <br/>-->
<!--        <button id="cleanResult">Pulsa para limpiar el resultado</button>-->

        <br/>
        <button id="printResult">Pulsa para imprimir el resultado</button>

        <br/>
        <div style="display: none" id="result">
            <?php
            foreach ($results as $pair) {
                ?>
                <p><?php echo $pair; ?></p>
                <?php
            }
            ?>
        </div>
    </form>
</div>

</body>
<script type="application/javascript">
    <?php
    echo 'var gamers = ' . json_encode($giftReceivers) . ';' . "\n";
    echo 'var giftReceiver = ' . json_encode($giftReceivers) . ';' . "\n";
    ?>
    $('#selectGamer').on('change', function () {
        $('#showGiftReceiver').html(gamers[this.value]);
    })

    $('#cleanResult').on('click', function () {
        $('#showGiftReceiver').html('');
        $('#selectGamer').val(-1);
    })

    $('#printResult').on('click', function () {
        $('#result').toggle();
    })

    $( "#formBasic" ).submit(function( event ) {
        event.preventDefault();
    });

</script>
</html>
