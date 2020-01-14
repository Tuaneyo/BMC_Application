/* Formatting function for row details - modify as you need */
function format ( d ) {
    $('.dataTables_length').addClass('bs-select');
    // `d` is the original data object for the row
    return '<form action="<?php echo URL::to(\'download\'); ?>" class="download-form" method="POST" enctype="multipart/form-data">{{ csrf_field() }}' +
        '<input hidden value="2" name="component_id"/>' +
        '<input hidden value="test_1557769025_product-visie.docx" name="file1" />' +

        '<a href="" role="button" class="donwload-link">test_1557769025_product-visie.docx</a>' +
        '</form>';

}

$( document ).ready(function() {
    $(this)
        .find('[data-fa-i2svg]')
        .toggleClass('fa-minus-square')
        .toggleClass('fa-plus-square');

    // Setup - add a text input to each footer cell
    $('#rating-table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Zoek '+title+'" />' );
    } );

// DataTable
   $('#rating-table').DataTable( {
        "language": {
            "sProcessing": "Bezig...",
            "sLengthMenu": "_MENU_ resultaten weergeven",
            "sZeroRecords": "Geen resultaten gevonden",
            "sInfo": "_START_ tot _END_ van _TOTAL_ resultaten",
            "sInfoEmpty": "Geen resultaten om weer te geven",
            "sInfoFiltered": " (gefilterd uit _MAX_ resultaten)",
            "sInfoPostFix": "",
            "sSearch": "Zoeken:",
            "sEmptyTable": "Geen resultaten aanwezig in de tabel",
            "sInfoThousands": ".",
            "sLoadingRecords": "Een moment geduld aub - bezig met laden...",
            "oPaginate": {
                "sFirst": "Eerste",
                "sLast": "Laatste",
                "sNext": "Volgende",
                "sPrevious": "Vorige"
            },
            "oAria": {
                "sSortAscending":  ": activeer om kolom oplopend te sorteren",
                "sSortDescending": ": activeer om kolom aflopend te sorteren"
            }
        },
        "order": [[ 4, "acs" ]]
    } );

    $('#rating-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            console.log(row);
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

});
