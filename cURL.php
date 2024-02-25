<?php
echo '<pre>';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.coincap.io/v2/assets/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
curl_close($ch);
if ($output !== false) {
    $data = json_decode($output, true);
    // print_r($data['data']);
    $fetchData = $data['data'];
    foreach ($fetchData as $key => $value) {
        echo "ID: " . $value['id'] . "<br>";
        echo "Name: " . $value['name'] . "<br>";
        echo "Symbol: " . $value['symbol'] . "<br>";
        echo "Rank: " . $value['rank'] . "<br>";
        echo "Price: " . $value['priceUsd'] . "<br>";
        echo "<hr>";
    }
} else {
    echo "Failed to fetch data from the API.";
}
echo '</pre>';
?>