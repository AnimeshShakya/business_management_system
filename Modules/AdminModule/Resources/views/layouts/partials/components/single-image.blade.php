<div class="card p-20 mb-4">
    <div class="row g-4">
        <div class="col-md-12">
            <h2 class="mb-2 text-primary text-uppercase border-bottom pb-3">Single Images</h2>
        </div>
        <div class="col-md-6">
            <h2 class="text-primary text-uppercase fz-16 mb-2">1/1 Image</h2>
            {{-- snippet container --}}
            <div class="component-snippets-container position-relative card">
                <div class="component-snippets-preview">
                    <div id="liveAlertPlaceholder">
                        <div></div>
                    </div>
                    {{-- Content starts --}}
                    <div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
                        <div>
                            <label for="" class="form-label fw-semibold mb-1">
                                Upload Specialty Image
                                <span class="text-danger">*</span>
                            </label>
                            <p class="fs-12 mb-0">Upload your Specialty Image</p>
                        </div>
                        <div class="upload_wrapper d-flex justify-content-center">
                            <div class="upload-file-new">
                                <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                                    accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
                                <label class="upload-file-new__wrapper ratio-1-1">
                                    <div class="upload-file-new-textbox text-center">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <i class="fi fi-sr-camera text-primary fs-16"></i>
                                            <span class="fs-10">{{ translate('Add_image') }}</span>
                                        </div>
                                    </div>
                                    <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
                                </label>
                                <div class="overlay">
                                    <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                                        <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                                            <i class="fi fi-rr-camera"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn view_btn">
                                            <i class="fi fi-sr-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
                                class="text-dark fw-semibold">(1:1)</span></p>
                    </div>
                    {{-- Content ends --}}
                </div>
                <div class="position-relative snippets-code-hover">
                    <div class="component-snippets-code-header">
                        <button
                            class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                        <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                            <i class="fi fi-rr-copy"></i>
                        </button>
                    </div>
                    <div class="code-preview max-w-100">
                        <div class="component-snippets-code-container">
<pre><code><div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
    <div>
        <label for="" class="form-label fw-semibold mb-1">
            Upload Specialty Image
            <span class="text-danger">*</span>
        </label>
        <p class="fs-12 mb-0">Upload your Specialty Image</p>
    </div>
    <div class="upload_wrapper d-flex justify-content-center">
        <div class="upload-file-new">
            <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
            <label class="upload-file-new__wrapper ratio-1-1">
                <div class="upload-file-new-textbox text-center">
                    <div class="d-flex flex-column gap-1 justify-content-center">
                        <i class="fi fi-sr-camera text-primary fs-16"></i>
                        <span class="fs-10">{{ translate('Add_image') }}</span>
                    </div>
                </div>
                <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
            </label>
            <div class="overlay">
                <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                    <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                        <i class="fi fi-rr-camera"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn view_btn">
                        <i class="fi fi-sr-eye"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
            class="text-dark fw-semibold">(1:1)</span></p>
</div></code></pre>
                        </div>
                    </div>
                </div>
            </div>
            {{-- snippet container ends --}} 
        </div>
        <div class="col-md-6">
            <h2 class="text-primary text-uppercase fz-16 mb-2">2/1 Image</h2>
            {{-- snippet container --}}
            <div class="component-snippets-container position-relative card">
                <div class="component-snippets-preview">
                    <div id="liveAlertPlaceholder">
                        <div></div>
                    </div>
                    {{-- Content starts --}}
                    <div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
                        <div>
                            <label for="" class="form-label fw-semibold mb-1">
                                Upload Specialty Image
                                <span class="text-danger">*</span>
                            </label>
                            <p class="fs-12 mb-0">Upload your Specialty Image</p>
                        </div>
                        <div class="upload_wrapper d-flex justify-content-center">
                            <div class="upload-file-new">
                                <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                                    accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
                                <label class="upload-file-new__wrapper ratio-2-1">
                                    <div class="upload-file-new-textbox text-center">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <i class="fi fi-sr-camera text-primary fs-16"></i>
                                            <span class="fs-10">{{ translate('Add_image') }}</span>
                                        </div>
                                    </div>
                                    <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
                                </label>
                                <div class="overlay">
                                    <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                                        <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                                            <i class="fi fi-rr-camera"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn view_btn">
                                            <i class="fi fi-sr-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
                                class="text-dark fw-semibold">(2:1)</span></p>
                    </div>
                    {{-- Content ends --}}
                </div>
                <div class="position-relative snippets-code-hover">
                    <div class="component-snippets-code-header">
                        <button
                            class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                        <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                            <i class="fi fi-rr-copy"></i>
                        </button>
                    </div>
                    <div class="code-preview max-w-100">
                        <div class="component-snippets-code-container">
