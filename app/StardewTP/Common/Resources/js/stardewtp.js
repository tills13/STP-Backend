var stp = function() {
    this.initialize();
}

stp.prototype = {
    initialize: function() {
        this.heroSpinner = $('.hero .spinner');
        this.heroSpinnerIndex = 0;
        this.heroSpinnerTimeout = setTimeout(this.stepHeroSpinner.bind(this), 1000);
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
    }
}

window.stp = new stp