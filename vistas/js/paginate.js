var current_page = 1;
var obj_per_page = 3;
function totNumPages()
{
    return Math.ceil(obj.length / obj_per_page);
}

function prevPage()
{
    if (current_page > 1) {
        current_page--;
        change(current_page);
    }
}
function nextPage()
{
    if (current_page < totNumPages()) {
        current_page++;
        change(current_page);
    }
}
function change(page)
{
    var btn_next = document.getElementById("btn_next");
    var btn_prev = document.getElementById("btn_prev");
    var listing_table = document.getElementById("TableList");
    var page_span = document.getElementById("page");
    if (page < 1) page = 1;
    if (page > totNumPages()) page = totNumPages();
    listing_table.innerHTML = "";
    for (var i = (page-1) * obj_per_page; i < (page * obj_per_page); i++) {
        listing_table.innerHTML += obj[i].number + "<br>";
    }
    page_span.innerHTML = page;
    if (page == 1) {
        btn_prev.style.visibility = "hidden";
    } else {
        btn_prev.style.visibility = "visible";
    }
    if (page == totNumPages()) {
        btn_next.style.visibility = "hidden";
    } else {
        btn_next.style.visibility = "visible";
    }
}
window.onload = function() {
    change(1);
};