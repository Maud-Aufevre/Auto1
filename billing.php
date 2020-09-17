<?php

require_once('./vendor/autoload.php');
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$data = "<table>
<caption>Facture n° ".$numero."</caption>
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Véhicule</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>000".$id."</td>
                    <td>".$marque."</td>
                    <td>".$prix."</td>
                </tr>
            </tbody>
        </table>";
$dompdf->loadHtml($data);
// parametrage du format de sortie:
$dompdf->setPaper('A4','landscape');
$dompdf->render();

//envoi des données vers le navigateur, 1er prop = nom du fichier, 2eme permet d'ouvrir sur une nouvelle page le pdf, si on met rien ca le telecharge automatiquement:
$dompdf->stream("auto",array('Attachment'=>0));

?>