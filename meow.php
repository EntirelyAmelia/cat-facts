<?php

const API = 'http://catfacts-api.appspot.com/api/facts';

prompt();

function prompt() {
    echo 'How many meows would you like? ';
    $input = fgets(STDIN);

    if (trim($input) == 'exit') {
        exit(0);
    }

    if ($num = filter_var($input, FILTER_VALIDATE_INT)) {
        if ($facts = getCatMeowArray($num)) {
            meow($facts);
        } else {
            echo "I don't want your love right meow. \n";
        }
    } else {
        echo "Don't be silly hooman, kittehs only know integers. \n";
    }

    prompt();
}

function getCatMeowArray($num = 1) {
    $request = API . '?number=' . $num;
    if ($raw = file_get_contents($request)) {
        if ($meows = json_decode($raw)) {
            if ($meows->success === 'true') {
                return $meows->facts;
            }
        }
    }

    return false;
}

function meow($facts) {
    echo "\n";

    $x = 1;
    foreach ($facts as $fact) {
        echo $x++ . '. ' . $fact . "\n\n";
    }

    echo "\n";
}
