<?php
include('functions_debug.php');

$msg = '';

if(isset($_GET['error']))
{
    switch($_GET['error'])
    {
        case 1:
            $msg = '<p>Please fill the required fields</p>';
        break;

        case 2:
            $msg = '<p>Please enter a valid email address. For example mail@domain.co.uk</p>';
        break;

        case 3:
            $msg = '<p>Are you trying to spam?</p>';
        break;

        default:
            $msg = '<p>ERROR!!!!!!</p>';
        break;
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>The Serious Sandwich Ltd - Online Order</title>
    <link href="styles/ss_order.css" rel="stylesheet" type="text/css" />
    <link href="styles/ui.datepicker.css" rel="stylesheet" type="text/css" />
    <link href="styles/jquery.clockpick.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.pack.js"></script>
    <script type="text/javascript" src="js/jquery.clockpick.js"></script>
    <script type="text/javascript">
        //<![CDATA[
       jQuery(function($) {
            // validate the comment form when it is submitted
            $("#formorder").validate();
            $('#date').datepicker({ showTime: true,timePos: 'top',dateFormat: 'dd/mm/yy'});

            $("#prefered").unbind().clockpick({
                //~ layout:'horizontal',
                //~ hoursopacity:1,
                 //~ showminutes : false,
                minutedivisions : 2,
                starthour : 6,
                endhour : 20
            });
        });
    function create_field(i) {

    var i2 = i + 1;

    document.getElementById('field_'+i).innerHTML = '<div class="name">' +
                            '<label for="name_'+i+'" class="box">Name</label>' +
                            '<input type="text" name="name_'+i+'" id="name_'+i+'" class="txt2" />' +
                            '</div>' +
                            '<div class="sandwich">' +
                                '<label for="sandwich_'+i+'" class="box">Sandwich</label>' +
                                '<input type="text" name="sandwich_'+i+'" id="sandwich_'+i+'" class="txt2" />' +
                            '</div>' +
                            '<div class="bread">' +
                                '<label for="bread_'+i+'" class="box">Bread</label>' +
                                '<select id="bread_'+i+'" name="bread_'+i+'" class="bread">' +
                                    '<option value="Granary">Granary&nbsp;&nbsp;</option>' +
                                    '<option value="Wholemeal">Wholemeal&nbsp;&nbsp;</option>' +
                                    '<option value="White">White&nbsp;&nbsp;</option>' +
                                    '<option value="French baguette">French baguette&nbsp;&nbsp;</option>' +
                                    '<option value="Harvester baguette">Harvester baguette&nbsp;&nbsp;</option>' +
                                    '<option value="White bap">White bap&nbsp;&nbsp;</option>' +
                                    '<option value="Granary bap">Granary bap&nbsp;&nbsp;</option>' +
                                    '<option value="Green olive ciabatta">Green olive ciabatta&nbsp;&nbsp;</option>' +
                                    '<option value="Sourdough bun">Sourdough bun&nbsp;&nbsp;</option>' +
                                    '<option value="Folded flatbread">Folded flatbread&nbsp;&nbsp;</option>' +
                                    '<option value="Plain wrap">Plain wrap&nbsp;&nbsp;</option>' +
                                    '<option value="Wholemeal wrap">Wholemeal wrap&nbsp;&nbsp;</option>' +
                                    '<option value="Tomato wrap">Tomato wrap&nbsp;&nbsp;</option>' +
                                    '<option value="Spinach wrap">Spinach wrap&nbsp;&nbsp;</option>' +
                                '</select>' +
                            '</div>' +
                            '<div class="comment"><label for="comment_'+i+'" class="commentlabel">Comment</label><textarea id="comment_'+i+'" name="comment_'+i+'" rows="3" cols="25"></textarea></div>' +
                            '<div class="additional"><label for="additional_'+i+'" class="additionallabel">Additional items (Cake, Crisps,...)</label><textarea id="additional_'+i+'" name="additional_'+i+'" rows="3" cols="25"></textarea></div>';
    document.getElementById('field_'+i).innerHTML += (i <= 30) ? '<div id="field_'+i2+'"><a href="javascript:create_field('+i2+')" class="add">Add a Sandwich</a></div>' : '';
    }

        //]]>
    </script>
</head>

<body>
    <div id="sand_container">
        <div id="text">
            <h1>Place your order</h1>
            <div class="top_box"></div>
            <div class="content">
            <?php
            $day = date('l');
            if(($day != 'Saturday')&&($day != 'Sunday'))
            {
            ?>
                <form action="send.php" method="post" id="formorder">
                    <fieldset>
                        <div class="topfield"></div>
                        <p class="ref">&pound; 6 minimum order. We cannot guarantee time of delivery but will do our best to meet your prefered time</p>
                        <?php echo $msg;?>
                        <div class="leftform">
                            <div class="formRow">
                                <label for="email">Email address *</label>
                                <div><input type="text" id="email" name="email"  class="required email txt" /></div>
                            </div>
                            <div class="formRow">
                                <label for="telephone">Telephone *</label>
                                <div><input type="text" id="telephone" name="telephone" class="required txt" /></div>
                            </div>
                            <div class="formRow">
                                <label for="contact">Contact Name *</label>
                                <div><input type="text" id="contact" name="contact" class="required txt" /></div>
                            </div>
                            <div class="formRow">
                                <label for="date">Date *</label>
                                <div><input type="text" id="date" name="date" class="required txt" value="<?php echo date('d/m/Y');?>" /></div>
                            </div>
                            <div class="formRow">
                                <label for="prefered">Prefered time *</label>
                                <div><input type="text" id="prefered" name="prefered" class="required txt time" /></div>
                            </div>
                            <div class="formRow">
                                <label for="payment">Payment</label>
                                <div>
                                    <select id="payment" name="payment" class="payment">
                                        <option value="Cash">Cash on Delivery&nbsp;&nbsp;</option>
                                        <option value="Cheque">Cheque ( must be over &pound;5.00)&nbsp;&nbsp;</option>
                                        <option value="Credit Card">Credit Card (please phone with details)&nbsp;&nbsp;</option>
                                        <option value="Account">Account (by prior arrangement)&nbsp;&nbsp;</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="rightform">
                            <div class="formRow">
                                <label for="company">Company *</label>
                                <div><input type="text" id="company" name="company" class="required txt" /></div>
                            </div>
                            <div class="formRow">
                                <label for="delivery">Delivery address *</label>
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
                                <label for="postcode">Postcode *</label>
                                <div><input type="text" id="postcode" name="postcode" class="required ukpostcode txt" /></div>
                            </div>
                            <div class="formRow">
                                <label>&nbsp;</label>
                                <div style="font-size:12px;"><a href="Menu.pdf" target="_blank">Download Menu as a PDF (483 KB)</a></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="bottomfield"></div>
                    </fieldset>
                    <div class="clearfielset"></div>
                    <fieldset>
                        <div class="topfield"></div>
                        <div class="name">
                            <label for="name_1" class="box">Name</label>
                            <input type="text" name="name_1" id="name_1" class="txt2" />
                        </div>
                        <div class="sandwich">
                            <label for="sandwich_1" class="box">Sandwich</label>
                            <input type="text" name="sandwich_1" id="sandwich_1" class="txt2" />
                        </div>
                        <div class="bread">
                            <label for="bread_1" class="box">Bread</label>
                            <select id="bread_1" name="bread_1" class="bread">
                                <option value="Granary">Granary&nbsp;&nbsp;</option>
                                <option value="Wholemeal">Wholemeal&nbsp;&nbsp;</option>
                                <option value="White">White&nbsp;&nbsp;</option>
                                <option value="French baguette">French baguette&nbsp;&nbsp;</option>
                                <option value="Harvester baguette">Harvester baguette&nbsp;&nbsp;</option>
                                <option value="White bap">White bap&nbsp;&nbsp;</option>
                                <option value="Granary bap">Granary bap&nbsp;&nbsp;</option>
                                <option value="Green olive ciabatta">Green olive ciabatta&nbsp;&nbsp;</option>
                                <option value="Sourdough bun">Sourdough bun&nbsp;&nbsp;</option>
                                <option value="Folded flatbread">Folded flatbread&nbsp;&nbsp;</option>
                                <option value="Plain wrap">Plain wrap&nbsp;&nbsp;</option>
                                <option value="Wholemeal wrap">Wholemeal wrap&nbsp;&nbsp;</option>
                                <option value="Tomato wrap">Tomato wrap&nbsp;&nbsp;</option>
                                <option value="Spinach wrap">Spinach wrap&nbsp;&nbsp;</option>
                            </select>
                        </div>
                        <div class="comment"><label for="comment_1" class="commentlabel">Comment</label><textarea id="comment_1" name="comment_1" rows="3" cols="25"></textarea></div>
                        <div class="additional"><label for="additional_1" class="additionallabel">Additional items (Cake, Crisps, ...)</label><textarea id="additional_1" name="additional_1" rows="3" cols="25"></textarea></div>

                        <div class="clear"></div>
                        <div class="name">
                            <label for="name_2" class="box">Name</label>
                            <input type="text" name="name_2" id="name_2" class="txt2" />
                        </div>
                        <div class="sandwich">
                            <label for="sandwich_2" class="box">Sandwich</label>
                            <input type="text" name="sandwich_2" id="sandwich_2" class="txt2" />
                        </div>
                        <div class="bread">
                            <label for="bread_2" class="box">Bread</label>
                            <select id="bread_2" name="bread_2" class="bread">
                                <option value="Granary">Granary&nbsp;&nbsp;</option>
                                <option value="Wholemeal">Wholemeal&nbsp;&nbsp;</option>
                                <option value="White">White&nbsp;&nbsp;</option>
                                <option value="French baguette">French baguette&nbsp;&nbsp;</option>
                                <option value="Harvester baguette">Harvester baguette&nbsp;&nbsp;</option>
                                <option value="White bap">White bap&nbsp;&nbsp;</option>
                                <option value="Granary bap">Granary bap&nbsp;&nbsp;</option>
                                <option value="Green olive ciabatta">Green olive ciabatta&nbsp;&nbsp;</option>
                                <option value="Sourdough bun">Sourdough bun&nbsp;&nbsp;</option>
                                <option value="Folded flatbread">Folded flatbread&nbsp;&nbsp;</option>
                                <option value="Plain wrap">Plain wrap&nbsp;&nbsp;</option>
                                <option value="Wholemeal wrap">Wholemeal wrap&nbsp;&nbsp;</option>
                                <option value="Tomato wrap">Tomato wrap&nbsp;&nbsp;</option>
                                <option value="Spinach wrap">Spinach wrap&nbsp;&nbsp;</option>
                            </select>
                        </div>
                        <div class="comment"><label for="comment_2" class="commentlabel">Comment</label><textarea id="comment_2" name="comment_2" rows="3" cols="25"></textarea></div>
                        <div class="additional"><label for="additional_2" class="additionallabel">Additional items (Cake, Crisps, ...)</label><textarea id="additional_2" name="additional_2" rows="3" cols="25"></textarea></div>

                        <div id="field_3"><a href="javascript:create_field(3)" class="add">Add a Sandwich</a></div>
                        <div class="bottomfield"></div>
                    </fieldset>
                    <div>
                        <label for="submit" class="submit">&nbsp;</label>
                            <input type="submit" alt="Submit Your Order" class="submit" id="submit" />
                    </div>
                </form>
            <?php
            }
            else
            {
                echo '<fieldset>
                    <div class="topfield"></div>
                    <p>Sorry online ordering and delivery Monday to Friday only.</p>
                    <div class="bottomfield"></div>
                </fieldset>';
            }
            ?>
            </div>
            <div class="bottom_box"></div>
        </div>
    </div>
</body>

</html>
