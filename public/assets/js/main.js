$(document).ready(function() {
    $('#btnDelete').click(function() {
        if (confirm('Are you sure delete this item?')) {
            return true;
        }
        return false;
    });
});