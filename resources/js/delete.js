document.addEventListener('DOMContentLoaded', function () {
    window.confirmDelete = function (dishId) {

        if (confirm("Sei sicuro di voler eliminare questo piatto?")) {
            document.getElementById(`delete-form-${dishId}`).submit();
        }
    };
});

const deleteConfirm = document.getElementById('')
const deleteButton = document.getElementById(`delete-form-${dishId}`);

myModal.addEventListener('shown.bs.modal', () => {
  deleteButton.focus()
})
