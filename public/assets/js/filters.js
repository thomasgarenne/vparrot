window.onload = () => {

    const FiltersForm = document.querySelector("#js-filter-form");
    const Content = document.querySelector("#js-filter-content");
    const Pagination = document.querySelector("#js-filter-pagination");
    const Sorting = document.querySelector("#js-filter-sorting");
    const Reset = document.querySelector("#reset");

    Pagination.addEventListener('click', (e) => {
        if (e.target.tagName === 'A') {
            e.preventDefault();

            let url = e.target.getAttribute('href');
            console.log(url);

            fetch(url, {
            headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                Content.innerHTML = data.content;
                //history.replaceState({}, '', url);
            }).catch(e => alert(e));
        }
    })

    Sorting.addEventListener('click', (e) => {
        if (e.target.tagName === 'A') {
            e.preventDefault();

            let url = e.target.getAttribute('href');
            console.log(url);

            fetch(url, {
            headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                Content.innerHTML = data.content;
                //history.replaceState({}, '', url);
            }).catch(e => alert(e));
        }
    })

    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("change", () => {
            const Form = new FormData(FiltersForm);

            const Url = new URL(window.location.href);

            const Params = new URLSearchParams();

            Form.forEach((value, key) => {
                Params.append(key, value);
            })         

            fetch(Url.pathname + "?" + Params.toString(), {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                Content.innerHTML = data.content;
                //history.replaceState({}, '', Url.pathname + "?" + Params.toString());
            }).catch(e => alert(e));
        });
    })

    Reset.addEventListener("click", ()  => {
        const Url = new URL(window.location.href);

        fetch(Url.pathname, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            Content.innerHTML = data.content;
        }).catch(e => console.log(e));
    });
}
