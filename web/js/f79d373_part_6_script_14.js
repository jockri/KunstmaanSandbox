/* Author: Indri

*/
$(document).ready(function () {
	init_datePicker();
	init_tree();
});

// JS-tree
function init_tree() {
	$('#tree').jstree({
<<<<<<< HEAD
		"plugins" : [ "themes", "html_data", "types", "search" ],
=======
>>>>>>> feature/user
		"themes" : { 
			"theme" : "OMNext",
			"dots" : true,
			"icons" : true		
		},
		"types" : {
			"types" : {
				//Page
				"page" : {
					"icon" : {
<<<<<<< HEAD
						"image" : "js/libs/themes/OMNext/d.png",
=======
						"image" : "libs/themes/OMNext/d.png",
>>>>>>> feature/user
						"position" : "-57px -57px" 
					}
				},				
				//Site
				"site" : {
					"icon" : {
<<<<<<< HEAD
						"image" : "js/libs/themes/OMNext/d.png",
=======
						"image" : "libs/themes/OMNext/d.png",
>>>>>>> feature/user
						"position" : "-75px -38px" 
					}
				},
				//Settings
				"settings" : {
					"icon" : {
<<<<<<< HEAD
						"image" : "js/libs/themes/OMNext/d.png",
						"position" : "-57px -37px" 
					}
				},
				//Image
				"image" : {
					"icon" : {
						"image" : "js/libs/themes/OMNext/d.png",
						"position" : "-20px -74px" 
					}
				},
				//Video
				"video" : {
					"icon" : {
						"image" : "js/libs/themes/OMNext/d.png",
						"position" : "-75px -55px" 
					}
				},
				//Slideshow
				"slideshow" : {
					"icon" : {
						"image" : "js/libs/themes/OMNext/d.png",
						"position" : "-2px -72px" 
					}
				},
				//Files
				"files" : {
					"icon" : {
						"image" : "js/libs/themes/OMNext/d.png",
						"position" : "-38px -72px" 
					}
=======
						"image" : "libs/themes/OMNext/d.png",
						"position" : "-57px -37px" 
					}
>>>>>>> feature/user
				}
			}
		
		
<<<<<<< HEAD
		},
		// Configuring the search plugin
		"search" : {
			"ajax" : {
			    "url" : "", //<-- Link naar php
			    "data" : function (str) {
			        return {
			            "operation" : "search",
			            "search_str" : str
			        };
			    }
			}
		}
	});
	$("#search").click(function() {
		$(this).jstree("search", document.getElementById("searchVal").value);
	});
	
	
=======
		},		
		"plugins" : [ "themes", "html_data", "types" ]
	});

>>>>>>> feature/user
}


// DATEPICKER
function init_datePicker() {
	$('.date-pick').datePicker();
}










