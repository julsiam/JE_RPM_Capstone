function calculateTotalBill() {
    // Get the values of 'room_rent', 'water_bill', and 'electric_bill' inputs
    const roomRent = parseFloat(document.getElementById('room_rent').value);
    const waterBill = parseFloat(document.getElementById('water_bill').value);
    const electricBill = parseFloat(document.getElementById('electric_bill').value);

    // Calculate the total bill by adding roomRent, waterBill, and electricBill
    const totalBill = roomRent + waterBill + electricBill;

    // Update the 'total_bill' input with the calculated value
    document.getElementById('total_bill').value = totalBill.toFixed(2);
}
