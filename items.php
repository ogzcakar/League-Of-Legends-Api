<?php
include "layout/header.php";

    echo "<div class='wall'>";

    $decode = curlFunc("http://ddragon.leagueoflegends.com/cdn/6.21.1/data/tr_TR/item.json")[0];

    foreach ($decode['data'] as $item) {
        $image = $item['image']['full'];
        echo "
             <div class='data' align='center'>
                <img src='http://ddragon.leagueoflegends.com/cdn/6.21.1/img/item/$image' alt='$item[name]' title='$item[name]' style='width: 64px;' />
                <h3>$item[name]</h3>
                <h6>$item[description]</h6>
            </div>
            ";
    }

    echo "</div>";

include "layout/footer.php";
?>
