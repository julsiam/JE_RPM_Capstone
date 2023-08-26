$(document).ready(function(){
    const currentMonth = new Date().getMonth() + 1;
    const currentYear = new Date().getFullYear();
    console.log(currentMonth);

    $('#month').val(currentMonth);
    $('#year').val(currentYear);
})
