<style type="text/css">
    .show {
        height:30px;
    }

    .wrap h2 {
        margin:20px 0 0 0;
}

    .widefat {
    margin:10px 0 0 0;
    }

    .wrap .input_box {
        padding: 3px 8px;
        font-size: 14px;
        line-height: 100%;
        margin:10px 20px 10px 5px;
        outline: 0;
        border-color: #ccc;
}

    .wrap label {
        color:#555;
        margin:-3px 0 0 0;
        font-size:15px;        
        }

        .wrap .editlink {
            background:url('<?php echo get_template_directory_uri(); ?>/style/img/grey-arrow.png') no-repeat right top;
            padding:0 20px 0 0;
}
    .clicked {
        background-position:bottom right !important;
    }
    .submit_button {
        margin:15px 0 0 0;
}

    .margin {
        margin: 0 0 0 20px;
    }

    </style>

<?php
global $wpdb;
   $title = '';
   $link = '';
   $imagelink = '';
if(!empty($_POST['link'])) {
   $title = $_POST['title'];   
   $link = $_POST['link'];
   $imagelink = $_POST['imagelink'];

   $title = addslashes($title);
   $link = addslashes($link);
   $imagelink = addslashes($imagelink);

   

   $wpdb->query(
	$wpdb->prepare(
            "INSERT INTO " .$wpdb->prefix. "advertising (title, link, imagelink) VALUES('$title', '$link', '$imagelink' )"
        )
);
   $title = '';
   $link = '';
   $imagelink = '';
}
if(isset($_GET['delete_advert'])) {
   $advert_id = $_GET['delete_advert'];
   $wpdb->query(
	$wpdb->prepare(
                "DELETE FROM " .$wpdb->prefix. "advertising WHERE ID = '$advert_id'"));
            
}

if(isset($_POST['title_edit'])) {    
   $title_edit = $_POST['title_edit'];
   $link_edit = $_POST['link_edit'];
   $imagelink_edit = $_POST['imagelink_edit'];
   $post_id = $_POST['post_id'];

   $title_edit = addslashes($title_edit);
   $link_edit = addslashes($link_edit);
   $imagelink_edit = addslashes($imagelink_edit);


   $wpdb->query(
	$wpdb->prepare(
           "UPDATE " .$wpdb->prefix. "advertising SET title= '$title_edit', link = '$link_edit', imagelink= '$imagelink_edit' WHERE ID = '$post_id'"
       )
);
}


?>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('.editlink').each(function(){
            jQuery(this).click(function(){
            
               var id = jQuery(this).attr('rel');
               jQuery('.show'+id).toggle("slow");
               
               jQuery('#editlink'+id).toggleClass('clicked');
        });
       
            });
          
        });

</script>

<div class="wrap">
<h2>Advertising</h2>
<p>Please make sure your banner images are 125x125px</p>

<form method="post"  name="advert_name" action="">

<label>Title</label>
<input class="input_box" type="text" id="title" name="title"  />

<label>Link</label>
<input class="input_box" type="text" id="link" name="link" />

<label>Image Link</label>
<input class="upload-url input_box" id="imagelink" type="text" size="36" name="imagelink" value="" />
<input class="st_upload_button" id="'imagelink" type="button" value="Upload" />

<input type="submit" value="Submit" class="margin" />

</form>





<?php
global $wpdb;
 $querystr = "SELECT * FROM " . $wpdb->prefix . "advertising ORDER BY id DESC";
 $pageposts = $wpdb->get_results($querystr, OBJECT);



 //print_r($pageposts);
 ?>



<table class="widefat">
<thead>
    <tr>
        <th>Advertisement ID</th>
        <th>Advertisement Title</th>
        <th>Advertisement link</th>
        <th>Banner</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>Advertisement ID</th>
        <th>Advertisement Title</th>
        <th>Advertisement link</th>
        <th>Banner</th>
        <th>Edit</th>
        <th>Delete</th>
       
    </tr>
</tfoot>
<tbody>
<?php
@$post_count = 0;
foreach ($pageposts as $post){

echo '<tr>
     <td>'.$post->ID.'</td>
     <td>'.stripslashes($post->title).'</td>
     <td>'.stripslashes($post->link).'</td>
     <td>'.stripslashes($post->imagelink).'</td>
     <td><a href="#" rel='.$post->ID.' id="editlink'.$post->ID.'" class="editlink">Edit</a></td>
     <td><a href="admin.php?page=advert_widget&delete_advert='.$post->ID.'">Delete</a></td>
     
   </tr>
<tr  class="show'.$post->ID.' show" style="display:none" >
     <td>'.$post->ID.'</td>
     <form method="post"  name="advert_name_edit" action="">
     <td><input class="input_box" type="text" id="title_edit" name="title_edit" value="'.esc_attr(stripslashes($post->title)).'" /></td>
     <td><input class="input_box" type="text" id="title_edit" name="link_edit" value="'.esc_attr(stripslashes($post->link)).'" /></td>
     <td>
     <input class="upload-url input_box" id="upload'.$post->ID.'" type="text" size="36" name="imagelink_edit" value="'.esc_attr(stripslashes($post->imagelink)).'" />
     <input class="st_upload_button" id="upload'.$post->ID.'" type="button" value="Upload" />
    </td>
     <td><input type="submit" value="save" class="submit_button" /></td>
     <td><input type="hidden" id="post_id" value="'.$post->ID.'" name="post_id" /></td>
     </form>
   </tr>   
';
$post_count++;
}
if($post_count == 0){
    echo '<tr>
<td>No active advertisements at the moment.</td>
</tr>';
}
?>
</tbody>
</table>


</div>