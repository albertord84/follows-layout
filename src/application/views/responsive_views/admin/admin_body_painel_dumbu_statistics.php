<script type="text/javascript"> var DATAS= JSON.parse('<?php echo json_encode($DATAS)?>');</script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/chart_admin.js?'.$SCRIPT_VERSION; ?>"></script>
    <br><br>    
    <div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <div class="center">
                <form action="<?php echo base_url().'index.php/admin/dumbu_statistics_view'?>" method="post">
                    <div class="col-xs-4">
                        <input type="text" id="date_from" name="date_from" placeholder="mm/dd/yyyy" class="form-control">
                    </div>
                    <div class="col-xs-2">
                        <b>até</b>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" id="date_to" name="date_to" placeholder="mm/dd/yyyy" class="form-control">
                    </div>
                    <div class="col-xs-2">
                        <input id="see_statistics" class="btn btn-primary" type="submit" value="VER">
                    </div>                    
                </form>
            </div>
        </div>
        <div class="col-xs-3">
        </div>
    </div>
    <br><br>    
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <div id="chartContainer" style="height: 450px; width: 100%;"></div>    
        </div>
        <div class="col-xs-2"></div>
    </div>
    <br><br>    
    <br><br>    

        