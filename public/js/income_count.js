const month_select = $('#month_select');

function getMonthNo(month_name) {
    const months_ = {
        January: 1,
        February: 2,
        March: 3,
        April: 4,
        May: 5,
        June: 6,
        July: 7,
        August: 8,
        September: 9,
        October: 10,
        November: 11,
        December: 12
    };

    return months_ [month_name];
}


$(document).ready(function () {
    
    const currMonth = new Date().getMonth() + 1;

    const month_names = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    month_select.val(month_names[currMonth - 1]);


    function updateTotalIncome(){

        var _month = getMonthNo(month_select.val());

        $.ajax({
            url:'/get_total_income_per_month',
            method: 'GET',
            data: { month: _month },
            success:function(data){
                const totalIncome = data.totalIncome;
                $('#totalIncome').html(`₱ ${totalIncome}`);
            },
            error:function(error){
                console.error('Error fetching data: ', error);

            }
        })
    }

    $('#month_select').on('change', function(){
        const selectedMonth = $(this).val();
        updateTotalIncome(selectedMonth);
    })

});