<pre><code><div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
    <div>
        <label for="" class="form-label fw-semibold mb-1">
            Upload Specialty Image
            <span class="text-danger">*</span>
        </label>
        <p class="fs-12 mb-0">Upload your Specialty Image</p>
    </div>
    <div class="upload_wrapper d-flex justify-content-center">
        <div class="upload-file-new">
            <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
            <label class="upload-file-new__wrapper ratio-2-1">
                <div class="upload-file-new-textbox text-center">
                    <div class="d-flex flex-column gap-1 justify-content-center">
                        <i class="fi fi-sr-camera text-primary fs-16"></i>
                        <span class="fs-10">{{ translate('Add_image') }}</span>
                    </div>
                </div>
                <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
            </label>
            <div class="overlay">
                <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                    <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                        <i class="fi fi-rr-camera"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn view_btn">
                        <i class="fi fi-sr-eye"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
            class="text-dark fw-semibold">(2:1)</span></p>
</div></code></pre>
                        </div>
                    </div>
                </div>
            </div>
            {{-- snippet container ends --}} 
        </div>
        <div class="col-md-6">
            <h2 class="text-primary text-uppercase fz-16 mb-2">3/1 Image</h2>
            {{-- snippet container --}}
            <div class="component-snippets-container position-relative card">
                <div class="component-snippets-preview">
                    <div id="liveAlertPlaceholder">
                        <div></div>
                    </div>
                    {{-- Content starts --}}
                    <div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
                        <div>
                            <label for="" class="form-label fw-semibold mb-1">
                                Upload Specialty Image
                                <span class="text-danger">*</span>
                            </label>
                            <p class="fs-12 mb-0">Upload your Specialty Image</p>
                        </div>
                        <div class="upload_wrapper d-flex justify-content-center">
                            <div class="upload-file-new">
                                <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                                    accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
                                <label class="upload-file-new__wrapper ratio-3-1">
                                    <div class="upload-file-new-textbox text-center">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <i class="fi fi-sr-camera text-primary fs-16"></i>
                                            <span class="fs-10">{{ translate('Add_image') }}</span>
                                        </div>
                                    </div>
                                    <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
                                </label>
                                <div class="overlay">
                                    <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                                        <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                                            <i class="fi fi-rr-camera"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn view_btn">
                                            <i class="fi fi-sr-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
                                class="text-dark fw-semibold">(3:1)</span></p>
                    </div>
                    {{-- Content ends --}}
                </div>
                <div class="position-relative snippets-code-hover">
                    <div class="component-snippets-code-header">
                        <button
                            class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                        <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                            <i class="fi fi-rr-copy"></i>
                        </button>
                    </div>
                    <div class="code-preview max-w-100">
                        <div class="component-snippets-code-container">
<pre><code><div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
    <div>
        <label for="" class="form-label fw-semibold mb-1">
            Upload Specialty Image
            <span class="text-danger">*</span>
        </label>
        <p class="fs-12 mb-0">Upload your Specialty Image</p>
    </div>
    <div class="upload_wrapper d-flex justify-content-center">
        <div class="upload-file-new">
            <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
            <label class="upload-file-new__wrapper ratio-3-1">
                <div class="upload-file-new-textbox text-center">
                    <div class="d-flex flex-column gap-1 justify-content-center">
                        <i class="fi fi-sr-camera text-primary fs-16"></i>
                        <span class="fs-10">{{ translate('Add_image') }}</span>
                    </div>
                </div>
                <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
            </label>
            <div class="overlay">
                <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                    <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                        <i class="fi fi-rr-camera"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn view_btn">
                        <i class="fi fi-sr-eye"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
            class="text-dark fw-semibold">(3:1)</span></p>
