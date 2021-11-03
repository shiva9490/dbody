<?php if(is_array($deliverychage) && count($deliverychage) >0){?>
    <input type="hidden" name="delitype" id="delitype" value="<?php echo $delitype;?>" data-title="<?php echo $deliverychage[0]->derliverytype?>" data-value="<?php echo $deliverychage[0]->deliverychg_amount?>">
    <input type="hidden" name="date" id="date" value="<?php echo $date;?>">
    <div class="row" style="text-align: center;">
        <div class="delivery-time">
            <ul>
            <?php foreach($deliverychage as $delchage){
                $selectdate = date('d/m/Y');
                if($selectdate == $date){
                $dates = date('H:i');
                $timestamp = strtotime($delchage->deliverychg_start);
                $da  = date('H:i', $timestamp);
                if($dates <= $da){
            ?>
                <li>
                    <label class="cont">
                        <?php
                            echo $da;
                        ?>
                        -
                        <?php 
                            $timestamp1 = strtotime($delchage->deliverychg_end);
                            echo date('h:i A', $timestamp1);
                        ?> hrs
                        <input type="radio" class="type" data-type="<?php echo $delchage->deliverychgid;?>" onchange="deliverychage('<?php echo $delchage->deliverychgid;?>')" value="<?php echo $delchage->deliverychgid;?>" name="devliry_chage">
                        <span class="checkmark"></span>
                    </label>
                </li>
            <?php } }else{ ?>
                <li>
                    <label class="cont">
                        <?php
                            $timestamp = strtotime($delchage->deliverychg_start);
                            echo $da  = date('h:i A', $timestamp);
                        ?>
                        -
                        <?php 
                            $timestamp1 = strtotime($delchage->deliverychg_end);
                            echo date('h:i A', $timestamp1);
                        ?> hrs
                        <input type="radio" class="type" data-type="<?php echo $delchage->deliverychgid;?>" onchange="deliverychage('<?php echo $delchage->deliverychgid;?>')" value="<?php echo $delchage->deliverychgid;?>" name="devliry_chage">
                        <span class="checkmark"></span>
                    </label>
                </li>
            <?php }
            }?>
            </ul>
        </div>
    </div>
<?php } ?>