const stars = document.querySelectorAll(".avg");
const average = document.querySelector("#average");

stars.forEach(star => {
    let starValue = star.dataset.star;
    let averageValue = average.value;

    if (averageValue >= starValue) {
        star.classList.add("note");
    }
});