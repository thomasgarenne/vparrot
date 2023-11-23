updateUI();

function addOrRemoveFav(id) {
    let fav = document.querySelector("#fav" + id);
    
    const carsInFav = JSON.parse(localStorage.getItem('favoris')) || [];

    // Vérifier si la voiture est déjà dans les favoris
    const carIndex = carsInFav.indexOf(id);

    if (carIndex === -1) {
        carsInFav.push(id);
        fav.innerText = '🧡';
        alert('Voiture ajoutée aux favoris !');
    } else {
        carsInFav.splice(carIndex, 1);
        fav.innerText = '🩶';
        alert('Voiture retirée de vos favoris.');
    }

    localStorage.setItem('favoris', JSON.stringify(carsInFav));
}

function isInFav(id, favoris) {
   return favoris.includes(id);
}

function updateUI() {
    const carsInFav = JSON.parse(localStorage.getItem('favoris')) || [];

    carsInFav.forEach(id => {
        let fav = document.querySelector("#fav" + id);
        
        fav.innerText = isInFav(id, carsInFav) ? '🧡' : '🩶';
    }); 
}