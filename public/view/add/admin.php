<div class="container " id="generatepage1">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
        <div class="">
            <h3></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus minus, nostrum assumenda voluptatem repellat libero molestias facere maxime, ipsam nulla suscipit error. Eum itaque iusto, nam tempore, beatae aperiam asperiores vero voluptate facere dolor quaerat ducimus vel illo porro consequatur minus quod dolorum quam perspiciatis? Voluptas accusantium atque corporis minus ducimus fugiat maiores, fugit, sapiente quaerat debitis id rem deserunt quidem nobis sequi consectetur adipisci veniam, dolorem dolore. Autem corrupti magni voluptatem alias cum ipsum quod assumenda rerum! Maiores ex modi, placeat nostrum dicta aspernatur?</p>
        </div>
    </div>
    <form class=" row g-2  my-3" id="formDataUser" novalidate>
        <div class="col-md-12 col-lg-8">
            <input type="hidden" class="form-control form-control-sm" value="0" id="generatePageId" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <input type="hidden" class="form-control form-control-sm" value="admin" id="generatePageStatus" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Token Openai</span>
                <input type="text" class="form-control form-control-sm" placeholder="Enter your key OpenAI" value="" id="generatePageToken" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 ">
            <div class="input-group input-group-sm  ">
                <span class="input-group-text">Amazon ID</span>
                <input type="text" class="form-control form-control-sm" placeholder="" value="alocraise03-21" id="generatePageAmazon" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Name</span>
                <input type="text" class="form-control form-control-sm" placeholder="" value="Jorge Luis" id="generatePageName" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Surname</span>
                <input type="text" class="form-control form-control-sm" placeholder="" value="Ordóñez" id="generatePageSurname" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">E-mail</span>
                <input type="email" class="form-control form-control-sm" placeholder="" value="generatePageEmail@alocrasi.com" id="generatePageEmail" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <select class="form-select form-select-sm" id="generatePageVersion" aria-label=".form-select-sm example">
                <option selected>Open this select your version</option>
                <option placeholder="" value="gpt-4">gpt-4</option>
                <option placeholder="" value="gpt-3.5-turbo">gpt-3.5-turbo</option>
                <option placeholder="" value="3">Three</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-4 ">
            <div class="input-group input-group-sm  ">
                <span class="input-group-text">Example 2</span>
                <input type="text" class="form-control form-control-sm" placeholder="" value="generatePageExample2" id="generatePageExample2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary " name="btnSend">Submit</button>
        </div>
    </form>
</div>