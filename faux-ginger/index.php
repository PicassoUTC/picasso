<?php
/*
 *  Copyright (C) 2013 payutc <payutc@assos.utc.fr>
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require("users.php");

// Parse l'url
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$actions = explode('/', $path);

// On cherche index.php et on ne garde que ce qu'il y a après
$first = array_search("index.php", $actions) + 1;
$actions = array_slice($actions, $first);

if($actions[0] != "v1"){
    die("Version non supportée");
}

if(empty($_GET["key"]) || $_GET["key"] != "fauxginger"){
    die("Clé invalide (la clé est 'fauxginger')");
}

if(empty($actions[1])){
    die("Pas d'action");
}

if($actions[1] == "find" || $actions[1] == "cotisations" || (!empty($actions[1]) && !empty($actions[2]) && $actions[2] == "cotisations")){
    die("Action non implémentée");
}

if($actions[1] == "badge" && !empty($actions[2])){
    $user = Users::getByBadge($actions[2]);
}
else if(!empty($actions[1])){
    $user = Users::getByLogin($actions[1]);
}

if($user != null){
    echo json_encode($user);        
}
else {
    header("HTTP/1.0 404 Not Found");
}
