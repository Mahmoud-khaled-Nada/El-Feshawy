@csrf
<div class="card-body border-top p-9">
    <!--begin::Input group-->
    <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('lang.file') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-12 fv-row fv-plugins-icon-container">
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        onclick="document.getElementById('file').click()">
                        <i class="fa-solid fa-upload"></i>
                    </span>
                    <span id="filename"></span>
                    <input type="file" name="file" id="file"
                        id=class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" hidden
                        onchange="getFileName()" accept=".xls, .xlsx">
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</div>
<script>
    function getFileName(event) {
        const fileInput = document.getElementById('file');
        const fileNameSpan = document.getElementById('filename');
        if (fileInput.files.length > 0) {
            fileNameSpan.innerText = fileInput.files[0].name;
        }
    }
</script>
