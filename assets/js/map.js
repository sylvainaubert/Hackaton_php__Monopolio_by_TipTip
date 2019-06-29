const $ = require('jquery');

$('#modalEvent').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var icon = '<i class=\"' + button.data('icon') + ' animated rotateIn mb-4\"></i>'; // Extract info from data-* attributes
    var name = button.data('name');
    var description = button.data('description');
    var picture = button.data('picture');

    var modal = $(this)

    /*            modal.find('.modal-title').text(recipient)*/
    modal.find('.modal-icon').html(icon);
    modal.find('.modal-title').html(name);
    modal.find('.modal-description').html(description);
    $('#picevent').attr('src', 'build/event/' + picture);
})

/***** THIRD MODAL *****/

$('#modalLoose').on('show.bs.modal', function (loose) {
    var button = $(loose.relatedTarget) // Button that triggered the modal
    var disease = button.data('disease');
    var picture = button.data('picture');
    var refund = button.data('refund');

    var modal = $(this)

    modal.find('.modal-disease').html(disease);
    modal.find('.modal-refund').html(refund);
    $('#picLoose').attr('src', 'build/loose/' + picture);
})

let isEvent = document.getElementById("openModal").value;
console.log($('#openModal').val(), openPopup);
if (isEvent == 1 && openPopup == 1) {
    $("#playEvent").click()
}

$("#btnEventModal").click(function(){
    $('#modalEvent').modal('hide')
});

$("#btnRandomModal").click(function(){
    $('#modalRandom').modal('hide')
});

