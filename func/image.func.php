<?php

function upload_image($image_temp, $image_ext, $album_id)  {
$album_id= (int)$album_id;

mysql_query("INSERT INTO `images` (`image_id`,`user_id`,`album_id`,`timestamp`,`ext`,`del_est_img`) VALUES('','".$_SESSION['id']."','$album_id',UNIX_TIMESTAMP(),'$image_ext','')");
$image_id= mysql_insert_id();
$image_file= $image_id.'.'.$image_ext;

move_uploaded_file($image_temp,'uploads/'.$album_id.'/'.$image_file);
create_thumb('uploads/'.$album_id.'/', $image_file, 'uploads/thumbs/'.$album_id.'/');
create_thumb_big('uploads/'.$album_id.'/', $image_file, 'uploads/thumbs/big/'.$album_id.'/');
create_thumb_small('uploads/'.$album_id.'/', $image_file, 'uploads/thumbs/small/'.$album_id.'/');
}



function upload_secun_images($r_image_temp, $r_image_ext, $sec_album_id,$id_item)  {

if (!empty($r_image_temp)) {
foreach ($r_image_temp as $index => $temp) {

mysql_query("INSERT INTO `item_sec_images` (`image_id`,`id_item`,`user_id`,`album_id`,`timestamp`,`ext`,`del_est_img`) VALUES('','$id_item','".$_SESSION['id']."','$sec_album_id[$index]',UNIX_TIMESTAMP(),'$r_image_ext[$index]','')");
$image_id= mysql_insert_id();
$image_file= $image_id.'.'.$r_image_ext[$index];

move_uploaded_file($temp[$index],'uploads/'.$sec_album_id[$index].'/'.$image_file);
create_thumb_small('uploads/'.$sec_album_id[$index].'/', $image_file, 'uploads/thumbs/'.$sec_album_id[$index].'/');
create_thumb_big('uploads/'.$sec_album_id[$index].'/', $image_file, 'uploads/thumbs/big/'.$sec_album_id[$index].'/');
}

}
}



function upload_image_small($image_temp, $image_ext, $album_id)  {
$album_id= (int)$album_id;

mysql_query("INSERT INTO `images` (`image_id`,`user_id`,`album_id`,`timestamp`,`ext`,`del_est_img`) VALUES('','".$_SESSION['id']."','$album_id',UNIX_TIMESTAMP(),'$image_ext','')");
$image_id= mysql_insert_id();
$image_file= $image_id.'.'.$image_ext;

move_uploaded_file($image_temp,'uploads/'.$album_id.'/'.$image_file);
create_thumb_small('uploads/'.$album_id.'/', $image_file, 'uploads/thumbs/'.$album_id.'/');
}


function upload_image_col($image_temp, $image_ext, $album_id)  {
$album_id= (int)$album_id;

mysql_query("INSERT INTO `images` (`image_id`,`user_id`,`album_id`,`timestamp`,`ext`,`del_est_img`) VALUES('','".$_SESSION['id']."','$album_id',UNIX_TIMESTAMP(),'$image_ext','')");
$image_id= mysql_insert_id();
$image_file= $image_id.'.'.$image_ext;

move_uploaded_file($image_temp,'uploads/'.$album_id.'/'.$image_file);
create_thumb_color('uploads/'.$album_id.'/', $image_file, 'uploads/thumbs/color/'.$album_id.'/');
}


function get_images($album_id){
$album_id= (int)$album_id;
$images= array();

$image_query= mysql_query("SELECT `image_id`, `album_id`, `timestamp`, `ext` FROM `images` WHERE `album_id`=$album_id AND del_est_img=0 AND `user_id`=".$_SESSION['id']);
while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']

);

}

return $images;

}


function get_images_it_type($id_it_type){
$id_it_type= (int)$id_it_type;
$images= array();

$image_query= mysql_query("SELECT it.id_item,it.id_it_type, im.image_id, im.ext
FROM images AS im, items AS it
WHERE it.id_it_type ='$id_it_type'
AND im.del_est_img =0
AND it.del_est_item =  '0'");
while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id_it_type' => $images_row['id_it_type'],
 'id_item' => $images_row['id_item'],
 'id' => $images_row['image_id'],
 'ext' => $images_row['ext']

);

}

