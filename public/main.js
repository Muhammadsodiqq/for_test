let currentUrl = window.location.href;
let url = new URL(currentUrl);
let page = url.searchParams.get("page") ?? 1;
let limit = url.searchParams.get("limit") ?? 10;

async function fetchData(column = 'id', order = 'ASC') {

    let res = await fetch(`/fetchApi.php?` + new URLSearchParams({
        page,limit,column,order
    }), )
    res = await res.json()


    generateTable(res);
}

let sorts = document.querySelectorAll('.sortbutton');
for (let sort of sorts) {

    sort.addEventListener('click', async function () {
        let order = JSON.parse(localStorage.getItem('order')) === "ASC" ? "DESC" : "ASC";
        localStorage.setItem('column', JSON.stringify(sort.getAttribute('sort')));
        localStorage.setItem('order', JSON.stringify(order));

        let column = JSON.parse(localStorage.getItem('column'));


        fetchData(column, order)
        let paginate = document.querySelector(".pagination")
        paginate.setAttribute('style',"display:flex")
    });
}

let search_submit = document.querySelector('#search-submit');

search_submit.addEventListener('click', async function () {
    let searchs = document.querySelectorAll('#search');

    let id = searchs[0].value
    let first_name = searchs[1].value
    let last_name = searchs[2].value
    let email = searchs[3].value
    let birth_date = searchs[4].value
    let to_date = searchs[5].value
    let status = searchs[6].value

    if((!id && !first_name && !email && !last_name && !birth_date && !to_date && !status)){
        return;
    }
    let res = await fetch('/fetchFilter.php?' + new URLSearchParams({
        id,first_name,last_name,email,birth_date,to_date,status,
    }),)
    let paginate = document.querySelector(".pagination")
    paginate.setAttribute('style', "display: none;")
    res = await res.json()
    generateTable(res);
})

function generateTable(arr = []) {
    let tbody = document.querySelector('#main-body')
    tbody.innerHTML = ""
    arr.data.forEach((item, index) => {
        console.log(item)

        let tr = document.createElement('tr')
        let th = document.createElement('th')
        let td1 = document.createElement('td')
        let td2 = document.createElement('td')
        let td3 = document.createElement('td')
        let td4 = document.createElement('td')
        let td5 = document.createElement('td')
        let td6 = document.createElement('td')

        th.setAttribute('scope', 'row')
        td4.setAttribute('colspan', '2')
        th.innerText = item.id
        td1.innerText = item.first_name
        td2.innerText = item.last_name
        td3.innerText = item.email
        td4.innerText = item.birth_date
        td5.innerText = item.status == 1 ? "active" : "unactive"
        td6.innerText = "harakat"
        tr.appendChild(th)
        tr.appendChild(td1)
        tr.appendChild(td2)
        tr.appendChild(td3)
        tr.appendChild(td4)
        tr.appendChild(td5)
        tr.appendChild(td6)

        tbody.appendChild(tr)
    })


}

