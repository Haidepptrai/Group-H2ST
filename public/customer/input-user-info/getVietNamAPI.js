const selectProvince = document.getElementById('select-province');
const selectDistrict = document.getElementById('select-district');
const selectWards = document.getElementById('select-wards');
selectDistrict.disabled = true;
selectWards.disabled = true;


//Get province
fetch('https://provinces.open-api.vn/api/?depth=3')
    .then(response => response.json())
    .then(data => {
        // Process the data and update your application's state
        data.map((d) => {
            const option = document.createElement('option'); // Create a new option element
            option.value = d.name; // Add value for the option, d.code is the code of each city
            option.textContent = d.name; // Set the text content of the option, d.name is city name from api
            selectProvince.appendChild(option); // Append the option to the select element
        })

        //Happens when user select their city
        selectProvince.addEventListener("change", function () {
            //Get province code
            const getSelectProvince = selectProvince.value;
            selectDistrict.disabled = false;

            //Reset the district option
            selectDistrict.innerHTML = '<option selected disabled value="">Select District</option>';
            selectWards.innerHTML = '<option selected disabled value="">Select Ward</option>';

            //Get city details district. Find the specific city by it value set at beginning
            const selectedCityData = data.find(city => city.name === getSelectProvince);

            if (selectedCityData) {
                //Create district data of that province
                selectedCityData.districts.map((district) => {
                    const option = document.createElement('option');
                    option.value = district.name; //Set district value as its code for further purposes
                    option.textContent = district.name;
                    selectDistrict.appendChild(option);
                })

                //If user selected their district, the wards will came appear
                selectDistrict.addEventListener('change', function () {
                    //Get district code
                    const getSelectDistrict = selectDistrict.value;
                    selectWards.disabled = false;

                    //Reset the ward option
                    selectWards.innerHTML = '<option selected disabled value="">Select Ward</option>';

                    //Find specific district data
                    const selectedDistrictData = selectedCityData.districts.find(district => district.name === getSelectDistrict);

                    //Create ward data of that district
                    if (selectedDistrictData) {
                        selectedDistrictData.wards.map((wards) => {
                            const option = document.createElement('option');
                            option.value = wards.name;
                            option.textContent = wards.name;
                            selectWards.appendChild(option);
                        })
                    }
                })
            }
        })

    })
    .catch(error => {
        console.error('Error fetching data - Please reload the page:', error);
    });