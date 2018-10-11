<?php
    include('functions_debug.php');
    require_once('class/AbstractMail.php');
    require_once('class/AttachmentMail.php');
    require_once('class/Multipart.php');
    require_once('class/Mailer.php');

    if (!function_exists("stripos")) {
        function stripos($haystack,$needle,$offset = 0)
        {
            return(strpos(strtolower($haystack),strtolower($needle),$offset));
        }
    }

    if(empty($_POST['email'])||empty($_POST['delivery'])||empty($_POST['date'])||empty($_POST['company'])||empty($_POST['telephone'])||empty($_POST['contact'])||empty($_POST['prefered'])||empty($_POST['postcode']))
        Header('Location: online_orders.php?error=1');

    else
    {
        foreach ($_POST as $thisvar) {
            if (is_scalar($thisvar))
            {
                if( stripos($thisvar,'Content-Type:') !== FALSE ) { die;}
                if( stripos($thisvar,'Bcc:') !== FALSE ) { die;}
                if( stripos($thisvar,'CC:') !== FALSE ) { die;}
                if( stripos($thisvar,'\r\n') !== FALSE ) { die;}
                if( stripos($thisvar,'\n') !== FALSE ) { die;}
                if( stripos($thisvar,'\r') !== FALSE ) { die;}
                if( stripos($thisvar,'<br/>') !== FALSE ) { die;}
                if( stripos($thisvar,'</a>') !== FALSE ) { die;}
                if( stripos($thisvar,'<a href=') !== FALSE ) { die;}
            }
        }

        $mail = '^[_a-zA-Z0-9.-]+@[_a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$';
        $email = $_POST['email'];

        $domain = '@serioussandwichpeopleltd.com';
        $domaine = strstr($email, '@');

        if (true == false) {

        } else
        {
            $num_name = (count($_POST) - 11)/5;

            //~ echo $num_name;

            $to = "serioussandwich@outlook.com";
            //$to = "stuart@blackpig.eu";
            $subject = "Website Order";
            $message .= '<p style="font-family:Arial, Verdana;font-size:12px;"><strong>Details</strong></p>';

            $message .= '<table style="font-family:Arial, Verdana;font-size:11px;">';
            $message .= '<tr><td><strong>Email address</strong></td><td>'.$_POST['email'].'</td></tr>';
            $message .= '<tr><td><strong>Telephone</strong></td><td>'.$_POST['telephone'].'</td></tr>';
            $message .= '<tr><td><strong>Contact Name</strong></td><td>'.$_POST['contact'].'</td></tr>';
            $message .= '<tr><td><strong>Company</strong></td><td>'.$_POST['company'].'</td></tr>';
            $message .= '<tr><td><strong>Delivery address</strong></td><td>'.$_POST['delivery'].' '.$_POST['delivery2'].' '.$_POST['delivery3'].'</td></tr>';
            $message .= '<tr><td><strong>Postcode</strong></td><td>'.$_POST['postcode'].'</td></tr>';
            $message .= '<tr><td><strong>Date</strong></td><td>'.$_POST['date'].'</td></tr>';
            $message .= '<tr><td><strong>Prefered time</strong></td><td>'.$_POST['prefered'].'</td></tr>';
            $message .= '<tr><td><strong>Payment</strong></td><td>'.$_POST['payment'].'</td></tr>';
            $message .= '</table>';

            $message .= '<p style="font-family:Arial, Verdana;font-size:12px;"><strong>Order</strong></p>';

            $message .= '<table>';
            for($i=1;$i<=$num_name;$i++)
            {
                $message .= '<tr><td style="border-bottom:1px solid #000;"><table style="font-family:Arial, Verdana;font-size:11px;"><tr><td><strong>Name</strong></td><td>'.$_POST['name_'.$i.''].'</td></tr>';
                $message .= '<tr><td><strong>Sandwich</strong></td><td>'.$_POST['sandwich_'.$i.''].'</td></tr>';
                $message .= '<tr><td><strong>Bread</strong></td><td>'.$_POST['bread_'.$i.''].'</td></tr>';
                $message .= '<tr><td><strong>Comment</strong></td><td>'.$_POST['comment_'.$i.''].'</td></tr>';
                $message .= '<tr><td><strong>Additional items</strong></td><td>'.$_POST['additional_'.$i.''].'</td></tr></table></td></tr>';
            }

            $message .= '</table>';

            //~ echo $message;

            $mail = new Mailer($to, $subject, "", $_POST['email']);

            // $mail->addBCC($addBCC);
            $mail->setBodyHtml($message);
            $mail->setPriority(ABSTRACTMAIL_NORMAL_PRIORITY);

            if ($mail->send())
                Header('Location: send.htm');
            else
                Header('Location: errorsend.htm');
            }
        }

?>
