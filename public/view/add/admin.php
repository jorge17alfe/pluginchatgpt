<div id="generatepage1">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
      
    </div>
    
    <form class=" row g-2  my-3" id="formDataUser" novalidate>
        <div class="col-md-12 col-lg-8">
            <input type="text" class="form-control form-control-sm" value="<?= get_current_user_id() ?>" id="generatePageId" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
            <select class="form-select form-select-sm" id="generatePageVersion" aria-label=".form-select-sm example">
                <option selected>Open this select your version</option>
                <option placeholder="" value="gpt-4">gpt-4</option>
                <option placeholder="" value="gpt-3.5-turbo">gpt-3.5-turbo</option>
                <option placeholder="" value="3">Three</option>
            </select>
        </div>
       
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary " name="btnSend">Submit</button>
        </div>
    </form>
</div>