return $images;

}

function get_index_images(){
//$album_id= (int)$album_id;
$images= array();

$image_query= mysql_query("SELECT it.id_item,it.image_id,im.image_id, im.album_id, im.timestamp, im.ext,itd.id_qua FROM images AS im,items AS it,items_detail AS itd WHERE it.image_id=im.image_id AND del_est_img=0 AND itd.id_item=it.id_item AND itd.id_qua <> '0' AND itd.del_est_itd = '0' group BY itd.id_item DESC LIMIT 12");

while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']

);

}

return $images;

}



function get_occ_images($pkey,$start,$per_page){
//$album_id= (int)$album_id;
$images= array();
$image_query= mysql_query("SELECT it.image_id,it.id_item,it.id_oct,im.image_id, im.album_id, im.timestamp, im.ext,oc.id_oct FROM images AS im,items AS it,occations AS oc, items_detail AS itd WHERE it.id_item=itd.id_item AND itd.id_qua <> '0' AND itd.del_est_itd = '0' AND oc.id_oct='$pkey' AND it.id_oct='$pkey' AND it.image_id=im.image_id AND del_est_img=0 GROUP BY itd.id_item DESC LIMIT $start,$per_page");


while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']
);
}
return $images;
}



function get_col_images($pkey,$start,$per_page){
$images= array();
$image_query= mysql_query("SELECT it.image_id,it.id_item,it.id_oct,im.image_id, im.album_id, im.timestamp, im.ext,co.id_color,itc.id_color,itc.id_item,itd.id_qua FROM images AS im,items AS it,colors AS co,item_main_color AS itc,items_detail AS itd WHERE itd.id_qua <> '0' AND itd.del_est_itd = '0' AND itc.id_item=itd.id_item AND co.id_color='$pkey' AND itc.id_color='$pkey' AND co.id_color=itc.id_color AND it.image_id=im.image_id AND itc.id_item=it.id_item AND del_est_img=0 GROUP BY itd.id_item DESC LIMIT $start,$per_page");


while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']
);
}
return $images;
}

function get_pri_images($pkey,$start,$per_page){
//$album_id= (int)$album_id;
$images= array();
$image_query= mysql_query("SELECT it.image_id,it.id_item,it.pri_it,im.image_id, im.album_id, im.timestamp, im.ext FROM images AS im,items AS it, items_detail AS itd WHERE it.pri_it < '$pkey' AND itd.id_qua <> '0' AND it.id_item=itd.id_item AND itd.del_est_itd = '0' AND it.image_id=im.image_id AND del_est_img=0  AND it.del_est_item= '0' GROUP BY itd.id_item DESC LIMIT $start,$per_page");

while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']
);

}
return $images;
}



function get_menu_images($itype,$iist,$iistc,$start,$per_page){
//$album_id= (int)$album_id;
$images= array();
//$image_query= mysql_query("SELECT it.image_id,it.id_item,it.pri_it,im.image_id, im.album_id, im.timestamp, im.ext FROM images AS im,items AS it, items_detail AS itd WHERE it.pri_it < '$pkey' AND itd.id_qua <> '0' AND it.id_item=itd.id_item AND itd.del_est_itd = '0' AND it.image_id=im.image_id AND del_est_img=0  AND it.del_est_item= '0' GROUP BY itd.id_item DESC LIMIT $start,$per_page");$image_query= mysql_query("SELECT it.image_id,it.id_item,it.pri_it,im.image_id, im.album_id, im.timestamp, im.ext FROM images AS im,items AS it, items_detail AS itd WHERE it.pri_it < '$pkey' AND itd.id_qua <> '0' AND it.id_item=itd.id_item AND itd.del_est_itd = '0' AND it.image_id=im.image_id AND del_est_img=0  AND it.del_est_item= '0' GROUP BY itd.id_item DESC LIMIT $start,$per_page");

$image_query= mysql_query("SELECT it.image_id,it.id_item,it.pri_it,im.image_id, im.album_id, im.timestamp, im.ext FROM images AS im,items AS it, items_detail AS itd WHERE it.id_it_type = '$itype' AND it.id_ist = '$iist' AND it.id_istc = '$iistc'  AND itd.id_qua <> '0' AND it.id_item=itd.id_item AND itd.del_est_itd = '0' AND it.image_id=im.image_id AND del_est_img=0  AND it.del_est_item= '0' GROUP BY itd.id_item DESC LIMIT $start,$per_page");

while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']
);

}
return $images;
}


