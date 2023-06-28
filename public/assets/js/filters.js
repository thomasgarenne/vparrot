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

            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                const content = document.getElementById("js-filter-content");
                content.innerHTML = data.content;
            }).catch(e => alert(e));
        });
    })

    const Reset = document.querySelector("#reset");

    Reset.addEventListener("click", ()  => {

        const Url = new URL(window.location.href);

        fetch(Url.pathname + "?ajax=1", {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            const content = document.getElementById("js-filter-content");
            content.innerHTML = data.content;
        }).catch(e => console.log(e));
    });
}