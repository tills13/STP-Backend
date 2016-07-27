var HeroSpinner = (function () {
    function HeroSpinner(selector, timeout) {
        if (timeout === void 0) { timeout = 1000; }
        this.timeout = 1200;
        this.spinner = $(selector);
        this.timeout = timeout;
        this.index = 0;
    }
    HeroSpinner.prototype.step = function () {
        var _this = this;
        var words = this.spinner.children('.words');
        words.children().eq(this.index).fadeOut(1000, function () {
            _this.index = (_this.index == (words.children().length - 1)) ? 0 : (_this.index + 1);
            var next = words.children().eq(_this.index);
            next.fadeIn(1000, function () {
                _this.timer = setTimeout(_this.step.bind(_this), _this.timeout);
            });
        });
    };
    HeroSpinner.prototype.start = function (force) {
        if (force === void 0) { force = true; }
        if (this.timer === undefined && !force)
            return;
        if (this.timer !== undefined && force) {
            clearTimeout(this.timer);
        }
        this.timer = setTimeout(this.step.bind(this), this.timeout);
    };
    HeroSpinner.prototype.stop = function () {
        if (this.timer === undefined)
            return;
        clearTimeout(this.timer);
    };
    return HeroSpinner;
}());
var SVX = (function () {
    function SVX() {
        this.initialize();
        this.registerObservers();
    }
    SVX.prototype.initialize = function () {
        this.spinner = new HeroSpinner('.hero .spinner');
        this.spinner.start();
    };
    SVX.prototype.registerObservers = function () {
        $(document.body).on('click', '.btn-group[rel="adjust-list-style"] > .btn', function (event) {
            var button = $(event.currentTarget);
            var group = button.parent('.btn-group');
            var style = button.data('style');
            var target = $(group.data('target'));
            var active = group.find('.active');
            active.removeClass('active');
            button.addClass('active');
            target.addClass(style);
            target.removeClass(_.difference(['list', 'comfy', 'compact'], [style]).join(" "));
        });
        $(document.body).on('click', '*[rel=add-contract-item]', function (event) {
            var items = $('form[name=new-contract] .items');
            var template = items.children('.item').clone();
            template.find('select#items').find(':selected').attr('selected', 'false');
            template.find('select#quality').find(':selected').attr('selected', 'false');
            template.find('input#quantity').val(1);
            items.append(template.html());
        });
    };
    return SVX;
}());
var svx = new SVX();
