<div id="generatepage4">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
        <div class="">
            <h3></h3>
        </div>
    </div>
    <table class="table table-striped" id="listPages">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name URL</th>
                <th scope="col">Status</th>
                <th scope="col">Title</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div class="">
        <p class=" d-flex justify-content-around">
            <a onclick=' pagination(-1)' href="javascritp:void(0);">PREV</a>
            <!-- <a onclick=' pagination(+1)' href="javascritp:void(0);">1</a>
            <a onclick=' pagination(+1)' href="javascritp:void(0);">2</a>
            <a onclick=' pagination(+1)' href="javascritp:void(0);">2</a> -->
            <a onclick=' pagination(+1)' href="javascritp:void(0);">NEXT</a>
        </p>
    </div>
</div>



