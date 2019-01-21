<script type="text/javascript"> var DATAS= JSON.parse('<?php echo json_encode($DATAS)?>');</script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/canvasjs-1.9.6/canvasjs.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/chart_admin.js?'.$SCRIPT_VERSION; ?>"></script>
    <br><br>
 
    <div class="row text-center">
        <h2>Atividade recente</h2>
    </div>
    <div class="row">
        <div class="col-xs-2 text-center"></div>
        <div class="col-xs-8">
            <div class="col-xs-4">
                <h4>Hoje</h4><hr>
                <h6><?php echo $recent_activity['today']['beginner'];?>  Beginners</h6>
                <h6><?php echo $recent_activity['today']['signin'];?>  Novos assinantes</h6>
                <h6><?php echo $recent_activity['today']['deleted'];?>  Cancelados</h6>
                <h6><?php echo $recent_activity['today']['bloqued_by_payment'];?>  Bloqueados por pagamento</h6>
            </div>
            <div class="col-xs-4">
                <h4>Últimos 7 dias</h4><hr>
                <h6><?php echo $recent_activity['last_7_days']['beginner'];?>  Beginners</h6>
                <h6><?php echo $recent_activity['last_7_days']['signin'];?>  Novos assinantes</h6>
                <h6><?php echo $recent_activity['last_7_days']['deleted'];?>  Cancelados</h6>
                <h6><?php echo $recent_activity['last_7_days']['bloqued_by_payment'];?>  Bloqueados por pagamento</h6>
            </div>
            <div class="col-xs-4">
                <h4>Últimos 30 dias</h4><hr>
                <h6><?php echo $recent_activity['last_month']['beginner'];?>  Beginners</h6>
                <h6><?php echo $recent_activity['last_month']['signin'];?>  Novos assinantes</h6>
                <h6><?php echo $recent_activity['last_month']['deleted'];?>  Cancelados</h6>
                <h6><?php echo $recent_activity['last_month']['bloqued_by_payment'];?>  Bloqueados por pagamento</h6>
            </div>
        </div>
        <div class="col-xs-2 text-center"></div>
    </div>
    
    <br><br><br><br>
    
    <div class="row">
        <div class="col-xs-2 text-center"></div>
        <div class="col-xs-8 text-center">        
            <div id="chartContainer" style="height: 450px; width: 100%;"></div>    
        </div>
        <div class="col-xs-2  text-center"></div>
    </div>  
    
    <br><br><br><br>
    
    <div class="row">
        <div class="col-xs-2  text-center"></div>
        <div class="col-xs-8 text-center">
            <div id="chartContainer2" style="height: 450px; width: 100%;"></div>    
        </div>
        <div class="col-xs-2 text-center"></div>
    </div>
        