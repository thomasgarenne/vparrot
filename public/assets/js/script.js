// SUPPRESSION PHOTOS AJAX 

let links = document.querySelectorAll("[data-delete]");

for (let link of links) {
    link.addEventListener("click", function(e) {
        e.preventDefault();

        if (confirm("Voulez-vous supprimer cette image ?")) {
            fetch(this.getAttribute("href"), {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-type": "application.json"
                },
                body: JSON.stringify({"_token": this.dataset.token})
            }).then(response => response.json())
            .then(data => {
                if (data.success){
                    this.parentElement.remove();
                } else {
                    alert(data.error);
                }
            })
        }
    });
}


//FILTRES VEHICULES
/*
window.onload = () => {
    const FiltersForm = document.querySelector("#js-filter-form");

    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("change", () => {
            const Form = new FormData(FiltersForm);

            const Url = new URL(window.location.href);

            const Params = new URLSearchParams();

            Form.forEach((value, key) => {
                Params.append(key, value);
            })

            console.log(Params.toString());

            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                console.log(data.content);

                const content = document.getElementById("js-filter-content");
                content.innerHTML = data.content;
            }).catch(e => alert(e));
        });
    })
}
*/