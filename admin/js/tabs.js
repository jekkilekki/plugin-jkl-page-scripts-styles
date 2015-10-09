/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

( function( $ ) {
    'use strict';
    
    $( function() {
        
        // Grab the wrapper for the nav tabs
        var navTabs = $( '#jkl-page-ss-navigation' ).children( '.nav-tab-wrapper' ),
            tabIndex = null;
            
        /*
         * Whenever each of the tabs is clicked, check if it has the 'nav-tab-active'
         * class. If not, make it 'active'; otherwise, do nothing.
         * 
         * Next, when a new tab becomes 'active', the corresponding children should
         * become 'hidden'.
         */
        navTabs.children().each( function() {
            
            $( this ).on( 'click', function( e ) {
                
                e.preventDefault();
                
                // If this tab is not active...
                if ( ! $( this ).hasClass( 'nav-tab-active' ) ) {
                    
                    // Unmark the current tab and mark the new one as active
                    $( '.nav-tab-active' ).removeClass( 'nav-tab-active' );
                    $( this ).addClass( 'nav-tab-active' );
                    
                    // Save the index of the tab that's just been marked as active
                    tabIndex = $( this ).index(); // 1-2
                    
                    // Hide the old active content
                    $( '#jkl-page-ss-navigation' )
                            .children( 'div:not( .inside.hidden ) ' )
                            .addClass( 'hidden' );
                    
                    $( '#jkl-page-ss-navigation' )
                            .children( 'div:nth-child(' + ( tabIndex ) + ')' )
                            .addClass( 'hidden' );
                    
                    // And display the new content
                    $( '#jkl-page-ss-navigation' )
                            .children( 'div:nth-child(' + ( tabIndex + 2 ) + ')' )
                            .removeClass( 'hidden' );
                } // END if
                
            }); // END click function
            
        }); // END navTabs each function
        
    }); // END main function
    
} )( jQuery );