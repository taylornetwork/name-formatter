<?php
/**
 * TaylorNetwork Name Formatter Config.
 *
 * @author Sam Taylor
 */

return [

    /*
     |--------------------------------------------------------------------------
     | Default Name Style
     |--------------------------------------------------------------------------
     |
     | The name formatter will use this as the default name style,
     | unless overridden by a call.
     |
     | Options:
     |      F = first name
     |      f = first initial
     |      L = last name
     |      l = last initial
     |
     | Anything else will be added to the name.
     |
     | Examples:
     |      First Name: Sam
     |      Last Name: Taylor
     |
     |      'F L'   => 'Sam Taylor'
     |      'L, F'  => 'Taylor, Sam'
     |      'f L'   => 'S Taylor'
     |      'fl'    => 'ST'
     |      'ff_L'  => 'SS_Taylor'
     |
     */
    'style' => 'F L',

    /*
     |--------------------------------------------------------------------------
     | Field Map - If Not Typical
     |--------------------------------------------------------------------------
     |
     | By default the name formatter will look for a first_name and a last_name
     | attribute on whichever model it is passed. You can override the field
     | names used by adding them to this array or by a call.
     |
     | Usage Example:
     |      Model has first name attribute in a field called fName and last name
     |      in a field called lName.
     |
     |      'fieldMap' => [
     |          'first_name' => 'fName',
     |          'last_name' => 'lName',
     |      ],
     |
     */
    'fieldMap' => [],
];
