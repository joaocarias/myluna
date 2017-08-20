<?php

    
  include("mpdf60/mpdf.php");
  
  $html = "<h1>Hello World!</h1>";
  $html2 = "<h2>Nova Página</h2>" ;
  
	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
        $mpdf->SetHeader('||<strong>Luanda Almeida - Odontologia Integrada</strong>'
                . '<br \>Rua Nova Descoberta, 393 - Centro - Goianinha'
                . '<br \>84 9830-9282'
                );
        
	$mpdf->SetFooter('Relatório de Cliente||{PAGENO}');
	
        $mpdf->SetTopMargin('30%');
        
        $mpdf->WriteHTML($html);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html2);
	$mpdf->Output();

	exit;
    
?>