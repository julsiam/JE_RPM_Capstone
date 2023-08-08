document.addEventListener('DOMContentLoaded', function() {
    // Your JavaScript code here
    const roomFeeDisplayInput = document.getElementById('room_fee_display');
    const waterBillInput = document.getElementById('water_bill');
    const electricBillInput = document.getElementById('electric_bill');
    const totalBillInput = document.getElementById('total_bill');

    roomFeeDisplayInput.addEventListener('input', calculateTotalBillAt);
    waterBillInput.addEventListener('input', calculateTotalBillAt);
    electricBillInput.addEventListener('input', calculateTotalBillAt);

    // Set initial total bill value to room fee display value
    totalBillInput.value = roomFeeDisplayInput.value;

    calculateTotalBillAt(); // Calculate initial total bill value
});

function calculateTotalBillAt() {
    // Get the values of 'room_fee_display', 'water_bill', and 'electric_bill' inputs
    const roomFeeDisplay = parseFloat(document.getElementById('room_fee_display').value) || 0;
    const waterBill = parseFloat(document.getElementById('water_bill').value) || 0;
    const electricBill = parseFloat(document.getElementById('electric_bill').value) || 0;

    // Calculate the total bill by adding roomFeeDisplay, waterBill, and electricBill
    const totalBill = roomFeeDisplay + waterBill + electricBill;

    // Update the 'total_bill' input with the calculated value
    document.getElementById('total_bill').value = totalBill.toFixed(2);
}
