<?php

    // Continents to include
    $countries = array(
        'lesotho',
        'swaziland',
        'southafrica',
        'botswana',
        'namibia',
        'zimbabwe',
        'zambia',
        'tanzania',
        'kenya',
        'droc',
        'cameroon',
        'nigeria',
        'uganda',
        'senegal',
        'cote',
        'ghana',
        'gabon'
    );

    // Pull the SVG file created in illustrator, name each path according to a country below.
    $data = file_get_contents( realpath(__DIR__ . '/../') . '/assets/img/map.svg' );

    // Parse the SVG
    $svgElements = new SimpleXMLElement($data);

    // Open Json array
    $n = [];

    // Loop to find countries
    foreach ($svgElements as $element) {

        if(strtolower($element['id']) == 'countries'){
            foreach($element as $country){

                if ( in_array($country['id'], $countries )){
                    $n[] = $country['id'] . ': { path: \'' . $country['d'] . '\'}';
                }
            }
        }
    }

    $myfile = fopen(realpath(__DIR__ . '/../') . '/assets/js/paths.js', "w") or die("Unable to open file!");
    $txt = 'var TerritoryPathData = {' . PHP_EOL . implode(",".PHP_EOL, $n) . PHP_EOL . '}';
    fwrite($myfile, $txt);
    fclose($myfile);