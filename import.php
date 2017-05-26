<?php
/**
 * Created by PhpStorm.
 * User: Luis Diaz
 * Date: 19/4/2016
 * Time: 2:07 PM
 */
include ('simple_html_dom.php');



include_once 'database.php';
$database = new Database();
$db = $database->getConnection();

include_once 'product.php';


$from = 3651;
$to = 3700;

for($x= $from; $x <= $to; $x++){



    $base = 'https://lbcomponents.com/page/'.$x.'/?s';

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



    foreach($html_base->find('tr') as $row) {

        $product = new Product($db);

        $description = "";
        $manufacturer = "";
        $product_no = "";
        $i = 0;
        foreach($row->find('td') as $cell) {
            // push the cell's text to the array

            if($i==0){
                $product_no = $cell->plaintext;
            }elseif($i==1){
                $manufacturer = $cell->plaintext;
            }elseif($i==2)
            {
                $description = $cell->plaintext;
            }


            $i++;
        }

        $product->part_no = $product_no;
        $product->manufacturer = $manufacturer;
        $product->description = $description;


        if($product->part_no == "")
            continue;

        $product->create();
    }

}

$html_base->clear();
unset($html_base);
