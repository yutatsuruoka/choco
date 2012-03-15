
// This function goes through the options for the given
// drop down box and removes them in preparation for
// a new set of values

function emptyList( box ) {
	// Set each option to null thus removing it
	while ( box.options.length ) box.options[0] = null;
}

// This function assigns new drop down options to the given
// drop down box from the list of lists specified

function fillList( box, arr ) {
	for ( i = 0; i < arr.length; i++ ) {

		// Create a new drop down option with the
		// display text and value from arr

		option = new Option( arr[i], arr[i] );

		// Add to the end of the existing options

		box.options[box.length] = option;
	}

	// Preselect option 0

	box.selectedIndex=0;
}

// This function performs a drop down list option change by first
// emptying the existing option list and then assigning a new set

function changeList( box, list ) {
	// Next empty the slave list

	emptyList( box );

	// Then assign the new list values

	fillList( box, list );
}
