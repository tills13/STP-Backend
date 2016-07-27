var Admin = (function () {
    function Admin() {
    }
    Admin.prototype.invalidateCache = function (item) {
        var key = $(item).parents('tr').attr('data-key');
        var url = sebastian.router.generateUrl('admin:invalidate_cache');
        $.post(url, { key: key }).done(function (response) {
        });
    };
    return Admin;
}());
var admin = new Admin();
