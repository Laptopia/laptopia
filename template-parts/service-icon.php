<?php
// Fixed SVG markup from the shared icon source, never user input.
echo str_replace(
    '<svg ',
    '<svg class="laptopia-dropdown-icon" width="17" height="17" aria-hidden="true" focusable="false" ',
    laptopia_get_icon_svg( $args['slug'] ?? '' )
);
