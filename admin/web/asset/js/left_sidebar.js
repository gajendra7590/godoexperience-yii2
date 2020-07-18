(function () {
	"use strict";
	var treeviewMenu = jQuery('.app-menu');
	// Toggle Sidebar
	jQuery('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		jQuery('.app').toggleClass('sidenav-toggled');
	});
	// Activate sidebar treeview toggle
	jQuery("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!jQuery(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		jQuery(this).parent().toggleClass('is-expanded');
	});
	// Set initial active toggle
	jQuery("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');
	//Activate bootstrip tooltips
	jQuery("[data-toggle='tooltip']").tooltip();

})();
