jQuery(document).ready(function ($) {
	var jssor_1_SlideshowTransitions = [
		{$Duration:1200,$Opacity:2}
	];

	var jssor_1_options = {
		$AutoPlay: true,
		$SlideshowOptions: {
			$Class: $JssorSlideshowRunner$,
			$Transitions: jssor_1_SlideshowTransitions,
			$TransitionsOrder: 1
		}
	};

	var jssor_slider = new $JssorSlider$("_slider", jssor_1_options);
	function ScaleSlider() {
		var refSize = jssor_slider.$Elmt.parentNode.clientWidth;
		if (refSize) {
			jssor_slider.$ScaleWidth(refSize);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}
	ScaleSlider();
	$Jssor$.$AddEvent(window, "load", ScaleSlider);
	$Jssor$.$AddEvent(window, "resize", ScaleSlider);
	$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
});