<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
  <style>
        /* Make the buttons look less button-y. */
        .hide-show-button-row button {
            border: none;
            background: transparent;
            text-transform: none;
			margin: auto;
        }

        /* Hide all elements by default on initial page load. */
        .element {
            display: none;
        }

        /* Specify any elements to show on initial page load below */
        #dublin-core-identifier {
            display: block;
        }

		div.element-set {
			width: 420px; 
            height: 280px; 
            overflow: auto; 
		}

        -->
    </style>

	

<!-- Moved navigation to the top of the page -->
<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
	

    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<h1><?php echo metadata('item', array('Dublin Core', 'Identifier')); ?></h1>

<div id="primary">

    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
    <?php endif; ?>
    
	 <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>
    
</div><!-- end primary -->

<aside id="sidebar">
	<!-- SELECTIVE SHOW/HIDE CHANGES -->
	<div class="hide-show-button-row">
		<button id="set-one-button">Image Only</button>
		<button id="set-two-button">Basic Information</button>
		<button id="set-three-button">Commentaries</button>
   </div>
   <!-- END SELECTIVE SHOW/HIDE CHANGES -->
  
	
<script>
<!-- SELECTIVE SHOW/HIDE CHANGES -->

	/**
 * Selectively show only a set of Omeka record fields
 *
 * Usage: SelectivelyShow.addSelectFieldsButton(buttonId, fieldsToShow)
 *
 * Example
 *
 * SelectivelyShow.addSelectFieldButton('show-three-fields-button', ['dublin-core-title', 'dublin-code-identifier, 'item-citation']);
 *
 * @type {{addSelectFieldsButton: addSelectFieldsButton}}
 */
var SelectivelyShow = (function () {

    var my = {}

    /**
     * Switch to display only a certain set of fields.
     *
     * @param {string[]} fieldsToShow IDs of fields to display when button is pressed
     *                     (e.g. ['dublin-core-title', 'dublin-code-identifier, 'item-citation'] ;
     */
    function switchFieldSet(fieldsToShow) {

        // First hide unwanted fields. Omeka gives all Dublin Core element fields the
        // class 'element', so we'll find those and hide them.
        hideByClass('element');

        // Next show wanted fields.
        for (var i = 0; i < fieldsToShow.length; i++) {
            showField(fieldsToShow[i]);
        }
    }

    /**
     * Hide all elements with a given class name
     *
     * @param className The class name of the fields to hide
     */
    function hideByClass(className) {
        var allElements = document.getElementsByClassName(className);

        for (var i = 0; i < allElements.length; i++) {
            allElements[i].style.display = "none";
        }
    }

    /**
     * Show a single field
     * If field is null, don't add it
     * @param {string} fieldId The ID of the field to display
     */
    function showField(fieldId) {
        var field = document.getElementById(fieldId);
        if (field != null) {
			field.style.display = "block";
		}
    }

    /**
     * Assign a button to selectively show a set of fields
     *
     * @param {string} buttonId ID of a button to assign
     * @param {string[]} fieldsToShow fieldsToShow IDs of fields to display when button is pressed
     *                     (e.g. ['dublin-core-title', 'dublin-code-identifier, 'item-citation']) ;
     */
    function addSelectFieldsButton(buttonId, fieldsToShow) {
        document.getElementById(buttonId).onclick = function () {
            switchFieldSet(fieldsToShow);
        }
    }

    return {
        addSelectFieldsButton
    };

}());


	// Add buttons to switch field sets. The first field is the ID of a button, the
    // second field is an array of the IDs of the elements you want to show when that
    // button is pressed.
    SelectivelyShow.addSelectFieldsButton('set-one-button', ['dublin-core-identifier']);
    SelectivelyShow.addSelectFieldsButton('set-two-button', ['dublin-core-title', 'dublin-core-creator', 'dublin-core-subject', 'dublin-core-type', 'still-image-item-type-metadata-physical-dimensions', 'still-image-item-type-metadata-original-format','dublin-core-date', 'item-citation']);
    

	 SelectivelyShow.addSelectFieldsButton('set-three-button', ['dublin-core-title', 'still-image-item-type-metadata-factual-commentary', 'still-image-item-type-metadata-interpretive-commentary', 'item-citation']);
	
	
	
	
	//SelectivelyShow.addSelectFieldsButton('set-three-button', ['dublin-core-title', 'still-image-item-type-metadata-interpretive-commentary', 'item-citation']);

</script>
<!-- END SELECTIVE SHOW/HIDE CHANGES -->



	<!-- Moved this line from primary to secondary to move text over -->
	<?php //echo metadata('item', array('Dublin Core', 'Title')); ?>
	<?php echo all_element_texts('item'); ?>
	<?php //echo all_element_texts('item', array('show_element_sets' => array('Dublin Core'))); ?>
	
	
    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (metadata('item', 'Collection Name')): ?>
    <div id="dublin-core-alternative-title" class="element">
        <h2><?php echo __('Alternative Title'); ?></h2>
		<?php echo metadata('item', array('Dublin Core', 'Alternative Title')); ?>
    </div>
    <?php endif; ?>
	

	<?php if (metadata('item', 'Collection Name')): ?>
    <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
    </div> 
    <?php endif; ?>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

   

</aside>



<?php echo foot(); ?>
