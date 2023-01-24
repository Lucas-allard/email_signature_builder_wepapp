document.addEventListener("DOMContentLoaded", function () {
    let deleteButtons = document.querySelectorAll('.dropdown-item[data-bs-toggle="modal"]');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            let employeeId = event.target.dataset.employeeId;
            let csrfToken = document.querySelector("[name='csrf_token']").value;
            let deleteLink = document.querySelector("#deleteLink");
            let employeeRow = document.querySelector('tr[data-employee-id]');

            deleteLink.addEventListener('click', function (event) {
                event.preventDefault();
                fetch("/salaries/" + employeeId + "/supprimer", {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                    .then(response => {
                        if (response.ok) {
                            //close modal & delete the employee in table
                            let modal = bootstrap.Modal.getInstance(document.querySelector('#deleteModal'));
                            modal.hide();
                            employeeRow.remove();
                        }
                    });
            });
        })

    });
})
;