<?php

/**
 * Class to send emails with attachments in Text and HTML formats
 *
 * @package			mail
 * @author			gustavo.gomes
 * @copyright		2006
 */
class AttachmentMail extends AbstractMail {

	var $uidBoundary;
	
	var $delimiter;
	
	var $contentTransferEncode = "7bit";

	var $attachment = array();
	
	function AttachmentMail($to, $subject, $fromName="", $fromMail="") {
		// Create a unique id boundary
		$this->uidBoundary = "_".md5(uniqid(time()));
		$this->delimiterBoundary = "--".$this->uidBoundary.ABSTRACTMAIL_CRLF;

		parent::AbstractMail($to, $subject, $fromName, $fromMail);
	}

	function setBodyHtml($html, $charset="iso-8859-1") {
		$this->contentType = "text/html";
		$this->charset = $charset;
		$this->body = $this->createMessageHeaders("text/html",$charset);
		$this->body .= "<html><head>";
		$this->body .= "<meta http-equiv=Content-Type content=\"text/html; charset=".$charset."\">";
		$this->body .= "</head><body>";
		$this->body .= nl2br($html)."";
		$this->body .= "</body></html>";
		$this->body .= ABSTRACTMAIL_CRLF.ABSTRACTMAIL_CRLF;
	}
	
	function setHtml($html, $charset="iso-8859-1") {
		$this->contentType = "text/html";
		$this->charset = $charset;
		$this->body = $this->createMessageHeaders("text/html",$charset);
		$this->body .= nl2br($html)."".ABSTRACTMAIL_CRLF.ABSTRACTMAIL_CRLF;
	}

	function setBodyText($text) {
		$this->contentType = "text/plain";
		$this->charset = "";
		$this->body = $this->createMessageHeaders("text/plain");
		$this->body .= $text.ABSTRACTMAIL_CRLF.ABSTRACTMAIL_CRLF;
	}
	
	function createMessageHeaders($contentType, $encode="") {
		$out = $this->delimiterBoundary;
		$out .= parent::createMessageHeaders($contentType, $encode);
		$out .= "Content-Transfer-Encoding: ".$this->contentTransferEncode.ABSTRACTMAIL_CRLF.ABSTRACTMAIL_CRLF;
		return $out;
	}
	
	function addAttachment($part) {
		$this->attachment[] = $part;
	}

	function send() {
		$this->addHeader("MIME-Version: 1.0");
		$this->addHeader("X-Mailer: Attachment Mailer ver. 1.0");
		$this->addHeader("X-Priority: ".$this->priority);
		$this->addHeader("Content-type: multipart/mixed;".ABSTRACTMAIL_CRLF.chr(9)." boundary=\"".$this->uidBoundary."\"".ABSTRACTMAIL_CRLF);
		$this->addHeader("This is a multi-part message in MIME format.");
		$headers = $this->buildHeaders();
		return mail($this->buildTo(),
					$this->subject,
					$this->body.$this->createAttachmentBlock(),
					$headers);
	}
	
	function createAttachmentBlock() {
		$block = "";
		
		if (count($this->attachment) > 0) {
			$block .= $this->delimiterBoundary;
			for ($i = 0;$i < count($this->attachment);$i++) {
				$block .= $this->attachment[$i]->getContent();
				$block .= $this->delimiterBoundary;
			}
		}
		return $block;
	}
}
?>