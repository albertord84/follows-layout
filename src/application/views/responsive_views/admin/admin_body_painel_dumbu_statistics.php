<?php 
    $a=$BLOCKED_BY_PAYMENT;
    if(isset($ACTIVE)){
        echo '<script type="text/javascript"> var ACTIVE= '.(json_encode($ACTIVE)).';</script>';
//        echo '<script type="text/javascript"> var ACTIVE= jQuery.parseJSON('.json_encode($ACTIVE).');</script>';
//        echo '<script type="text/javascript"> var BLOCKED_BY_PAYMENT= jQuery.parseJSON('.json_encode($BLOCKED_BY_PAYMENT).');</script>';
//        echo '<script type="text/javascript"> var BLOCKED_BY_INSTA= jQuery.parseJSON('.json_encode($BLOCKED_BY_INSTA).');</script>';
//        echo '<script type="text/javascript"> var DELETED= jQuery.parseJSON('.json_encode($DELETED).');</script>';
//        echo '<script type="text/javascript"> var UNFOLLOW= jQuery.parseJSON('.json_encode($UNFOLLOW).');</script>';
//        echo '<script type="text/javascript"> var VERIFY_ACCOUNT= jQuery.parseJSON('.json_encode($VERIFY_ACCOUNT).');</script>';
//        echo '<script type="text/javascript"> var BLOCKED_BY_TIME= jQuery.parseJSON('.json_encode($BLOCKED_BY_TIME).');</script>';
    }
?>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/chart_admin.js?'.$SCRIPT_VERSION; ?>"></script>

        <br><br>
    
        <!--<div class="row">
        <div class="col-xs-3"></div>
        <div class="col-xs-6">
            <div class="center">
                <div class="col-xs-5">
                    <input type="text" id="date_from" name="date_from" placeholder="mm/dd/yyyy" class="form-control">
                </div>
                <div class="col-xs-1">
                    <b>até</b>
                </div>
                <div class="col-xs-5">
                    <input type="text" id="date_to" name="date_to" placeholder="mm/dd/yyyy" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-xs-3"></div>
    </div>-->
    
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <div id="chartContainer" style="height: 450px; width: 100%;"></div>    
        </div>
        <div class="col-xs-2"></div>
    </div>
    

        