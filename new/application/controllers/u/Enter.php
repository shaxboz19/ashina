<?php
Class Enter extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->data['sel'] = 'enter';
	}
  public function index()
  {  
    $this->load->helper('enter');
     $email_send = trim(getSiteSettings(1, 'link'));
    //define('MailFrom', 'info@'.$_SERVER['HTTP_HOST']);
    define('MailFrom', $email_send);
    define('MailTo',   trim(getSiteSettings(1, 'link')));
    define('RemoveHTML', true);
    header('Content-Type: application/json');
    if(empty($_POST)) {
        header("HTTP/1.0 503 Service Unavailable");
        exitWithMessage('Direct access not allowed');
    } elseif(isset($_POST['message']) and is_array($_POST['message'])
        and !empty($_POST['message'])) {
        $message = $_POST['message'];
        $mailTo = (string) '';
        $mailFrom = (string) '';
        // Check mail destination
        if(defined('MailTo') and validateEmail(MailTo))
            $mailTo = MailTo;
        elseif(!empty($message['to'][0]['email'])
            and validateEmail($message['to'][0]['email']))
            $mailTo = $message['to'][0]['email'];
        if(empty($mailTo))
            exitWithMessage('Empty or invalid email address for sending');
        // Check mail sender
        if(defined('MailFrom') and validateEmail(MailFrom))
            $mailFrom = MailFrom;
        elseif(!empty($message['from_email'])
            and validateEmail($message['from_email']))
            $mailFrom = $message['from_email'];
        if(empty($mailFrom))
            exitWithMessage('Empty or invalid email sender');
        // Remove html (if needed)
        if(defined('RemoveHTML') and RemoveHTML) {
            $message['subject'] = secureClear($message['subject']);
            $message['html'] = str_replace(
                array('<strong>', '</strong>', '<b>', '</b>'),
            ' ## ', $message['html']);
            $message['html'] = secureClear($message['html']);
        }
        // Check subject
        if (empty($message['subject'])) exitWithMessage('Empty subject');
        // Check mail body
        if (empty($message['html'])) exitWithMessage('Empty or invalid mail body');
        // Prepare sendmail headers
        $headers = "MIME-Version: 1.0\r\n".
            "Content-Type: text/".((defined('RemoveHTML') and RemoveHTML) ? 
            "plain" : "html")."; charset=\"utf-8\"\r\n";
        $headers .= "From: ".$mailFrom."\r\n".
                    "Reply-To: ".$mailFrom."\r\n".
                    "Return-Path: ".$mailFrom."\r\n";
        // And sending mail
        if(!mail($mailTo, 
                 '=?UTF-8?B?'.base64_encode($message['subject']).'?=',
                 $message['html'],
                 $headers)) {
            exitWithMessage('Sendmail server error :(');
        } exitWithMessage('Your message was sent successfully', 1);
    }
  }
}