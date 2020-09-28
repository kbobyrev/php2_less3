<?php

function getAllPictures($link){
	$strSQL ="SELECT photo.id, photo.photo_name, count(views.id) AS v_count FROM photo LEFT JOIN views ON photo.id =views.photo_id GROUP BY photo.id, photo.photo_name ORDER BY v_count DESC;";
	$result =mysqli_query($link,$strSQL);

	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$images[]=$row;
		}
		return $images;
	}
}
function prepareArray($images){
	foreach($images as $image){
		$link = 'showBig.php?id='.$image['id'];
		$source ='img/small/'.$image['photo_name'];
		$imageToTempl =array(
			"link"=>$link,
			"source"=>$source,
			"seen"=>$image['v_count']
		);
		$imagesToTempl[]=$imageToTempl;
	}
		return $imagesToTempl;
}

function getPhotoNameByID($id,$link){
	$strSQL ="SELECT photo.photo_name FROM photo WHERE photo.id=$id";
	$result =mysqli_query($link,$strSQL);
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
			$photoName=$row['photo_name'];
		}
		return $photoName;
	}
}
?>