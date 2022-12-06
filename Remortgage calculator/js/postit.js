function check_loan_amount(loan_amount) {
    var x=loan_amount;
    var filter=/^[0-9]+$/;
    if (filter.test(x)) {
        return true;
    }
    else {
        return false;
    }
}

function check_amount_down(amount_down) {
    var x=amount_down;
    var filter=/^[0-9]+$/;
    if (filter.test(x)) {
        return true;
    }
    else {
        return false;
    }
}

function check_loan_length(loan_length) {
    var x=loan_length;
    var filter=/^[0-9]+$/;
    if (filter.test(x)) {
        return true;
    }
    else {
        return false;
    }
}

function check_interest_rate(interest_rate) {
    var x=interest_rate;
    var filter=/^[0-9]+$/;
    if (filter.test(x)) {
        return true;
    }
    else {
        return false;
    }
}