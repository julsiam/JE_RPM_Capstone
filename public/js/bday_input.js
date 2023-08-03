// const bdateInput = document.getElementById('birthdate');
// const dateFormatRegex = /^(\d{4})[-/]?(\d{2})[-/]?(\d{2})$/;



// bdateInput.addEventListener('input', formatBirthdate);

// function formatBirthdate() {
//   let value = bdateInput.value.trim();

//   if (dateFormatRegex.test(value)) {
//     const [, year, month, day] = value.match(dateFormatRegex);
//     const maxYear = new Date().getFullYear();

//     // Ensure the year is between 1000 and the current year
//     const formattedYear = Math.min(maxYear, Math.max(1000, parseInt(year, 10)));

//     // Ensure the month is between 01 and 12
//     const formattedMonth = Math.min(12, Math.max(1, parseInt(month, 10)));

//     // Get the maximum number of days in the month
//     const maxDay = new Date(formattedYear, formattedMonth, 0).getDate();

//     // Ensure the day is between 01 and the maximum day of the month
//     const formattedDay = Math.min(maxDay, Math.max(1, parseInt(day, 10)));

//     // Format the date as "YYYY-MM-DD"
//     const formattedDate = `${formattedYear}-${String(formattedMonth).padStart(2, '0')}-${String(formattedDay).padStart(2, '0')}`;

//     bdateInput.value = formattedDate;

//   } else {
//     // If the input is not in the valid format, clear the value
//     bdateInput.value = '';
//   }
// }

function formatDate() {
    const birthdateInput = document.getElementById('birthdate');
    const selectedDate = new Date(birthdateInput.value);
    const formattedDate = selectedDate.toISOString().slice(0, 10);

    birthdateInput.value = formattedDate;
}
