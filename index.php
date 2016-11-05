<?php
include "layout/header.php";

    echo "<div class='wall'>";

    $decode = curlFunc("http://ddragon.leagueoflegends.com/cdn/6.21.1/data/tr_TR/champion.json")[0];

    foreach ($decode['data'] as $champion) {
        echo "
             <a class='data' href='champion/$champion[id]'>
                <img src='http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$champion[id]_0.jpg' alt='$champion[name]' title='$champion[name]' />
                 <h3>$champion[name]</h3>
            </a>
            ";
    }

    echo "</div>";

include "layout/footer.php";
?>
