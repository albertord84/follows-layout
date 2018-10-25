
 
        <div class="row">        
            <div class="col-md-5"></div>
            <div class="col-md-7">
                <nav class="navbar navbar-inverse navbar-right"   role="navigation"> <!--style="background-color:transparent;border-color:transparent;"-->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <!--style="background-color:transparent;"-->
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">           
                        <ul class="nav navbar-nav navbar-left">
                            <li><a id="dumbu_statistics" target="_blank" href="
                                <?php 
                                    $database_config = parse_ini_file(dirname(__FILE__) . "/../../../../../../FOLLOWS.INI", true);
                                    $worker_server_name = $database_config['server']['worker_server_name'];
                                    echo "http://$worker_server_name/follows-worker/src/index.php/admin/view_scan_logs";                                    
                                ?>">SCAN-LOG</a></li>
                            <li><a id="dumbu_statistics" target="_blank" href="<?php echo base_url().'index.php/admin/dumbu_statistics_view'?>">ESTATÍSTICAS</a></li>
                            <li><a id="do_payments" target="_blank" href="<?php echo base_url().'index.php/admin/do_payments'?>">OPERAÇÔES BÁSICAS</a></li>
                            <li><a id="lnk_washdog" target="_blank" href="<?php echo base_url().'index.php/admin/watchdog'?>">WATCHDOG</a></li>
                            <li><a id="lnk_pendences" target="_blank" href="<?php echo base_url().'index.php/admin/pendences'?>">PENDÊNCIAS</a></li>
                            <li><a href="<?php echo base_url().'index.php/admin/log_out'?>" >SAIR</a></li>
                        </ul>
                    </div>
                </nav>                     
            </div>            
        </div>

        <div class="row center">
            <a href=../"#"><img  style="width: 10%" src="<?php echo base_url().'assets/images/logo.png'?>"/></a>
        </div>

   