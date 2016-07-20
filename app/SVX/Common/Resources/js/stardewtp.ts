/**
 * HeroSpinner
 */
class HeroSpinner {
    spinner: JQuery;
    index: number;
    timer: number;
    timeout: number = 1200;

    constructor(selector: String, timeout: number = 1000) {
        this.spinner = $(selector);
        this.timeout = timeout;
        this.index = 0;
    }

    step() : void {
        var words = this.spinner.children('.words');
        words.children().eq(this.index).fadeOut(1000, () => {
            this.index = (this.index == (words.children().length -1)) ? 0 : (this.index + 1);
            let next = words.children().eq(this.index);

            next.fadeIn(1000, () => {
                this.timer = setTimeout(this.step.bind(this), this.timeout);
            });
        });
    }

    start(force: boolean = true) {
        if (this.timer === undefined && !force) return;

        if (this.timer !== undefined && force) {
            clearTimeout(this.timer);
        } 

        this.timer = setTimeout(this.step.bind(this), this.timeout);
    }

    stop() {
        if (this.timer === undefined) return;

        clearTimeout(this.timer);
    }
}

/**
 * SVX
 */
class SVX {
    spinner: HeroSpinner;

    constructor() {
        this.initialize();
        this.registerObservers();
    }

    initialize() {
        this.spinner = new HeroSpinner('.hero .spinner');
        this.spinner.start();
    }

    registerObservers() {
        $(document.body).on('click', '.btn-group[rel="adjust-list-style"] > .btn', (event) => {
            let button = $(event.currentTarget);
            let group = button.parent('.btn-group');
            let style = button.data('style');
            let target = $(group.data('target'));
            let active = group.find('.active');

            active.removeClass('active');
            button.addClass('active');
            target.addClass(style);
            target.removeClass(_.difference(['list','comfy','compact'], [style]).join(" "));
        });

        $(document.body).on('click', '*[rel=add-contract-item]', (event) => {
            let items = $('form[name=new-contract] .items');
            let template = items.children('.item').clone();
            //template.find('span#count').val(parseInt(template.find('#count').val()) + 1);
            template.find('select#items').find(':selected').attr('selected', 'false');
            template.find('select#quality').find(':selected').attr('selected', 'false');
            template.find('input#quantity').val(1);

            items.append(template.html());
        });
    }
}

var svx = new SVX(); 