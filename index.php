<?php

$url = 'https://geodata.tampere.fi/geoserver/liikennealueet/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=liikennealueet%3Apysakointi_pysakointipaikat_polygon_gk24&outputFormat=application%2Fjson';

$json = file_get_contents($url);
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON error: ' . json_last_error_msg());
}

$features = $data['features'];

// Suodatetaan pois rivit, joissa osoite on null, tyhjä tai '-'
$filteredFeatures = array_filter($features, function ($feature) {
    $address = $feature['properties']['osoite'];
    return !empty($address) && $address !== '-';
});

// Yhdistetään samankaltaiset rivit
$combinedFeatures = [];
foreach ($filteredFeatures as $feature) {
    $properties = $feature['properties'];
    $key = $properties['osoite'] . '|' . $properties['rajoitustyyppi'] . '|' . $properties['suurin_sallittu_pysakointiaika'];

    if (!isset($combinedFeatures[$key])) {
        $combinedFeatures[$key] = $properties;
        $combinedFeatures[$key]['paikkamaara'] = (int)$properties['paikkamaara'];
    } else {
        $combinedFeatures[$key]['paikkamaara'] += (int)$properties['paikkamaara'];
    }
}

// Lajitellaan osoitteen mukaan aakkosjärjestykseen
usort($combinedFeatures, function ($a, $b) {
    return strcasecmp($a['osoite'], $b['osoite']);
});

echo '<!DOCTYPE html>';
echo '<html lang="fi">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Pysäköintipaikat</title>';
echo '<style>';
echo 'table { width: 100%; border-collapse: collapse; }';
echo 'th, td { border: 1px solid #000; padding: 0.5em; }';
echo 'th { background-color: #f0f0f0; }';
echo 'th[scope="col"] { background-color: #e0e0e0; }';
echo 'th[scope="row"] { background-color: #d0d0d0; text-align: left; }';
echo 'caption { font-weight: bold; font-size: 1.2em; margin-bottom: 0.5em; }';
echo '.sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); border: 0; }';
echo '</style>';
echo '</head>';
echo '<body>';
echo '<h1>Pysäköintipaikat</h1>';

echo '<hr>';

echo '<table lang="fi">';
echo '<caption>Tampereen pysäköintialueet ja -laitokset</caption>';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Osoite</th>';
echo '<th scope="col">Alueen tyyppi</th>';
echo '<th scope="col">Paikkoja</th>';
echo '<th scope="col">Pysäköintirajoitus</th>';
echo '<th scope="col">Maksuvyöhyke</th>';
echo '<th scope="col">Pisin sallittu aika</th>';
echo '<th scope="col">Lisätietoa</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($combinedFeatures as $properties) {
    echo '<tr>';
    echo '<th scope="row">' . htmlspecialchars($properties['osoite']) . '</th>';
    echo '<td>' . htmlspecialchars($properties['kohteen_tyyppi'] ?? '-') . '</td>';
    echo '<td>' . htmlspecialchars($properties['paikkamaara'] ?? '-') . '</td>';
    echo '<td>' . htmlspecialchars($properties['rajoitustyyppi'] ?? '-') . '</td>';
    echo '<td>' . htmlspecialchars($properties['maksuvyohyke'] ?? '-') . '</td>';
    echo '<td>' . htmlspecialchars($properties['suurin_sallittu_pysakointiaika'] ?? '-') . '</td>';
    echo '<td>';
    if (!empty($properties['lisatietoa']) && filter_var($properties['lisatietoa'], FILTER_VALIDATE_URL)) {
        echo '<a href="' . htmlspecialchars($properties['lisatietoa']) . '" target="_blank">' . htmlspecialchars($properties['lisatietoa']) . '<span class="sr-only">Avautuu uuteen välilehteen</span></a>';
    } else {
        echo htmlspecialchars($properties['lisatietoa'] ?? '-');
    }
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</body>';
echo '</html>';
?>
