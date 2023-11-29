document.addEventListener('DOMContentLoaded', function () {

    const roomFeeDisplayInput = document.getElementById('room_fee_display');
    const waterBillInput = document.getElementById('water_bill');
    const electricBillInput = document.getElementById('electric_bill');
    // const totalBillInput = document.getElementById('total_bill');

    roomFeeDisplayInput.addEventListener('input', calculateTotalBillAndStatus);
    waterBillInput.addEventListener('input', calculateTotalBillAndStatus);
    electricBillInput.addEventListener('input', calculateTotalBillAndStatus);

    calculateTotalBillAndStatus();
});

function calculateTotalBillAndStatus() {
    const roomFeeDisplay = parseFloat(document.getElementById('room_fee_display').value) || 0;
    const waterBill = parseFloat(document.getElementById('water_bill').value) || 0;
    const electricBill = parseFloat(document.getElementById('electric_bill').value) || 0;


    const amountPaid = parseFloat(document.getElementById('amount_paid').value) || 0;

    const rentalStatusInput = document.getElementById('rentalStatus')

    const totalBill = roomFeeDisplay + waterBill + electricBill;

    const totalBillStr = totalBill.toFixed(2).toString();
    const firstThreeDigitsTotalBill = parseFloat(totalBillStr.substr(0, 3));

    let balance = totalBill - amountPaid;

    if (amountPaid === 0 && balance === totalBill) {
        rentalStatusInput.value = 'Not Yet Paid';
    } else if (amountPaid < totalBill && balance > 0) {
        rentalStatusInput.value = 'Not Fully Paid';
    } else if (amountPaid >= totalBill) {
        rentalStatusInput.value = 'Paid';
        balance = 0;
    } else if (amountPaid >= firstThreeDigitsTotalBill) {
        // Check if the first three digits of amount paid match or exceed total bill
        rentalStatusInput.value = 'Paid';
        balance = 0;
    } else {
        rentalStatusInput.value = 'Test';
    }

    document.getElementById('total_bill').value = totalBill.toFixed(2);
    document.getElementById('balance').value = balance.toFixed(2);
}

