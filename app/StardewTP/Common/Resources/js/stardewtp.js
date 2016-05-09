var stp = function() {
    this.initialize();
}

stp.prototype = {
    initialize: function() {
        this.heroSpinner = $('.hero .spinner');
        this.heroSpinnerIndex = 0;
        this.heroSpinnerTimeout = setTimeout(this.stepHeroSpinner.bind(this), 1000);
        this.registerObservers();
    },


    stepHeroSpinner: function() {
        var words = this.heroSpinner.children('.words');
        words.children().eq(this.heroSpinnerIndex).fadeOut(1000, function() {
            this.heroSpinnerIndex = (this.heroSpinnerIndex == (words.children().length - 1)) ? 0 : (this.heroSpinnerIndex + 1);
            var next = words.children().eq(this.heroSpinnerIndex);

            next.fadeIn(1000, function() {
                this.heroSpinnerTimeout = setTimeout(this.stepHeroSpinner.bind(this), 1000);
            }.bind(this));
        }.bind(this));
    },

    registerObservers: function() {
        $(document.body).on('click', '.btn-group[rel="adjust-list-style"] > .btn', function(event) {
            var button = $(event.currentTarget);
            var group = button.parent('.btn-group');
            var style = button.data('style');
            var target = $(group.data('target'));

            target.addClass(style);
            target.removeClass(_.difference(['list','comfy','compact'], [style]).join(" "));
        });
    }
}

window.stp = new stp