class Admin {
    constructor() {

    }

    public invalidateCache(item? : Element): void {
        let key = $(item).parents('tr').attr('data-key');
        let url = sebastian.router.generateUrl('admin:invalidate_cache');

        $.post(url, { key: key }).done((response) => {

        });
    }
}

let admin = new Admin();