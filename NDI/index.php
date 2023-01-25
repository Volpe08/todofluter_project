<?php
require "./vendor/pdfcrowd/pdfcrowd/pdfcrowd.php";

try
{
    // create the API client instance
    $client = new \Pdfcrowd\PdfToHtmlClient("Volpe", "f6173a308cdc555febc6e412b250b545");

    // run the conversion and write the result to a file
    $client->convertFileToFile("./Banc_de_carcasse_6561_EF.pdf", "logo.html");
}
catch(\Pdfcrowd\Error $why)
{
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");

    // rethrow or handle the exception
    throw $why;
}

?>