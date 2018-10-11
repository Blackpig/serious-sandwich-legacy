<script type="text/javascript">
    //<![CDATA[
   jQuery(function($) {
        // validate the comment form when it is submitted
        $("#formorder").validate();
        $('#date').datepicker({ showTime: true,timePos: 'top',dateFormat: 'dd/mm/yy'});
        <?php
        if($browser['browsertype'] != 'Safari') {
        ?>
        $("#collect").unbind().clockpick({
            //~ layout:'horizontal',
            //~ hoursopacity:1,
             //~ showminutes : false,
            minutedivisions : 2,
            starthour : 6,
            endhour : 20
        });
        <?php } ?>
    });
    
    function create_field(i) {

    var i2 = i + 1;

    document.getElementById('field_'+i).innerHTML = '<div class="name"><input type="text" name="name_'+i+'" id="name_'+i+'" class="txt" /></div><div class="sandwich"><input type="text" name="sandwich_'+i+'" id="sandwich_'+i+'" class="txt" /></div><div class="bread"><select id="bread_'+i+'" name="bread_'+i+'"><option value="Brown">Brown&nbsp;&nbsp;</option><option value="White">White&nbsp;&nbsp;</option></select></div><div class="comment"><textarea id="comment_'+i+'" name="comment_'+i+'" rows="5" cols="25"></textarea></div><div class="clear"></div>';
    document.getElementById('field_'+i).innerHTML += (i <= 30) ? '<div id="field_'+i2+'" colspan="4"><a href="javascript:create_field('+i2+')">Add a field</a></div>' : '';
    }
    //]]>
</script>

<form action="send.php" method="post" id="formorder">
                <div class="formRow">
                    <label for="email">Email address</label>
                    <div><input type="text" id="email" name="email"  class="required email txt" /></div>
                </div>
                <div class="formRow">
                    <label for="delivery">Delivery address</label>
                    <div><input type="text" id="delivery" name="delivery" class="required txt" /></div>
                </div>
                <div class="formRow">
                    <label for="delivery2">&nbsp;</label>
                    <div><input type="text" id="delivery2" name="delivery2" class="txt" /></div>
                </div>
                <div class="formRow">
                    <label for="delivery3">&nbsp;</label>
                    <div><input type="text" id="delivery3" name="delivery3" class="txt" /></div>
                </div>
                <div class="formRow">
                    <label for="collect">Deliver / Collect Time</label>
                    <div><input type="text" id="collect" name="collect" class="required txt time" /></div>
                </div>
                <div class="formRow">
                    <label for="company">Company</label>
                    <div><input type="text" id="company" name="company" class="required txt" /></div>
                </div>
                <div class="formRow">
                    <label for="contact">Contact</label>
                    <div><input type="text" id="contact" name="contact" class="required txt" /></div>
                </div>
                <div class="formRow">
                    <label for="payment">Payment</label>
                    <div>
                        <select id="payment" name="payment">
                            <option value="Cash">Cash&nbsp;&nbsp;</option>
                            <option value="Account">Account&nbsp;&nbsp;</option>
                        </select>
                    </div>
                </div>
                <div class="formRow">
                    <label for="telephone">Telephone</label>
                    <div><input type="text" id="telephone" name="telephone" class="required txt" /></div>
                </div>
                <div class="formRow">
                    <div class="name"><label for="name" class="top">Name</label></div>
                    <div class="sandwich"><label for="sandwich" class="top">Sandwich</label></div>
                    <div class="bread"><label for="bread" class="top">Bread</label></div>
                    <div class="comment"><label for="comment" class="top">Comment</label></div>
                </div>
                <div class="formRow">
                    <div class="name"><input type="text" name="name_1" id="name_1" class="txt" /></div>
                    <div class="sandwich"><input type="text" name="sandwich_1" id="sandwich_1" class="txt" /></div>
                    <div class="bread">
                        <select id="bread_1" name="bread_1">
                            <option value="Brown">Brown&nbsp;&nbsp;</option>
                            <option value="White">White&nbsp;&nbsp;</option>
                        </select>
                    </div>
                    <div class="comment"><textarea id="comment_1" name="comment_1" rows="5" cols="25"></textarea></div>
                    <div class="clear"></div>
                </div>
                
                <div id="field_2"><a href="javascript:create_field(2)">Add a field</a></div>
                <div class="formRow">
                    <!-- <label for="submit">&nbsp;</label> -->
                    <div><input type="submit" id="submit" value="Submit" /></div>
                </div>
            </form>