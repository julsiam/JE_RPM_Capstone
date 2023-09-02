document.addEventListener('DOMContentLoaded', function () {

    const birthdateInput = document.getElementById('birthdate');
    const ageInput = document.getElementById('age');

    birthdateInput.addEventListener('change', updateAge);
    
    console.log("Trying to find birthdate input:", birthdateInput);


    function updateAge() {
        const birthdate = new Date(birthdateInput.value);
        const today = new Date();
        let age = today.getFullYear() - birthdate.getFullYear();

        // Adjust the age if the birthdate hasn't occurred yet this year
        if (today.getMonth() < birthdate.getMonth() ||
            (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
            age--;
        }

        ageInput.value = age;
    }
});




