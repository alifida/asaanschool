var isDOMready = false;
enable_body_overlay_loading();
setTimeout(function(){
	enable_overlay_loading();
}, 50);

$(document).ready(function() {
	
	
	fix_sidebar(); // fix side bar 
	initDataTables();

	// show the error notifications if there is any message sent by server
	show_app_error_and_messages();
	create_dual_list_boxes();
	enable_popover();
	
	enable_collapse_data_widget();
	
	isDOMready = true;
	disable_overlay_loading();
	 setLocationInCookie();
});

function initDataTables(){
	
	/*$(document).ready(function() {
	    $('#example').DataTable( {
	        dom: 'Bfrtip',
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ]
	    } );
	} );*/
	
	$('.dataTables').dataTable({
		responsive: true,
		 dom: 'Bfrtip',
		 
		  buttons: [
			  {
			    	extend: 'print',  
			    	text: "Print",
			    	title:$(this).closest('.box').find('.box-header').clone().children().remove().end().text().trim(),
			    	messageTop: $(this).closest('.box').find('.box-header').clone().children().remove().end().text().trim(),
			    	className: 'btn btn-default btn-xs',
			    	exportOptions: {
			    		columns: 'th:not(:last-child)'
			    	},
			    	
			    	customize: function ( win ) {
	                    $(win.document.body)
	                        .css( 'font-size', '10pt' )
	                        .prepend(
	                        	print_header_html
	                        );
	 
	                    $(win.document.body).find( 'table' )
	                        .addClass( 'compact' )
	                        .css( 'font-size', 'inherit' );
	                }
			    }
			   /*{
			        extend: 'excel',  
			        text: 'Export (Excel)',
			        className: 'btn btn-success btn-xs',
			        exportOptions: {
			            columns: 'th:not(:last-child)'
			        }
			    },
			    {
			    	extend: 'pdf',  
			    	text: 'PDF',
			    	className: 'btn btn-danger btn-xs',
			    	exportOptions: {
			    		columns: 'th:not(:last-child)'
			    	}
			    },
			     
			    {
			        text: 'PDF Html5 (Land)',
			        className: 'btn btn-default btn-xs',
			        extend: 'pdfHtml5',
			    message: '',
			    orientation: 'landscape',
			    exportOptions: {
			         columns: ':visible'
			    },
			    customize: function (doc) {
			        doc.pageMargins = [10,10,10,10];
			        doc.defaultStyle.fontSize = 7;
			        doc.styles.tableHeader.fontSize = 7;
			        doc.styles.title.fontSize = 9;
			        // Remove spaces around page title
			        doc.content[0].text = doc.content[0].text.trim();
			        // Create a footer
			        doc['footer']=(function(page, pages) {
			            return {
			                columns: [
			                    'This is your left footer column',
			                    {
			                        // This is the right column
			                        alignment: 'right',
			                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
			                    }
			                ],
			                margin: [10, 0]
			            }
			        });
			        doc['header']=(function(page, pages) {
			        	return {
			        		columns: [
			        			'This is your header footer column',
			        			{
			        				// This is the right column
			        				alignment: 'right',
			        				text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
			        			}
			        			],
			        			margin: [10, 0]
			        	}
			        });
			        // Styling the table: create style object
			        var objLayout = {};
			        // Horizontal line thickness
			        objLayout['hLineWidth'] = function(i) { return .5; };
			        // Vertikal line thickness
			        objLayout['vLineWidth'] = function(i) { return .5; };
			        // Horizontal line color
			        objLayout['hLineColor'] = function(i) { return '#aaa'; };
			        // Vertical line color
			        objLayout['vLineColor'] = function(i) { return '#aaa'; };
			        // Left padding of the cell
			        objLayout['paddingLeft'] = function(i) { return 4; };
			        // Right padding of the cell
			        objLayout['paddingRight'] = function(i) { return 4; };
			        // Inject the object in the document
			        doc.content[1].layout = objLayout;
			    }
			    }*/
			    
			   ] 

		 
		 
	});
	
	$('.simpleDataTables').dataTable({
		"responsive": true,
		"searching": false,
		"ordering":  false,
		"paging": false
	});
	$('.noPaginationDataTables').dataTable({
		"responsive": true,
		"searching": true,
		"ordering":  true,
		"paging": false
	});
	$(".disable-sort").css('background-image','none');
	
	$('.simpleDataTables').next(".row").hide();
	$('.simpleDataTables').parent().find('.dataTables_length').hide();
	$('.table-responsive .col-sm-5').addClass("col-xs-5");
	$('.table-responsive .col-sm-7').addClass("col-xs-7");
	$('.pagination').addClass("pull-right");
}

