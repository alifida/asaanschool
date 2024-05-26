<?php



/* $source="http://asaanschool.com/uploads/users/OO/profile-pic.jpg";
$source = substr($source,  strpos($source, "/uploads/"),strlen($source) );

echo $source;
die; */



require '/vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
require '/vendor/cloudinary/cloudinary_php/src/Uploader.php';
require '/vendor/cloudinary/cloudinary_php/src/Error.php';
\Cloudinary::config(array(
		"cloud_name" => "hbgvcyjil",
		"api_key" => "544661793883191",
		"api_secret" => "pVSuoqf2R0ooOyRVMvbPgZbHNbs"
));
$options = array(
				'width' => 180,
				'height' => 180,
				'crop' => 'fit',
				'public_id' => 'uploads/campuses/ss/NG49vxHsVPXGLTiUezHK-campus-logo-thumb'
				 
		)
		;
$res = \Cloudinary\Uploader::upload("d:/alifida.jpg", $options);
echo "<pre>";
print_r ($res);
echo "</pre>";
?>