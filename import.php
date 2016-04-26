<?php
/**
 * Created by PhpStorm.
 * User: Luis Diaz
 * Date: 19/4/2016
 * Time: 2:07 PM
 */
include ('simple_html_dom.php');



$base = 'https://www.lbcomponents.com/circuit-breakers-accessories.html';

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, $base);
curl_setopt($curl, CURLOPT_REFERER, $base);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$str = curl_exec($curl);
curl_close($curl);

// Create a DOM object
$html_base = new simple_html_dom();
// Load HTML from a string
$html_base->load($str);

//get all category links
foreach($html_base->find('table.yui') as $element) {
    echo "<pre>";
    print_r( $element->tr );
    echo "</pre>";
}

$html_base->clear();
unset($html_base);