<div class="container " id="chatgpt2">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
        <div class="">
            <h3></h3>
        </div>
    </div>
    <form class=" row g-2  my-3" id="formCreatePageIA" novalidate>
        <div class="">
            <!-- <input type="hidden" class="form-control form-control-sm" value="0" id="createiIAid" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"> -->
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Title</span>
                <input type="text" class="form-control form-control-sm" value="ecuador" id="titleIA" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class=" ">
            <div class="input-group input-group-sm d-none ">
                <span class="input-group-text">Descripción</span>
                <input type="text" class="form-control form-control-sm" value="Lista de top 5 de balones de futbol" id="descriptionIA" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>

    </form>
    <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="btndev">Create...</button>
        <div id="spinner" class="spinner-grow text-primary" role="status">
            <span class="sr-only"></span>
        </div>
      
    </div>
    <div>
        <div id="resultpageIA" class="">
        </div>
        <div>
            <textarea class="form-control mb-3" style="font-size: 12px;" name="" id="editTextIA"></textarea>
            <button id="btneditText" class="btn btn-primary">Edit</button>
        </div>

    </div>
</div>