/**
 * Creates a new input element to add files be enqueued in the webpage
 * and added to either the head (CSS) or body (JS) of the site.
 * 
 * @since   0.1.0
 * @param   object  $   A reference to the jQuery object.
 * @returns object      A file to be enqueued in the webpage.
 */
function createInputElement( $ ) {
    
    var $inputElement, inputCount;
    
    /*
     * First, count the number of input fields that already exist.
     * This is how we set the name and ID attributes of the element. 
     */
    inputCount = $( '#jkl-page-ss-enqueue' ).children().length;
    inputCount++;
    
    // Next, create the actual input element and return it
    $inputElement = 
            $( '<input />' )
            .attr( 'type', 'text' )
            .attr( 'name', 'jkl-page-ss-enqueue-' + inputCount )
            .attr( 'id', 'jkl-page-ss-enqueue-' + inputCount )
            .attr( 'value', '' );
    
    return $inputElement;
    
} // END createInputElement($)

( function( $ ) {
    'use strict';
    
    $( function() {
        
        var $inputElement;
        
        $( '#jkl-page-ss-add-enqueue' ).on( 'click', function( e ) {
            
            e.preventDefault();
            
            /**
             * Create a new input element that will be used to capture the 
             * user input and append it to the container just above this button.
             */
            $( '#jkl-page-ss-enqueue' ).append( createInputElement( $ ) );
            
        }); // END click function
        
    }); // END main function
    
}) ( jQuery );

