(function() {
	var SVXPartners = function() {
		console.log('asdasd');

		this.registerObservers();
	};

	SVXPartners.prototype = {
		registerObservers: function() {
			$(document).on('keyup', 'form#new-partner input#name', function(e) {
				var nameField = $('form#new-partner strong[rel=partner-name]');
				var input = $(e.currentTarget);

				nameField.text(input.val());
			});

			$(document).on('keyup', 'form#new-partner input#logo', function(e) {
				var select = $('form#new-partner select[name=logo]');
				var input = $(e.currentTarget);

				if (input.val() == '' || input.val().length == 0) {
					select.attr('disabled', false);
				} else {
					select.attr('disabled', true);
				}
			});

			$(document).on('change', 'form#new-partner select[name=logo]', function(e) {
				var select = $(e.currentTarget);
				var input = $('form#new-partner input#logo');
				var logo = $('form#new-partner img.logo');

				var selected = select.children("option:selected");
				if (selected && selected.val() != "") {
					logo.attr('src', selected.val());
					input.attr('disabled', true);
				} else {
					logo.attr('src', null);
					input.attr('disabled', false);
				}
			});
		}
	}

	window.partnerUtils = new SVXPartners();
})();