</div></code></pre>
                        </div>
                    </div>
                </div>
            </div>
            {{-- snippet container ends --}} 
        </div>
        <div class="col-md-6">
            <h2 class="text-primary text-uppercase fz-16 mb-2">7/1 Image</h2>
            {{-- snippet container --}}
            <div class="component-snippets-container position-relative card">
                <div class="component-snippets-preview">
                    <div id="liveAlertPlaceholder">
                        <div></div>
                    </div>
                    {{-- Content starts --}}
                    <div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
                        <div>
                            <label for="" class="form-label fw-semibold mb-1">
                                Upload Specialty Image
                                <span class="text-danger">*</span>
                            </label>
                            <p class="fs-12 mb-0">Upload your Specialty Image</p>
                        </div>
                        <div class="upload_wrapper d-flex justify-content-center">
                            <div class="upload-file-new">
                                <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                                    accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
                                <label class="upload-file-new__wrapper ratio-7-1">
                                    <div class="upload-file-new-textbox text-center">
                                        <div class="d-flex flex-column gap-1 justify-content-center">
                                            <i class="fi fi-sr-camera text-primary fs-16"></i>
                                            <span class="fs-10">{{ translate('Add_image') }}</span>
                                        </div>
                                    </div>
                                    <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
                                </label>
                                <div class="overlay">
                                    <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                                        <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                                            <i class="fi fi-rr-camera"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn view_btn">
                                            <i class="fi fi-sr-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
                                class="text-dark fw-semibold">(7:1)</span></p>
                    </div>
                    {{-- Content ends --}}
                </div>
                <div class="position-relative snippets-code-hover">
                    <div class="component-snippets-code-header">
                        <button
                            class="bg-primary min-w-80 h-40 border-0 py-2 px-3 fz-14 text-uppercase bg-opacity-10">Html</button>
                        <button class="bg-opacity-10 min-w-50 h-40 bg-primary py-2 px-3 border-0 copy--button">
                            <i class="fi fi-rr-copy"></i>
                        </button>
                    </div>
                    <div class="code-preview max-w-100">
                        <div class="component-snippets-code-container">
<pre><code><div class="bg-light rounded-10 p-3 p-sm-20 d-flex flex-column gap-20">
    <div>
        <label for="" class="form-label fw-semibold mb-1">
            Upload Specialty Image
            <span class="text-danger">*</span>
        </label>
        <p class="fs-12 mb-0">Upload your Specialty Image</p>
    </div>
    <div class="upload_wrapper d-flex justify-content-center">
        <div class="upload-file-new">
            <input type="file" name="thumbnail" class="upload-file-new__input single_file_input"
                accept=".webp, .jpg, .jpeg, .png, .gif" value="" required>
            <label class="upload-file-new__wrapper ratio-7-1">
                <div class="upload-file-new-textbox text-center">
                    <div class="d-flex flex-column gap-1 justify-content-center">
                        <i class="fi fi-sr-camera text-primary fs-16"></i>
                        <span class="fs-10">{{ translate('Add_image') }}</span>
                    </div>
                </div>
                <img class="upload-file-new-img" loading="lazy" src="" data-default-src="" alt="">
            </label>
            <div class="overlay">
                <div class="d-flex gap-10 justify-content-center align-items-center h-100">
                    <button type="button" class="btn btn-outline-info icon-btn edit_btn">
                        <i class="fi fi-rr-camera"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn view_btn">
                        <i class="fi fi-sr-eye"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info icon-btn remove_btn">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <p class="fs-10 mb-0 text-center">{{ translate('JPG,_JPEG_or_PNG._image_size_:_max_2_MB') }} <span
            class="text-dark fw-semibold">(7:1)</span></p>
</div></code></pre>
                        </div>
                    </div>
                </div>
            </div>
            {{-- snippet container ends --}} 
        </div>
    </div>
</div>

