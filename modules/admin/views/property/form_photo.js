$(function(){
    $('.photo-remove').click(removeClicked);

    $('#photo-list').sortable({
        placeholder:'placeholder',
        create: sortCreated,
        update: sortChanged
    }).disableSelection();
});

/**
 * Event handler for when a photo remove button is clicked.
 */
function removeClicked(event) {
    $(this).closest('li').remove();
    updateSortData();
}

/**
 * Event handler for when photo sortable object is created.
 */
function sortCreated(event, ui) {
    updateSortData();
}

/**
 * Event handler for when the ordering of the photos has been changed.
 */
function sortChanged(event, ui) {
    updateSortData();
}

/**
 * Update the value of the form hidden field that represents the ordering
 * of the photos.
 */
function updateSortData() {
    $('#photo-order').val($('#photo-list').sortable('toArray').toString());   
}