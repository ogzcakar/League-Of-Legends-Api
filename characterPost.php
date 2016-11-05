<?php
include "layout/header.php";

    $characterName = strtolower($_POST['characterName']);
    $season = $_POST['season'];
    $server = $_POST['server'];

    $character = curlFunc("https://$server.api.pvp.net/api/lol/$server/v1.4/summoner/by-name/$characterName?api_key=$apiKey")[1];
    if ($character == 404) {
        echo "<span> Oyuncu Bulunamadı </span>";
    }else
    {
        $character = curlFunc("https://$server.api.pvp.net/api/lol/$server/v1.4/summoner/by-name/$characterName?api_key=$apiKey")[0];
        $characterId = $character[$characterName]['id'];
        $characterIcon = $character[$characterName]['profileIconId'];
        $characterLevel = $character[$characterName]['summonerLevel'];

        $team = curlFunc("https://$server.api.pvp.net/api/lol/$server/v2.4/team/by-summoner/$characterId?api_key=$apiKey")[1];
        if ($team == 404) {
            $teamName = "Takım yok";
        }else{
            $team = curlFunc("https://$server.api.pvp.net/api/lol/$server/v2.4/team/by-summoner/$characterId?api_key=$apiKey")[0];
            foreach ($team[$characterId] as $name) {
                $teamName =$name['name'];
            }
        }

        echo"
            <div id ='leftColumn'>
                <h3>$characterName <span>($characterId)</span></h3>
                <img src='http://ddragon.leagueoflegends.com/cdn/6.21.1/img/profileicon/$characterIcon.png' alt='$characterName' title='$characterName' />
                <h3>Level : <span>$characterLevel</span></h3>
                <h3>Takım : <span>$teamName</span></h3>
            </div>
            ";



        echo"
            <div id='rightColumn'>
                <h3>Canlı Maç</h3>
            ";
            $serverCurrent = $server."1";
            $currentGame = curlFunc("https://$server.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$serverCurrent/$characterId?api_key=$apiKey")[1];
            if ($currentGame == 404) {
                echo "<span>Canlı maç bulunmamaktadır.</span>";
            }else{
                $currentGame = curlFunc("https://$server.api.pvp.net/observer-mode/rest/consumer/getSpectatorGameInfo/$serverCurrent/$characterId?api_key=$apiKey")[0];
                echo"
                        <h3>Oyun Modu : <span>$currentGame[gameMode]</span></h3>
                        <ul class='team'>
                    ";

                    foreach ($currentGame['participants'] as $participants) {
                        if($participants['teamId'] == 100) {
                        echo"
                            <li class='redTeam'>
                                <span> $participants[summonerName] </span>
                            </li>
                             ";
                        }else{
                        echo"
                            <li class='greenTeam'>
                                <span> $participants[summonerName] </span>
                            </li>
                            ";
                        }
                    }
            }

        echo "</ul> </div> <div class='clear'> </div> <div class='wall'>";

        $statsGet = curlFunc("https://$server.api.pvp.net/api/lol/$server/v1.3/stats/by-summoner/$characterId/summary?season=$season&api_key=$apiKey")[1];
        if ($statsGet == 200) {
            $statsGet = curlFunc("https://$server.api.pvp.net/api/lol/$server/v1.3/stats/by-summoner/$characterId/summary?season=$season&api_key=$apiKey")[0];
            foreach ($statsGet['playerStatSummaries'] as $stats) {
                $totalChampionKills = $stats['aggregatedStats']['totalChampionKills'];
                $totalMinionKills = $stats['aggregatedStats']['totalMinionKills'];
                $totalAssists = $stats['aggregatedStats']['totalAssists'];

                echo"
                <div class ='data'>
                    <h3>Oyun Modu : <span> $stats[playerStatSummaryType] </span> </h3>
                    <h3>Toplam Kazanma : <span> $stats[wins] </span> </h3>
                    <h3>Toplam Şampiyon Öldürme : <span> $totalChampionKills </span> </h3>
                    <h3>Toplam Minyon Öldürme : <span> $totalMinionKills </span> </h3>
                    <h3>Toplam Asist : <span> $totalAssists </span> </h3>
                </div>
                ";
            }
        }



        echo "</div>";

    }

include "layout/footer.php";
?>
