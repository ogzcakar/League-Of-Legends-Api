<?php
include "layout/header.php";

    $id = $_GET['id'];

    $decode = curlFunc("http://ddragon.leagueoflegends.com/cdn/6.21.1/data/tr_TR/champion/$id.json")[0];

    foreach ($decode['data'] as $champion) {
        echo "
             <div id ='leftColumn'>
                <h3>$champion[name]</h3>
                <img src='http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$champion[id]_0.jpg' alt='$champion[name]' title='$champion[name]' />
                <h3>$champion[title]</h3>
            </div>

            <div id ='rightColumn'>
                <h3>Hikaye</h3>
                <span>$champion[lore]</span>
            </div>
            ";

        echo "<div class='clear'> </div> <div class='wall'>";

        $i=0;
        foreach ($champion['skins'] as $skin) {
                echo"
                    <div class='data'>
                        <img src='http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$champion[id]_$i.jpg' alt='$champion[name]' title='$champion[name]' />
                         <h3>$skin[name]</h3>
                    </div>
                    ";
                $i++;
            }

        echo "</div> <div class='clear'> </div> <ul class='tags'>";

        foreach ($champion['tags'] as $Tag)
        {
            echo "<li> $Tag </li>";
        }

        echo "</ul>";
        
    }

include "layout/footer.php";
?>
