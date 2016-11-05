<?php
include "layout/header.php";

    echo"
        <form action='characterPost' method='post'>
            <input type='text' id='characterName' name='characterName' placeholder='Karakter Adı' />
            <select name='season' id='season'>
                <option value='SEASON2016'>Sezon 2016</option>
                <option value='SEASON2015'>Sezon 2015</option>
                <option value='SEASON2014'>Sezon 2014</option>
            </select>
            <select name='server' id='server'>
                <option value='TR'>Tr</option>
                <option value='EUNE'>Eune</option>
                <option value='EUW'>Euw</option>
            </select>
            <input type='submit' value='Sorgula' />
        </form>
        ";

include "layout/footer.php";
?>
