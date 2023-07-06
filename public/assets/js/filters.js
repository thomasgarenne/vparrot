window.onload = () => {

    const FiltersForm = document.querySelector("#js-filter-form");
    const Content = document.querySelector("#js-filter-content");

    document.querySelectorAll("input").forEach(input => {
        input.addEventListener("change", () => {
            const Form = new FormData(FiltersForm);

            const Url = new URL(window.location.href);

            const Params = new URLSearchParams();

            Form.forEach((value, key) => {
                Params.append(key, value);
            })         

            fetch(Url.pathname + "?" + Params.toString() + '&ajax=1', {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                Content.innerHTML = data.content;
            }).catch(e => alert(e));
        });
    })

    const Sorting = document.querySelector("#js-filter-sorting");

    Sorting.addEventListener("click", e => {

        if (e.target.tagName === 'A') {
            e.preventDefault();
            url = e.target.getAttribute('href');
        }

        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            Content.innerHTML = data.content;
            Sorting.innerHTML = data.sorting;
        }).catch(e => alert(e));    
    })

    const Pagination = document.querySelector("#js-filter-pagination");
    
    Pagination.addEventListener("click", e => {

        if (e.target.tagName === 'A') {
            e.preventDefault();
            url = e.target.getAttribute('href');
        }

        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        }).then(response => {
            return response.json();
        }).then(data => {
            Content.innerHTML = data.content;
            Pagination.innerHTML = data.pagination;
        }).catch(e => alert(e));    
    })

    const Reset = document.querySelector("#reset");

    Reset.addEventListener("click", ()  => {

        const Url = new URL(window.location.href);

        fetch(Url.pathname, {
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