function initDatatablesById($id){
	if(isDOMready){
		$('#'+$id).dataTable({
			responsive: true
		});
	}
	
}
function enable_overlay_loading(){
	
	if(isDOMready){
		disable_overlay_loading();
		
	}else{
		$boxesCount  = 	$('body').find('.box').length
				
		$overlayedCount = $('body').find('.box-overlayed').length
		
		$boxesCount = $boxesCount - $overlayedCount;
		
		if($boxesCount > 0){
			
			$("<div class='loading-overlay'></div>").css({
			    position: "absolute",
			    width: "100%",
			    height: "100%",
			    left: 0,
			    top: 0,
			    opacity: 1,
			    zIndex: 1000000,  // to be on the safe side
			    background: "#ffffff url("+site_url +"public/images/loader_gif.gif) no-repeat 50% 60px"
			    
			}).appendTo($(".box").not(".box-overlayed").css("position", "relative"));
			
			$(".box").addClass("box-overlayed");
			
			$(".loading-overlay-body").remove();
			
		}else{
			setTimeout(function(){
				enable_overlay_loading();
			}, 50);
		}
		
		
	}
}
function enable_body_overlay_loading(){
	$("<div class='loading-overlay-body'></div>").css({
		position: "fixed",
		width: "100%",
		height: "100%",
		left: 0,
		top: 0,
		opacity: 1,
		zIndex: 1000000,  // to be on the safe side
		background: "#ffffff url("+site_url +"public/images/loader_gif.gif) no-repeat 50% 50%"
	}).appendTo($(".skin-blue").css("position", "fixed"));
	
	
}
function disable_overlay_loading(){
	$(".loading-overlay-body").remove();
	$(".loading-overlay").remove();
}
function fix_sidebar() {
    //Make sure the body tag has the .fixed class
    if (!$("body").hasClass("fixed")) {
        return;
    }

    //Add slimscroll
    $(".sidebar").slimscroll({
        height: ($(window).height() - $(".header").height()) + "px",
        color: "rgba(0,0,0,0.2)"
    });
}
function enable_popover(){
	$("[data-toggle=popover]")
    .popover({
	    container: 'body',
	    html: true,
	    placement: 'top'
	});
	
	/*
	$('.popover-link').popover({
	    container: 'body',
	    html: true,
	    placement: 'bottom'
	});
	$(document).click(function (e) {
	    $('.popover-link').each(function () {
	        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
	            //$(this).popover('hide');
	            if ($(this).data('bs.popover').tip().hasClass('in')) {
	                $(this).popover('toggle');
	            }
	            
	            return;
	        }
	    });
	});
	*/
	$(".pagination li a").click(function (e){
		setTimeout(function(){
			 enable_popover();
	    }, 500);
	});
}




