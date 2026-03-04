

$('#dataTable').DataTable({
    processing: true,
    serverSide: true, // Enables server-side processing
    ajax: {
        url: postIndexRoute, // URL to fetch data for the DataTable
        type: 'GET' // HTTP method to use for the AJAX request
    }, // URL to fetch data for the DataTable
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'categories', name: 'categories' },
        { data: 'tags', name: 'tags' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

