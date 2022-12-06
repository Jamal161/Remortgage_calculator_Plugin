<div style="float:none" class="well-3 center-block-3 col-md-4-3">
				<div class="success_msg" style="color:red;display: none">				
				<?php
				global $wpdb;
				$resultrow = $wpdb->get_results("SELECT * FROM wc_calculator_guide");			
				foreach ( $resultrow as $row ) {
				$result = $row->popbg;	 
				}	
				calculator_guide_ajax_request();
				?>
				</div>
                <div class="error_msg" style="display: none">
				Not working, There is some error.
				</div>
			<h3>Loan Calculator</h3>
			<form name="myform" id="myform" action="" method="POST" enctype="multipart/form-data">
				<label>currently worth</label>
				<br />
				<input style="width:100%" placeholder="Loan Amount e.g 1500" id="loan_amount" name="loan_amount" type="text" value="" required="required" />
				<br />
				<label>mortgage balance</label>
				<br />
				<input style="width:100%" placeholder="Down Payment e.g 0" id="amount_down" name="amount_down" type="text" value="" required="required" />
				<br />
				<label>Mortgage term</label>
				<br />
				<input style="width:100%" placeholder="Loan length(Years) e.g 6" id="loan_length" name="loan_length" type="text" value="" required="required" />
				<br />
				<label>Deal</label>
				<select style="width:100%" id="term" name="term" size="1">
					<option value="Monthly" selected="selected">Monthly Payment:</option>
					<option value="Bi_weekly"<?php if(isset($_POST['term']) == "Bi_weekly") echo "selected";?>>Bi-weekly Payment:</option>
					<option value="Weekly"<?php if(isset($_POST['term']) == "Weekly") echo "selected";?>>Weekly Payment:</option>
				</select>
				<label>monthly payment</label><br>
				<select style="width:100%" id="term" name="term" size="1">
					<option value="Monthly" selected="selected">Monthly Payment:</option>
					<option value="Bi_weekly"<?php if(isset($_POST['term']) == "Bi_weekly") echo "selected";?>>Bi-weekly Payment:</option>
					<option value="Weekly"<?php if(isset($_POST['term']) == "Weekly") echo "selected";?>>Weekly Payment:</option>
				</select>
				
				<div style="clear:both">
					<br />
				</div>
				<input class="btn-lg-3 btn-primary-3" type='button' id='submit' name='submit' value='Calculate'/>
					
			</form>
			
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {   
$("#submit").click(function(){
if(document.myform.loan_amount.value.length==0){
alert("Please enter your Loan Amount number.");
}else if(!check_loan_amount(document.myform.loan_amount.value)){
alert("Loan Amount must contain a Valid numbers.\n");
}else if(document.myform.amount_down.value.length==0){
alert("Please enter your Down Payment number.");
}else if(!check_amount_down(document.myform.amount_down.value)){
alert("Down Payment must contain a Valid numbers.\n");
}else if(document.myform.loan_length.value.length==0){
alert("Please enter your Loan length number.");
}else if(!check_loan_length(document.myform.loan_length.value)){
alert("Loan length must contain a Valid numbers.\n");
}else if(document.myform.interest_rate.value.length==0){
alert("Please enter your Annual Interest number.");
}else if(!check_interest_rate(document.myform.interest_rate.value)){
alert("Annual Interest must contain a Valid numbers.\n");
}else{	
	
var loan_amountvalue=document.getElementById("myform").loan_amount.value 
var amount_downvalue=document.getElementById("myform").amount_down.value 
var loan_lengthvalue=document.getElementById("myform").loan_length.value 
var interest_ratevalue=document.getElementById("myform").interest_rate.value 
var termvalue=document.getElementById("myform").term.value 
      $.ajax({
          url: calculator_guide_ajaxurl, 
          data: {
              'action':'calculator_guide_ajax_request', 
			  'loan_amount':loan_amountvalue, 
			  'amount_down':amount_downvalue,
			  'loan_length':loan_lengthvalue,
			  'term':termvalue, 
			  'term':termvalue
          },
         
		  success:function(data) {
			if ( 'popup' == '<?php echo esc_html($result); ?>' ) {  
			  alert(data);
			  }
			  if ( 'block' == '<?php echo esc_html($result); ?>' ) {  
			  $(".success_msg").css("display","block");
		 
              $(".success_msg").text(data);
			  }
          },
          error: function(errorThrown){
              window.alert(errorThrown);
          }
		  	  
      });
	  
	
	  
    }  });
});
</script>