// revalidate the Date fields on Date picker
function dateTimePickerRevalidator(){
	$('.date')
		.on('dp.change dp.show dp.hide', function(e) {
// list all the datepicker here		
			$('#employee_form').bootstrapValidator('revalidateField', 'date_of_joining');
			$('#employee_form').bootstrapValidator('revalidateField', 'date_of_resigning');
			$('#due_fee_form').bootstrapValidator('revalidateField', 'due_fee_date');
			$('#expense_form').bootstrapValidator('revalidateField', 'expense_date');
			$('#student_add_update_form').bootstrapValidator('revalidateField', 'student_admission_date');
			$('#student_add_update_form').bootstrapValidator('revalidateField', 'student_date_of_birth');
			$('#issue_salary_form').bootstrapValidator('revalidateField', 'salary_date');
	});
}
function show_app_error_and_messages() {
		if ($("#appNotifications .custom_ul").length) {
		  $('#appNotifications').slideDown();
		}
	
	
	
		if ($("#appErrors .custom_ul").length) {
		  $('#appErrors').slideDown();
		  
			setTimeout(function(){
				 $('#appErrors').slideUp();    
		    }, 10000);
		  
		  
		// adjust overlapping in case all the notifications are visibile at the same time
		  if ($("#appNotifications .custom_ul").length) {
			   
			  //$count_li = $("#appNotifications .custom_ul li").length ;
			   //$topMargin = $count_li * 38;
			  // $topMargin = $topMargin + 52;
			   
			  $topMargin = $("#appNotifications .custom_ul").height();
			   $topMargin = $topMargin + 15;
			   $topMargin = $topMargin + "px";
			   // $topMargin = $topMargin + $("#appErrors").position().top;
			   $("#appErrors").css({
				top : $topMargin
			   });
		  }
		  
		  
		  
		}
		
		if ($("#appMessages .custom_ul").length) {
		  $('#appMessages').slideDown();
		  

		  // adjust overlapping in case both notifications are visibile
		    if ($("#appErrors .custom_ul").length || $("#appNotifications .custom_ul").length) {
		    	$topMargin = 0;
		    	if ($("#appErrors .custom_ul").length) {
		    		
		    		$topMargin = $("#appErrors .custom_ul").height();
					   $topMargin = $topMargin + 10;
					  
				  }
		    	 if ($("#appNotifications .custom_ul").length) {
		    		 
		    		 $topMargin = $topMargin + $("#appNotifications .custom_ul").height();
					   $topMargin = $topMargin + 10;
					   
					  
				  }
		    	 $topMargin = $topMargin + 4;
		    	 $topMargin = $topMargin +"px";
		    	
		   
		    	$("#appMessages").css({
					top : $topMargin
				   });
		    	
		    }
		  
		    setTimeout(function(){
				 $('#appMessages').slideUp();    
		    }, 10000);
		

		}
	}

function clear_app_error_and_messages(){
	$('#appErrors').slideUp();
	$('#appMessages').slideUp();
	
	$("#appMessages .message_container .custom_ul").remove();
	$("#appErrors .message_container .custom_ul").remove();
	$("#appNotifications .message_container .custom_ul").remove();
	
}


// Loads the correct sidebar on window load,
// collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
	$(window)
			.bind(
					"load resize",
					function() {
						topOffset = 50;
						width = (this.window.innerWidth > 0) ? this.window.innerWidth
								: this.screen.width;
						if (width < 768) {
							$('div.navbar-collapse').addClass('collapse')
							topOffset = 100; // 2-row-menu
						} else {
							$('div.navbar-collapse').removeClass('collapse')
						}

						height = (this.window.innerHeight > 0) ? this.window.innerHeight
								: this.screen.height;
						height = height - topOffset;
						if (height < 1)
							height = 1;
						if (height > topOffset) {
							$("#page-wrapper").css("min-height",
									(height) + "px");
						}
					});
});



