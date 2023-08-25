const selectProvince = document.getElementById("select-province");
const selectDistrict = document.getElementById("select-district");
const selectWards = document.getElementById("select-wards");
const selectStreet = document.getElementById("userAddress");
selectDistrict.disabled = true;
selectWards.disabled = true;

//Get province
fetch("https://provinces.open-api.vn/api/?depth=3")
    .then((response) => response.json())
    .then((data) => {
        // Process the data and update your application's state
        data.map((d) => {
            const option = document.createElement("option"); // Create a new option element
            option.value = d.name; // Add value for the option, d.code is the code of each city
            option.textContent = d.name; // Set the text content of the option, d.name is city name from api
            selectProvince.appendChild(option); // Append the option to the select element
        });

        //Happens when user select their city
        selectProvince.addEventListener("change", function () {
            //Get province code
            const getSelectProvince = selectProvince.value;
            selectDistrict.disabled = false;

            //Reset the district option
            selectDistrict.innerHTML =
                '<option selected disabled value="">Select District</option>';
            selectWards.innerHTML =
                '<option selected disabled value="">Select Ward</option>';

            //Get city details district. Find the specific city by it value set at beginning
            const selectedCityData = data.find(
                (city) => city.name === getSelectProvince
            );

            if (selectedCityData) {
                //Create district data of that province
                selectedCityData.districts.map((district) => {
                    const option = document.createElement("option");
                    option.value = district.name; //Set district value as its code for further purposes
                    option.textContent = district.name;
                    selectDistrict.appendChild(option);
                });

                //If user selected their district, the wards will came appear
                selectDistrict.addEventListener("change", function () {
                    //Get district code
                    const getSelectDistrict = selectDistrict.value;
                    selectWards.disabled = false;

                    //Reset the ward option
                    selectWards.innerHTML =
                        '<option selected disabled value="">Select Ward</option>';

                    //Find specific district data
                    const selectedDistrictData =
                        selectedCityData.districts.find(
                            (district) => district.name === getSelectDistrict
                        );

                    //Create ward data of that district
                    if (selectedDistrictData) {
                        selectedDistrictData.wards.map((wards) => {
                            const option = document.createElement("option");
                            option.value = wards.name;
                            option.textContent = wards.name;
                            selectWards.appendChild(option);
                        });
                    }
                });
            }
        });
    })
    .catch((error) => {
        console.error("Error fetching data - Please reload the page:", error);
    });


if (selectWards.value !== ""){
    const provinceName = selectProvince.value;
    const district = selectDistrict.value;
    const ward = selectWards.value;
    const street = selectStreet.value;

    const fullAddress = `post office near ${ward}, ${district}, ${provinceName}, Vietnam`;
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode(
        { address: fullAddress + ", Vietnam" },
        (results, status) => {
            if (status === "OK" && results[0]) {
                const postalAddress = results[0].geometry.location;

                const destinationAddress = `${street}, ${ward}, ${district}, ${provinceName}, Vietnam`;
                geocoder.geocode(
                    { address: destinationAddress },
                    (destinationResults, destinationStatus) => {
                        if (
                            destinationStatus === "OK" &&
                            destinationResults[0]
                        ) {
                            const destination =
                                destinationResults[0].geometry.location;

                            const distance =
                                google.maps.geometry.spherical.computeDistanceBetween(
                                    postalAddress,
                                    destination
                                ) / 1000; // Distance in kilometers

                            const shippingCost =
                                calculateCostBasedOnDistance(distance);

                            document.getElementById(
                                "shippingCost"
                            ).value = `${shippingCost}`;

                            initMap(postalAddress, destination);
                        }
                    }
                );
            }
        }
    );

    function initMap(postalAddress, destination) {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: postalAddress,
            zoom: 12,
        });

        const provinceMarker = new google.maps.Marker({
            position: postalAddress,
            map,
            title: "Viettel Postal",
        });

        const destinationMarker = new google.maps.Marker({
            position: destination,
            map,
            title: "Destination",
        });

        const distance =
            google.maps.geometry.spherical.computeDistanceBetween(
                postalAddress,
                destination
            ) / 1000;

        const distanceInfoWindow = new google.maps.InfoWindow({
            content: `Distance: ${distance.toFixed(2)} km`,
        });

        distanceInfoWindow.open(map, destinationMarker);
    }

    function calculateCostBasedOnDistance(distance) {
        switch (true) {
            case distance === 0:
                return 5; // Approximate conversion of 20,000 VND to USD
            case distance < 0.5:
                return distance * 20;
            case distance <= 1:
                return distance * 10;
            case distance <= 2:
                return distance * 5;
            case distance <= 4:
                return distance * 5;
            case distance <= 6:
                return distance * 2.3;
            case distance >= 10:
                return distance * 1.5;
            default:
                return distance * 2;
        }
    }
}
selectWards.addEventListener("change", function () {
    const provinceName = selectProvince.value;
    const district = selectDistrict.value;
    const ward = selectWards.value;
    const street = selectStreet.value;

    const fullAddress = `Viettel POST near ${ward}, ${district}, ${provinceName}, Vietnam`;
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode(
        { address: fullAddress + ", Vietnam" },
        (results, status) => {
            if (status === "OK" && results[0]) {
                const postalAddress = results[0].geometry.location;

                const destinationAddress = `${street}, ${ward}, ${district}, ${provinceName}, Vietnam`;
                geocoder.geocode(
                    { address: destinationAddress },
                    (destinationResults, destinationStatus) => {
                        if (
                            destinationStatus === "OK" &&
                            destinationResults[0]
                        ) {
                            const destination =
                                destinationResults[0].geometry.location;

                            const distance =
                                google.maps.geometry.spherical.computeDistanceBetween(
                                    postalAddress,
                                    destination
                                ) / 1000; // Distance in kilometers

                            const shippingCost =
                                calculateCostBasedOnDistance(distance);

                            const formattedShippingCost =
                                shippingCost.toLocaleString("en-US", {
                                    style: "currency",
                                    currency: "USD",
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                });

                            document.getElementById(
                                "shippingCost"
                            ).value = `${formattedShippingCost}`;

                            initMap(postalAddress, destination);
                        }
                    }
                );
            }
        }
    );

    function initMap(postalAddress, destination) {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: postalAddress,
            zoom: 12,
        });

        const provinceMarker = new google.maps.Marker({
            position: postalAddress,
            map,
            title: "Viettel Postal",
        });

        const destinationMarker = new google.maps.Marker({
            position: destination,
            map,
            title: "Destination",
        });

        const distance =
            google.maps.geometry.spherical.computeDistanceBetween(
                postalAddress,
                destination
            ) / 1000;

        const distanceInfoWindow = new google.maps.InfoWindow({
            content: `Distance: ${distance.toFixed(2)} km`,
        });

        distanceInfoWindow.open(map, destinationMarker);
    }

    function calculateCostBasedOnDistance(distance) {
        switch (true) {
            case distance === 0:
                return 5; // Approximate conversion of 20,000 VND to USD
            case distance < 0.5:
                return distance * 20;
            case distance <= 1:
                return distance * 10;
            case distance <= 2:
                return distance * 5;
            case distance <= 4:
                return distance * 5;
            case distance <= 6:
                return distance * 2.3;
            case distance >= 10:
                return distance * 1.5;
            default:
                return distance * 2;
        }
    }
});

selectStreet.addEventListener("input", function () {
    // Reset the district and wards options
    selectDistrict.value = "";
    selectWards.value = "";
});
