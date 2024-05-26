<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! function_exists ( 'getCertificateContents' )) {
	function getCertificateContents($certificate = array()) {
		$contents = "";
		if (empty ( $certificate ) || empty($certificate ["contents"])) {
			return $contents;
		}
		
		$background = "";
		if (isset ( $certificate ["background_image"] ) && ! empty ( $certificate ["background_image"] )) {
			$background = "background: transparent url(" . $certificate ["background_image"] . ") no-repeat  ; background-size: 100% 100%;";
		}
		$contents = "<div class='row' style='" . $background . "'>";
		$contents .= "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
		$contents .= $certificate ["contents"];
		$contents .= "</div>";
		$contents .= "</div>";
		
		return $contents;
	}
}

