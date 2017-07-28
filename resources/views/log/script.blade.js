$("tr.header i.fa.fa-chevron-down").click(function () {
    var button = $(this);
    var el = button.closest('tr.header');
    var next = el.next();
    if (next.is(":visible")) {
        next.hide();
    } else {
        next.show();
    }
});
