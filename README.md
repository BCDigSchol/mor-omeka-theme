# MoR-omeka-theme
Custom theme for The Mirror of Race omeka project, based on the standard Seasons Classic Omeka theme (https://omeka.org/classic/themes/seasons/)

One major difference betwen MoR and a standard Omeka database is the "levels of engagement" capability, which allows users to discover more info about the image over time. This was accomplished through incorporating the "selectively-show-fields.js" (base version backed up here) into the show.php in the items folder. This allows us to create buttons to show only certain metadata fields at certain moments, and to only show those fields if they are not "null"

