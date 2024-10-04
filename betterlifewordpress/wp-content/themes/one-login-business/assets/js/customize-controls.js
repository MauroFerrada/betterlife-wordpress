( function( api ) {

	// Extends our custom "one-login-business" section.
	api.sectionConstructor['one-login-business'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );


  api.controlConstructor['toggle'] = api.Control.extend( {

    ready: function() {
      var control = this;

      this.container.on( 'change', 'input:checkbox', function() {
        value = this.checked ? true : false;
        control.setting.set( value );
      } );
    }
   
  } );


} )( wp.customize );