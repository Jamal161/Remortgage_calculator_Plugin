<?php
$current_url = admin_url( "admin.php?page=".$_REQUEST["page"] ); 
if(isset($_REQUEST['Submit']) && trim($_REQUEST['Submit']) == "Update")	{
				$coun=sanitize_text_field($_REQUEST['country']);
				$result = $wpdb->query($wpdb->prepare( "UPDATE wc_calculator_guide SET 
						popbg='$coun'" ));
			if ($result){
			header("location:$current_url&msg=edit");
			}
}				
$p_count = "";
$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM wc_calculator_guide"));
if($result)
		{
			foreach($result as $row)
			{			
				$p_count = sanitize_text_field($row->popbg);
					
			}
		}			
?>
<div style="float:none" class="well-3 center-block-3 col-md-4-3">		
	<form action="" method="post" enctype="multipart/form-data" >
		<span style="color:red">
		<?php
		if(isset($_REQUEST['msg']))
		{
			echo esc_html($mess[$_REQUEST['msg']]); 
		}
		?>
		</span><br />
		<h3>Calculator Guide Admin Page</h3>
		  <label>*Display Result:</label>
		  <br />
				<select style="width:100%" required id="country" name="country" size="1">
					<option value="<?php echo esc_html($p_count); ?>" disabled selected>Select your option</option>
					<option value="popup"<?php if(isset($_POST['country']) == "popup") echo "selected";?>>Alert popup display</option>
					<option value="block"<?php if(isset($_POST['country']) == "block") echo "selected";?>>Block display on form</option>
				</select>
		 <br />
         <div style="clear:both"><br /></div> 
       
         <input name="Submit" type="submit" class="btn" id="submit" value="Update" onclick="return check();"/>
       
        </form>
    
</div>