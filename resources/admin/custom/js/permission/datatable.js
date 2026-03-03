

$('#dataTable').DataTable({
    processing: true,
    serverSide: true, // Enables server-side processing
    ajax: {
        url: permissionIndexRoute, // URL to fetch data for the DataTable
        type: 'GET' // HTTP method to use for the AJAX request
    }, // URL to fetch data for the DataTable
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'slug', name: 'slug' },
        { data: 'description', name: 'description' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

