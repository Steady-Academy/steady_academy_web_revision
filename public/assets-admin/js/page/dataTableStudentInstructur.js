// DataTables with Column Search by Text Inputs
document.addEventListener("DOMContentLoaded", function () {
    // Setup - add a text input to each footer cell
    $("#datatables-column-search-text-inputs tfoot th.filter").each(
        function () {
            var title = $(this).text();
            $(this).html(
                '<input type="text" class="form-control" placeholder="Search ' +
                    title +
                    '" />'
            );
        }
    );
    // DataTables
    var table = $("#datatables-column-search-text-inputs").DataTable({
        order: [],
        language: {
            processing: `
            <div class="progress-bar">
                <div class="progress-bar-value"></div>
            </div>
            `,
        },
        responsive: true,
        scrollX: true,
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        lengthChange: false,
        columns: [
            {
                data: "name",
                name: "name",
            },
            {
                data: "phoneNumber",
                name: "phoneNumber",
            },
            {
                data: "login_at",
                name: "login_at",
            },
            {
                data: "provider",
                name: "provider",
            },
            {
                data: "created_at",
                name: "created_at",
            },
        ],
    });

    // Apply the search
    table.columns().every(function () {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });

    setInterval(function () {
        table.ajax.reload();
    }, 30000);

    $(".col-sm-12.col-md-6").first().append($("#add"));
    $("#add>button").click(function refreshData() {
        table.ajax.reload(null, true);
    });
    $(".col-sm-12.col-md-6:eq(1)").addClass("my-auto");
    $(".loading")
        .appendTo(
            ".col-sm-12>#datatables-column-search-text-inputs_wrapper>.row:eq(0)"
        )
        .first();
    $(".loading").append($("div.dataTables_processing"));
});
