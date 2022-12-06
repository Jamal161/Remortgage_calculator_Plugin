<?php
DEFINE("CALCULATOR_GUIDE_SEPARATOR","."); 
if(isset($_REQUEST['term'])){
	switch($_REQUEST["term"]) {
		case 'Weekly':
			$pay_term = 52;
			
			break;
		case 'Bi_weekly':
			$pay_term = 26;
			
			break;
		case 'Monthly':
			$pay_term = 12;
			
			break;
		default:
			$pay_term = 12;
			
			break;
	}
} else {
	$pay_term = 12;
	
}

if (!empty($_GET["price"])) {
	$starting_price = (int) $_REQUEST["price"];
} elseif (!empty(sanitize_text_field($_REQUEST["loan_amount"]))) {
	$starting_price = (int) sanitize_text_field($_REQUEST["loan_amount"]);
} else {
	$starting_price = 0;
}

$price             = sanitize_text_field($_REQUEST["loan_amount"])     ? number_format($starting_price, 2, CALCULATOR_GUIDE_SEPARATOR, '') : $starting_price;
$loan_length       = !empty(sanitize_text_field($_REQUEST["loan_length"]))    ? sanitize_text_field($_REQUEST["loan_length"]) : 3;
$down_payment      = sanitize_text_field($_REQUEST["amount_down"])     ? number_format(sanitize_text_field($_REQUEST["amount_down"]), 2, CALCULATOR_GUIDE_SEPARATOR, '') : 0;
if (isset($_REQUEST["interest_rate"]) && $_REQUEST["interest_rate"] == 0) {
	$annual_interest = 10;
} else {
	$annual_interest   = sanitize_text_field($_REQUEST["interest_rate"])  ? sanitize_text_field($_REQUEST["interest_rate"]) : 10;
}
$loan_amount       = $price - $down_payment;
$total_periods     = $loan_length * $pay_term;
$interest_percent  = $annual_interest / 100;
$period_interest   = $interest_percent / $pay_term;
$c_period_payment  = $loan_amount * ($period_interest / (1 - pow((1 + $period_interest), - ($total_periods))));
$total_paid        = number_format($c_period_payment * $total_periods, 2, CALCULATOR_GUIDE_SEPARATOR, '');
$total_interest    = number_format($c_period_payment * $total_periods - $loan_amount, 2, CALCULATOR_GUIDE_SEPARATOR, '');
$total_principal   = number_format($loan_amount, 2, CALCULATOR_GUIDE_SEPARATOR, '');

$total_loan_amount = number_format($loan_amount + $total_interest, 2, CALCULATOR_GUIDE_SEPARATOR, '');
$annual_interest   = number_format($annual_interest, 2, CALCULATOR_GUIDE_SEPARATOR, '');
$period_payment    = number_format($c_period_payment, 2, CALCULATOR_GUIDE_SEPARATOR, '');

$output = sanitize_text_field($_REQUEST['term']);	
if(isset($_REQUEST['term']) == "Weekly"){
 echo $output.":".esc_html($period_payment);
} else if(isset($_REQUEST['term']) == "Bi_weekly"){
 echo $output.":".esc_html($period_payment);
} else {  
 echo $output.":".esc_html($period_payment);
} 
	
?>
