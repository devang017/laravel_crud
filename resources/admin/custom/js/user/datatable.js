

$('#dataTable').DataTable({
    processing: true,
    serverSide: true, // Enables server-side processing
    ajax: {
        url: userIndexRoute, // URL to fetch data for the DataTable
        type: 'GET' // HTTP method to use for the AJAX request
    }, // URL to fetch data for the DataTable
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'roles', name: 'roles' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

