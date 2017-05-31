
<?php
session_start();


include_once 'testarLogado.php';

include_once 'partes/header.php';

include_once 'view/ViewSaida.php';

include_once 'partes/profile.php';
    
include_once 'partes/menu_lateral.php';
    
include_once 'partes/menu_top.php';
    
    $view = new ViewSaida();    
    $view->setTitulo("Saída");
    $view->setSubTitulo("Cadastrar Nova Saída");
    
$novo_fornecedor = false;
$id_fornecedor = 0;
$novo_servico = false;
$id_servico = 0;

if(isset($_GET['novo_fornecedor'])){
    $novo_fornecedor = $_GET['novo_fornecedor'];
}else{
    $novo_fornecedor = false;
}

if(isset($_GET['id_fornecedor'])){
    $id_fornecedor = $_GET['id_fornecedor'];    
}else{
    $id_fornecedor = 0;
}

if(isset($_GET['novo_servico'])){
    $novo_servico = $_GET['novo_servico'];
}else{
    $novo_servico = false;
}

if(isset($_GET['id_servico'])){
    $id_servico = $_GET['id_servico'];
}else{
    $id_servico = 0;
}

    
?>
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $view->getTitulo(); ?> <small><?php echo $view->getSubTitulo(); ?> </small></h3>
              </div>
       
              
            </div>

            <div class="clearfix"></div>

                <?php
                
                    if($novo_fornecedor == true){
                        $view->imprimirFormNovoFornecedor();
                        
                    }else{                        
                        if($id_fornecedor > 0){
                            $view->imprimirDadosFornecedor($id_fornecedor);
                            
                            if($id_servico > 0){
                                    $view->imprimirFormServico($id_servico);                                
                            }
                            
                            $view->imprimirListaDetalhamentoSaida($id_fornecedor);
                            
                            $view->imprimirListaDeServicosFornecedor($id_fornecedor);
                            if($novo_servico == true){
                                $view->imprimirFormNovoServico($id_fornecedor);                            
                            }
                        }else{                        
                            $view->imprimirListaFornecedor();
                        }
                    }
                            
                ?>
          </div>
          </div>
        </div>
        <!-- /page content -->
  
   <?php
   
include_once 'partes/footer_tabelas.php';    
    
    ?>