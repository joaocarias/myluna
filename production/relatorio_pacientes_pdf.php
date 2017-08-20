<?php

include_once 'controllers/GeradorDePDF.php';
include_once 'controllers/Paciente.php';

$titulo = "Relatório de Pacientes";

$html = "<h3 style='text-align: center'>".$titulo."</h3>";
$html = $html . "<table>"
        . "thead>"
        . "<tr>"
        . "     <td>Código</td>"
        . "     <td>Nome</td>"
        . "     <td>CPF</td>"
        . "     <td>Gênero</td>"
        . "     <td>Telefone</td>"
        . "     <td>Nº de Ficha</td>"
        . "     <td>Cidade</td>"
        . "</tr>"
        . "</thead>"
        . "<tbody>"
        . "".Paciente::getLinhasTabelaRelatorioPaciente()   
        . "</tbody>"
        . "</table>"        
        ;

$gerador = new GeradorDePDF($titulo, $html, "L");
$gerador->gerarPDF();