function image_check($image_id){
$image_id= (int)$image_id;
$query= mysql_query("SELECT COUNT(`image_id`) FROM `images` WHERE `image_id`=$image_id AND del_est_img=0 AND `user_id`=".$_SESSION['id']);
return (mysql_result($query, 0) == 0)  ? false : true;


}


function erase_image($image_id) {

$image_id= (int)$image_id;
$image_query= mysql_query("SELECT `album_id`,`ext` FROM `images` WHERE `image_id`=$image_id");
$image_result= mysql_fetch_assoc($image_query);

$album_id= $image_result['album_id'];
$image_ext= $image_result['ext'];

unlink('uploads/'.$album_id.'/'.$image_id.'.'.$image_ext);
unlink('uploads/thumbs/'.$album_id.'/'.$image_id.'.'.$image_ext);

$sql_ditmc="UPDATE `images` SET del_est_img=1 WHERE image_id='$image_id'";
$re_ditmc=mysql_query($sql_ditmc) or die ("There was an error while deleting the image data").mysql_error();

}




function delete_image($image_id) {

$image_id= (int)$image_id;
$image_query= mysql_query("SELECT `album_id`,`ext` FROM `images` WHERE `image_id`=$image_id AND `user_id`=".$_SESSION['id']);
$image_result= mysql_fetch_assoc($image_query);

$album_id= $image_result['album_id'];
$image_ext= $image_result['ext'];

unlink('uploads/'.$album_id.'/'.$image_id.'.'.$image_ext);
unlink('uploads/thumbs/'.$album_id.'/'.$image_id.'.'.$image_ext);

mysql_query("DELETE from `images` WHERE `image_id`= $image_id AND `user_id`=".$_SESSION['id']);
}


function removeqsvar($request, $varname) {
    return preg_replace('/([?&])'.$varname.'=[^&]+(&|$)/','$1',$request);
}


function get_view_images($id_item){
$id_item= (int)$id_item;
$images= array();

//$image_query= mysql_query("SELECT `it.id_item`,`isi.image_id`, `isi.album_id`, `isi.timestamp`, `isi.ext`, `isi.id_item` FROM `item_sec_images` AS isi AND `items` AS it WHERE `album_id`= '8' AND del_est_img=0 AND isi.id_item='$id_item' AND it.id_item=isi.id_item");
$image_query= mysql_query("SELECT `id_item`,`image_id`, `album_id`, `timestamp`, `ext` FROM `item_sec_images` WHERE `album_id`='8' AND del_est_img=0 AND id_item='$id_item'");
while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'timestamp' => $images_row['timestamp'],
 'ext' => $images_row['ext']

);

}

return $images;

}



function ajaxget_images($id_item){
//$id_est= (int)$album_id;
$images= array();

$image_query= mysql_query("SELECT `it.id_item`, `im.album_id`, `im.ext` , `im.del_est_img` FROM `images` AS im, `items` AS it WHERE `it.id_item`=$id_item AND `it.image_id`=`im.image_id` AND it.del_est_item='0' AND im.del_est_img = '0'");
while ($images_row = mysql_fetch_assoc($image_query)) {
$images[]= array(
 'image_id' => $images_row['image_id'],
 'id_item' => $images_row['id_item'],
 'album' => $images_row['album_id'],
 'ext' => $images_row['ext']

);

}

return $images;

}

?>