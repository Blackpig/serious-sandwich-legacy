<?php


if (!defined("MULTIPART_DISPOSITION_ATTACHMENT"))
	define("MULTIPART_DISPOSITION_ATTACHMENT", "attachment");
if (!defined("MULTIPART_DISPOSITION_INLINE"))
	define("MULTIPART_DISPOSITION_INLINE", "inline");

/**
 * Representation for a attachment
 *
 * @package			mail
 * @author			gustavo.gomes
 * @copyright		2006
 */
class Multipart {
	
	var $content;
	
	var $disposition;
	
	function Multipart($file="",$disposition="attachment") {
		if ($file != "")
			$this->setContent($file, $disposition);
	}
	
	function getContent() {
		return $this->content;
	}
	
	function getDisposition() {
		return $this->disposition;
	}
	
	/**
	 * Use for $disposition "attachment" or "inline"
	 * (f.e. example images inside a html mail
	 * 
	 * @param	file	string - nome do arquivo
	 * @param	disposition	string
	 * @return	boolean
	 */
	function setContent($file, $disposition = "attachment") {
		$this->disposition = $disposition.
		$fileContent = $this->getFileData($file);
		if ($fileContent != "") {
			$filename = basename($file);
			if (function_exists("mime_content_type"))
				$fileType = mime_content_type($file);
			else
				$fileType = "";
			$chunks = chunk_split(base64_encode($fileContent));
			
			$mailPart = "";
			if ($fileType)
				$mailPart .= "Content-type:".$fileType.";".ABSTRACTMAIL_CRLF.chr(9)." name=\"".$filename."\"".ABSTRACTMAIL_CRLF;
			$mailPart .= "Content-length:".filesize($file).ABSTRACTMAIL_CRLF;
			$mailPart .= "Content-Transfer-Encoding: base64".ABSTRACTMAIL_CRLF;
			$mailPart .= "Content-Disposition: ".$disposition.";".chr(9)."filename=\"".$filename."\"".ABSTRACTMAIL_CRLF.ABSTRACTMAIL_CRLF;
			$mailPart .= $chunks;
			$mailPart .= ABSTRACTMAIL_CRLF.ABSTRACTMAIL_CRLF;
			$this->content = $mailPart;
				return true;
		}			
		return false;
	}
	
	function getFileData($filename) {
		if (file_exists($filename))
			return file_get_contents($filename);
		return "";
	}
}
?>
