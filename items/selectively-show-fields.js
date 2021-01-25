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
     *
     * @param {string} fieldId The ID of the field to display
     */
    function showField(fieldId) {
        var field = document.getElementById(fieldId);
        field.style.display = "block";
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