window.onload = () => {
    const jsonDataList = document.getElementById('searchDataList').dataset.list;
    const originalDataList = JSON.parse(jsonDataList);
    const searchDataList = JSON.parse(jsonDataList);
    const employeeTable = document.getElementById('employeeTable');
    const getSearchResult = (searchInput) => {
        return searchDataList.filter((item) => {
            return item.firstName.toLowerCase().includes(searchInput.toLowerCase()) || item.lastName.toLowerCase().includes(searchInput.toLowerCase());
        });
    }
    const emptyTable = (table) => {
        for (let i = table.rows.length - 1; i > 0; i--) {
            table.deleteRow(i);
        }
    }
    const fillTable = (table, data) => {
        for (const [index, result] of data.entries()) {
            const editUrl = `/collaborateurs/${result.id}/editer`;
            const signatureUrl = `/collaborateurs/signature/${result.id}`;
            const newRow = table.insertRow(table.rows.length);

            const indexCell = newRow.insertCell(0);
            const firstNameCell = newRow.insertCell(1);
            const lastNameCell = newRow.insertCell(2);
            const positionCell = newRow.insertCell(3);
            const actionCell = newRow.insertCell(4);

            indexCell.innerHTML = index + 1;
            firstNameCell.innerHTML = result.firstName;
            lastNameCell.innerHTML = result.lastName;
            positionCell.innerHTML = result.position;
            actionCell.classList.add('text-center');
            actionCell.innerHTML = `<div class="btn-group-sm dropdown">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item edit-link" href="#"><i class="fa-solid fa-pen"></i> Editer</a>
                            <input type="hidden" name="csrf_token" value={{ csrf_token("employee") }}>
                        </li>
                        <li>
                            <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-employee-id="{{ employee.id }}">
                                <i class="fa-solid fa-trash"></i> Supprimer
                            </button>
                        </li>
                        <li>
                            <a class="dropdown-item signature-link" href=""><i class="fa-solid fa-signature"></i> Signature</a>
                        </li>
                    </ul>
                </div>`;
            newRow.querySelector('.edit-link').setAttribute('href', editUrl);
            newRow.querySelector('.signature-link').setAttribute('href', signatureUrl);
        }
    }

    document.getElementById('searchInput').addEventListener('keyup', (e) => {
        e.preventDefault()

        const searchInput = document.getElementById('searchInput').value;
        const searchInputLength = searchInput.length;

        if (searchInputLength > 3) {
            // get the search results
            const searchResults = getSearchResult(searchInput);

            // Remove all existing rows from the table except for the header
            emptyTable(employeeTable);

            // Add the search results to the table
            fillTable(employeeTable, searchResults);
        } else {
            // Remove all existing rows from the table except for the header
            emptyTable(employeeTable);

            // Add the original data to the table
            fillTable(employeeTable, originalDataList);

        }
    });
}
