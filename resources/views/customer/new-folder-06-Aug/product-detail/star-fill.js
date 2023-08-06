    // Assuming you have fetched the rating value from the database and stored it in a variable called "rating"
    const rating = 3; // Example rating value, can be any value from 1 to 5
    // Neu fetch tu laravel thi lam rating se nhu the nay nha const rating = {{ $product->rating }}; // Assume $product->rating is the rating value fetched from the database

    // Calculate the percentage of the filled stars
    const percentage = (rating / 5) * 100;

    // Get all the star elements
    const stars = document.querySelectorAll('.fa-star');

    // Loop through each star and set the filled class based on the percentage
    stars.forEach((star, index) => {
        if (index * 20 < percentage) {
            star.classList.add('checked');
        }
    });