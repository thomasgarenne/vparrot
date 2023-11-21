const etoiles = document.querySelectorAll(".notes");
const notes = document.querySelectorAll("#notes");

notes.forEach(note => {
    etoiles.forEach(e => {
        if(note.dataset.id == e.dataset.id) {
            if (note.value >= e.dataset.star) {
                e.classList.add("note");
            }
        }
    })
})
