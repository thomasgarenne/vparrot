const stars = document.querySelectorAll("i");
const average = document.querySelector("#average");

stars.forEach(star => {
    let starValue = star.dataset.star;
    let averageValue = average.value;

    if (averageValue >= starValue) {
        star.classList.add("note");
    }
});