<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3 style="margin-top: 100px">Geral</h3>
    <ul class="nav side-menu">
        <li><a href="index.php"><i class="fa fa-tachometer"></i> Home </a>  </li>

     <li><a><i class="fa fa-male"></i> Paciente <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="novo_paciente.php">Novo Paciente</a></li>
          <li><a href="lista_paciente.php">Lista de Pacientes</a></li>
          
            <?php if($_SESSION['tipo'] == 1){ ?>
                <li><a href="lista_orcamento.php">Lista de Orçamentos</a></li>
            <?php } ?>
                
           <li><a href="lista_aniversariantes_pacientes.php">Aniversariantes do Mês</a></li>
        </ul>
      </li>

    <?php if($_SESSION['tipo'] == 1){ ?>

      <li><a><i class="fa fa-clock-o"></i> Agendamento <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">          
          <li><a href="tables_dynamic.html">Agenda do Dia</a></li>
          <li><a href="nova_visita.php">Agendar Visita</a></li>
          <li><a href="tables_dynamic.html">Listar por Período</a></li>
        </ul>
      </li>
      
    <?php } ?>
      
    <?php if($_SESSION['tipo'] == 1){ ?>
  
      <li><a><i class="fa fa-cart-arrow-down"></i> Financeiro <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">          
          <li><a href="entrada.php">Nova Entrada</a></li>   
          <li><a href="tables_dynamic.html">Lista de Entrada</a></li>
          <li><a href="nova_saida.php">Nova Saída</a></li>   
          <li><a href="tables_dynamic.html">Lista de Saída</a></li>          
        </ul>
      </li>
    <?php } ?>      
    </ul>
  </div>

    
  <?php if($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2) { ?>

    <div class="menu_section">
    <h3>Administrativo</h3>
    <ul class="nav side-menu">           
    

    <li><a><i class="fa fa-wrench"></i> Serviços <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="novo_servico.php">Novo Serviço</a></li>
          <li><a href="lista_servico.php">Lista de Serviços</a></li>
        </ul>
      </li>

      <li><a><i class="fa fa-truck"></i> Fornecedor <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="novo_fornecedor.php">Novo Fornecedor</a></li>
          <li><a href="lista_fornecedor.php">Lista de Fornecedor</a></li>
        </ul>
      </li>
      
      <li><a><i class="fa fa-users"></i> Usuários <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="novo_usuario.php">Novo Usuário</a></li>
          <li><a href="lista_usuarios.php">Lista de Usuários</a></li>
          <li><a href="lista_tipo_usuario.php">Tipos de Usuários</a></li>
        </ul>
      </li>

    </ul>
  </div>

  <?php } ?>
    
  <div class="menu_section">
    <h3>Relatórios</h3>    
    <ul class="nav side-menu">
        <?php if($_SESSION['tipo'] == 1){ ?>
      <li><a><i class="fa fa-bug"></i> Logs <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="e_commerce.html">Acesso do dia</a></li>
          <li><a href="projects.html">Acesso do Mês</a></li>          
        </ul>
      </li>      
      <?php } ?>
      
      <li><a><i class="fa fa-male"></i> Pacientes <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="relatorio_novos_pacientes.php?dias=1">Novos Paciente no Dia</a></li>
          <li><a href="relatorio_novos_pacientes.php?dias=7">Novos Paciente nos Últimos 7 dias</a></li>          
          <li><a href="relatorio_novos_pacientes.php?dias=30">Novos Paciente nos Últimos 30 dias</a></li>  
          <li><a href="lista_aniversariantes_pacientes.php">Aniversariantes do Mês</a></li>
        </ul>
      </li>
      
    </ul>
  </div>

    
    <?php if($_SESSION['tipo'] == 1){ ?>

  <div class="menu_section">
    <h3>Outros</h3>
    <ul class="nav side-menu">
      <li><a><i class="fa fa-bug"></i> Login <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="e_commerce.html">E-commerce</a></li>         
        </ul>
      </li>
      <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="page_403.html">403 Error</a></li>
          <li><a href="page_404.html">404 Error</a></li>
          <li><a href="page_500.html">500 Error</a></li>
          <li><a href="plain_page.html">Plain Page</a></li>
          <li><a href="login.html">Login Page</a></li>
          <li><a href="pricing_tables.html">Pricing Tables</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="#level1_1">Level One</a>
            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li class="sub_menu"><a href="level2.html">Level Two</a>
                </li>
                <li><a href="#level2_1">Level Two</a>
                </li>
                <li><a href="#level2_2">Level Two</a>
                </li>
              </ul>
            </li>
            <li><a href="#level1_2">Level One</a>
            </li>
        </ul>
      </li>                  
      <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
    </ul>
  </div>

    <?php } ?>
</div>

 </div>
        </div>
<!-- /sidebar menu -->