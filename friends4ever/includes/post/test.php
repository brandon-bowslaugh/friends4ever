<?php

$temp = '{"meta": {"code": 200}, "data": [{"username": "datboizzzzzzzz", "profile_picture": "https://scontent-mad1-1.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg", "id": "4466481514", "full_name": "datboi"}]}';

$moreTemp = JSON_decode($temp, true);

echo var_dump($moreTemp["data"])

?>