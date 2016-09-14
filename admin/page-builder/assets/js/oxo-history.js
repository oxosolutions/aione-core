/*
* adds undo and redo functionality to the Aione Builder
*/
( function($) { 
	var oxoHistoryManager 		= {};
	window.oxoHistoryManager 	= oxoHistoryManager;
	var oxoCommands 				= new Array('[]');
	//is tracking on or off?
	window.tracking					= 'on'
	//maximum steps allowed/saved
	var maxSteps					= 40;
	//current Index of step
	var currStep					= 0;
	
	/**
	 * get editor data and add to array
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.captureEditor = function( ) {
		
		//if tracking is on
		if( oxoHistoryManager.isTrackingOn() ) {
			//get elements
			allElements = oxoHistoryManager.getAllElementsData();
			
			if ( currStep ==  maxSteps) { //if reached limit
				oxoCommands.shift(); //remove first index
			} else {
				currStep += 1; //else increment index
			}
			
			//add editor data to Array
			oxoCommands[currStep] = allElements;
			//update buttons
			oxoHistoryManager.updateButtons();
		}
	}
	/**
	 * get models of all elements visible in editor
	 * @param 	NULL
	 * @return 	{String}	JSON String of editor elements
	 */
	oxoHistoryManager.getAllElementsData = function() {
		
		var editorElements 		= document.querySelectorAll('#editor .item-wrapper');	
		var allElements 		= new Array();
		var uniqueEls			= new Array();


		for ( var i=0; i < editorElements.length; i++ )
		{
			var elementId 		= editorElements[i].id;
			
			if( elementId ) //if element exists
			{
				//get element model
				var element 		= app.editor.selectedElements.get(elementId);
				// get element order
				var elementIndex 	= i;
				//set element order
				element.attributes.index = elementIndex;
				//add element to stack
				allElements.push( element );
				
			}
		}
		//remove duplicates
		$.each( allElements, function( i, el ){
			if( $.inArray( el, uniqueEls ) === -1) uniqueEls.push( el );
		});
		//return JSON String of elements
		return JSON.stringify(uniqueEls);
	}
	/**
	 * set tracking flag ON.
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.turnOnTracking = function( ) {
		window.tracking = 'on';
	}
	/**
	 * set tracking flag OFF.
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.turnOffTracking = function( ) {
		window.tracking = 'off';
	}
	/**
	 * Get editor elements of current index for UNDO. Remove all elements currenlty visible in eidor and then reset models
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.doUndo = function( ){
		
		if ( oxoHistoryManager.hasUndo() ) { //if no data or end of stack and nothing to undo
			//turn off tracking first, so these actions are not captured
			oxoHistoryManager.turnOffTracking();
			currStep 		-= 1;
			
			//data to undo
			var undoData 	= oxoCommands[currStep];
			if( undoData != '[]' ) { //if not empty state
				//remove all current editor elements first
				Editor.deleteAllElements();
				//reset models with new elements
				app.editor.selectedElements.reset( JSON.parse(undoData) );
				//turn on tracking
				oxoHistoryManager.turnOnTracking();
				//update buttons
				oxoHistoryManager.updateButtons();
			}
		}
		
	}
	/**
	 * Get editor elements of current index for REDO. Remove all elements currenlty visible in eidor and then reset models
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.doRedo = function( ) {
		
		if ( oxoHistoryManager.hasRedo() ) { //if not at end and nothing to redo
			//turn off tracking, so these actions are not tracked
			oxoHistoryManager.turnOffTracking();
			//move index
			currStep	+= 1;;
			//get data to redo
			var RedoData = oxoCommands[currStep];
			//remove currently visible elements in editor
			Editor.deleteAllElements();
			//reset models with new elements
			app.editor.selectedElements.reset( JSON.parse(RedoData) );
			//turn on tracking, so future actions are tracked
			oxoHistoryManager.turnOnTracking();
			//update buttons
			oxoHistoryManager.updateButtons();
		}
		
	}
	/**
	 * check whether tracking is on or off
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.isTrackingOn = function( ) {
		if ( window.tracking == 'on' ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * log current data
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.logStacks = function() {
		console.log( JSON.parse(oxoCommands) );
	}
	/**
	 * clear all commands and reset manager
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.clear = function() {
		oxoCommands 	= new Array('[]');
		currStep 		= -1;
	}
	/**
	 * check if undo commands exist
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.hasUndo = function () {
		return currStep !== 1;
	}
	/**
	 * check if redo commands exist
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.hasRedo = function () {
		return currStep < ( oxoCommands.length - 1 );
	}
	/**
	 * get existing commands
	 * @param 	NULL
	 * @return 	{string}	actions
	 */
	oxoHistoryManager.getCommands = function () {
		return oxoCommands;
	}
	/**
	 * update buttons colors accordingly
	 * @param 	NULL
	 * @return 	NULL
	 */
	oxoHistoryManager.updateButtons = function () {
		//for undo button
		$( '#both_icon .oxoa-reply' ).css( 'color',oxoHistoryManager.hasUndo() ? "#008EC5" : "" );
		//for redo button
		$( '#both_icon .oxoa-forward' ).css( 'color', oxoHistoryManager.hasRedo() ? "#008EC5" : "" );
		
	}
	 
  })(jQuery);