function enable_collapse_data_widget(){
	$("[data-widget='collapse']").click(function() {
	    //Find the box parent        
	    var box = $(this).parents(".box").first();
	    //Find the body and the footer
	    var bf = box.find(".box-body, .box-footer");
	    if (!box.hasClass("collapsed-box")) {
	        box.addClass("collapsed-box");
	        //Convert minus into plus
	        $(this).children(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
	        bf.slideUp();
	    } else {
	        box.removeClass("collapsed-box");
	        //Convert plus into minus
	        $(this).children(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
	        bf.slideDown();
	    }
	});
}

$(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
});



function show_ajax_loader(){
	$('#ajax_loader_wrapper').modal('show');
}
function hide_ajax_loader(){
	$('#ajax_loader_wrapper').modal('hide');
}

function append_request_type_delimiter(url){
	if (url.indexOf("?") >-1) {
		url= url +"&rt=m"
	}else{
		url= url +"?rt=m"
	}
	return url;
}

function load_remote_model(url, modal_title, $serializedData) {
	
	show_ajax_loader();
	
	window.history.pushState("",  modal_title + " " + currentTitle, url);
	
	url = append_request_type_delimiter(url);
	
	// remove modal-lg class
	$("#global_modal .modal-dialog ").removeClass("modal-lg");
	$.ajax({
		url : url,
		type : "post",
		data : $serializedData,
		success : function(result) {
			// set Title
			$('#global_modal_label').html(modal_title);
			$('#global_modal_body').html(result);
			hide_ajax_loader();
			$('#global_modal').modal('show');
			show_app_error_and_messages();
			enable_popover();
			
			// console.log(result);
		}
	});
}

function onModelCloseBtn(){
	window.history.pushState("",  currentTitle, currentPageUrl);
	
	
}

function load_local_model(modal_title, model_body) {
	$('#local_modal_title').html(modal_title);
	$('#local_modal_body').html($html);
	$('#local_modal').modal('show');
	enable_popover();
}

function load_image_details(modal_title, image_path) {
	$html = "<div class='col-lg-12>'<center><div class='alert alert-info'>"
	    	+" Image Path: "+ image_path                          
	    	+"	</div><br/>";
	$html = $html + "<img src='"+image_path+"' style='max-width: 100%;' /></center></div>";
	
	$('#global_image_lighbox_title').html(modal_title);
	$('#global_image_lighbox_body').html($html);
	
	$('#global_image_lighbox').modal('show');
	enable_popover();
}
function load_gallery_images(targetId){
	

	var url = site_url +  "website/galleryImagesForRichEditor";
	$.ajax({
		url : url,
		type : "post",
		
		success : function(result) {
			// set Title
			//gallery_in_editor_popup
			$("#"+targetId).html(result);
			enable_popover();
			
			// console.log(result);
		}
	});
}
var targetControleForImagePath=""; 
function copy_image_path_to_field($imagePath){
	
	$(targetControleForImagePath).val($imagePath);
}
function enlarge_remote_model() {
	$("#global_modal .modal-dialog ").addClass("modal-lg");
}

function ajax_file_submit(url , preview_container_id, update_path_id,inputFileId="browse_file"){
	$html_loader = "<img src='"+ site_url +"public/images/loader_gif.gif' alt=''  class='img-circle circle_border'/>";
	 
	$existing_html =  $("#"+preview_container_id).html();
	$("#"+preview_container_id).html("");
	$("#"+preview_container_id).html($html_loader);
	
	// clear existing messages from list 
	clear_app_error_and_messages();
	var file_data = $("#"+inputFileId).prop("files")[0];   
    var form_data = new FormData();                  
    form_data.append("file", file_data);
	
	$.ajax({
		url : url,
		type : "post",
		cache:false,
	    processData:false,
	    contentType:false,
		data : form_data,
		success : function(result) {
			//console.log(result);
			//console.log(result);
			
			var json = jQuery.parseJSON(result);
			
			$server_message = "<ul  class='custom_ul'><li>"+json.message+"</li></ul>";
			if(json.status == "success"){
				
				$cssClass ="img-circle circle_border max-100 ";
				if(json.hasOwnProperty('cssClass')){
					$cssClass = json.cssClass;
				}
				
				
				$("#"+update_path_id).val(json.absolute_path);
				
				$("#"+preview_container_id).html("");
				$previewHTML = "<img src='"+json.absolute_path+"' alt=''  class='"+$cssClass+"' />";
				$("#"+preview_container_id).html($previewHTML);
				$("#appMessages .message_container").append($server_message);
			}else{
				$("#"+preview_container_id).html($existing_html);
				$("#appErrors .message_container").append($server_message);
			}
			
			
			show_app_error_and_messages();
		},
		error: function(result){
			$("#"+preview_container_id).html("");
			$("#appErrors .message_container").append("<ul  class='custom_ul'><li>Error Occured. Please Re-login and try again.</li></ul>");
			show_app_error_and_messages();
			
		}
		
	});
	
}

function create_dual_list_boxes() {

	var dual_list_box = $('.dual_list_box').bootstrapDualListbox({
		nonSelectedListLabel : 'Available',
		selectedListLabel : 'Selected',
		preserveSelectionOnMove : 'moved',
		moveOnSelect : false,
		nonSelectedFilter : ''
	});
	// dual_list_box.bootstrapDualListbox('refresh', true); // to refresh on
	// ajax.

}

function global_ajax_from_submit(url, $fromId, $targetId, $serializedData) {
	beforeAjaxFormSubmit($targetId);
	
	window.history.pushState("", currentTitle, url);
	
	//enable_overlay_loading();
	$formData ="";

	if($fromId != ''){
		$formData = $("#"+$fromId).serialize();
	}else{
		$formData = $serializedData;
	}
	url = append_request_type_delimiter(url);
	
	$.ajax({
		type : "POST",
		url : url,
		data : $formData,
		success : function(response) {
			
			if ($targetId != "") {
				$("#" + $targetId).html(response);
				
			} else {
				return response;
			}
			afterAjaxResponse($fromId);	
		},
		error : {
		// hide loader

		}

	});
}
function beforeAjaxFormSubmit($targetId){
	if($targetId.length > 0){
		$html = "<div class='small-box' style='background-color: #fff;'><div class='col-centered'><br/><br/><img src='"+site_url +"public/images/loader_gif.gif' /></div><br/><br/></div>";
		$("#" + $targetId).html($html);
	}
}
function afterAjaxResponse($formId){
	
	show_app_error_and_messages();
	enableFormValidatorOnAjax($formId);
	disable_overlay_loading();
}
function enableFormValidatorOnAjax($fromId){
	$('#'+$fromId).bootstrapValidator({
        fields: {
        	
        }
    });
}


$(function() {

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function() {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });

    /* SPARKLINE DOCUMENTAION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
    drawDocSparklines();
   // drawMouseSpeedDemo();
});

function drawDocSparklines() {

    // Bar + line composite charts
    $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
    $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
            {composite: true, fillColor: false, lineColor: 'red'});


    // Line charts taking their values from the tag
    $('.sparkline-1').sparkline();

    // Larger line charts for the docs
    $('.largeline').sparkline('html',
            {type: 'line', height: '2.5em', width: '4em'});

    // Customized line chart
    $('#linecustom').sparkline('html',
            {height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
                minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3});

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

    $('.barformat').sparkline([1, 3, 5, 3, 8], {
        type: 'bar',
        tooltipFormat: '{{value:levels}} - {{value}}',
        tooltipValueLookups: {
            levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
        }
    });

    // Tri-state charts using inline values
    $('.sparktristate').sparkline('html', {type: 'tristate'});
    $('.sparktristatecols').sparkline('html',
            {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

    // Composite line charts, the second using values supplied via javascript
    $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
    $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
            {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

    // Line charts with normal range marker
    $('#normalline').sparkline('html',
            {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
    $('#normalExample').sparkline('html',
            {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

    // Discrete charts
    $('.discrete1').sparkline('html',
            {type: 'discrete', lineColor: 'blue', xwidth: 18});
    $('#discrete2').sparkline('html',
            {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

    // Bullet charts
    $('.sparkbullet').sparkline('html', {type: 'bullet'});

    // Pie charts
    $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

    // Box plots
    $('.sparkboxplot').sparkline('html', {type: 'box'});
    $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
            {type: 'box', raw: true, showOutliers: true, target: 6});

    // Box plot with specific field order
    $('.boxfieldorder').sparkline('html', {
        type: 'box',
        tooltipFormatFieldlist: ['med', 'lq', 'uq'],
        tooltipFormatFieldlistKey: 'field'
    });

    // click event demo sparkline
    $('.clickdemo').sparkline();
    $('.clickdemo').bind('sparklineClick', function(ev) {
        var sparkline = ev.sparklines[0],
                region = sparkline.getCurrentRegionFields();
        value = region.y;
        alert("Clicked on x=" + region.x + " y=" + region.y);
    });

    // mouseover event demo sparkline
    $('.mouseoverdemo').sparkline();
    $('.mouseoverdemo').bind('sparklineRegionChange', function(ev) {
        var sparkline = ev.sparklines[0],
                region = sparkline.getCurrentRegionFields();
        value = region.y;
        $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
    }).bind('mouseleave', function() {
        $('.mouseoverregion').text('');
    });
}

/**
 ** Draw the little mouse speed animated graph
 ** This just attaches a handler to the mousemove event to see
 ** (roughly) how far the mouse has moved
 ** and then updates the display a couple of times a second via
 ** setTimeout()
 **/
function drawMouseSpeedDemo() {
    var mrefreshinterval = 500; // update display every 500ms
    var lastmousex = -1;
    var lastmousey = -1;
    var lastmousetime;
    var mousetravel = 0;
    var mpoints = [];
    var mpoints_max = 30;
    $('html').mousemove(function(e) {
        var mousex = e.pageX;
        var mousey = e.pageY;
        if (lastmousex > -1) {
            mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
        }
        lastmousex = mousex;
        lastmousey = mousey;
    });
    var mdraw = function() {
        var md = new Date();
        var timenow = md.getTime();
        if (lastmousetime && lastmousetime != timenow) {
            var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
            mpoints.push(pps);
            if (mpoints.length > mpoints_max)
                mpoints.splice(0, 1);
            mousetravel = 0;
            $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
        }
        lastmousetime = timenow;
        setTimeout(mdraw, mrefreshinterval);
    }
    // We could use setInterval instead, but I prefer to do it this way
    setTimeout(mdraw, mrefreshinterval);
}




function toggle_all_source_chkbx(controlling_chkbx, cls) {
	//source_chkbx_all
	var checked = $("#" + controlling_chkbx).is(':checked'); // Checkbox state
	
	if (checked) {
		check_by_class(cls);
	} else {
		un_check_by_class(cls);
	}

}
function toggle_chkbx(cls) {
	var checked = $("." + cls).is(':checked'); // Checkbox state
	
	if (checked) {
		check_by_class(cls);
	} else {
		un_check_by_class(cls);
	}
	
}

function check_by_class(cls) {
	$("." + cls).each(function() {

		this.checked = true;
	});
}
function un_check_by_class(cls) {
	$("." + cls).each(function() {

		this.checked = false;
	});
}

function get_selected_checkbox_by_class(cls){
	var selected = [];
	$("."+cls+":checked").each(function(){
		selected.push($(this).val());
	});
	return selected;
}


function setLocationInCookie(){
	var sl_country = getCookie("SL_COUNTRY");
	if (sl_country == "" ) {
		 $.getJSON('https://jsonip.com?callback=?', function(data) {
		        var ip = data.ip;
		        $.getJSON("https://asaanschool.com/http://www.geoplugin.net/json.gp?ip=" + ip, function(response) {
		            console.log(response);
		            setCookie('SL_COUNTRY', response.geoplugin_countryCode, 5000);
		        });
		        
		    }); 
	} else{
		console.log(sl_country);
	}
} 


function getCookie(cname) {
	  var name = cname + "=";
	  var decodedCookie = decodeURIComponent(document.cookie);
	  var ca = decodedCookie.split(';');
	  for(var i = 0; i <ca.length; i++) {
	    var c = ca[i];
	    while (c.charAt(0) == ' ') {
	      c = c.substring(1);
	    }
	    if (c.indexOf(name) == 0) {
	      return c.substring(name.length, c.length);
	    }
	  }
	  return "";
	}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
 
	
$(document).ready(function(){
	$(".remote-dropdown").click(function(event) {
		$targetUpdate = $(this).next(".dropdown-menu" );
		$url = $(this).attr('data-url');
		$url = append_request_type_delimiter($url);
		$.ajax({
			type : "POST",
			url : $url,
			success : function(response) {
				$targetUpdate.html(response);
			},
			error : function() {
				$targetUpdate.html("error Occured.");
			}
		});
    });
	
});









