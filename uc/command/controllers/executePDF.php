<?php
// Projet: Application TPI
// Script: Contrôleur executePDF.php
// Description: Execute la page PDF
// Version 1.0.0 PC 11.05.2021 / Codage initial

/**
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * 
 */
require_once dirname(__FILE__).'/../../../vendor/autoload.php';
require_once 'uc/command/model/command.php';
require_once 'uc/items/models/item.php';
require_once 'uc/panier/models/commandItem.php';
require_once 'commons/views/Html.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $idCommand = filter_input(INPUT_POST, "idCommand", FILTER_VALIDATE_INT);
    $idItem = filter_input(INPUT_POST, "idItem", FILTER_VALIDATE_INT);
   

    $user = Session::getUser();

    $idUser = $user->getIdUser();

    $date = date('Y-m-d');
    $directory = 'C:/laragon/www/TPI/TPI/uc/command/pdf/';
    $fileName = 'CMD_' . $idUser . '_' . $date . '.pdf';

    if (file_exists($directory . $fileName)) {
     
        $file = $directory . $fileName;
       
        header('Content-type: application/pdf');

        header('Content-Disposition: inline; filename="' . $file . '"');

        header('Content-Transfer-Encoding: binary');

        header('Accept-Ranges: bytes');

    
        @readfile($file);
    } else {
    
        ob_start();
        include dirname(__FILE__) . '/../views/showGeneratePDF.php';
        $content = ob_get_clean();
        ob_end_clean();
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
    
        $html2pdf->output($directory . $fileName, 'FI');
    
        command::UpdateCommandPdfPath($idCommand, $directory . $fileName);
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS, "Vous avez mis à jour le pdfPath de la commande");
    }
} catch (Html2PdfException $e) {
    $html2pdf->clean();
    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
