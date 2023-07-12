const etoiles = document.querySelectorAll(".notes");
const notes = document.querySelectorAll("#notes");
/*
etoiles.forEach(e => {
    if (notes.value >= e.dataset.star) {
        e.classList.add("note");
    }
});
*/
notes.forEach(note => {
    etoiles.forEach(e => {
        if(note.dataset.id == e.dataset.id) {
            if (note.value >= e.dataset.star) {
                e.classList.add("note");
            }
        }
    })
})
