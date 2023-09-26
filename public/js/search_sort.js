// JavaScript code for search functionality
$(document).ready(function () {
    $('#search').on('keyup', function () {
        var searchText = $(this).val().toLowerCase();
        $('#announcementData .card').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
        });
    });

    $('#searchTenant').on('keyup', function () {
        var search_text = $(this).val().toLowerCase();
        $('#tenantTable tbody tr').filter(function () {
            var row_text = $(this).text().toLowerCase();
            $(this).toggle(row_text.indexOf(search_text) > -1);
        });
    });


    $('#sort-by').on('change', function () {
        var sortBy = $(this).val();
        if (sortBy === 'location') {
            sortTableByColumn(3); // Location column index
        } else if (sortBy === 'dues') {
            sortTableByColumn(5); // Dues column index
        }
    });

    function sortTableByColumn(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById('tenantsData');
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName('TD')[columnIndex];
                y = rows[i + 1].getElementsByTagName('TD')[columnIndex];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    $('#sort-by').on('change', function () {
        var sortBy = $(this).val();
        if (sortBy === 'status') {
            sortTableByColumn(4); // Status column index
        } else if (sortBy === 'priority') {
            sortTableByColumn(2); // Priority column index
        } else if(sortBy === 'date'){
            sortTableByColumn(0); // Date column index
        }
    });

    function sortTableByColumn(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById('maintenanceData');
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName('TD')[columnIndex];
                y = rows[i + 1].getElementsByTagName('TD')[columnIndex];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
});

