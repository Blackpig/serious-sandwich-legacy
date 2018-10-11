<?php

if (!defined("ABSTRACTMAIL_CRLF"))
	define("ABSTRACTMAIL_CRLF", "\n");

if (!defined("ABSTRACTMAIL_HIGH_PRIORITY"))
	define("ABSTRACTMAIL_HIGH_PRIORITY", 2);
if (!defined("ABSTRACTMAIL_NORMAL_PRIORITY"))
	define("ABSTRACTMAIL_NORMAL_PRIORITY", 3);
if (!defined("ABSTRACTMAIL_LOW_PRIORITY"))
	define("ABSTRACTMAIL_LOW_PRIORITY", 4);

/**
 * Abstract class used for email sender implementation classes
 *
 * @package			mail
 * @author			gustavo.gomes
 * @copyright		2006
 */
class AbstractMail {
	
	var $to = array();
	var $fromName;
	var $fromMail;
	var $subject;
	
	var $contentType;
	var $charset;
	
	var $priority = 3;
	
	var $headers = array();
	var $body;

	function AbstractMail($to, $subject, $fromName="", $fromMail="") {
		$this->to[] = $to;
		$this->subject = $subject;
		$this->fromName = $fromName;
		$this->fromMail = $fromMail;
		$this->init();
	}
	
	function init() {
		if ($this->fromName != "" && $this->fromMail != "") {
			$this->addHeader("From: ".$this->fromName." <".$this->fromMail.">");
			$this->addHeader("Reply-To: ".$this->fromName." <".$this->fromMail.">");
		} else if ($this->fromName == "" && $this->fromMail != "") {
			$this->addHeader("From: ".$this->fromMail);
			$this->addHeader("Reply-To: ".$this->fromMail);
		}
	}
	
	function getPriority() {
		return $this->priority;
	}
	
	function setPriority($priority) {
		$this->priority = $priority;
	}
	
	function getContentType() {
		return $this->contentType;
	}
	
	function getCharset() {
		return $this->charset;
	}
	
	function addTo($mail) {
		$this->to[] = $mail;
	}
	
	function addCC($mail) {
		$this->addHeader("CC:".$mail);
	}

	function addBCC($mail) {
		$this->addHeader("BCC:".$mail);
	}

	function addHeader($header) {
		$this->headers[] = $header;
	}
	
	function buildTo() {
		return implode(", ",$this->to);
	}
	
	function buildHeaders() {
		$headers = "";
		if (count($this->headers) > 0) {
			for ($i = 0;$i < count($this->headers)-1;$i++)
				$headers .= $this->headers[$i].ABSTRACTMAIL_CRLF;
			$headers .= $this->headers[$i];
		}
		return $headers;
	}
	
	function createMessageHeaders($contentType, $encode="") {
		$out = "";
		if ($encode != "")
			$out .= "Content-type:".$contentType."; charset=".$encode;
		else
			$out .= "Content-type:".$contentType.";";
		return $out;
	}

	function validateAddress($mailadresse) {
		if (!preg_match("/[a-z0-9_-]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4})/i",$mailadresse))
			return false;
		return true;
	}
	
	function resetHeaders() {
		$this->headers = array();
		$this->init();
	}
	
	function setBodyHtml($html, $charset="iso-8859-1") {}

	function setHtml($html, $charset="iso-8859-1") {}

	function setBodyText($text) {}
	
	function send() {}
	
}
?>
