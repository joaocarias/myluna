<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensagem
 *
 * @author joao
 */
class Mensagem {
    
    public static function getMensagem($tipo, $idMensagem, $tituloPagina, $paginaSeguinte){
        $tituloModal = "";
        $texto = "";
                
        if($tipo == 1){    //Se tipo igual a 1, então é um questionamento      
             switch ($idMensagem):
                case 1:                    
                    $texto = "Tem Certeza que Deseja Cancelar o Cadastro?";
                    $bt_confirmar = "<a href='".$paginaSeguinte."?btn-cancelar=true'><button type='button' class='btn btn-primary'>Cancelar Cadastro</button></a>";
                    break;
                case 2:         //aqui é possível definir os paramentros dos GET           
                    $texto = "Tem Certeza que Deseja Excluir o Cadastro?";
                    $bt_confirmar = "<a href='".$paginaSeguinte."'><button type='button' class='btn btn-primary'>Excluir Cadastro</button></a>";
                    break;
                case 3:     //Pode definir os paramentros do GET                    
                    $texto = "Tem Certeza que Deseja Cancelar o Cadastro?";
                    $bt_confirmar = "<a href='".$paginaSeguinte."'><button type='button' class='btn btn-primary'>Cancelar Cadastro</button></a>";
                    break;                
                default :
                    $texto = "[ERRO] Ação não Identificada!";
                    $bt_confirmar = "";
                    break;
            endswitch;    
        }else if($tipo == 2){   //Se tipo igual a 2, então é apenas uma mensagem 
            switch ($idMensagem):
                case 1:                    
                    $texto = "Ação Cancelada!";
                    $bt_confirmar = "";
                    break;
                case 2:                    
                    $texto = "Cadastro Salvo com Sucesso!";
                    $bt_confirmar = "";
                    break;
                case 3:                    
                    $texto = "[ERRO] Erro ao Salvar Cadastro!";
                    $bt_confirmar = "";
                    break;
                case 4:                    
                    $texto = "[AVISO] Cadastro Excluído com Sucesso!";
                    $bt_confirmar = "";
                    break;
                default :                   
                    $texto = "[ERRO] Ação não Identificada!";
                    $bt_confirmar = "";
                    break;
            endswitch;            
        }
        
        echo "<div class='modal fade bs-example-modal-lg' tabindex='-1' role='dialog' "
                    . "aria-hidden='true' id='mensagem'>
                        <div class='modal-dialog modal-sm'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal'>
                                        <span aria-hidden='true'>×</span>
                                    </button>
                                    <h4 class='modal-title' id='myModalLabel'>".$tituloPagina."</h4>
                                </div>
                                <div class='modal-body'>
                                    <h5>".$texto."</h5> 
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>                          
                                    ".$bt_confirmar."                          
                                </div>
                            </div>
                        </div>
                    </div>";
        
        
       
    }
}
