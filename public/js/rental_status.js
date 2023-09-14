document.addEventListener('DOMContentLoaded', function () {
    const roomFeeInput = document.getElementById('edit_room_rent');
    const waterBill = document.getElementById('edit_water_bill');
    const electricBill = document.getElementById('edit_electric_bill');

    roomFeeInput.addEventListener('input', calculateEditTotalBillAndStatus);
    waterBill.addEventListener('input', calculateEditTotalBillAndStatus);
    electricBill.addEventListener('input', calculateEditTotalBillAndStatus);

    calculateEditTotalBillAndStatus();
});

function calculateEditTotalBillAndStatus() {
    const roomRent = parseFloat(document.getElementById('edit_room_rent').value) || 0;
    const waterFee = parseFloat(document.getElementById('edit_water_bill').value) || 0;
    const electricFee= parseFloat(document.getElementById('edit_electric_bill').value) || 0;

    const amountPaid = parseFloat(document.getElementById('edit_amount_paid').value) || 0;

    const rentalStatusInput = document.getElementById('edit_status')

    const totalBill = roomRent + waterFee + electricFee;

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

    document.getElementById('edit_total_bill').value = totalBill.toFixed(2);
    document.getElementById('edit_balance').value = balance.toFixed(2);
}
